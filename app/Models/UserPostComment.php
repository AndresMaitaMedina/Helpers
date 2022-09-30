<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPostComment extends Model
{
    use HasFactory;
    protected $table = 'user_post_comments';

    protected $fillable = [
        'use_id',
        'pos_id',
        'use_pos_like'
    ];

    public function IntermediateComment(){
        return $this->belongsToMany(Post_comment::class,'pos_id');
    }

}
