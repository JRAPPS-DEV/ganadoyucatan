<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contacto extends Model
{
    protected $table = 'contactospago';

    protected $fillable = [
        'nombre',
        'rancho',
        'ubicacion',
        'mensaje',
        'paquete', 
    ];

}
