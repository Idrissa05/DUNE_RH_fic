<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AgentMigration extends Model {

	protected $fillable = array('agent_id', 'grade_id', 'matricule','type','cadre_id','corp_id','fonction_id');

    protected $dates = ['deleted_at'];

    public function agent()
    {
        return $this->belongsTo('App\Models\Agent');
    }
    public function cadre()
    {
        return $this->belongsTo('App\Models\Cadre');
    }
    public function corp()
    {
        return $this->belongsTo('App\Models\Corp');
    }
    public function fonction()
    {
        return $this->belongsTo('App\Models\Fonction');
    }
    public function grade()
    {
        return $this->belongsTo('App\Models\Grade');
    }
}
