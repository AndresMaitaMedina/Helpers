<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\use_occ;
use App\Models\use_tal;
use App\Models\Contract;
use App\Models\Post_comment;
use App\Models\Question;
use App\Models\Answer;
use App\Models\Tablon;
use App\Models\ServiceOccupation;
use App\Models\ServiceTalent;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\TablonRequest;

use App;
use Illuminate\Support\Facades\Http;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    // Perfiles de talento
    public function showTalentService($randNumber = null){
        $allServices = use_tal::orderBy('created_at','DESC')->where('use_tal_group_payment',false)->paginate(20);
        return view('profileServiceTalent',compact('allServices'));
    }
    // Perfiles de oficios
    public function showOccupationService($randNumber = null){
        $allServices = use_occ::orderBy('created_at','DESC')->where('use_occ_group_payment',false)->paginate(20);
        return view('profileServiceOccupation',compact('allServices'));
    }
    // Muestra retos - Pagos grupales
    public function  showRetoService($randNumber = null){
        $changeAllOcc = use_occ::orderBy('created_at','DESC')->where('use_occ_group_payment',true)->paginate(20);
        return view('profileServiceRetos',compact('changeAllOcc'));
    }
    // Aleatorio
    public function showServicesRandom(){
        $changeAllOcc = use_occ::select('id');
        $identityChange=mt_rand(1,$changeAllOcc->count());
        return redirect()->route('showProfileServiceRetos',$identityChange);
    }

    public function TablonServicios(){
        $talentos = ServiceTalent::all();
        $ocupaciones = ServiceOccupation::all();
        $servicios = Tablon::all();
        return view('tablonservicios')->with('talentos', $talentos)->with('ocupaciones', $ocupaciones)->with('servicios', $servicios);

    }

    public function solicitarServicio(TablonRequest $request){

        $talentos = ServiceTalent::all();
        $ocupaciones = ServiceOccupation::all();

        $servicioNuevo = new App\Models\Tablon;

        $servicioNuevo->servicio = $request->nombre;
        $servicioNuevo->descripcion = $request->descripcion;
        $servicioNuevo->precio = $request->precio;
        $servicioNuevo->tipo = $request->tipo;
        $servicioNuevo->use_id = auth()->id();
        $servicioNuevo -> save();

        $servicios = Tablon::all();

        return back()->with('agregado', 1)->with('talentos', $talentos)->with('ocupaciones', $ocupaciones)->with('servicios', $servicios)->with('agregado','ok');
    }

    public function eliminarServicio($id)
    {
        $servicio = Tablon::find($id);
        $servicio->delete();
        return back()->with('eliminado','ok');
    }

    public function showProfileServiceTalent($id){
        $chat = null;
        $serviceProfile = use_tal::where('id',$id)->first();
        $SerTal = use_tal::orderBy('created_at','DESC')->skip(0)->take(5)->get();
        $SerOcc = use_occ::orderBy('created_at','DESC')->skip(0)->take(5)->get();

        if(auth()->user()==null){
            $chat = false;
        }else{
            $estadoContrato = Contract::where('use_tal_id',$id)
                                ->where('use_receive',auth()->user()->id)
                                ->first();

            if($estadoContrato){
                $contratado = $estadoContrato->con_status;
                if($contratado == "1"){
                    $chat = true;
                }
            }else{
                $chat = false;
            }
        }
        return view('servicioTalent',compact('serviceProfile','chat','SerTal','SerOcc'));
    }



    public function showProfileServiceOccupation($id){
        $chat = null;
        $serviceProfile = use_occ::where('id',$id)->first();
        $SerOcc = use_occ::orderBy('created_at','DESC')->skip(0)->take(5)->get();
        $SerTal = use_tal::orderBy('created_at','DESC')->skip(0)->take(5)->get();

        if(auth()->user()==null){
            $chat = false;
        }else{
            $estadoContrato = Contract::where('use_occ_id',$id)
                                ->where('use_receive',auth()->user()->id)
                                ->first();
            if($estadoContrato){
                $contratado = $estadoContrato->con_status;
                if($contratado == "1"){
                    $chat = true;
                }
            }else{
                $chat = false;
            }
        }
        return view('servicioOccupation',compact('serviceProfile','chat','SerOcc','SerTal'));
    }
    public function showProfileServiceRetos($id){
        $serviceProfile = use_occ::where('id',$id)->first();
        $SerTal = use_tal::orderBy('created_at','DESC')->skip(0)->take(5)->get();
        $SerOcc = use_occ::orderBy('created_at','DESC')->skip(0)->take(5)->get();
        return view('servicioRetos',compact('serviceProfile','SerTal','SerOcc'));
    }

    public function nuevoRegistro(Request $request){
        $request->validate([
            'name'=>'required',
            'lastname'=>'required|string|max:100',
            'dni'=>'required|numeric|min:0|max:99999999|unique:users,dni|digits:8',
            'email'=>'required|email|unique:users,email',
            'birthdate'=>'required|date|before_or_equal:'.\Carbon\Carbon::now()->subYears(18)->format('Y-m-d'),
            'password'=>'required|string|max:25|confirmed',
            'password_confirmation'=>'required|string|max:25',
        ]);
        /*$dniApi = null;
        $response = Http::get('https://consulta.api-peru.com/api/dni/'.$request->dni);
        if($response!=null){
            $dniApi = $response->json();
        }
        if($dniApi!=null && $dniApi["success"] == true){
            // Insertar en caso de encontrar
        }else{
            return back()->withErrors("DNI invalido, no se pudo comprobar la existencia del DNI",'notfound')->withInput();
        }*/


        $user = new User(array(
            'name' => $request->get('name'),
            'lastname' => $request->get('lastname'),
            'DNI' => $request->get('dni'),
            'email' => $request->get('email'),
            'birthdate' => $request->get('birthdate'),
            'password' => bcrypt($request->get('password')),
            'password_confirmation' => bcrypt($request->get('password_confirmation'))
        ));

        $user->save();

        return redirect()->route('login');
    }
}
