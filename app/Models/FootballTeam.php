<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FootballTeam extends Model
{
    protected $table = 'FootballTeam';
    public $timestamps = false;

    public function footballPlayer()
    {
        return $this->hasMany(FootballPlayer::class);
    }

    public function user()
    {
        return $this->hasMany(User::class);
    }
}
