<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Model\AdoptThread;
use App\Model\PetCategory;
use App\Model\Gallery;

class Seeker extends Controller
{

  public function finder(){
    $data['category'] = PetCategory::where("parent_id",null)->get();
    return view("seeker.finder",$data);
  }


}
