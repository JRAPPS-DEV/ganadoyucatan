<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class PTGallery extends Model
{
    use HasFactory;
    protected $table = 'imagent';
    public $timestamps = false;
    public function product() {
        return $this->belongsTo(ProductT::class, 'id_producto', 'idproducto');
    }
}
