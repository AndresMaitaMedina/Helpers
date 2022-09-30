<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\use_occ;
use App\Models\use_tal;
use App\Models\Score;

class PostScoreController extends Controller
{
    public function newScore(Request $request){


            switch ($request->typeJobFromScore){
                case 1:
                    if($request->get('calificacion') == null){
                        $score = new Score(array(
                            'calificacion' => 0,
                            'use_id' => auth()->user()->id,
                            'use_occ_id' => $request->get('serviceId'),
                            'etiqueta'=> 'comentado',
                        ));
                    }
                    else{
                        $score = new Score(array(
                            'calificacion' => $request->get('calificacion'),
                            'use_id' => auth()->user()->id,
                            'use_occ_id' => $request->get('serviceId'),
                            'etiqueta'=> 'comentado',
                        ));
                    }

                    $scr = Score::where('use_occ_id',$request->get('serviceId'))->get();
                    $suma = 0;

                    foreach($scr as $s){
                    $suma = $suma + $s->calificacion;
                    }

                        $serviceProfile = use_occ::where('id',$request->get('serviceId'))->first();
                        $scoreT = ($suma + $request->get('calificacion'))/($scr->count() + 1);
                        $serviceProfile->calificacionT = $scoreT;

                        $serviceProfile->push();
            
                    break;
                case 2:
                    if($request->get('calificacion') == null){
                        $score = new Score(array(
                            'calificacion' => 0,
                            'use_id' => auth()->user()->id,
                            'use_tal_id' => $request->get('serviceId'),
                            'etiqueta'=> 'comentado',
                        ));
                    }
                    else{
                        $score = new Score(array(
                            'calificacion' => $request->get('calificacion'),
                            'use_id' => auth()->user()->id,
                            'use_tal_id' => $request->get('serviceId'),
                            'etiqueta'=> 'comentado',
                        ));
                    }

                    $scr = Score::where('use_tal_id',$request->get('serviceId'))->get();
                    $suma = 0;
                    
                    foreach($scr as $s){
                    $suma = $suma + $s->calificacion;
                    }
                    
                        $serviceProfile = use_tal::where('id',$request->get('serviceId'))->first();
                        $scoreT = ($suma + $request->get('calificacion'))/($scr->count() + 1);
                        $serviceProfile->calificacionT = $scoreT;

                        $serviceProfile->push();
    
                    break;
                default :
                    return ("No se pudo procesar");
            }

        $score->save();
        $message = "Solo puede calificar una vez";
        return redirect()->back()->with("calificacionMessage",$message);

        
    }
}
