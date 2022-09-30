<?php

namespace App\Http\Livewire;
use App\Models\Mensajechat;
use Livewire\Component;
use Auth;

class ChatTalents extends Component
{
    public $mensaje = "";
    public $usuario;
    public $serviceProfile; 
    public $vendedo;
    public $client;
    public $vendedor;
    public $id_servici;
    public $respuesta;


    protected $listeners = ['llegadaMensaje' => 'actualizaMensaje'];

    protected $rules = [
        'mensaje' => 'required|min:1'
    ];

    public function mount(){
        
        $this->client = Auth::user()->id;
        $this->vendedo = $this->serviceProfile->use_id;
        $this->id_servici = $this->serviceProfile->ser_tal_id;
    }

    public function actualizaMensaje(){

        $this->datos = Mensajechat::where("vendedor","=",$this->vendedo)
        ->where("cliente","=",$this->client)
        ->where("id_servicio","=",$this->id_servici)
        ->get();
    }


    public function enviarMensaje(){

        $this->validate();
        $nuevo = new Mensajechat;
        $nuevo->cliente = $this->client;
        $nuevo->vendedor = $this->vendedo;
        $nuevo->mensaje = $this->mensaje;
        $nuevo->envia = $this->client;
        $nuevo->fecha = now();
        $nuevo->servicio = $this->serviceProfile->IntermediateTal->ser_tal_name;
        $nuevo->id_servicio = $this->id_servici;
        $nuevo->save();

        event(new \App\Events\MessageSent($this->vendedor,$this->respuesta));

        $this->emit('enviado');
        $this->reset('mensaje');
        
    }
    
    public function render()
    {
        return view('livewire.chat-talents',[
            "datos" => Mensajechat::where("vendedor","=",$this->vendedo)
                ->where("cliente","=",$this->client)
                ->where("id_servicio","=",$this->id_servici)
            ->get()
        ]);
    }
}
