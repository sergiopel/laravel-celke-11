
@extends('layouts.admin') {{-- extendendo o layout do admin --}}

@section('content')

    <h2>Editar o curso</h2>

    <a href="{{ route('courses.index') }}">Listar cursos</a>

@endsection
