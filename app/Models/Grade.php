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
        'Titularisation' => Titulaire::class,
        'Engagement' => Engagement::class
    ];
    protected $dates = ['deleted_at'];

    public function agent()
    {
        return $this->belongsTo('App\Models\Agent');
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
