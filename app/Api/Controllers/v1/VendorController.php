<?php

namespace App\Api\Controllers\v1;

use App\Api\Controllers\BaseController;
use App\Api\Transformers\v1\VendorTransformer;
use App\Models\Business;
use App\Models\Vendor;
use Dingo\Api\Exception\StoreResourceFailedException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

/**
 * @group Vendor
 *
 * APIs for managing vendors
 */
class VendorController extends BaseController {
    /**
     * Create Vendor
     *
     * @authenticated
     * @bodyParam first_name string required The first name of the vendor.
     * @bodyParam last_name string required The last name of the vendor.
     * @bodyParam email string The email of the vendor.
     * @bodyParam phone_number string The phone number of the vendor.
     * @bodyParam description string The description of the vendor.
     * @bodyParam location string The location of the vendor.
     * @bodyParam business_id string required The id of the business.
     *
     * @transformer App\Api\Transformers\v1\VendorTransformer
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
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'email|max:255',
            'phone_number' => 'string|max:20',
            'description' => 'string',
            'location' => 'string|max:255',
            'business_id' => 'required|exists:businesses,id_hash',
        ]);
        if ($validator->fails()) {
            throw new StoreResourceFailedException($validator->errors()->first(), $validator->errors());
        }

        $data = request()->all();
        $data['business_id'] = Business::findByIdHash($data['business_id'])->id;
        $vendor = Vendor::create($data);

        auth()->user()->log("created new vendor. name: '{$vendor->full_name}'");
        return $this->response->item($vendor, new VendorTransformer());
    }

    /**
     * Update Vendor
     *
     * Update the information of an vendor
     *
     * @authenticated
     * @bodyParam first_name string The first name of the vendor.
     * @bodyParam last_name string The last name of the vendor.
     * @bodyParam email string The email of the vendor.
     * @bodyParam phone_number string The phone number of the vendor.
     * @bodyParam description string The description of the vendor.
     * @bodyParam location string The location of the vendor.
     *
     * @transformer App\Api\Transformers\v1\VendorTransformer
     * @response 422 {
     *  "status_code": 422,
     *  "message": "The email must be a valid email address.",
     *  "errors": {
     *     "email": ["The email must be a valid email address."]
     *   }
     * }
     * @response 404 {
     *  "status_code": 404,
     *  "message": "Vendor not found"
     * }
     *
     * @param Request $request
     * @return \Dingo\Api\Http\Response
     */
    public function update(Request $request) {
        $vendor = Vendor::findByIdHash(request('id', ''));
        if (!isset($vendor)) {
            $this->response->errorNotFound("Vendor not found");
        }
        $validator = Validator::make($request->all(), [
            'first_name' => 'string|max:255',
            'last_name' => 'string|max:255',
            'email' => 'email|max:255',
            'phone_number' => 'string|max:20',
            'description' => 'string',
            'location' => 'string|max:255',
        ]);
        if ($validator->fails())
            throw new StoreResourceFailedException($validator->errors()->first(), $validator->errors());

        $data = request()->all();

        // Remove id_hash, business_id, id fields it exist
        unset($data['id_hash'], $data['id'], $data['business_id']);

        $vendor->update($data);
        auth()->user()->log("updated vendor: {$vendor->full_name}");
        return $this->response->item($vendor, new VendorTransformer());
    }

    /**
     * All Vendors
     *
     * Returns the json representation of all vendors of a business
     *
     * @authenticated
     * @urlParam business_id required The id of the business. Example: Wpmbk5ezJn
     *
     * @transformer App\Api\Transformers\v1\VendorTransformer
     * @response 404{
     *  "status_code": 404,
     *  "message": "Business not found"
     * }
     * @return \Dingo\Api\Http\Response
     */
    public function all() {
        $bus = Business::findByIdHash(request('business_id'));
        if (!isset($bus))
            $this->response->errorNotFound("Business not found");

        $res = Vendor::where('business_id', $bus->id)->get();

        auth()->user()->log("viewed all vendors for business: {$bus->name}");
        return $this->response->collection($res, new VendorTransformer());
    }

    /**
     * View Vendor
     *
     * Returns the json representation of a vendor
     *
     * @authenticated
     * @urlParam id required The id of the vendor. Example: Wpmbk5ezJn
     *
     * @transformer App\Api\Transformers\v1\VendorTransformer
     *
     * @response 404 {
     *  "status_code": 404,
     *  "message": "Vendor not found"
     * }
     * @return \Dingo\Api\Http\Response
     */
    public function view() {
        $vendor = Vendor::findByIdHash(request('id'));
        if (!isset($vendor))
            $this->response->errorNotFound("Vendor not found");

        auth()->user()->log("Viewed vendor: {$vendor->full_name}");
        return $this->response->item($vendor, new VendorTransformer());
    }

    /**
     * Delete Vendor
     *
     * @authenticated
     * @urlParam id required The id of the vendor. Example: Wpmbk5ezJn
     *
     * @response {
     *  "status_code": 200,
     *  "message": "Vendor deleted successfully"
     * }
     * @response 404 {
     *  "status_code": 404,
     *  "message": "Vendor not found"
     * }
     */
    public function delete() {
        $res = Vendor::findByIdHash(request('id', ''));
        if (!isset($res))
            $this->response->errorNotFound("Vendor not found");

        $res->delete();
        auth()->user()->log("Deleted Vendor: {$res->full_name}");
        return ['status_code' => 200, 'message' => "Vendor deleted successfully"];
    }
}
