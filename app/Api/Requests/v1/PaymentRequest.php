<?php

namespace App\Api\Requests\v1;

use App\Api\Requests\Request;

/**
 * @bodyParam type string required The type of the payment. Accepted values are: paid, partial or owing.
 * @bodyParam description string The description of the transaction.
 * @bodyParam payment_method string The method of payment. Either cash, mobile money, bank.
 * @bodyParam phone_number string The phone number of the customer if payment method is mobile money.
 * @bodyParam date string The date of the transaction.
 * @bodyParam due_date string The due date of the payments. Normally for partial and owing payments.
 * @bodyParam total_amount float The total amount of the payment. Required if it is partial or paid
 * @bodyParam amount_paid float The amount paid for the transaction. Required if the payment is partial
 * @bodyParam amount_remaining float The amount remaining for the transaction. Required if the payment is partial
 * @bodyParam amount_owed float The amount remaining for the payment. Required if the payment is owing
 * @bodyParam discount_applied boolean Whether discount is applied to the amount paid
 * @bodyParam discount_type float The type of the discount. Whether fixed or percentage.
 * @bodyParam discount_value float The amount of the discount
 * @bodyParam shopping_cart_id string required The id of the shopping cart.
 * @bodyParam customer_id string The id of the vendor. Required if the payment is partial or owing.
 * @bodyParam business_id string required The id of the business.
 *
 */
class PaymentRequest extends Request {

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
            'type' => 'required|string|in:partial,owing,paid',
            'discount_applied' => 'required_with:discount_type,discount_value|boolean',
            'payment_method' => 'string',
            'description' => 'string',
            'discount_value' => 'required_with:discount_type|regex:/^[0-9]{1,12}(\.[0-9]{0,})?$/',
            'discount_type' => 'required_with:discount_value|string|in:fixed,percentage',
            'total_amount' => 'required_if:type,paid,partial|regex:/^[0-9]{1,12}(\.[0-9]{0,2})?$/',
            'amount_remaining' => 'regex:/^[0-9]{1,12}(\.[0-9]{0,2})?$/',
            'amount_paid' => 'required_if:type,partial|regex:/^[0-9]{1,12}(\.[0-9]{0,2})?$/',
            'amount_owed' => 'required_if:type,owing|regex:/^[0-9]{1,12}(\.[0-9]{0,2})?$/',
            'due_date' => 'required_if:type,partial,owing|string',
            'customer_id' => 'required_if:type,partial,owing|exists:customers,id_hash',
            'business_id' => 'required|exists:businesses,id_hash',
            'shopping_cart_id' => 'required|exists:shopping_cart,id_hash',
        ];
    }
}
