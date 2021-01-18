<?php

namespace App\Api\Transformers\v1;

use App\Models\AccountType;
use League\Fractal\TransformerAbstract;

class AccountTypeTransformer extends TransformerAbstract {

    /**
     * Turn this item object into a generic array
     *
     * @param AccountType $type
     * @return array
     */
    public function transform(AccountType $type) {
        return [
            'id' => $type->id_hash,
            'name' => $type->name,
            'sign' => $type->sign,
            'code' => $type->code,
        ];
    }

}
