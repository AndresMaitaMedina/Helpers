@extends('layouts.app')


@section('contenido_js')

@endsection

@section('contenido_cSS')

@endsection


@section('content')


    <!-- Product section-->
    <section class="py-5">
        <div class="container px-4 px-lg-5 my-5">
            <div class="row gx-4 gx-lg-5 align-items-center">
                <div class="col-md-6"><img class="card-img-top mb-5 mb-md-0" src="https://dummyimage.com/600x700/dee2e6/6c757d.jpg" alt="..." /></div>
                <div class="col-md-6">
                    {{-- <h1 class="display-5 fw-bolder">{{ $serviceProfile->IntermediateUseTal->name }}&nbsp;{{ $serviceProfile->IntermediateUseTal->lastname }}</h1> --}}
                    <h1 class="display-5 fw-bolder">Electricista</h1>

                    <div class="card text-center">
                        <div class="card-header">
                          <ul class="nav nav-tabs card-header-tabs">
                            <li class="nav-item">

                                <a class="nav-link" href="{{ view('servicio') }}">Normal</a>

                            </li>
                            <li class="nav-item">

                                <a class="nav-link active" aria-current="true" href="{{ view('serviciopremium') }}">Premium</a>

                            </li>
                          </ul>
                        </div>
                        <div class="card-body">
                          <h5 class="card-title">$40.00</h5>
                            <div class="d-flex small text-warning mb-2">
                                <div class="bi-star-fill"></div>
                                <div class="bi-star-fill"></div>
                                <div class="bi-star-fill"></div>
                                <div class="bi-star-fill"></div>
                                <div class="bi-star-fill"></div>
                            </div>
                          <p class="card-text">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Voluptate nobis eveniet non quae quasi velit pariatur corrupti libero rerum quam. Aperiam laborum reprehenderit ducimus sunt placeat dolorem sint asperiores necessitatibus?</p>
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
            </div>
        </div>
    </section>

    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    <!-- Core theme JS-->
    <script src="js/scripts.js"></script>

@endsection

@section('contenido_abajo_js')
<script>
</script>

@endsection
