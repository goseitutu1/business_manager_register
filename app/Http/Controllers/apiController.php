<?php /** @noinspection DuplicatedCode */

namespace App\Http\Controllers;

use App\Api\Transformers\v1\BusinessTransformer;
use App\Api\Transformers\v1\CategoryTransformer;
use App\Models\AuditTrail;
use App\Models\Business;
use App\Models\Category;
use App\Models\Currency;
use App\Models\Employee;
use App\Models\MobileMoneyTransaction;
use App\Models\Subscription;
use App\Models\SubscriptionPlan;
use App\Models\TmpRegistration;
use App\Models\User;
use App\Models\WhitelistedIPs;
use Carbon\Carbon;
use Dingo\Api\Exception\StoreResourceFailedException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Response;

class apiController extends Controller
{
    public function register(Request $request,$tmpcode=null)
    {


        $tmp_user = null;
        if(empty($tmpcode)) {
            $validator = Validator::make($request->all(),
                [
                    'first_name' => 'required',
                    'last_name' => 'required',
                    'email' => 'required|unique:users',
                    'terms_and_conditions' => 'required',
                    'phone_number' => ['nullable', 'numeric', 'unique:users',],
                    'password' => ['required', 'string', 'min:8', 'confirmed'],

                    'business_name' => 'required|string|max:255',
                    'business_location' => 'required|string|max:255',
                    'business_type' => 'required|string|max:255',
                    'currency' => 'exists:currencies,code',
                    'reg_no' => 'required',
                    'tax_no' => 'required',
                    'vat_no' => 'required',
                ]
            );

            $data = $request->all();

            if ($validator->fails())
                return response()->json(['status_code' => 401, 'message' => $validator->errors()]);


            if ($data['terms_and_conditions'] !== 'true')
                return response()->json(['status_code' => 402, 'message' => ['terms_and_conditions' => 'You must accept the Terms and Conditions']]);


            $data['currency_id'] = Currency::query()->where('code', $data['currency'])->first()->id;
            $data['raw_password'] = $data['password'];
            $data['password'] = Hash::make($data['password']);


            try {

                DB::beginTransaction();
                $user = User::query()->create($data);
                $data['type'] = 'manager';

                $business['name'] = $data['business_name'];
                $business['currency_id'] = $data['currency_id'];
                $business['location'] = $data['business_location'];
                $business['type'] = $data['business_type'];
                $business['owner_id'] = $user->id;
                Business::query()->create($business);


                $res = Subscription::query()->create(
                    ['status' => 'owing', 'user_id' => $user->id]
                );

                $user->update(['subscription_id' => $res->id]);

                DB::commit();

            } catch (\Exception $exception) {
                return response()->json(['status_code' => 403, 'message' => ['error' => 'Registration failed']]);
            }


            $data['full_name'] = $user->full_name;

            Mail::send("emails.new_subscriber", $data, function ($mail) use ($data) {
                $mail->subject("MTN Business Manager Registration")
                    ->to($data['email']);
            });

            Mail::send("emails.new_subscriber2", $data, function ($mail) use ($data) {
                $mail->subject("MTN Business Manager Registration")
                    ->to($data['email']);
            });

            return response()->json(['status_code' => 200, 'message' => 'registration successful']);
        }
        else
        {
                $route = route('register.company.tmp',$tmpcode);
                $tmp_user = TmpRegistration::query()
                    ->where('tmp_url',$route)->first();

                if(empty($tmp_user))
                    return  abort(401);


                return  view('auth.register',compact('tmp_user'));
        }



    }

    public function tmp_register(Request $request)
    {
        $data = $request->all();

        $validator = Validator::make($data,
            [
                'mobile_money_number' => 'required|unique:tmp_registrations|digits_between:10,12',
                'first_name' => 'required',
                'last_name' => 'required',
                'phone_number' => 'required|unique:tmp_registrations|digits_between:10,12'
            ]
        );


        if ($validator->fails())
        {
            return response()
                ->json(['code' => 405, 'status'=>'failed','msg' => $validator->errors()->all()]);
        }

        $inputs = $validator->getData();
        DB::beginTransaction();
        $tmp = TmpRegistration::query()->create($inputs);
        $tmp->url();
        DB::commit();
        return response()
            ->json(['code'=>200, 'status'=>'success', 'msg'=>'account successfully registered','url'=>$tmp->tmp_url]);
    }


