<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comisaria extends Model
{
    use HasFactory;
    protected $table = 'comisarias';

    public function ciudad(){
        return $this->belongsTo(Ciudad::class);
    }
}
