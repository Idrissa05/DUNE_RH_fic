<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Classe extends Model {

	protected $fillable = ['name', 'description'];

	public $timestamps = false;

    public function getDateFormat(){
		return 'Y-m-d H:i:s.u';
		//return 'Y-m-d H:i';
	}

    public function echelons()
    {
        return $this->hasMany('App\Models\Echelon');
    }

    public function indices()
    {
        return $this->hasMany('App\Models\Indice');
    }

    public function grades()
    {
        return $this->hasMany('App\Models\Grade');
    }

}
