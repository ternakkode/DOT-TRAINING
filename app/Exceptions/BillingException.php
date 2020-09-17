<?php

namespace App\Exceptions;

use Exception;

class BillingException extends Exception
{
    protected $data;

    public function __construct($data){
        $this->data = $data;
    }

    public function report(){

    }

    public function render($request){
        return api_error('terjadi kesalahan', $this->data->errors());
    }
}
