<?php

namespace App\Models;

use Tightenco\Parental\HasParent;

class Avancement extends Grade
{
    use HasParent;
    public function impersonate($agents){}
    protected $fillable = ['agent_id','category_id','classe_id','echelon_id','ref_avancement','date_decision_avancement','observation_avancement','indice_id'];
}
