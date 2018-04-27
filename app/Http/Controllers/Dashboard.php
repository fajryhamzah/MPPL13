<?php
namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Email;
use App\Model\User;
use App\Model\PetCategory;
use App\Http\Controllers\Owner;
use App\Http\Controllers\HomePage;

class Dashboard extends Controller
{


  //handling a registration form
  public function register(Request $r){
      $rules = array(
          'uname' => 'required|min:4',
          'pass' => 'required|min:4',
          'email' => 'required|email'
      );

      $validator = \Validator::make($r->all(), $rules);

      if($validator->fails()){
          return \Redirect::back()->with(["error" => implode("\n",$validator->errors()->all())]);
      }

      $email = $r->input("email");
      $username = $r->input("uname");
      $password = md5($r->input("pass"));

      $insert = new User;
      $insert->email = $email;
      $insert->username = $username;
      $insert->password = $password;
      $time = time();
      $hash = md5($r->input("uname").$r->input("password").$time);
      $insert->verifyHash = $hash;
      $insert->registOn = date('Y-m-d h:i:s',$time);

      try{
        $insert->save();
        $mail = new Email;

        $mail->mailRegist($r->input("email"),$r->input("uname"),$hash);
        return \Redirect::to(url("/register/success"));
      }
      catch(\Exception $e){
        $msg = $e->getMessage();
        return \Redirect::to(url("/register"))->with(["error" => $msg]);
      }


  }

  //verification for activation after regist
  public function registConfirm($hash){
    $check = User::where("verifyHash",$hash)->where("active",0)->first();

    if(!$check){
      return \Redirect::to(url(""));
    }

    $check->active = 1;
    $check->save();
    return \Redirect::to(url("/register/success/activate"));
  }

  //handling login
  public function login(Request $r){
    $rules = array(
        'uname' => 'required',
        'pass' => 'required',
    );

    $validator = \Validator::make($r->all(), $rules);

    if($validator->fails()){
        return \Redirect::back()->with(["error" => implode("\n",$validator->errors()->all())]);
    }

    $username = $r->input("uname");
    $password = md5($r->input("pass"));


    //\DB::enableQueryLog();
    $data = User::select("id","username","active")->where('username', $username)->orWhere("email",$username)->where('password', $password)->first();
    //dd(\DB::getQueryLog());
    if(is_null($data)){
      return json_encode(array('code'=>403,'msg'=> "username and password is not match" ));
    }

    if($data->active == 0){
      return json_encode(array('code'=>403,'msg'=> "This account has not been activated yet" ));
    }

    \Session::put('id', $data->id);
    \Session::put('username', $data->username);

    return json_encode(array('code'=>200,'msg'=> "Ok" ));
  }

  //logout event
  public function logout(Request $r){
      \Session::forget("id");
      \Session::flush();
      return \Redirect::to(url("/"));
  }

  public function index(){
    return view("dashboard");
  }

  //get all type/race of pet
  public function childTypePet($parent){
      $data = PetCategory::select("id","name")->where("parent_id",$parent)->get();

      return $data->toJson();
  }


}
