@extends('layouts.app')

@section('title', 'Jogadores')

@push('styles')
<link rel="stylesheet" href="{{ asset('/assets/css/footballPlayers/footballPlayers.css') }}">
@endpush

@section('head')
    @include('layouts.header',['title' => __('Escalar'), 'teamInfo' =>  $teamInfo])
@endsection

@section('content')
    <div class="player-filter">
        <form method= "POST" action="{{ route('positionFilter') }}">
            @csrf
            <select class="form-control" name="filter" id="filter">
                <option value="all" selected>Todos</option>
                <option value="GL">Goleiros</option>
                <option value="LAT">Laterais</option>
                <option value="DEF">Defensores</option>
                <option value="MEI">Meias</option>
                <option value="ATA">Atacantes</option>
            </select>
            <input type="submit" value="Filtrar" class= "btn btn-success">
        </form>
    </div>

        @foreach($footballPlayers as $footballPlayer)
            <div class="player-card">
                <div class="player-info">
                    <img src="{{ asset('uploads/Jogador.jpg') }}">
                    <div>
                        <h3>{{ $footballPlayer['position']}} - {{ $footballPlayer['name'] }}</h3>
                        <p>{{ $footballPlayer['footballTeam']['name'] }}</p>
                        <p><bold>Preço: R$ </bold>{{ $footballPlayer['price'] }}</p>
                    </div>
                </div>

                <input type="hidden" value="{{ $footballPlayer['id'] }}">
                <div class="btn-buy">
                    <a href="" value="Comprar" class= "btn btn-warning">Comprar</a>
                </div>
            </div>
        @endforeach

@endsection
