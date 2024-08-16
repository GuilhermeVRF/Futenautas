<?php

namespace App\Http\Controllers;

use App\Models\FootballPlayer;
use App\Models\Round;
use App\Models\RoundLineup;
use App\Models\TeamPlayer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FootballPlayerController extends Controller
{
    public function index(){
        $teamInfo = TeamPlayer::getTeamInfo();
        $amount = TeamPlayer::where('user_id', Auth::id())->select('amount')->first()['amount'];
        $round = Round::orderBy('id', 'DESC')->first();
        $round_amount = $amount - RoundLineup::where('round_id', $round['id'])
        ->join('footballplayer', 'roundlineup.footballplayer_id', '=', 'footballplayer.id')
        ->sum('footballplayer.price');

        $footballPlayers = FootballPlayer::find(1)->with('footballTeam')->get();

        return view('players.index', compact(
        'footballPlayers',
        'teamInfo',
        'round_amount'));
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
