@extends('layouts.admin') {{-- extendendo o layout do admin --}}

@section('content')
    <h2>Detalhes do curso</h2>

    <span style="widht: 100; display:inline-block;">
        <a href="{{ route('courses.create') }}"><button type="button">Criar</button></a>
    </span>

    <span style="widht: 100; display:inline-block;">
        <a href="{{ route('courses.index') }}">
            <button type="button">Listar</button>
        </a>
    </span>
    <span style="widht: 100; display:inline-block;">
        <a href="{{ route('courses.edit', $course->id) }}">
            <button type="button">Editar</button>
        </a>
    </span>
    <span style="widht: 100; display:inline-block;">
        <form action="{{ route('courses.destroy', $course->id) }}" method="post">
            @csrf
            @method('DELETE')
            <button type="submit" onclick="return confirm('Tem certeza que deseja deletar?')">Deletar</button>
        </form>
    </span>

    <x-alert />

    <div>
        <p>ID: {{ $course->id }}</p>
        <p>Nome: {{ $course->name }}</p>
        <p>Preço: {{ 'R$ ' . number_format($course->price, 2, ',', '.') }}</p>
        <p>Data Cadastro: {{ \Carbon\Carbon::parse($course->created_at)->format('d/m/Y H:i:s') }}</p>
        <p>Data Alteração: {{ \Carbon\Carbon::parse($course->updated_at)->format('d/m/Y H:i:s') }}</p>
    </div>
@endsection
