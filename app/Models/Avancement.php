<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Tightenco\Parental\HasParent;

class Avancement extends Model
{
    use HasParent;
    public function impersonate($agents){}
    protected $fillable = ['agent_id','category_id','classe_id','echelon_id','type','ref_avancement','date_decision_avancement','observation_avancement'];
}
