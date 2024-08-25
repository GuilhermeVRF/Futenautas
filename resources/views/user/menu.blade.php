@extends('layouts.app')

@section('title', 'Time')

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
        </div>
    </div>
</div>

@endsection
