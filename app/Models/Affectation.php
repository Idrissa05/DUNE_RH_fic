<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Affectation extends Model {

    use SoftDeletes;

	protected $dates = ['deleted_at'];
	protected $fillable = array('ref', 'date', 'date_prise_effet', 'observation', 'agent_id', 'etablissement_id');

	public function agent()
	{
		return $this->belongsTo('App\Models\Agent');
	}

	public function etablissement()
	{
		return $this->belongsTo('App\Models\Etablissement');
	}

}
