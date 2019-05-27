<?php

namespace App\Models;

use Tightenco\Parental\HasParent;

class Contrat extends Grade
{
    use HasParent;
    public function impersonate($agents){}
    protected $fillable = ['agent_id','category_id','ref_engagement','date_engagement'];
}
