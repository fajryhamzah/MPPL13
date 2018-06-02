<?php
namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\User;

class Profile extends Controller
{

  //Profile Edit
  public function editProfile(){
    $data = User::select("username","email","bio","img","lati","longi","name")->where("id",\Session::get("id"))->first();

    return view("profile.edit_profile",$data);
  }

  public function editProfileSave(Request $r){
    $rules = array(
        'username' => 'required|min:4',
        'name' => 'max:50',
        'bio' => 'max:60',
        'email' => 'required|email',
        'img_hidden' => "is_png"
    );

    $validator = \Validator::make($r->all(), $rules);

    if($validator->fails()){
        return \Redirect::back()->with(["error" => implode("\n",$validator->errors()->all())]);
    }

    $update = User::find(\Session::get("id"));
    $update->email = $r->input("email");
    $update->username = $r->input("username");
    $update->name = $r->input("name");
    $update->bio = $r->input("bio");
    $update->lati = $r->input("lat");
    $update->longi = $r->input("lng");

    if($r->has("img_hidden")){
      $image = str_replace('data:image/png;base64,', '', $r->input("img_hidden"));
      $image = str_replace(' ', '+', $image);
      $id = md5(\Session::get("id")).".png";
      $path = public_path()."/img/avatar/";

      try{
        \File::put($path.$id,base64_decode($image));
        $update->img = $id;
      }
      catch(\Exception $e){
        return \Redirect::back()->with(["error" => $e->getMessage()]);
      }

    }

    try{
      $update->save();

      return \Redirect::to(url("/profile"))->with(['success' => "Profile Updated"]);
    }
    catch(\Exception $e){
      $msg = $e->getMessage();
      return \Redirect::to(url("/profile"))->with(["error" => $msg]);
    }
  }


  //Change Password
  public function changePassword(Request $r){
    $rules = array(
        'oldpass' => 'required',
        'newpass' => 'required|min:4',
        'confirmnewpass' => 'required|min:4',
    );

    $validator = \Validator::make($r->all(), $rules);

    if($validator->fails()){
        return \Redirect::back()->with(["error" => $validator->errors()]);
    }

    $old = $r->input("oldpass");
    $new = $r->input("newpass");
    $conf = $r->input("confirmnewpass");


    if($new != $conf){
      return \Redirect::back()->with(["different" => trans("profile/change_pass.different") ]);
    }

    $pass = md5($new);

    $find = User::select("password")->where("id",\Session::get("id"))->first();

    if($find->password != md5($old)){
      return \Redirect::back()->with(["wrong" => trans("profile/change_pass.wrong") ]);
    }

    $find->password = $pass;

    try{
      $find->save();

      return \Redirect::back()->with(["success" => trans("profile/change_pass.success") ]);
    }
    catch(\Exception $e){
      return \Redirect::back()->with(["err" => $e->getMessage() ]);
    }


  }

}
