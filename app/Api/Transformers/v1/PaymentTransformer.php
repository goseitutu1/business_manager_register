<?php

namespace App\Api\Transformers\v1;

use App\Api\Transformers\v1\Sales\ProductTransformer;
use App\Api\Transformers\v1\Sales\ServiceTransformer;
use App\Models\Payment;
use League\Fractal\TransformerAbstract;

class PaymentTransformer extends TransformerAbstract
{
    /**
     * Turn this item object into a generic array
     *
     * @param Payment $item
     * @return array
     */
    public function transform(Payment $item)
    {
        $cus_transform = new CustomerTransformer();
        return [
            'id' => $item->id_hash,
            'total_amount' => $item->total_amount,
            'payment_method' => $item->payment_method,
            'discount_applied' => $item->discount_applied,
            'discount_type' => $item->discount_type,
            'discount_value' => $item->discount_value,
            'type' => $item->type,
            'amount_paid' => $item->amount_paid,
            'amount_owed' => $item->amount_owed,
            'amount_remaining' => $item->amount_remaining,
            'due_date' => $item->due_date,
            'sales_id' => @$item->sales->id_hash,
            'business_id' => $item->business->id_hash,
            'customer' => isset($item->customer_id) ? $cus_transform->transform($item->customer) : null,
            'created_at' => $item->created_at,
            'updated_at' => $item->created_at,
        ];
    }
}
