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
    public function index(){
        $teamInfo = TeamPlayer::getTeamInfo();
        $amount = TeamPlayer::where('user_id', Auth::id())->select('amount')->first()['amount'];
        $round = Round::orderBy('id', 'DESC')->first()['id'];

        $round_amount = $amount - RoundLineup::where('round_id', $round)
        ->join('footballplayer', 'roundlineup.footballplayer_id', '=', 'footballplayer.id')
        ->where('teamPlayer_id', $teamInfo['id'])
        ->sum('footballplayer.price');

        $roundLineups = RoundLineup::where('teamPlayer_id', $teamInfo['id'])
        ->where('round_id', $round)
        ->join('footballplayer', 'roundLineup.footballplayer_id', '=', 'footballplayer.id')
        ->orderBy('footballplayer.position')
        ->select('roundLineup.id', 'footballplayer.name', 'footballplayer.price', 'footballplayer.position')
        ->get();

        return view('roundLineup.index' , compact('teamInfo',
        'round_amount',
        'round',
        'roundLineups'
        ));
    }

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


        return back()->with('success', 'Jogador escalado com sucesso!');;
    }

    public function destroy(Request $request){
        $request->validate([
            'roundLineup_id' => 'required'
        ],[
            'roundLineup_id.required' => 'É obrigatório a escolha de um jogador!'
        ]);

        $roundLineup = RoundLineup::where('id', $request->roundLineup_id)->first();
        $deleted = $roundLineup->delete();

        if($deleted == true){
            return back()->with('success', 'Jogador removido com sucesso!');
        }else{
            return back()->withErrors('error', 'Não foi possivel remover esse jogador!');
        }
    }

    private function numbersPerPosition442($position): int {
        switch($position){
            case '1':
                return 1;
            break;

            case '2':
                return 2;
            break;

            case '3':
                return 2;
            break;

            case '4':
                return 4;
            break;

            case '5':
                return 2;
            break;
        }
    }
}
