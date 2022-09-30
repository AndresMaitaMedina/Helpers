<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VideoController extends Controller
{

    public function videoUpload(Request $request){
        $request->validate([
            'urlVideo' => 'required|url|max:255|regex:{^https://www.youtu}',
            'idService'=>'required'
        ]);
        $change =auth()->user()->UseOccIntermediate->find($request->idService);
        $change->IntermediateChange->update([
            'cha_video'=>$request->urlVideo,
            'cha_25_percent_active'=>true
        ]);
        return back();   
    }
}
