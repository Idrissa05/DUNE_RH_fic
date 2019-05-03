<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EquivalenceDiplome extends Model {

	protected $fillable = array('name');

	public function formations()
	{
		return $this->hasMany('App\Models\Formation');
	}

}
