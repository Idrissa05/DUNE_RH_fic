<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Tightenco\Parental\HasParent;

class Titularisation extends Grade
{
    use HasParent;

    public function getDateFormat(){
		return 'Y-m-d H:i:s.u';
	}
    
    public function impersonate($agents){}
    protected $fillable = ['agent_id','category_id','classe_id','echelon_id','cadre_id','corp_id','fonction_id', 'programme_id' ,'type','ref_titularisation','date_titularisation','ref_engagement','date_engagement','indice_id'];
}
