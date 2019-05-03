<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Classe extends Model {

	protected $fillable = array('name');

    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }

    public function echelons()
    {
        return $this->hasMany('App\Models\Echelon');
    }

}
