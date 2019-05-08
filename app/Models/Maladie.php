<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Maladie extends Model {

	protected $fillable = array('name');
	public $timestamps = false;

	public function agents()
	{
		return $this->belongsToMany('App\Models\Agent')->withPivot('observation','date_observation')->withTimestamps();
	}

}
