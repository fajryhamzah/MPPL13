<?php
namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Email;
use App\Model\User;
use App\Model\PetCategory;
use App\Model\AdoptThread;
use App\Model\Notification;
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
          return \Redirect::back()->with(["error" => $validator->errors()]);
      }

      $email = $r->input("email");
      $username = $r->input("uname");
      $password = md5($r->input("pass"));
      $msg = array();

      //check email if not exist
      if(User::where("email",$email)->first()){
        $msg["email"] = trans("register.email_exist");
      }

      //check username if not exist
      if(User::where("username",$username)->first()){
        $msg["uname"] = trans("register.username_exist");
      }

      if(!empty($msg)){
        return \Redirect::back()->with(["msg" => $msg]);
      }

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
        //$msg = $e->getMessage();
        $msg = trans("register.exist");
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
        return json_encode(array('code'=>403,'msg'=> $validator->errors()->all() ));
    }

    $username = $r->input("uname");
    $password = md5($r->input("pass"));


    //\DB::enableQueryLog();
    $data = User::select("id","username","img","active")->where('password', $password)->where(
      function($q) use($username){
          $q->where('username', $username)->orWhere("email",$username);
      })->first();
    //dd(\DB::getQueryLog());
    if(!$data){
      return json_encode(array('code'=>402,'msg'=> "username and password is not match" ));
    }

    if($data->active == 0){
      return json_encode(array('code'=>403,'msg'=> "This account has not been activated yet" ));
    }

    \Session::put('id', $data->id);
    \Session::put('username', $data->username);
    \Session::put('img_profile', $data->img);
    \Session::put('channel', sha1($data->id.env("APP_KEY")));

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


  public function editProfile(){
    $data = User::select("username","email","bio","img","lati","longi","name")->where("id",\Session::get("id"))->first();

    return view("profile.edit_profile",$data);
  }

  /*
    * Get all avalaible post by location bound
    * GET /api/pet/location
    *
  */
  public function getAllLocation(Request $r){
    $south = $r->input("south");
    $west = $r->input("west");
    $north = $r->input("north");
    $east = $r->input("east");
    $id = $r->input("id");

    if( (!$south) || (!$west) || (!$north) || (!$east) ){
      return \Response::json([
          'message' => "Bad Request"
      ], 400);
    }

    //\DB::enableQueryLog();
    $data = AdoptThread::select(\DB::raw("open_adoption.id,title,lati,longi,IF(parent_id is null, category_pet.id,parent_id) as cate"))
    ->join("category_pet","category_pet.id","open_adoption.category_pet")
    ->where("status",1)
    ->where("poster_id","!=",$id)
    ->where("lati",">",$south)
    ->where("lati","<",$north)
    ->where("longi",">",$west)
    ->where("longi","<",$east)
    ->get()->toJSON();


    //dd(\DB::getQueryLog());
    return \Response::json([
        'data' => $data
    ], 200);

  }

  public function notif(){
    $notif = Notification::select("id_post","type","date","title as name")->join("open_adoption","open_adoption.id","id_post")->where("id_target",\Session::get("id"))->where("seen",0)->get();
    $count = $notif->count();

    $data["count"] = $count;
    $data["data"] = $notif;

    return json_encode($data);

  }

}
