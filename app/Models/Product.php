<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Estado;
use App\Models\Ciudad;
use App\Models\Persona;
use App\Models\Visits;
use App\Models\Review;
class Product extends Model
{
    use HasFactory;
    protected $table = 'producto';
    public $timestamps = false;
    protected $primaryKey = 'idproducto';
    protected $createdAt = 'datecreated';
    public function location(){
        return $this->hasOne(Estado::class, 'id', 'estado');
    }
    public function ciudades(){
        return $this->hasOne(Ciudad::class, 'id', 'ciudad');
    }
    public function owner(){
        return $this->hasOne(Persona::class, 'idpersona', 'vendedorid');
    }
    public function images(){
        return $this->hasMany(PGallery::class, 'productoid', 'idproducto');
    }
    public function visits(){
        return $this->hasMany(Visits::class, 'idproducto', 'idproducto')->where('type', 'gen')->whereMonth('fecha', now()->month);
    }
    public function videos(){
        return $this->hasMany(Video::class, 'producto_id', 'idproducto');
    }
    public function reviews(){
        return $this->hasMany(Review::class, 'product_id', 'idproducto');
    }
}
