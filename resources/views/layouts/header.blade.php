<div class="section-header">
    <h1>{{ $title }}</h1>
    @if(!empty($teamInfo))
        <div class="div-teamInfo">
            <img src={{ $teamInfo['logo'] }} height="70px"></img>
            <p style="color: {{ $teamInfo['color'] }};">{{ $teamInfo['name'] }}</p>
        </div>
    @else
    <img src={{asset('uploads/Futenautas-Logo.png')}} height="70px"></img>
    @endif
</div>
