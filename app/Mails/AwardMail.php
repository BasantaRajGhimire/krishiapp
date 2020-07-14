<?php
namespace App\Mails;

use Illuminate\Contracts\Mail\Mailer;

class AwardMail {
    protected $mailer; 
    protected $fromAddress = 'ethekka@gmail.com';
    protected $fromName = 'E-thekka Nepal';
    protected $to;
    protected $subject;
    protected $view;
    protected $data = [];

    public function __construct(Mailer $mailer)
    {
        $this->mailer = $mailer;
    }

    public function sendAwardEMail($user, $postid)
    {
        $this->to = $user->email;
        $this->subject = "Client awarded post for you";
        $this->view = 'mails.award';
        $this->data = compact(['user','postid']);

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