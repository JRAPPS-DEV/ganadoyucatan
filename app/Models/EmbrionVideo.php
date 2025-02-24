<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmbrionVideo extends Model
{
    use HasFactory;
    protected $table = 'embrion_videos';
    protected $primaryKey = 'idvideo';

    protected $fillable = [
        'idproducto',
        'url_video',
        'nombre_video',
        'tamaño'
    ];
    public $timestamps = false;
    public function embrion(){
        return $this->belongsTo(Embrion::class, 'idproducto', 'idproducto');
    }
}
