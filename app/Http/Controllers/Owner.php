<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\AdoptThread;
use App\Model\PetCategory;
use App\Model\Gallery;
use Yajra\Datatables\Datatables;

class Owner extends Controller
{

  //Owner own thread
  public function list(){
    $data['id'] = \Session::get("id");
    return view("open_adopt.mypost",$data);
  }

  //Opening new thread of adoption
  public function newView(){
      $data['category'] = PetCategory::where("parent_id",null)->get();
      return view("open_adopt.open_adopt",$data);
  }

  //Process opening new thread of adoption
  public function new(Request $r){
      $rules = array(
          'title' => 'required|min:3',
          'desc' => 'required',
          'type' => 'nullable|numeric',
          'category' => 'required',
          'lat' => 'required',
          'lng' => 'required',
          'featured' => 'required',
          'image' => 'nullable',
          'gender' => 'required|min:0|max:1',
          'age' => 'required|min:0|max:360',
          'image.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
      );

      $validator = \Validator::make($r->all(), $rules);

      if($validator->fails()){
        return \Redirect::back()->with(["error" => $validator->errors()]);
      }
      $title = $r->input("title");
      $desc = $r->input("desc");
      $cate = $r->input("category");
      $lat = $r->input("lat");
      $lng = $r->input("lng");
      $gender = $r->input("gender");
      $age = $r->input("age");
      $files = $r->file("image");
      $featured = $r->input("featured");
      @$img_before_delete = json_decode($r->input("img_list"),true);

      $insert = new AdoptThread;
      $insert->title = $title;
      $insert->description = $desc;

      $insert->category_pet = $cate;
      if($r->has("type")) $insert->category_pet = $r->input("type");
      $insert->poster_id = \Session::get("id");
      $insert->lati = $lat;
      $insert->longi = $lng;
      $insert->status = 1;
      $insert->gender = $gender;
      $insert->age = $age;
      $insert->post_date = date('Y-m-d h:i:s',time());

      try{
        $insert->save();

        $id = md5($insert->id);
        $path = public_path()."/img/product/".$id."/";
        $url = array();

        if(($files) && (!empty($img_before_delete))){
          if(!in_array($featured,$img_before_delete)) $featured = $img_before_delete[0];


          foreach($files as $file){
              $name = $file->getClientOriginalName();
              $ext = $file->getClientOriginalExtension();

              if(in_array($name,$img_before_delete)){
                $filename = md5(time().$name).".".$ext;
                $file->move($path,$filename);

                if($featured == $name){
                  $url[] = array("open_adoption_id" => $insert->id,"link_name" => $id."/".$filename, "is_featured" => 1);
                }else{
                  $url[] = array("open_adoption_id" => $insert->id,"link_name" => $id."/".$filename, "is_featured" => 0);
                }

              }
          }
        }


        Gallery::insert($url);

        return \Redirect::to(url("/open"));
      }
      catch(\Exception $e){
        $msg = $e->getMessage();
        return \Redirect::back()->with(["error" => $msg]);
      }
  }

  //Edit thread of adoption
  public function editView($id){
      $data['category'] = PetCategory::where("parent_id",null)->get();
      $data['data'] = AdoptThread::find($id);
      $data['cate'] = PetCategory::find($data['data']->category_pet);
      $data['child'] = PetCategory::where("parent_id",$data['cate']->parent_id)->get();
      $data['img'] = Gallery::where("open_adoption_id",$id)->get();
      $data['img_list'] = $data['img']->map(function($item, $key){
        return $item->id;
      })->toJson();

      $data['img_id'] = ($data['img']->where("is_featured",1)->first())? $data['img']->where("is_featured",1)->first()->id: null;
      $data['img_mode'] = ($data['img_id'])? 0:1;

      if(!$data['data']){
        return \Redirect::to(url("/open"));
      }

      return view("open_adopt.edit_open_adopt",$data);
  }

