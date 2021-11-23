<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Programme extends Model
{
    protected $fillable = ['name'];
    
    public $timestamps = false;

    public function getDateFormat(){
		return 'Y-m-d H:i:s.u';
		//return 'Y-m-d H:i';
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
