<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inspection extends Model {

	protected $fillable = array('name', 'departement_id');
	public $timestamps = false;

	public function etablissements()
	{
		return $this->hasMany('App\Models\Etablissement');
	}

	public function departement()
	{
		return $this->belongsTo('App\Models\Departement');
	}

}
