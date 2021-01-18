<?php

namespace App\Api\Controllers\v1;

use App\Api\Controllers\BaseController;
use App\Api\Transformers\v1\UserTransformer;
use App\Models\Subscription;
use App\Models\User;
use Dingo\Api\Exception\StoreResourceFailedException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

/**
 * @group User
 *
 * APIs for managing users
 */
class UserController extends BaseController
{


    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:users,email|max:255',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone_number' => 'required|string|unique:users,phone_number|max:20',
            'mobile_money_number' => 'nullable|string|unique:users,mobile_money_number|max:20',
            'country' => 'nullable|string|max:255',
            'password_confirm' => 'required|same:password',
            'password' => ['required', 'string', 'min:6'],
        ]);

        if ($validator->fails()) {
            throw new StoreResourceFailedException($validator->errors()->first(), $validator->errors());
        }

        $data = request()->all();
        $data['raw_password'] = $data['password'];
        $data['password'] = Hash::make($data['password']);
        $data['password'] = Hash::make($request->input('password'));
        $data['type'] = 'manager';
        $user = User::query()->create($data);
        $token = auth('api')->login($user);





        $data['full_name'] = $user->full_name;
        try {
              Mail::send("emails.new_subscriber", $data, function ($mail) use ($data) {
            $mail->subject("MTN Business Manager Registration")
                ->to($data['email']);
        });

             Mail::send("emails.new_subscriber2", $data, function ($mail) use ($data) {
            $mail->subject("MTN Business Manager Registration")
                ->to($data['email']);
        });
//            $this->sendNotifications($user);
        }catch (\Exception $ex){
            file_put_contents(storage_path() . '/logs/momo_log.log', "\n" . now() . ' || ' . $ex->getMessage() . PHP_EOL, FILE_APPEND);
        }

        $user->log("Created new account: " . $user->id);

        $res =  Subscription::query()->create([
            'status' => 'owing',
            'user_id' => $user->id,
            'is_first_time' => true
        ]);

        $user->update(['subscription_id' => $res->id]);



        return response()->json([

            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL(),
            'status_code' => 201,
            'message' => "User created successfully",
            'id' => $user->id_hash,
            "type" => $user->type,

        ])->setStatusCode(201);
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


    public function update(Request $request)
    {
        $user = User::findByIdHash(request('id', ''));
        if (!isset($user)) {
            $this->response->errorNotFound("User not found");
        }
        $data = request()->all();
        $rules = [
            'first_name' => 'string|max:255',
            'last_name' => 'string|max:255',
            'country' => 'string|max:255',
            'email'        => [
                'email',
                'max:255',
                Rule::unique('users')
                    ->where('deleted_at', null)
                    ->ignore($user)
            ],
            'phone_number'        => [
                'string',
                'max:255',
                Rule::unique('users')
                    ->where('deleted_at', null)
                    ->ignore($user)
            ],
            'mobile_money_number'        => [
                'string',
                'max:255',
                Rule::unique('users')
                    ->where('deleted_at', null)
                    ->ignore($user)
            ],
        ];

        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            throw new StoreResourceFailedException('Could not update user.', $validator->errors());
        }

        // Remove id_hash & id, password fields if exist
        unset($data['id_hash'], $data['id'], $data['password']);

        $user->update($data);
        auth()->user()->log("updated user: {$user->name}");
        return ['status_code' => 200, 'message' => "User updated successfully"];
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


    public function passwordReset(Request $request)
    {
        $user = auth()->user();

        $data = $request->all();
        $validator = Validator::make($data, [
            'new_password' => ['required', 'string', 'min:6'],
            'old_password' => [
                'required',
                'min:6',
                function ($attribute, $value, $fail) use ($user) {
                    if (!Hash::check($value, $user->password)) {
                        $fail($attribute . ' is invalid.');
                    }
                },
            ]
        ]);
        if ($validator->fails()) {
            throw new StoreResourceFailedException($validator->errors()->first(), $validator->errors());
        }

        // Remove id_hash & id fields if exist
        unset($data['id_hash'], $data['id']);
        $user->update(['password' => Hash::make($data['new_password'])]);

        auth()->user()->log("changed user password: {$user->name}");
        return ['status_code' => 200, 'message' => "Password changed successfully"];
    }


    public function view()
    {
        $user = User::findByIdHash(request('id', ''));
        if (!isset($user))
            $this->response->errorNotFound("User not found");
        return $this->response->item($user, new UserTransformer);
    }

    /**
     * Delete a user
     *
     * Deletes a user account
     *
     * @urlParam id required The id of the user. Example: 10
     * @response {
     *  "status_code": 200,
     *  "message": "User deleted successfully"
     * }
     * @response 404 {
     *  "status_code": 4,
     *  "message": "User not found"
     * }
     */
    public function delete($id)
    {
        $user = User::findByIdHash($id);
        if (!isset($user))
            $this->response->errorNotFound("User not found");

        $user->delete();
        return ['status_code' => 200, 'message' => "User deleted successfully"];
    }
}
