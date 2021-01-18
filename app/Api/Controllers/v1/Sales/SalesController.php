<?php

namespace App\Api\Controllers\v1\Sales;

use App\Api\Controllers\BaseController;
use App\Api\Transformers\v1\Sales\SalesTransformer;
use App\Models\Business;
use App\Models\Sales;

/**
 * @group Sales
 *
 * APIs for managing sales
 */
class SalesController extends BaseController
{

    /**
     * All Sales
     *
     * Returns the json representation of all sales belonging to a business
     *
     * @authenticated
     * @urlParam business_id required The id of the business. Example: Wpmbk5ezJn
     *
     * @responseFile responses/sales.all.json
     *
     * @response 404{
     *  "status_code": 404,
     *  "message": "Business not found"
     * }
     * @return \Dingo\Api\Http\Response
     */
    public function all($business_id)
    {
        $bus = Business::findByIdHash($business_id);
        if (!isset($bus))
            $this->response->errorNotFound("Business not found");

        $res = Sales::where('business_id', $bus->id)->with(['items'])->get();

        auth()->user()->log("viewed all sales for business: {$bus->name}");
        return ['total_sales' => 443434534];
        // return $this->response->item($res, new SalesTransformer);
    }

    /**
     * View Sales
     *
     * Returns the json representation of sales item
     *
     * @authenticated
     * @urlParam id required The id of the business. Example: Wpmbk5ezJn
     *
     * @responseFile responses/sales.view.json
     *
     * @response 404 {
     *  "status_code": 404,
     *  "message": "Sales not found"
     * }
     * @return \Dingo\Api\Http\Response
     */
    public function view($id)
    {
        $sales = Sales::findByIdHash($id);
        if (!isset($sales))
            $this->response->errorNotFound("Sales not found");

        auth()->user()->log("Viewed sales: {$sales->id}");
        return $this->response->item($sales, new SalesTransformer());
    }

    /**
     * Delete Product Sales
     *
     * @authenticated
     * @urlParam id required The id of the product. Example: Wpmbk5ezJn
     *
     * @response {
     *  "status_code": 200,
     *  "message": "Sales deleted successfully"
     * }
     * @response 404 {
     *  "status_code": 404,
     *  "message": "Sales not found"
     * }
     */
    // public function delete()
    // {
    //     $res = ProductSales::where('id_hash', request('id', ''))->first();
    //     if (!isset($res))
    //         $this->response->errorNotFound("Sales not found");

    //     $res->delete();
    //     auth()->user()->log("Deleted product sales: {$res->id}");
    //     return ['status_code' => 200, 'message' => "Sales deleted successfully"];
    // }
}
