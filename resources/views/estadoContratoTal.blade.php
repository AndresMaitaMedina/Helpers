@extends('layouts.app')


@section('contenido_js')
    
@endsection

@section('contenido_cSS')

@endsection


@section('content')


<br>
<h1 style="text-align: center">Contrato N° <span>{{$id}} </span></h1>
<div class="row">
    <div class="col-sm-6">
    <div class="card" style="width: 18rem; margin-left : 14rem; margin-top: 2rem; margin-bottom: 2rem">
        <img class="card-img-top" src="{{$dataTal->imagen}}" alt="Card image cap">  
        <div class="card-body">
            <h5 class="card-title">Datos tecnico</h5>
            <p class="card-text">{{$dataTal->descripcion}}</p>
        </div>
        <ul class="list-group list-group-flush">
            <li class="list-group-item">{{$contr->con_initial}}</li>
            <li class="list-group-item">{{$userOff->name, $userOff->lastname}}</li>
            <li class="list-group-item">{{$dataTal->ser_tal_name}}</li>
        </ul>
    </div>
    </div>

<div class="col-sm-3" style="text-align: center; margin-top: 4rem">
    @if (Auth::user()->id == $contr->use_receive)
        <h2>Detalles del contrato</h2>
        <p>{{"Fecha inicial del contrato: ". Carbon\Carbon::parse($contr->con_initial)->format('Y-m-d')}}</p>
        <p>{{"Hora del contrato: ". Carbon\Carbon::parse($contr->con_initial)->format('H:i:s')}}</p>
            <p>{{"Ubicación: ".$contr->con_address}}</p>
            <label>Estado: </label>
            @if ($contr->con_status == 1)
                <label>Pendiente</label><br>
            @endif
            @if ($contr->con_status == 2)
                <label>En ejecución</label><br>
                <form action=" {{route('end.contract')}} " method="POST">
                    @csrf
                    <input type="hidden" name="contractId" value="{{ $id }}" required>
                    <button type="submit" class="btn btn-primary btn-lg">Finalizar contrato</button>
                </form>
            @endif
            @if ($contr->con_status == 3)
                <label>Terminado</label><br>
            @endif
            <br> <br>
    @elseif(Auth::user()->id == $contr->use_offer)        
        <h2>Detalles del contrato</h2>
        <p>{{"Fecha inicial del contrato: ". Carbon\Carbon::parse($contr->con_initial)->format('Y-m-d')}}</p>
        <p>{{"Hora del contrato: ". Carbon\Carbon::parse($contr->con_initial)->format('H:i:s')}}</p>
        <p>{{"Ubicación: ".$contr->con_address}}</p>
        <label>Estado: </label>
        @if ($contr->con_status == 1)
            <label>Pendiente</label><br>
            <form action=" {{route('eject.contract')}} " method="POST">
                @csrf
                <input type="hidden" name="contractId" value="{{ $id }}" required>
                <button type="submit" class="btn btn-primary btn-lg">Poner en marcha servicio de talento</button>
            </form>
        @endif
        @if ($contr->con_status == 2)
            <label>En ejecución</label><br>
        @endif
        @if ($contr->con_status == 3)
            <label>Terminado</label><br>
        @endif        
    @endif

</div>
</div>
@endsection

@section('contenido_abajo_js')
<script>
</script>
    
@endsection