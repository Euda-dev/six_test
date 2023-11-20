@extends('layout')

@section('title', 'Cadastrar Produto')

@section('content')

@if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>
                        {{$error}}
                    </li>
                @endforeach
            </ul>
        </div>
    @endif

<div class="col-md-12">
    <form action="{{ route('add_products_post') }}" method="post" onsubmit="return checkForm()">
        @csrf
    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title">Cadastrar Produto</h3>

        <div class="card-tools">
        </div>
      </div>
      <div class="card-body">
        <div class="form-group">
          <label for="name">Nome do Produto <span style="color: red">*</span></label>
          <input type="text" id="name" name="name" class="form-control" >
        </div>
        <div class="form-group">
          <label for="description">Descrição do Produto</label>
          <textarea id="description" name="description" class="form-control" rows="4"></textarea>
        </div>
        <div class="form-group">
          <label for="image">Imagem do Produto <span style="color: red">*</span></label>
          <input type="text" id="image" name="image" class="form-control" >
        </div>
        <div class="form-group">
          <label for="value">Valor do Produto <span style="color: red">*</span></label>
            <input type="text" id="value" name="value" class="form-control" pattern="\d+(\.\d{2})?" title="Informe um número com duas casas decimais, use ponto e não vírgula!" >
        </div>
        <div class="form-group">
          <label for="quantity">Quantidade no estoque <span style="color: red">*</span></label>
          <input type="number" id="quantity" name="quantity" class="form-control">
        </div>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
    <div class="col-8 text-center">
        <a href="{{route('list_products')}}" class="btn btn-secondary" style="width: 150px">Voltar</a>
        <button type="submit" id="save" class="btn btn-success float-right" style="width: 150px">Cadastrar</button>
      </div>
</form>
</div>

@section('scripts')
<script>
    function checkForm() {
        let name = document.getElementById('name');
        let image = document.getElementById('image');
        let value_product = document.getElementById('value');
        let quantity = document.getElementById('quantity');
        let save = document.getElementById('save');
        save.disabled = true;

        if (name.value.trim() === "") {
            toastr.warning("Por favor, preencha o nome do produto.");
            name.focus();
            save.disabled = false;
            return false;
        }

        if (image.value.trim() === "") {
            toastr.warning("Por favor, insere a URL da imagem do produto.");
            image.focus();
            save.disabled = false;
            return false;
        }

        if (value_product.value.trim() === "") {
            toastr.warning("Por favor, preencha o valor do produto.");
            value_product.focus();
            save.disabled = false;
            return false;
        }

        if (quantity.value.trim() === "") {
            toastr.warning("Por favor, preencha a quantidade do produto.");
            quantity.focus();
            save.disabled = false;
            return false;
        }

        return true;
    }
</script>
@endsection

@endsection
