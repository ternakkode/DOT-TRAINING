<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BillingProduk extends JsonResource
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
            'no_billing'    => $this->no_billing,
            'id_produk'     => $this->id_produk,
            'jumlah'        => $this->jumlah,
        ];
    }
}
