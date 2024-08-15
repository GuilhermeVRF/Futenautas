<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    public $timestamps = false;

    public function heartFootballTeam()
    {
        return $this->belongsTo(FootballTeam::class);
    }

}
