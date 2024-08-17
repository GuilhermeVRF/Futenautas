@extends('layouts.app')

@section('title', 'Jogadores')

@push('styles')
<link rel="stylesheet" href="{{ asset('/assets/css/footballPlayers/footballPlayers.css') }}">
@endpush

@section('head')
    @include('layouts.header',['title' => __('Escalar - Rodada '. $round), 'teamInfo' =>  $teamInfo])
@endsection

@section('content')
    <div class="roundLineup-info">
        <h3>Jogadores escalados: {{ $roundLineup_count }}</h3>
        <h3>Saldo: R$ {{ number_format($round_amount, 2, ',') }}</h3>
        <a href="{{ route('roundLineup') }}" class="btn btn-primary">Ver escalação!</a>
    </div>
    <div class="player-filter">
        <form method= "POST" action="{{ route('listAllPlayers') }}">
            @csrf
            <select class="form-control" name="filter" id="filter">
                <option value="all">Todos</option>
                <option value="1">Goleiros</option>
                <option value="2">Laterais</option>
                <option value="3">Defensores</option>
                <option value="4">Meias</option>
                <option value="5">Atacantes</option>
            </select>
            <input type="submit" value="Filtrar" class= "btn btn-success">
        </form>
    </div>

        @foreach($footballPlayers as $footballPlayer)
            @switch($footballPlayer['position'])
                @case('1')
                    @php $position = 'Goleiro'; @endphp
                @break

                @case('2')
                    @php $position = 'Lateral'; @endphp
                @break

                @case('3')
                    @php $position = 'Zagueiro'; @endphp
                @break

                @case('4')
                    @php $position = 'Meia'; @endphp
                @break

                @case('5')
                    @php $position = 'Atacante'; @endphp
                @break
            @endswitch
            <div class="player-card">
                <div class="player-info">
                    <img src="{{ asset('uploads/Jogador.jpg') }}">
                    <div>
                        <h3>{{ $position }} - {{ $footballPlayer['name'] }}</h3>
                        <p>{{ $footballPlayer['footballTeam']['name'] }}</p>
                        <p><bold>Preço: R$ </bold>{{ $footballPlayer['price'] }}</p>
                    </div>
                </div>

                <form method="POST" action="{{ route('roundLineup.store') }}">
                    @csrf
                    <input type="hidden" name="footballPlayer_id" value="{{ $footballPlayer['id'] }}">
                    <div class="action-footballPlayer">
                        <input type="submit" value="Comprar" class= "btn btn-warning">
                    </div>
                </form>
            </div>
        @endforeach

@endsection
