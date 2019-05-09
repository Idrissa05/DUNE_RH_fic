<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Diplome extends Model {

	protected $fillable = array('name');
	public $timestamps = false;

	public function formations()
	{
		return $this->hasMany('App\Models\Formation');
	}

}
