<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Mail;

class Email extends Controller
{

  public function mailRegist($email,$username,$hash){
    $data = array('name'=>$username,'hash'=>$hash);
    Mail::send(['html'=>'mailTemplate.confirmationRegist'], $data, function($message) use($email,$username) {
         $message->to($email, $username)->subject
            ('Thank you for registering');
         $message->from('regist@adopet.com','Adopet Register Bot');
      });
  }


}
