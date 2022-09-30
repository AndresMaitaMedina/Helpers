@extends('layouts.app')
@section('contenido_js')

@endsection

@section('contenido_cSS')
<style>
.bg-gradient {
    background: #C9D6FF;
    }
    ul li {
      margin-bottom:1.4rem;
    }
    .pricing-divider {
    border-radius: 20px;
    background: #C64545;
    padding: 1em 0 4em;
    position: relative;
    }
    .blue .pricing-divider{
    background: #2D5772;
    }
    .green .pricing-divider {
    background: #1AA85C;
    }

    .blue strong {
      color:#2D5772
    }
    .green strong {
      color:#1AA85C
    }
    .pricing-divider-img {
        position: absolute;
        bottom: -2px;
        left: 0;
        width: 100%;
        height: 80px;
    }
    .deco-layer {
        -webkit-transition: -webkit-transform 0.5s;
        transition: transform 0.5s;
    }
    .btn-custom  {
      background:#C64545; color:#fff; border-radius:20px
    }

    .img-float {
      width:50px; position:absolute;top:-3.5rem;right:1rem
    }

    .princing-item {
      transition: all 150ms ease-out;
    }
    .princing-item:hover {
      transform: scale(1.05);
    }
    .princing-item:hover .deco-layer--1 {
      -webkit-transform: translate3d(15px, 0, 0);
      transform: translate3d(15px, 0, 0);
    }
    .princing-item:hover .deco-layer--2 {
      -webkit-transform: translate3d(-15px, 0, 0);
      transform: translate3d(-15px, 0, 0);
    }


</style>
@endsection


