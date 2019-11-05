<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cadre extends Model
{
    protected $fillable = ['id','name','abreviation'];
    public $timestamps = false;

    public function grades()
    {
        return $this->hasMany('App\Models\Grade');
    }
    public function agent_migrations()
    {
        return $this->hasMany('App\Models\AgentMigration');
    }
}
