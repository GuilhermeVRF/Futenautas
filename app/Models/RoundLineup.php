<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoundLineup extends Model
{
    protected $table = 'RoundLineup';
    public $timestamps = false;

    public function round(){
        return $this->belongsTo(RoundLineup::class);
    }
}
