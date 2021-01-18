<?php

namespace App\Api\Transformers\v1;

use App\Models\Account;
use League\Fractal\TransformerAbstract;

class AccountTransformer extends TransformerAbstract {

    /**
     * Turn this item object into a generic array
     *
     * @param Account $acct
     * @return array
     */
    public function transform(Account $acct) {
        return [
            'id' => $acct->id_hash,
            'name' => $acct->name,
            'bank_account_number' => $acct->bank_account_number,
            'mobile_money_wallet' => $acct->mobile_money_wallet,
            'currency' => [
                'code' => $acct->currency->code,
                'sign' => $acct->currency->sign,
                'name' => $acct->currency->name,
                'id' => $acct->currency->id_hash,
            ],
            'business' => ['name' => $acct->business->name, 'id' => $acct->business->id_hash],
            'account_type' => [
                'id' => $acct->account_type->code,
                'name' => $acct->account_type->name,
                'code' => $acct->account_type->id_hash
            ],
        ];
    }
}
