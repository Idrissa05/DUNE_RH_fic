<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Etablissement extends Model {

	protected $fillable = array('id','name','secteur_pedagogique_id','type_etablissement_id');
	public $timestamps = false;

	public function affectations()
	{
		return $this->hasMany('App\Models\Affectation');
	}

	public function secteurPedagogique()
	{
		return $this->belongsTo('App\Models\SecteurPedagogique');
	}

	public function typeEtablissement()
	{
		return $this->belongsTo('App\Models\TypeEtablissement');
	}

}
