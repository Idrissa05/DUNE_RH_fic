<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Tightenco\Parental\HasChildren;

class Grade extends Model
{
    use SoftDeletes;
    use HasChildren;

    protected $childTypes = [
        'Avancement' => Avancement::class,
        'Reclassement' => Reclassement::class,
        'Titularisation' => Titularisation::class,
        'Contrat' => Contrat::class,
        'Auxiliairement' => Auxiliairement::class
    ];
    protected $dates = ['deleted_at'];

    public function getDateFormat(){
		return 'Y-m-d H:i:s.u';
		//return 'Y-m-d H:i';
	}

    public function agent()
    {
        return $this->belongsTo('App\Models\Agent');
    }

    public function categoryAuxiliaire()
    {
        return $this->belongsTo('App\Models\CategoryAuxiliaire');
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

    public function programme()
    {
        return $this->belongsTo('App\Models\Programme');
    }

    public function indice()
    {
        return $this->belongsTo('App\Models\Indice');
    }

    public function agent_migrations()
    {
        return $this->hasMany('App\Models\AgentMigration');
    }
}
