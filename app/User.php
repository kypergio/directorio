<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'type',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /*protected $with = ["avgRating"];*/

    public function ratings(){
        return $this->hasMany("\App\Rating", "touserid","id");
    }

    public function avgRating()
    {
        return $this->ratings()
            ->selectRaw('touserid,avg(rating) as avg')
            ->groupBy('touserid');
    }

}
