<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Echelon extends Model {

	protected $fillable = array('name');

    public function classe()
    {
        return $this->belongsTo('App\Models\Classe');
    }

    public function agents()
    {
        return $this->belongsToMany('App\Models\Agent')->withPivot('ref_avancement','date_decision','observation');
    }
}
