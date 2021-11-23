<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NiveauEtude extends Model {

	protected $fillable = array('id','name');
	public $timestamps = false;

	public function getDateFormat(){
		return 'Y-m-d H:i:s.u';
		//return 'Y-m-d H:i';
	}

	public function formations()
	{
		return $this->hasMany('App\Models\Formation');
	}
	public function diplomes()
	{
		return $this->hasMany('App\Models\Diplome');
	}

}
