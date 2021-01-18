<?php

namespace App\Api\Transformers\v1;

use App\Models\Tax;
use League\Fractal\TransformerAbstract;

class TaxTransformer extends TransformerAbstract {

    /**
     * Turn this item object into a generic array
     *
     * @param Tax $currency
     * @return array
     */
    public function transform(Tax $currency) {
        return [
            'id' => $currency->id_hash,
            'name' => $currency->name,
            'percentage' => number_format($currency->percentage * 100,3)
        ];
    }

}
