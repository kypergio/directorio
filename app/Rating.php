<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Rating extends Authenticatable
{
    protected $table = "ratings";

    public function from(){
        return $this->belongsTo("\App\User","fromuserid", "id");
    }
    public function to(){
        return $this->belongsTo("\App\User","touserid", "id");
    }
}
