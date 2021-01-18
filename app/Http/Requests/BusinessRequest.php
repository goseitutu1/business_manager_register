<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\Rule;

class BusinessRequest extends FormRequest
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
        if ("POST" == request()->method()) {
            $rules = [
                'location' => 'required|string|max:255',
                'type' => 'required|string|max:255',
                //                'currency_id' => 'required|exists:currencies,id',
                'reg_no' => 'nullable|string',
                'tax_no' => 'nullable|string',
                'vat_no' => 'nullable|string',
                'name' => [ 'required', 'string', 'max:255']
            ];
            if (preg_match('/business\.edit/', Route::currentRouteName())) {
                $rules['name'] = [ 'required', 'string', 'max:255' ];

            }
            return $rules;
        }
        return [];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'location' => 'Business Location',
            'type' => 'Nature of Business',
            'name' => 'Business Name',
        ];
    }
}
