<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Retraite extends Model {

	use SoftDeletes;

	protected $dates = ['deleted_at'];
	protected $fillable = array('date', 'ref_decision', 'date_decision', 'observation', 'agent_id');

	public function titulaire()
	{
		return $this->belongsTo('App\Models\Titulaire');
	}

}
