<?php

namespace App\Http\Resources\API\V1\Billing;

use Illuminate\Http\Resources\Json\JsonResource;

class Billing extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'billing_number'    => $this->billing_number,
            'email'             => $this->email,
            'total_price'       => $this->total_price,
            'discount'          => $this->discount,
            'status'            => $this->status,
            'due_date'          => $this->due_date,
            // 'product'           => BillingProduct::collection($this->product)
        ];
    }
}
