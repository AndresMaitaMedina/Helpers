@extends('layouts.app')


@section('contenido_js')

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>


@endsection

@section('contenido_cSS')

@endsection


@section('content')
<div class="container">

    <div class="row">
        <div class="col-md-6 my-3">

            <div class="">
                <img src="img/user.png" class="img-fluid" width="200" height="200" alt="imagen usuario">
            </div>
            <div>
                <h3>Descripcion</h3>
                <p>Descricpion del profesional</p>
            </div>
        </div>

        <div class="col-md-6 my-3">
                <!-- Boton modal -->
    <button type="button" class="btn btn-secondary p-3" data-bs-toggle="modal" data-bs-target="#exampleModal">
        Servicio 1
        </button>

      <!-- Modal -->
        <form class="" method="POST" enctype="" action="" novalidate>
            {{csrf_field()}}
            @csrf
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
                                <input type="time" class="form-control" name="hora_contrato">
                                <label class="m-1">Fecha: </label>
                                <input type="date" class="form-control" value="{{ old('') }}" name="fecha_contrato" min="2020-11-02" id="fechaContrato" required>
                                <label class="m-1">Descripcion</label><br>
                                <input class="form-control" placeholder="Escriba aquí">
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



        </div>

    </div>

    <script type="text/javascript">
    </script>


</div>

@endsection

@section('contenido_abajo_js')

@endsection
