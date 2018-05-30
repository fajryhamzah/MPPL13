<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AdoptThread extends Model
{
  use SoftDeletes;

  protected $table = 'open_adoption';
	public $timestamps = false;
	protected $primaryKey = 'id';
	protected $fillable = ['title','age','gender','description','poster_id','post_date','category_pet','lati','longi','status'];
}
