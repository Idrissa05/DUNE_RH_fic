<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Echelon extends Model {

	protected $fillable = ['name', 'classe_id', 'description'];
	public $timestamps = false;

    public function classe()
    {
        return $this->belongsTo('App\Models\Classe');
    }

    public function agents()
    {
        return $this->belongsToMany('App\Models\Agent')->withPivot('category_id', 'classe_id','ref_avancement','date_decision','observation');
    }
}
