<?php

namespace App\Api\Transformers\v1;

use App\Models\ExpenseCategory;
use League\Fractal\TransformerAbstract;

class ExpenseCategoryTransformer extends TransformerAbstract {

    /**
     * Turn this item object into a generic array
     *
     * @param ExpenseCategory $category
     * @return array
     */
    public function transform(ExpenseCategory $category) {
        return [
            'id' => $category->id_hash,
            'name' => $category->name,
        ];
    }

}
