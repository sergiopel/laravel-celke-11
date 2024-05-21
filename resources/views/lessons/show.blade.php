@extends('layouts.admin')

@section('content')

    <h2>Detalhes da Aula</h2>

    <a href="{{ route('lessons.index', ['course' => $lesson->course_id]) }}">
        <button type="button">Aulas</button>
    </a><br><br>

    <a href="{{ route('lessons.edit', ['lesson' => $lesson->id]) }}">
        <button type="button">Editar</button>
    </a><br><br>

    <form action="{{ route('lessons.destroy', ['lesson' => $lesson->id]) }}" method="POST">
        @csrf
        @method('DELETE')

        <button type="submit" onclick="return confirm('Tem certeza que deseja excluir esta aula?')">Excluir
        </button>

    </form><br>

    <x-alert />

    ID: {{ $lesson->id }}<br>
    Nome: {{ $lesson->name }}<br>
    Descrição: {{ $lesson->description }}
    Ordem: {{ $lesson->order_lesson }}<br>
    Curso: {{ $lesson->course->name }}<br>
    Cadastrado: {{ $lesson->created_at }}<br>
    Atualizado: {{ $lesson->updated_at }}


@endsection
