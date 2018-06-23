<?php
namespace App\Http\Controllers;

use App\Model\Notification as notif;

class Notification
{
  private $type = array("new_bidder","chosen"."other");
  private $error;
  /**
      * Add new notification to the table
      *
      * @param $id_target The id of user targetted for notification.
      * @param $id_post The id of post sourced of the notification.(null for global notification)
      * @param $type Type of notification.see var $type
      * @return boolean
  */
  public function addNotification($id_target,$id_post=null,$type=0){
    $insert = new notif;
    $insert->id_target = $id_target;
    $insert->id_post = $id_post;
    $insert->type = $this->type[$type];
    $insert->date = date("Y-m-d H:i:s");

    try{
      $insert->save();

      return true;
    }
    catch(\Exception $e){
      $this->error = $e->getMessage();
      return false;
    }
  }

  /**
      * get error message that happen
      *
      * @return string
  */
  public function getError(){
    return $this->error;
  }



}
