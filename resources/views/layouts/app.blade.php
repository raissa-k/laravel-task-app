<!doctype html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Task App')</title>
    <link rel="stylesheet" href="{{ asset('app.css') }}">
</head>
<body>
<header>
    <nav>
        <a href="{{ route('tasks.index') }}">Tasks</a>
        | <a href="{{ route('tasks.create') }}">Nova task</a>
    </nav>
</header>

@php
    $flashType = session()->has('success') ? 'success' : (session()->has('danger') ? 'danger' : null);
    $flashMessage = $flashType ? session($flashType) : null;
@endphp

@if ($flashType)
    <div class="flash">
        <div class="flash__box flash__box--{{ $flashType }}">
            <strong>{{ strtoupper($flashType) }}:</strong>
            {{ $flashMessage }}
        </div>
    </div>
@endif

<main>
    @yield('content')
</main>
</body>
</html>
