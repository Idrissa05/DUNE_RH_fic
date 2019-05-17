<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fonction extends Model
{
    protected $fillable = ['name'];
    public $timestamps = false;

    public function titulaire()
    {
        return $this->hasMany('App\Models\Titulaire');
    }
}
