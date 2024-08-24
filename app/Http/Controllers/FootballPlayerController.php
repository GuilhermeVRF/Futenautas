<?php

namespace App\Http\Controllers;

use App\Models\FootballPlayer;
use App\Models\FootballTeam;
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
            $footballPlayers = FootballPlayer::with('footballTeam')
            ->orderBy('position')->get();
        }else{
            $request->validate([
                'filter' => 'required|in:all,1,2,3,4,5'
            ],[
                'filter.required' => 'O campo filtro de posição é obrigatório!',
                'filter.in' => 'O filtro é aplicado apenas para as posições GOL,LAT,DEF,MEI,ATA!'
            ]);

            $footballPlayers = FootballPlayer::where('position', $request->filter)->with('footballTeam')
            ->orderBy('position')->get();
        }

        return view('players.index', compact(
        'footballPlayers',
        'teamInfo',
        'round_amount',
        'round',
        'roundLineup_count'
    ));
    }

    public function create(){
        $footballTeams = $footballTeams = FootballTeam::all()->select('id', 'name');
        return view('administrator.footballPlayer.create', compact('footballTeams'));
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required|max:200',
            'nacionality' => 'required|max:100',
            'birthDate' => 'required|date',
            'footballTeam' => 'required|in:1,2,3,4,5,6,7,8,9,10,11,12',
            'position' => 'required|in:1,2,3,4,5',
            'playerImage' => 'required|image|max:2048'
        ],[
            'name.required' => 'O campo nome é obrigatório!',
            'name.max' => 'O campo nome deve ter no máximo 200 caractéres!',
            'nacionality.required' => 'O campo nacionalidade é obrigatório!',
            'nacionality.max' => 'O campo nacionalidade deve ter no máximo 200 caractéres!',
            'birthDate.required' => 'O campo data de nascimento é obrigatório!',
            'birthDate.date' => 'Não foi informado uma data de nascimento válida!',
            'footballTeam.required' => 'O campo time é obrigatório!',
            'footballTeam.in' => 'Time de futebol escolhido inexistente!',
            'position.required' =>'O campo posição é obrigatório!',
            'position.in' => 'Posição inexistente!',
            'playerImage.required' => 'O campo imagem do jogador é obrigatório!',
            'playerImage.image' => 'Não foi passado uma imagem válida!'
        ]);

        $footballPlayer = new FootballPlayer;
        $footballPlayer->name = $request->name;
        $footballPlayer->nacionality = $request->nacionality;
        $footballPlayer->birthDate = $request->birthDate;
        $footballPlayer->footballTeam_id = $request->footballTeam;
        $footballPlayer->position = $request->position;
        $image = $request->file('playerImage');
        $imageData = file_get_contents($image->getRealPath());
        $footballPlayer->image = $imageData;

        $footballPlayer->save();
        return back()->with('success', 'Jogador criado com sucesso!');
    }
}
