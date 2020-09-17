<?php

namespace App\Domain\Billing\Services;

class MergeProductBillingService {
    
    public function handle($produk, $jumlah) {
        $merged = [];
        for ($i=0; $i<count($produk); $i++){
            $merged[] = [
                'id_produk' => $produk[$i],
                'jumlah' => $jumlah[$i],
            ];
        }

        return $merged;
    }
}