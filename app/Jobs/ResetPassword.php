<?php

namespace App\Jobs;

use App\Mail\ResetPassword as MailResetPassword;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class ResetPassword implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */

    private $token;
    private $email;

    public function __construct($token,$email)
    {
        $this->setToken($token);
        $this->setEmail($email);
        //
    }

    public function setToken($token){
$this->token=$token;
    }

    public function getToken(){
return $this->token;
    }

    public function setEmail($email){
        $this->email=$email;
            }

     public function getEmail()
     {
        return $this->email;
     }



    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
    Mail::to($this->getEmail())->send(new MailResetPassword($this->getToken()));
    }
}
