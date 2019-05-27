<?php

namespace App\Models;

use Tightenco\Parental\HasParent;

class Contractuel extends Agent
{
    use HasParent;
    public function impersonate($agents){}
    protected $fillable = ['matricule','nom', 'prenom', 'date_naiss', 'lieu_naiss','ref_acte_naiss','date_etablissement_acte_naiss',
        'lieu_etablissement_acte_naiss','sexe','nationnalite','cadre_id','corp_id','date_prise_service'];

}
