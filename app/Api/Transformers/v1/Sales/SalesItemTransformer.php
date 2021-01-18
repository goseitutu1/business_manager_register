<?php

namespace App\Api\Transformers\v1\Sales;

use App\Models\SalesItem;
use Illuminate\Database\Eloquent\Collection;
use League\Fractal\TransformerAbstract;

class SalesItemTransformer extends TransformerAbstract
{

    public function transformCollection(Collection $data, $resourceKey = null)
    {
        $items = [];
        $data->each(function ($row) use (&$items) {
            $items[] = $this->transform($row);
        });

        return $resourceKey == null ? $items : ['data' => $items];
    }
    /**
     * Turn this item object into a generic array
     *
     * @param SalesItem $item
     * @return array
     */
    public function transform(SalesItem $item)
    {
        if (isset($item->service_id))
            $name = $item->service->name;
        else
            $name = $item->product->name;
        return [
            'id' => $item->id_hash,
            'unit_price' => $item->unit_price,
            'quantity' => $item->quantity,
            'is_taxed' => $item->is_taxed,
            'tax_type' => $item->tax_type,
            'tax_amount' => $item->tax_amount,
            'discount_type' => $item->discount_type,
            'discount_amount' => $item->discount_amount,
            'tax_id' => @$item->tax->id_hash,
            'service_id' => @$item->service->id_hash,
            'product_id' => @$item->product->id_hash,
            'name' => $name
        ];
    }
}
