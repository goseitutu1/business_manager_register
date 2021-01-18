<?php

namespace App\Api\Transformers\v1;

use App\Models\Business;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Log;
use League\Fractal\TransformerAbstract;

class BusinessTransformer extends TransformerAbstract {
    public function transformCollection(Collection $data, $resourceKey = null) {
        $items = [];
        $data->each(function ($row) use (&$items) {
            $items[] = $this->transform($row);
        });

        return $resourceKey == null ? $items : ['data' => $items];
    }

    /**
     * Turn this item object into a generic array
     *
     * @param Business $business
     * @return array
     */
    public function transform(Business $business) {
        return [
            'id' => $business->id_hash,
            'name' => $business->name,
            'nature' => $business->type,
            'location' => $business->location,
            'owner' => $business->owner->fullName(),
            'currency' => [
                'code' => $business->currency->code,
                'sign' => $business->currency->sign,
                'name' => $business->currency->name,
                'id' => $business->currency->id_hash,
            ],
            'reg_no' => $business->reg_no,
            'tax_no' => $business->tax_no,
            'vat_no' => $business->vat_no,
            'logo' => empty($business->logo) ? null : asset($business->logo)
        ];
    }
}
