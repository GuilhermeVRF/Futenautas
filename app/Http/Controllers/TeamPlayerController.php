<?php

namespace App\Http\Controllers;

use App\Models\Round;
use App\Models\TeamPlayer;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use DB;
use Illuminate\Support\Facades\Redirect;

class TeamPlayerController extends Controller
{
    public function create(){
        return view('teamPlayer.create');
    }

    public function store(Request $request){
        $valid_user = $request->session()->has('email') && $request->session()->has('name')
        && $request->session()->has('password') && $request->session()->has('heartFootballTeam');

        if($valid_user){
            $request->validate([
                'teamName' => 'required|max:200',
                'teamLogo' => 'required|image|max:2048',
                'teamColor' => 'required|in:black,white,gray,yellow,red,orange,green,blue'
            ],[
                'teamName.required' => 'O campo nome do time é obrigatório!',
                'teamName.max' => 'O campo nome do time deve ter no máximo 200 caractéres!',
                'teamLogo.required' => 'A logo do time é um campo obrigatório!',
                'teamColor.required' => 'A cor do time é um campo obrigatório!',
                'teamColor.in' => 'Selecione uma cor válida!'
            ]
            );

            // Creating the user
            $user = new User;
            $user->name = $request->session()->pull('name');
            $user->email = $request->session()->pull('email');
            $user->password = Hash::make($request->session()->pull('password'));
            $user->footballTeam_id = $request->session()->pull('heartFootbalTeam');
            $user->save();

            Auth::login($user);

            //Creating his team
            $teamPlayer = new TeamPlayer;
            $teamPlayer->name = $request->teamName;
            $image = $request->file('teamLogo');
            $imageData = file_get_contents($image->getRealPath());
            $teamPlayer->logo = $imageData;
            $teamPlayer->color = $request->teamColor;
            $teamPlayer->user_id = Auth::id();
            $teamPlayer->save();

            return Redirect::route('listAllPlayers');
        }

        return back()->withErrors('error', 'Ocorreu um erro durante o registro!');
    }

    public function ranking(Request $request){
        $teamInfo = TeamPlayer::getTeamInfo();
        $rounds = Round::orderBy('id', 'DESC')->get();
        $playersTeams = TeamPlayer::join('roundlineup', 'roundlineup.teamplayer_id', '=','teamplayer.id')
            ->join('footballplayer', 'roundlineup.footballplayer_id', '=', 'footballplayer.id')
            ->join('footballplayerscore', 'footballplayerscore.footballplayer_id', '=', 'footballplayer.id')
            ->select('teamplayer.name', 'teamplayer.logo', DB::raw('SUM(footballplayerscore.score) AS total_score'))
            ->groupBy('teamplayer.name', 'teamplayer.logo');

        if(empty($request->round) || $request->round == 'all'){
            $playersTeams = $playersTeams->orderBy('total_score','DESC')->get();
        }else{
            $request->validate([
                'round' => 'required'
            ],[
                'round.required' => 'O campo Rodada é obrigatório!'
            ]);

            $playersTeams = $playersTeams->where('roundlineup.round_id',$request->round)->orderBy('total_score','DESC')->get();
        }

        return view('teamPlayer.ranking', compact('playersTeams',
         'teamInfo',
        'rounds'));
    }
}
