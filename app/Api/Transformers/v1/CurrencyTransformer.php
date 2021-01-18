<?php

namespace App\Api\Transformers\v1;

use App\Models\Currency;
use League\Fractal\TransformerAbstract;

class CurrencyTransformer extends TransformerAbstract {

    /**
     * Turn this item object into a generic array
     *
     * @param Currency $currency
     * @return array
     */
    public function transform(Currency $currency) {
        return [
            'id' => $currency->id_hash,
            'name' => $currency->name,
            'sign' => $currency->sign,
            'code' => $currency->code,
        ];
    }

}
