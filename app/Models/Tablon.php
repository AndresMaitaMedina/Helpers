<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tablon extends Model
{
    use HasFactory;
    protected $table = 'tablons';
    protected $fillable = [
        'id',
        'servicio',
        'descripcion',
        'precio',
        'tipo',
        'use_id'
        
    ];
}
