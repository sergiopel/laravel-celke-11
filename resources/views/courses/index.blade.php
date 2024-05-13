
    @extends('layouts.admin') {{-- extendendo o layout do admin --}}

    @section('content')

        <h2>Listar todos os cursos</h2>

        <a href="{{ route('courses.create') }}">Cadastrar</a>

    @endsection



