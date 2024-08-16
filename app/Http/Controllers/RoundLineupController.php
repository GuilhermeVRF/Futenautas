<?php

namespace App\Http\Controllers;

use App\Models\FootballPlayer;
use App\Models\Round;
use App\Models\RoundLineup;
use App\Models\TeamPlayer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoundLineupController extends Controller
{
    public function store(Request $request){
        $request->validate([
                'footballPlayer_id' => 'required'
            ],[
                'footballPlayer_id.required' => 'É obrigatório a escolha de um jogador!'
            ]);

        //Pegando o round atual
        $round = Round::orderBy('id', 'DESC')->first();

        // Pegando informações do jogador
        $footballPlayer = FootballPlayer::where('id', $request->footballPlayer_id)->first();
        $footballPlayer_position = $footballPlayer['position'];
        $teamPlayer = TeamPlayer::where('user_id', Auth::id())->first();


        // Verificar se já escalou os 11 jogadores
        $count_players = RoundLineup::where('teamPlayer_id', $teamPlayer['id'])
        ->where('round_id', $round['id'])->count();

        // Verificar se o jogador já está escalado
        $rostered_players = RoundLineup::where('teamPlayer_id', $teamPlayer['id'])
        ->where('round_id', $round['id'])->where('footballPlayer_id', $footballPlayer['id'])->first();

        if(!empty($rostered_players)){
            return back()->withErrors(['error' => 'Você já escalou esse jogador!']);
        }

        // Verificar quantos jogadores referente a posição estão escalados
        $count_position = RoundLineup::where('teamPlayer_id', $teamPlayer['id'])
        ->where('round_id', $round['id'])
        ->with('footballplayer')
        ->whereHas('footballplayer', function ($query) use($footballPlayer_position) {
            $query->where('position', $footballPlayer_position);
        })->count();

        if($count_position == $this->numbersPerPosition442($footballPlayer_position)){
            return back()->withErrors('error', 'Limite para essa posição atendido!');
        }

        if($count_players < 12 ){
            $roundLineup = new RoundLineup;
            $roundLineup->round_id = $round['id'];
            $roundLineup->footballPlayer_id = $footballPlayer['id'];
            $roundLineup->teamPlayer_id = $teamPlayer['id'];

            $roundLineup->save();
        }

        return back();
    }

    private function numbersPerPosition442($position): int {
        switch($position){
            case 'GL':
                return 1;
            break;

            case 'LAT':
                return 2;
            break;

            case 'DEF':
                return 2;
            break;

            case 'MEI':
                return 4;
            break;

            case 'ATA':
                return 2;
            break;
        }
    }
}