  //Process editing thread of adoption
  public function edit(Request $r){
      $rules = array(
          'title' => 'required|min:3',
          'desc' => 'required',
          'type' => 'nullable|numeric',
          'category' => 'required',
          'lat' => 'required',
          'lng' => 'required',
          'gender' => 'required|min:0|max:1',
          'age' => 'required|min:0|max:360',
          'image' => 'nullable',
          'image.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
      );

      $validator = \Validator::make($r->all(), $rules);

      if($validator->fails()){
        return \Redirect::back()->with(["error" => $validator->errors()]);
      }


      $title = $r->input("title");
      $desc = $r->input("desc");
      $cate = $r->input("category");
      $lat = $r->input("lat");
      $lng = $r->input("lng");
      $age = $r->input("age");
      $gender = $r->input("gender");
      $mode = ($r->input("featuredMode"))? $r->input("featuredMode"): 0;
      $files = $r->file("image");
      @$img_bef = json_decode($r->input("img_before"),true);
      $featured = $r->input("featured");
      @$img_before_delete = json_decode($r->input("img_list"),true);

      $insert = AdoptThread::where("id",$r->input("id"))->where("poster_id",\Session::get("id"))->first();

      if(!$insert){
        return \Redirect::to(url("open"))->with(["error" => "Something fishy going on..."]);
      }

      $insert->title = $title;
      $insert->description = $desc;

      $insert->category_pet = $cate;
      if($r->has("type")) $insert->category_pet = $r->input("type");
      $insert->lati = $lat;
      $insert->age = $age;
      $insert->gender = $gender;
      $insert->longi = $lng;
      $insert->status = 1;

      try{
        $insert->save();

        $id = md5($insert->id);
        $path = public_path()."/img/product/".$id."/";
        $url = array();

        if(is_int($img_bef)) $img_bef = array($img_bef);
        $gal = Gallery::select("id")->where("open_adoption_id",$r->input("id"))->get()->toArray();

        if(!$img_bef){
          $img_bef = array();
        }

        $delete = array_map(function($ob) use($img_bef){
            if(!in_array($ob['id'],$img_bef)) return $ob['id'];
        },$gal);

        $delete = array_filter($delete);

        //delete bulk
        $data_delete = Gallery::whereIn("id",$delete);
        $delete_file = array();
        foreach($data_delete->get() as $a){
          $delete_file[] = public_path()."/img/product/".$a->link_name;
        }

        //delete real file
        \File::delete($delete_file);
        $data_delete->delete();
        //set all image featured flag to zero
        Gallery::where("open_adoption_id",$r->input("id"))->update(["is_featured" => 0]);

        //if featured mode selected from saved image
        if($mode == 0){
          //selected image must exist
          if(!in_array($featured,$delete)){

            //update the selected image
            Gallery::where("open_adoption_id",$r->input("id"))->where("id",$featured)->update(["is_featured" => 1]);

          }
        }

        if(($files) && (!empty($img_before_delete))){
          if( (!in_array($featured,$img_before_delete)) && ($mode == 1) ) $featured = $img_before_delete[0];


          foreach($files as $file){
              $name = $file->getClientOriginalName();
              $ext = $file->getClientOriginalExtension();

              if(in_array($name,$img_before_delete)){
                $filename = md5(time().$name).".".$ext;
                $file->move($path,$filename);

                if($featured == $name){
                  $url[] = array("open_adoption_id" => $insert->id,"link_name" => $id."/".$filename, "is_featured" => 1);
                }else{
                  $url[] = array("open_adoption_id" => $insert->id,"link_name" => $id."/".$filename, "is_featured" => 0);
                }

              }
          }
        }

        Gallery::insert($url);

        return \Redirect::to(url("/open"));
      }
      catch(\Exception $e){
        $msg = $e->getMessage();
        return \Redirect::back()->with(["error" => $msg]);
      }
  }

  //Get own adoption post ordered by status and date
  public function getPostAdoptionThread($id,$status){
    $data = AdoptThread::select("open_adoption.id as id",\DB::raw("COUNT(adopting.id) as interest"),"title",\DB::raw("DATE_FORMAT(post_date,'%d.%c.%Y') as date"),"age","gender","category_pet.name as pet")
            ->join("category_pet","category_pet","category_pet.id")
            ->leftJoin("adopting","adopting.post_id","open_adoption.id")
            ->where("poster_id",$id)
            ->where("open_adoption.status",$status)
            ->groupBy("open_adoption.id")
            ->orderBy("post_date","desc")
            ->orderBy("id","desc")
            ->get();

    return Datatables::of($data)
          ->addColumn("name",function($row){
            $gender = ($row->gender == 0)? trans("open_post/post.male"):trans("open_post/post.female");
            $age = $row->age." ".trans("open_post/post.age_unit");
            $ret = "<span style='display:block'>".$row->title."</span>";
            $ret .= "<span>".$age." | ".$gender." | ".$row->pet."</span>";
            return $ret;
          })
          ->addColumn("action",function($row){
            $ret = "<a class='action_button edit-link' href='".url("open_adopt/edit/".$row->id)."'>".trans("open_post/post.button_edit")."</a>";
            $ret .= "<a class='action_button delete-link' href='#!' data-link='".url("open_adopt/delete/".$row->id)."'>".trans("open_post/post.button_delete")."</a>";
            return $ret;
          })
          ->editColumn("id",function($row){
            $ret = '<label><input type="checkbox" name="ids[]" class="delete_ids" value="'.$row->id.'" /><span></span></label>';
            return $ret;
          })
          ->removeColumn("age")
          ->removeColumn("gender")
          ->removeColumn("pet")
          ->removeColumn("title")
          ->rawColumns(["name","action","id"])
          ->make(true);
  }

  //delete a single post_date
  public function singleDelete($id){
    $data = $this->getPostPoster($id,\Session::get("id"));

    if(!$data){
      return \Redirect::to(url("open"))->with(["error" => "Something fishy going on..."]);
    }

    try{
        $data->delete();
        return \Redirect::to(url("open"))->with(["success" => "Delete success"]);
    }
      catch(\Exception $e){
        return \Redirect::to(url("open"))->with(["error" => $e->getMessage()]);
    }
  }

  //delete mass post
  public function massDelete(Request $r){
    $ids = $r->input("ids");

    if(empty($ids)){
      return \Redirect::back()->with(["error" => "empty"]);
    }

    try{
      AdoptThread::where("status",1)->whereIn("id",$ids)->delete();

      return \Redirect::back()->with(["success" => "deleted"]);
    }
    catch(\Exception $e){
      return \Redirect::back()->with(["error" => $e->getMessage()]);
    }
  }


  private function getPostPoster($id,$poster_id){
    $data = AdoptThread::where("id",$id)->where("poster_id",$poster_id)->first();

    if(!$data) return false;

    return $data;
  }

  //get preview of post
  public function getPreviewPost(Request $r){
    $json = json_decode($r->data);

    if($json){
      $data = AdoptThread::select("open_adoption.id as id","title",\DB::raw("DATE_FORMAT(post_date,'%d.%c.%Y') as date"),"age","gender","category_pet.name as pet")
              ->join("category_pet","category_pet","category_pet.id")
              ->whereIn("open_adoption.id",$json)
              ->where("open_adoption.status",1)
              ->orderBy("id","desc")
              ->get()->toJson();
      return $data;
    }
    else{
      return null;
    }


  }


}
