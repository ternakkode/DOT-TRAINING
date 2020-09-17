<?php

namespace App\Domain\Billing\Services;

use App\Domain\Product\Entities\Product;

class MergeProductBillingService {
    
    public function handle($product_id, $quantity) {
        $product = Product::find($product_id);

        foreach($product as $index => $p){
            $merged[] = [
                'product_id' => $product_id[$index],
                'product_name' => $p->product_name,
                'quantity' => $quantity[$index],
            ];
        }

        return $merged;
    }
}