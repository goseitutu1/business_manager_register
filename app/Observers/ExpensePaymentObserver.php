<?php

namespace App\Observers;

use App\Models\ExpensePayment;
use App\Api\Helpers\HashIdHelper;

class ExpensePaymentObserver
{
    /**
     * Handle the expense payment "creating" event.
     *
     * @param  \App\Models\ExpensePayment  $payment
     * @return void
     */
    public function creating(ExpensePayment $payment)
    {
        $payment->id_hash = HashIdHelper::generateId();
        $payment->code = "EXP-PYMT" . sprintf('%06d', ExpensePayment::count() + 1);
        if (!isset($payment->payment_date))
            $payment->payment_date = now()->toDateString();
    }

    /**
     * Handle the expense payment "created" event.
     *
     * @param  \App\Models\ExpensePayment  $payment
     * @return void
     */
    public function created(ExpensePayment $payment)
    {
        $expense = $payment->expense;

        // update the main expense totals
        $expense->decrement('amount_remaining', $payment->amount_paid);
        $expense->increment('amount_paid', $payment->amount_paid);

        //if the total amount remaining reaches zero, set expense as paid
        if ($expense->amount_remaining <= 0)
            $expense->update(['type' => 'paid']);
    }

    /**
     * Handle the expense payment "updating" event.
     *
     * @param  \App\Models\ExpensePayment  $payment
     * @return void
     */
    public function updating(ExpensePayment $new_payment)
    {
        $old_payment = ExpensePayment::find($new_payment->id);

        $diff = $old_payment->amount_paid - $new_payment->amount_paid;

        // new payment is greater than old payment
        if($diff < 0){
            $new_payment->expense->decrement('amount_remaining', abs($diff));
            $new_payment->expense->increment('amount_paid', abs($diff));
        }
        // old is greater than new payment
        if($diff > 0){
            $new_payment->expense->increment('amount_remaining', abs($diff));
            $new_payment->expense->decrement('amount_paid', abs($diff));
        }
    }

    /**
     * Handle the expense payment "deleted" event.
     *
     * @param  \App\Models\ExpensePayment  $payment
     * @return void
     */
    public function deleted(ExpensePayment $payment)
    {
        $expense = $payment->expense;

        // restore main expense totals back to the previous values
        $expense->increment('amount_remaining', $payment->amount_paid);
        $expense->decrement('amount_paid', $payment->amount_paid);

        //if the total amount remaining reaches zero, set expense as paid
        if ($expense->amount_remaining > 0)
            $expense->update(['type' => 'owing']);
    }

    /**
     * Handle the expense payment "restored" event.
     *
     * @param  \App\Models\ExpensePayment  $payment
     * @return void
     */
    public function restored(ExpensePayment $payment)
    {
        $expense = $payment->expense;

        // update the main expense totals
        $expense->decrement('amount_remaining', $payment->amount_paid);
        $expense->increment('amount_paid', $payment->amount_paid);

        //if the total amount remaining reaches zero, set expense as paid
        if ($expense->amount_remaining == 0)
            $expense->update(['type' => 'paid']);
    }

    /**
     * Handle the expense payment "force deleted" event.
     *
     * @param  \App\Models\ExpensePayment  $payment
     * @return void
     */
    public function forceDeleted(ExpensePayment $payment)
    {
        $expense = $payment->expense;

        // restore main expense totals back to the previous values
        $expense->increment('amount_remaining', $payment->amount_paid);
        $expense->decrement('amount_paid', $payment->amount_paid);

        //if the total amount remaining reaches zero, set expense as paid
        if ($expense->amount_remaining > 0)
            $expense->update(['type' => 'owing']);
    }
}
