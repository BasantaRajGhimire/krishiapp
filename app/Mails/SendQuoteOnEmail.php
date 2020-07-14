<?php
namespace App\Mails;

use Illuminate\Contracts\Mail\Mailer;

class SendQuoteOnEmail {
    protected $mailer; 
    protected $fromAddress ='ethekka@gmail.com';
    protected $fromName = 'E-thekka Nepal';
    protected $to;
    protected $subject;
    protected $view;
    protected $data = [];

    public function __construct(Mailer $mailer)
    {
        $this->mailer = $mailer;
    }

    public function sendQuote($data)
    {
        $this->to = $data->email_address;
        $this->subject = "Free Quote is ready here";
        $this->view = 'admin.send_quote_to_email';
        $this->data = compact('data');

        return $this->deliver();
    }

    public function deliver()
    {
        $this->mailer->send($this->view, $this->data, function($message) {
            $message->from($this->fromAddress, $this->fromName)
                    ->to($this->to)->subject($this->subject);
        });
    }

}