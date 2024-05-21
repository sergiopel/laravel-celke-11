@extends('layouts.admin') {{-- extendendo o layout do admin --}}

@section('content')

    <h2>Listar as Aulas</h2>

    {{-- {{ dd($course) }} --}}

    <a href="{{ route('courses.index') }}"><button type="button">Cursos</button></a><br><br>
    <a href="{{ route('lessons.create', ['course' => $course->id]) }}"><button type="button">Cadastrar</button></a><br><br>

    <x-alert />

    @forelse ($lessons as $lesson)
        ID: {{ $lesson->id }} <br>
        Nome: {{ $lesson->name }} <br>
        Descricão: {{ $lesson->description }} <br>
        Ordem: {{ $lesson->order_lesson }} <br>
        Curso: {{ $lesson->course->name }} <br>
        Criado em: {{ \Carbon\Carbon::parse($lesson->created_at)->format('d/m/Y H:i:s') }} <br>
        Atualizado em: {{ \Carbon\Carbon::parse($lesson->updated_at)->format('d/m/Y H:i:s') }} <br><br>
        <a href="{{ route('lessons.show', ['lesson' => $lesson->id]) }}"><button type="button">Visualizar</button></a><br><br>
        <a href="{{ route('lessons.edit', ['lesson' => $lesson->id]) }}"><button type="button">Editar</button></a><br><br>

        <form action="{{ route('lessons.destroy', ['lesson' => $lesson->id]) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" onclick="return confirm('Tem certeza que deseja excluir a aula?')">Excluir</button>
        </form>

        <hr>


    @empty
        <p style="color: #f00;">Nenhuma aula encontrada!</p>
    @endforelse


@endsection
