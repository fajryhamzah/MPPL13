<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class PetCategory extends Model
{
  protected $table = 'category_pet';
	public $timestamps = false;
	protected $primaryKey = 'id';
	protected $fillable = ['name','parent_id'];
}
