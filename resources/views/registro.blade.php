@extends('layouts.app')

@section('contenido_js')

@endsection

@section('contenido_cSS')
<link href="{{ asset('css/registrocss.css') }}" rel="stylesheet">
@endsection



@section('content')


<div class="content-main-layout">

<div class="container register">
    <div class="row">
        <div class="col-md-3 register-left">
            <img src="data:image/png;base64,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" alt=""/>
            <h3>TalentWork</h3>
            <p>Bienvenido esperamos que su registro sea rápido y sencillo :)</p>

        </div>
        <div class="col-md-9 register-right" style="background: rgba(252, 255, 255, 0.8);">


            <div class="tab-content" id="myTabContent" >
                <div class="tab-pane fade show active"  style="background: transparent !important" id="home" role="tabpanel" aria-labelledby="home-tab">

                    
                    <h3 class="register-heading text-black" >TalentWork te espera el primer paso es registrarse</h3>
                    <form method="POST" action="{{ route('registrarUsuario') }}">
                        @csrf

                        <div class="row register-form">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Nombres *" value="{{ old('name') }}"  autofocus autocomplete="" />
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>

                                    @enderror
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control @error('lastname') is-invalid @enderror" name="lastname" placeholder="Apellidos *" value="{{ old('lastname') }}"  />
                                    @error('lastname')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>

                                    @enderror
                                </div>
                                    

                                <div class="form-group">
                                    <input type="number" minlength="10" maxlength="10" name="dni" class="form-control @error('dni') is-invalid @enderror" placeholder="Escriba su DNI *" value="{{ old('dni') }}"  />                                    

                                    @foreach ($errors->notfound->all() as $errorRegister)
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            <strong>Invalido !</strong>{{ $errorRegister }}, puede consultar <a href="https://portaladminusuarios.reniec.gob.pe/validacionweb/index.html#no-back-button" target="_blank">ACA</a>
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>                                        

                                    @endforeach
                                    @if($errors->has('dni'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('dni') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                                               
                                <div class="form-group">
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Correo electronico *"  name="email" value="{{ old('email') }}"  autocomplete="email" />

                                    @if($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif                                    


                                </div>

                            </div>
                            <div class="col-md-6">

                                <div class="form-group">
                                    <input class="form-control @error('birthdate') is-invalid @enderror"  type="text" name="birthdate" placeholder="Fecha de Nacimiento" onclick="ocultarError();" onfocus="(this.type='date')" onblur="(this.type='text')" value="{{ old('birthdate') }}" />
                                    @error('birthdate')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                </div>
                                <div class="form-group">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Contraseña *" name="password"  autocomplete="new-password" value="{{ old('password') }}" />
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                </div>
                                <div class="form-group">
                                    <input id="password-confirm" type="password" class="form-control @error('password_confirmation') is-invalid @enderror"  placeholder="Confirme contraseña *" name="password_confirmation"  autocomplete="new-password" value="{{ old('password_confirmation') }}" />
                                    @error('password_confirmation')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror



                                </div>
                                <input type="submit" class="btnRegister"  value="Registrar"/>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
