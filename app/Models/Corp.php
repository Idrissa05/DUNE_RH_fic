<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Corp extends Model
{
    protected $fillable = ['id','name', 'abreviation','category_id'];
    
    public $timestamps = false;

    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }

    public function grades()
    {
        return $this->hasMany('App\Models\Grade');
    }

    public function agent_migrations()
    {
        return $this->hasMany('App\Models\AgentMigration');
    }
}
