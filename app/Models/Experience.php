<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Experience extends Model {

	use SoftDeletes;

	protected $dates = ['deleted_at'];
	protected $fillable = array('organisation', 'date_debut', 'date_fin', 'fonction', 'tache', 'observation', 'agent_id');

	public function agent()
	{
		return $this->belongsTo('App\Models\Agent');
	}

}
