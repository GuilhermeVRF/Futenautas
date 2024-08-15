<?php

namespace App\Http\Controllers;

use App\Models\FootballPlayer;
use Illuminate\Http\Request;

class FootballPlayerController extends Controller
{
    public function index($filter){
        if($filter == 'all'){
            $footballPlayers = FootballPlayer::all()->with('footballTeam')->get();;
        }else{
            $footballPlayers = FootballPlayer::where('position', $filter)->with('footballTeam')->get();
        }

        return view('players.index', compact('footballPlayers'));
    }
}
