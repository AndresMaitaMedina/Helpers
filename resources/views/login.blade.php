@extends('layouts.app')


@section('contenido_js')

@endsection

@section('contenido_cSS')
<link rel="stylesheet" href="{{ asset('/css/styleLoginCss.css') }}">

<link href="{{ asset('/css/estilos.css') }}" rel="stylesheet"> 

<link href="{{ asset('/css/style.css') }}" rel="stylesheet"> 
<link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">

@endsection


@section('content')
<main>
    <div class="contenedor__todo">
        <div class="caja__trasera">
            <div class="caja__trasera-login">
                <h3>¿Ya tienes una cuenta?</h3>
                <p>Inicia sesión para entrar en la página</p>
                <button id="btn__iniciar-sesion">Iniciar Sesión</button>
            </div>
            <div class="caja__trasera-register">
                <h3>¿Aún no tienes una cuenta?</h3>
                <p>Regístrate para que puedas iniciar sesión</p>

                
            </div>
        </div>

            <!--Formulario de Login y registro-->
            <div class="contenedor__login-register">
                <!--Login-->
                <div class="card-header">{{ __('Login') }}</div>
                <form class="formulario__login" form method="POST" action="">

                    @csrf

                    <h2>Iniciar Sesión</h2>

                    <input id="email" type="email" placeholder="Correo electrónico" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                    @error('email')
                        <br>
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                    <input id="password" type="password" placeholder="Contraseña" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                    @error('password')
                        <br>
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <button type="submit" class="btn btn-primary">
                        {{ __('Entrar') }}
                    </button>
                    

                </form>

                <!--Register-->
                <form action="" class="formulario__register">
                    <h2>Regístrarse</h2>
                    <input type="text" placeholder="Nombre completo">
                    <input type="text" placeholder="Correo Electronico">
                    <input type="text" placeholder="Usuario">
                    <input type="password" placeholder="Contraseña">
                    <button>Regístrarse</button>
                </form>
            </div>
        </div>
    </div>

</main>
@endsection

@section('contenido_abajo_js')
<script>
    var x = document.getElementById('login');
    var y = document.getElementById('register');
    var z = document.getElementById('btn');
    function register() {
        x.style.left = '-400px';
        y.style.left = '50px';
        z.style.left = '110px';
    }
    function login() {
        x.style.left = '50px';
        y.style.left = '450px';
        z.style.left = '0px';
    }
</script>
<script src="../../../public/js/script.js"></script>
@endsection




