

@extends('layouts.admin') {{-- extendendo o layout do admin --}}

@section('content')

    <h2>Cadastrar o curso</h2>

    <a href="{{ route('courses.index') }}">Listar</a>

@endsection
