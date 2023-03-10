<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Dece extends Model {

	use SoftDeletes;

	protected $dates = ['deleted_at'];

	protected $fillable = array('date', 'ref_document', 'observation', 'agent_id');

	public function getDateFormat(){
		return 'Y-m-d H:i:s.u';
		//return 'Y-m-d H:i';
	}
	
	public function agent()
	{
		return $this->belongsTo('App\Models\Agent');
	}

}
