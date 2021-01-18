<?php

namespace App\Api\Transformers\v1\Sales\Report;

use App\Models\Customer;
use League\Fractal\TransformerAbstract;

class DebtorsListTransformer extends TransformerAbstract {

    /**
     * Turn this item object into a generic array
     *
     * @param Customer $item
     * @return array
     */
    public function transform(Customer $customer) {
        $amount = $customer->payments->sum('total_amount') - $customer->payments->sum('amount_paid');
        return [
            'id'     => $customer->id,
            'name'   => $customer->full_name,
            'amount' => $amount,
        ];
    }

}
