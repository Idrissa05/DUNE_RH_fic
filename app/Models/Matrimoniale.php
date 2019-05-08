<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Matrimoniale extends Model {

	protected $fillable = array('name');
	public $timestamps = false;

	public function agents()
	{
		return $this->belongsToMany('App\Models\Agent')->withPivot('date')->withTimestamps();
	}

}
