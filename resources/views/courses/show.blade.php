
@extends('layouts.admin') {{-- extendendo o layout do admin --}}

@section('content')

    <h2>Detalhes do curso</h2>

    <a href="{{ route('courses.create') }}">Criar Curso</a>
    <a href="{{ route('courses.index') }}">Listar cursos</a>

@endsection
