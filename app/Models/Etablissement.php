<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Etablissement extends Model {

	protected $fillable = array('name', 'inspection_id', 'localite_id', 'type_etablissement_id');
	public $timestamps = false;

	public function affectations()
	{
		return $this->hasMany('App\Models\Affectation');
	}

	public function inspection()
	{
		return $this->belongsTo('App\Models\Inspection');
	}

	public function localite()
	{
		return $this->belongsTo('App\Models\Localite');
	}

	public function typeEtablissement()
	{
		return $this->belongsTo('App\Models\TypeEtablissement');
	}

}
