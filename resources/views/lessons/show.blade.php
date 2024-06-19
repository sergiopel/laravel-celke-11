@extends('layouts.admin')

@section('content')
    <div class="container-fluid px-4">
        <div class="mb-1 hstack gap-2">
            <h2 class="mt-3">Detalhes da Aula</h2>

            <ol class="breadcrumb mb-3 mt-3 ms-auto">
                <li class="breadcrumb-item">
                    <a href="{{ route('dashboard.index') }}" class="text-decoration-none">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">Curso</li>
            </ol>

        </div>

        <div class="card mb-4 border-light shadow">
            <div class="card-header hstack gap-2">
                <span>Visualizar</span>

                <span class="ms-auto d-sm-flex flex-row">
                    <a href="{{ route('lessons.index', ['course' => $lesson->course_id]) }}"
                        class="btn btn-info btn-sm me-1 mb-1 mb-sm-0"><i class="fa-solid fa-list"></i> Aulas</a>
                    <a href="{{ route('lessons.edit', ['lesson' => $lesson->id]) }}"
                        class="btn btn-warning btn-sm me-1 mb-1 mb-sm-0"><i class="fa-regular fa-pen-to-square"></i> Editar</a>
                    <form action="{{ route('lessons.destroy', ['lesson' => $lesson->id]) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm"
                            onclick="return confirm('Tem certeza que deseja deletar esta aula?')"><i
                                class="fa-regular fa-trash-can"></i> Deletar</button>
                    </form>
                </span>

            </div>

            <div class="card-body">

                <x-alert />

                <dl class="row">

                    <dt class="col-sm-3">ID:</dt>
                    <dd class="col-sm-9">{{ $lesson->id }}</dd>

                    <dt class="col-sm-3">Nome:</dt>
                    <dd class="col-sm-9">{{ $lesson->name }}</dd>

                    <dt class="col-sm-3">Descrição:</dt>
                    <dd class="col-sm-9">{{ $lesson->description }}</dd>

                    <dt class="col-sm-3">Ordem:</dt>
                    <dd class="col-sm-9">{{ $lesson->order_lesson }}</dd>

                    <dt class="col-sm-3">Curso:</dt>
                    <dd class="col-sm-9">{{ $lesson->course->name }}</dd>

                    <dt class="col-sm-3">Data Cadastro:</dt>
                    <dd class="col-sm-9">{{ \Carbon\Carbon::parse($lesson->created_at)->format('d/m/Y H:i:s') }}</dd>

                    <dt class="col-sm-3">Data Alteração:</dt>
                    <dd class="col-sm-9">{{ \Carbon\Carbon::parse($lesson->updated_at)->format('d/m/Y H:i:s') }}</dd>

                </dl>

            </div>

        </div>


    </div>

@endsection
