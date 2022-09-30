<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;
    protected $table = 'answers';
    
    protected $fillable = [
        //'comentario', 'us_com', 'serpro_id'
        'comentario', 'use_id', 'use_com_id'
    ];

    public function PostCommentUser(){
        return $this->belongsTo(User::class,'use_id');
    }

}
