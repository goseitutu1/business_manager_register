<?php

namespace App\Observers;

use App\Api\Helpers\HashIdHelper;
use App\Models\Expense;
use App\Models\GLAccount;
use App\Models\Journal;
use App\Tools\JournalTool;
use Carbon\Carbon;

class ExpenseObserver
{
    /**
     * Handle the expense "created" event.
     *
     * @param Expense $expense
     * @return void
     */
    public function creating(Expense $expense)
    {
        if (isset($expense->payment_date)) {
            $expense->payment_date = Carbon::parse($expense->payment_date)->toDateString();
        }
        if (isset($expense->due_date)) {
            $expense->due_date = Carbon::parse($expense->due_date)->toDateString();
        }

        $expense->expense_no = "EXP" . sprintf('%06d', Expense::count() + 1);
        $expense->id_hash = HashIdHelper::generateId();

        $journal = Journal::create([
            'transaction_date' => Carbon::now(),
            'description' => 'Journal Entry for expense: ' . $expense->expense_no,
            'batch_no' => $expense->expense_no,
            'debit_total' => 0,
            'credit_total' => 0,
            'business_id' => $expense->business_id
        ]);
        $expense->journal_id = $journal->id;

        //TODO: implement for paid owing and partial
        if ($expense->type == "paid") {
//            $acc = GLAccount::where('name', 'like', '%'.$expense->category->name.'%')->first();
//            dd($expense->category->name,$acc);
            JournalTool::debitAndCreditEntries($journal, [
                'debit_account_id' => GLAccount::where('name', 'like', '%'.$expense->category->name.'%')->first()->id,
                'debit_amount' => $expense->amount_paid,
                'debit_comment' => "Entry for paid expense: {$expense->expense_no}",
                'credit_account_id' => GLAccount::where('name', 'like', 'Bank')->first()->id,
                'credit_amount' => $expense->amount_paid,
                'credit_comment' => "Bank Entry for expense payment: {$expense->expense_no}",
            ]);
            $journal->increment('credit_total', $expense->amount_paid);
            $journal->increment('debit_total', $expense->amount_paid);
        }
        if ($expense->type == "owing") {
            JournalTool::debitAndCreditEntries($journal, [
                'debit_account_id' => GLAccount::where('name', 'like', $expense->category->name)->first()->id,
                'debit_amount' => $expense->amount_remaining,
                'debit_comment' => "Entry for owing expense: {$expense->expense_no}",
                'credit_account_id' => GLAccount::where('name', 'like', 'creditors')->first()->id,
                'credit_amount' => $expense->amount_remaining,
                'credit_comment' => "Bank Entry for owing expense: {$expense->expense_no}",
            ]);
            $journal->increment('credit_total', $expense->amount_remaining);
            $journal->increment('debit_total', $expense->amount_remaining);
        }
    }

    /**
     * Handle the expense "updated" event.
     *
     * @param Expense $expense
     * @return void
     */
    public function updating(Expense $expense)
    {
        if (isset($expense->payment_date)) {
            $expense->payment_date = Carbon::parse($expense->payment_date)->toDateString();
        }
        if (isset($expense->due_date)) {
            $expense->due_date = Carbon::parse($expense->due_date)->toDateString();
        }

        //TODO! Refactor & remove this since payment will be made in installment
        $old = Expense::find($expense->id);
        if ($old->type == "owing" && $expense->type == "paid") {
            JournalTool::debitAndCreditEntries($expense->journal, [
                'debit_account_id' => GLAccount::where('name', 'like', 'creditors')->first()->id,
                'debit_amount' => $expense->amount_paid,
                'debit_comment' => "Entry for paid owing expense: {$expense->expense_no}",
                'credit_account_id' => GLAccount::where('name', 'like', 'bank')->first()->id,
                'credit_amount' => $expense->amount_paid,
                'credit_comment' => "Bank Entry for paid owing expense: {$expense->expense_no}",
            ]);
            $expense->journal()->increment('credit_total', $expense->amount_paid);
            $expense->journal()->increment('debit_total', $expense->amount_paid);
        }
        //TODO: implement for changed expense category, amount paid & amount owed
    }

    /**
     * Handle the expense "deleted" event.
     *
     * @param Expense $expense
     * @return void
     */
    public function deleted(Expense $expense)
    {
        if (isset($expense->journal_id)) {
            $expense->journal->entries()->delete();
            @$expense->journal->delete();
        }
    }

    /**
     * Handle the expense "restored" event.
     *
     * @param Expense $expense
     * @return void
     */
    public function restored(Expense $expense)
    {
        //
    }

    /**
     * Handle the expense "force deleted" event.
     *
     * @param Expense $expense
     * @return void
     */
    public function forceDeleted(Expense $expense)
    {
        $expense->journal->entries()->forceDelete();
        $expense->journal->forceDelete();
    }
}
