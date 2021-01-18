<?php

namespace App\Api\Transformers\v1\ShoppingCart;

use App\Api\Transformers\v1\Inventory\ProductTransformer;
use App\Api\Transformers\v1\Inventory\ServiceTransformer;
use App\Api\Transformers\v1\TaxTransformer;
use App\Models\ShoppingCartItem;
use League\Fractal\TransformerAbstract;

class ShoppingCartItemTransformer extends TransformerAbstract
{

    /**
     * Turn this item object into a generic array
     *
     * @param ShoppingCartItem $item
     * @return array
     */
    public function transform(ShoppingCartItem $item)
    {
        if (isset($item->product_id))
            $name = $item->product->name;
        else
            $name = $item->service->name;

        return [
            'id' => $item->id_hash,
            'name' => $name,
            'quantity' => $item->quantity,
            'total' => $item->total,
            'unit_price' => $item->unit_price,
            'tax_amount' => $item->tax_amount,
        ];
    }
}
