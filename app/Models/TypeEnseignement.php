<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TypeEnseignement extends Model
{
    protected $fillable = array('id','name');
	public $timestamps = false;

	public function agents()
	{
		return $this->belongsToMany('App\Models\Agent')->withPivot('date')->withTimestamps();
	}
}
