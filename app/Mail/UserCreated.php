<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\User;

class UserCreated extends Mailable
{
    use Queueable, SerializesModels;


    /**
     * The order instance.
     *
     * @var User
     */
    public $user;
    protected $nudePass;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user,String $nudePass)
    {
        $this->user = $user;
        $this->nudePass = $nudePass;
        
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.email')
        ->with(['nudePass' => $this->nudePass])
        ->subject('Seja bem-vindo ao Credcoop Meetings');
        
        
    }
}
