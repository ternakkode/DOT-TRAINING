<?php namespace App\Domain\Billing\Repositories;

use App\Domain\Billing\Entities\Billing;


class ProsesBillingRepository{

    public $model;

    public function __construct(Billing $model){
        $this->model = $model;
    }

    public function store($no_billing, $data){
        $this->model->no_billing = $no_billing ?? $this->model->no_billing;
        $this->model->total_harga = $data->total_harga ?? $this->model->total_harga;
        $this->model->diskon = $data->diskon ?? $this->model->diskon;
        $this->model->save();
    }

    public function storeProduct($data){
        $this->model->produk()->createMany($data);
    }

}