<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Region extends Model {

	protected $fillable = array('name');

    public function getDateFormat(){
		return 'Y-m-d H:i:s.u';
	}

	public function departements()
	{
		return $this->hasMany('App\Models\Departement');
	}

    public function agent()
    {
        return $this->hasMany('App\Models\Agent');
    }

    public function user()
    {
        return $this->hasMany('App\User');
    }

}
