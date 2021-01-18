<?php

namespace App\Api\Transformers\v1;

use App\Models\Expense;
use League\Fractal\TransformerAbstract;

class ExpenseTransformer extends TransformerAbstract {

    /**
     * Turn this item object into a generic array
     *
     * @param Expense $expense
     * @return array
     */
    public function transform(Expense $expense) {
        return [
            'id' => $expense->id_hash,
            'due_date' => $expense->due_date,
            'type' => $expense->type,
            'payment_date' => $expense->payment_date,
            'description' => $expense->description,
            'category' => @$expense->category->name,
            'total_amount' => $expense->total_amount,
            'amount_paid' => $expense->amount_paid,
            'amount_owed' => $expense->amount_owed,
            'amount_remaining' => $expense->amount_remaining,
            'vendor_id' => @$expense->vendor->id_hash,
            'business_id' => $expense->business->id_hash,
            'created_at' => $expense->created_at->format('Y-m-d')
        ];
    }

}
