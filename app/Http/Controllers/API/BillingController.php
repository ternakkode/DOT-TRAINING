<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Requests\API\V1\Billing\StoreBilling;
use App\Http\Requests\API\V1\Billing\GetBilling;
use App\Domain\Billing\Application\ProcessBillingApplication;
use App\Domain\Billing\Entities\Billing;
use DB;
use Exception;

class BillingController
{
    public $processBillingApplication;
    
    public function __construct(
        ProcessBillingApplication $processBillingApplication
    ){
        $this->processBillingApplication = $processBillingApplication;

    }

    public function generate(StoreBilling $request){
        try {
            DB::beginTransaction();
            $this->processBillingApplication->generate(
                $request->email,
                $request->product,
                $request->quantity,
                $request->total_price,
                $request->discount,
                $request->due_date,
            );
            
            DB::commit();
            return api_success(__('api.success_api'));
        } catch (Exception $err) {
            report($err);
            DB::rollBack();
            return api_error(__('api.failed_api'));
        }   
    }

    public function pay(GetBilling $request){
        try {
            DB::beginTransaction();
            $this->processBillingApplication->pay($request->billing_number);
            DB::commit();
            return api_success(__('api.success_api'));
        } catch (Exception $err) {
            report($err);
            DB::rollBack();
            return api_error(__('api.failed_api'));
        }
    }

    public function cancel(GetBilling $request){
        try {
            DB::beginTransaction();
            $this->processBillingApplication->cancel($request->billing_number);
            DB::commit();
            
            return api_success(__('api.success_api'));
        
        } catch (Exception $err) {
            report($err);
            DB::rollBack();
            return api_error(__('api.failed_api'));
        }
    }
}
