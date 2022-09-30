<?php

namespace App\Http\Controllers;

use App\Models\Change;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use App\Models\User;
use App\Models\ServiceOccupation;
use App\Models\ServiceTalent;
use App\Models\use_occ;
use App\Models\use_tal;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use JD\Cloudder\Facades\Cloudder;

class ServiceController extends Controller
{
    public function registro(){
        $serviciosTec = ServiceOccupation::all();
        $serviciosTal = ServiceTalent::all();
        return view('registrodeServicio',compact('serviciosTec','serviciosTal'));
    }

    public function imageAddToCloud($image){
        $name = $image->getClientOriginalName();
        $image_name = $image->getRealPath();
        Cloudder::upload($image_name, null);
        list($width, $height) = getimagesize($image_name);
        $image_url= Cloudder::show(
                Cloudder::getPublicId(), 
                ["width" => $width, "height"=>$height]
        );
        $image->move(public_path("uploads"), $name);
        return $image_url;
    }
    public function registroReto(Request $request){
        $existsActiveChange=false;
        $request->validate([
            'nombreReto' => 'required|max:100|min:5',
            'detallesReto' => 'required|max:2000|min:10',
            'costoReto' => 'required|between:100,10000|numeric',
            'imagenReto'=>'required|mimes:jpeg,bmp,jpg,png|between:1,6000|dimensions:min_width=256,min_height=256,max_width=2048,max_height=2048',
        ]);
        // Verifica si tiene activo algun reto
        if(count(auth()->user()->UseOccIntermediate->where('use_occ_group_payment',true))>0){
            foreach(auth()->user()->UseOccIntermediate as $changes){
                if(isset($changes->IntermediateChange->cha_active) && $changes->IntermediateChange->cha_active){
                        $existsActiveChange = true;
                        break;
                }
            }
        }
        if($existsActiveChange){
            $message = "Hay un reto activo, el reto tiene que ser cumplido para registrar otro";
            return back()->with('failedChangeActive',$message);

        }
        $datosServicio = new use_occ;
        $datosServicio->use_id = auth()->id();
        $datosServicio->ser_occ_id = 1;
        $datosServicio->descripcion = $request->detallesReto;
        $datosServicio->precio = $request->costoReto;
        $datosServicio->precio_actual = 0;
        $datosServicio->use_occ_group_payment = true;

        // Imagen en la nube
        $image_url = $this->imageAddToCloud($request->file('imagenReto'));

        $datosServicio->imagen = $image_url;
        $datosServicio->save();
        
        // Registro de reto
        DB::transaction(function () use($request,$datosServicio) {
            $datosServicio->save();
            $datosServicio->IntermediateChange()->create([
                'cha_name'=>$request->nombreReto,
            ]);                
        });
        $message = "Reto registrado exitosamente";
        return back()->with('serviceMessage',$message);
    }



    public function registroTecnico(Request $request){
        $request->validate([
            'servicioTecn' => 'required',
            'nombreTecn'=> 'required|min:10|max:45',
            'detallesTecn' => 'required|min:10',
            'costoTecn' => 'required|between:10,10000|numeric',
            'imagenTecn'=>'required|mimes:jpeg,bmp,jpg,png|between:1,6000|dimensions:min_width=256,min_height=256,max_width=2048,max_height=2048'
        ]);
        $imagen2 = $request->file('imagenTecn');
        $datosServicio = new use_occ;
        $datosServicio->use_id = auth()->id();
        $datosServicio->ser_occ_id = $request->servicioTecn;
        $datosServicio->ser_occ_name = $request->nombreTecn;
        $datosServicio->descripcion = $request->detallesTecn;
        $datosServicio->precio = $request->costoTecn;

        $image_url = $this->imageAddToCloud($imagen2);

        $datosServicio->imagen = $image_url;
        $datosServicio->save();
        $message = "Servicio de ocupación registrado exitosamente";

        return back()->with('serviceMessage',$message);
    }

    public function registroTalento(Request $request){
        $request->validate([
            'servicioTalen' => 'required',
            'nombreTalen'=> 'required|min:10|max:45',
            'detallesTalen' => 'required|min:10',
            'costoTalen' => 'required|between:10,10000|numeric',
            'imagenTalen'=>'required|mimes:jpeg,bmp,jpg,png|between:1,6000|dimensions:min_width=256,min_height=256,max_width=2048,max_height=2048',
        ]);

        $datosServicio = new use_tal;
        $datosServicio->use_id = auth()->id();
        $datosServicio->ser_tal_id = $request->servicioTalen;
        $datosServicio->ser_tal_name = $request->nombreTalen;
        $datosServicio->descripcion = $request->detallesTalen;
        $datosServicio->precio = $request->costoTalen;

        $image_url = $this->imageAddToCloud($request->file('imagenTalen'));
        
        $datosServicio->imagen = $image_url;
        $datosServicio->save();

        $message = "Talento registrado exitosamente";

        return back()->with('serviceMessage',$message);
    }
}
