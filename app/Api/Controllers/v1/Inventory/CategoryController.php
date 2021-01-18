<?php

namespace App\Api\Controllers\v1\Inventory;

use App\Api\Controllers\BaseController;
use App\Api\Transformers\v1\CategoryTransformer;
use App\Models\Category;

/**
 * @group Inventory - Category
 *
 * APIs for managing inventory categories
 */
class CategoryController extends BaseController {

    /**
     * All Categories
     *
     * Returns the json representation of all categories
     *
     * @authenticated
     * @transformer App\Api\Transformers\v1\CategoryTransformer
     *
     * @return \Dingo\Api\Http\Response
     */
    public function all() {
        $res = Category::all();
        $transform = new CategoryTransformer();

        auth()->user()->log("Viewed all categories");
        return $this->response->collection($res, new CategoryTransformer());
    }

    /**
     * View Category
     *
     * Returns the json representation of a category
     *
     * @authenticated
     * @urlParam id required The id of the category. Example: Wpmbk5ezJn
     * @transformer App\Api\Transformers\v1\CategoryTransformer
     *
     * @response 404 {
     *  "status_code": 404,
     *  "message": "Category not found"
     * }
     */
    public function view() {
        $category = Category::where('id_hash', request('id'))->first();
        if (!isset($category))
            $this->response->errorNotFound("Category not found");

        auth()->user()->log("Viewed category: {$category->name}");
        return $this->response->item($category, new CategoryTransformer());
    }
}
