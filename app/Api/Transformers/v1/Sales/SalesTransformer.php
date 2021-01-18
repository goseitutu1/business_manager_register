<?php

namespace App\Api\Transformers\v1\Sales;

use App\Models\Sales;
use League\Fractal\TransformerAbstract;

class SalesTransformer extends TransformerAbstract
{

    /**
     * Turn this item object into a generic array
     *
     * @param Sales $item
     * @return array
     */
    public function transform(Sales $item)
    {
        $item_trans = new SalesItemTransformer();

        return [
            'id' => $item->id_hash,
            'total_discount' => $item->total_discount,
            'total' => $item->total,
            'total_tax' => $item->total_tax,
            'business_id' => $item->business->id_hash,
            'items' => $item_trans->transformCollection($item->items)
        ];
    }
}
