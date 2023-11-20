@extends('layout')

@section('title', 'Cadastrar Usuário')

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
        <form action="{{ route('add_users_post') }}" method="post" onsubmit="return checkForm()">
            @csrf
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Cadastrar Usuário</h3>

                    <div class="card-tools">
                    </div>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="name">Nome do Usuário <span style="color: red">*</span></label>
                        <input type="text" id="name" name="name" class="form-control" >
                    </div>
                    <div class="form-group">
                        <label for="email">E-mail <span style="color: red">*</span></label>
                        <input type="email" id="email" name="email" class="form-control" >
                    </div>
                    <div class="form-group">
                        <label for="password">Senha <span style="color: red">*</span></label>
                        <input type="password" id="password" name="password" class="form-control" >
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
            <div class="col-8 text-center">
                <a href="{{route('list_users')}}" class="btn btn-secondary" style="width: 150px">Voltar</a>
                <button type="submit" id="save" class="btn btn-success float-right" style="width: 150px">Cadastrar</button>
            </div>
        </form>
    </div>

    @section('scripts')
        <script>
            function checkForm() {
                let name = document.getElementById('name');
                let email = document.getElementById('email');
                let password = document.getElementById('password');

                let save = document.getElementById('save');
                save.disabled = true;

                if (name.value.trim() === "") {
                    toastr.warning("Por favor, preencha o nome do usuário.");
                    name.focus();
                    save.disabled = false;
                    return false;
                }

                if (email.value.trim() === "") {
                    toastr.warning("Por favor, preencha o E-mail do usuário.");
                    email.focus();
                    save.disabled = false;
                    return false;
                }

                if (password.value.trim() === "") {
                    toastr.warning("Por favor, preencha a senha.");
                    password.focus();
                    save.disabled = false;
                    return false;
                }

                return true;
            }
        </script>
    @endsection

@endsection
