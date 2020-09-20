<?php

namespace App\Domain\Billing\Services;
use PDF;

class GenerateBillingDocumentService {
    
    public function handle($data) {
        $fileName = '#'.$data['billing_number']. '.' . 'pdf' ;
        $path = public_path('document/invoice');
        $url = $path . '/' . $fileName;

        $pdf = PDF::loadview('pdf/billing/paid',['data' => $data]);
        $pdf->save($url);

        return $url;
    }
}