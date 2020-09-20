<?php

namespace App\Domain\Billing\Entities;

use Illuminate\Database\Eloquent\Model;

class BillingProduct extends Model
{
    
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'billing_product';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['product_name'];

    public function billing()
    {
        return $this->belongsTo('App\Domain\Entities\Billing', 'billing_number', 'billing_number');
    }
}
