<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\use_occ;
use App\Models\Post_comment;
use App\Models\Question;
use App\Models\Answer;

class PostCommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest', ['only' => 'showLoginForm']);
    }

    public function newComment(Request $request){

        $request->validate([
            'comentario'=>'required|string|max:400',
        ]);

            switch ($request->typeJobFromComment){
                case 1:
                    $comment = new Post_comment(array(
                        'comentario' => $request->get('comentario'),
                        'use_id' => auth()->user()->id,
                        'use_occ_id' => $request->get('serviceId'),
                    ));
            
                    break;
                case 2:
                    $comment = new Post_comment(array(
                        'comentario' => $request->get('comentario'),
                        'use_id' => auth()->user()->id,
                        'use_tal_id' => $request->get('serviceId'),
                    ));
    
                    break;
                default :
                    return ("No se pudo procesar");
            }

        $comment->save();

        return redirect()->back();

        
    }

    public function newQuestion(Request $request){

        $request->validate([
            'pregunta'=>'required|string|min:10|max:170',
            'respuesta'=>'required|string|min:10|max:350',
        ]);
        
        switch ($request->typeJobFromQuestion){
            case 1:
                $question = new Question(array(
                    'pregunta' => $request->get('pregunta'),
                    'respuesta' => $request->get('respuesta'),
                    // 'use_id' => auth()->user()->id,
                    'use_occ_id' => $request->get('serviceId'),
                ));
        
                break;
            case 2:
                $question = new Question(array(
                    'pregunta' => $request->get('pregunta'),
                    'respuesta' => $request->get('respuesta'),
                    // 'use_id' => auth()->user()->id,
                    'use_tal_id' => $request->get('serviceId'),
                ));

                break;
            default :
                return ("No se pudo procesar");
        }

        $question->save();

        return redirect()->back();
    }

    public function newAnswer(Request $request){

        $request->validate([
            'comentarioRespuesta'=>'required|string|max:400',
        ]);
    
            $answer = new Answer(array(
                'comentario' => $request->get('comentarioRespuesta'),
                'use_id' => auth()->user()->id,
                'use_com_id' => $request->get('ComId'),
            ));
            
        $answer->save();

        return redirect()->back();
    }


    public function proccessLikeComment(Request $request){
        $comment = Post_comment::where('id',$request->idPost)->firstOrFail();
        $like = $comment->CommentIntermediate->where('use_id',auth()->user()->id);
        if($like==null){
            $like[0]->update([
                'use_pos_like'=>true
            ]);
        }else{
            $comment->CommentIntermediate()->create([
                'use_id'=>auth()->user()->id,
                'pos_id'=>$request->idPost,
                'use_pos_like'=>true
            ]);
    
        }
        return back();
    }

    public function proccessDislikeComment(Request $request){
        $comment = Post_comment::where('id',$request->idPost)->firstOrFail();
        $unlike = $comment->CommentIntermediate->where('use_id',auth()->user()->id);
        foreach ($unlike as $val) {
            $val->update([
                'use_pos_like'=>false
            ]);
            
        }
        return back();

    }
}
