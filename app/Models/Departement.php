<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Departement extends Model {

	protected $fillable = array('id','name', 'region_id');

    public $timestamps = false;

	public function getDateFormat(){
		return 'Y-m-d H:i:s.u';
		//return 'Y-m-d H:i';
	}

	public function communes()
	{
		return $this->hasMany('App\Models\Commune');
	}

	public function region()
	{
		return $this->belongsTo('App\Models\Region');
	}

}
