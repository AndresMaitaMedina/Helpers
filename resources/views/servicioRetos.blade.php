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
    .hero__pic {
    margin-bottom: 50px;
    margin-left:auto;
    margin-top: auto;
    margin-right: auto;

   }
  .hero__pic {

    height: 391px;
    width:520px;
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-align:center;
    -ms-flex-align: center;
    align-items: center;
    -webkit-box-pack: center;
    -ms-flex-pack: center;
    justify-content: center;



  }
  .set-bg {
    background-repeat: no-repeat;
    background-size: cover;
    background-position: top center;

  }
   *, ::after, ::before {
    box-sizing: border-box;
  }

  .banner-text {
    margin: 16.6em 0 6em;
    }

    .banner-text {
    margin: 22em 0 10em;
    text-align: center;
    background: rgba(0, 0, 0, 0.72);
    display: inline-block;
    padding: 4em;
    }
    .banner-text h1 {
    font-size: 3.5em;
    color: #fff;
    font-family: 'Text Me One', sans-serif;
    font-weight: 900;
    margin: 0;

    }
</style>
@endsection


@section('content')
{{-- Modal insertar video --}}
<div class="modal fade" id="modalInsertVideo" tabindex="-1" role="dialog"aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalInsertVideoTitle">Subir video</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{ route('upload.video.25.percentaje') }}" method="POST" enctype="multipart/form-data">
            @csrf

        <div class="modal-body container">

            <label for="">Insertar url del video de YOUTUBE : </label>
                <input type="hidden" required class="form-control" name="idService" value="{{ $serviceProfile->id }}">

                <input type="url" required class="form-control" name="urlVideo" max="255">
                @error('urlVideo')
                <div class="alert alert-danger" role="alert">
                  <strong>Atención.</strong> {{ $message }}.
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                @enderror
        </div>
        <div class="modal-footer">
          {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button> --}}
          <button type="submit" class="btn btn-primary">Subir video</button>
        </div>
        </form>

      </div>
    </div>
  </div>

    <div class="row" style="margin-right: 0px">

        {{-- @if($serviceProfile->use_id !== auth()->user()->id) --}}

            {{-- Si existe el contrato --}}

        <div class="col-12">
            <section class="py-5">
                <div class="container px-4 px-lg-5 my-5">
                    <div class="row gx-4 gx-lg-5 align-items-center">

                        <div class="col-md-6">
                            <img class="card-img-top mb-5 mb-md-0" src="{{  $serviceProfile->imagen  }}" style="width:512px !important;" alt="..." />


                            @if($serviceProfile->IntermediateChange->cha_video!=null)

                                {{-- Video --}}
                                <h4>Video</h4>

                                <div class="hero__pic set-bg"  data-setbg="img/hero/hero-video.png" style="background-image: url(&quot;https://img.freepik.com/vector-gratis/fondo-negro-foco-luz_1017-27230.jpg?size=626&ext=jpg&quot;);">

                                @php
                                    $ytarray=explode("/", $serviceProfile->IntermediateChange->cha_video);
                                    $ytendstring=end($ytarray);
                                    $ytendarray=explode("?v=", $ytendstring);
                                    $ytendstring=end($ytendarray);
                                    $ytendarray=explode("&", $ytendstring);
                                    $ytcode=$ytendarray[0];
                                    echo "<iframe width=\"100%\" height=\"315\" src=\"https://www.youtube.com/embed/$ytcode\" title=\"Navigation menu\" frameborder=\"0\" allowfullscreen></iframe>";
                                @endphp
                                </div>
                                <br>

                                <a href="{{ $serviceProfile->IntermediateChange->cha_video }}">Link del video</a>

                            @endif


                        </div>
                        <div class="col-md-6">
                            <h1 class="display-5 fw-bolder">{{ $serviceProfile->IntermediateChange->cha_name }}</h1>

                            <a href="{{ route('perfil',$serviceProfile->IntermediateUseOcc->id) }}" class="h5 fw-bolder">{{ $serviceProfile->IntermediateUseOcc->name." ".$serviceProfile->IntermediateUseOcc->lastname }}</a>
                            <br>
                            <label><strong>Email : &nbsp;</strong> </label> {{ $serviceProfile->IntermediateUseOcc->email }} <label></label>
                            <br>
                            <label><strong>Año de nacimiento : &nbsp;</strong> </label> {{ $serviceProfile->IntermediateUseOcc->birthdate }} <label></label>
                            <br>
                            <div class="card text-center">
                                <div class="card-header">
                                  <ul class="nav nav-tabs card-header-tabs">
                                    <li class="nav-item">

                                        <a class="nav-link active" aria-current="true" href="">Servicio</a>

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

                                  <p class="card-text">{{ $serviceProfile->descripcion }}</p>
                                  <span class="ksr-green-700 inline-block bold type-16 type-28-md">
                                  <span class="ksr-green-500">S/{{ $serviceProfile->precio_actual }}</span>
                                  </span>
                                  <p class="card-text">contribuido de <span class="money">{{ $serviceProfile->precio }} US$ </span></p>
                                  <div class="block type-16 type-28-md bold dark-grey-500"><span> {{ $serviceProfile->IntermediateChange->cha_count }} </span></div>
                                  <p class="card-text">patrocinadores</p>

                                  <div class="">

                                    @php
                                        $receivedServiceNow = false;
                                    @endphp
                                    @if(auth()->user()!=null)
                                        @if(auth()->user()->id == $serviceProfile->IntermediateUseOcc->id)
                                            <div class="row">
                                                    <div class="col-md-12 d-flex justify-content-center">
                                                        <button class="btn btn-outline-dark flex-shrink-0" disabled type="button">
                                                            <em class="bi-cart-fill me-1"></em>
                                                            Tu eres el del servicio
                                                        </button>

                                                    </div>

                                            </div>
                                            <br>
                                            @if ( $serviceProfile->precio_actual>=$serviceProfile->precio*0.25 && $serviceProfile->IntermediateChange->cha_25_percent_active==false)

                                            <div class="row">
                                                <div class="col-md-12 d-flex justify-content-center">
                                                    <div class="alert alert-danger" role="alert">
                                                        * Los pagos fueron INHABILITADOS hasta que subas un video
                                                      </div>

                                                </div>
                                                {{-- Subir video o enlace --}}
                                                <div class="col-md-12 d-flex justify-content-center" data-toggle="modal" data-target="#modalInsertVideo">
                                                    <button class="btn btn-outline-dark flex-shrink-0" type="button">
                                                        <em class="fa fa-upload"></em>
                                                        Subir video
                                                    </button>

                                                </div>




                                            </div>
                                            @endif

                                        @else
                                        <div class="row ">
                                            <div class="col-md-12 d-flex justify-content-center">
                                                <nav>
                                                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                                        <a class="nav-item nav-link active" id="nav-profile-tab" data-toggle="tab" href="#nav-stripe" role="tab" aria-controls="nav-profile" aria-selected="false"><img style="width:40px;" src="{{ asset('img/stripe.png') }}" alt=""></a>
                                                    </div>
                                                </nav>
                                             </div>

                                             @if ( $serviceProfile->precio_actual>=$serviceProfile->precio*0.25 && $serviceProfile->IntermediateChange->cha_25_percent_active==false)
                                                {{-- Llega al 25% y no tiene video --}}
                                                <button disabled class="btn btn-danger theme--create bttn-large flex mb3 ">
                                                    Estamos pidiendo un video de prueba al que ofrece el servicio
                                                </button>
                                                <label class="text-danger" for="">
                                                * Actualmente las donaciones estan inhabilitadas, hasta que el usuario coloque un video de prueba.Sea paciente
                                                </label>
                                             @else
                                             <div class="col-md-12">
                                                <div class="tab-content" id="nav-tabContent">

                                                    {{-- Pago para stripe --}}
                                                    <div class="tab-pane fade show active" id="nav-stripe" role="tabpanel" aria-labelledby="nav-profile-tab">
                                                        <br>
                                                        @if($serviceProfile->precio <=$serviceProfile->precio_actual)
                                                            <button style="cursor: default !important" disabled class="bttn bttn-primary theme--create bttn-large flex mb3 ">
                                                                !Alcanzo la meta¡
                                                            </button>
                                                        @else

                                                        <form action="{{ route('proccessPaymentStripe2') }}" method="POST">
                                                            @csrf
                                                            <input type="hidden" name="serviceOffer" value="{{ $serviceProfile->id }}">
                                                            <input type="hidden" name="cantidadMeta" value="{{ $serviceProfile->precio }}">
                                                            <input type="hidden" name="cantidadActual" value="{{ $serviceProfile->precio_actual }}">
                                                            <input type="number" name="cantidadDonacion" required step="0.01" min="1" max="{{ $serviceProfile->precio-$serviceProfile->precio_actual }}" class="form-control" placeholder="Insertar cantidad a donar">
                                                            @error('cantidadDonacion')
                                                            <div class="alert alert-danger" role="alert">
                                                              <strong>Atención.</strong> {{ $message }}
                                                              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                              </button>
                                                            </div>
                                                            @enderror



                                                            <br>
                                                            <script src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                                                                data-key="{{ config('services.stripe.key') }}"
                                                                data-name="{{ $serviceProfile->IntermediateChange->cha_name }}"
                                                                data-description="{{ $serviceProfile->description }}"
                                                                data-panel-label="Donar"
                                                                data-image="https://logos-world.net/wp-content/uploads/2021/03/Stripe-Symbol.png"
                                                                data-locale="es">
                                                            </script>
                                                            <script>
                                                                // Esconde el button por defecto
                                                                document.getElementsByClassName("stripe-button-el")[0].style.display = 'none';
                                                            </script>
                                                            <button type="submit" class="bttn bttn-primary theme--create bttn-large flex mb3 keyboard-focusable">
                                                                Patrocina este proyecto (stripe)
                                                            </button>
                                                            <label class="text-info" for="">
                                                                * Cuando llegue al 25% o mas la pagina exigirá un video sobre evidencia del servicio, asi que dona con precaución
                                                                (Si una donacion cubre todo el costo de todas maneras exigiremos el video)
                                                            </label>

                                                        </form>
                                                        @endif

                                                    </div>
                                                </div>
                                             </div>
                                             @endif

                                        </div>



                                        @endif
                                    @else
                                    <button onclick="window.location.href='{{ route('login') }}'" class="bttn bttn-primary theme--create bttn-large flex mb3 keyboard-focusable">
                                                Identificate
                                            </button>
                                            <label for="" class="text-info">* Para poder donar, necesitas identificarte</label>

                                    @endif

                                </div>
                                </div>
                              </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
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
            <input type="hidden" class="set-service-name-input" name="serviceName" value="{{ $serviceProfile->IntermediateChange->cha_name }}" required>
            <input type="hidden" class="set-user-offer-name-input" name="userNameProvider" value="{{ $serviceProfile->IntermediateUseOcc->name.$serviceProfile->IntermediateUseOcc->lastname}}" required>
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

         {{-- comentario --}}
        {{-- comentario --}}
        <div class="px-4 px-lg-5 my-5">
            <div class="col-3">
                <h2 class="headertekst">Comentarios</h2>
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

                        @foreach($serviceProfile->UseOccPostQuestion as $ques)

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
                                        <input type="hidden" name="typeJobFromComment" value="1">
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
                            @foreach( $serviceProfile->UseOccPostComment as $coment)
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

                                                <div class="card p-2 mt-3" style="background-color: rgb(154, 231, 195)">
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

                            @endforeach
                        </section>
                        <!-- Post Ends -->
                    </div>
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-body p-3">
                                <h5 class="card-title m-0">Oficios Disponibles</h5>
                                <div class="list-group list-group-flush">
                                    @foreach($SerOcc as $so)
                                    {{-- <a href="{{ route('showProfileServiceOccupation',$so->id) }}" class="list-group-item list-group-item-action text-primary">{{ $so->IntermediateOcc->ser_occ_name }}</a> --}}
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
                                    <a href="{{ route('showProfileServiceTalent',$st->id) }}" class="list-group-item list-group-item-action text-primary">{{ $st->IntermediateTal->ser_tal_name }}</a>
                                    @endforeach
                                    <a href="{{ route('showTalentService') }}" class="btn btn-sm btn-primary">Ver más</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            {{-- Quitar form? --}}
        @livewireScripts
        {{-- Quitar div? --}}
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
                            <input type="hidden" name="typeJobFromQuestion" value="1">
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

@error('urlVideo')
<script>
    Swal.fire({
        title: "Error al insertar url",
        html:  `
        {{ $message}}
        <br>`,
        icon: "error"
    });
</script>
@enderror


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
        title: "Donacion realizada",
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

