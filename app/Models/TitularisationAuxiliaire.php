<?php

namespace App\Models;

use Tightenco\Parental\HasParent;

class TitularisationAuxiliaire extends Grade
{
    use HasParent;
    public function impersonate($agents){}
    protected $fillable = ['agent_id','category_auxiliaire_id','type','ref_engagement','date_engagement','ref_titularisation','date_titularisation'];
}
