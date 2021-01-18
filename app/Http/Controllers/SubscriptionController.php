<?php

namespace App\Http\Controllers;

use App\DataTables\SubscriptionPaymentsDataTable;
use App\Models\MobileMoneyTransaction;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

// TODO!: move to namespace to Subscription
class SubscriptionController extends Controller
{
    public function index(SubscriptionPaymentsDataTable $table)
    {
        $subscription = auth()->user()->subscriptions()->latest()->first();
        if (empty($subscription->plan_id)) {
            Session::flash('alert-danger', 'You have not subscribed to any plan yet. Kindly subscribe to a plan.');

            return redirect()->route('subscription.plan.index');
        }

        return $table->render('subscription.index', [
            "page" => (object) [
                'title' => "Subscription Payments", 'section' => 'Subscription Payments'
            ],
            "amount" => $subscription->plan->price
        ]);
    }

    public function create(Request $request)
    {
        if ("POST" == request()->method()) {
            $this->validate($request, [
                'momo_number' => 'required|string|max:20',
            ]);

            $inputs = $request->all();
            $inputs['business_id'] = session('business_id');
            $subscription = auth()->user()->subscriptions()->latest()->first();

            $momo = MobileMoneyTransaction::create([
                "phone_number" => $inputs['momo_number'],
                "amount" => $subscription->plan->price,
                'subscription_id' => $subscription->id,
                'business_id' => session('business_id'),
                "vendor" => "MTN",
                "message" => "MTN Business Manager subscription payment",
            ]);
            $this->initiatePayment($momo);

            auth()->user()->log("initiated subscription payment" . $this->business()->name);

            $url = "<a href='" . route('subscription.payment.index') . "'>Refresh page</a>";
            Session::flash('alert-success', "Kindly wait for the payment prompt in order to approve payment for the subscription package selected. $url after payment is made to confirm status of payment.");
            return redirect()->route('subscription.payment.index');
        }
    }

    //TODO!: refactor to accept $inputs as payment details

    /**
     * Initiate mobile money payment using npontu MOMO api
     *
     * @param MobileMoneyTransaction $transaction
     * @return void
     */
    public static function initiatePayment(MobileMoneyTransaction $transaction)
    {
        try {
            // create new mobile money transaction record
            $transaction->update([
                "transaction_id" => Str::random(11),
                "transaction_type" => "Debit",
            ]);

            $paymentEndpoint =
                "https://pay.npontu.com/api/pay";
            $callbackResponseUrl = config('app.url') . "/api/v1/payments/subscriptions/callback";

            $request = [
                "msg" => "{$transaction->message}",
                "number" => "{$transaction->phone_number}",
                "vendor" => "{$transaction->vendor}",
                "trans_type" => "{$transaction->transaction_type}",
                "tp" => "{$transaction->transaction_id}",
                "amt" => "{$transaction->amount}",
                "uid" => "mtnmessenger",
                "pass" => "mtnmessenger",
                "description" => "BUSINESSMANAGER PAYMENT",
                "cbk" => $callbackResponseUrl,
            ];

            $ch = curl_init($paymentEndpoint);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $request);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

            $response = json_decode(curl_exec($ch));
            logger(json_encode($response));
            $transaction->save();
            // dd($response);
        } catch (Exception $e) {
            logger()->error($e->getTraceAsString());
        }
    }

    /**
     * Handles Mobile Money payment api callback after initializing
     * a payment.
     * Updates the Mobile Money Transaction record with api response data
     *
     * @param Request $request
     * @return void
     */
    public function momoCallback(Request $request)
    {
        file_put_contents(storage_path() . '/logs/momo_transactions.log', "\n" . 'INFO: ' . now() . ' || ' . "Callback executed" . PHP_EOL, FILE_APPEND);
        try {
            $inputs = $request->all();
            DB::transaction(function () use ($inputs) {
                $tranx = MobileMoneyTransaction::where('transaction_id', '=', $inputs['transaction_id'])->first();

                $tranx->update([
                    'response_status' => $inputs['status'],
                    'response_message' => $inputs['responseMessage'],
                ]);

                if (strtolower($inputs['status']) == 'success') {
                    $now = now();
                    $tranx->subscription->payments()->create([
                        'amount' => $tranx->amount,
                        'payment_date' => $now,
                        'mobile_money_number' => $tranx->phone_number,
                        'subscription_id' => $tranx->subscription->id,
                        'user_id' => $tranx->subscription->user_id,
                    ]);

                    $expiry_date = $now;
                    if (!is_null(@$tranx->subscription->renewal_period->months)) {
                        $expiry_date = $now->addMonths($tranx->subscription->renewal_period->months);
                    } else {
                        $expiry_date = $now->addDays(30);
                    }
                    if($tranx->subscription->is_first_time){
                        $expiry_date->addDays(30);
                    }

                    $tranx->subscription->update([
                        'last_payment_date' => $expiry_date,
                        'expiry_date' => $expiry_date,
                        'status' => 'paid',
                        'is_active' => true,
                        'is_first_time' => false
                    ]);
                    $tranx->subscription->user->update([
                        'subscription_id' => $tranx->subscription->id,
                    ]);
                    $previousPlan = $tranx->subscription->previousPlan;
                    if (isset($previousPlan)) {
                        $tranx->subscription->previousPlan->update([
                            'is_active' => false
                        ]);
                    }
                }
                $this->log($inputs['transaction_id'] . '||' . $inputs['status'] . "||" . $inputs['responseMessage']);
            });

            return ['status' => $inputs['responseMessage']];
        } catch (Exception $ex) {
            $message = $ex->getMessage() . "\t" . $ex->getLine() . "\n\n" . $ex->getTraceAsString();
            $this->log($message);
        }
    }

    /**
     * A simple logger for logging mobile money api responses
     *
     * @param string $message
     * @return void
     */
    public function log($message)
    {
        $now = Carbon::parse(now());
        file_put_contents(storage_path() . '/logs/momo_transactions.log', "\n" . 'INFO: ' . $now . ' || ' . $message . PHP_EOL, FILE_APPEND);
    }
}
