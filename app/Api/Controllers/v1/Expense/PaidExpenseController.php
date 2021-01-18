<?php

namespace App\Api\Controllers\v1\Expense;

use App\Api\Controllers\BaseController;
use App\Api\Transformers\v1\ExpenseTransformer;
use App\Models\Business;
use App\Models\Expense;
use App\Models\ExpenseCategory;
use Dingo\Api\Exception\StoreResourceFailedException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

/**
 * @group Expense
 *
 * APIs for managing paid expenses
 */
class PaidExpenseController extends BaseController
{
    /**
     * Create Paid Expense
     *
     * @authenticated
     *
     * @bodyParam description string The description of the expense.
     * @bodyParam date string The date of the expense.
     * @bodyParam category string The category of the expense.
     * @bodyParam amount_paid float The total amount of the expense.
     * @bodyParam business_id string required The id of the business.
     *
     * @transformer App\Api\Transformers\v1\ExpenseTransformer
     * @responseFile responses/expenses.create.json
     * @response 422 {
     *  "status_code": 422,
     *  "message": "The type field is required.",
     *  "errors": {
     *     "type": ["The type field is required."]
     *   }
     * }
     * @param PaidExpenseRequest $request
     * @return \Dingo\Api\Http\Response
     */
    public function create(Request $request)
    {
        $inputs = $request->all();
        $validator = Validator::make($inputs, [
            'amount_paid' => 'required|regex:/^[0-9]{1,12}(\.[0-9]{0,2})?$/',
            'description' => 'string',
            'date' => 'string',
            'category_id' => 'required|exists:expense_categories,id_hash',
            'business_id' => 'required|exists:businesses,id_hash',
        ]);
        if ($validator->fails())
            throw new StoreResourceFailedException($validator->errors()->first(), $validator->errors());

        $inputs['business_id'] = Business::findByIdHash($inputs['business_id'])->id;
        $inputs['category_id'] = ExpenseCategory::findByIdHash($inputs['category_id'])->id;
        $inputs['type']  = 'paid';
        $inputs['amount_remaining'] = 0;
        $inputs['total_amount'] = $inputs['amount_paid'];
        $inputs['vendor_id'] = null;

        $expense = Expense::create($inputs);

        auth()->user()->log("created new paid expense. id: '{$expense->id}'");
        return $this->response->item($expense, new ExpenseTransformer());
    }
}
