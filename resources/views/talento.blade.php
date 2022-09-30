@extends('layouts.app')


@section('contenido_js')

@endsection

@section('contenido_cSS')

@endsection


@section('content')
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Servicios</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
       <!-- Bootstrap -->
       <link rel="stylesheet" href="css/bootstrap.min.css">

       <!-- Font Awesome -->
       <link rel="stylesheet" href="css/font-awesome.min.css">

       <!-- Custom CSS -->
       <link rel="stylesheet" href="css/owl.carousel.css">
       <link rel="stylesheet" href="css/style.css">
       <link rel="stylesheet" href="css/responsive.css">


</head>
<body>
    <!-- Product section-->
    <section class="py-5">
        <div class="container px-4 px-lg-5 my-5">
            <div class="row gx-4 gx-lg-5 align-items-center">
                <div class="col-md-6"><img class="card-img-top mb-5 mb-md-0" src="https://dummyimage.com/600x700/dee2e6/6c757d.jpg" alt="..." /></div>
                <div class="col-md-6">
                    <h1 class="display-5 fw-bolder">Juanito Diaz</h1>
                    <h1 class="display-5 fw-bolder">Contador de chistes</h1>
                    <div class="fs-5 mb-5">
                        <span>$0.5.00</span>
                    </div>
                    <!-- Review usuarios-->
                    <div class="d-flex small text-warning mb-2">
                        <div class="bi-star-fill"></div>
                        <div class="bi-star-fill"></div>
                        <div class="bi-star-fill"></div>
                        <div class="bi-star-fill"></div>
                        <div class="bi-star-fill"></div>
                    </div>
                    <p class="lead">Lorem ipsum dolor sit amet consectetur adipisicing elit. Praesentium at dolorem quidem modi. Nam sequi consequatur obcaecati excepturi alias magni, accusamus eius blanditiis delectus ipsam minima ea iste laborum vero?</p>
                    <div class="d-flex">
                        <input class="form-control text-center me-3" id="inputQuantity" type="num" value="1" style="max-width: 3rem" />
                        <button class="btn btn-outline-dark flex-shrink-0" type="button">
                            <em class="bi-cart-fill me-1"></em>
                            Contratar
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <div class="footer-top-area">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-6">
                    <div class="footer-about-us">
                        <h2>Talent<span>Work</span></h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Perferendis sunt id doloribus vero quam laborum quas alias dolores blanditiis iusto consequatur, modi aliquid eveniet eligendi iure eaque ipsam iste, pariatur omnis sint! Suscipit, debitis, quisquam. Laborum commodi veritatis magni at?</p>
                        <div class="footer-social">
                            <a href="#" target="_blank"><em class="fa fa-facebook"></em></a>
                            <a href="#" target="_blank"><em class="fa fa-twitter"></em></a>
                            <a href="#" target="_blank"><em class="fa fa-youtube"></em></a>
                            <a href="#" target="_blank"><em class="fa fa-linkedin"></em></a>
                        </div>
                    </div>
                </div>

                <div class="col-md-3 col-sm-6">
                    <div class="footer-menu">
                        <h2 class="footer-wid-title">Navegación </h2>
                        <ul>
                            <li><a href="">Mi perfil</a></li>
                            <li><a href="">Mi historial</a></li>
                        </ul>
                    </div>
                </div>

                <div class="col-md-3 col-sm-6">
                    <div class="footer-menu">
                        <h2 class="footer-wid-title">Categorias</h2>
                        <ul>
                            <li><a href="">Oficios</a></li>
                            <li><a href="">Talentos</a></li>
                        </ul>
                    </div>
                </div>

                <div class="col-md-3 col-sm-6">
                    <div class="footer-newsletter">
                        <h2 class="footer-wid-title">Premium</h2>
                        <p>Subscribete a nuestra versión premium para acceder a mayores beneficios!</p>
                        <div class="newsletter-form">
                            <input type="submit" onclick="window.location.href='{{route('premium')}}'" value="Subscribete">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom-area">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="copyright">
                       <p>&copy; 2021 TalentWork. Todos los derechos reservados. Grupo 5 - MPF - FISI - UNMSM </p>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="footer-card-icon">
                        <em class="fa fa-cc-discover"></em>
                        <em class="fa fa-cc-mastercard"></em>
                        <em class="fa fa-cc-paypal"></em>
                        <em class="fa fa-cc-visa"></em>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    <!-- Core theme JS-->
    <script src="js/scripts.js"></script>
</body>

@endsection

@section('contenido_abajo_js')
<script>

Swal.fire('Any fool can use a computer');
</script>

@endsection
