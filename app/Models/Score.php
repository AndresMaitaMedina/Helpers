<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
    use HasFactory;
    protected $table = 'scores';

    protected $fillable = [
        'calificacion', 'use_id', 'use_occ_id', 'use_tal_id', 'etiqueta'
    ];
}
