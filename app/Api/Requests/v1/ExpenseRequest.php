<?php

namespace App\Api\Requests\v1;

use App\Api\Requests\Request;

/**
 * @bodyParam type string required The type of the expense. Accepted values are: paid, partial or owing.
 * @bodyParam description string The description of the expense. Normally for paid expenses.
 * @bodyParam date string The date of the expense. Normally for paid expenses.
 * @bodyParam due_date string The due date of the expense. Normally for partial and owing expenses.
 * @bodyParam category string The category of the expense.
 * @bodyParam total_amount float The total amount of the expense. Required if the expense is partial or paid
 * @bodyParam amount_paid float The amount paid for the expense. Required if the expense is partial
 * @bodyParam amount_remaining float The amount remaining for the expense. Required if the expense is partial
 * @bodyParam amount_owed float The amount remaining for the expense. Required if the expense is owing
 * @bodyParam vendor_id string The id of the vendor. Required if the expense is partial or owing.
 * @bodyParam business_id string required The id of the business.
 *
 */
class ExpenseRequest extends Request {

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        return [
            'description' => 'string',
            // 'date' => 'date',
            'category' => 'string|required|exists:expense_categories,name',
            'business_id' => 'required|exists:businesses,id_hash',
            'type' => 'required|string|in:partial,owing,paid',
            'total_amount' => 'required_if:type,paid,partial|regex:/^[0-9]{1,12}(\.[0-9]{0,2})?$/',
            'amount_paid' => 'required_if:type,partial|regex:/^[0-9]{1,12}(\.[0-9]{0,2})?$/',
            'amount_remaining' => 'required_if:type,partial|regex:/^[0-9]{1,12}(\.[0-9]{0,2})?$/',
            'amount_owed' => 'required_if:type,owing|regex:/^[0-9]{1,12}(\.[0-9]{0,2})?$/',
            'vendor_id' => 'required_if:type,partial,owing|exists:vendors,id_hash',
            'due_date' => 'required_if:type,partial,owing|date',
        ];
    }
}
