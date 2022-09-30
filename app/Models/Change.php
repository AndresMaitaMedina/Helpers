<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Change extends Model
{
    use HasFactory;
    protected $table = 'changes';
    protected $fillable = [
        'ser_occ_change',
        'cha_name',
        'cha_video',
        'cha_count',
        'cha_upload_video_date',
        'cha_25_percent_active',
        'cha_active'
    ];    
}
