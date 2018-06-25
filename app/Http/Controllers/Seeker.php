<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Notification;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Model\AdoptThread;
use App\Model\PetCategory;
use App\Model\Gallery;
use App\Model\User;
use App\Model\Adopting;

class Seeker extends Controller
{

  /*
    * Showing finder page
    * GET /finder
    *
  */
  public function index(){
    $location = User::select("lati","longi")->where("id",\Session::get('id'))->first();
    $data['lati'] = $location->lati;
    $data['longi'] = $location->longi;
    $data['id'] = \Session::get("id");


    return view("seeker.maps",$data);
  }


  /*
    * Showing detail page about adoption thread
    * GET /post/{id}
    * id: integer, unique number of adoption thread
  */
  public function detail($id){
    $post = AdoptThread::where('id',$id)->first();

    if(!$post){
      return 404;
    }

    $data["detail"] = $post;
    $data["id"] = $id;
    $bidder = Adopting::where("post_id",$id)->get();

    //check if the post is belong to the session holder
    if($post->poster_id == \Session::get("id")){
      $data["bidder_count"] = $bidder->count();
    }
    else{
      if($bidder->where("bidder_id",\Session::get("id"))->count()){ //already bid
        $data["bidder_post"] = $bidder->where("bidder_id",\Session::get("id"))->first();
      }
    }

    return view("seeker.detail_post",$data);
  }

  /*
    * Handling bid request to adoption thread
    * POST /post/{id}
    * id: integer, unique number of adoption thread
  */
  public function apply($id,Request $r){
    $rules = array(
        'msg' => 'required',
    );

    $validator = \Validator::make($r->all(), $rules);

    if($validator->fails()){
        return \Redirect::back()->with(["error" => implode("\n",$validator->errors()->all())]);
    }

    $id_bid = \Session::get("id");
    $msg =  $r->input("msg");
    $cv = Adopting::firstOrNew(["bidder_id" => $id_bid, "post_id"=> $id]);
    $cv->message = $msg;
    $exists = $cv->exists;

    try{
      //$cv->save();

      if(!$exists){
        $owner_id = AdoptThread::select("poster_id")->where("id",$id)->first()->poster_id;
        $notif = new Notification();

        $notif->addNotification($owner_id,$id);
      }

      return \Redirect::back()->with(["success" => "success"]);
    }
    catch(\Exception $e){
      return \Redirect::back()->with(["error" => $e->getMessage()]);
    }

  }

  public function finder(){
    $data['category'] = PetCategory::where("parent_id",null)->get();
    $location = User::select("lati","longi")->where("id",\Session::get('id'))->first();
    $data['lati'] = $location->lati;
    $data['longi'] = $location->longi;

    return view("seeker.finder",$data);
  }

  public function finderAction(Request $r){
    $rules = array(
        'type' => 'nullable',
        'category' => 'required',
        'radius' => 'required|min:1|max:6',
        'lat' => 'required',
        'lng' => 'required',

    );

    $validator = \Validator::make($r->all(), $rules);

    if($validator->fails()){
        return \Redirect::back()->with(["error" => implode("\n",$validator->errors()->all())]);
    }

    $radius = $r->input("radius");
    $type = $r->input("type");
    $category = $r->input("category");
    $lat = $r->input("lat");
    $lng = $r->input("lng");

    $cate = ($type)? $type:$category;


    //get list of all category child
    if($cate == "*"){
      $cate = PetCategory::select("id")->where("parent_id",$category)->pluck("id")->toArray();
    }

    //haversine formula
    $distance_select = sprintf(
					                "ROUND(( 6371 * acos( cos( radians(%s) )" ." * cos( radians( lati ) )" .
					                        "* cos( radians( longi ) - radians(%s) )" .
					                        "+ sin( radians(%s) ) * sin( radians( lati ) )" .
					                    ")" .
					                "), 2 ) " ."AS distance",$lat,$lng,$lat);

  	$data = AdoptThread::select( \DB::raw("*" .",".  $distance_select) );

    if(is_array($cate)){
      $data = $data->whereIn("category_pet",$cate);
    }
    else{
      $data = $data->where("category_pet",$cate);
    }

    //\DB::enableQueryLog();
    $passing["data"] = $data->where("poster_id", '!=', \Session::get("id"))
                  ->where("status",1)
      					  ->having( 'distance', '<=', $radius )
      					  ->orderBy( 'distance', 'ASC' )
                  ->orderBy("post_date", 'ASC')
      					  ->get();
    //dd(\DB::getQueryLog());

    return view("seeker.search_result",$passing);

  }


}
