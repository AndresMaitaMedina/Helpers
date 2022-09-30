@extends('layouts.app')


@section('contenido_js')
    
@endsection

@section('contenido_cSS')


        <!-- Font Awesome -->
        <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }} ">
        
        <!-- Custom CSS -->
        <link rel="stylesheet" href="{{ asset('css/owl.carousel.css') }} ">
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">
        <link rel="stylesheet" href="{{ asset('css/responsive.css') }} ">
        <link href='http://fonts.googleapis.com/css?family=Titillium+Web:400,200,300,700,600' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:400,700,300' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Raleway:400,100' rel='stylesheet' type='text/css'>
        <style>
            .description-service {
                display: -webkit-box;
                overflow: hidden;
                -webkit-line-clamp: 3;
                -webkit-box-orient: vertical;
            }            
        </style>
@endsection


@section('content')

    
    <div class="product-big-title-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="product-bit-title text-center">
                        <h2>Servicios</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    
    <div class="single-product-area">
        <div class="container">
            <div class="row">
              
                @foreach($allServices as $service)
                    @if ($service->IntermediateUseTal->premium == true)
                        <div class="col-md-3 col-sm-6">
                            <div class="single-shop-product">
                                <div class="product-upper" style="height: 150px !important">
                                    @if($service->imagen!=null)
                                        
                                        <img src="{{ $service->imagen }}" alt="Servicio" style="height: 150px !important">
                                    
                                    @else
                                        <img src="img/product-6.jpg" alt="Servicio">
                                    @endif
                                </div>

                                
                                <h2><a href="{{ route('showProfileServiceTalent',$service->id) }}">{{ $service->ser_tal_name }}</a></h2>
                                <div class="product-carousel-price">
                                    <a href="{{ route('perfil',$service->use_id) }}">{{ $service->IntermediateUseTal->name }}</a> 
                                </div>  
                                <div class="product-carousel-price description-service">
                                    {{ $service->descripcion }}
                                </div>
                                <!-- Calificacion estrellas-->
                                
                                <h4> 
                                    <ul class="list-inline">
                                    <li class="list-inline-item"><em class="fa fa-star {{$service->calificacionT >= 1 ? ' yellow': ''}}"></em></li>
                                    <li class="list-inline-item"><em class="fa fa-star {{$service->calificacionT >= 2 ? ' yellow': ''}}"></em></li>
                                    <li class="list-inline-item"><em class="fa fa-star {{$service->calificacionT >= 3 ? ' yellow': ''}}"></em></li>
                                    <li class="list-inline-item"><em class="fa fa-star {{$service->calificacionT >= 4 ? ' yellow': ''}}"></em></li>
                                    <li class="list-inline-item"><em class="fa fa-star {{$service->calificacionT >= 5 ? ' yellow': ''}}"></em></li>
                                    </ul>
                                </h4>  
                                <div class="product-carousel-price">
                                    <ins>${{ $service->precio }}</ins> 
                                </div>  
                                
                                <div class="product-option-shop">
                                    <a class="add_to_cart_button" data-quantity="1" data-product_sku="" data-product_id="70" rel="nofollow" href="{{ route('showProfileServiceTalent',$service->id) }}">Ver más</a>
                                    <div class="premium-image">
                                        <img src="img/premium.png" width="50" height="50" alt="">
                                    </div> 
                                </div>                       
                            </div>
                        </div> 
                    @endif
                    @if ($service->IntermediateUseTal->premium == false)
                        <div class="col-md-3 col-sm-6">
                            <div class="single-shop-product">
                                <div class="product-upper" style="height: 150px !important">
                                    @if($service->imagen!=null)
                                        
                                        <img src="{{ $service->imagen }}" alt="Servicio" style="height: 150px !important">
                                    
                                    @else
                                        <img src="img/product-6.jpg" alt="Servicio">
                                    @endif
                                </div>

                                
                                <h2><a href="{{ route('showProfileServiceTalent',$service->id) }}">{{ $service->ser_tal_name }}</a></h2>
                                <div class="product-carousel-price">
                                    <a href="{{ route('perfil',$service->use_id) }}">{{ $service->IntermediateUseTal->name }}</a> 
                                </div>  
                                <div class="product-carousel-price description-service">
                                    {{ $service->descripcion }}
                                </div>
                                <!-- Calificacion estrellas-->
                                
                                <h4> 
                                    <ul class="list-inline">
                                    <li class="list-inline-item"><em class="fa fa-star {{$service->calificacionT >= 1 ? ' yellow': ''}}"></em></li>
                                    <li class="list-inline-item"><em class="fa fa-star {{$service->calificacionT >= 2 ? ' yellow': ''}}"></em></li>
                                    <li class="list-inline-item"><em class="fa fa-star {{$service->calificacionT >= 3 ? ' yellow': ''}}"></em></li>
                                    <li class="list-inline-item"><em class="fa fa-star {{$service->calificacionT >= 4 ? ' yellow': ''}}"></em></li>
                                    <li class="list-inline-item"><em class="fa fa-star {{$service->calificacionT >= 5 ? ' yellow': ''}}"></em></li>
                                    </ul>
                                </h4>
                                <div class="product-carousel-price">
                                    <ins>${{ $service->precio }}</ins> 
                                </div>  
                                
                                <div class="product-option-shop">
                                    <a class="add_to_cart_button" data-quantity="1" data-product_sku="" data-product_id="70" rel="nofollow" href="{{ route('showProfileServiceTalent',$service->id) }}">Ver más</a>
                                </div>                       
                            </div>
                        </div> 
                    @endif                   
                @endforeach


            </div>
            <div class="row">
                <div class="col-md-12 d-flex justify-content-center">
                    {{ $allServices->links() }}
                </div>
            </div>            
        </div>
    </div>

@endsection

@section('contenido_abajo_js')
<script>

</script>
    
@endsection