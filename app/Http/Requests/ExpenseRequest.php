<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExpenseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if (request()->method() == "POST" || request()->method() == "PATCH") {
            if (request()->input('type') == "paid") {
                return [
                    'description' => 'nullable|string',
                    'payment_date' => 'nullable|date',
                    'amount_paid' => 'required|min:0|regex:/^[0-9]{1,12}(\.[0-9]{0,2})?$/',
                    'category_id' => 'required|exists:expense_categories,id',
                    'total_amount' => 'required|regex:/^[0-9]{1,12}(\.[0-9]{0,2})?$/',
                ];
            }
            if (request()->input('type') == "owing") {
                return [
                    'description' => 'nullable|string',
                    'due_date' => 'nullable|date',
                    'amount_paid' => 'nullable|min:0|regex:/^[0-9]{1,12}(\.[0-9]{0,2})?$/',
                    'amount_remaining' => 'nullable|min:0|regex:/^[0-9]{1,12}(\.[0-9]{0,2})?$/',
                    'total_amount' => 'required|regex:/^[0-9]{1,12}(\.[0-9]{0,2})?$/',
                    'category_id' => 'required|exists:expense_categories,id',
                    'vendor_id' => 'required|exists:vendors,id',
                ];
            }
        } else {
            return [];
        }
    }
}
