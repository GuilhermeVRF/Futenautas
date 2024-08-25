<?php

namespace App\Http\Controllers;

use App\Models\FootaballPlayerScore;
use App\Models\FootballPlayer;
use Illuminate\Http\Request;
use App\Models\TeamPlayer;
use App\Models\Round;
use App\Models\RoundLineup;

class RoundController extends Controller
{
    public function index(){
        $round = Round::orderBy('id', 'DESC')->first()['id'];
        $rostered_players = RoundLineup::where('round_id', $round)->count();

        return view('administrator.round.index', compact('round','rostered_players'));
    }

    public function finishRound(){
        $round = Round::orderBy('id', 'DESC')->first()['id'];
        $rostered_players = FootballPlayer::all();
        foreach($rostered_players as $rostered_player){
            $footballPlayerScore = new FootaballPlayerScore;
            $footballPlayerScore->round_id = $round;
            $footballPlayerScore->footballplayer_id = $rostered_player['id'];
            $footballPlayerScore->score = rand(0,15);

            $footballPlayerScore->save();
        }

        return back()->with('success', 'Rodada finalizada com sucesso!');
    }
}
