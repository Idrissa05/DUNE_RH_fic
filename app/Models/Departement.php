<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Departement extends Model {

	protected $fillable = array('name', 'region_id');

	public function inspections()
	{
		return $this->hasMany('App\Models\Inspection');
	}

	public function region()
	{
		return $this->belongsTo('App\Models\Region');
	}

}
