<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Enfant extends Model {

	use SoftDeletes;

	protected $dates = ['deleted_at', 'date_naiss'];
	protected $fillable = array('prenom', 'date_naiss', 'lieu_naiss', 'sexe', 'agent_id');

	public function agent()
	{
		return $this->belongsTo('App\Models\Agent');
	}

}
