@extends('layouts.app')

@section('title', 'Jogadores')

@push('styles')
<link rel="stylesheet" href="{{ asset('/assets/css/footballPlayers/footballPlayers.css') }}">
@endpush

@section('head')
    @include('layouts.header',['title' => __('Cadastro')])
@endsection

@section('content')

    @foreach($footballPlayers as $footballPlayer)
    <div class="player-card">
        <h3>{{ $footballPlayer['name'] }}</h3>
        <p>{{ $footballPlayer['footballTeam']['name'] }}</p>
    </div>
    @endforeach

@endsection
