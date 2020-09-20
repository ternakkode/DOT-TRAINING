<?php

namespace App\Exceptions;

use Exception;

class BillingException extends Exception
{
    protected $data;
    protected $report;

    public function __construct($data, $report = false){
        $this->data = $data;
        $this->report = $report;
    }

    public function report(){
        if($this->report) \Log::debug('Failed to validate data, errors: '.$this->data->errors());
    }

    public function render($request){
        return api_error(__('api.failed_api'), $this->data->errors());
    }
}
