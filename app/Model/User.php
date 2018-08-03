<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Model
{
  use SoftDeletes;

  protected $table = 'user';
	public $timestamps = false;
	protected $primaryKey = 'id';
	protected $fillable = ['username','password','email','verifyHash','active','registOn','name','bio','img','lati','longi','notif_new_bidder','notif_choosen','notif_new_post','forgotHash','lang'];
}
