<?php

namespace App\Domain\Billing\Services;

use App\Domain\Product\Entities\Product;

class MergeProductBillingService {
    
    public function handle($product_id, $quantity) {
        $product = Product::find($product_id);

        foreach($product as $index => $p){
            $merged[] = [

                // TODO product_id ini apakah integer atau array han, krn yang di line 10 integer ?
                'product_id' => $product_id[$index],
                'product_name' => $p->product_name,
                'quantity' => $quantity[$index],
            ];
        }

        return $merged;
    }
}