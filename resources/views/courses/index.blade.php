@extends('layouts.admin') {{-- extendendo o layout do admin --}}

@section('content')
    <div class="container-fluid px-4">
        <div class="mb-1 hstack gap-2">
            <h2 class="mt-3">Curso</h2>

            <ol class="breadcrumb mb-3 mt-3 ms-auto">
                <li class="breadcrumb-item">
                    <a href="#" class="text-decoration-none">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">Cursos</li>
            </ol>

        </div>

        <div class="card mb-4 border-light shadow">
            <div class="card-header hstack gap-2">
                <span>Listar</span>

                <span class="ms-auto">
                    <a href="{{ route('courses.create') }}" class="btn btn-success btn-sm"><i class="fa-regular fa-square-plus"></i> Cadastrar</a>
                </span>

            </div>

            <div class="card-body">

                <x-alert />

                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th class="d-none d-sm-table-cell">ID</th>
                            <th>Nome</th>
                            <th class="d-none d-md-table-cell">Preço</th>
                            <th class="text-center">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($courses as $course)
                            <tr>
                                <th class="d-none d-sm-table-cell">{{ $course->id }}</th>
                                <td>{{ $course->name }}</td>
                                <td class="d-none d-md-table-cell">{{ 'R$ ' . number_format($course->price, 2, ',', '.') }}
                                </td>
                                <td class="d-md-flex flex-row justify-content-center">
                                    <a href="{{ route('lessons.index', $course->id) }}"
                                        class="btn btn-info btn-sm me-1 mb-1 mb-md-0"><i class="fa-solid fa-list"></i> Aulas</a>

                                    <a href="{{ route('courses.show', $course->id) }}"
                                        class="btn btn-primary btn-sm me-1 mb-1 mb-md-0"><i class="fa-regular fa-eye"></i> Visualizar</a>
                                    {{-- Eu poderia fazer desse jeito também:
                                     <a href="{{ route('courses.show', ['course' => $course->id]) }}">Visualizar</a> --}}

                                    <a href="{{ route('courses.edit', $course->id) }}"
                                        class="btn btn-warning btn-sm me-1 mb-1 mb-md-0"><i class="fa-regular fa-pen-to-square"></i> Editar</a>

                                    {{-- Para deletar sou obrigado a usar um 'form' e forçar o método 'delete' --}}
                                    {{-- <a href="{{ route('courses.destroy', $course->id) }}">Deletar</a> --}}
                                    <form action="{{ route('courses.destroy', $course->id) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-danger btn-sm me-1"
                                            onclick="return confirm('Tem certeza que deseja deletar?')"><i class="fa-regular fa-trash-can"></i> Deletar</button>
                                    </form>

                                </td>
                            </tr>
                        @empty
                            <div class="alert alert-danger" role="alert">
                                Nenhum registro encontrado!
                            </div>
                        @endforelse
                    </tbody>

                </table>

                {{-- Imprimir a paginação --}}
                {{ $courses->links() }}

            </div>

        </div>


    </div>



    {{-- {{ dd($courses) }} --}}

    {{-- @foreach ($courses as $course)
            <li> {{ $course->name }} </li>
        @endforeach --}}

    {{-- o @forelse é semelhante ao @foreach, exceto que com @forelse, dá para verificar
             se a lista está vazia com o @empy --}}

    {{-- Na formatação da data e hora, se eu quisesse inserir um timezone diferente do que está definido
        no arquivo .env, eu poderia fazer assim:
        {{ \Carbon\Carbon::parse($course->created_at)->tz('America/Boa_Vista')format('d/m/Y H:i:s') --}}

    {{-- <ul>
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
    {{-- <span style="widht: 100; display:inline-block;">
                    <a href="{{ route('courses.edit', $course->id) }}">
                        <button type="button">Editar</button>
                    </a>
                </span>
                {{-- Para deletar sou obrigado a usar um 'form' e forçar o método 'delete' --}}
    {{-- <a href="{{ route('courses.destroy', $course->id) }}">Deletar</a> --}}
    {{-- <span style="widht: 100; display:inline-block;">
                    <form action="{{ route('courses.destroy', $course->id) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Tem certeza que deseja deletar?')">Deletar</button>
                    </form>
                </span>

            </li>
            <hr> --}}
    {{-- @empty
            <p style="color: red">Nenhum registro encontrado!</p>
        @endforelse
    </ul> --}}


@endsection
