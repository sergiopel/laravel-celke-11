

@extends('layouts.admin') {{-- extendendo o layout do admin --}}

@section('content')

    <h2>Cadastrar o curso</h2>

    <a href="{{ route('courses.index') }}"><button type="button">Listar</button></a><br><br>

    <x-alert />

    <form action="{{ route('courses.store') }}" method="POST">
        @csrf
        @method('POST')

        <label>Nome: </label>
        {{-- a sintaxe abaixo do value, indica que se não conseguir cadastrar corretamente,
             manter o valor que já estava preenchido anteriormente  --}}
        <input type="text" name="name" id="name" placeholder="Nome do curso" value="{{ old('name') }}" required><br><br>
        <label>Preço: </label>
        <input type="text" name="price" id="price" placeholder="Preço do curso 1,99" value="{{ old('price') }}" required><br><br>

        <button type="submit">Cadastrar</button>

    </form>

@endsection
