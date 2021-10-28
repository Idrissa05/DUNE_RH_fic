<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Indice extends Model
{
    protected $fillable = ['name', 'value','salary','category_id', 'classe_id', 'echelon_id'];
    public $timestamps = false;

    public function getDateFormat(){
		return 'Y-m-d H:i:s.u';
	}

    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }

    public function classe()
    {
        return $this->belongsTo('App\Models\Classe');
    }

    public function echelon()
    {
        return $this->belongsTo('App\Models\Echelon');
    }
}