    public function login(Request $request)
    {
        $credentials = request(['email', 'password']);

        if (!$token = auth('api')->attempt($credentials)) {
            return  response()->json(['status_code'=>406,'message'=>'Invalid Credentials']);
        }

        $user = auth('api')->user();
        $transform = new BusinessTransformer();
        $business = [];
        if (strtolower($user->type) == "manager")
            $business = $transform->transformCollection(Business::where('owner_id', $user->id)->get());
        if (strtolower($user->type) == "employee")
            $business = [$transform->transform(Employee::where('user_id', $user->id)->first()->business)];

        $sub_status = $user->subscriptions()->where('is_active',true)->first();
        $sub_status = $sub_status && $sub_status->is_active;

        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL(),
            "message" => "Login successful",
            "status_code" => 200,
            "momo_number" => $user->mobile_money_number,
            "id" => $user->id_hash,
            "type" => $user->type,
            "sub_status" => $sub_status,
            "businesses" => $business,
        ]);
    }

    public function subscription_list(Request $request)
    {
        $plans  =  SubscriptionPlan::query()->get();
        return response()->json($plans);
    }

    public function subscriptionPayment(Request $request)
    {
        $priceId = $request->input('id');
        $idHash = $request->input('userId');
        $momoNumber = $request->input('momoNumber');
        $user = User::query()->where('id_hash',$idHash)->first();
        $plan = SubscriptionPlan::query()->find($priceId);
        $transactionId = $momoNumber.Str::random('20');



        DB::beginTransaction();

        if(!empty($user->subscription))
        {
            $res = Subscription::query()->create([
                'status' => 'owing',
                'user_id' => $user->id,
                'is_first_time' => true,
                'plan_id' => $plan->id,
            ]);

            $user->update(['subscription_id' => $res->id]);
        }



         MobileMoneyTransaction::query()->create(
             [
                "phone_number" => $momoNumber,
                "amount" => $plan->price,
                'subscription_id' => $user->subscription->id ?? null,
                'business_id' => $user->businesses()->first()->id ?? null,
                "vendor" => "MTN",
                "message" => "MTN Business Manager subscription payment",
                "transaction_id" => $transactionId,
             ]
         );




        $paymentEndpoint = "https://pay.npontu.com/api/pay";
        $callbackResponseUrl = route('subscription.cbk');


        $user_id = 'mtnmessenger';
        $password = 'mtnmessenger';

        $data = [
            'number' => $momoNumber,
            'vendor' => 'mtn',
            'uid'  => $user_id,
            'pass' => $password,
            'tp'   => $transactionId,
            'cbk'  => $callbackResponseUrl,
            'amt'  => $plan->price,
            "description" => "BUSINESSMANAGER PAYMENT",
            'msg'  => 'Business Manager Payment',
            'trans_type' => 'Debit'
        ];

        $this->appLog('BUSINESS-MANAGER PAY REQUEST step 1 '.json_encode($data));
        $result = $this->makePayment($data, $paymentEndpoint);
        DB::commit();

        if ($result->status == 'success') {
            return response()->json(['status_code'=>200,'message'=>'Payment initiated check your wallet to approve the transaction']);
        }
        return response()->json(['status_code'=>407,'message'=>'Payment failed kindly try again']);
    }

    public function appLog($message)
    {
        $now = Carbon::parse(now());
        file_put_contents(storage_path() . '/logs/momo_log.log', "\n" . $now . ' || ' . $message . PHP_EOL, FILE_APPEND);
    }



    private function makePayment(array $data, $endpoint)
    {

        $ch = curl_init($endpoint);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $output = json_decode(curl_exec($ch));

        //if output is null because of an error, return a custom object with status failed
        if (is_null($output)):
            $this->appLog('BUSINESS-MANAGER PAY REQUEST step 2 '.json_encode($output));
            return (object)['status' => 'failed', 'message' => 'Failed'];
        endif;

        //Response for mobile money is either an object or an array of object
        //If its an array, then get the first element of object and return it
        $this->appLog('OUTPUT PAYMENT '.json_encode($output));
        return is_object($output) ? $output : $output[0];
    }


    public function subscription_cbk(Request $request)
    {
        $this->appLog('BUSINESS-MANAGER PAY REQUEST step 3 '.json_encode($request->all()));

        try {
            $transactionId = $request->input('transaction_id');
            $message = $request->input('responseMessage');
            $status = $request->input('status');

            $momo = MobileMoneyTransaction::query()->where('transaction_id', $transactionId)->first();
            DB::beginTransaction();

            $momo->update(
                [
                    'response_status' => $status,
                    'response_message' => $message,
                ]
            );

            if (strtolower($status) == 'success') {
                $now = now();
                $momo->subscription->payments()->create([
                    'amount' => $momo->amount,
                    'payment_date' => $now,
                    'mobile_money_number' => $momo->phone_number,
                    'subscription_id' => $momo->subscription->id,
                    'user_id' => $momo->subscription->user_id,
                ]);

                $expiry_date = $now;

                if (!is_null(@$momo->subscription->renewal_period->months)) {
                    $expiry_date = $now->addMonths($momo->subscription->renewal_period->months);
                } else {
                    $expiry_date = $now->addDays(30);
                }
                if ($momo->subscription->is_first_time) {
                    $expiry_date->addDays(30);
                }


                $momo->subscription->update([
                    'last_payment_date' => $expiry_date,
                    'expiry_date' => $expiry_date,
                    'status' => 'paid',
                    'is_active' => true,
                    'is_first_time' => false
                ]);
                $momo->subscription->user->update([
                    'subscription_id' => $momo->subscription->id,
                ]);
                $previousPlan = $momo->subscription->previousPlan;
                if (empty($previousPlan)) {
                    $momo->subscription->previousPlan->update([
                        'is_active' => false
                    ]);
                }
            }

            DB::commit();
        }catch (\Exception $ex)
        {$this->appLog($ex->getMessage());}


    }


    public function checkPayment(Request $request)
    {
        sleep(5);
        $hash = $request->input('userId');
        $user = User::query()->where('id_hash',$hash)->first();

        $subscription = $user->subscription;

        if ($subscription != null && !($subscription->expiry_date < today() || $subscription->expiry_date == null)) {
            $code = 200;
        }
        else {
            $code = 408;
        }
        return response()->json(['code'=>$code]);
    }


    public function all(Request $request) {
        $business_id = $request->input('business_id');
        $business = Business::query()->where('id_hash',$business_id)->first();
        $res = Category::query()->where('business_id',$business->id)->get();

        return response()->json(['status_code'=>200,'message'=>'ok','data'=>$res]);
    }

    public function getExpiry(Request $request)
    {
        $data = $request->all();

        $validator = Validator::make($data,
            [
                'phone_number' =>'required',
            ]
        );

        if($validator->fails())
            return  $this->validationError($validator->errors()->all());

        if(!$this->lookUp($request)){
            return  $this->unAuthorisedAccess('You are not authorized to access this resource');
        }

        $requestIP = $request->ip();


        $phone = $request->input('phone_number');
        $phone_number = User::query()->where('phone_number',$phone)->first();


        if (empty($phone_number)) {
            return   $this->infoNotFound('User not found');
        }
        else{
            $subscription_id=$phone_number->subscription_id;
            $subscriptionDetails=Subscription::query()->where('id',$subscription_id)->first();
            if (empty($subscriptionDetails)) {


                $phone_number->ip = $requestIP;
                $message = ucwords("Expiry date queried for phone number: $phone ,  expiry date:  Subscription details not found");
                $this->audit($phone_number,$message);
                return   $this->infoNotFound('Subscription details not found');

            }
            else{

                $expiry_date = $subscriptionDetails->expiry_date;
                $phone_number->ip = $requestIP;
                $message = ucwords("Expiry date queried for phone number: $phone ,  expiry date: $expiry_date ");
                $this->audit($phone_number,$message);
                return  $subscriptionDetails->status == 'owing' ?
                    $this->infoNotFound('Subscription details not found')   :
                    $this->successResponse($expiry_date);


            }
        }
    }

    public function setExpiry(Request $request)
    {
        $data = $request->all();


        $validator = Validator::make($data,
            [
                'phone_number' =>'required',
                'month_count' =>'required',
            ]
        );

        if($validator->fails())
            return  $this->validationError($validator->errors()->all());

        if(!$this->lookUp($request)){
            return  $this->unAuthorisedAccess('You are not authorized to access this resource');
        }

        $requestIP = $request->ip();

        $phone      = $request->input('phone_number');
        $monthCount = $request->input('month_count');

        if (!is_numeric($phone)){
            return $this->invalidParameter('Invalid phone number');
        }

        if (!is_numeric($monthCount)){
            return $this->invalidParameter('month_count is not numeric');
        }

        $phone_number = User::query()->where('phone_number',$phone)->first();

        if (empty($phone_number)) {

            return $this->infoNotFound('User not found');
        }
        else{

            $subscription_id = $phone_number->subscription_id;
            $subscriptionDetails = Subscription::query()->find($subscription_id);
            $current_expiry_date = $subscriptionDetails->expiry_date;

            if ($current_expiry_date > now()){
                $expiry_date = $current_expiry_date->addMonths($monthCount);
            }
            else{
                $expiry_date = now()->addMonths($monthCount);
            }

            if (empty($subscriptionDetails)) {


                $phone_number->ip = $requestIP;
                $message = ucwords("Expiry date update for phone number: $phone ,  month count: $monthCount , response: Subscription details not found");
                $this->audit($phone_number,$message);

                return $this->infoNotFound('Subscription details not found');

            }

            else{

                $subscriptionDetails->status = 'paid';
                $subscriptionDetails->is_active = true;
                $subscriptionDetails->is_first_time =false;
                $subscriptionDetails->expiry_date = $expiry_date;
                $subscriptionDetails->last_payment_date = now();
                $subscriptionDetails->save();


                $phone_number->ip = $requestIP;
                $message =  ucwords("Expiry date update for phone number: $phone , month count: $monthCount , response: Subscription renewed to $expiry_date");
                $this->audit($phone_number,$message);

                return $this->successResponse( "Subscription renewed to $expiry_date");
            }
        }
    }

    public function subscribeUser(Request  $request)
    {

        $data = $request->all();
        $validator = Validator::make($data,
            [
                'plan_id' =>'required',
                'phone_number' =>'required',
            ]
        );

        if($validator->fails())
            return  $this->validationError($validator->errors()->all());

        if(!$this->lookUp($request)){
            return  $this->unAuthorisedAccess('You are not authorized to access this resource');
        }

        $user = User::query()->where('phone_number',$request->input('phone_number'))->first();

        if(empty($user))
            return  $this->infoNotFound('User Not Found');


        $plan = SubscriptionPlan::query()->find($request->input('plan_id'))->first();

        if(empty($plan))
            return  $this->infoNotFound("Plan with {$request->input('plan_id')} Not Found");


        if (!isset($user->subscription)) {
            $user->subscriptions()->create([
                'plan_id' => $plan->id,
                'status' => 'paid',
                'is_active' => true,
                'is_first_time' => false,
                'expiry_date'   => now()->endOfMonth(),
                'last_payment_date' => now(),
            ]);

            return  $this->successResponse("User successfully subscribed to  {$plan->name} package");
        }
        else
        {
            return  $this->packageExist("User already subscribed to {$user->subscription->plan->name} package");
        }
    }

    public function getSubscription(Request  $request)
    {

            $data = $request->all();

            if(!$this->lookUp($request)){
               return  $this->unAuthorisedAccess('You are not authorized to access this resource');
            }

        $plans  =  SubscriptionPlan::query()->get(['id','price','name','maximum_employees']);
        return $this->successResponse($plans);
    }







    public function audit($model,$message)
    {
        AuditTrail::query()->create([
            'user_id' => $model->id,
            'email' => $model->email,
            'name' => $model->ip,
            'date' => Carbon::now()->toDateTimeString(),
            'activity' => $message
        ]);
    }

    public function lookUp($request)
    {
        $data = $request->all();
        $requestIP = request()->ip();


        $this->appLog('LOGGING IP => '  .$requestIP.' BODY => '.json_encode($data));


        $app_user = $request->header('app_user');
        $app_user_token = $request->header('app_user_token');

        if(empty($app_user) || empty($app_user_token))
            return false;


        $authorizer = WhitelistedIPs::query()->where('ip',$requestIP)
            ->where('app_user',$app_user)
            ->first();

        if (!empty($authorizer)){

            $token =  $encrypted = hash_hmac('sha256', $authorizer->client_key, $authorizer->client_secrete);
            if($app_user_token !== $token)
                return  false;
        }else
        {
            return  false;
        }

        return true;

    }



    public function successResponse($message)
    {
        return response()->json(['code' => 200, 'status' => 'success', 'msg' => $message]);
    }

    public function infoNotFound($message = null)
    {
        return response()->json(['code' => 204, 'status' => 'failed', 'msg' => $message ?? "No Records found"]);
    }

    public function failureResponse($message)
    {
        return response()->json(['code' => 206, 'status' => 'failed', 'msg' => $message]);
    }

    public function invalidParameter($message)
    {
        return response()->json(['code' => 207, 'status' => 'failed', 'msg' => $message]);
    }

    public function packageExist($message = null)
    {
        return response()->json(['code' => 304, 'status' => 'failed', 'msg' => $message]);
    }

    public function validationError($message = null)
    {
        return response()->json(['code' => 401, 'status' => 'failed', 'msg' => $message]);

    }

    public function unAuthorisedAccess($message)
    {
        return response()->json(['code' => 403, 'status' => 'failed', 'msg' => $message]);
    }


    public function invalidResponse($message)
    {
        return response()->json(['code' => 507, 'status' => 'failed', 'msg' => $message]);
    }

}
