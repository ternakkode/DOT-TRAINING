<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PaidBilling extends Mailable
{
    use Queueable, SerializesModels;
    protected $data;
    protected $document;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data, $document)
    {
        $this->data = $data;
        $this->document = $document;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $from       = 'admin@seorang.engineer';
        $subject    = 'Pembayaran Transaksi Berhasil #'.$this->data['billing_number'];
        $file       = 'email/billing/paid';

        return $this->from($from)
                    ->subject($subject)
                    ->view($file)
                    ->with(['data' => $this->data])
                    ->attach($this->document);
    }
}
