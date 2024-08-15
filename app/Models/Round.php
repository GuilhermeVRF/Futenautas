<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Round extends Model
{
    protected $table = 'Round';
    public $timestamps = false;

    public function roundLineup(){
        return $this->hasMany(RoundLineup::class);
    }

    public function footballPlayerScores(){
        return $this->hasMany(FootaballPlayerScore::class);
    }
}
