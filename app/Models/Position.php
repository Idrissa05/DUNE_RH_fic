<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    protected $fillable = ['id','name'];
    public $timestamps = false;

    public function getDateFormat(){
		return 'Y-m-d H:i:s.u';
	}
    
    public function agents()
    {
        return $this->belongsToMany('App\Models\Agent')->withPivot('ref_decision','date_decision','date_effet','date_fin','observation')->withTimestamps();
    }
}
