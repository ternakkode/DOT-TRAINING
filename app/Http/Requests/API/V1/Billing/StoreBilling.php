<?php

namespace App\Http\Requests\API\V1\Billing;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
// use App\Exception\BillingException;

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
            'total_harga'   => 'required|numeric|min:0',
            'produk.*'      => 'required|integer|exists:produk,id',
            'jumlah.*'      => 'required|integer|min:0',
            'diskon'        => 'required|numeric|min:0',
            'due_date'      => 'required|date_format:Y/m/d H:i:s',
            'email'         => 'required|email',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new \App\Exceptions\BillingException($validator);
    }
}
