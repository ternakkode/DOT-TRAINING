<?php

namespace App\Domain\Billing\Application;

use App\Domain\Billing\Repositories\ProsesBillingRepository;
use App\Domain\Billing\Services\GenerateBillingService;
use App\Domain\Billing\Services\SendEmailBillingService;
use App\Domain\Billing\Services\MergeProductBillingService;

class ProsesBillingApplication
{
    public $prosesBillingRepository;
    public $genereteBillingService;
    public $sendEmailBillingService;
    public $mergeProductBillingService;

    public function __construct(
        ProsesBillingRepository $prosesBillingRepository,
        GenerateBillingService $genereteBillingService,
        SendEmailBillingService $sendEmailBillingService,
        MergeProductBillingService $mergeProductBillingService
    ) {
        $this->prosesBillingRepository = $prosesBillingRepository;
        $this->genereteBillingService = $genereteBillingService;
        $this->sendEmailBillingService = $sendEmailBillingService;
        $this->mergeProductBillingService = $mergeProductBillingService;
    }

    public function generate($data){
        // generate nomor id billing
        $no_billing = $this->genereteBillingService->handle();
        // kirim email ke user
        // $this->sendEmailBillingService->handle($no_billing, $data);

        // simpan data billing
        $this->prosesBillingRepository->store($no_billing, $data);
        // simpan data produk
        $product = $this->mergeProductBillingService->handle($data->produk, $data->jumlah);
        $this->prosesBillingRepository->storeProduct($product);
    }
}
