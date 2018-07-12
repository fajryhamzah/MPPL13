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

  public function new_bidder($email,$username,$id,$name){
    $data = array('name'=>$username,'id'=>$id);
    Mail::send(['html'=>'mailTemplate.new_bidder'], $data, function($message) use($email,$username,$name) {
         $message->to($email, $username)->subject
            ('You got new bidder on '.$name);
         $message->from('donotreply@adopet.com','Adopet Notification System');
      });
  }


}
