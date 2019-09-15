<?php

namespace App\Models;

use Tightenco\Parental\HasParent;

class Auxiliairement extends Grade
{
    use HasParent;
    public function impersonate($agents){}
    protected $fillable = ['agent_id','category_auxiliaire_id','cadre_id','corp_id','fonction_id','type','ref_engagement','date_engagement'];
}