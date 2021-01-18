<?php

namespace App\Api\Transformers\v1;

use App\Models\Vendor;
use League\Fractal\TransformerAbstract;

class VendorTransformer extends TransformerAbstract {

    /**
     * Turn this item object into a generic array
     *
     * @param Vendor $vendor
     * @return array
     */
    public function transform(Vendor $vendor) {
        return [
            'id' => $vendor->id_hash,
            'last_name' => $vendor->last_name,
            'first_name' => $vendor->first_name,
            'full_name' => $vendor->full_name,
            'description' => $vendor->description,
            'phone_number' => $vendor->phone_number,
            'email' => $vendor->email,
            'business_id' => $vendor->business->id_hash,
        ];
    }

}
