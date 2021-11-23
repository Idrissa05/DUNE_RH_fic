<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

trait Multiteamable {

    protected static function bootMultiteamable() {
        static::creating(function ($model) {
            $model->created_by_region_id = auth()->user()->region_id;
            $model->created_by_ministere_id = auth()->user()->ministere_id;
        });
        static::addGlobalScope('RegionMinistry', function (Builder $builder) {
            if((auth()->user()->role != 'Administrateur') or (auth()->user()->ministere_id != 1)){
                return $builder->where('created_by_region_id', auth()->user()->region_id)->where('created_by_ministere_id', auth()->user()->ministere_id);
                return $builder->where('created_by_ministere_id', auth()->user()->ministere_id);
            }
        });
    }

}
