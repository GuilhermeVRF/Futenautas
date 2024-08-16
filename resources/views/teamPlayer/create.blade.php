@extends('layouts.app')

@section('title', 'Time')

@push('styles')

@endpush

@section('head')
    @include('layouts.header',['title' => __('Cadastre seu time')])
@endsection

@section('content')
    <div class="container">
        <form action="{{ route('teamPlayer.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <label for="teamName" class="form-label">Nome do time</label>
            <input type="text" name="teamName" id="teamName" class="form-control">

            <label for="teamLogo" class="form-label">Logo do time:</label>
            <input type="file" id="teamLogo" name="teamLogo" class="form-control">

            <label for="teamColor" class="form-label">Cor do time:</label>
            <select name="teamColor" id="teamColor" class="form-control">
                <option value="black">Preto</option>
                <option value="white">Branco</option>
                <option value="gray">Cinza</option>
                <option value="yellow">Amarelo</option>
                <option value="red">Vermelho</option>
                <option value="orange">Laranja</option>
                <option value="green">Verde</option>
                <option value="blue">Azul</option>
            </select>

            <input type="submit" value="Enviar" class="btn btn-success">
        </form>
    </div>
@endsection
