@extends('layouts.app')

@section('title', 'Rodada')

@push('styles')
<link rel="stylesheet" href="{{ asset('/assets/css/footballPlayers/footballPlayers.css') }}">
@endpush

@section('head')
    @include('layouts.header',['title' => __('Finalizar - Rodada '. $round)])
@endsection

@section('content')
    <div class="container">
        <h2>Jogadores escalados: {{ $rostered_players }}</h2>
        <form action="{{ route('round.finish') }}" method="POST">
            @csrf
            <input type="submit" value="Finalizar rodada" class="btn btn-success">
        </form>

    </div>

@endsection
