<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Requests\API\V1\Billing\StoreBilling;
use App\Http\Request\API\V1\Billing\GetBilling;
use App\Domain\Billing\Application\ProcessBillingApplication;

class BillingController
{
    public $processBillingApplication;
    
    public function __construct(
        ProcessBillingApplication $processBillingApplication
    ){
        $this->processBillingApplication = $processBillingApplication;

    }

    public function generate(StoreBilling $request){
        $this->processBillingApplication->generate(
            $request->email,
            $request->product,
            $request->quantity,
            $request->total_price,
            $request->discount,
            $request->due_date,
        );
    }

    public function pay(GetBilling $request){
        $this->processBillingApplication->pay($request->billing_number);
    }

    public function cancel(GetBilling $request){
        $this->processBillingApplication->cancel($request->billing_number);
    }
}
