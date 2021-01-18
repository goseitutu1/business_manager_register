<?php

namespace App\Api\Controllers\v1;

use App\Api\Controllers\BaseController;
use App\Api\Transformers\v1\AccountTransformer;
use App\Models\Account;
use App\Models\AccountType;
use App\Models\Business;
use App\Models\Currency;
use Dingo\Api\Exception\StoreResourceFailedException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

/**
 * @group Account
 *
 * APIs for managing accounts
 */
class AccountController extends BaseController {

    /**
     * Create Account
     *
     * @authenticated
     * @bodyParam name string required The name of the account.
     * @bodyParam bank_account_number string required The bank account number of the account.
     * @bodyParam mobile_money_wallet string required The MTN Mobile Money wallet number of the account.
     * @bodyParam account_type_id string required The type id of the account.
     * @bodyParam currency_id string required The id of the default currency.
     * @bodyParam business_id string required The id of the business.
     *
     * @transformer App\Api\Transformers\v1\AccountTransformer
     *
     * @response 422 {
     *  "status_code": 422,
     *  "message": "Could not create account.",
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
            'bank_account_number' => 'string|max:20',
            'mobile_money_wallet' => 'string|max:15',
            'account_type_id' => 'exists:account_types,id_hash|max:15',
            'currency_id' => 'required|exists:currencies,id_hash',
            'business_id' => 'required|exists:businesses,id_hash',
        ]);

        if ($validator->fails()) {
            throw new StoreResourceFailedException('Could not create account.', $validator->errors());
        }
        $data = request()->all();
        $data['currency_id'] = Currency::where('id_hash', $data['currency_id'])->first()->id;
        $data['business_id'] = Business::where('id_hash', $data['business_id'])->first()->id;
        if (!empty($data['account_type_id']))
            $data['account_type_id'] = AccountType::where('id_hash', $data['account_type_id'])->first()->id;
        $acct = Account::create($data);

        auth()->user()->log("created new account. name: '{$acct->name}', id: {$acct->id}");
        return $this->response->item($acct, new AccountTransformer);
    }

    /**
     * Update Account
     *
     * Update the information of an account
     *
     * @authenticated
     * @bodyParam name string The name of the account.
     * @bodyParam bank_account_number string The bank account number of the account.
     * @bodyParam mobile_money_wallet string The MTN Mobile Money wallet number of the account.
     * @bodyParam account_type_id string The type id of the account.
     * @bodyParam currency_id string The id of the default currency.
     * @bodyParam business_id string The id of the business.
     *
     * @response 422 {
     *  "status_code": 422,
     *  "message": "Could not update account.",
     *  "errors": {
     *     "name": ["The name may not be greater than 255 characters."]
     *   }
     * }
     * @response {
     *  "status_code": 200,
     *  "message": "Account updated successfully"
     * }
     * @response 404 {
     *  "status_code": 404,
     *  "message": "Account not found"
     * }
     *
     * @param Request $request
     * @return array
     */
    public function update(Request $request) {
        $acct = Account::where('id_hash', request('id', ''))->first();
        if (!isset($acct)) {
            $this->response->errorNotFound("Account not found");
        }
        $validator = Validator::make($request->all(), [
            'name' => '|string|max:255',
            'bank_account_number' => 'string|max:20',
            'mobile_money_wallet' => 'string|max:15',
            'account_type_id' => 'exists:account_types,id_hash|max:15',
            'currency_id' => 'exists:currencies,id_hash',
            'business_id' => 'exists:businesses,id_hash',
        ]);
        if ($validator->fails()) {
            throw new StoreResourceFailedException('Could not update account.', $validator->errors());
        }
        $data = request()->all();
        if (!empty($data['currency_id']))
            $data['currency_id'] = Currency::where('id_hash', $data['currency_id'])->first()->id;
        if (!empty($data['business_id']))
            $data['business_id'] = Business::where('id_hash', $data['business_id'])->first()->id;
        if (!empty($data['account_type_id']))
            $data['account_type_id'] = AccountType::where('id_hash', $data['account_type_id'])->first()->id;

        // Remove id_hash & id fields it exist
        unset($data['id_hash'], $data['id']);

        $acct->update($data);
        auth()->user()->log("updated account: {$acct->name}");
        return ['status_code' => 200, 'message' => "Account updated successfully"];
    }


    /**
     * View  Account
     *
     * Returns the json representation of an account
     *
     * @authenticated
     * @urlParam id required The id of the account. Example: Wpmbk5ezJn
     *
     * @transformer App\Api\Transformers\v1\AccountTransformer
     *
     * @response 404{
     *  "status_code": 404,
     *  "message": "Account not found"
     * }
     */
    public function view() {
        $res = Account::where('id_hash', request('id', ''))->first();
        if (!isset($res))
            $this->response->errorNotFound("Account not found");

        auth()->user()->log("Viewed account: {$res->name}");
        return $this->response->item($res, new AccountTransformer());
    }

    /**
     * Delete Account
     *
     * @authenticated
     * @urlParam id required The id of the business. Example: Wpmbk5ezJn
     * @response {
     *  "status_code": 200,
     *  "message": "Account deleted successfully"
     * }
     * @response 404 {
     *  "status_code": 404,
     *  "message": "Account not found"
     * }
     */
    public function delete() {
        $res = Account::where('id_hash', request('id', ''))->first();
        if (!isset($res))
            $this->response->errorNotFound("Account not found");

        $res->delete();
        auth()->user()->log("Deleted Account: {$res->name}");
        return ['status_code' => 200, 'message' => "Account deleted successfully"];
    }
}
