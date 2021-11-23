<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Query extends Model {

	protected $fillable = array('name','sql','fields');
	public $timestamps = false;

	public function getDateFormat(){
		return 'Y-m-d H:i:s.u';
		//return 'Y-m-d H:i';
	}
}
