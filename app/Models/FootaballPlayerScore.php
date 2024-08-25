<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FootaballPlayerScore extends Model
{
    protected $table = 'footballplayerscore';
    public $timestamps = false;

    public function footballPlayer(){
        return $this->belongsTo(FootaballPlayer::class);
    }
}
