<!DOCTYPE html>
<html lang="PT-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('/assets/css/app.css') }}" rel="stylesheet">
    @stack('styles')
    <title>@yield('title', 'Futenautas')</title>
</head>
<body>
    <div class="main-content">
        <section class="head">
            @yield('head')
        </section>

        <section class="content">
            @if (!empty(Session::get('error')))
                <span class="flash-error">{{ Session::get('error') }}</span>
            @endif
            @yield('content')
        </section>

    </div>
    @stack('scripts')
</body>
</html>
