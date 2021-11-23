<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model {

	protected $fillable = array('name');
    
	public $timestamps = false;

    public function getDateFormat(){
		return 'Y-m-d H:i:s.u';
		//return 'Y-m-d H:i';
	}

    public function corps()
    {
        return $this->hasMany('App\Models\Corp');
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
