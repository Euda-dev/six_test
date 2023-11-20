@extends('layout')


@section('title', 'Lista de Usuários')

@section('content')
    <div class="col-12">

        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Filtro</h3>
            </div>

            <form action="{{route('filter_users')}}" method="post">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="status_filter">Status</label>
                        <select id="status_filter" name="status_filter" class="form-control">
                            <option value="0">Todos</option>
                            <option value="active">Ativos</option>
                            <option value="inactive">Inativos</option>
                        </select>
                    </div>
                </div>

                <div class="card-footer text-center">
                    <button type="submit" class="btn btn-primary">Buscar</button>
                </div>
            </form>
        </div>

        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h3 class="card-title">Lista de produtos</h3>
                <a class="ml-auto" href="{{route('add_users_get')}}">
                    <button class="btn btn-primary">Novo</button>
                </a> <!-- route('id da rota') -->
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>Nome</th>
                        <th>E-mail</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Alterar</th>
                        <th class="text-center">Desativar</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td class="text-center">{{ $user->status == 'active' ? 'Ativo' : 'Inativo' }}</td>

                            <td class="text-center"><a href="{{route('edit_users_get', ['id' => $user->id]) }}"><i
                                        class="fas fa-edit"></i></a></td>
                            @if($user->status == 'active')
                                <td class="text-center">
                                    <button type="button" class="btn" data-toggle="modal"
                                            data-target="#confirmationModal" onclick="setId('{{$user->id}}')">
                                        <i class="fas fa-trash-alt" style="color: red;"></i>
                                    </button>
                                </td>
                            @else
                                <td class="text-center">
                                    <button type="button" class="btn" data-toggle="modal"
                                            data-target="#confirmationActiveModal" onclick="setId('{{$user->id}}')">
                                        <i class="fas fa-check" style="color: green"></i>
                                    </button>
                                </td>
                            @endif
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>

    <!-- Modal de confirmação -->
    <div class="modal" id="confirmationModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confirmação</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Tem certeza de que deseja desativar este usuário?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-danger" id="confirmDelete">Confirmar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de confirmação -->
    <div class="modal" id="confirmationActiveModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confirmação</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Tem certeza de que deseja ativar este usuário?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-warning" id="confirmActive">Confirmar</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        var id_user = null;

        function setId(id_user_modal) {
            id_user = id_user_modal;
        }

        document.addEventListener('DOMContentLoaded', function () {
            let confirmDeleteButton = document.getElementById('confirmDelete');

            confirmDeleteButton.addEventListener('click', function () {
                let active_user = "{{ route('disabled_user', ['id' => ':id']) }}";
                window.location.href = active_user.replace(':id', id_user);
            });
        });

        document.addEventListener('DOMContentLoaded', function () {
            let confirmActiveButton = document.getElementById('confirmActive');

            confirmActiveButton.addEventListener('click', function () {
                let active_user = "{{ route('active_user', ['id' => ':id']) }}";
                window.location.href = active_user.replace(':id', id_user);
            });
        });
    </script>
@endsection
