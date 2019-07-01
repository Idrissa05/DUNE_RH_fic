<?php

namespace App\Models;

use Tightenco\Parental\HasParent;

class Contractuel extends Agent
{
    use HasParent;
    public function impersonate($agents){}
    protected $fillable = ['matricule','nom', 'prenom', 'date_naiss', 'lieu_naiss','ref_acte_naiss','date_etablissement_acte_naiss',
        'lieu_etablissement_acte_naiss','sexe','nationnalite','type','date_prise_service','created_by_region_id', 'created_by_ministere_id'];
}
