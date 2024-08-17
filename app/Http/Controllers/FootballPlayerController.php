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
    public function index(Request $request){
        $teamInfo = TeamPlayer::getTeamInfo();
        $amount = TeamPlayer::where('user_id', Auth::id())->select('amount')->first()['amount'];
        $round = Round::orderBy('id', 'DESC')->first()['id'];

        $round_amount = $amount - RoundLineup::where('round_id', $round)
        ->join('footballplayer', 'roundlineup.footballplayer_id', '=', 'footballplayer.id')
        ->where('teamPlayer_id', $teamInfo['id'])
        ->sum('footballplayer.price');

        $roundLineup_count = RoundLineup::where('round_id', $round)
        ->where('teamPlayer_id', $teamInfo['id'])
        ->count();

        if(empty($request->filter) || $request->filter == 'all'){
            $footballPlayers = FootballPlayer::find(1)->with('footballTeam')->get();
        }else{
            $request->validate([
                'filter' => 'required|in:all,1,2,3,4,5'
            ],[
                'filter.required' => 'O campo filtro de posição é obrigatório!',
                'filter.in' => 'O filtro é aplicado apenas para as posições GOL,LAT,DEF,MEI,ATA!'
            ]);
            $footballPlayers = FootballPlayer::where('position', $request->filter)->with('footballTeam')->get();
        }

        return view('players.index', compact(
        'footballPlayers',
        'teamInfo',
        'round_amount',
        'round',
        'roundLineup_count'
    ));
    }
}
