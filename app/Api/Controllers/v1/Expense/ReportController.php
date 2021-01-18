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
class ReportController extends BaseController
{

    /**
     * Summary
     *
     * Returns the summary report of all expenses
     *
     * @authenticated
     * @urlParam business_id required The id of the business
     *
     * @response 404{
     *  "status_code": 404,
     *  "message": "Business not found"
     * }
     * @return \Dingo\Api\Http\Response
     */
    public function summary()
    {
        $bus = Business::findByIdHash(request('business_id'));
        if (!isset($bus))
            $this->response->errorNotFound("Business not found");

        $query = Expense::where('business_id', $bus->id);
        $res = [
            'total_paid' =>  $query->sum('amount_paid'),
            'total_unpaid' => $query->sum('amount_remaining'),
            'total_expenses' => $query->sum('total_amount')
        ];

        auth()->user()->log("viewed expenses summary report for business: {$bus->name}");
        return response()->json($res);
    }
}
