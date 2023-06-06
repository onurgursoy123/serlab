<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MailSender extends Mailable
{
    use Queueable, SerializesModels;

    public $mailData;
    public $type;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($mailData, $type = 0)
    {
        $this->mailData = $mailData;
        $this->type = $type;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        if ($this->type == 1) {
            return $this->subject('Ürün Satımı Teklifi')->view('mail.salesMail');
        } else if ($this->type == 2) {
            return $this->subject('Servis Talebi')->view('mail.serviceRequestMail');
        } else if ($this->type == 3) {
            return $this->subject('Cihaz Teklifi')->view('mail.deviceOfferMail');
        } 
    }
}
