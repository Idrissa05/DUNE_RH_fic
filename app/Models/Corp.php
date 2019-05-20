<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Corp extends Model
{
    protected $fillable = ['name', 'abreviation','category_id'];
    public $timestamps = false;

    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }

    public function agents()
    {
        return $this->hasMany('App\Models\Agent');
    }
}
