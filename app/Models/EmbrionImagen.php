<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmbrionImagen extends Model
{
    use HasFactory; 

    protected $table = 'embrion_imagenes';
    protected $primaryKey = 'idimagen';

    protected $fillable = [
        'idproducto',
        'url_imagen'
    ];

    public $timestamps = false;
    public function embrion(){
        return $this->belongsTo(Embrion::class, 'idproducto', 'idproducto');
    }
}
