<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Departement extends Model {

	protected $fillable = array('name', 'region_id');

	public function communes()
	{
		return $this->hasMany('App\Models\Commune');
	}

	public function region()
	{
		return $this->belongsTo('App\Models\Region');
	}

}
