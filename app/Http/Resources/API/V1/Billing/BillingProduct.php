<?php

namespace App\Http\Resources\API\V1\Billing;

use Illuminate\Http\Resources\Json\JsonResource;

class BillingProduct extends JsonResource
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
            'id'                => $this->id,
            'billing_number'    => $this->billing_number,
            'product_id'        => $this->product_id,
            'quantity'          => $this->quantity,
        ];
    }
}
