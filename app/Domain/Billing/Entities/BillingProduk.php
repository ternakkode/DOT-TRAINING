<?php

namespace App\Domain\Billing\Entities;

use Illuminate\Database\Eloquent\Model;

class BillingProduk extends Model
{
    
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'billing_produk';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    public function post()
    {
        return $this->belongsTo('App\Domain\Entities\BillingProduk');
    }
}
