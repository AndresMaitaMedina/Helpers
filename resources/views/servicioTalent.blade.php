@extends('layouts.app')


@section('contenido_js')
    <!-- Core theme JS-->
    @livewireStyles
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
    <script src="https://js.pusher.com/7.0/pusher.min.js" integrity="sha384-zvPTdTn0oNW7YuTZj1NueYOFJSJNDFJGdKwMMlWDtr3b4xarXd2ydDUajHfnszL7" crossorigin="anonymous"></script>
    
@endsection

@section('contenido_cSS')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/estiloChat.css') }}" />
<style>
    .container px-4 px-lg-5 my-5.col-3.h2.headertekst{
        left: 0;
        right: 0;
        width: 100%;
        text-align: center;
    }
</style>
@endsection


@section('content')

    <div class="row" style="margin-right: 0px">

        {{-- @if($serviceProfile->use_id !== auth()->user()->id) --}}

            {{-- Si existe el contrato --}}
        @if ($chat == true)
            <div class="col-lg-8">
                <section class="py-5">
                    <div class="container px-4 px-lg-5 my-5">
                        <div class="row gx-4 gx-lg-5 align-items-center">
                            <div class="col-md-6"><img class="card-img-top mb-5 mb-md-0" src="{{  $serviceProfile->imagen  }}" style="width:512px !important;" alt="..." /></div>
                            <div class="col-md-6">
                                <h1 class="display-5 fw-bolder">{{ $serviceProfile->ser_tal_name }}</h1>
                                <a href="{{ route('perfil',$serviceProfile->IntermediateUseTal->id) }}" class="h5 fw-bolder">{{ $serviceProfile->IntermediateUseTal->name." ".$serviceProfile->IntermediateUseTal->lastname }}</a>
                                <br>
                                <label><strong>Email : &nbsp;</strong> </label> {{ $serviceProfile->IntermediateUseTal->email }} <label></label>
                                <br>
                                <label><strong>Año de nacimiento : &nbsp;</strong> </label> {{ $serviceProfile->IntermediateUseTal->birthdate }} <label></label>
    



                                <div class="card text-center">
                                    <div class="card-header">
                                      <ul class="nav nav-tabs card-header-tabs">
                                        <li class="nav-item">

                                            <a class="nav-link active" aria-current="true" href="">Servicio Normal</a>

                                        </li>
                                      </ul>
                                    </div>
                                    <div class="col-12 col-sm-12 col-md-10 col-lg-10">
                                        <ul class="text-danger">
                                            @foreach ($errors->contractProccessForm->all() as $errorRegister)
                                                <li>{{ $errorRegister }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    <div class="card-body">
                                      <h5 class="card-title">S/{{ $serviceProfile->precio }}</h5>
                                        <h5>Calificación por usuarios
                                            <h4> 
                                                <ul class="list-inline">
                                                <li class="list-inline-item"><em class="fa fa-star {{$serviceProfile->calificacionT >= 1 ? ' yellow': ''}}"></em></li>
                                                <li class="list-inline-item"><em class="fa fa-star {{$serviceProfile->calificacionT >= 2 ? ' yellow': ''}}"></em></li>
                                                <li class="list-inline-item"><em class="fa fa-star {{$serviceProfile->calificacionT >= 3 ? ' yellow': ''}}"></em></li>
                                                <li class="list-inline-item"><em class="fa fa-star {{$serviceProfile->calificacionT >= 4 ? ' yellow': ''}}"></em></li>
                                                <li class="list-inline-item"><em class="fa fa-star {{$serviceProfile->calificacionT >= 5 ? ' yellow': ''}}"></em></li>
                                                </ul>
                                            </h4>
                                        </h5>
                                      <p class="card-text">{{ $serviceProfile->descripcion }}</p>
                                      <div class="d-flex">

                                        @php
                                            $receivedServiceNow = false;
                                        @endphp
                                        @if(auth()->user()!=null)
                                            @if(auth()->user()->id == $serviceProfile->IntermediateUseTal->id)
                                                <button class="btn btn-outline-dark flex-shrink-0" disabled type="button">
                                                    <em class="bi-cart-fill me-1"></em>
                                                    Tu eres el del servicio
                                                </button>

                                            @else
                                                @foreach($serviceProfile->IntermetiateTalContract as $contract)
                                                    @if($contract->use_receive == auth()->user()->id)
                                                        @php
                                                            $receivedServiceNow =true;
                                                        @endphp
                                                    @else
                                                    @endif

                                                @endforeach
                                                @if($receivedServiceNow == true)
                                                    <button class="btn btn-outline-dark flex-shrink-0" disabled type="button" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                                        <em class="bi-cart-fill me-1"></em>
                                                        Ya lo contrataste
                                                    </button>
                                                    <br>
                                                    <div class="text-danger">* Para comunicarte con el que ofrece el servicio, presione <a href="">AQUI</a> </div>
                                                @else
                                                    <button class="btn btn-outline-dark flex-shrink-0 btn-details-now-data" type="button" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                                        <em class="bi-cart-fill me-1"></em>
                                                        Contratar
                                                    </button>


                                                @endif
                                            @endif
                                        @else
                                            <button class="btn btn-outline-dark flex-shrink-0" onclick="window.location.href='{{ route('registrouser') }}'" type="button">
                                                <em class="bi-cart-fill me-1"></em>
                                                Contratar
                                            </button>

                                        @endif

                                    </div>
                                    </div>
                                  </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            <div class="col-lg-4">
                <livewire:chat-talents :serviceProfile="$serviceProfile">
            </div>
        @else
        <div class="col-12">
            <section class="py-5">
                <div class="container px-4 px-lg-5 my-5">
                    <div class="row gx-4 gx-lg-5 align-items-center">
                        <div class="col-md-6"><img class="card-img-top mb-5 mb-md-0" src="{{  $serviceProfile->imagen  }}" style="width:512px !important;" alt="..." /></div>
                        <div class="col-md-6">
                            <h1 class="display-5 fw-bolder">{{ $serviceProfile->ser_tal_name }}</h1>

                            <a href="{{ route('perfil',$serviceProfile->IntermediateUseTal->id) }}" class="h5 fw-bolder">{{ $serviceProfile->IntermediateUseTal->name." ".$serviceProfile->IntermediateUseTal->lastname }}</a>
                            <br>
                            <label><strong>Email : &nbsp;</strong> </label> {{ $serviceProfile->IntermediateUseTal->email }} <label></label>
                            <br>
                            <label><strong>Año de nacimiento : &nbsp;</strong> </label> {{ $serviceProfile->IntermediateUseTal->birthdate }} <label></label>
                            <br>
                            <div class="card text-center">
                                <div class="card-header">
                                  <ul class="nav nav-tabs card-header-tabs">
                                    <li class="nav-item">

                                        <a class="nav-link active" aria-current="true" href="">Servicio Normal</a>

                                    </li>
                                  </ul>
                                </div>
                                <div class="col-12 col-sm-12 col-md-10 col-lg-10">
                                    <ul class="text-danger">
                                        @foreach ($errors->contractProccessForm->all() as $errorRegister)
                                            <li>{{ $errorRegister }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="card-body">
                                  <h5 class="card-title">S/{{ $serviceProfile->precio }}</h5>
                                    
                                  <p class="card-text">{{ $serviceProfile->descripcion }}</p>
                                  <div class="d-flex">

                                    @php
                                        $receivedServiceNow = false;
                                    @endphp
                                    @if(auth()->user()!=null)
                                        @if(auth()->user()->id == $serviceProfile->IntermediateUseTal->id)
                                            <button class="btn btn-outline-dark flex-shrink-0" disabled type="button">
                                                <em class="bi-cart-fill me-1"></em>
                                                Tu eres el del servicio
                                            </button>

                                        @else
                                            @foreach($serviceProfile->IntermetiateTalContract as $contract)
                                                @if($contract->use_receive == auth()->user()->id)
                                                    @php
                                                        $receivedServiceNow =true;
                                                    @endphp
                                                @else
                                                @endif

                                            @endforeach
                                            @if($receivedServiceNow == true)
                                                <button class="btn btn-outline-dark flex-shrink-0" disabled type="button" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                                    <em class="bi-cart-fill me-1"></em>
                                                    Ya lo contrataste
                                                </button>
                                                <br>
                                                <div class="text-danger">* Para comunicarte con el que ofrece el servicio, presione <a href="">AQUI</a> </div>
                                            @else
                                                <button class="btn btn-outline-dark flex-shrink-0 btn-details-now-data" type="button" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                                    <em class="bi-cart-fill me-1"></em>
                                                    Contratar
                                                </button>


                                            @endif
                                        @endif
                                    @else
                                        <button class="btn btn-outline-dark flex-shrink-0" onclick="window.location.href='{{ route('registrouser') }}'" type="button">
                                            <em class="bi-cart-fill me-1"></em>
                                            Contratar
                                        </button>

                                    @endif

                                </div>
                                </div>
                              </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        @endif


    </div>
    

    <div class="row">
    </div>

    <!-- Product section-->



        {{-- PopUp --}}

        <form class="" action="{{ route('contractDetailsData') }}" method="POST" enctype="" novalidate>
            @csrf
            <input type="hidden" class="set-user-offer-input" name="userOffer" value="{{ $serviceProfile->use_id }}" required>
            <input type="hidden" class="set-price-offer-input" name="priceOffer" value="{{ $serviceProfile->precio }}" required>
            <input type="hidden" class="set-service-offer-input" name="serviceOffer" value="{{ $serviceProfile->id }}" required>
            <input type="hidden" class="set-type-offer-input" name="typeOfJob" value="2" required>
            <input type="hidden" class="set-service-offer-input" name="img1" value="{{ $serviceProfile->imagen }}" required>
            <input type="hidden" class="set-status-offer-input" name="statusInitial" value="1" required>

            {{-- Datos que no se procesan, solo para mejorar el estilo --}}
            <input type="hidden" class="set-service-name-input" name="serviceName" value="{{ $serviceProfile->ser_tal_name }}" required>
            <input type="hidden" class="set-user-offer-name-input" name="userNameProvider" value="{{ $serviceProfile->IntermediateUseTal->name.$serviceProfile->IntermediateUseTal->lastname}}" required>
            {{-- Fin datos que no se procesas --}}

            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="ventanaModal" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">

                        <div class="text-center">
                            <h5 class="modal-title m-2" id="ventanaModal">Contratar servicio</h5>
                        </div>

                        <!-- Cuerpo modal -->
                        <div class="modal-corpo">
                            <div class="m-1" id="formulario">
                                <label class="">Contratado por: Usuario nuevo</label><br>
                                <label>Hora: </label><br>
                                <input type="time" class="form-control" value="{{ old('hourForm') }}" name="hourForm">
                                <label class="m-1">Fecha: </label>
                                <input type="date" class="form-control" value="{{ old('dateForm') }}" name="dateForm" min="2020-11-02" id="fechaContrato" required>

                                <label class="m-1" for="">Lugar</label>
                                <input type="text" class="form-control" name="addressForm" value="{{ old('addressForm') }}" placeholder="Lugar">


                                <label class="m-1">Descripcion</label><br>
                                <input class="form-control" name="descriptionForm" value="{{ old('descriptionForm') }}" placeholder="Descripcion">
                            </div>
                        </div>

                        <!-- Botones pie -->
                        <div class="form-group row justify-content-center">
                            <div class="col-sm-3">
                            <input type="submit" value="Siguiente" class="btn btn-primary"/>
                            </div>
                            <div class="col-sm-3">
                            <input type="submit" value="Cancelar" class="btn btn-danger" data-bs-dismiss="modal" />
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </form>

        @auth
            @php
                $receivedService =  false;
                $unComment =  true;
            @endphp

            @foreach($serviceProfile->IntermetiateTalContract as $contractScr)
                @if($contractScr->use_receive == auth()->user()->id)
                        @php
                            $receivedService =  true;
                        @endphp
                @endif
            @endforeach

            @foreach($serviceProfile->UseTalPostScore as $ScrEtiq)
                @if($ScrEtiq->use_id == auth()->user()->id){
                    @if($ScrEtiq->etiqueta == 'comentado')
                        @php
                            $unComment =  false;
                        @endphp
                    @endif
                }
                @endif
            @endforeach

        @if($receivedService && $unComment)

        <div class="card" style="margin-left: 23rem; margin-right: 4rem">
            <h5 class="card-header">¿Qué tal te parecio este servicio?</h5>
            <div class="card-body">
              <h5 class="card-title">Califica este servicio</h5>
              <p>Tambien puede calificar como 0 estrellas, sin dar click a ninguna</p>
        
              <!-- Calificacion estrellas-->
                <form action="{{ route('registrarScore') }}" method="post">
                {{ csrf_field() }}
                <input type="hidden" name="usCom" value="{{ auth()->user()->id }}">
                <input type="hidden" name="typeJobFromScore" value="2">
                <input type="hidden" name="serviceId" value="{{ $serviceProfile->id }}">
                    <div class="rating">
                        <input id="star5" name="calificacion" type="radio" value="5" class="radio-btn hide" />
                        <label for="star5">&#9733;</label>
                        <input id="star4" name="calificacion" type="radio" value="4" class="radio-btn hide" />
                        <label for="star4">&#9733;</label>
                        <input id="star3" name="calificacion" type="radio" value="3" class="radio-btn hide" />
                        <label for="star3">&#9733;</label>
                        <input id="star2" name="calificacion" type="radio" value="2" class="radio-btn hide" />
                        <label for="star2">&#9733;</label>
                        <input id="star1" name="calificacion" type="radio" value="1" class="radio-btn hide" />
                        <label for="star1">&#9733;</label>
                        <div class="clear"></div>
                    </div>
                    <div class="text-right">
                        <button type="submit" class="btn" style="background-color: rgba(10, 169, 190, 0.61)">Calificar</button>
                    </div>
                </form>
            </div>
          </div>

        @endif

        @endauth

         {{-- comentario --}}
    <div class="px-4 px-lg-5 my-5">
         <div class="col-3">
            <h1>Comentarios</h1>
        </div>

        <div class="container-fluid my-5">
            <div class="row">
                <div class="col-md-3">
                    <div class="card">
                    <div class="card-body">
                            <h5 class="card-title">Preguntas Frecuentes</h5>
                            @auth
                                @if(auth()->user()->id == $serviceProfile->use_id)
                                <button type="button" class="btn btn-sm btn-primary" name="btnpregunta" data-toggle="modal" data-target="#Modalpregunta">Añadir Pregunta Frecuente</button>
                                @endif
                            @endauth

                        </div>
                    </div>

                    @foreach($serviceProfile->UseTalPostQuestion as $ques)

                    <div class="card mt-4">
                        <div class="card-body p-3">
                            <h6 class="card-subtitle mb-2 text-muted">{{$ques->pregunta}}</h6>
                            <p class="card-text">{{$ques->respuesta}}</p>
                        </div>
                    </div>

                    @endforeach

                </div>
                <div class="col-md-6">

                    <!--- Post Form Begins -->
            @auth

                <section class="card">
                    <div class="card-header">
                        <ul class="nav nav-tabs card-header-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="posts-tab" data-toggle="tab" href="#posts" role="tab" aria-controls="posts" aria-selected="true">
                                    Realizar Comentario</a>
                            </li>
                        </ul>
                    </div>
                <form action="{{ route('registrarComent') }}" method="post" class="form-horizontal">
                    <div class="card-body">
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="posts" role="tabpanel" aria-labelledby="posts-tab">
                                <div class="form-group">
                                    <label class="sr-only" for="message">post</label>
                                    {{ csrf_field() }}
                                    <input type="hidden" name="usCom" value="{{ auth()->user()->id }}">
                                    <input type="hidden" name="typeJobFromComment" value="2">
                                    <input type="hidden" name="serviceId" value="{{ $serviceProfile->id }}">

                                    <textarea class="form-control @error('comentario') is-invalid @enderror" id="message" rows="3" placeholder="Escriba lo que piensa..." name="comentario"></textarea>
                                    @error('comentario')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="text-right">
                                <button type="submit" class="btn" style="background-color: rgba(10, 169, 190, 0.61)">Comentar</button>
                            </div>
                        </div>
                    </div>
                </form>
                </section>

            @endauth
                    <!--- Post Form Ends -->

                    <!-- Post Begins -->
                    <section class="card mt-4">
                        @foreach( $serviceProfile->UseTalPostComment as $coment)
                        <div class="border p-2">
                            <!-- post header -->
                            <div class="row m-0">
                                <div class="">
                                    <a class="text-decoration-none" href="#">
                                        @if($serviceProfile->use_id == $coment->use_id)
                                        <img class="" src="https://i.postimg.cc/ryg6tyH9/operator-m.png" width="50" height="50" alt="...">
                                        @else
                                        <img class="" src="https://cdn3.iconfinder.com/data/icons/avatars-round-flat/33/avat-01-512.png" width="50" height="50" alt="...">
                                        @endif
                                    </a>
                                </div>
                                <div class="flex-grow-1 pl-2">
                                    <a class="text-decoration-none" href="{{ route('perfil',$coment->PostCommentUser->id) }}">
                                        <h2 class="text-capitalize h5 mb-0">{{ $coment->PostCommentUser->name }}</h2>
                                    </a>
                                    <p class="small text-secondary m-0 mt-1">Posteado el {{ $coment->created_at }}</p>
                                </div>

                            </div>
                            <!-- post body -->
                            <div class="">
                                <p class="my-2">
                                {{ $coment->comentario }}
                                </p>
                            </div>
                            <hr class="my-1">
                            <!-- post footer begins -->
                            <footer class="">
                            <!-- @php
                                $var=$coment->id;
                            @endphp -->
                                <!-- post actions -->
                                <div class="">
                                    <ul class="list-group list-group-horizontal">
                                        <li class="list-group-item flex-fill text-center p-0 px-lg-2 border border-0">
                                            @auth
                                            @php
                                                $likeUser = false;
                                            @endphp
                                            @foreach ($coment->CommentIntermediate as $item)
                                                @if($item->use_id == auth()->user()->id && $item->use_pos_like==true)
                                                    @php
                                                        $likeUser = true;
                                                        break;
                                                    @endphp                                                    
                                                @endif
                                            @endforeach
                                            @if($likeUser==true)

                                            <form action="{{ route('dislikeComment') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="idUser" value="{{ auth()->user()->id }}">
                                                <input type="hidden" name="idPost" value="{{ $coment->id }}">
                                                <button class="small text-decoration-none" type="submit" style="border: none;background-color:transparent; color:#007bff !important;text-transform:none !important;padding:0px">
                                                    <em class="fa fa-thumbs-up"></em>  Me gusta
                                                </button>    
                                            </form>


                                            @else
                                                <form action="{{ route('likeComment') }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="idUser" value="{{ auth()->user()->id }}">
                                                    <input type="hidden" name="idPost" value="{{ $coment->id }}">
                                                    <button class="small text-decoration-none" type="submit" style="border: none;background-color:transparent; color:#007bff !important;text-transform:none !important;padding:0px">
                                                        <em class="far fa-thumbs-up"></em>  Me gusta
                                                    </button>    
                                                </form>

                                            @endif
                                            @else
                                                <button class="small text-decoration-none" type="button" onclick="window.location.href='{{ route('registrouser') }}'" style="border: none;background-color:transparent; color:#007bff !important;text-transform:none !important;padding:0px">
                                                    <em class="far fa-thumbs-up"></em>  Me gusta
                                                </button>    
                                            @endauth
                                        </li>
                                        <li class="list-group-item flex-fill text-center p-0 px-lg-2 border border-right-0 border-top-0 border-bottom-0">
                                            <a class="small text-decoration-none" data-toggle="collapse" href="#id{{$coment->id}}" role="button" aria-expanded="false" aria-controls="collapseExample">
                                                <em class="fas fa-comment-alt"></em> {{ $coment->UseComPostAnswer->count() }} Comentario
                                            </a>
                                        </li>
                                    </ul>
                                </div>


                                <!-- collapsed comments begins -->
                                <div class="collapse" id="id{{$coment->id}}">
                                    <div class="card border border-right-0 border-left-0 border-bottom-0 mt-1">
                                        <!-- new comment form -->
                                        @auth
                                        <section class="mt-3">
                                            <form action="{{ route('registrarComentR') }}" method="post">
                                                <div class="input-group input-group">
                                                {{ csrf_field() }}
                                                <input type="hidden" name="usCom" value="{{ auth()->user()->id }}">
                                                <input type="hidden" name="ComId" value="{{ $coment->id }}">
                                                    <input type="text" class="form-control @error('comentarioRespuesta') is-invalid @enderror" name="comentarioRespuesta" placeholder="Escribir algo..." aria-label="Recipient's username" aria-describedby="basic-addon2">
                                                    <div class="input-group-append">
                                                        <button class="text-decoration-none text-white btn btn-primary" style="background-color: rgb(0, 0, 0)">Responder</button>
                                                    </div>
                                                    @error('comentarioRespuesta')
                                                        <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </form>
                                        </section>
                                        @endauth
                                        <!-- comment card bgins -->
                                        <section>

                                        @foreach( $coment->UseComPostAnswer as $comentR)

                                            <div class="card p-2 mt-3" style="background-color: rgb(159, 230, 224)">
                                                <!-- comment header -->
                                                <div class="d-flex">
                                                    <div class="">
                                                        <a class="text-decoration-none" href="#">
                                                        @if($serviceProfile->use_id == $comentR->use_id)
                                                            <img class="profile-pic" src="https://i.postimg.cc/ryg6tyH9/operator-m.png" width="40" height="40" alt="...">
                                                            @else
                                                            <img class="profile-pic" src="https://cdn3.iconfinder.com/data/icons/avatars-round-flat/33/avat-01-512.png" width="40" height="40" alt="...">
                                                            @endif
                                                        </a>
                                                    </div>
                                                    <div class="flex-grow-1 pl-2">
                                                        <a class="text-decoration-none text-capitalize h6 m-0" href="#">{{ $comentR->PostCommentUser->name }}</a><label class="text-muted small"> &nbsp; Respondiendo a {{ $coment->PostCommentUser->name }}</label>
                                                        <p class="small m-0 text-muted">Posteado el {{ $comentR->created_at }}</p>
                                                    </div>
                                                    
                                                </div>
                                                <!-- comment header -->
                                                <!-- comment body -->
                                                <div class="card-body p-0">
                                                    <p class="card-text h7 mb-1">{{ $comentR->comentario }}</p>
                                                </div>
                                            </div>

                                        @endforeach
                                        </section>
                                        <!-- comment card ends -->

                                    </div>
                                </div>
                                <!-- collapsed comments ends -->
                            </footer>
                            <!-- post footer ends -->
                        </div>
                        <!---pt2 del comentariooooooooooooooooooooo >
                            <!-- Post Begins -->
                    <!-- Post Ends -->
                    @endforeach
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body p-3">
                            <h5 class="card-title m-0">Oficios Disponibles</h5>
                            <div class="list-group list-group-flush">
                                @foreach($SerOcc as $so)
                                {{-- <a href="{{ route('showProfileServiceOccupation',$so->id) }}" class="list-group-item list-group-item-action text-primary">{{ $so->ser_occ_name }}</a> --}}
                                @endforeach
                                {{-- <a href="{{ route('showOccupationService') }}" class="btn btn-sm btn-primary">Ver más</a> --}}
                            </div>
                        </div>
                    </div>
                    <div class="card mt-4">
                        <div class="card-body p-3">
                            <h5 class="card-title m-0">Talentos</h5>
                            <div class="list-group list-group-flush">
                                @foreach($SerTal as $st)
                                {{-- <a href="{{ route('showProfileServiceTalent',$st->id) }}" class="list-group-item list-group-item-action text-primary">{{ $st->ser_tal_name }}</a> --}}
                                @endforeach
                                {{-- <a href="{{ route('showTalentService') }}" class="btn btn-sm btn-primary">Ver más</a> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- The Modal -->
        <form action="{{ route('registrarPreg') }}" method="post" class="form-horizontal">
            <div class="modal fade" id="Modalpregunta">
                <div class="modal-dialog">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                    <h4 class="modal-title">Añadir pregunta frecuente</h4>
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    </div>

                    <!-- Modal body -->

                    <div class="modal-corpo">

                    {{ csrf_field() }}

                    <input type="hidden" name="typeJobFromQuestion" value="2">
                    <input type="hidden" name="serviceId" value="{{ $serviceProfile->id }}">

                        <div class="form-row">

                            <div class="form-group col-md-12">
                            <label for="inputEmail4">Escribir Pregunta Frecuente</label>
                            <input type="text" name="pregunta" class="form-control @error('pregunta') is-invalid @enderror" id="inputPregunta" placeholder="Escriba la Pregunta Frecuente*" value="{{ old('pregunta')}}" />
                            @error('pregunta')
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            </div>
                        </div>

                        <div class="form-row">

                            <div class="form-group col-md-12">
                            <label for="inputEmail4">Responder Pregunta Frecuente</label>
                            <input type="text" name="respuesta" class="form-control @error('respuesta') is-invalid @enderror" id="inputRespuesta" placeholder="Responda la Pregunta Frecuente*" value="{{ old('respuesta')}}" />
                            @error('respuesta')
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            </div>
                        </div>


                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                    <button type="submit" class="btn btn-outline-success">Publicar Pregunta

                    </button>

                    <button id="cerrarBtn" type="button" class="btn btn-outline-danger" data-dismiss="modal">Cerrar</button>

                    </div>

                </form>
            </div>



        @livewireScripts
@endsection

@section('contenido_abajo_js')

@if (session('contractFailed'))
<script>
    Swal.fire({
        title: "Error en el contrato",
        html:  `
        {{session('contractFailed')}}
        <br>
        <ul>
            @foreach ($errors->contractProccessForm->all() as $errorRegister)
                <li>{{ $errorRegister }}</li>
            @endforeach
        </ul>`,
        icon: "error"
    });
</script>
@endif

@if (session('contractMessage'))
<script>
    Swal.fire({
        title: "Contrato correctamente",
        html:  `
        {{session('contractMessage')}}`,
        icon: "success"
    });
</script>
@endif

@if (session('calificacionMessage'))
<script>
    Swal.fire({
        title: "Calificación recibida",
        html:  `
        {{session('calificacionMessage')}}`,
        icon: "success"
    });
</script>
@endif





@if (session('statusPaymentFailed'))
<script>
    Swal.fire({
        title: "Error en el contrato",
        html:  `
        {{session('statusPaymentFailed')}}`,
        icon: "error"
    });
</script>
@endif

@if (session('statusPaymentSuccess'))
<script>
    Swal.fire({
        title: "Contrato correctamente",
        html:  `
        {{session('statusPaymentSuccess')}}`,
        icon: "success"
    });
</script>
@endif


@if ($errors->has('pregunta') || $errors->has('respuesta'))
<script>
    document.addEventListener('DOMContentLoaded', () => {
        $("#Modalpregunta").modal("show");
    })
</script>

<script>
    const cerrarBtn = document.getElementById('cerrarBtn');
    console.log('BOTÓN CERRAR', cerrarBtn);
    cerrarBtn.addEventListener('click', () => {
        console.log('diste click')
        $('#Modalpregunta').modal('hide')
    })
</script>
@endif

@endsection

