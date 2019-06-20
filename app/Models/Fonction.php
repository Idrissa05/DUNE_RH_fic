<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fonction extends Model
{
    protected $fillable = ['name'];
    public $timestamps = false;

    public function agent()
    {
        return $this->hasMany('App\Models\Agent');
    }
    public function agent_migrations()
    {
        return $this->hasMany('App\Models\AgentMigration');
    }
}
