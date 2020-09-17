<?php

namespace App\Http\Requests\API\V1\Billing;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

class StoreBilling extends FormRequest
{
    
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email'         => 'required|email',
            'product.*'     => 'required|integer|exists:product,id',
            'total_price'   => 'required|numeric|min:0',
            'quantity.*'    => 'required|integer|min:0',
            'discount'      => 'required|numeric|min:0',
            'due_date'      => 'required|date_format:Y/m/d H:i:s',
            
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new \App\Exceptions\BillingException($validator);
    }
}
