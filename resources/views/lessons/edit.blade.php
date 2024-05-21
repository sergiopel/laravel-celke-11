@extends('layouts.admin') {{-- extendendo o layout do admin --}}

@section('content')

    <h2>Editar a aula</h2>

    {{-- {{ dd($lesson) }} --}}

    <a href="{{ route('lessons.index', ['course' => $lesson->course_id]) }}">
        <button type="button">Aulas</button>
    </a><br><br>

    <x-alert />

    <form action="{{ route('lessons.update', ['lesson' => $lesson->id]) }}" method="post">
        @csrf
        @method('PUT')

        {{-- {{ dd($lesson->course->name) }} --}}

        <label>Curso: </label>
        <input type="text" name="course" value="{{ $lesson->course->name }}" disabled><br><br>
        <label>Nome: </label>
        <input type="text" name="name" placeholder="Nome da aula" value="{{ old('name', $lesson->name) }}" required><br><br>
        <label>Descricão: </label>
        <textarea name="description" id="description" cols="30" rows="4" required>{{ old('description', $lesson->description) }}</textarea><br><br>

        <button type="submit">Atualizar</button>

    </form>

@endsection
