<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Requests\API\V1\Billing\StoreBilling;
use App\Domain\Billing\Application\ProsesBillingApplication;

class BillingController
{
    public $prosesBillingApplication;
    
    public function __construct(
        ProsesBillingApplication $prosesBillingApplication
    ){
        $this->prosesBillingApplication = $prosesBillingApplication;

    }

    public function generate(StoreBilling $request){
        $this->prosesBillingApplication->generate($request);
    }
}
