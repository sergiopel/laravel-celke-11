@extends('layouts.admin') {{-- extendendo o layout do admin --}}

@section('content')

<div class="container-fluid px-4">
    <div class="mb-1 hstack gap-2">
        <h2 class="mt-3">Aula</h2>

        <ol class="breadcrumb mb-3 mt-3 ms-auto">
            <li class="breadcrumb-item">
                <a href="{{ route('dashboard.index') }}" class="text-decoration-none">Dashboard</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ route('courses.index') }}" class="text-decoration-none">Cursos</a>
            </li>
            <li class="breadcrumb-item active">Curso</li>
        </ol>

    </div>

    <div class="card mb-4  border-light shadow">
        <div class="card-header hstack gap-2">
            <span>Editar</span>

            <span class="ms-auto d-sm-flex flex-row">
                <a href="{{ route('lessons.index', ['course' => $lesson->course_id]) }}" class="btn btn-info btn-sm me-1 mb-1 mb-sm-0"><i class="fa-solid fa-list"></i> Listar</a>
                <a href="{{ route('lessons.show', $lesson->id) }}" class="btn btn-primary btn-sm me-1 mb-1 mb-sm-0"><i class="fa-regular fa-eye"></i> Visualizar</a>
            </span>

        </div>


        <div class="card-body">

            <x-alert />
            <form class="row g-3" action="{{ route('lessons.update', $lesson->id) }}" method="POST">

                @csrf
                @method('PUT')

                <div class="col-12">
                    <label class="form-label">Curso</label>
                    <input type="text" class="form-control" name="course" value="{{ old('course', $lesson->course->name) }}" disabled>
                </div>
                <div class="col-12">
                    <label class="form-label">Nome</label>
                    <input type="text" class="form-control" name="name" value="{{ old('name', $lesson->name) }}" required>
                </div>
                <div class="col-12">
                    <label for="description" class="form-label">Descricão</label>
                    <textarea class="form-control" name="description" id="description" cols="30" rows="4" placeholder="Conteúdo da aula" required>{{ old('description', $lesson->description) }}
                    </textarea>
                </div>

                <div class="col-12">
                    <button type="submit" class="btn btn-warning">Atualizar</button>
                </div>

            </form>
        </div>
    </div>
</div>


@endsection
