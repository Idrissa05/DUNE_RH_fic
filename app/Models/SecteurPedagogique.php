<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SecteurPedagogique extends Model
{
    protected $fillable = ['name', 'inspection_id'];
    public $timestamps = false;

    public function etablissements()
    {
        return $this->hasMany('App\Models\Etablissement');
    }

    public function inpection()
    {
        return $this->belongsTo('App\Models\Inspection');
    }
}
