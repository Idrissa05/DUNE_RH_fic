<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SecteurPedagogique extends Model
{
    protected $fillable = ['id','name', 'inspection_id'];
    public $timestamps = false;

    public function etablissements()
    {
        return $this->hasMany('App\Models\Etablissement');
    }

    public function inspection()
    {
        return $this->belongsTo('App\Models\Inspection');
    }
}
