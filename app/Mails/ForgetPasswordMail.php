<?php
namespace App\Mails;

use Illuminate\Contracts\Mail\Mailer;

class ForgetPasswordMail {
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

    public function sendEmail($user)
    {
        $this->to = $user->email;
        $this->subject = "Reset Password";
        $this->view = 'mails.forget_password';
        $this->data = compact('user');

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