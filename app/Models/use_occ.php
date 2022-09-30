<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class use_occ extends Model
{
    use HasFactory;

    protected $table = 'use_occs';
    protected $fillable = [
        'ser_occ_change',
        'cha_name',
        'cha_video',
        'cha_count',
        'cha_upload_video_date',
        'cha_25_percent_active',
        'cha_active'
    ];      

    public function IntermediateUseOcc(){
        return $this->belongsTo(User::class,'use_id');
    }
    
    public function IntermediateOcc(){
        return $this->belongsTo(ServiceOccupation::class,'ser_occ_id');
    }

    public function IntermediateChange(){
        return $this->hasOne(Change::class,'ser_occ_change');
    }


    public function IntermediateOccContract(){
        return $this->hasMany(Contract::class,'use_occ_id');
    }
    public function UseOccPostComment(){
        return $this->hasMany(Post_comment::class,'use_occ_id');
    }
    public function UseOccPostQuestion(){
        return $this->hasMany(Question::class,'use_occ_id');
    }
    public function UseOccPostScore(){
        return $this->hasMany(Score::class,'use_occ_id');
    }
}
