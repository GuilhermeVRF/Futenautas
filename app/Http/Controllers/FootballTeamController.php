<?php

namespace App\Http\Controllers;

use App\Models\FootballTeam;
use Illuminate\Http\Request;

class FootballTeamController extends Controller
{
    public function show(){

    }

    public function create(){
        return view('administrator.footballTeam.create');
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required|max:200',
            'stadium' => 'required|max:200',
            'state' => 'required|in:AC,AL,AP,AM,BA,CE,DF,ES,GO,MA,MS,MT,MG,PA,PB,PR,PE,PI,RJ,RN,RS,RO,RR,SC,SP,SE,TO',
            'city' => 'required:max:200',
            'foundationDate' => 'required|date',
            'teamShield' => 'required|image|max:2048'
        ],[
            'name.required' => 'O campo nome é obrigatório!',
            'name.max' => 'O campo nome deve ter no máximo 200 caractéres!',
            'stadium.required' => 'O campo estádio é obrigatório!',
            'stadium.max' => 'O campo estádio deve ter no máximo 200 caractéres!',
            'state.required' => 'O campo estado é obrigatório!',
            'state.in' => 'Não foi informado um estado válida!',
            'city.required' => 'O campo cidade é obrigatório!',
            'city.max' => 'O campo cidade deve ter no máximo 200 caractéres!',
            'foundationDate.required' => 'O campo data de fundação é obrigatório!',
            'foundationDate.date' => 'Não foi informado uma data de fundação válida!',
            'teamShield.required' => 'O campo escudo é obrigatório!',
            'teamShield.image' => 'Não foi passado uma imagem válida!'
        ]);

        $footballTeam = new FootballTeam;
        $footballTeam->name = $request->name;
        $footballTeam->stadium = $request->stadium;
        $footballTeam->city = $request->city;
        $footballTeam->state = $request->state;
        $footballTeam->foundationDate = $request->foundationDate;
        $image = $request->file('teamShield');
        $imageData = file_get_contents($image->getRealPath());
        $footballTeam->shield = $imageData;

        $footballTeam->save();
        return back()->with('success', 'Time criado com sucesso!');
    }
}
