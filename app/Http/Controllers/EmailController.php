<?php

namespace App\Http\Controllers;

use App\Mail\SendEmail;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class EmailController extends Controller
{
    function send() {

        $emailTo = env('MAIL_FROM_ADDRESS');
        
        $name = $_POST['name'];
        $email = $_POST['email'];
        $message = $_POST['message'];
        $subject = env('MAIL_SUBJECT');

        $data = array();
		$data['name'] = $name;
		$data['email'] = $email;
		$data['message'] = $message;
		$data['subject'] = $subject;
        
        $result = filter_var( $data['email'], FILTER_VALIDATE_EMAIL );
        if($result == false){
            return response()->json([
                'valid' => 0,
            ]);
        } else {
            Mail::to($emailTo)->send(new SendEmail($data));
            return response()->json([
                'valid' => 1,
            ]);
        }

    }
}
