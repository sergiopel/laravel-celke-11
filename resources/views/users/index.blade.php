@extends('layouts.admin') {{-- extendendo o layout do admin --}}

@section('content')
    <div class="container-fluid px-4">
        <div class="mb-1 hstack gap-2">
            <h2 class="mt-3">Usuário</h2>

            <ol class="breadcrumb mb-3 mt-3 ms-auto">
                <li class="breadcrumb-item">
                    <a href="{{ route('dashboard.index') }}" class="text-decoration-none">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">Usuários</li>
            </ol>

        </div>

        <div class="card mb-4 border-light shadow">
            <div class="card-header hstack gap-2">
                <span>Listar</span>

                <span class="ms-auto">
                    <a href="{{ route('users.create') }}" class="btn btn-success btn-sm"><i class="fa-regular fa-square-plus"></i> Cadastrar</a>
                </span>

            </div>

            <div class="card-body">

                <x-alert />

                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th class="d-none d-sm-table-cell">ID</th>
                            <th>Nome</th>
                            <th class="d-none d-md-table-cell">E-mail</th>
                            <th class="text-center">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($users as $user)
                            <tr>
                                <th class="d-none d-sm-table-cell">{{ $user->id }}</th>
                                <td>{{ $user->name }}</td>
                                <td class="d-none d-md-table-cell">{{ $user->email }}</td>
                                <td class="d-md-flex flex-row justify-content-center">
                                    <a href="{{ route('users.show', $user->id) }}"
                                        class="btn btn-primary btn-sm me-1 mb-1 mb-md-0"><i class="fa-regular fa-eye"></i> Visualizar</a>
                                    {{-- Eu poderia fazer desse jeito também:
                                     <a href="{{ route('courses.show', ['course' => $course->id]) }}">Visualizar</a> --}}

                                    <a href="{{ route('users.edit', $user->id) }}"
                                        class="btn btn-warning btn-sm me-1 mb-1 mb-md-0"><i class="fa-regular fa-pen-to-square"></i> Editar</a>

                                    {{-- Para deletar sou obrigado a usar um 'form' e forçar o método 'delete' --}}
                                    {{-- <a href="{{ route('courses.destroy', $course->id) }}">Deletar</a> --}}
                                    <form action="{{ route('users.destroy', $user->id) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm me-1"
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
                {{ $users->links() }}

            </div>

        </div>

    </div>



@endsection
