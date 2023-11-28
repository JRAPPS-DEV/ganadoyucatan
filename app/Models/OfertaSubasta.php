<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfertaSubasta extends Model
{
    use HasFactory;
    protected $table = 'ofertasub';
    public $timestamps = false;
    protected $createdAt = 'fecha';
}
