@extends('layouts.admin') {{-- extendendo o layout do admin --}}

@section('content')

<div class="container-fluid px-4">
    <div class="mb-1 hstack gap-2">
        <h2 class="mt-3">Cadastrar a Aula</h2>

        <ol class="breadcrumb mb-3 mt-3 ms-auto">
            <li class="breadcrumb-item">
                <a href="#" class="text-decoration-none">Dashboard</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ route('courses.index') }}" class="text-decoration-none">Cursos</a>
            </li>
            <li class="breadcrumb-item active">Aula</li>
        </ol>

    </div>

    <div class="card mb-4 border-light shadow">
        <div class="card-header hstack gap-2">
            <span>Cadastrar</span>

            <span class="ms-auto d-sm-flex flex-row">
                <a href="{{ route('lessons.index', ['course' => $course->id]) }}" class="btn btn-info btn-sm me-1 mb-1 mb-sm-0"><i class="fa-solid fa-list"></i> Listar</a>
            </span>

        </div>

        <div class="card-body">

            <x-alert />

            <form class="row g-3" action="{{ route('lessons.store') }}" method="POST">

                @csrf
                @method('POST')

                <input type="hidden" name="course_id" id="course_id" value="{{ $course->id }}" required>

                <div class="col-12">
                    <label for="name" class="form-label">Curso</label>
                    <input type="text" name="course_name" id="course_name" class="form-control" value="{{ $course->name }}" disabled>
                </div>

                <div class="col-12">
                    <label for="name" class="form-label">Nome</label>
                    <input type="text" name="name" id="name" class="form-control" placeholder="Nome da aula" value="{{ old('name') }}" required>
                </div>

                <div class="col-12">
                    <label for="description" class="form-label">Descrição</label>
                    <textarea name="description" id="description" class="form-control" cols="30" rows="4" placeholder="Descricão da aula" required>{{ old('description') }}</textarea>
                </div>

                <div class="col-12">
                    <button type="submit" class="btn btn-success btn-sm">Cadastrar</button>
                </div>

            </form>


        </div>


    </div>
</div>


@endsection
