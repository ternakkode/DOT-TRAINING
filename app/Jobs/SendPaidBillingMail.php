<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Domain\Billing\Services\GenerateBillingDocumentService;
use App\Domain\Billing\Services\SendEmailPaidBillingService;

class SendPaidBillingMail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $data;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(
        GenerateBillingDocumentService $generateBillingDocumentService,
        SendEmailPaidBillingService $sendEmailPaidBillingService
    ){
        $document = $generateBillingDocumentService->handle($this->data);
        $sendEmailPaidBillingService->handle($this->data, $document);
    }
}
