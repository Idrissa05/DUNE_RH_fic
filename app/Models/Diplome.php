<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Diplome extends Model {

	protected $fillable = ['id','name', 'equivalence_diplome_id', 'niveau_etude_id'];
	public $timestamps = false;

	public function getDateFormat(){
		return 'Y-m-d H:i:s.u';
		//return 'Y-m-d H:i';
	}

	public function formations()
	{
		return $this->hasMany('App\Models\Formation');
	}
	public function equivalenceDiplome()
	{
		return $this->belongsTo('App\Models\EquivalenceDiplome');
	}
	public function niveauEtude()
	{
		return $this->belongsTo('App\Models\NiveauEtude');
	}

}
