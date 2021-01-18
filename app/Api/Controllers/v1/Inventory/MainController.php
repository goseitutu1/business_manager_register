<?php

namespace App\Api\Controllers\v1\Inventory;

use App\Api\Controllers\BaseController;
use App\Api\Transformers\v1\Inventory\ProductTransformer;
use App\Api\Transformers\v1\Inventory\ServiceTransformer;
use App\Models\Business;
use App\Models\Product;
use App\Models\Service;

/**
 * @group Inventory
 *
 * APIs for managing inventory
 */
class MainController extends BaseController {

    /**
     * All Products & Services
     *
     * Returns the json representation of all products & services belonging to a business
     *
     * @authenticated
     * @urlParam business_id required The id of the business. Example: Wpmbk5ezJn
     *
     * @response 200 {
     *  "data": {
     *   "products": [
     *      {
     *      "id_hash": "vj1jDwyOf2jMnBDx",
     *      "name": "Odit tempore adipisci enim occaecateum.",
     *      "amount": 4343,
     *      "business_id": 15,
     *      "category_id": null
     *      }
     *    ],
     *  "services": [
     *      {
     *      "id_hash": "vj1jDwyOf2jMnBDx",
     *      "name": "Odit tempore adipisci enim occaecateum.",
     *      "amount": 4343,
     *      "business_id": 15
     *      }
     *    ]
     *  }
     * }
     * @response 404 {
     *  "status_code": 404,
     *  "message": "Business not found"
     * }
     * @return array
     */
    public function all() {
        $bus = Business::where('id_hash', request('business_id'))->first();
        if (!isset($bus))
            $this->response->errorNotFound("Business not found");

        $product_trans = new ProductTransformer();
        $service_trans = new ServiceTransformer();

        $products = [];
        $res = Product::where('business_id', $bus->id)->get();
        foreach ($res as $item)
            array_push($products, $product_trans->transform($item));

        $services = [];
        $res = Service::where('business_id', $bus->id)->get();
        foreach ($res as $item)
            array_push($services, $service_trans->transform($item));

        auth()->user()->log("viewed all products & services for business: {$bus->name}");
        return ['data' => [
            'products' => $products,
            'services' => $services,
        ]];
    }
}
