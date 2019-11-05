<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inspection extends Model {

	protected $fillable = array('id','name', 'commune_id');
	public $timestamps = false;

	public function secteurPedagogiques()
	{
		return $this->hasMany('App\Models\SecteurPedagogique');
	}

	public function commune()
	{
		return $this->belongsTo('App\Models\Commune');
	}

}
