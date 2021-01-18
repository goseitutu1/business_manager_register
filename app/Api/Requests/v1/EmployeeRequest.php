<?php

namespace App\Api\Requests\v1;

use App\Api\Requests\Request;

/**
 * @bodyParam email string required
 * @bodyParam first_name string required
 * @bodyParam last_name string required
 * @bodyParam phone_number string required
 * @bodyParam country string optional
 * @bodyParam role string optional The role of the employee. Default to 'Attendant' if not set.
 * @bodyParam business_id string required The id of the business.
 *
 */
class EmployeeRequest extends Request {

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
            'email' => 'required|email|unique:users,email|max:255',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone_number' => 'required|string|unique:users,phone_number|max:20',
            'country' => 'string|max:255',
            'role' => 'exists:roles,name',
            'business_id' => 'required|exists:businesses,id_hash'
        ];
    }
}
