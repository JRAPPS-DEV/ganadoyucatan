<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visits extends Model
{
    use HasFactory;

    protected $table = 'visitas';
    protected $fillable = ['ip', 'fecha', 'vendedorid', 'idproducto', 'type'];
    public $timestamps = false;
}
