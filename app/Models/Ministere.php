<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ministere extends Model {

	protected $fillable = array('name', 'abreviation');

    public function getDateFormat(){
		return 'Y-m-d H:i:s.u';
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
