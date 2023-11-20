<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SIX</title>
    <link rel="icon" href="{{asset('dist/img/logo_six.jpg')}}" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
          integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
</head>
<body style="background-color: #eee;">

@if ($errors->any())
    <!-- Se existe alguma mensagem de erro -->
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

<section style="">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-8 col-xl-6">
                <div class="card" style="border-radius: 15px;">
                    <div class="bg-image hover-overlay ripple ripple-surface ripple-surface-light"
                         data-mdb-ripple-color="light">
                        <img src="{{$product->image}}"
                             style="border-top-left-radius: 15px; border-top-right-radius: 15px;" class="img-fluid"
                             alt="Laptop"/>
                        <a href="#!">
                            <div class="mask"></div>
                        </a>
                    </div>
                    <div class="card-body pb-0">
                        <div class="d-flex justify-content-between">
                            <div>
                                <p><a class="text-dark">{{$product->name}}</a></p>
                                <p class="small text-muted">{{$product->description}}</p>
                            </div>
                        </div>
                    </div>
                    <hr class="my-0"/>
                    <div class="card-body pb-0">
                        <div class="d-flex justify-content-between">
                            <p><a class="text-dark">Valor Unitário: </a></p>
                            <p class="text-dark" id="productValue">R$ {{$product->value}}</p>
                        </div>
                        <div class="d-flex justify-content-between">
                            <p><a class="text-dark">Total: </a></p>
                            <p class="text-dark" id="totalValue">R$ {{$product->value}}</p>
                        </div>
                    </div>
                    <hr class="my-0"/>
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <p>Quantidade</p>
                            <p class="text-dark">Disponíveis: {{ $product->stocks->quantity }}</p>
                        </div>
                        <div class="input-group">
                            <button class="btn btn-outline-secondary" type="button" onclick="decrementQuantity()">-
                            </button>
                            <input type="text" class="form-control text-center" value="1" id="quantityInput" readonly>
                            <button class="btn btn-outline-secondary" type="button" onclick="incrementQuantity()">+
                            </button>
                        </div>
                    </div>
                    <hr class="my-0"/>
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center pb-2 mb-1">
                            <a href="/" class="text-dark fw-bold">Cancelar</a>
                            <button {{ ($product->stocks->quantity <= 0) ? 'disabled' : '' }} type="button"
                                    class="btn btn-primary" onclick="redirectToCheckout()">Comprar
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct"
        crossorigin="anonymous"></script>

<script>
    let selectedQuantity = 1;

    function incrementQuantity() {
        let quantityInput = document.getElementById('quantityInput');
        let currentQuantity = parseInt(quantityInput.value);
        if (currentQuantity < {{$product->stocks->quantity}}) {
            quantityInput.value = currentQuantity + 1;
            selectedQuantity = currentQuantity + 1;
        }
        calculateTotal();
    }

    function decrementQuantity() {
        let quantityInput = document.getElementById('quantityInput');
        let currentQuantity = parseInt(quantityInput.value);
        if (currentQuantity > 1) {
            quantityInput.value = currentQuantity - 1;
            selectedQuantity = currentQuantity - 1;
        }
        calculateTotal();
    }

    function calculateTotal() {
        let quantityInput = document.getElementById('quantityInput');
        let totalValueElement = document.getElementById('totalValue');
        let productValue = parseFloat("{{$product->value}}");
        let quantity = parseInt(quantityInput.value);
        let total = productValue * quantity;
        totalValueElement.textContent = 'R$ ' + total.toFixed(2);
    }

    function redirectToCheckout() {
        let checkoutRoute = "{{ route('checkout', ['quantity' => ':quantity', 'id' => $product->id]) }}";
        let url = checkoutRoute.replace(':quantity', selectedQuantity);

        window.location.href = url;
    }
</script>
</body>
</html>
