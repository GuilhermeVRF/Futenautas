<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FootballPlayer extends Model
{
    protected $table = 'FootballPlayer';
    public $timestamps = false;

    public function footballTeam()
    {
        return $this->belongsTo(FootballTeam::class, 'footballTeam_id');
    }

    public function roundlineup(){
        return $this->hasMany(RoundLineup::class);
    }

    public function score(){
        return $this->hasMany(FootaballPlayerScore::class);
    }
}
