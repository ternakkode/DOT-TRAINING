<?php

namespace App\Domain\Billing\Services;

class GenerateBillingService {
    
    public function handle() {
        
        $date = date("YmdHis");
        $random_number = rand(0, 9);

        return '#'.$date.$random_number;
    }
}