@extends('layouts.app')

@section('title', 'Menu')

@push('styles')
<link rel="stylesheet" href="{{ asset('/assets/css/admin/admin.css') }}">
@endpush

@section('head')
    @include('layouts.header',['title' => __('Menu'), 'teamInfo' =>  $teamInfo])
@endsection

@section('content')

<div class="container">
    <div class="menu">
        <h2>Opções</h2>
        <div class="menu-options">
            <a href="{{route('listAllPlayers')}}" class="btn btn-primary">Escalar jogadores</a>
            <a href="{{route('roundLineup')}}" class="btn btn-primary">Ver Escalação</a>
            <a href="{{route('footaballPlayerScore.index')}}" class="btn btn-primary">Ver pontuação da rodada</a>
            <a href="{{route('team.ranking')}}" class="btn btn-primary">Ranking Times de Futebol</a>
            <a href="{{route('teamPlayer.ranking')}}" class="btn btn-primary">Ranking Times dos Players</a>
        </div>
    </div>
</div>

@endsection
