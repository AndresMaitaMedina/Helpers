<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class use_tal extends Model
{
    use HasFactory;
    protected $table = 'use_tals';

    public function IntermediateUseTal(){
        return $this->belongsTo(User::class,'use_id');
    }
    
    public function IntermediateTal(){
        return $this->belongsTo(ServiceTalent::class,'ser_tal_id');
    }

    public function IntermetiateTalContract(){
        return $this->hasMany(Contract::class,'use_tal_id');
    }

    public function UseTalPostComment(){
        return $this->hasMany(Post_comment::class,'use_tal_id');
    }

    public function UseTalPostQuestion(){
        return $this->hasMany(Question::class,'use_tal_id');
    }

    public function UseTalPostScore(){
        return $this->hasMany(Score::class,'use_tal_id');
    }

}
