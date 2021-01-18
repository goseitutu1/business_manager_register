<?php

namespace App\Api\Transformers\v1\ShoppingCart;

use App\Models\ShoppingCart;
use League\Fractal\TransformerAbstract;

class ShoppingCartTransformer extends TransformerAbstract {

    /**
     * Turn this item object into a generic array
     *
     * @param ShoppingCart $item
     * @return array
     */
    public function transform(ShoppingCart $item) {
        $trans = new ShoppingCartItemTransformer();
        $cart_items = [];
        foreach ($item->items as $row)
            array_push($cart_items, $trans->transform($row));

        return [
            'id' => $item->id_hash,
            'total_tax' => $item->total_tax,
            'total' => $item->total,
            'items' => $cart_items,
            'user_id' => $item->user->id_hash
        ];
    }

}
