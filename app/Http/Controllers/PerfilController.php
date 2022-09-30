<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\Models\ServiceOccupation;
use App\Models\User;

class PerfilController extends Controller
{

    public function index($id)
    {
        $servOcu=ServiceOccupation::all();
        $user = User::where('id',$id)->first();
        return view('perfil', compact( 'servOcu' , 'user' ));
    }

    public function update(Request $request){

        $usuarioLogeado = Auth::user();
        
        if($usuarioLogeado->email!=$request->email){
            $request->validate([
                'email'=>'required|email|unique:users,email',
            ]);
        }

        $request->validate([
            'name'=>'required',
            'lastname'=>'required|string|max:100',
            'birthdate'=>'required',
            'password'=>'required|string|max:25',
        ]);

         
            if($request->name!=NULL){$usuarioLogeado->name=$request->name;}
            if($request->lastname!=NULL){$usuarioLogeado->lastname=$request->lastname;}
            if($request->email!=NULL){$usuarioLogeado->email=$request->email;}
            if($request->birthdate!=NULL){$usuarioLogeado->birthdate=$request->birthdate;}
            if($request->password!=NULL){
                $usuarioLogeado->password=bcrypt($request->password);
                $usuarioLogeado->password_confirmation=bcrypt($request->password);
            }

            $usuarioLogeado->name=$request->name;
            $usuarioLogeado->lastname=$request->lastname;
            $usuarioLogeado->email=$request->email;
            $usuarioLogeado->birthdate=$request->birthdate;
            $usuarioLogeado->password=bcrypt($request->password);
            $usuarioLogeado->password_confirmation=bcrypt($request->password);

        $usuarioLogeado->push();
        $message = "Realizado correctamente";
        return redirect()->route('perfil',Auth::user()->id)->with('updateMessage',$message);
    
    }
}
