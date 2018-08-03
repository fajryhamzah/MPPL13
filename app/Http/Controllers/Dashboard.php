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
  private $avalaibleLang = array("en","id");

  /*
    * Handling language change
    *
  */
  public function langSwitch($id,$back){
    if(\Session::has("lang")){
      if(in_array($id,$this->avalaibleLang)){
        \Session::put("lang",$id);
      }
      else{
        \Session::put("lang","en");
      }
    }
    else{
      \Session::put("lang","en");
    }

    return \Redirect::to(url(base64_decode($back)));
  }

  /*
    * Forgot password handler
    * POST /forgot
    *
  */
  public function forgot(Request $r){
    $input = $r->input("uname");

    $user = User::where("username",$input)->orWhere("email",$input)->first();

    if(!$user){
      return 402;
    }

    $hash = sha1($user->verifyHash.time());
    $user->forgotHash = \DB::raw("UNHEX('".$hash."')");

    try{
      $user->save();
      $mail = new Email;
      $mail->forgot($user->email,$user->username,$hash,$user->name);

      return 200;
    }
    catch(\Exception $e){
      return 403;
    }
  }

  /*
    * setting new pasword when forgot interface
    * POST /forgot/{hash}
    *
  */
  public function forgotConfirm($hash,Request $r){
    $rules = array(
        'pass' => 'required|min:4',
        'confirmpass' => 'required|min:4',
    );

    $validator = \Validator::make($r->all(), $rules);

    if($validator->fails()){
        return \Redirect::back()->with(["error" => implode("<br />",$validator->errors()->all()) ]);
    }

    $pass = $r->input('pass');

    if($pass != $r->input("confirmpass")){
      return \Redirect::back()->with(["error" => trans("forgot.not_same")]);
    }

    $user = User::where("forgotHash",\DB::raw("UNHEX('".$hash."')"))->first();

    if(!$user){
      return view("404");
    }

    $user->password = md5($pass);
    $user->forgotHash = null;

    try{
      $user->save();
      return \Redirect::to(url("login"))->with(["success" => trans("forgot.changed")]);
    }
    catch(\Exception $e){
      return \Redirect::back()->with(["error" => "2@300xkqxmcc7%%$sncbshqy$$@$.#\\.casdfxcxP;"]);
    }



  }

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
      return json_encode(array('code'=>402,'msg'=> trans("login.not_match") ));
    }

    if($data->active == 0){
      return json_encode(array('code'=>403,'msg'=> trans("login.not_active") ));
    }

    \Session::put('id', $data->id);
    \Session::put('username', $data->username);
    \Session::put('img_profile', $data->img);
    \Session::put('channel', sha1($data->id.env("APP_KEY")));
    \Session::put('lang',$data->lang);

    return json_encode(array('code'=>200,'msg'=> "Ok" ));
  }

  //logout event
  public function logout(Request $r){
      \Session::forget("id");
      \Session::flush();
      return \Redirect::to(url("/"));
  }

  public function index(){
    $data['category'] = PetCategory::where("parent_id",null)->get();
    return view("dashboard",$data);
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
    $notif = Notification::select("notification.id","id_post","type",\DB::raw("DATE_FORMAT(date,'%d/%m/%Y') as date"),"title as name")->join("open_adoption","open_adoption.id","id_post")->where("id_target",\Session::get("id"))->where("seen",0)->get();
    $count = $notif->count();

    $data["count"] = $count;
    $data["data"] = $notif;

    return json_encode($data);
  }

}
