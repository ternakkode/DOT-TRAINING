<?php

namespace App\Domain\Billing\Services;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewBilling;

class SendEmailNewBillingService {
    
    public function handle($data) {
        Mail::to($data['email'])->send(new NewBilling($data));
    }
}