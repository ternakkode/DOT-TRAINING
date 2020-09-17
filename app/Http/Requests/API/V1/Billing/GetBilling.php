<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

class GetBilling extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'billing_number'   => 'required|numeric|exists:billing,billing_number',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new \App\Exceptions\BillingException($validator);
    }
}
