<div class="section-header">
    <div class="header-title">
        @if($title != 'Menu' && $title != 'Administrador')
        <a
            @if(Auth::getDefaultDriver() === 'web')
                href="{{ route('user.menu') }}">
            @else
                href="{{ route('admin-menu') }}">
            @endif
            <img src="{{ asset('uploads/back.png') }}" alt="Voltar">
        </a>
        @endif
        <h1>
            <u>{{ $title }}</u>
        </h1>
    </div>
    @if(!empty($teamInfo))
        <div class="div-teamInfo">
            <img src={{ $teamInfo['logo'] }} height="70px"></img>
            <p style="color: {{ $teamInfo['color'] }};">{{ $teamInfo['name'] }}</p>
        </div>
    @else
    <img src={{asset('uploads/Futenautas-Logo.png')}} height="70px"></img>
    @endif
</div>
