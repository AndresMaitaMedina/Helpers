<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\ServiceOccupation;
use App\Models\ServiceTalent;
use App\Models\use_occ;
use App\Models\use_tal;
use App\Models\User;

class Filtroservicio extends Component
{

    public $ocupacion;
    public $talento;
    public $precio = 0;
    public $calificacion;
    public $talentoS = false;
    public $ocupacionS = false;
    public $tipo = "";

    protected $rules = [
        'precio' => 'required|numeric|min:1|regex:/^[\d]{1,3}(\.[\d]{1,2})?$/'
    ];

    protected $messages = [
        'precio.required' => 'Ingrese precio máximo',
        'precio.numeric' => 'Solo carácteres numéricos',
        'precio.regex' => 'Máximo 99999.99 S/',
        'precio.min' => 'Precio minimo no permitido',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
        $validatedData = $this->validate();
    }

    public function talentoM()
    {
        $this->talentoS = true;
        $this->ocupacionS = false;
    }
    public function ocupacionM()
    {
        $this->talentoS = false;
        $this->ocupacionS = true;
    }

    public function render()
    {
        if($this->talentoS){
            $this->tipo = "Talentos";
            return view('livewire.filtroservicio',[
                'datos' => use_tal::where("ser_tal_id","=", $this->talento)
                    ->where("precio","<=", $this->precio)
                    ->where("precio",">",0)
                    //->orderBy('calificacion', $this->calificacion)
                    ->get()],['tipo' => $this->tipo]);
        }else{
            $this->tipo = "Ocupaciones";
            return view('livewire.filtroservicio',[
                'datos' => use_occ::where("ser_occ_id","=", $this->ocupacion)
                    ->where("use_occ_group_payment",false)
                    ->where("precio",">",0)
                    ->where("precio","<=", $this->precio)
                    //->orderBy('calificacion', $this->calificacion)
                    ->get()],['tipo' => $this->tipo]);
        }
    }
}