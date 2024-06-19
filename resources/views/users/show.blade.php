@extends('layouts.admin') {{-- extendendo o layout do admin --}}

@section('content')
    <div class="container-fluid px-4">
        <div class="mb-1 hstack gap-2">
            <h2 class="mt-3">Detalhes do Usuário</h2>

            <ol class="breadcrumb mb-3 mt-3 ms-auto">
                <li class="breadcrumb-item">
                    <a href="{{ route('dashboard.index') }}" class="text-decoration-none">Dashboard</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('users.index') }}" class="text-decoration-none">Usuários</a>
                </li>
                <li class="breadcrumb-item active">Usuário</li>
            </ol>

        </div>

        <div class="card mb-4 border-light shadow">
            <div class="card-header hstack gap-2">
                <span>Visualizar</span>

                <span class="ms-auto d-sm-flex flex-row">
                    <a href="{{ route('users.index') }}" class="btn btn-info btn-sm me-1 mb-1 mb-sm-0"> <i
                            class="fa-solid fa-list"></i> Listar</a>
                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning btn-sm me-1 mb-1 mb-sm-0"><i
                            class="fa-regular fa-pen-to-square"></i> Editar</a>
                    <a href="{{ route('users.edit.password', $user->id) }}" class="btn btn-warning btn-sm me-1 mb-1 mb-sm-0"><i
                            class="fa-regular fa-pen-to-square"></i> Editar Senha</a>
                    <form action="{{ route('users.destroy', $user->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm"
                            onclick="return confirm('Tem certeza que deseja deletar este registro?')"><i
                                class="fa-regular fa-trash-can"></i> Deletar</button>
                    </form>
                </span>

            </div>

            <div class="card-body">

                <x-alert />

                <dl class="row">

                    <dt class="col-sm-3">ID:</dt>
                    <dd class="col-sm-9">{{ $user->id }}</dd>

                    <dt class="col-sm-3">Nome:</dt>
                    <dd class="col-sm-9">{{ $user->name }}</dd>

                    <dt class="col-sm-3">E-mail:</dt>
                    <dd class="col-sm-9">{{ $user->email }}</dd>

                    <dt class="col-sm-3">Data Cadastro:</dt>
                    <dd class="col-sm-9">{{ \Carbon\Carbon::parse($user->created_at)->format('d/m/Y H:i:s') }}</dd>

                    <dt class="col-sm-3">Data Alteração:</dt>
                    <dd class="col-sm-9">{{ \Carbon\Carbon::parse($user->updated_at)->format('d/m/Y H:i:s') }}</dd>

                </dl>

            </div>

        </div>


    </div>
@endsection
