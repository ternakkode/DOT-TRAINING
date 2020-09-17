<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewBilling extends Mailable
{
    use Queueable, SerializesModels;
    protected $data;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $from       = 'admin@seorang.engineer';
        $subject    = 'Transaksi Baru #'.$this->data->billing_id;
        $file       = 'email/billing/baru';

        return $this->from($from)
                    ->subject($subject)
                    ->view($file)
                    ->with($this->data);
    }
}
