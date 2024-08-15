<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeamPlayer extends Model
{
    protected $table = 'TeamPlayer';
    public $timestamps = false;

    public function roundLineup(){
        return $this->hasMany(RoundLineup::class);
    }
}
