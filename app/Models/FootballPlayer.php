<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FootballPlayer extends Model
{
    protected $table = 'FootballPlayer';
    public $timestamps = false;

    public function footBallTeam()
    {
        return $this->belongsTo(FootballTeam::class);
    }

    public function roundLineup(){
        return $this->hasMany(RoundLineup::class);
    }

    public function score(){
        return $this->hasMany(FootaballPlayerScore::class);
    }
}
