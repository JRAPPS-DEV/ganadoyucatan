<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class Review extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_id','nombre','telefono','rancho','estrellas','mensaje'
    ];

    public function product()
    {
       return $this->belongsTo(Product::class, 'product_id', 'idproducto');
    }
}
