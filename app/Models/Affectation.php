<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Affectation extends Model {

    use SoftDeletes;

	protected $dates = ['deleted_at'];

	protected $fillable = array('ref', 'type_ref', 'date', 'date_prise_effet', 'observation', 'agent_id', 'etablissement_id');
	
	public function getDateFormat(){
		return 'Y-m-d H:i:s.u';
		//return 'Y-m-d H:i';
	}
	
	public function agent()
	{
		return $this->belongsTo('App\Models\Agent');
	}

	public function etablissement()
	{
		return $this->belongsTo('App\Models\Etablissement');
	}

}
