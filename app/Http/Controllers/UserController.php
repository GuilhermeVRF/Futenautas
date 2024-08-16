<?php

namespace App\Http\Controllers;

use App\Models\FootballTeam;
use Illuminate\Http\Request;
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

        $request->session()->put('name', $request->name);
        $request->session()->put('email', $request->email);
        $request->session()->put('password', $request->password);
        $request->session()->put('heartFootballTeam', $request->heartFootballTeam);

        return Redirect::route('teamPlayer.create');
    }
}
