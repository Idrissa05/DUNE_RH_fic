<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoryAuxiliaire extends Model {

	protected $fillable = array('name');
	public $timestamps = false;

    public function grades()
    {
        return $this->hasMany('App\Models\Grade');
    }
}
