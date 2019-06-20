<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Conjoint extends Model {

	use SoftDeletes;

	protected $dates = ['deleted_at', 'date_naiss'];
	protected $fillable = array('matricule','nom', 'prenom', 'date_naiss', 'lieu_naiss', 'sexe', 'nationnalite', 'tel', 'employeur', 'profession','ref_acte_mariage','agent_id');

	public function agent()
	{
		return $this->belongsTo('App\Models\Agent');
	}

}
