@extends('layouts.app')

@section('title', 'Time')

@push('styles')
<link rel="stylesheet" href="{{ asset('/assets/css/admin/admin.css') }}">
@endpush

@section('head')
    @include('layouts.header',['title' => __('Administrador')])
@endsection

@section('content')

<div class="container">
    <div class="menu">
        <h2>Opções</h2>
        <div class="menu-options">
            <a href="{{route('player.create')}}" class="btn btn-primary">Criar jogador</a>
            <a href="{{route('team.create')}}" class="btn btn-primary">Criar time de futebol</a>
            <a href="#" class="btn btn-primary">Manipular rodada</a>
        </div>
    </div>
</div>

@endsection
