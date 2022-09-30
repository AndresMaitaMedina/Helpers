<div class="container">
  <div class="row">
    <div class="col-6 overflow-scroll" style="height: 100%;"><br>
      @foreach ($datos as $mensaje)

        <div class="row">
            <div class="col-12">
              <p>De tu servicio: {{ $mensaje->servicio }}</p>
            </div>
            <div class="col-6 text-truncate pt-1">
              <strong>{{ $mensaje->IntermediateUser->name}}:</strong> {{ $mensaje->mensaje }}
            </div>
            <div class="col-6">
              <button class="btn btn-success btn-sm btn-block" wire:click="responderM({{ $mensaje->IntermediateUser->id}}, {{ $mensaje->id_servicio }})">Ver mensajes</button>
            </div>
        </div><hr>
      @endforeach
    </div>
    <div class="col-6 px-4 media-body"><br>
        <h3>
          Mensajes:
          @if($mensajes)
            @foreach ($mensajes as $hist)
              @if($hist->envia == auth()->user()->id)
                <div style="border:1px solid black;background-color:#36D1DC;" class="m-1 rounded">
                  <p class="text-right p-1 m-1" style="font-size: 1rem;">{{ $hist->mensaje}}</p>
                </div>
              @else
                <div style="border:1px solid black; word-wrap: break-word; background-color:#F3F9A7;" class="rounded m-1">
                  <p class="text-left p-1 m-1" style="font-size: 1rem;"><strong>{{ $rCliente->IntermediateUser->name }}</strong>: {{ $hist->mensaje}}</p>
                </div>
              @endif
            @endforeach

            @if($habilitarInput)
              <div class="row justify-content-center" style="display: flex;
              align-items: center;">
                <div class="col-8 pr-1">
                  <input class="form-control form-control my-1 pr-0 inputChat" wire:keydown.enter="enviarRespuesta" type="text" placeholder="Escribir" wire:model="respuesta">
                </div>
                <div class="col-4 pl-0" >
                  <button class="btn btn-success btn-block" wire:click="enviarRespuesta">Enviar</button>
                </div>
              </div>
            
            @else
              <input class="form-control form-control-lg m-1 inputChat" wire:keydown.enter="enviarRespuesta" type="text" placeholder="Escribir"  disabled>
            @endif


          @else
          @endif
        </h3>
    </div>
  </div>
</div>

<script>
    
    Pusher.logToConsole = true;
    var pusher = new Pusher('0cceeee491b92f68de44', {
    cluster: 'mt1'
    });
    var channel = pusher.subscribe('chat-channel');
    channel.bind('chat-event', function(data) {
        // alert(JSON.stringify(data));
        Livewire.emit('llegadaMensaje');
        app.messages.push(JSON.stringify(data));
    });
</script>
