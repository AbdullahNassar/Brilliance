<?php

namespace App\Exceptions;

use Exception;

use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;

class CustomException extends Exception
{
    public function report()
    {
            $subject = "Program update failed";
            Mail::to('abdullah.nassar1000@gmail.com')->send(new SendMail($subject));

    }
    
    public function render()
    {
        return parent::render();
    }
    
}