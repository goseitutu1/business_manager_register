<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Subscription;
use App\Models\SurveyNotification;
use App\Models\TmpRegistration;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/business/setup-business';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {

        return Validator::make($data, [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'terms_and_conditions' => [
                'required',
                function ($attribute, $value, $fail) {
                    if (!(strlen("$value") != "true")) {
                        $fail('You must accept the Terms and Conditions');
                    }
                },
            ],
            'phone_number' => ['required', 'unique:users', 'between:10,12',
                               function ($attribute, $value, $fail) {
                                   if (preg_match('/[a-zA-Z]/i', $value)) {
                                       $fail('Invalid phone number');
                                   }
                               }
            ],
            'password' => ['required', 'string', 'min:8', 'same:confirmed'],
            'advert_source' => [
                function ($attribute, $value, $fail) {
                    if (($value != "Other") && strlen("$value") == 0) {
                        $fail('This field is required.');
                    }
                }
            ],
            'advert_source_val' => 'required_if:advert_source,Other',
        ]);
    }

    protected function create(array $data)
    {

        Session::flash('alert-success', 'Account Created Successfully');

        $tmp_user = null;

        if (!empty($data['tmp_id']))
            $tmp_user = TmpRegistration::query()->find($data['tmp_id']);

        if ($data['advert_source'] == 'Other') {
            $data['advert_source'] = $data['advert_source_val'];
        }


        $user = User::query()->create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'phone_number' => $data['phone_number'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'type' => 'manager',
            'advert_source' => $data['advert_source'],
        ]);

        $res = Subscription::query()->create([
            'status' => 'owing',
            'user_id' => $user->id,
            'is_first_time' => true
        ]);


        $user->update(['subscription_id' => $res->id]);
        $tmp_user ? $tmp_user->isRegistered() : null;

        $this->sendNotifications($data);

        $user->survey_notification()->create(['user_id' => $user->id, 'status' => 'pending']);
        return $user;
    }

    private function sendNotifications($user)
    {
        // send registration sms
        $message = "Hello " . $user['first_name'] . ",\nYour account for MTN Business Manager has been created.";
        $message = "${message}\nKindly visit " . route('login') . " with\n username: " . $user['email'];
        $message = "${message}\n password:  " . $user['password'];
        $message = "${message}\nThank You, \nMTN Business Manager";

        $this->sendSms($message, $user['phone_number']);
        // $user->update(['sms_response' => $this->sendSms($message, $user->phone_number)]);
    }

    public function sendSms($text, $phone)
    {
        $message = urlencode($text);
        $num = urlencode($phone);
        // $source = chr(194) . chr(160) ."MTN". chr(194) . chr(160);
        // TODO: report this bug to mtn. We bypass their filter of SMS ID with this trick
        $source = chr(160) ."MTNBusiness";

        $url = "https://deywuro.com/api/sms?username=mtnbusinessmgr&password=ed6486&source=$source&destination=" . $num . "&message=" . $message;

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($curl);
        curl_close($curl);

        return $output;
    }
}
