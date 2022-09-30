<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
class User extends Authenticatable
{
    use HasFactory, Notifiable;
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'name',
        'lastname',
        'DNI',
        'email',
        'birthdate',
        'password',
        'password_confirmation',
        'sesion'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function UseOccIntermediate(){
        return $this->hasMany(use_occ::class,'use_id');
    }
    public function UseTalIntermediate(){
        return $this->hasMany(use_tal::class,'use_id');
    }
    
    public function messages(){
        return $this->hasMany(Message::class);
    }

    public function UseContractReceive(){
        return $this->hasMany(Contract::class,'use_receive');
    }
    public function UseContractOffer(){
        return $this->hasMany(Contract::class,'use_offer');
    }

}
