<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class Notation extends Eloquent {

	use SoftDeletes;

	protected $dates = ['deleted_at'];
	protected $fillable = array('date_debut', 'date_fin', 'note', 'responsable', 'observation', 'agent_id');

	public function titulaire()
	{
		return $this->belongsTo('App\Models\Titulaire');
	}

}
