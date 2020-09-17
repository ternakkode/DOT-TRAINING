<?php

namespace App\Domain\Billing\Entities;

use Illuminate\Database\Eloquent\Model;

class Billing extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'billing';

    public function produk()
    {
        return $this->hasMany('App\Domain\Billing\Entities\BillingProduct', 'billing_number', 'billing_number');
    }
}
