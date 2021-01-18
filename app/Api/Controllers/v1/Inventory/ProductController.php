<?php

namespace App\Api\Controllers\v1\Inventory;

use App\Api\Controllers\BaseController;
use App\Api\Transformers\v1\Inventory\ProductTransformer;
use App\Models\Business;
use App\Models\Category;
use App\Models\Product;
use Dingo\Api\Exception\StoreResourceFailedException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

/**
 * @group Inventory - Products
 *
 * APIs for managing inventory products
 */
class ProductController extends BaseController {

    /**
     * Create Product
     *
     * @authenticated
     * @bodyParam name string required The name of the product.
     * @bodyParam cost_price float The price at which the product was bought or produced.
     * @bodyParam selling_price float The price at which the product is sold.
     * @bodyParam stock_threshold float The minimum quantity at which reorder is placed.
     * @bodyParam can_expire string Whether the product expires or not.
     * @bodyParam location string The location of the product.
     * @bodyParam category string required The name of the inventory category. Example: Product
     * @bodyParam business_id string required The id of the business.
     *
     * @transformer App\Api\Transformers\v1\Inventory\ProductTransformer
     *
     * @response 422 {
     *  "status_code": 422,
     *  "message": "The selected business id is invalid.",
     *  "errors": {
     *     "business_id": ["The selected business id is invalid."]
     *   }
     * }
     *
     * @param Request $request
     * @return \Dingo\Api\Http\Response
     */
    public function create(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'quantity' => 'required|numeric|min:0',
            'cost_price' => 'regex:/^[0-9]{1,12}(\.[0-9]{0,2})?$/',
            'selling_price' => 'regex:/^[0-9]{1,12}(\.[0-9]{0,2})?$/',
            'stock_threshold' => 'numeric|min:0',
            'can_expire' => 'string',
            'location' => 'string|max:255',
            'category' => 'exists:categories,name',
            'business_id' => 'required|exists:businesses,id_hash',
        ]);
        if ($validator->fails()) {
            throw new StoreResourceFailedException($validator->errors()->first(), $validator->errors());
        }

        $data = request()->all();
        $data['business_id'] = Business::where('id_hash', $data['business_id'])->first()->id;
        if (!empty($data['category']))
            $data['category_id'] = Category::where('name', 'like', $data['category'])->first()->id;
        $product = Product::create($data);

        auth()->user()->log("created new product. name: '{$product->name}', id: {$product->id}");
        return $this->response->item($product, new ProductTransformer());
    }

    /**
     * Update Product
     *
     * Update the information of an product
     *
     * @authenticated
     * @bodyParam name string  The name of the product.
     * @bodyParam cost_price float The price at which the product was bought or produced.
     * @bodyParam selling_price float The price at which the product is sold.
     * @bodyParam stock_threshold float The minimum quantity at which reorder is placed.
     * @bodyParam can_expire string Whether the product expires or not.
     * @bodyParam location string The location of the product.
     * @bodyParam category string required The name of the inventory category. Example: Product
     * @bodyParam business_id string The id of the business.
     *
     * @transformer App\Api\Transformers\v1\Inventory\ProductTransformer
     * @response 422 {
     *  "status_code": 422,
     *  "message": "The selected business id is invalid.",
     *  "errors": {
     *     "name": ["The name may not be greater than 255 characters."]
     *   }
     * }
     * @response 404 {
     *  "status_code": 404,
     *  "message": "Product not found"
     * }
     *
     * @param Request $request
     * @return \Dingo\Api\Http\Response
     */
    public function update(Request $request) {
        $product = Product::where('id_hash', request('id', ''))->first();
        if (!isset($product)) {
            $this->response->errorNotFound("Product not found");
        }
        $validator = Validator::make($request->all(), [
            'name' => 'string|max:255',
            'quantity' => 'numeric|min:0',
            'cost_price' => 'regex:/^[0-9]{1,12}(\.[0-9]{0,2})?$/',
            'selling_price' => 'regex:/^[0-9]{1,12}(\.[0-9]{0,2})?$/',
            'stock_threshold' => 'numeric|min:0',
            'can_expire' => 'string',
            'location' => 'string|max:255',
            'category' => 'exists:categories,name',
            'business_id' => 'exists:businesses,id_hash',
        ]);
        if ($validator->fails())
            throw new StoreResourceFailedException($validator->errors()->first(), $validator->errors());

        $data = request()->all();
        if (!empty($data['category']))
            $data['category_id'] = Category::where('name', 'like', $data['category'])->first()->id;

        // Remove id_hash, business_id, id fields it exist
        unset($data['id_hash'], $data['id'], $data['business_id']);

        $product->update($data);
        auth()->user()->log("updated product: {$product->name}");
        return $this->response->item($product, new ProductTransformer());
    }

    /**
     * All Products
     *
     * Returns the json representation of all products belonging to a business
     *
     * @authenticated
     * @urlParam business_id required The id of the business. Example: Wpmbk5ezJn
     *
     * @transformer App\Api\Transformers\v1\Inventory\ProductTransformer
     * @response 404{
     *  "status_code": 404,
     *  "message": "Business not found"
     * }
     * @return \Dingo\Api\Http\Response
     */
    public function all() {
        $bus = Business::where('id_hash', request('business_id'))->first();
        if (!isset($bus))
            $this->response->errorNotFound("Business not found");

        $res = Product::where('business_id', $bus->id)->get();

        auth()->user()->log("Products all services for business: {$bus->name}");
        return $this->response->collection($res, new ProductTransformer());
    }

    /**
     * View Product
     *
     * Returns the json representation of a product
     *
     * @authenticated
     * @urlParam id required The id of the product. Example: Wpmbk5ezJn
     *
     * @transformer App\Api\Transformers\v1\Inventory\ProductTransformer
     *
     * @response 404 {
     *  "status_code": 404,
     *  "message": "Product not found"
     * }
     * @return \Dingo\Api\Http\Response
     */
    public function view() {
        $product = Product::where('id_hash', request('id'))->first();
        if (!isset($product))
            $this->response->errorNotFound("Product not found");

        auth()->user()->log("Viewed product: {$product->name}");
        return $this->response->item($product, new ProductTransformer());
    }

    /**
     * Delete Product
     *
     * @authenticated
     * @urlParam id required The id of the product. Example: Wpmbk5ezJn
     *
     * @response {
     *  "status_code": 200,
     *  "message": "Product deleted successfully"
     * }
     * @response 404 {
     *  "status_code": 404,
     *  "message": "Product not found"
     * }
     */
    public function delete() {
        $res = Product::where('id_hash', request('id', ''))->first();
        if (!isset($res))
            $this->response->errorNotFound("Product not found");

        $res->delete();
        auth()->user()->log("Deleted Product: {$res->name}");
        return ['status_code' => 200, 'message' => "Product deleted successfully"];
    }
}
