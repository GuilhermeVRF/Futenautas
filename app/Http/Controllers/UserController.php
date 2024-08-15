<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\FootballTeam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

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
        $user->password = Crypt::encryptString($request->password);
        $user->footballTeam_id = $request->heartFootballTeam;
        $user->save();

        return response()->json('Usuário criado com sucesso!');
    }

    public function login(Request $request){
        $user = User::where('email', $request->email)->first();

        if(!empty($user)){
            $user_password = Crypt::decryptString($user->password);
            if($request->password == $user_password){
                return response()->json('sucesso');
            }
        }

        $request->session()->flash('error', 'Ocorreu um erro!');
        return back();
    }
}
