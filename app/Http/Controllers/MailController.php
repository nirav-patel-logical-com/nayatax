<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Config;

class MailController extends Controller {


	    public function send_email_for_exception($emailSubject, $emailId,$mail_body){


        if( (isset($emailId))&&(!empty($emailId)) ){

            //$link = asset('')."account_activation?otp=".$otp;
            $headers  = "From: noreply@digitalsamaj.com\r\n";
            $headers .= "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            $subject = $emailSubject;
            $message = $mail_body;

            mail($emailId,$subject,$message,$headers);
        }else{
            Session::put('SUCCESS','FALSE');
            Session::put('MESSAGE', 'Error while adding user details');
            return Redirect::route('home');
        }

    }


}
