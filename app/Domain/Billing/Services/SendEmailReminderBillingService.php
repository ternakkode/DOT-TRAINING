<?php

namespace App\Domain\Billing\Services;
use Illuminate\Support\Facades\Mail;
use App\Mail\ReminderBilling;

class SendEmailReminderBillingService {
    
    public function handle($data) {
        Mail::to($data['email'])->send(new ReminderBilling($data));
    }
}