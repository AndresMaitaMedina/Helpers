<?php

namespace App\Http\Livewire;
use App\Models\Mensajechat;
use App\Models\User;
use Livewire\Component;

use Auth;

class ChatLista extends Component
{
    public $vendedor;
    public $para = "";
    public $mensajes;
    public $respuesta;
    public $id_servicio;
    public $rCliente;
    public $vendedo;
    public $habilitarInput = false;

    
    protected $listeners = ['llegadaMensaje' => 'actualizaMensaje'];

    protected $rules = [
        'respuesta' => 'required|min:1'
    ];


    public function responderM($usuario, $id_servicio){

        $this->habilitarInput = true;
        $this->id_servicio = $id_servicio;
        $this->para = $usuario;
        $this->vendedor = Auth::user()->id;
        $this->mensajes = Mensajechat::where("vendedor","=",$this->vendedor)
                            ->where("cliente","=",$this->para)
                            ->get();

        $this->rCliente = Mensajechat::where("cliente","=",$this->para)
                            ->first();

    }

    public function actualizaMensaje(){

        $this->client = $this->para;
        $this->vendedor = Auth::user()->id;
        $this->datos = Mensajechat::where("vendedor","=",$this->vendedo)
        ->where("cliente","=",$this->client)
        ->where("id_servicio","=",$this->id_servicio)
        ->orderBy('id', 'desc')
        ->get();
        $this->mensajes = Mensajechat::where("vendedor","=",$this->vendedor)
        ->where("cliente","=",$this->para)
        ->get();
    }

    public function enviarRespuesta(){

        $this->validate();
        $nuevo = new Mensajechat;
        $nuevo->cliente = $this->para;
        $nuevo->vendedor = $this->vendedor;
        $nuevo->mensaje = $this->respuesta;
        $nuevo->envia = Auth::user()->id;
        $nuevo->fecha = now();
        $nuevo->id_servicio = $this->id_servicio;
        $nuevo->save();

        event(new \App\Events\MessageSent($this->vendedor,$this->respuesta));

        $this->reset('respuesta');

        $this->mensajes = Mensajechat::where("vendedor","=",$this->vendedor)
        ->where("cliente","=",$this->para)
        ->get();

    }

    public function render()
    {
        $this->vendedor = auth()->user()->id;

        return view('livewire.chat-lista',[
            "datos" => Mensajechat::where("vendedor","=",$this->vendedor)
                ->where("envia","<>",$this->vendedor)
                ->orderBy('id', 'desc')
                ->get()
        ]);
    }
}
