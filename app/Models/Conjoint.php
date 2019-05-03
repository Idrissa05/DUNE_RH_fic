<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Conjoint extends Model {

	use SoftDeletes;

	protected $dates = ['deleted_at'];
	protected $fillable = array('nom', 'prenom', 'date_naiss', 'lieu_naiss', 'sexe', 'nationnalite', 'tel', 'employeur', 'profession', 'agent_id');

	public function agent()
	{
		return $this->belongsTo('App\Models\Agent');
	}

}
