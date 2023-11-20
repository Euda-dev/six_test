<!DOCTYPE html>
<html lang="pt-br">

<head>
    <!-- Basic -->
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <!-- Site Metas -->
    <meta name="keywords" content=""/>
    <meta name="description" content=""/>
    <meta name="author" content=""/>

    <link rel="icon" href="{{asset('dist/img/logo_six.jpg')}}" type="image/x-icon">

    <title>
        SIX
    </title>

    <!-- slider stylesheet -->
    <link rel="stylesheet" type="text/css"
          href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css"/>

    <!-- bootstrap core css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('store/css/bootstrap.css') }}"/>

    <!-- Custom styles for this template -->
    <link href="{{ asset('store/css/style.css') }}" rel="stylesheet"/>
    <!-- responsive style -->
    <link href="{{ asset('store/css/responsive.css') }}" rel="stylesheet"/>
</head>

<body>


<!-- shop section -->

<section class="shop_section layout_padding">
    <div class="container">
        <div class="heading_container heading_center">
            <h2>
                Lista de Produtos
            </h2>
        </div>
        <div class="row">
            @foreach ($products as $product)
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <div class="box">
                        <a href="{{route('page_product', ['id' => $product->id])}}">
                            <div class="img-box">
                                <img src="{{$product->image}}" alt="">
                            </div>
                            <div class="detail-box">
                                <h6>
                                    {{$product->name}}
                                </h6>
                                <h6>
                                    Preço
                                    <span>
                      R${{$product->value}}
                    </span>
                                </h6>
                            </div>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>


<script src="{{ asset('store/js/jquery-3.4.1.min.js') }}"></script>
<script src="{{ asset('store/js/bootstrap.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js">
</script>
<script src="{{ asset('store/js/custom.js') }}"></script>

</body>

</html>
