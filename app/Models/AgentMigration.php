<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AgentMigration extends Model {

	protected $fillable = array('agent_id', 'grade_id', 'matricule','type');

    protected $dates = ['deleted_at'];

    public function getDateFormat(){
		return 'Y-m-d H:i:s.u';
		//return 'Y-m-d H:i';
	}

    public function agent()
    {
        return $this->belongsTo('App\Models\Agent');
    }
    
    public function grade()
    {
        return $this->belongsTo('App\Models\Grade');
    }
}
