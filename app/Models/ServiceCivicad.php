<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Tightenco\Parental\HasParent;

class ServiceCivicad extends Grade
{
    use HasParent;

    public function getDateFormat(){
		return 'Y-m-d H:i:s.u';
		//return 'Y-m-d H:i';
	}
    
    public function impersonate($agents){}
    protected $fillable = ['agent_id','category_id','cadre_id','corp_id', 'programme_id' ,'fonction_id','type','ref_engagement','date_engagement'];
}
