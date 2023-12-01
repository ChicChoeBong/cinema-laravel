<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ResetPassword extends Mailable
{
    use Queueable, SerializesModels;

    protected $data;

    public function __construct($data_reset)
    {
        $this->data = $data_reset;
    }

    public function build()
    {
        return $this->subject('Đổi Mật Khẩu Tài Khoản Tại Website....')
                    ->view('client.mail_reset_password', [
                        'data'   => $this->data,
                    ]);
    }
}
