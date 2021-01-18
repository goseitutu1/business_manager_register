<?php

namespace App\Api\Controllers\v1\Inventory;

use App\Api\Controllers\BaseController;
use App\Api\Transformers\v1\Inventory\ServiceTransformer;
use App\Models\Business;
use App\Models\Category;
use App\Models\Service;
use Dingo\Api\Exception\StoreResourceFailedException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

/**
 * @group Inventory - Services
 *
 * APIs for managing inventory services
 */
class ServiceController extends BaseController {

    /**
     * Create Service
     *
     * @authenticated
     * @bodyParam name string required The name of the service.
     * @bodyParam amount float required The amount charged for the service.
     * @bodyParam category string required The name of the inventory category. Example: Service
     * @bodyParam business_id string required The id of the business.
     *
     * @transformer App\Api\Transformers\v1\Inventory\ServiceTransformer
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
            'amount' => 'required|regex:/^[0-9]{1,12}(\.[0-9]{0,2})?$/',
            'category' => 'exists:categories,name',
            'business_id' => 'required|exists:businesses,id_hash',
        ]);

        if ($validator->fails())
            throw new StoreResourceFailedException($validator->errors()->first(), $validator->errors());

        $data = request()->all();
        $data['business_id'] = Business::where('id_hash', $data['business_id'])->first()->id;
        if (!empty($data['category']))
            $data['category_id'] = Category::where('name', 'like', $data['category'])->first()->id;
        $service = Service::create($data);

        auth()->user()->log("created new inventory service. name: '{$service->name}', id: {$service->id}");
        return $this->response->item($service, new ServiceTransformer());
    }

    /**
     * Update Service
     *
     * Update the information of a service
     *
     * @authenticated
     * @bodyParam name string The name of the service.
     * @bodyParam amount float The amount charged for the service.
     * @bodyParam category string required The name of the inventory category. Example: Service
     * @bodyParam business_id string The id of the business.
     *
     * @response 422 {
     *  "status_code": 422,
     *  "message": "The name may not be greater than 255 characters.",
     *  "errors": {
     *     "name": ["The name may not be greater than 255 characters."]
     *   }
     * }
     * @response {
     *  "status_code": 200,
     *  "message": "Service updated successfully"
     * }
     * @response 404 {
     *  "status_code": 404,
     *  "message": "Service not found"
     * }
     *
     * @param Request $request
     * @return array
     */
    public function update(Request $request) {
        $service = Service::where('id_hash', request('id', ''))->first();
        if (!isset($service)) {
            $this->response->errorNotFound("Service not found");
        }
        $validator = Validator::make($request->all(), [
            'name' => 'string|max:255',
            'amount' => 'regex:/^[0-9]{1,12}(\.[0-9]{0,2})?$/',
            'category' => 'exists:categories,name',
            'business_id' => 'exists:businesses,id_hash',
        ]);
        if ($validator->fails())
            throw new StoreResourceFailedException($validator->errors()->first(), $validator->errors());

        $data = request()->all();
        if (!empty($data['category']))
            $data['category_id'] = Category::where('name', 'like', $data['category'])->first()->id;

        // Remove id_hash, id, & business_id fields it exist
        unset($data['id_hash'], $data['id'], $data['business_id']);

        $service->update($data);
        auth()->user()->log("updated service: {$service->name}");
        return ['status_code' => 200, 'message' => "Service updated successfully"];
    }


    /**
     * All Services
     *
     * Returns the json representation of all services belonging to a business
     *
     * @authenticated
     * @urlParam business_id required The id of the business. Example: Wpmbk5ezJn
     *
     * @transformer App\Api\Transformers\v1\Inventory\ServiceTransformer
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

        $res = Service::where('business_id', $bus->id)->get();

        auth()->user()->log("Viewed all services for business: {$bus->name}");
        return $this->response->collection($res, new ServiceTransformer());

    }

    /**
     * View Services
     *
     * Returns the json representation of a service
     *
     * @authenticated
     * @urlParam id required The id of the service. Example: Wpmbk5ezJn
     * @transformer App\Api\Transformers\v1\Inventory\ServiceTransformer
     *
     * @response 404{
     *  "status_code": 404,
     *  "message": "Service not found"
     * }
     * @return \Dingo\Api\Http\Response
     */
    public function view() {
        $service = Service::where('id_hash', request('id'))->first();
        if (!isset($service))
            $this->response->errorNotFound("Service not found");

        auth()->user()->log("Viewed service: {$service->name}");
        return $this->response->item($service, new ServiceTransformer());
    }

    /**
     * Delete Service
     *
     * @authenticated
     * @urlParam id required The id of the service. Example: Wpmbk5ezJn
     * @response {
     *  "status_code": 200,
     *  "message": "Service deleted successfully"
     * }
     * @response 404 {
     *  "status_code": 404,
     *  "message": "Service not found"
     * }
     */
    public function delete() {
        $res = Service::where('id_hash', request('id', ''))->first();
        if (!isset($res))
            $this->response->errorNotFound("Service not found");

        $res->delete();
        auth()->user()->log("Deleted Service: {$res->name}");
        return ['status_code' => 200, 'message' => "Service deleted successfully"];
    }
}
