<?php

namespace App\Http\Controllers;

use App\Models\FootaballPlayerScore;
use App\Models\FootballTeam;
use App\Models\Round;
use Illuminate\Http\Request;

class FootballPlayerScoreController extends Controller
{

    public function index(Request $request){
        $filter = $request->filter ?? '1';
        $rounds = Round::orderBy('id', 'DESC')->get();
        $footballTeams = FootballTeam::all();
        $footballPlayerScores = FootaballPlayerScore::where('round_id', $request->round ?? $rounds[sizeof($rounds) - 1]['id'])
            ->join('footballplayer', 'footballplayerscore.footballplayer_id', '=','footballplayer.id')
            ->join('footballteam', 'footballplayer.footballteam_id', '=','footballteam.id')
            ->select('footballPlayer.name AS footballPlayer_name', 'footballPlayer.image', 'footballPlayer.position', 'score', 'footballTeam.name AS footballTeam_name', 'footballTeam.shield');

        if(!empty($request->filter)){
            $request->validate([
                'filter' => 'required|in:1,2,3,4'
            ],[
                'filter.required' => 'O campo filtro é obrigatório!',
                'filter.in' => 'A filtragem se aplica apenas por jogador, time ou posição!'
            ]);

            if($request->filter == '1'){
                $footballPlayerScores = $footballPlayerScores->orderBy('score', 'DESC')->get();
            }else if($request->filter == '2'){
                $request->validate([
                    'footballPlayer' => 'required|max:200'
                ],[
                    'footballPlayer.required' => 'O campo Jogador é obrigatório!',
                    'footballPlayer.max' => 'O campo jogador deve ter no máximo 200 caractéres!'
                ]);

                $footballPlayerScores = $footballPlayerScores->where('footballplayer.name', $request->footballPlayer)->orderBy('score', 'DESC')->get();
            }else if($request->filter == '3'){
                $request->validate([
                    'footballTeam' => 'required|in:1,2,3,4,5,6,7,8,9,10,11,12'
                ],[
                    'footballTeam.required' => 'O campo Time é obrigatório!',
                    'footballTeam.in' => 'Time de futebol escolhido inexistente!'
                ]);

                $footballPlayerScores = $footballPlayerScores->where('footballTeam.id', $request->footballTeam)->orderBy('score', 'DESC')->get();
            }else{
                $request->validate([
                    'position' => 'required|in:1,2,3,4,5'
                ],[
                    'position.required' => 'O campo Posição é obrigatório!',
                    'position.in' => 'Posição escolhida inexistente!'
                ]);

                $footballPlayerScores = $footballPlayerScores->where('footballplayer.position', $request->position)->orderBy('score', 'DESC')->get();
            }
        }else{
            $footballPlayerScores = $footballPlayerScores->get();
        }

        return view('roundLineup.score', compact('rounds',
        'footballPlayerScores',
        'footballTeams',
    'filter'));
    }


}
