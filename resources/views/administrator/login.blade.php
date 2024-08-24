@extends('layouts.app')

@section('title', 'Administrador')

@push('styles')

@endpush

@section('head')
    @include('layouts.header',['title' => __('Login - Administrador')])
@endsection

@section('content')

<div class="container">
    <form method= "POST" action="{{ route('user.authenticate') }}">
        @csrf
        <label for ="email" class="form-label">E-mail</label>
        <input type="email" name="email" id="email" class="form-control">

        <label for ="password" class="form-label">Senha</label>
        <input type="password" name="password" id="password" class="form-control">

        <input type="submit" value="Enviar" class="btn btn-success">
    </form>
</div>

@endsection
