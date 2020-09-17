<?php

namespace App\Domain\Billing\Services;

class GenerateBillingNumberService {
    
    public function handle() {
        
        $date = date("YmdHis");
        $random_number = rand(0, 9);

        return $date.$random_number;
    }
}