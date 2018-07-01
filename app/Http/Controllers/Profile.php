<?php
namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\User;
use App\Model\AdoptThread;
use App\Model\PetCategory;
use App\Model\Adopting;

class Profile extends Controller
{

  /*
    * Showing edit profile on setting page
    * GET /setting/profile
    *
  */
  public function editProfile(){
    $data = User::select("username","email","bio","img","lati","longi","name")->where("id",\Session::get("id"))->first();
    $data['page'] = "general";
    return view("profile.edit_profile",$data);
  }

  /*
    * Handling data of edit profile
    * POST /setting/profile
    *
  */
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


  /*
    * Change user password
    * POST /setting/change_password
    *
  */
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

    $find = User::find(\Session::get("id"));

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

  /*
    * Showing edit profile on setting page
    * GET /profile/{uname}
    * uname : can be an id or username of the user
  */
  public function showProfile(Request $r){
    if($r->uname){ //another profile
      $id = $r->uname;
    }
    else{ //own profile
      $id = \Session::get("id");
    }

    $find = User::select("id","username","name","registOn","bio","img")->where("id",$id)->orWhere("username",$id)->where("active",1)->first();

    if(!$find){ //dead link
      return 404;
    }

    $id = $find->id;
    $data["id"] = $id;
    $data["profile"] = $find;


    $data["post"] = $this->getPostProfile($id,1,0,true);
    $data["adopted"] = $this->getPostProfile($id,1,1,true);
    //$data["adopting"] = $this->getAdoptedProfile($id,true);


    return view("profile.profile",$data);
  }

  /*
    * Get all post made by user
    * GET api/list/{id}/{page}/{slug}
    * id : id of the user
    * page : page number
    * slug : type of post
  */
  public function getPostProfile($id,$page,$slug,$bypass = false){
    $category = PetCategory::whereNull("parent_id")->get();

    //set current page
    \Illuminate\Pagination\Paginator::currentPageResolver(function () use ($page) {
        return $page;
    });

    //\DB::enableQueryLog();
    if($slug == 0){ //regular post
      $data = AdoptThread::select("link_name","open_adoption.id as id","title","gender","age","post_date","category_pet.id as cate","parent_id","name");
    }
    else{ //adopted post
      $data = AdoptThread::select("link_name","open_adoption.id as id","title","gender","age","post_date","category_pet.id as cate","name",\DB::raw("apply_at"));
    }

    $data = $data->join("category_pet","category_pet","category_pet.id")
                  ->leftJoin("gallery",function($q){
                      $q->on("open_adoption_id","=","open_adoption.id")
                      ->where("is_featured",1);
                  });

    if($slug == 0){ //regular post
      $data = $data->where("status",1);
    }
    else{//adopted post
      $data = $data->join("adopting","post_id","open_adoption.id")->where("adopting.status",1)->where("open_adoption.status",0);
    }


    $data = $data->where("poster_id",$id)->orderBy("open_adoption.id","DESC")->paginate(5);
    //dd(\DB::getQueryLog());
    $data = $data->map(function($item) use($category,$slug){
      $item->post_date = date("d M Y",strtotime($item->post_date));
      if($item->apply_at){
        $item->apply_at = date("d M Y",strtotime($item->apply_at));
      }

      $item->link_name = ($item->link_name)? asset("img/product/".$item->link_name):asset("images/default.png");

      $item = collect($item);
      //dd($item);

      if($slug == 0){
        if($item->get("parent_id")){ //if not parent
          $item->put("parent_category",$category->where("id",$item->get("parent_id"))->first()->name); //push category parent name
        }
      }

      return $item;
    });

    //for request by api
    if(!$bypass) return $data->toJson();

    //dd($data);
    return $data;
  }

}
