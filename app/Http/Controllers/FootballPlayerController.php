<?php

namespace App\Http\Controllers;

use App\Models\FootballPlayer;
use App\Models\TeamPlayer;
use Illuminate\Http\Request;
use App\Models\Image;

class FootballPlayerController extends Controller
{
    public function index(){
        $teamInfo = TeamPlayer::getTeamInfo();
        $footballPlayers = FootballPlayer::find(1)->with('footballTeam')->get();

        return view('players.index', compact('footballPlayers', 'teamInfo'));
    }

    public function show(Request $request){
        $teamInfo = TeamPlayer::getTeamInfo();
        $request->validate([
            'filter' => 'required|in:all,GL,LAT,DEF,MEI,ATA'
        ],[
            'filter.required' => 'O campo filtro de posição é obrigatório!',
            'filter.in' => 'O filtro é aplicado apenas para as posições GOL,LAT,DEF,MEI,ATA!'
        ]);

        if($request->filter != 'all'){
            $footballPlayers = FootballPlayer::where('position', $request->filter)->with('footballTeam')->get();
        }else{
            $footballPlayers = FootballPlayer::find(1)->with('footballTeam')->get();;
        }

        return view('players.index', compact('footballPlayers','teamInfo'));
    }
}
