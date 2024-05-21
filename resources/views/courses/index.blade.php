@extends('layouts.admin') {{-- extendendo o layout do admin --}}

@section('content')
    <h2>Listar todos os cursos</h2>

    <a href="{{ route('courses.create') }}"><button type="button">Cadastrar</button></a><br><br>

    <x-alert />
    {{-- {{ dd($courses) }} --}}

    {{-- @foreach ($courses as $course)
            <li> {{ $course->name }} </li>
        @endforeach --}}

    {{-- o @forelse é semelhante ao @foreach, exceto que com @forelse, dá para verificar
             se a lista está vazia com o @empy --}}

    {{-- Na formatação da data e hora, se eu quisesse inserir um timezone diferente do que está definido
        no arquivo .env, eu poderia fazer assim:
        {{ \Carbon\Carbon::parse($course->created_at)->tz('America/Boa_Vista')format('d/m/Y H:i:s') --}}

    <ul>
        <li style="list-style-type: none; justify-content: space-between">
            <span style="width: 50px; display: inline-block;">ID</span>
            <span style="width: 200px; display: inline-block;">Nome</span>
            <span style="width: 130px; display: inline-block;">Preço</span>
            <span style="width: 150px; display: inline-block;">Criado em</span>
            <span style="width: 150px; display: inline-block;">Atualizado em</span>
        </li><br>
        @forelse ($courses as $course)
            <li style="list-style-type: none; justify-content: space-between">
                <span style="width: 50px; display: inline-block;">{{ $course->id }}</span>
                <span style="width: 200px; display: inline-block;">{{ $course->name }}</span>
                <span
                    style="width: 130px; display: inline-block;">{{ 'R$ ' . number_format($course->price, 2, ',', '.') }}</span>
                <span style="width: 150px; display: inline-block;">
                    {{ \Carbon\Carbon::parse($course->created_at)->format('d/m/Y H:i:s') }}</span>
                <span style="width: 150px; display: inline-block;">
                    {{ \Carbon\Carbon::parse($course->updated_at)->format('d/m/Y H:i:s') }}</span>

                <span style="widht: 100; display:inline-block;">
                    <a href="{{ route('lessons.index', $course->id) }}">
                        <button type="button">Aulas</button>
                    </a>
                </span>
                <span style="widht: 100; display:inline-block;">
                    <a href="{{ route('courses.show', $course->id) }}">
                        <button type="button">Visualizar</button>
                    </a>
                </span>
                {{-- Eu poderia fazer desse jeito também:
                 <a href="{{ route('courses.show', ['course' => $course->id]) }}">Visualizar</a> --}}
                <span style="widht: 100; display:inline-block;">
                    <a href="{{ route('courses.edit', $course->id) }}">
                        <button type="button">Editar</button>
                    </a>
                </span>
                {{-- Para deletar sou obrigado a usar um 'form' e forçar o método 'delete' --}}
                {{-- <a href="{{ route('courses.destroy', $course->id) }}">Deletar</a> --}}
                <span style="widht: 100; display:inline-block;">
                    <form action="{{ route('courses.destroy', $course->id) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Tem certeza que deseja deletar?')">Deletar</button>
                    </form>
                </span>

            </li>
            <hr>
        @empty
            <p style="color: red">Nenhum registro encontrado!</p>
        @endforelse
    </ul>

    {{-- Imprimir a paginação --}}
    {{-- {{ $courses->links() }} --}}
@endsection
