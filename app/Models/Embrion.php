<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Estado;
use App\Models\Ciudad;
use App\Models\Persona;
use App\Models\Visits;
class Embrion extends Model
{
    use HasFactory;
    protected $table = 'embrion';
    protected $primaryKey = 'idproducto';

    protected $fillable = [
        'nombre',
        'descripcion',
        'precio',
        'stock',
        'rancho',
        'vendedorid',
        'raza',
        'certificado',
        'estatus',
        'estado',
        'ciudad',
        'comisaria',
        'premium',
        'edad'
    ];

    public $timestamps = false;
    public function imagenes(){
        return $this->hasMany(EmbrionImagen::class, 'idproducto', 'idproducto');
    }
    public function videos(){
        return $this->hasMany(EmbrionVideo::class, 'idproducto', 'idproducto');
    }
    public function location(){
        return $this->hasOne(Estado::class, 'id', 'estado');
    }
}
