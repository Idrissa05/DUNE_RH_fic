<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reclassement extends Model {

	use SoftDeletes;

	protected $dates = ['deleted_at'];
	protected $fillable = array('ref', 'date', 'angent_id');

	public function agent()
	{
		return $this->belongsTo('App\Models\Agent');
	}

}
