<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Adopting extends Model
{

  protected $table = 'adopting';
	public $timestamps = false;
	protected $primaryKey = 'id';
	protected $fillable = ['post_id','bidder_id','message','status'];
}
