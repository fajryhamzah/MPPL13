<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{

  protected $table = 'gallery';
	public $timestamps = false;
	protected $primaryKey = 'id';
	protected $fillable = ['open_adoption_id','link_name','is_featured'];
}
