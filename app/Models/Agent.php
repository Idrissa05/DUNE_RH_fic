<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Agent extends Model {

	use SoftDeletes;

	protected $dates = ['deleted_at'];
	protected $fillable = array('matricule', 'nom', 'prenom', 'date_naiss', 'lieu_naiss', 'sexe', 'nationnalite', 'date_titularisation', 'ref_engagement', 'date_engagement', 'type', 'date_prise_service');

	public function conges()
	{
		return $this->hasMany('App\Models\Conge');
	}

	public function conjoints()
	{
		return $this->hasMany('App\Models\Conjoint');
	}

	public function affectations()
	{
		return $this->hasMany('App\Models\Affectation');
	}

	public function experiences()
	{
		return $this->hasMany('App\Models\Experience');
	}

	public function reclassements()
	{
		return $this->hasMany('App\Models\Reclassement');
	}

	public function retraite()
	{
		return $this->hasOne('App\Models\Retraite');
	}

	public function dece()
	{
		return $this->hasOne('App\Models\Dece');
	}

	public function enfants()
	{
		return $this->hasMany('App\Models\Enfant');
	}

	public function notations()
	{
		return $this->hasMany('App\Models\Notation');
	}

	public function formations()
	{
		return $this->hasMany('App\Models\Formation');
	}

	public function maladies()
	{
		return $this->belongsToMany('App\Models\Maladie')->withPivot('observation','date_observation')->withTimestamps();
	}

	public function matrimoniales()
	{
		return $this->belongsToMany('App\Models\Matrimoniale')->withPivot('date')->withTimestamps();
	}

    public function echelons()
    {
        return $this->belongsToMany('App\Models\Echelon')->withPivot('category_id', 'classe_id','ref_avancement','date_decision','observation');
    }

}
