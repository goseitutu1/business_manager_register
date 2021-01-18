<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateSales extends FormRequest
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

        if (strtolower(request()->get('type')) == "cash_sales") {
            session()->put('js_grid', json_decode(request()->get('items')), true);
            return [
                'type' => 'string|required|in:credit_sales,cash_sales',
                'payment_method' => 'string|max:255',
                'total' => 'required|regex:/^[0-9]{1,12}(\.[0-9]{0,2})?$/',
                'amount_paid' => 'required|regex:/^[0-9]{1,12}(\.[0-9]{0,2})?$/',
                'total_discount' => 'nullable|regex:/^[0-9]{1,12}(\.[0-9]{0,2})?$/',
                'customer_id' => 'nullable|exists:customers,id',
            ];
        }
        if (strtolower(request()->get('type')) == "credit_sales") {
            session()->put('js_grid', json_decode(request()->get('items')), true);
            return [
                'type' => 'required|string|in:credit_sales,cash_sales',
                'due_date' => 'date',
                'customer_id' => 'required|exists:customers,id',
                'total' => 'required|regex:/^[0-9]{1,12}(\.[0-9]{0,2})?$/',
                'total_discount' => 'nullable|regex:/^[0-9]{1,12}(\.[0-9]{0,2})?$/',
            ];
        }
        return ['type' => 'in:credit_sales,cash_sales'];
    }
}
