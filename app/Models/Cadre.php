<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cadre extends Model
{
    protected $fillable = ['name','abreviation'];
    public $timestamps = false;

    public function agents()
    {
        return $this->hasMany('App\Models\Agent');
    }
}
