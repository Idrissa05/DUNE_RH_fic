<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model {

	protected $fillable = array('name');

    public function classes()
    {
        return $this->hasMany('App\Models\Classe');
    }

}
