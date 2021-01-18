<?php

namespace App\Observers;

use App\Api\Controllers\v1\MoMoPaymentController;
use App\Api\Helpers\HashIdHelper;
use App\Models\GLAccount;
use App\Models\Journal;
use App\Models\Payment;
use App\Tools\JournalTool;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;

class PaymentObserver
{
    /**
     * Handle the payment "creating" event.
     *
     * @param Payment $payment
     * @return void
     */
    public function creating(Payment $payment)
    {
        $payment->id_hash = HashIdHelper::generateId();

        //TODO: do payment calculation here instead
        $payment->payment_no = "PYMT" . sprintf('%06d', Payment::count() + 1);

        if (isset($payment->due_date)) {
            $payment->due_date = Carbon::parse($payment->due_date)->toDateString();
        }

        $journal = Journal::create([
            'transaction_date' => Carbon::now(),
            'description' => 'Journal Entry for payment: ' . $payment->payment_no,
            'batch_no' => $payment->payment_no,
            'debit_total' => 0,
            'credit_total' => 0,
            'business_id' => $payment->business_id
        ]);
        $payment->journal_id = $journal->id;

        //TODO: implement journal entries for discount  and taxes
        $payment->sales->items->each(function ($item) use (&$journal, $payment) {
            if (isset($item->product_id))
                $item->productJournalEntry($journal, $payment);
            if (isset($item->service_id))
                $item->serviceJournalEntry($journal, $payment);
        });
    }

    /**
     * Handle the payment "created" event.
     *
     * @param Payment $payment
     * @return void
     */
    public function created(Payment $payment)
    {

        try {

        $payment->sales()->update(['payment_id' => $payment->id]);

        // initiate mobile money payment
        if (!empty($payment->phone_number) && !empty($payment->amount_paid))
            MoMoPaymentController::initiatePayment($payment);

        $data = ['sales' => $payment->sales, 'business_owner' => $payment->business->owner];
        Mail::send("emails.new_sales", $data, function ($mail) use ($data) {
            $mail->subject("MTN Business Manager - New Sales")
                 ->to($data['business_owner']->email);
        });


        }catch (\Exception $ex){
            $this->appLog($ex->getMessage());
        }
    }


    public function appLog($message)
    {
        $now = Carbon::parse(now());
        file_put_contents(storage_path() . '/logs/momo_log.log', "\n" . $now . ' || ' . $message . PHP_EOL, FILE_APPEND);
    }

    /**
     * Handle the payment "updating" event.
     *
     * @param Payment $payment
     * @return void
     */
    public function updating(Payment $payment)
    {
        $old = Payment::find($payment->id);
        $journal = $payment->journal;

        if (isset($payment->due_date)) {
            $payment->due_date = Carbon::parse($payment->due_date)->toDateString();
        }

        if (strtolower($old->type) == "owing" && strtolower($payment->type) == "paid") {
            // first entries
            JournalTool::debitAndCreditEntries($journal, [
                'debit_account_id' => GLAccount::where('name', 'like', 'bank')->first()->id,
                'debit_amount' => $payment->amount_paid,
                'debit_comment' => "Bank Account entry for paid owing payment: {$payment->id}",
                'credit_account_id' => GLAccount::where('name', 'like', 'debtors')->first()->id,
                'credit_amount' => $payment->amount_paid,
                'credit_comment' => "Debtors Entry for paid owing payment: {$payment->id}",
            ]);
        }

        // initiate mobile money payment if the amount paid has increased
        $diff = ($payment->amount_paid ?? 0) - ($old->amount_paid ?? 0);
        if (!empty($payment->phone_number) && !empty($payment->amount_paid) && $diff > 0) {
            MoMoPaymentController::initiatePayment($payment, $diff);
        }

        // make journal entries for all sales/cart items
        //TODO: implement journal entries for discount  and taxes
        //        if (!empty($payment->shopping_cart_id)) {
        //            $payment->shopping_cart->items->each(function ($item) use (&$journal, $payment) {
        //                if (isset($item->product_id))
        //                    $item->product->updateSalesJournalEntry($journal, $old, $payment);
        //                if (isset($item->service_id))
        //                    $item->service->salesJournalEntry($journal, $payment);
        //            });
        //        }
    }

    /**
     * Handle the payment "updated" event.
     *
     * @param Payment $payment
     * @return void
     */
    public function updated(Payment $payment)
    {
        //
    }

    /**
     * Handle the payment "deleted" event.
     * Deletes journals and all journal entries associated with this payment object
     *
     * @param Payment $payment
     * @return void
     */
    public function deleted(Payment $payment)
    {
        $payment->journal->entries()->delete();
        $payment->journal->delete();
    }

    /**
     * Handle the payment "restored" event.
     *
     * @param Payment $payment
     * @return void
     */
    public function restored(Payment $payment)
    {
        //
    }

    /**
     * Handle the payment "force deleted" event.
     * force delete journal and all journal entries associated with this payment object
     *
     * @param Payment $payment
     * @return void
     */
    public function forceDeleted(Payment $payment)
    {
        $payment->journal->entries()->forceDelete();
        $payment->journal->forceDelete();
    }
}
