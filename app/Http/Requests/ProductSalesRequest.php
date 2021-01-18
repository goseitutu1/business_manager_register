<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Product;

class ProductSalesRequest extends FormRequest
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
                'items' => [
                    'required',
                    function ($attribute, $value, $fail) {
                        $values = json_decode($value);
                        foreach ($values as $item) {
                            $product = Product::find($item->product_id);
                            if ($product === null) {
                                $fail('Select product is invalid.');
                            }
                            if (($product->quantity - $item->quantity) < $product->stock_threshold) {
                                $fail('Remaining quantity for ' . $product->name . ' is below stock threshold (' . $product->stock_threshold . ')');
                            }
                        }
                    },
                ]
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
                'items' => [
                    'required',
                    function ($attribute, $value, $fail) {
                        $values = json_decode($value);
                        foreach ($values as $item) {
                            $product = Product::find($item->product_id);
                            if ($product === null) {
                                $fail('Select product is invalid.');
                            }
                            if (($product->quantity - $item->quantity) < $product->stock_threshold) {
                                $fail('Remaining quantity for ' . $product->name . ' is below stock threshold (' . $product->stock_threshold . ')');
                            }
                        }
                    },
                ]
            ];
        }
        return ['type' => 'in:credit_sales,cash_sales'];
    }
}
