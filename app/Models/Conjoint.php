<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Conjoint extends Model {

	use SoftDeletes;

	protected $dates = ['deleted_at'];

	protected $fillable = array('matricule','nom', 'prenom', 'date_naiss','ref_acte_naiss','lieu_naiss', 'sexe', 'nationnalite', 'tel', 'employeur', 'profession','ref_acte_mariage','date_mariage','agent_id');

	public function getDateFormat(){
		return 'Y-m-d H:i:s.u';
	}
	
	public function agent()
	{
		return $this->belongsTo('App\Models\Agent');
	}

}
