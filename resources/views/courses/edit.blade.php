
@extends('layouts.admin') {{-- extendendo o layout do admin --}}

@section('content')

    <h2>Editar o curso</h2>

    <a href="{{ route('courses.index') }}"><button type="button">Listar</button></a>
    <a href="{{ route('courses.show', $course->id) }}"><button type="button">Visualizar</button></a><br><br>

    <x-alert />

    <form action="{{ route('courses.update', $course->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label>Nome: </label>
        <input type="text" name="name" id="name" placeholder="Nome do curso"
         value="{{ old('name', $course->name) }}" ><br><br>

        <label>Preço: </label>
         <input type="text" name="price" id="price" placeholder="Preço do curso 1,99"
         value="{{ old('price', str_replace('.', ',', $course->price)) }}" ><br><br>
         <button type="submit">Atualizar</button>
    </form>


@endsection
