<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Sergio</title>

    </head>
    <body>
        <h1>Bem vindo ao meu site</h1>

        <a href="{{ route('courses.index') }}">Listar</a>

        {{-- <p>Data atual: {{ \Carbon\Carbon::now()->format('d/m/Y H:i:s') }}</p> --}}
    </body>
</html>
