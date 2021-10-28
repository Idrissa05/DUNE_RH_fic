<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Commune extends Model
{
    protected $fillable = ['id','name', 'departement_id'];
    public $timestamps = false;

    public function getDateFormat(){
		return 'Y-m-d H:i:s.u';
	}

    public function inspections()
    {
        return $this->hasMany('App\Models\Inspection');
    }

    public function departement()
    {
        return $this->belongsTo('App\Models\Departement');
    }
}
