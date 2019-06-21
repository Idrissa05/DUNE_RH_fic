<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Tightenco\Parental\HasChildren;

class Agent extends Model {

	use SoftDeletes;
    use HasChildren;

    protected $childTypes = [
        'Contractuel' => Contractuel::class,
        'Titulaire' => Titulaire::class,
        'Auxiliaire' => Auxiliaire::class
    ];
	protected $dates = ['deleted_at'];

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

	public function dece()
	{
		return $this->hasOne('App\Models\Dece');
	}

	public function enfants()
	{
		return $this->hasMany('App\Models\Enfant');
	}

	public function formations()
	{
		return $this->hasMany('App\Models\Formation');
	}

    public function grades()
    {
        return $this->hasMany('App\Models\Grade');
    }

    public function agent_migration()
    {
        return $this->hasOne('App\Models\AgentMigration');
    }

    public function retraite()
    {
        return $this->hasOne('App\Models\Retraite');
    }

    public function notations()
    {
        return $this->hasMany('App\Models\Notation');
    }

    public function fonction()
    {
        return $this->belongsTo('App\Models\Fonction');
    }

    public function cadre()
    {
        return $this->belongsTo('App\Models\Cadre');
    }

    public function corp()
    {
        return $this->belongsTo('App\Models\Corp');
    }

	public function maladies()
	{
		return $this->belongsToMany('App\Models\Maladie')->withPivot('observation','date_observation')->withTimestamps();
	}

	public function matrimoniales()
	{
		return $this->belongsToMany('App\Models\Matrimoniale')->withPivot('date')->withTimestamps();
	}

    public function positions()
    {
        return $this->belongsToMany('App\Models\Position')->withPivot('ref_decision','date_decision','date_effet','date_fin','observation')->withTimestamps();
    }

    public function getFullNameAttribute() {
	    return $this->nom .' '.$this->prenom;
    }
}
