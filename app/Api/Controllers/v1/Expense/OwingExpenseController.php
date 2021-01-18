<?php

namespace App\Api\Controllers\v1\Expense;

use App\Api\Controllers\BaseController;
use App\Api\Requests\v1\Expense\PaidExpenseRequest;
use App\Api\Transformers\v1\ExpenseTransformer;
use App\Models\Business;
use App\Models\Expense;
use App\Models\ExpenseCategory;
use App\Models\Vendor;
use Dingo\Api\Exception\StoreResourceFailedException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

/**
 * @group Expense
 *
 * APIs for managing paid expenses
 */
class OwingExpenseController extends BaseController
{
    /**
     * Create Owing Expense
     *
     * @authenticated
     *
     * @bodyParam due_date string The due date of the expense.
     * @bodyParam category string The category of the expense.
     * @bodyParam amount_owed float The amount owing for the expense.
     * @bodyParam vendor_id string The id of the vendor.
     * @bodyParam business_id string required The id of the business.
     *
     * @transformer App\Api\Transformers\v1\ExpenseTransformer
     *
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
            'category_id' => 'required|exists:expense_categories,id_hash',
            'business_id' => 'required|exists:businesses,id_hash',
            'amount_owed' => 'required|regex:/^[0-9]{1,12}(\.[0-9]{0,2})?$/',
            'vendor_id' => 'required|exists:vendors,id_hash',
            'due_date' => 'required|string',
        ]);
        if ($validator->fails())
            throw new StoreResourceFailedException($validator->errors()->first(), $validator->errors());

        $inputs['business_id'] = Business::findByIdHash($inputs['business_id'])->id;
        $inputs['category_id'] = ExpenseCategory::findByIdHash($inputs['category_id'])->id;
        $inputs['vendor_id'] = Vendor::findByIdHash($inputs['vendor_id'])->id;
        $inputs['type']  = 'owing';
        $inputs['amount_remaining'] = $inputs['amount_owed'];
        $inputs['total_amount'] = $inputs['amount_owed'];
        $inputs['amount_paid'] = 0;

        $expense = Expense::create($inputs);

        auth()->user()->log("created new owing expense. id: '{$expense->id}'");
        return $this->response->item($expense, new ExpenseTransformer());
    }
}
