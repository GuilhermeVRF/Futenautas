<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\FootballTeam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller{
    public function index(){
        $footballTeams = FootballTeam::all()->select('id', 'name');

        return view('user.signup', compact('footballTeams'));
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required|max:200',
            'email' => 'required|max:200',
            'password' => 'required|max:200',
            'heartFootballTeam' => 'required|in:1,2,3,4,5,6,7,8,9,10,11,12'
        ]);

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->footballTeam_id = $request->heartFootballTeam;
        $user->save();

        Auth::login($user);

        return Redirect::route('listPlayers', 'all');
    }
}
