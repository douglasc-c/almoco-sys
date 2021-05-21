<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\User;

class UserRegister extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $random_password;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, $random_password)
    {
        $this->user = $user;
        $this->random_password = $random_password;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.register')->subject('Bem vindo ao meu almoço');
    }
}
