@extends('layouts.app')

@section('title', 'Ranking Times de Futebol')

@push('styles')

@endpush

@section('head')
    @include('layouts.header',['title' => __('Ranking Times de Futebol'), 'teamInfo' =>  $teamInfo])
@endsection

@section('content')

<div class="container">
    <table>
        <thead>
            <th>Posição</th>
            <th>Time</th>
            <th>Pontuação</th>
        </thead>
        @php $rank = 1; @endphp
        @foreach ($footballTeams as $footballTeam)
            @php
                $footballTeam_shield = 'data:image/jpeg;base64,' . base64_encode($footballTeam['shield']);
            @endphp
            <tr>
                <td>{{ $rank }}°</td>
                <td><img src="{{ $footballTeam_shield }}" height="50px">{{ $footballTeam['name'] }}</td>
                <td>{{ $footballTeam['total_score'] }}</td>
            </tr>
            @php $rank++ @endphp
        @endforeach
    </table>
</div>

@endsection
