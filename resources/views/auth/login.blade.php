<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SIX</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">

    <link rel="stylesheet" href="{{ asset('plugins/toastr/toastr.min.css') }}">

    <link rel="icon" href="{{asset('dist/img/logo_six.jpg')}}" type="image/x-icon">
</head>
<body class="hold-transition login-page">
<div class="login-box">
    <div class="login-logo">
        <a ><b>SIX</b></a>
    </div>

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

    <!-- /.login-logo -->
    <div class="card">
        <div class="card-body login-card-body">
            <p class="login-box-msg">Faça login para iniciar sua sessão.</p>

            <form action="{{ route('auth') }}" method="post" onsubmit="return checkForm()">
                @csrf
                <div class="input-group mb-3">
                    <input id="email" name="email" type="email" class="form-control" placeholder="E-mail...">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input id="password" name="password" type="password" class="form-control" placeholder="Senha...">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <div class="row">

                    <div class="col-12">
                        <button id="save" type="submit" class="btn btn-primary btn-block">Entrar</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>

        </div>
        <!-- /.login-card-body -->
    </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('dist/js/adminlte.min.js') }}"></script>

<script src="{{ asset('plugins/toastr/toastr.min.js') }}"></script>

<script>
    toastr.options = {
        "positionClass": "toast-top-center",
    }
</script>

<script>
    function checkForm() {
        let email = document.getElementById('email');
        let password = document.getElementById('password');
        let save = document.getElementById('save');
        save.disabled = true;

        if (email.value.trim() === "") {
            toastr.warning("Por favor, preencha o E-mail.");
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
</body>
</html>
