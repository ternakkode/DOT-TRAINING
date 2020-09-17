<?php 

namespace App\Domain\Product\Repositories;

use App\Domain\Product\Entities\Product;


class ProductRepository{

    public $model;

    public function __construct(Product $model){
        $this->model = $model;
    }

    public function find($product_id){
        $this->model->find(1);

        return $this->model;
    }

}