<?php

namespace App\Domain\Billing\Services;
use PDF;

class GenerateBillingDocumentService {
    
    public function handle($no_billing) {
        $fileName = 'Invoice #'.$no_billing. '.' . 'pdf' ;
        $path = public_path('document/invoice');
        $url = $path . '/' . $fileName;

        $pdf = PDF::loadview('email/billing/paid',['data' => $data]);
        $pdf->save($url);

        return $url;
    }
}