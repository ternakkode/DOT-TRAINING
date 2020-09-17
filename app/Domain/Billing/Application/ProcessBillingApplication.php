<?php

namespace App\Domain\Billing\Application;

use App\Domain\Billing\Repositories\BillingRepository;
use App\Domain\Billing\Services\GenerateBillingNumberService;
use App\Domain\Billing\Services\MergeProductBillingService;
use App\Domain\Billing\Services\GenerateBillingDocumentService;
use App\Jobs\SendNewBillingMail;

class ProcessBillingApplication
{
    public $billingRepository;
    public $genereteBillingNumberService;
    public $mergeProductBillingService;
    public $generateBillingDocumentService;

    public function __construct(
        BillingRepository $billingRepository,
        GenerateBillingNumberService $genereteBillingNumberService,
        MergeProductBillingService $mergeProductBillingService,
        GenerateBillingDocumentService $generateBillingDocumentService
    ) {
        $this->billingRepository = $billingRepository;
        $this->genereteBillingNumberService = $genereteBillingNumberService;
        $this->mergeProductBillingService = $mergeProductBillingService;
        $this->generateBillingDocumentService = $generateBillingDocumentService;
    }

    public function generate(
        $email, $product, $quantity, $total_price, $discount, $due_date
    ){
        // generate nomor id billing
        $billing_number = $this->genereteBillingNumberService->handle();

        // merge product 
        $product = $this->mergeProductBillingService->handle($product, $quantity);

        // kirim email ke user
        SendNewBillingMail::dispatch([
            'billing_number'    => $billing_number,
            'email'             => $email,
            'product'           => $product,
            'total_price'       => $total_price,
            'discount'          => $discount,
            'total_price'       => $total_price,
            'due_date'          => $due_date
        ])->delay(now()->addMinutes(1));

        // simpan data billing
        $this->billingRepository->store(
            $billing_number,
            $email,
            $total_price,
            $discount,
            $due_date
        );

        // simpan data produk
        $this->billingRepository->storeProduct($product);
    }

    public function pay($no_billing){
        $this->billingRepository = new BillingRepository(Billing::find($no_billing));
        $this->billingRepository->updateStatus('PAID');

        $document = $this->generateBillingDocumentService($no_billing, $this->billingRepository);
        $this->sendEmailPaidBillingService->handle();
    }

    public function cancel($no_billing){
        $this->billingRepository = new billingRepository(Billing::find($no_billing));
        $this->billingRepository->updateStatus('CANCELED');
    }
}
