@extends('layouts.admin') {{-- extendendo o layout do admin --}}

@section('content')

    <h2>Cadastrar a aula</h2>

    {{-- {{ dd($course) }} --}}

    <a href="{{ route('lessons.index', ['course' => $course->id]) }}"><button type="button">Aulas</button></a><br><br>

    <x-alert />

    <form action="{{ route('lessons.store') }}" method="POST">
        @csrf

        <input type="hidden" name="course_id" id="course_id" value="{{ $course->id }}" required>

        <label>Curso: </label>
        <input type="text" name="course_name" id="course_name" value="{{ $course->name }}" disabled><br><br>

        <label>Nome: </label>
        <input type="text" name="name" id="name" placeholder="Nome da aula" value="{{ old('name') }}" required><br><br>

        <label>Descricão: </label>
        <textarea name="description" id="description" cols="30" rows="4" placeholder="Descricão da aula" required>{{ old('description') }}</textarea><br><br>

        <button type="submit">Cadastrar</button>


    </form>


@endsection
