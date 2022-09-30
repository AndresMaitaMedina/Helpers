@extends('layouts.app')

@section('contenido_js')

  <!-- Required meta tags-->
  <meta name="description" content="Colorlib Templates">
  <meta name="author" content="Colorlib">
  <meta name="keywords" content="Colorlib Templates">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

@endsection

@section('contenido_cSS')

    <link rel="stylesheet" href="{{ asset('css/registro.css') }}" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"/>
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" integrity="sha384-RFZC58YeKApoNsIbBxf4z6JJXmh+geBSgkCQXFyh+4tiFSJmJBt+2FbjxW7Ar16M" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i" rel="stylesheet">

@endsection


@section('content')
    <div class="page-wrapper bg-gra-03 p-t-45 p-b-50">
        <div class="wrapper wrapper--w790">
            <div class="card card-5">
                <div class="card-heading">
                    <h2 class="title">Registre su servicio</h2>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="servicio">Seleccione el tipo de servicio que quiere brindar</label> <br>
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                          




                          <li class="nav-item" role="presentation">
                            <a class="nav-link @if (Route::currentRouteName() != 'offerMyServiceChange') active @endif" id="service-tab" data-toggle="tab" href="#service" role="tab" aria-controls="service" aria-selected="true">
                              <button type="button" class="btn btn-primary btn-lg">Servicio Técnico</button>
                            </a>
                          </li>
                          <li class="nav-item" role="presentation">
                            <a class="nav-link" id="talent-tab" data-toggle="tab" href="#talent" role="tab" aria-controls="talent" aria-selected="false">
                              <button type="button" class="btn btn-secondary btn-lg">Talento</button>
                            </a>
                          </li>
                          <li class="nav-item" role="presentation">
                            <a class="nav-link @if (Route::currentRouteName() == 'offerMyServiceChange') active @endif" id="reto-tab" data-toggle="tab" href="#reto" role="tab" aria-controls="reto" aria-selected="false">
                              <button type="button" class="btn btn-info btn-lg">Reto</button>
                            </a>
                          </li>                          


                        </ul>
                    </div>
                    <div class="tab-content" id="myTabContent">
                    {{-- Registro de Tecnico --}}
                      <div class="tab-pane fade @if (Route::currentRouteName() != 'offerMyServiceChange') show active @endif" id="service" role="tabpanel" aria-labelledby="service-tab">
                        <form action=" {{route('servicio.tecnico')}} " method="POST" enctype="multipart/form-data">
                          @csrf
                          <div class="form-group">
                            <label for="servicioTecn">Seleccione su servicio técnico perteneciente</label>
                            <select class="form-control" id="servicioTecn" name="servicioTecn" required>
                                  <option value= "">Seleccione su servicio correspondiente</option>
                              @foreach ($serviciosTec as $item)
                                  <option value= {{$item->id}}>{{$item->ser_occ_name}}</option>
                              @endforeach
                            </select>
                          </div>
                          @error('nombreTecn')
                          <div class="alert alert-danger" role="alert">
                            <strong>Atención.</strong> El nombre de su servicio debe tener un mínimo de 10 letras y un máximo de 45.
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          @enderror
                          <div class="form-group">
                            <label for="nombreTecn">Ingrese el nombre de su servicio</label>
                            <input class="form-control" id="nombreTecn" name="nombreTecn" type="text" required>
                          </div>
                          @error('detallesTecn')
                            <div class="alert alert-danger" role="alert">
                              <strong>Atención.</strong> La descripción del servicio debe tener un mínimo de 10 letras.
                              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                          @enderror
                          <div class="form-group">
                            <label for="detallesTecn">Ingrese los detalles de su servicio</label>
                            <textarea class="form-control" id="detallesTecn" name="detallesTecn" rows="3" required></textarea>
                          </div>
                          @error('costoTecn')
                          <div class="alert alert-danger" role="alert">
                            <strong>Atención.</strong> Por favor ingrese el costo de su servicio (entre 10 y 10000 soles).
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          @enderror
                          <div class="form-group">
                            <label for="costoTecn">Ingrese el costo de su servicio</label>
                            <input type="number" class="form-control" id="costoTecn" name="costoTecn" min="10" max="10000" required>
                          </div>
                          @error('imagenTecn')
                          <div class="alert alert-danger alert-dismissible fade show" role="alert">
                              <small>Solo se acepta imagen con formato JPEG,BMP,JPG o PNG (máx 6MB)</small>
                              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                              </button>
                          </div>
                          @enderror
                          <div class="form-group">
                              <label for="imagenTecn">Ingrese una imagen referente de su servicio</label>
                              <input type="file" accept="image/bmp,image/jpeg,image/jpg,image/png" class="form-control-file" id="imagenTecn" name="imagenTecn" required>
                              <p class="text-info">Minimo Tamaño : 256x256px
                                <br>
                                Maximo Tamaño : 2048x2048px
                              </p>
                            </div>
                          <button type="submit" class="btn btn-primary">Guardar servicio</button>
                        </form>
                      </div>
                      {{-- Registro de Talento --}}

                      <div class="tab-pane fade" id="talent" role="tabpanel" aria-labelledby="talent-tab">
                        <form action=" {{route('servicio.talento')}} " method="POST" enctype="multipart/form-data">
                          @csrf
                          <div class="form-group">
                            <label for="servicioTalen">Seleccione su talento perteneciente</label>
                            <select class="form-control" id="servicioTalen" name ="servicioTalen" required>
                              <option value= "">Seleccione su servicio correspondiente</option>
                              @foreach ($serviciosTal as $item)
                                  <option value={{$item->id}}>{{$item->ser_tal_name}}</option>
                              @endforeach
                            </select>
                          </div>
                          @error('nombreTalen')
                          <div class="alert alert-danger" role="alert">
                            <strong>Atención.</strong> El nombre de su talento debe tener un mínimo de 10 letras  y un máximo de 45.
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          @enderror
                          <div class="form-group">
                            <label for="nombreTalen">Ingrese el nombre de su talento</label>
                            <input class="form-control" id="nombreTalen" name="nombreTalen" type="text" required>
                          </div>
                          @error('detallesTalen')
                          <div class="alert alert-danger" role="alert">
                            <strong>Atención.</strong> La descripción de su talento debe tener un mínimo de 10 letras.
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          @enderror
                          <div class="form-group">
                            <label for="detallesTalen">Ingrese los detalles de su talento</label>
                            <textarea class="form-control" id="detallesTalen" name="detallesTalen" rows="3" required></textarea>
                          </div>
                          @error('costoTalen')
                          <div class="alert alert-danger" role="alert">
                            <strong>Atención.</strong> Por favor ingrese el costo de su servicio (entre 10 y 10000 soles).
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          @enderror
                          <div class="form-group">
                            <label for="costoTalen">Ingrese el costo de su talento</label>
                            <input type="number" class="form-control" id="costoTalen" name="costoTalen" min="10" max="10000" required>
                          </div>
                          @error('imagenTalen')
                          <div class="alert alert-danger alert-dismissible fade show" role="alert">
                              <small>Solo se acepta imagen con formato JPEG,BMP,JPG o PNG (máx 6MB)</small>
                              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                              </button>
                          </div>
                          @enderror
                          <div class="form-group">
                              <label for="imagenTalen">Ingrese una imagen referente de su talento</label>
                              <input type="file" accept="image/bmp,image/jpeg,image/jpg,image/png" class="form-control-file" id="imagenTalen" name ="imagenTalen" required>
                              <p class="text-info">Minimo Tamaño : 256x256px
                                <br>
                                Maximo Tamaño : 2048x2048px
                              </p>
                            </div>
                          <button type="submit" class="btn btn-primary">Guardar servicio</button>
                        </form>
                      </div>
                      {{-- Registro de Reto --}}
                      <div class="tab-pane fade @if (Route::currentRouteName() == 'offerMyServiceChange') show active @endif" id="reto" role="tabpanel" aria-labelledby="reto-tab">

                        <form action="{{ route('servicio.reto') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <label for="" class="text-info">* Solo se puede tener un reto "activo" a la vez, si registras un reto entonces necesitas cumplir el reto para registrar otro</label>
                            <div class="form-group">
                              <label for="nombreReto">¿Qué reto desea asumir? (Nombre del reto)</label>
                              <textarea class="form-control" id="nombreReto" name="nombreReto" rows="1" required></textarea>
                            </div>

                            @error('nombreReto')
                            <div class="alert alert-danger" role="alert">
                              <strong>Atención.</strong> {{ $message }}.
                              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            @enderror


                            <div class="form-group">
                              <label for="detallesReto">Ingrese una breve descripción sobre su reto.</label>
                              <textarea class="form-control" id="detallesReto" name="detallesReto" rows="3" required></textarea>
                            </div>

                            @error('detallesReto')
                            <div class="alert alert-danger" role="alert">
                              <strong>Atención.</strong> {{ $message }}
                              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            @enderror

                            <div class="form-group">
                              <label for="costoReto">¿Qué meta monetaria solicita para realizar el reto?</label>
                              <input type="number" class="form-control" id="costoReto" name="costoReto" required>
                            </div>

                            @error('costoReto')
                            <div class="alert alert-danger" role="alert">
                              <strong>Atención.</strong> {{ $message }}
                              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            @enderror


                            <div class="form-group">
                                <label for="imagenReto">Ingrese una imagen referente de su reto</label>
                                <input type="file" accept="image/bmp,image/jpeg,image/jpg,image/png" class="form-control-file" id="imagenReto" name ="imagenReto" required>
                                <p class="text-info">Minimo Tamaño : 256x256px
                                  <br>
                                  Maximo Tamaño : 2048x2048px
                                </p>  
                              </div>
                              @error('imagenReto')
                              <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                  <small>Solo se acepta imagen con formato JPEG,BMP,JPG o PNG (máx 6MB) {{ $message }}</small>
                                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                  </button>
                              </div>
                              @enderror                              
                            <button type="submit" class="btn btn-primary">Guardar Reto</button>
                          </form>
                      </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection

@section('contenido_abajo_js')
  {{-- Registro fallo --}}

  @if(session('failedChangeActive'))
    <script>
        Swal.fire({
            title: "Error en el registro del reto",
            html:  `
            <br>
            <br>
            <p> {{ session('failedChangeActive') }}</p>
            `,
            icon: "error"
        });
    </script>
  @endif


  @if ($errors->any())
  <script>
      Swal.fire({
          title: "Error en el registro del servicio",
          html:  `
          <strong>Errores encontrados, vuelva a intentalo</strong> : 
          <br>
          <br>
          <ul>
              @foreach ($errors->all() as $errorRegister)
                  <li>{{ $errorRegister }}</li>
              @endforeach
          </ul>`,
          icon: "error"
      });
  </script>
  @endif  
  {{-- Registro exitoso --}}
  @if (session('serviceMessage'))
  <script>
      Swal.fire({
          title: "Registro correctamente",
          html:  `
          {{session('serviceMessage')}}`,
          icon: "success"
      });
  </script>
  @endif
@endsection
