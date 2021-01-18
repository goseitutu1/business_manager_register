<?php

namespace App\Api\Transformers\v1\Inventory;

use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;
use League\Fractal\TransformerAbstract;

class ProductTransformer extends TransformerAbstract {
    /**
     * Turn this collection object into a generic array
     *
     * @param Collection $item
     * @return array
     */
    public function transformCollection(Collection $item) {
        $items = ['data' => []];
        $item->transform(function ($row) use (&$items) {
            $items['data'][] = $this->transform($row);
        });
        return $items;
    }

    /**
     * Turn this item object into a generic array
     *
     * @param Product $product
     * @return array
     */
    public function transform(Product $product) {
        return [
            'id' => $product->id_hash,
            'name' => $product->name,
            'location' => $product->location,
            'quantity' => $product->quantity,
            'category' => @$product->category->name,
            'stock_threshold' => $product->stock_threshold,
            'cost_price' => $product->cost_price,
            'selling_price' => $product->selling_price,
            'can_expire' => $product->can_expire,
        ];
    }

}
