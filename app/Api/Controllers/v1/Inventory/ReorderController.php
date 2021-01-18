<?php

namespace App\Api\Controllers\v1\Inventory;

use App\Api\Controllers\BaseController;
use App\Api\Transformers\v1\Inventory\ProductTransformer;
use App\Models\Business;
use App\Models\Product;
use Dingo\Api\Exception\StoreResourceFailedException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

/**
 * @group Inventory - Reorder
 *
 * APIs for managing inventory reorder
 */
class ReorderController extends BaseController {

    /**
     * Place Reorder
     *
     * @authenticated
     * @bodyParam quantity float required The quantity to be added to the product.
     * @bodyParam product_id string required The id of the product.
     *
     * @transformer App\Api\Transformers\v1\Inventory\ProductTransformer
     *
     * @response 422 {
     *  "status_code": 422,
     *  "message": "Could not update prodcuct.",
     *  "errors": {
     *     "product_id": ["The selected product id is invalid."]
     *   }
     * }
     *
     * @param Request $request
     * @return \Dingo\Api\Http\Response
     */
    public function create(Request $request) {
        $validator = Validator::make($request->all(), [
            'product_id' => 'exists:products,id_hash',
            'quantity' => 'required|numeric',
        ]);

        if ($validator->fails())
            throw new StoreResourceFailedException('Could not update product.', $validator->errors());

        $data = request()->all();
        $product = Product::where('id_hash', $data['product_id'])->first();
        $product->increment('quantity', $data['quantity']);

        auth()->user()->log("added {$data['quantity']} to product '{$product->name}', id: {$product->id}");
        return $this->response->item($product, new ProductTransformer());
    }

    /**
     * Pending Reorder
     *
     * Returns the json representation of all products which needs reorder
     *
     * @authenticated
     * @urlParam business_id required The id of the business. Example: Wpmbk5ezJn
     * @response {
     *  "data": [
     *      {
     *          "name": "Commodi dicta in soluta nesciunt",
     *          "id": "ypZvg7gBHYJlGGWP",
     *          "quantity": 10,
     *          "selling_price": 434,
     *          "cost_price": 4343.4300000000002910383045673370361328125,
     *          "stock_threshold": 10,
     *          "location": "Non repellendus qid est minus.",
     *          "category_id": null
     *      }
     *  ]
     * }
     * @response 404 {
     *  "status_code": 404,
     *  "message": "Business not found"
     * }
     * @return \Illuminate\Http\JsonResponse
     */
    public function all() {
        $bus = Business::where('id_hash', request('business_id'))->first();
        if (!isset($bus))
            $this->response->errorNotFound("Business not found");

        $res = Product::whereRaw("business_id = ? AND stock_threshold >= quantity", [$bus->id])
                      ->select('name', 'id_hash AS id', 'quantity',
                          'selling_price', 'cost_price', 'stock_threshold',
                          'location', 'category_id')->toBase()->get();

        auth()->user()->log("Viewed all reorders for business: {$bus->name}");
        return response()->json(['data' => $res]);
    }
}
