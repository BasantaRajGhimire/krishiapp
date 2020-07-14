<?php
namespace App\Mails;

use Illuminate\Contracts\Mail\Mailer;

class SendMessageFromContactUs {
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

    public function sendMessage($data)
    {
        $this->to = $data->email;
        $this->subject = "Thank you For contacting us";
        $this->view = 'admin.send_message_to_contactus';
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