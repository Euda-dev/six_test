@extends('layout')


@section('title', 'Lista de pedidos')

@section('content')
    <div class="col-12">

        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Filtro</h3>
            </div>

            <form action="{{route('filter_orders')}}" method="post">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="status_filter">Status</label>
                        <select id="status_filter" name="status_filter" class="form-control">
                            <option value="0">Todos</option>
                            <option value="pending">Pendentes</option>
                            <option value="completed">Completos</option>
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
                <h3 class="card-title">Lista de pedidos</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Telefone</th>
                        <th>CPF</th>
                        <th>Produto</th>
                        <th class="text-center">Quantidade</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Completar</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($orders as $order)
                        <tr>
                            <td>{{ $order->name }}</td>
                            <td>{{ $order->phone }}</td>
                            <td>{{ $order->cpf }}</td>
                            <td>{{ $order->product->name }}</td>
                            <td class="text-center">{{ $order->quantity }}</td>
                            <td class="text-center">{{ $order->status == 'pending' ? 'Pendente' : 'Completo' }}</td>

                            @if($order->status == 'pending')
                                <td class="text-center">
                                    <button type="button" class="btn" data-toggle="modal"
                                            data-target="#confirmationActiveModal" onclick="setId('{{$order->id}}')">
                                        <i class="fas fa-check" style="color: green"></i>
                                    </button>
                                </td>
                            @else
                                <td class="text-center">
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
                    Tem certeza de que deseja completar este pedido?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-warning" id="confirmActive">Confirmar</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        var id_order = null;

        function setId(id_order_modal) {
            id_order = id_order_modal;
        }

        document.addEventListener('DOMContentLoaded', function () {
            let confirmActiveButton = document.getElementById('confirmActive');

            confirmActiveButton.addEventListener('click', function () {
                let complete_order = "{{ route('complete_order', ['id' => ':id']) }}";
                window.location.href = complete_order.replace(':id', id_order);
            });
        });
    </script>
@endsection
