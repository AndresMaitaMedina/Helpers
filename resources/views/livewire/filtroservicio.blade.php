<div class="row">
    <div class="col-4">
        <div style="text-align: center">

            <br><h5>Precio S/</h5>
            <div>
                @error('precio')
                    <span class="badge badge-danger">{{ $message }}</span>
                @enderror
                <div class=""><input type="text" class="" name="precio" wire:model="precio"></div>
            </div>
            <div class="mb-3">
                <p>Ocupaciones:</p>
                <select class="desplegable" wire:model="ocupacion" wire:click="ocupacionM">
                    <option value="1" >Gasfitero de madrigueras</option>
                    <option value="2" >Reparador de computadoras</option>
                    <option value="3" >Diseñador grafico</option>
                    <option value="4" >Estampador de polos</option>
                    <option value="5" >Confeccionador de ropa</option>
                </select>
            </div>
            <div>
                <p>Talentos:</p>
                <select class="desplegable" wire:model="talento" wire:click="talentoM">
                    <option value="1" >Abridor de cajas</option>
                    <option value="2" >Narrador de audiolibros</option>
                    <option value="3" >Contador de chistes</option>
                    <option value="4" >Probador de ropa</option>
                    <option value="5" >Creador de videos rapidos</option>
                </select>
            </div>
    
            
        </div>
    </div>
    <div class="col-8 text-center my-2">
        <h4>Filtro de servicios:</h4>
        @if($datos->count())
            <h4>Resultados para: {{ $tipo }}</h4>
            @foreach($datos as $dato)
                @if($talento)
                    <div class="row mt-2">
                        <div class="col-4">
                            <img alt="Imagen de servicio" class="img-fluid"  src="{{ $dato->imagen}}">
                        </div>
                        <div class="col-7 text-left">
                            <p>Descripcion: {{ $dato->descripcion}}</p>
                            <p>Precio: {{ $dato->precio}} S/</p>
                            <a class="btn btn-success my-1" href="{{ route('showProfileServiceTalent',$dato->id) }}">Ir a servicio</a>
                        </div>
                        <div class="col-1"></div>
                    </div>
                    
                    
                @elseif($ocupacion)
                    <div class="row mt-2">
                        <div class="col-4">
                            <img alt="Imagen de servicio" src="{{ $dato->imagen}}">
                        </div>
                        <div class="col-7 text-left">
                            <p>Descripcion: {{ $dato->descripcion}}</p>
                            <p>Precio: {{ $dato->precio}} S/</p>
                            <a class="btn btn-success my-1" href="{{ route('showProfileServiceOccupation',$dato->id) }}">Ir a servicio</a>
                        </div>
                        <div class="col-1"></div>
                    </div>
                @endif
            @endforeach
        @else
            <p></p>
        @endif
    </div>
</div>