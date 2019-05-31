<?php

namespace App\Models;

use Tightenco\Parental\HasParent;

class Reclassement extends Grade
{
    use HasParent;
    public function impersonate($agents){}
    protected $fillable = ['agent_id','category_id','classe_id','echelon_id','ref_reclassement','date_reclassement','indice_id'];
}
