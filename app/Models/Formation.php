<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Formation extends Model {

	use SoftDeletes;

	protected $dates = ['deleted_at', 'date_debut', 'date_fin'];
	protected $fillable = array('date_debut', 'date_fin', 'agent_id', 'ecole_formation_id', 'diplome_id', 'niveau_etude_id', 'equivalence_diplome_id');

	public function agent()
	{
		return $this->belongsTo('App\Models\Agent');
	}

	public function ecoleFormation()
	{
		return $this->belongsTo('App\Models\EcoleFormation');
	}

	public function diplome()
	{
		return $this->belongsTo('App\Models\Diplome');
	}

	public function niveauEtude()
	{
		return $this->belongsTo('App\Models\NiveauEtude');
	}

	public function equivalenceDiplome()
	{
		return $this->belongsTo('App\Models\EquivalenceDiplome');
	}

}
