<?php

namespace App\Api\Controllers\v1;

use App\Api\Controllers\BaseController;
use App\Api\Transformers\v1\BusinessTransformer;
use App\Models\Business;
use App\Models\Currency;
use App\Models\Employee;
use App\Models\SubscriptionPlan;
use App\Models\User;
use Dingo\Api\Exception\StoreResourceFailedException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

/**
 * @group Businesses
 *
 * APIs for managing businesses
 */
class BusinessController extends BaseController
{
    /**
     * Create a business
     *
     * @authenticated
     * @bodyParam name string required The name of the business.
     * @bodyParam type string required The nature of the business.
     * @bodyParam location string required The location of the business.
     * @bodyParam owner_id string required The id of the user creating the business.
     * @bodyParam logo file Logo of the business
     * @bodyParam reg_no string The registration number of the business
     * @bodyParam tax_no string The tax identification number of the business
     * @bodyParam vat_no string The vat number of the business
     * @bodyParam currency string The the default currency for all transactions
     *
     * @transformer App\Api\Transformers\v1\BusinessTransformer
     *
     * @response 404{
     *  "status_code": 422,
     *  "message": "The name has already been taken.",
     *  "errors": {
     *     "name": ["The name has already been taken."]
     *   }
     * }
     *
     * @param Request $request
     * @return \Dingo\Api\Http\Response
     */
    public function create(Request $request)
    {
        $messages = [ ];
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'type' => 'required|string|max:255',
//            'currency' => 'exists:currencies,code',
            'owner_id' => 'required|exists:users,id_hash',
            'reg_no' => 'string',
            'tax_no' => 'string',
            'vat_no' => 'string',
        ], $messages);

        if ($validator->fails()) {
            throw new StoreResourceFailedException($validator->errors()->first(), $validator->errors());
        }
        $data = request()->all();
        if (!empty($data['logo'])) {
            $data['logo'] = $this->saveImage($data['logo'], $data['name']);
        }

        $data['currency_id'] = 1;
        $user = User::findByIdHash($data['owner_id']);
        $data['owner_id'] = $user->id;
        DB::beginTransaction();
        $business = Business::query()->create($data);


        if (now()->year == 2020 && in_array(now()->month,[7,8,9])) {

            $plan = SubscriptionPlan::query()->where('name', 'like', 'Enterprise')->first();

            if (isset($user->subscription)) {
                $user->subscription->update([
                    'plan_id' => $plan->id,
                    'status' => 'paid',
                    'is_active' => true,
                    'is_first_time'=>false,
                    'expiry_date' => now()->endOfMonth(),
                    'last_payment_date' => now()
                ]);
            } else {
                $user->subscriptions()->create([
                    'plan_id' => $plan->id,
                    'status' => 'paid',
                    'is_active' => true,
                    'is_first_time' => false,
                    'expiry_date'   => now()->endOfMonth(),
                    'last_payment_date' => now(),
                ]);
            }

            $user->log("Subscribed user to august promotion" . $business->name);

            Session::flash('alert-success', "Congratulations! You have been given a 30 Day free trial subscription on our Enterprise Plan");
        }

        auth()->user()->log("created new business. name: '{$business->name}', id: {$business->id}");

        DB::commit();
        return $this->response->item($business, new BusinessTransformer);
    }

    /**
     * Update a business
     *
     * Update the information of a business
     *
     * @authenticated
     * @bodyParam name string The email of the user.
     * @bodyParam type string The nature of the business.
     * @bodyParam location string  The location of the business.
     * @bodyParam logo file Logo of the business
     * @bodyParam reg_no string The registration number of the business
     * @bodyParam tax_no string The tax identification number of the business
     * @bodyParam vat_no string The vat number of the business
     * @bodyParam currency string This is the default currency for all transactions
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
     *  "message": "Business updated successfully"
     * }
     * @response 404 {
     *  "status_code": 404,
     *  "message": "Business not found"
     * }
     *
     * @param Request $request
     * @return array
     */

    public function update(Request $request)
    {
        $business = Business::where('id_hash', request('id', ''))->first();
        if (!isset($business)) {
            $this->response->errorNotFound("Business not found");
        }

        $validator = Validator::make($request->all(), [
            'name' => 'string|max:255',
            'location' => 'string|max:255',
            'type' => 'string|max:255',
            'currency' => 'string',
            'reg_no' => 'string',
            'tax_no' => 'string',
            'vat_no' => 'string',
        ]);

        if ($validator->fails()) {
            throw new StoreResourceFailedException($validator->errors()->first(), $validator->errors());
        }
        $data = request()->all();
        if (!empty($data['logo'])) {
            // delete old logo
            Storage::delete($business->logo);
            // save new logo
            $data['logo'] = $this->saveImage($data['logo'], $data['name'] ?? $business->name);
        }
        $data['currency_id'] = Currency::where('code', $data['currency'])->first()->id;

        // Remove id_hash & id fields it exist
        unset($data['id_hash'], $data['id']);

        $business->update($data);
        auth()->user()->log("updated business: {$business->name}");
        return ['status_code' => 200, 'message' => "Business updated successfully"];
    }


    /**
     * View a business
     *
     * Returns the json representation of the business
     * All business will be returned if no id is et
     *
     * @authenticated
     * @queryParam id  The id of the business. Example: Wpmbk5ezJn
     *
     * @transformercollection App\Api\Transformers\v1\BusinessTransformer
     * @transformerModel App\Models\Business
     *
     * @response 404{
     *  "status_code": 404,
     *  "message": "Business not found"
     * }
     */
    public function view()
    {
        if (!empty(request()->query('id', ''))) {
            $res = Business::where('id_hash', request('id', ''))->first();
            if (!isset($res))
                $this->response->errorNotFound("Business not found");

            auth()->user()->log("Viewed business: {$res->name}");
            return $this->response->item($res, new BusinessTransformer());
        } else {
            $user = auth()->user();
            if ($user->type != "manager") {
                $res = Employee::where('user_id', $user->id)->first()->business;
                $user->log("Viewed business: {$res->name}");
                return $this->response->item($res, new BusinessTransformer());
            } else {
                $res = Business::where('owner_id', $user->id)->get();
                $user->log("Viewed business");
                return $this->response->collection($res, new BusinessTransformer());
            }
        }
        return $this->response()->noContent();
    }

    /**
     * Delete a business
     *
     * @authenticated
     * @urlParam id required The id of the business. Example: Wpmbk5ezJn
     * @response {
     *  "status_code": 200,
     *  "message": "Business deleted successfully"
     * }
     * @response 404 {
     *  "status_code": 404,
     *  "message": "Business not found"
     * }
     */
    public function delete()
    {
        $res = Business::where('id_hash', request('id', ''))->first();
        if (!isset($res))
            $this->response->errorNotFound("Business not found");

        $res->delete();
        auth()->user()->log("Deleted business: {$res->name}");
        return ['status_code' => 200, 'message' => "Business deleted successfully"];
    }

    // helpers
    private function saveImage($image, $name)
    {
        $image = preg_replace('/^data:image\/\w+;base64,/', '', $image);
        $type = explode(';', $image)[0];
        $ext = explode('/', $type)[1]; // png or jpg etc

        $name = str_replace(' ', '_', $name);
        $name = "{$name}_logo.png";


        Storage::put('/public/logos/' . $name, base64_decode($image));
        return Storage::url("logos/$name");
    }
}
