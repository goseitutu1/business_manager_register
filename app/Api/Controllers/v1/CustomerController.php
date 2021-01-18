<?php

namespace App\Api\Controllers\v1;

use App\Api\Controllers\BaseController;
use App\Api\Transformers\v1\CustomerTransformer;
use App\Models\Business;
use App\Models\Customer;
use Dingo\Api\Exception\StoreResourceFailedException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

/**
 * @group Customer
 *
 * APIs for managing customers
 */
class CustomerController extends BaseController
{
    /**
     * Create Customer
     *
     * @authenticated
     * @bodyParam first_name string required The first name of the customer.
     * @bodyParam last_name string required The last name of the customer.
     * @bodyParam email string The email of the customer.
     * @bodyParam phone_number string The phone number of the customer.
     * @bodyParam location string The location of the customer.
     * @bodyParam business_id string required The id of the business.
     *
     * @transformer App\Api\Transformers\v1\CustomerTransformer
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
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name'   => 'required|string|max:255',
            'last_name'    => 'required|string|max:255',
            'email'        => 'email|max:255',
            'phone_number' => 'string|max:20',
            'location'     => 'string|max:255',
            'business_id'  => 'required|exists:businesses,id_hash',
        ]);
        if ($validator->fails()) {
            throw new StoreResourceFailedException($validator->errors()->first(), $validator->errors());
        }

        $data                = request()->all();
        $data['business_id'] = Business::findByIdHash($data['business_id'])->id;
        $customer            = Customer::create($data);

        auth()->user()->log("created new customer. name: '{$customer->full_name}'");
        return $this->response->item($customer, new CustomerTransformer());
    }

    /**
     * Update Customer
     *
     * Update the information of a customer
     *
     * @authenticated
     * @bodyParam first_name string The first name of the customer.
     * @bodyParam last_name string The last name of the customer.
     * @bodyParam email string The email of the customer.
     * @bodyParam phone_number string The phone number of the customer.
     * @bodyParam location string The location of the customer.
     *
     * @transformer App\Api\Transformers\v1\CustomerTransformer
     * @response 422 {
     *  "status_code": 422,
     *  "message": "The email must be a valid email address.",
     *  "errors": {
     *     "email": ["The email must be a valid email address."]
     *   }
     * }
     * @response 404 {
     *  "status_code": 404,
     *  "message": "Customer not found"
     * }
     *
     * @param Request $request
     * @return \Dingo\Api\Http\Response
     */
    public function update(Request $request)
    {
        $customer = Customer::findByIdHash(request('id', ''));
        if (!isset($customer)) {
            $this->response->errorNotFound("Customer not found");
        }
        $validator = Validator::make($request->all(), [
            'first_name'   => 'string|max:255',
            'last_name'    => 'string|max:255',
            'email'        => 'email|max:255',
            'phone_number' => 'string|max:20',
            'location'     => 'string|max:255',
        ]);
        if ($validator->fails()) {
            throw new StoreResourceFailedException($validator->errors()->first(), $validator->errors());
        }

        $data = request()->all();

        // Remove id_hash, business_id, id fields it exist
        unset($data['id_hash'], $data['id'], $data['business_id']);

        $customer->update($data);
        auth()->user()->log("updated customer: {$customer->full_name}");
        return $this->response->item($customer, new CustomerTransformer());
    }

    /**
     * All Customers
     *
     * Returns the json representation of all customers of a business
     *
     * @authenticated
     * @urlParam business_id required The id of the business. Example: Wpmbk5ezJn
     *
     * @transformer App\Api\Transformers\v1\CustomerTransformer
     * @response 404{
     *  "status_code": 404,
     *  "message": "Business not found"
     * }
     * @return \Dingo\Api\Http\Response
     */
    public function all()
    {
        $bus = Business::findByIdHash(request('business_id'));
        if (!isset($bus)) {
            $this->response->errorNotFound("Business not found");
        }

        $res = Customer::where('business_id', $bus->id)->get();

        auth()->user()->log("viewed all customers for business: {$bus->name}");
        return $this->response->collection($res, new CustomerTransformer());
    }

    /**
     * View Customer
     *
     * Returns the json representation of a customer
     *
     * @authenticated
     * @urlParam id required The id of the customer. Example: Wpmbk5ezJn
     *
     * @transformer App\Api\Transformers\v1\CustomerTransformer
     *
     * @response 404 {
     *  "status_code": 404,
     *  "message": "Customer not found"
     * }
     * @return \Dingo\Api\Http\Response
     */
    public function view($id)
    {
        $customer = Customer::findByIdHash($id);

        if (!isset($customer)) {
            $this->response->errorNotFound("Customer not found");
        }

        auth()->user()->log("Viewed customer: {$customer->full_name}");
        return $this->response->item($customer, new CustomerTransformer());
    }

    /**
     * Total Customer
     *
     * Returns the total number of customers of a business
     *
     * @authenticated
     * @urlParam id required The id of the business. Example: Wpmbk5ezJn
     *
     * @response 404 {
     *  "status_code": 404,
     *  "message": "Business not found"
     * }
     * @return \Dingo\Api\Http\Response
     */
    public function totalCustomers($business_id)
    {
        $bus = Business::findByIdHash($business_id);
        if (!isset($bus)) {
            $this->response->errorNotFound("Business not found");
        }

        $customers = Customer::where('business_id', $bus->id)->count();

        auth()->user()->log("Viewed total customers for business: {$bus->name}");
        return ['total_customers' => $customers];
    }

    /**
     * Delete Customer
     *
     * @authenticated
     * @urlParam id required The id of the customer. Example: Wpmbk5ezJn
     *
     * @response {
     *  "status_code": 200,
     *  "message": "Customer deleted successfully"
     * }
     * @response 404 {
     *  "status_code": 404,
     *  "message": "Customer not found"
     * }
     */
    public function delete()
    {
        $res = Customer::findByIdHash(request('id', ''));
        if (!isset($res)) {
            $this->response->errorNotFound("Customer not found");
        }

        $res->delete();
        auth()->user()->log("Deleted Customer: {$res->full_name}");
        return ['status_code' => 200, 'message' => "Customer deleted successfully"];
    }
}