@section('content')
<div class="container-center bg-gradient p-5">
    <div class="row m-auto text-center w-75">





      <div class="col-md-6 princing-item blue">
        <div class="pricing-divider ">
            <h3 class="text-light">Suscripcion Gratuita</h3>
          <h4 class="my-0 display-4 text-light font-weight-normal mb-3"><span class="h3">$</span>0 <span class="h5">/mo</span></h4>
           <svg class='pricing-divider-img' enable-background='new 0 0 300 100' height='100px' id='Layer_1' preserveAspectRatio='none' version='1.1' viewBox='0 0 300 100' width='300px' x='0px' xml:space='preserve' xmlns:xlink='http://www.w3.org/1999/xlink' xmlns='http://www.w3.org/2000/svg' y='0px'>
        <path class='deco-layer deco-layer--1' d='M30.913,43.944c0,0,42.911-34.464,87.51-14.191c77.31,35.14,113.304-1.952,146.638-4.729
  c48.654-4.056,69.94,16.218,69.94,16.218v54.396H30.913V43.944z' fill='#FFFFFF' opacity='0.6'></path>
        <path class='deco-layer deco-layer--2' d='M-35.667,44.628c0,0,42.91-34.463,87.51-14.191c77.31,35.141,113.304-1.952,146.639-4.729
  c48.653-4.055,69.939,16.218,69.939,16.218v54.396H-35.667V44.628z' fill='#FFFFFF' opacity='0.6'></path>
        <path class='deco-layer deco-layer--3' d='M43.415,98.342c0,0,48.283-68.927,109.133-68.927c65.886,0,97.983,67.914,97.983,67.914v3.716
  H42.401L43.415,98.342z' fill='#FFFFFF' opacity='0.7'></path>
        <path class='deco-layer deco-layer--4' d='M-34.667,62.998c0,0,56-45.667,120.316-27.839C167.484,57.842,197,41.332,232.286,30.428
  c53.07-16.399,104.047,36.903,104.047,36.903l1.333,36.667l-372-2.954L-34.667,62.998z' fill='#FFFFFF'></path>
      </svg>
        </div>

        <div class="card-body bg-white mt-0 shadow">
          <ul class="list-unstyled mb-5 position-relative">

            <li><label>Registrar oficios sin límite</label></li>
            <li><label>Registrar talentos sin límites</label></li>
            <li><label>Publicar demanda de servicio sin límite</label></li>
            <li><label>Comunicacón privada con el dueño de un servicio</label></li>
          </ul>
          <button disabled type="button" class="btn btn-lg btn-block  btn-danger">Suscribirse</button>
        </div>

    </div>






      <div class="col-md-6 princing-item green">
        <div class="pricing-divider ">
            <h3 class="text-light">Premium</h3>
          <h4 class="my-0 display-4 text-light font-weight-normal mb-3"><span class="h3">$</span> 5<span class="h5">/mo</span></h4>
           <svg class='pricing-divider-img' enable-background='new 0 0 300 100' height='100px' id='Layer_1' preserveAspectRatio='none' version='1.1' viewBox='0 0 300 100' width='300px' x='0px' xml:space='preserve' xmlns:xlink='http://www.w3.org/1999/xlink' xmlns='http://www.w3.org/2000/svg' y='0px'>
        <path class='deco-layer deco-layer--1' d='M30.913,43.944c0,0,42.911-34.464,87.51-14.191c77.31,35.14,113.304-1.952,146.638-4.729
  c48.654-4.056,69.94,16.218,69.94,16.218v54.396H30.913V43.944z' fill='#FFFFFF' opacity='0.6'></path>
        <path class='deco-layer deco-layer--2' d='M-35.667,44.628c0,0,42.91-34.463,87.51-14.191c77.31,35.141,113.304-1.952,146.639-4.729
  c48.653-4.055,69.939,16.218,69.939,16.218v54.396H-35.667V44.628z' fill='#FFFFFF' opacity='0.6'></path>
        <path class='deco-layer deco-layer--3' d='M43.415,98.342c0,0,48.283-68.927,109.133-68.927c65.886,0,97.983,67.914,97.983,67.914v3.716
  H42.401L43.415,98.342z' fill='#FFFFFF' opacity='0.7'></path>
        <path class='deco-layer deco-layer--4' d='M-34.667,62.998c0,0,56-45.667,120.316-27.839C167.484,57.842,197,41.332,232.286,30.428
  c53.07-16.399,104.047,36.903,104.047,36.903l1.333,36.667l-372-2.954L-34.667,62.998z' fill='#FFFFFF'></path>
      </svg>
        </div>

        <div class="card-body bg-white mt-0 shadow">
          <ul class="list-unstyled mb-5 position-relative">
            <li><strong>Registrar oficios sin límite</strong></li>
            <li><strong>Registrar talentos sin límites</strong></li>
            <li><strong>Publicar demanda de servicio sin límite</strong></li>
            <li><strong>Comunicacón privada con el dueño de un servicio</strong></li>
            <li><strong>Destacar tu servicio sobre el resto</strong></li>
          </ul>

          <!-- The Modal -->
          <div class="tab-pane" id="nav-stripe" role="tabpanel" aria-labelledby="nav-profile-tab">
            <br>
            <form action="{{ route('proccessPaymentPremiumStripe') }}" method="POST">
                @csrf
                <script src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                    data-key="{{ config('services.stripe.key') }}"
                    data-amount="500"
                    data-name="Subscription premium"
                    data-description="Subscription premium for the user"
                    data-image="https://logos-world.net/wp-content/uploads/2021/03/Stripe-Symbol.png"
                    data-locale="auto">
                </script>
                <script>
                    // Esconde el button por defecto
                    document.getElementsByClassName("stripe-button-el")[0].style.display = 'none';

                </script>
                @auth
                @if (auth()->user()->premium == true)
                <h4 style="color: rgb(4, 0, 255)" >Usted ya es usuario premium</h4>
                @else
                    <button type="submit button" class="btn btn-lg btn-block  btn-danger "aria-disabled="false">Suscribirse</button>
                @endif
                @endauth
                @guest
                  <a href="{{ route('login') }}"><button type="button" class="btn btn-lg btn-block  btn-danger"aria-disabled="false">Suscribirse</button></a>
                @endguest

            </form>
          </div>
        </div>
      </div>






    </div>
  </div>

</div>
@endsection

@section('contenido_abajo_js')
<script>
</script>

@endsection
