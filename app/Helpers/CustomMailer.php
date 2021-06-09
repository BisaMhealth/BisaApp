<?php
namespace App\Helpers;

use App\Mail\AppMail;
use App\Mail\PasswordRequestMail;
use App\Mail\ResetUserPassword;
use App\Mail\NewDoctorAccountCreated;
class CustomMailer
{
    public function sendPasswordResetEmail(string $email, string $username, string $text)
    {
        // $mailData = array('username' => $username, 'text' => $text);
        // \Mail::to($email)->send(new PasswordRequestMail($mailData));

         $mailData = array('username' => $username, 'text' => $text);
        \Mail::to($email)->send(new ResetUserPassword($mailData));
    }

    public function newDoctorCreated($email,$fullName,$password){
        $mailData = array('email' => $email, 'fullname' => $fullName, 'password'=>$password);
        \Mail::to($email)->send(new NewDoctorAccountCreated($mailData));
    }

}
