<?php

namespace App\Models;

use App\Config;
use App\Traits\Multiteamable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;
use Tightenco\Parental\HasChildren;
use Carbon\Carbon;

class Agent extends Model {

	use SoftDeletes;
    use HasChildren;
    use Multiteamable;

    protected $fillable = ['id'];

    protected $childTypes = [
        'Contractuel' => Contractuel::class,
		'Civicard' => Civicard::class,
        'Titulaire' => Titulaire::class,
        'Auxiliaire' => Auxiliaire::class
    ];
	protected $dates = ['deleted_at'];

	public function getDateFormat(){
		return 'Y-m-d H:i:s.u';
		//return 'Y-m-d H:i';
	}

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

    public function region()
    {
        return $this->belongsTo('App\Models\Region');
    }

    public function ministere()
    {
        return $this->belongsTo('App\Models\Ministere');
    }

	public function maladies()
	{
		return $this->belongsToMany('App\Models\Maladie')->withPivot('observation','date_observation')->withTimestamps();
	}

	public function matrimoniales()
	{
		return $this->belongsToMany('App\Models\Matrimoniale')->withPivot('date')->withTimestamps();
	}

	public function type_enseignements()
	{
		return $this->belongsToMany('App\Models\TypeEnseignement')->withPivot('date')->withTimestamps();
	}

    public function positions()
    {
        return $this->belongsToMany('App\Models\Position')->withPivot('ref_decision','date_decision','date_effet','date_fin','observation')->withTimestamps();
    }

    public function getFullNameAttribute() {
	    return $this->nom .' '.$this->prenom;
    }


    public function scopeRetraitable(Builder $query) {
	    $months = (Config::first()->age_retraite * 12) - 3;
	    $days = $months * 30;
	    return $query->whereRaw("DATEDIFF(CURDATE(), date_naiss) >= $days");
    }

	public function scopeNombreRetraitable(Builder $query) {
	    $months = (Config::first()->age_retraite * 12) - 3;
	    $days = $months * 30;
	    return $query->whereRaw("DATEDIFF(CURDATE(), date_naiss) >= $days")->count();
    }
}
