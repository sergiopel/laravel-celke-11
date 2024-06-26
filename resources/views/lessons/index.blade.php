@extends('layouts.admin') {{-- extendendo o layout do admin --}}

@section('content')
    <div class="container-fluid px-4">
        <div class="mb-1 hstack gap-2">
            <h2 class="mt-3">Aulas - {{ $course->name }}</h2>

            <ol class="breadcrumb mb-3 mt-3 ms-auto">
                <li class="breadcrumb-item">
                    <a href="{{ route('dashboard.index') }}" class="text-decoration-none">Dashboard</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('courses.index') }}" class="text-decoration-none">Cursos</a>
                </li>
                <li class="breadcrumb-item active">Aulas</li>
            </ol>

        </div>

        <div class="card mb-4 border-light shadow">
            <div class="card-header hstack gap-2">
                <span>Listar</span>

                <span class="ms-auto d-sm-flex flex-row">
                    <a href="{{ route('courses.show', ['course' => $course->id]) }}" class="btn btn-primary btn-sm me-1 mb-1 mb-sm-0">Curso</a>
                    <a href="{{ route('lessons.create', ['course' => $course->id]) }}" class="btn btn-success btn-sm me-1 mb-1 mb-sm-0"><i class="fa-regular fa-square-plus"></i> Cadastrar</a>
                </span>

            </div>

            <div class="card-body">

                <x-alert />

                <table class="table table-striped table-hover table-bordered">
                    <thead>
                        <tr>
                            <th class="d-none d-sm-table-cell">ID</th>
                            <th>Nome</th>
                            <th class="d-none d-md-table-cell">Descrição</th>
                            <th class="text-center">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($lessons as $lesson)
                            <tr>
                                <th class="d-none d-sm-table-cell">{{ $lesson->id }}</th>
                                <td>{{ $lesson->name }}</td>
                                <td class="d-none d-md-table-cell">{{ $lesson->description }}</td>

                                <td class="d-md-flex flex-row justify-content-center">
                                    <a href="{{ route('lessons.show', $lesson->id) }}"
                                        class="btn btn-primary btn-sm me-1 mb-1 mb-md-0"><i class="fa-regular fa-eye"></i> Visualizar</a>
                                    {{-- Eu poderia fazer desse jeito também:
                                     <a href="{{ route('courses.show', ['course' => $course->id]) }}">Visualizar</a> --}}

                                    <a href="{{ route('lessons.edit', $lesson->id) }}"
                                        class="btn btn-warning btn-sm me-1 mb-1 mb-md-0"><i class="fa-regular fa-pen-to-square"></i> Editar</a>

                                    {{-- Para deletar sou obrigado a usar um 'form' e forçar o método 'delete' --}}
                                    {{-- <a href="{{ route('courses.destroy', $course->id) }}">Deletar</a> --}}
                                    <form action="{{ route('lessons.destroy', $lesson->id) }}" method="post">
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
                {{ $lessons->links() }}


            </div>

        </div>
    </div>

@endsection
