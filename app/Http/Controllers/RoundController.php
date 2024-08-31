<?php

namespace App\Http\Controllers;

use App\Models\FootaballPlayerScore;
use App\Models\FootballPlayer;
use Illuminate\Http\Request;
use App\Models\TeamPlayer;
use App\Models\Round;
use App\Models\RoundLineup;
use DateInterval;
use DateTime;

class RoundController extends Controller
{
    public function index(){
        $round = Round::orderBy('id', 'DESC')->first()['id'];
        $rostered_players = RoundLineup::where('round_id', $round)->count();

        return view('administrator.round.index', compact('round','rostered_players'));
    }

    public function finishRound(){
        $actualRound = Round::orderBy('id', 'DESC')->first();
        $actualRound_id = $actualRound['id'];
        $actualRound_endDate = new DateTime($actualRound['endDate']);

        $rostered_players = FootballPlayer::all();
        foreach($rostered_players as $rostered_player){
            $footballPlayerScore = new FootaballPlayerScore;
            $footballPlayerScore->round_id = $actualRound_id;
            $footballPlayerScore->footballplayer_id = $rostered_player['id'];
            $footballPlayerScore->score = rand(0,15);

            $footballPlayerScore->save();
        }

        $nextRound = new Round;
        $nextRound_startDate = date_add($actualRound_endDate, new DateInterval('P'.rand(3,6).'D'));
        $nextRound->startDate = $nextRound_startDate->format('Y-m-d');
        $nextRound_endDate = date_add($nextRound_startDate, new DateInterval('P'.rand(3,4).'D'));
        $nextRound->endDate = $nextRound_endDate->format('Y-m-d');;
        $nextRound->save();

        return back()->with('success', 'Rodada finalizada com sucesso!');
    }
}
