<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Notation extends Model {

	use SoftDeletes;

	protected $dates = ['deleted_at'];

	protected $fillable = array('date_debut', 'date_fin', 'note_pedagogique', 'note_adminitratif', 'responsable', 'observation', 'agent_id');

	public function getDateFormat(){
		return 'Y-m-d H:i:s.u';
	}
	
	public function agent()
	{
		return $this->belongsTo('App\Models\Agent');
	}

}
