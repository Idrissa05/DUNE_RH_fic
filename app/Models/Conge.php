<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Conge extends Model {

	use SoftDeletes;

	protected $dates = ['deleted_at'];
	protected $fillable = array('ref_decision', 'date_debut', 'date_fin', 'observation', 'agent_id');

	public function agent()
	{
		return $this->belongsTo('App\Models\Agent');
	}

}
