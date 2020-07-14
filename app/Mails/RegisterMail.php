<?php
namespace App\Mails;

use Illuminate\Contracts\Mail\Mailer;

class RegisterMail {
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

    public function sendRegisterEmail($user)
    {
        $this->to = $user->email;
        $this->subject = (isset($user->status)&&$user->status==3)?"Rejected Registration":"New Registration";
        $this->view = 'mails.register';
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