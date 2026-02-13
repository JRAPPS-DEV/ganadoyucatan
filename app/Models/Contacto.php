<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contacto extends Model
{
    protected $table = 'contactosPago';

    protected $fillable = [
        'nombre',
        'rancho',
        'ubicacion',
        'mensaje',
        'paquete', 
    ];

}
