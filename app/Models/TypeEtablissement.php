<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TypeEtablissement extends Model {

	protected $fillable = array('id','name');
	public $timestamps = false;

	public function etablissements()
	{
		return $this->hasMany('App\Models\Etablissement');
	}

}
