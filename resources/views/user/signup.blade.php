@extends('layouts.app')

@section('title', 'Cadastrar')

@push('styles')
<link rel="stylesheet" href="{{ asset('/assets/css/user/user.css') }}">
@endpush

@section('head')
    @include('layouts.header',['title' => __('Cadastro')])
@endsection

@section('content')
    <div class="container">
        <form method= "POST" action="{{ route('user.store') }}">
            @csrf
            <label for="name" class="form-label">Nome</label>
            <input type="text" name="name" id="name" class="form-control">

            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" id="email" class="form-control">

            <label for="password" class="form-label">Senha</label>
            <input type="password" name="password" id="password" class="form-control">

            <label for="heartFootballTeam" class="form-label">Time do coração</label>
            <select name="heartFootballTeam" id="heartFootballTeam" class="form-control">
                @foreach($footballTeams as $footbalTeam)
                <option value="{{ $footbalTeam['id'] }}"> {{ $footbalTeam['name'] }}</option>
                @endforeach
            </select>

            <input type="submit" value="Enviar" class="btn btn-success">
        </form>
    </div>
@endsection
