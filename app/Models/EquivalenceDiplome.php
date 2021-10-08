<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EquivalenceDiplome extends Model {

	protected $fillable = array('id','name');
	public $timestamps = false;

	public function formations()
	{
		return $this->hasMany('App\Models\Formation');
	}
	public function diplomes()
	{
		return $this->hasMany('App\Models\Diplome');
	}

}
