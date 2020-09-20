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

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'billing_number';

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'string';


    public function product()
    {
        return $this->hasMany('App\Domain\Billing\Entities\BillingProduct', 'billing_number', 'billing_number');
    }
}
