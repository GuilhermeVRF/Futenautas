@extends('layouts.app')

@section('title', 'Time')

@push('styles')

@endpush

@section('head')
    @include('layouts.header',['title' => __('Criar jogador de futebol')])
@endsection

@section('content')
<div class="container">
    <form method= "POST" action="{{ route('player.store') }}" enctype="multipart/form-data">
        @csrf
        <label for="name" class="form-label">Nome</label>
        <input type="text" name="name" id="name" class="form-control">

        <label for="nacionality" class="form-label">Nacionalidade</label>
        <input type="text" name="nacionality" id="nacionality" class="form-control">

        <label for="footballTeam" class="form-label">Time</label>
        <select name="footballTeam" id="footballTeam" class="form-control">
            @foreach($footballTeams as $footbalTeam)
            <option value="{{ $footbalTeam['id'] }}"> {{ $footbalTeam['name'] }}</option>
            @endforeach
        </select>

        <label for="birthDate" class="form-label">Data de nascimento</label>
        <input type="date" name="birthDate" id="birthDate" class="form-control">

        <label for="position" class="form-label">Time do coração</label>
        <select name="position" id="position" class="form-control">
            <option value="1">Goleiro</option>
            <option value="2">Lateral</option>
            <option value="3">Zagueiro</option>
            <option value="4">Meia</option>
            <option value="5">Atacante</option>
        </select>

        <label for="playerImage" class="form-label">Imagem do jogador</label>
        <input type="file" id="playerImage" name="playerImage" class="form-control">

        <input type="submit" value="Enviar" class="btn btn-success">
    </form>
</div>


@endsection
