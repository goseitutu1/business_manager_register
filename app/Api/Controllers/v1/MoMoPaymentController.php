<?php

namespace App\Api\Controllers\v1;

use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Api\Controllers\BaseController;
use App\Models\MobileMoneyTransaction;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Log;

class MoMoPaymentController extends BaseController
{
    //TODO!: refactor to accept $inputs as payment details
    /**
     * Initiate mobile money payment using npontu MOMO api
     *
     * @param Request $request
     * @deprecated 0.1
     * @return void
     */
    public static function initiatePayment(Payment $payment, $amount = null)
    {
        try {
            // create new mobile money transaction record
            $transaction  = new MobileMoneyTransaction([
                "phone_number" => $payment->phone_number,
                "vendor" => "MTN",
                "transaction_id" => Str::random(11),
                "transaction_type" => "Debit",
                "message" => "MTN Business Manager",
                "amount" => $amount != null ? $amount : $payment->amount_paid,
                'payment_id' => $payment->id,
                'business_id' => $payment->business_id
            ]);

            $paymentEndpoint =
                "https://pay.npontu.com/api/pay";
            $callbackResponseUrl = config('app.url') . "/api/v1/payments/momo/callback";

            $request = array(
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
            );

            $ch = curl_init($paymentEndpoint);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $request);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

            $response = json_decode(curl_exec($ch));

            $transaction->save();
        } catch (Exception $e) {
            Log::error($e->getTraceAsString());
        }
    }

    //TODO!: refactor to accept $inputs as payment details
    /**
     * Initiate mobile money payment using npontu MOMO api
     *
     * @param Request $request
     * @return void
     */
    public static function initiatePaymentNew(MobileMoneyTransaction $transaction, string $callback)
    {
        try {
            // create new mobile money transaction record
            $transaction->update([
                "transaction_id" => Str::random(11),
                "transaction_type" => "Debit",
            ]);

            $paymentEndpoint =
                "https://pay.npontu.com/api/pay";
            $callbackResponseUrl = config('app.url') . $callback;

            $request = array(
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
            );

            $ch = curl_init($paymentEndpoint);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $request);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

            $response = json_decode(curl_exec($ch));
            logger(json_encode($response));
            $transaction->save();
        } catch (Exception $e) {
            logger()->error($e->getTraceAsString());
            $this->log($e->getTraceAsString());
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
        try {

            $inputs = $request->all();
            $tranx = MobileMoneyTransaction::where('transaction_id', $request->transaction_id)
                ->update([
                    'response_status' => $inputs['status'],
                    'response_message' => $inputs['responseMessage'],
                ]);

            if (strtolower($inputs['status']) == 'failed') {
                $tranx->sales_payment->update(['status' => 'owing']);
            }

            $this->log($inputs['transaction_id'] . '||' . $inputs['status']);

            return ['status' => $inputs['responseMessage']];
        } catch (Exception $ex) {
            $this->log($ex->getMessage());
        }
    }

    /**
     * A simple logger for logging mobile money api responses
     *
     * @param [type] $message
     * @return void
     */
    public function log($message)
    {
        $now = Carbon::parse(now());
        file_put_contents(storage_path() . '/logs/momo_transactions.log', "\n" . 'INFO: ' . $now . ' || ' . $message . PHP_EOL, FILE_APPEND);
    }
}
