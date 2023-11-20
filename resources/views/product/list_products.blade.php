@extends('layout')


@section('title', 'Lista de produtos')

@section('content')
    <div class="col-12">

        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Filtro</h3>
            </div>

            <form action="{{route('filter_products')}}" method="post">
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
                <a class="ml-auto" href="{{route('add_products_get')}}">
                    <button class="btn btn-primary">Novo</button>
                </a> <!-- route('id da rota') -->
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Descrição</th>
                        <th class="text-center">Valor</th>
                        <th class="text-center">Quantidade</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Alterar</th>
                        <th class="text-center">Desativar</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($products as $product)
                        <tr>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->description }}</td>
                            <td class="text-center">{{ $product->value }}</td>
                            <td class="text-center">{{ $product->stocks->quantity }}</td>
                            <td class="text-center">{{ $product->status == 'active' ? 'Ativo' : 'Inativo' }}</td>

                            <td class="text-center"><a href="{{route('edit_products_get', ['id' => $product->id]) }}"><i
                                        class="fas fa-edit"></i></a></td>
                            @if($product->status == 'active')
                                <td class="text-center">
                                    <button type="button" class="btn" data-toggle="modal"
                                            data-target="#confirmationModal" onclick="setId('{{$product->id}}')">
                                        <i class="fas fa-trash-alt" style="color: red;"></i>
                                    </button>
                                </td>
                            @else
                                <td class="text-center">
                                    <button type="button" class="btn" data-toggle="modal"
                                            data-target="#confirmationActiveModal" onclick="setId('{{$product->id}}')">
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
                    Tem certeza de que deseja desativar este produto?
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
                    Tem certeza de que deseja ativar este produto?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-warning" id="confirmActive">Confirmar</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        var id_product = null;

        function setId(id_product_modal) {
            id_product = id_product_modal;
        }

        document.addEventListener('DOMContentLoaded', function () {
            let confirmDeleteButton = document.getElementById('confirmDelete');

            confirmDeleteButton.addEventListener('click', function () {
                let active_product = "{{ route('disabled_product', ['id' => ':id']) }}";
                window.location.href = active_product.replace(':id', id_product);
            });
        });

        document.addEventListener('DOMContentLoaded', function () {
            let confirmActiveButton = document.getElementById('confirmActive');

            confirmActiveButton.addEventListener('click', function () {
                let active_product = "{{ route('active_product', ['id' => ':id']) }}";
                window.location.href = active_product.replace(':id', id_product);
            });
        });
    </script>
@endsection
