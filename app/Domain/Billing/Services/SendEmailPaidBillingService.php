<?php

namespace App\Domain\Billing\Services;
use Illuminate\Support\Facades\Mail;
use App\Mail\PaidBilling;

class SendEmailPaidBillingService {
    
    public function handle($data, $document) {
        Mail::to($data['email'])->send(new PaidBilling($data, $document));
    }
}