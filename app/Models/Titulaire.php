<?php

namespace App\Models;

use Tightenco\Parental\HasParent;

class Titulaire extends Agent
{
    use HasParent;
    public function impersonate($agents){}
    protected $fillable = ['matricule','nom', 'prenom', 'date_naiss', 'lieu_naiss','ref_acte_naiss','date_etablissement_acte_naiss',
        'lieu_etablissement_acte_naiss','sexe','nationnalite','cadre_id','corp_id','type','fonction_id'];

    public function fonction()
    {
        return $this->belongsTo('App\Models\Fonction');
    }

    public function retraite()
    {
        return $this->hasOne('App\Models\Retraite');
    }

    public function notations()
    {
        return $this->hasMany('App\Models\Notation');
    }
}
