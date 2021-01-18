<?php

namespace App\Api\Transformers\v1\Inventory;

use App\Models\Service;
use League\Fractal\TransformerAbstract;

class ServiceTransformer extends TransformerAbstract
{

    /**
     * Turn this item object into a generic array
     *
     * @param Service $service
     * @return array
     */
    public function transform(Service $service)
    {
        return [
            'id' => $service->id_hash,
            'name' => $service->name,
            'amount' => $service->amount,
            'category' => @$service->category->name
        ];
    }
}
