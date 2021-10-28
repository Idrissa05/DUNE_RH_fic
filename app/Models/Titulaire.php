<?php

namespace App\Models;

use Tightenco\Parental\HasParent;

class Titulaire extends Agent
{
    use HasParent;

    public function getDateFormat(){
		return 'Y-m-d H:i:s.u';
	}
    
    public function impersonate($agents){}
    protected $fillable = ['matricule','nom', 'prenom', 'date_naiss', 'telephone', 'lieu_naiss','ref_acte_naiss','date_etablissement_acte_naiss',
        'lieu_etablissement_acte_naiss','sexe','nationnalite','type','created_by_region_id', 'created_by_ministere_id'];
}
