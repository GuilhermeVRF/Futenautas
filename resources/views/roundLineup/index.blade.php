@extends('layouts.app')

@section('title', 'Jogadores')

@push('styles')
<link rel="stylesheet" href="{{ asset('/assets/css/footballPlayers/footballPlayers.css') }}">
@endpush

@section('head')
    @include('layouts.header',['title' => __('Sua Escalação - Rodada '. $round), 'teamInfo' =>  $teamInfo])
@endsection

@section('content')
    <div class="roundLineup-info">
        <h3>Saldo: R$ {{ number_format($round_amount, 2, ',') }}</h3>
        <a href="{{ route('listAllPlayers') }}" class="btn btn-primary">Comprar jogadores</a>
    </div>

    @if($roundLineups->count() > 0)
        @foreach($roundLineups as $roundLineup)
            @switch($roundLineup['position'])
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

                @php
                    $playerImage = 'data:image/jpeg;base64,' . base64_encode($roundLineup['image']);
                    $footballTeam_shield = 'data:image/jpeg;base64,' . base64_encode($roundLineup['shield']);
                @endphp

            <div class="player-card">
                <div class="player-info">
                    <img src="{{ $playerImage ?? asset('uploads/Jogador.jpg') }}" height="150px">
                    <div>
                        <h3>{{ $position }} - {{ $roundLineup['footballPlayer_name'] }}</h3>
                        <div class="footballTeam-info">
                            <img src="{{ $footballTeam_shield }}" height="50px">
                            <p>{{ $roundLineup['footballTeam_name'] }}</p>
                        </div>
                        <p><bold>Preço: R$ </bold>{{ $roundLineup['price'] }}</p>
                    </div>
                </div>

                <form method="POST" action="{{ route('roundLine.destroy') }}">
                    @csrf
                    <input type="hidden" name="roundLineup_id" value="{{ $roundLineup['id'] }}">
                    <div class="action-footballPlayer">
                        <input type="submit" value="Remover" class= "btn btn-danger">
                    </div>
                </form>
            </div>
        @endforeach
    @else
    <div class="div-alert">
        <span class="flash-warning">Sem jogadores escalados!</span>
    </div>
    @endif
@endsection
