<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class TeamPlayer extends Model
{
    protected $table = 'TeamPlayer';
    public $timestamps = false;

    public function roundLineup(){
        return $this->hasMany(RoundLineup::class);
    }

    public static function getTeamInfo(){
        if(Auth::check()){
            $team_info = TeamPlayer::where('user_id', Auth::id())->select('id','logo', 'name', 'color')->first();
            return [
                'id' => $team_info['id'],
                'logo' => 'data:image/jpeg;base64,' . base64_encode($team_info['logo']),
                'name' => $team_info['name'],
                'color' => $team_info['color']
            ];
        }else{
            return ['id' => '', 'logo' => '', 'name' => '', 'color' => ''];
        }
    }
}
