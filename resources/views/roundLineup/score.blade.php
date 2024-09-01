@extends('layouts.app')

@section('title', 'Pontuação')

@push('styles')
    <link rel="stylesheet" href="{{ asset('/assets/css/footballPlayerScore/footballPlayerScore.css') }}">
@endpush

@section('head')
    @if($round == 'all')
        @php $message_round = 'Todas as rodadas' @endphp
    @else
        @php $message_round = 'Rodada '. $round @endphp
    @endif
    @include('layouts.header',['title' => __('Pontuação - '. $message_round)])
@endsection

@section('content')
    <div class="container">
        <form action="{{ route('footaballPlayerScore.index') }}" method="POST">
            @csrf
            <div class="form-row">
                <div class="col">
                    <label for="round" class="form-label">Rodada</label>
                    <select name="round" id="round" class="form-control">
                        <option value="all">Todas</option>
                        @foreach ($rounds as $round)
                            <option value="{{ $round['id'] }}">{{ $round['id'] }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col">
                    <label for="filter" class="form-label">Filtrar por</label>
                    <select name="filter" id="filter" class="form-control">
                        <option @if($filter == '1') selected @endif value="1">Tudo</option>
                        <option @if($filter == '2') selected @endif value="2">Jogador</option>
                        <option @if($filter == '3') selected @endif value="3">Time</option>
                        <option @if($filter == '4') selected @endif value="4">Posição</option>
                    </select>
                </div>
            </div>

            <div id="div-footballTeam" @if($filter != '3') style="display:none" @endif>
                <label for="footballTeam" class="form-label">Time</label>
                <select name="footballTeam" id="footballTeam" class="form-control">
                    @foreach ($footballTeams as $footballTeam)
                        <option value="{{ $footballTeam['id'] }}">{{ $footballTeam['name'] }}</option>
                    @endforeach
                </select>
            </div>

            <div id="div-position" @if($filter != '4') style="display:none" @endif>
                <label for="position" class="form-label">Posição</label>
                <select name="position" id="position" class="form-control">
                    <option value="1">Goleiro</option>
                    <option value="2">Lateral</option>
                    <option value="3">Zagueiro</option>
                    <option value="4">Meia</option>
                    <option value="5">Atacante</option>
                </select>
            </div>

            <div id="div-footballPlayer" @if($filter != '2') style="display:none" @endif>
                <label for="footballPlayer" class="form-label">Jogador</label>
                <input type="text" name="footballPlayer" id="footballPlayer" class="form-control">
            </div>

            <input type="submit" value="Filtrar" class="btn btn-success">
        </form>
    </div>

    @if($footballPlayerScores->count() > 0)
        @foreach($footballPlayerScores as $footballPlayerScore)
            @switch($footballPlayerScore['position'])
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
                    $playerImage = 'data:image/jpeg;base64,' . base64_encode($footballPlayerScore['image']);
                    $footballTeam_shield = 'data:image/jpeg;base64,' . base64_encode($footballPlayerScore['shield']);
                @endphp

            <div class="player-card">
                <div class="player-info">
                    <img src="{{ $playerImage ?? asset('uploads/Jogador.jpg') }}" height="150px">
                    <div>
                        <h3>{{ $position }} - {{ $footballPlayerScore['footballPlayer_name'] }}</h3>
                        <div class="footballTeam-info">
                            <img src="{{ $footballTeam_shield }}" height="50px">
                            <p>{{ $footballPlayerScore['footballTeam_name'] }}</p>
                        </div>
                        <h4>Pontuação: {{ $footballPlayerScore['score'] }}</p>
                    </div>
                </div>
            </div>
        @endforeach
    @else
        <div class="div-alert">
            <span class="flash-warning">Sem jogadores escalados!</span>
        </div>
    @endif
@endsection

@push('scripts')
    <script src="{{ asset('/assets/js/footballPlayerScore/footballPlayerScore.js') }}"></script>
@endpush
