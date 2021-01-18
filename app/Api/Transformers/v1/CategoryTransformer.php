<?php

namespace App\Api\Transformers\v1;

use App\Models\Category;
use League\Fractal\TransformerAbstract;

class CategoryTransformer extends TransformerAbstract {
    /**
     * Turn this item object into a generic array
     *
     * @param Category $item
     * @return array
     */
    public function transform(Category $item) {
        return [
            'id' => $item->id_hash,
            'name' => $item->name,
        ];
    }

}
