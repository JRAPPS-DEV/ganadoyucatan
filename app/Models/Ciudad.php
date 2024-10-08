<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ciudad extends Model
{
    use HasFactory;
    protected $table = 'ciudades';

    public function estado(){
        return $this->belongsTo(Estado::class);
    }

    public function comisarias(){
        return $this->hasMany(Comisaria::class);
    }
}
