<?php namespace App\Domain\Billing\Repositories;

use App\Domain\Billing\Entities\Billing;


class BillingRepository{

    public $model;

    public function __construct(Billing $model){
        $this->model = $model;
    }

    public function store(
        $billing_number,
        $email,
        $total_price,
        $discount,
        $due_date
    ){
        $this->model->billing_number    = $billing_number ?? $this->model->billing_number;
        $this->model->email             = $email ?? $this->model->email;
        $this->model->total_price       = $total_price ?? $this->model->total_price;
        $this->model->discount          = $discount ?? $this->model->discount;
        $this->model->due_date          = $due_date ?? $this->model->due_date;
        $this->model->status            = 'PENDING' ?? $this->model->status;
        $this->model->save();
    }

    public function updateStatus($status){
        $this->model->status = $status;
        $this->model->save();
    }

    public function storeProduct($data){
        $this->model->produk()->createMany($data);
    }

}