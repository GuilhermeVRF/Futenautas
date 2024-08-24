@extends('layouts.app')

@section('title', 'Time')

@push('styles')

@endpush

@section('head')
    @include('layouts.header',['title' => __('Criar time de futebol')])
@endsection

@section('content')
<div class="container">
    <form method= "POST" action="{{ route('team.store') }}" enctype="multipart/form-data">
        @csrf
        <label for="name" class="form-label">Nome</label>
        <input type="text" name="name" id="name" class="form-control">

        <label for="stadium" class="form-label">Estádio</label>
        <input type="text" name="stadium" id="stadium" class="form-control">

        <label for="foundationDate" class="form-label">Data de fundação</label>
        <input type="date" name="foundationDate" id="foundationDate" class="form-control">

        <div class="form-row">
            <div class="col">
                <label for="city" class="form-label">Cidade</label>
                <input type="text" name="city" id="city" class="form-control">
            </div>

            <div class="col">
                <label for="state" class="form-label">Estado</label>
                <select id="state" name="state" class="form-control">
                    <option value="AC">Acre</option>
                    <option value="AL">Alagoas</option>
                    <option value="AP">Amapá</option>
                    <option value="AM">Amazonas</option>
                    <option value="BA">Bahia</option>
                    <option value="CE">Ceará</option>
                    <option value="DF">Distrito Federal</option>
                    <option value="ES">Espírito Santo</option>
                    <option value="GO">Goiás</option>
                    <option value="MA">Maranhão</option>
                    <option value="MT">Mato Grosso</option>
                    <option value="MS">Mato Grosso do Sul</option>
                    <option value="MG">Minas Gerais</option>
                    <option value="PA">Pará</option>
                    <option value="PB">Paraíba</option>
                    <option value="PR">Paraná</option>
                    <option value="PE">Pernambuco</option>
                    <option value="PI">Piauí</option>
                    <option value="RJ">Rio de Janeiro</option>
                    <option value="RN">Rio Grande do Norte</option>
                    <option value="RS">Rio Grande do Sul</option>
                    <option value="RO">Rondônia</option>
                    <option value="RR">Roraima</option>
                    <option value="SC">Santa Catarina</option>
                    <option value="SP">São Paulo</option>
                    <option value="SE">Sergipe</option>
                    <option value="TO">Tocantins</option>
                </select>
            </div>
        </div>

        <label for="teamShield" class="form-label">Escudo</label>
        <input type="file" id="teamShield" name="teamShield" class="form-control">

        <input type="submit" value="Enviar" class="btn btn-success">
    </form>
</div>


@endsection
