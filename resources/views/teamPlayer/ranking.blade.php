@extends('layouts.app')

@section('title', 'Ranking Times dos Players')

@push('styles')

@endpush

@section('head')
    @include('layouts.header',['title' => __('Ranking Times dos Players'), 'teamInfo' =>  $teamInfo])
@endsection

@section('content')

<div class="container mb-2 w-50">
    <form action="{{ route('teamPlayer.ranking') }}" method="POST">
        @csrf
        <label for="round" class="form-label">Rodada</label>
        <select name="round" id="round" class="form-control">
            @foreach ($rounds as $round)
                <option value="{{ $round['id'] }}">{{ $round['id'] }}</option>
            @endforeach
        </select>

        <input type="submit" value="Filtrar" class="btn btn-success">
    </form>
</div>

<div class="container">
    <table>
        <thead>
            <th>Posição</th>
            <th>Time</th>
            <th>Pontuação</th>
        </thead>
        @php $rank = 1; @endphp
        @foreach ($playersTeams as $playerTeam)
            @php
                $playerTeam_logo = 'data:image/jpeg;base64,' . base64_encode($playerTeam['logo']);
            @endphp
            <tr>
                <td>{{ $rank }}°</td>
                <td><img src="{{ $playerTeam_logo }}" height="50px">{{ $playerTeam['name'] }}</td>
                <td>{{ $playerTeam['total_score'] }}</td>
            </tr>
            @php $rank++ @endphp
        @endforeach
    </table>
</div>

@endsection
