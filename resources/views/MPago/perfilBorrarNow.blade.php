@extends('layouts.app')
@section('contenido_js')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>

@endsection
@section('contenido_cSS')
@endsection
@section('content')

    <div class="col-12 col-sm-12 col-md-10 col-lg-10">
        <ul class="text-danger">
            @foreach ($errors->contractProccessForm->all() as $errorRegister)
                <li>{{ $errorRegister }}</li>
            @endforeach
        </ul>
    </div>

{{--
    <form action="{{ route('iPContract') }}" method="POST">
        @csrf
        <input type="hidden" name="userOffer" value="1" required>
        <input type="hidden" name="priceOffer" value="20.00" required>
        <input type="hidden" name="serviceOffer" value="1" required>
        <label for="">Dia</label>
        <select name="dayForm" id="" required>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
            <option value="6">6</option>
            <option value="7">7</option>
            <option value="8">8</option>
            <option value="9">9</option>
            <option value="10">10</option>
            <option value="11">11</option>
            <option value="12">12</option>
            <option value="13">13</option>
            <option value="14">14</option>
            <option value="15">15</option>
            <option value="16">16</option>
            <option value="17">17</option>
            <option value="18">18</option>
            <option value="19">19</option>
            <option value="20">20</option>
            <option value="21">21</option>
            <option value="22">22</option>
            <option value="23">23</option>
            <option value="24">24</option>
            <option value="25">25</option>
            <option value="26">26</option>
            <option value="27">27</option>
        </select>
        <label for="">Hora</label>
        <input type="time" name="hourForm" value="{{ old('hourForm') }}" required>
        <label for="">Lugar</label>
        <input type="text" name="addressForm" value="{{ old('addressForm') }}" placeholder="Lugar">
        <label for="">Descripcion</label>
        <input type="text" name="descriptionForm" value="{{ old('descriptionForm') }}" placeholder="Descripcion" >


        <button class="btn-info" type="submit">Contratar</button>
    </form> --}}






    <button type="button" class="btn btn-secondary p-3" data-bs-toggle="modal" data-bs-target="#exampleModal">
        Servicio 1
        </button>



      <!-- Modal -->
        <form class="" action="{{ route('iPContract') }}" method="POST" enctype="" novalidate>
            @csrf

            <input type="hidden" name="userOffer" value="1" required>
            <input type="hidden" name="priceOffer" value="20.00" required>
            <input type="hidden" name="serviceOffer" value="1" required>

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



@endsection
