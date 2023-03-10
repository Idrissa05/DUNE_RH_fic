<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Matrimoniale extends Model {

	protected $fillable = array('id','name');
	public $timestamps = false;

	public function getDateFormat(){
		return 'Y-m-d H:i:s.u';
		//return 'Y-m-d H:i';
	}

	public function agents()
	{
		return $this->belongsToMany('App\Models\Agent')->withPivot('date')->withTimestamps();
	}

}
