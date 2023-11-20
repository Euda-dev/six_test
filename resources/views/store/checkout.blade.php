<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>SIX</title>
    <link rel="stylesheet" href="{{asset('checkout/style.css')}}">
    <link rel="icon" href="{{asset('dist/img/logo_six.jpg')}}" type="image/x-icon">
</head>
<body>
<!-- partial:index.partial.html -->
<div class="mainscreen">
    <!-- <img src="https://image.freepik.com/free-vector/purple-background-with-neon-frame_52683-34124.jpg"  class="bgimg " alt="">-->
    <div class="card">
        <div class="leftside">
            <img
                src="{{$product->image}}"
                class="product"
                alt="Shoes"
            />
        </div>
        <div class="rightside">
            <form action="{{route('checkout', ['quantity' => $quantity,'id' => $product->id])}}" method="post">
                @csrf
                <h1>Finalização de Pedido</h1>
                <h2>Informação do Pedido</h2>
                <p>Nome Completo</p>
                <input type="text" class="inputbox" name="name" id="name" required/>

                <p>Celular</p>
                <input type="text" class="inputbox" name="phone" id="phone" required/>

                <p>CPF</p>
                <input type="text" class="inputbox" name="cpf" id="cpf" required/>

                <p></p>
                <button type="submit" class="button">Finalizar Pedido</button>
            </form>
        </div>
    </div>
</div>
<!-- partial -->

</body>
</html>
