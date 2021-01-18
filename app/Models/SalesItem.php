<?php

namespace App\Models;

use App\Api\Helpers\HashIdHelper;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Tools\JournalTool;

class SalesItem extends Model
{
    use SoftDeletes;

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->id_hash = HashIdHelper::generateId();
        });
    }

    protected $fillable = [
        'id_hash', 'is_taxed', 'discount_type', 'discount_amount',
        'total', 'type', 'tax_id',  'business_id', 'sales_id',
        // for product item
        'quantity', 'unit_price', 'tax_amount', 'product_id',
        // for service item
        'amount', 'service_id',

    ];

    protected $table = 'sales_items';

    protected $dates = ['created_at', 'updated_at'];

    public function getNameAttribute()
    {
        if ($this->product_id != null) {
            return $this->product->name;
        }
        if ($this->service_id != null) {
            return $this->service->name;
        }
        return null;
    }

    public function getItemPriceAttribute()
    {
        if ($this->product_id != null) {
            return $this->unit_price * $this->quantity;
        }
        if ($this->service_id != null) {
            return $this->amount;
        }
        return null;
    }

    public function product()
    {
        return $this->belongsTo('App\Models\Product', 'product_id');
    }

    public function service()
    {
        return $this->belongsTo('App\Models\Service', 'service_id');
    }

    public function sales()
    {
        return $this->belongsTo('App\Models\Sales', 'sales_id');
    }

    public function business()
    {
        return $this->belongsTo('App\Models\Sales', 'business_id');
    }

    public function tax()
    {
        return $this->belongsTo('App\Models\Tax', 'tax_id');
    }

    /**
     * Create journal entries for product sales. Following are the entries;
     * Paid Sales:
     *      1: DR Bank Account & CR Product Sales Account with selling price
     *      2: DR Cost of Sales Product & CR Stock Account with cost price
     * Credit Sales:
     *      1: DR Debtors Account & CR Product Sales with selling price
     *      2: DR Cost of Sales Product & CR Stock with cost price
     * Paid Credit Sales (update):
     *      1: DR Bank Account & CR Debtors Account with amount paid
     *
     * @param Journal $journal
     * @param Payment $payment
     * @param bool $update
     */
    public function productJournalEntry(Journal $journal, Payment $payment, $update = false)
    {
        //TODO: implement for payment changes from old to paid
        if (!$update) {
            $selling_price = $this->product->selling_price;
            $cost_price = $this->product->cost_price;

            // create journal entries for cash sales
            if (strtolower($payment->type) == "paid") {
                // first entries
                JournalTool::debitAndCreditEntries($journal, [
                    'debit_account_id' => GLAccount::where('name', 'like', 'bank')->first()->id,
                    'debit_amount' => $selling_price,
                    'debit_comment' => "Bank Account entry for product sales",
                    'credit_account_id' => GLAccount::where('name', 'like', 'Sales Product')->first()->id,
                    'credit_amount' => $selling_price,
                    'credit_comment' => "Sales Product Entry for product: {$this->product->name}",
                ]);
                // second entries
                JournalTool::debitAndCreditEntries($journal, [
                    'debit_account_id' => GLAccount::where('name', 'like', 'Cost of Sales Products')->first()->id,
                    'debit_amount' => $cost_price,
                    'debit_comment' => "Cost of Sales Products entry for product sales",
                    'credit_account_id' => GLAccount::where('name', 'like', 'Stock')->first()->id,
                    'credit_amount' => $cost_price,
                    'credit_comment' => "Stock Entry for product: {$this->product->name}",
                ]);

                // update main journal entry debit & credit totals
                $journal->increment('debit_total', $cost_price + $selling_price);
                $journal->increment('credit_total', $cost_price + $selling_price);
            }
            if (strtolower($payment->type) == "owing") {
                // first entries
                JournalTool::debitAndCreditEntries($journal, [
                    'debit_account_id' => GLAccount::where('name', 'like', 'debtors')->first()->id,
                    'debit_amount' => $selling_price,
                    'debit_comment' => "Debtors Account entry for product credit sales",
                    'credit_account_id' => GLAccount::where('name', 'like', 'Sales Product')->first()->id,
                    'credit_amount' => $selling_price,
                    'credit_comment' => "Sales Product Entry for product: {$this->product->name}",
                ]);
                // second entries
                JournalTool::debitAndCreditEntries($journal, [
                    'debit_account_id' => GLAccount::where('name', 'like', 'Cost of Sales Products')->first()->id,
                    'debit_amount' => $cost_price,
                    'debit_comment' => "Cost of Sales Products entry for product credit sales",
                    'credit_account_id' => GLAccount::where('name', 'like', 'Stock')->first()->id,
                    'credit_amount' => $cost_price,
                    'credit_comment' => "Stock Entry for product: {$this->product->name}",
                ]);
                // update main journal entry debit & credit totals
                $journal->increment('debit_total', $cost_price + $selling_price);
                $journal->increment('credit_total', $cost_price + $selling_price);
            }
        }
    }


    /**
     * Create journal entries for service sales. Following are the entries;
     * Paid Sales:
     *      1: DR Bank Account & CR Sales Service Account with selling price
     *      2: DR Cost of Sales Service & CR Stock Account with cost price
     * Credit Sales:
     *      1: DR Debtors Account & CR Product Sales with selling price
     *      2: DR Cost of Sales Service & CR Stock with cost price
     * Paid Credit Sales (update):
     *      1: DR Bank Account & CR Debtors Account with amount paid
     *
     * @param Journal $journal
     * @param Payment $payment
     * @param bool $update
     */
    public function serviceJournalEntry(Journal $journal, Payment $payment, $update = false)
    {
        //TODO: implement for payment changes from old to paid
        if (!$update) {
            $amount = $this->amount;
            $name = $this->service->name;

            if (strtolower($payment->type) == "paid") {
                // first entries
                JournalTool::debitAndCreditEntries($journal, [
                    'debit_account_id' => GLAccount::where('name', 'like', 'bank')->first()->id,
                    'debit_amount' => $amount,
                    'debit_comment' => "Bank Account entry: $name",
                    'credit_account_id' => GLAccount::where('name', 'like', 'Sales Service')->first()->id,
                    'credit_amount' => $amount,
                    'credit_comment' => "Sales Service Entry: $name",
                ]);
                // second entries
                JournalTool::debitAndCreditEntries($journal, [
                    'debit_account_id' => GLAccount::where('name', 'like', 'Cost of Sales Services')->first()->id,
                    'debit_amount' => $amount,
                    'debit_comment' => "Cost of Sales Services: $name",
                    'credit_account_id' => GLAccount::where('name', 'like', 'Stock')->first()->id,
                    'credit_amount' => $amount,
                    'credit_comment' => "Stock Entry:  $name",
                ]);
                // update main journal entry debit & credit totals
                $journal->increment('debit_total', $amount * 2);
                $journal->increment('credit_total', $amount * 2);
            }
            if (strtolower($payment->type) == "owing") {
                // first entries
                JournalTool::debitAndCreditEntries($journal, [
                    'debit_account_id' => GLAccount::where('name', 'like', 'debtors')->first()->id,
                    'debit_amount' => $amount,
                    'debit_comment' => "Debtors Account entry: $name",
                    'credit_account_id' => GLAccount::where('name', 'like', 'Sales Service')->first()->id,
                    'credit_amount' => $amount,
                    'credit_comment' => "Sales Product Entry for: $name",
                ]);
                // second entries
                JournalTool::debitAndCreditEntries($journal, [
                    'debit_account_id' => GLAccount::where('name', 'like', 'Cost of Sales Services')->first()->id,
                    'debit_amount' => $amount,
                    'debit_comment' => "Cost of Sales Products entry for: $name",
                    'credit_account_id' => GLAccount::where('name', 'like', 'Stock')->first()->id,
                    'credit_amount' => $amount,
                    'credit_comment' => "Stock Entry for: $name",
                ]);
                // update main journal entry debit & credit totals
                $journal->increment('debit_total', $amount * 2);
                $journal->increment('credit_total', $amount * 2);
            }
        }
    }
}
