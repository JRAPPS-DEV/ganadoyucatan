<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product; 
class ReviewController extends Controller
{
    public function store(Request $request, Product $product)
    {
        $data = $request->validate([
            'nombre'    => 'required|string|max:100',
            'telefono'  => 'nullable|string|max:30',
            'rancho'    => 'nullable|string|max:100',
            'estrellas' => 'required|integer|min:1|max:5',
            'mensaje'   => 'required|string|max:1000',
        ]);
        if ($request->filled('website')) {
            return back()->with('success', '¡Gracias!'); 
        }

        $product->reviews()->create($data);

        return back()->with('success', '¡Gracias por tu reseña!');
    }
}
