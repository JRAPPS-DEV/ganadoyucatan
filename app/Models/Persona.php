<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticatableTrait;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Persona extends Model implements Authenticatable,  JWTSubject
{
    use HasApiTokens, AuthenticatableTrait, HasFactory, Notifiable;

    protected $table = 'persona';
    protected $primaryKey = 'idpersona';
    public $timestamps = false;
    public function nombreRol(){
        return $this->hasOne(Roles::class, 'idrol', 'rolid');
    }
    public function ubi(){
        return $this->hasOne(Estado::class, 'id', 'estado');
    }    
    public function getJWTIdentifier() {
        return $this->getKey();
    }

    public function getJWTCustomClaims() {
        return [];
    }

}
