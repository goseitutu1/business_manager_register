<?php

namespace App\Api\Controllers\v1\Expense;

use App\Api\Controllers\BaseController;
use App\Api\Requests\v1\ExpenseRequest;
use App\Api\Transformers\v1\ExpenseCategoryTransformer;
use App\Api\Transformers\v1\ExpenseTransformer;
use App\Models\Business;
use App\Models\Expense;
use App\Models\ExpenseCategory;
use App\Models\Vendor;

/**
 * @group Expense
 *
 * APIs for managing expenses
 */
class ExpenseController extends BaseController
{
    /**
     * Update Expense
     *
     * Update the information of an expense
     *
     * @authenticated
     * @urlParam id string required The id of the expense.
     *
     * @transformer App\Api\Transformers\v1\VendorTransformer
     * @response 422 {
     *  "status_code": 422,
     *  "message": "The type field is required.",
     *  "errors": {
     *     "type": ["The type field is required."]
     *   }
     * }
     * @response 404 {
     *  "status_code": 404,
     *  "message": "Expense not found"
     * }
     *
     * @param ExpenseRequest $request
     * @return \Dingo\Api\Http\Response
     */
    public function update(ExpenseRequest $request)
    {
        //TODO: fix ExpenseRequest form request inconsistency in data validation

        $expense = Expense::findByIdHash(request('id', ''));
        if (!isset($expense)) {
            $this->response->errorNotFound("Expense not found");
        }
        $inputs = $request->all();
        if (!empty($inputs['vendor_id']))
            $inputs['vendor_id'] = Vendor::findByIdHash($inputs['vendor_id'])->id;

        // Remove id_hash, business_id, id fields it exist
        unset($inputs['id_hash'], $inputs['id'], $inputs['business_id']);

        $expense->update($inputs);

        auth()->user()->log("updated expense. id: '{$expense->id}'");
        return $this->response->item($expense, new ExpenseTransformer());
    }

    /**
     * All Expenses
     *
     * Returns the json representation of all expenses of a business
     *
     * @authenticated
     * @urlParam business_id required The id of the business. Example: Wpmbk5ezJn
     *
     * @transformercollection App\Api\Transformers\v1\ExpenseTransformer
     * @transformerModel App\Models\Expense
     * @responseFile responses/expenses.all.json
     *
     * @response 404{
     *  "status_code": 404,
     *  "message": "Business not found"
     * }
     * @return \Dingo\Api\Http\Response
     */
    public function all()
    {
        $bus = Business::findByIdHash(request('business_id'));
        if (!isset($bus))
            $this->response->errorNotFound("Business not found");

        $res = Expense::where('business_id', $bus->id)->get();

        auth()->user()->log("viewed all expenses for business: {$bus->name}");
        return $this->response->collection($res, new ExpenseTransformer());
    }

    /**
     * Expenses Categories
     *
     * Returns the json representation of all categories of expenses
     *
     * @authenticated
     *
     * @transformercollection App\Api\Transformers\v1\ExpenseCategoryTransformer
     * @transformerModel App\Models\ExpenseCategory
     *
     * @response 404{
     *  "status_code": 404,
     *  "message": "Business not found"
     * }
     * @return \Dingo\Api\Http\Response
     */
    public function categories()
    {
        $res = ExpenseCategory::all();

        auth()->user()->log("viewed all expense categories");
        return $this->response->collection($res, new ExpenseCategoryTransformer());
    }

    /**
     * View Expense
     *
     * Returns the json representation of an expense
     *
     * @authenticated
     * @urlParam id string required The id of the expense. Example: Wpmbk5ezJn
     *
     * @transformer App\Api\Transformers\v1\ExpenseTransformer
     *
     * @response 404 {
     *  "status_code": 404,
     *  "message": "Expense not found"
     * }
     * @return \Dingo\Api\Http\Response
     */
    public function view()
    {
        $res = Expense::findByIdHash(request('id'));
        if (!isset($res))
            $this->response->errorNotFound("Expense not found");

        auth()->user()->log("Viewed expense: {$res->id}");
        return $this->response->item($res, new ExpenseTransformer());
    }

    /**
     * Delete Expense
     *
     * @authenticated
     * @urlParam id required The id of the expense. Example: Wpmbk5ezJn
     *
     * @response {
     *  "status_code": 200,
     *  "message": "Expense deleted successfully"
     * }
     * @response 404 {
     *  "status_code": 404,
     *  "message": "Expense not found"
     * }
     */
    public function delete()
    {
        $res = Expense::findByIdHash(request('id', ''));
        if (!isset($res))
            $this->response->errorNotFound("Expense not found");

        $res->delete();
        auth()->user()->log("Deleted Expense: {$res->id}");
        return ['status_code' => 200, 'message' => "Expense deleted successfully"];
    }
}
