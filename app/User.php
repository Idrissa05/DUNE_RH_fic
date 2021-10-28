<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'password', 'region_id', 'ministere_id','verifier_login'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getDateFormat(){
		return 'Y-m-d H:i:s.u';
	}

    protected $with = ['region', 'ministere'];

    public function region()
    {
        return $this->belongsTo('App\Models\Region');
    }

    public function ministere()
    {
        return $this->belongsTo('App\Models\Ministere');
    }

    public function getRoleAttribute() {
        return $this->roles()->first()->name ?? null;
    }
}
