<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    use HasFactory;
    protected $table = 'contracts';
    protected $fillable = [
        'con_contract_date',
        'con_hour',
        'con_address',
        'con_description',
        'con_price',
        'con_initial',
        'con_end',
        'use_offer',
        'use_receive',
        'use_occ_id',
        'use_tal_id',
        'con_status',
        'servicio'

    ];
    protected $hidden = [];

    public function IntermediateUseTal(){
        return $this->belongsTo(use_tal::class,'use_tal_id');
    }
    
    public function IntermediateUseOcc(){
        return $this->belongsTo(use_occ::class,'use_occ_id');
    }
}
