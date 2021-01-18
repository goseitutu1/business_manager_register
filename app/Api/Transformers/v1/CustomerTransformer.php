<?php

namespace App\Api\Transformers\v1;

use App\Models\Customer;
use League\Fractal\TransformerAbstract;

class CustomerTransformer extends TransformerAbstract
{

    /**
     * Turn this item object into a generic array
     *
     * @param Customer $customer
     * @return array
     */
    public function transform(Customer $customer)
    {
        $payments = [];
        $customer->payments()->each(function ($row) use (&$payments) {
            array_push($payments, $row->id_hash);
        });

        return [
            'id' => $customer->id_hash,
            'last_name' => $customer->last_name,
            'first_name' => $customer->first_name,
            'full_name' => $customer->full_name,
            'phone_number' => $customer->phone_number,
            'email' => $customer->email,
            'payments' => $payments,
            'business_id' => $customer->business->id_hash,
            'created_at' => $customer->created_at,
            'updated_at' => $customer->created_at,
        ];
    }
}
