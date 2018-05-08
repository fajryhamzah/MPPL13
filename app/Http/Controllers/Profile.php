<?php
namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\User;

class Profile extends Controller
{

  public function editProfile(){
    $data = User::select("username","email","bio","img","lati","longi","name")->where("id",\Session::get("id"))->first();

    return view("profile.edit_profile",$data);
  }

  public function editProfileSave(Request $r){

  }

}
