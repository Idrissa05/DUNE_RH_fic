<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Tightenco\Parental\HasParent;

class Engagement extends Model
{
    use HasParent;
    public function impersonate($agents){}
    protected $fillable = ['agent_id','category_id','classe_id','echelon_id','type','ref_engagement','date_engagement'];
}
