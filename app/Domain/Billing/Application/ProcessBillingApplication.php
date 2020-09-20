<?php

namespace App\Domain\Billing\Application;

use App\Domain\Billing\Repositories\BillingRepository;
use App\Domain\Billing\Services\GenerateBillingNumberService;
use App\Domain\Billing\Services\MergeProductBillingService;
use App\Domain\Billing\Services\GenerateBillingDocumentService;
use App\Domain\Billing\Services\SendEmailPaidBillingService;
use App\Domain\Billing\Entities\Billing;
use App\Jobs\SendNewBillingMail;
use App\Jobs\SendPaidBillingMail;
use Exception;

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
        GenerateBillingDocumentService $generateBillingDocumentService,
        SendEmailPaidBillingService $sendEmailPaidBillingService
    ) {
        $this->billingRepository = $billingRepository;
        $this->genereteBillingNumberService = $genereteBillingNumberService;
        $this->mergeProductBillingService = $mergeProductBillingService;
        $this->generateBillingDocumentService = $generateBillingDocumentService;
        $this->sendEmailPaidBillingService = $sendEmailPaidBillingService;
    }

    public function generate(
        $email,
        $product,
        $quantity,
        $total_price,
        $discount,
        $due_date
    ) {
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
        ]);

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

    public function pay($billing_number)
    {
        $this->billingRepository = new BillingRepository(Billing::with('product')->find($billing_number));
        
        if($this->billingRepository->getStatus() != "PENDING") throw (new Exception('Artikel tidak ditemukan'));

        $this->billingRepository->setStatus('PAID');

        SendPaidBillingMail::dispatch($this->billingRepository->model->toArray());
    }

    public function cancel($no_billing)
    {
        $this->billingRepository = new billingRepository(Billing::find($no_billing));
        if($this->billingRepository->getStatus() != "PENDING") throw (new Exception('Artikel tidak ditemukan'));

        $this->billingRepository->setStatus('CANCELED');
    }
}
