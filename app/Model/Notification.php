<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
  protected $table = 'notification';
	public $timestamps = false;
	protected $primaryKey = 'id';
	protected $fillable = ['id_target','id_post','type','seen'];
}
