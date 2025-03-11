<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Config;
use Intervention\Image\ImageManagerStatic as Image;
use Auth;
use App;
use App\Models\Product;
use App\Models\ProductT;
use App\Models\ProductS;
use App\Models\Estado;
use App\Models\Ciudad;
use App\Models\Comisaria;
use App\Models\PGallery;
use App\Models\PSubGallery;
use App\Models\PTGallery;
use App\Models\Subasta;
use App\Models\Video;
use App\Models\VideoS;
use App\Models\VideoT;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use App\Utilities\ImageConverter;
use App\Models\MensajeProducto;
use Illuminate\Support\Facades\Date;
use App\Models\Pajilla;
use App\Models\PajillaImagen;
use App\Models\PajillaVideo;
use App\Models\Embrion;
use App\Models\EmbrionImagen;
use App\Models\EmbrionVideo;

class PajEmbController extends Controller
{
     public function postNewEmbrion(Request $request) {
        $rules = [
            'txtNombre' => 'required',
            'txtPrecio' => 'required|numeric',
            'txtDescripcion' => 'required',
            'txtStock' => 'required|integer',
            'txtRancho' => 'nullable|string',
            'txtRaza' => 'nullable|string',
            'listCert' => 'nullable|string',
            'listEstatus' => 'nullable|string',
            'estados' => 'required|string',
            'ciudades' => 'required|string',
            'comisarias' => 'nullable|string',
            'premium' => 'boolean',
            'txtEdad' => 'nullable|integer',
            'imagenes.*' => 'image|mimes:jpg,jpeg,png|max:2048',
            'video' => 'nullable|mimes:mp4,mov,avi,wmv|max:50000'
        ];

        $messages = [
            'txtNombre.required' => 'El nombre del embrión es obligatorio',
            'txtPrecio.required' => 'El precio es obligatorio',
            'txtDescripcion.required' => 'La descripción es obligatoria',
            'imagenes.*.image' => 'Cada archivo debe ser una imagen válida',
            'video.mimes' => 'El video debe estar en formato MP4, MOV, AVI o WMV',
            'video.max' => 'El video no puede pesar más de 50 MB'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return back()->withErrors($validator)->with('message', 'Se ha producido un error')->with('typealert', 'danger')->withInput();
        }
        
        $embrion = new Embrion();
        $embrion->nombre = e($request->input('txtNombre'));
        $embrion->descripcion = e($request->input('txtDescripcion'));
        $embrion->precio = e($request->input('txtPrecio'));
        $embrion->stock = $request->input('txtStock');
        $embrion->rancho = e($request->input('txtRancho'));
        $embrion->vendedorid = Auth::id();
        $embrion->raza = e($request->input('txtRaza'));

        if ($request->hasFile('fileCert')) {
            $certificadoPath = "uploads/certificados/";
            if (!Storage::disk('public')->exists($certificadoPath)) {
                Storage::disk('public')->makeDirectory($certificadoPath);
            }
            $file = $request->file('fileCert');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs($certificadoPath, $fileName, 'public'); 
            $embrion->certificado = $fileName;
        }
        
        $embrion->estatus = $request->input('listEstatus');
        $embrion->estado = $request->input('estados');
        $embrion->ciudad = $request->input('ciudades');
        $embrion->comisaria = $request->input('comisarias');
        $embrion->premium = $request->input('premium') ? true : false;
        $embrion->save();

        if ($request->hasFile('imagenes')) {
            foreach ($request->file('imagenes') as $imagen) {
                if ($imagen->isValid()) {
                    $path = Storage::disk('webp_images_emb')->putFile('', $imagen);
                    if (Storage::disk('webp_images_emb')->exists($path)) {
                        EmbrionImagen::create([
                            'idproducto' => $embrion->idproducto,
                            'url_imagen' => $path
                        ]);
                    } else {
                        Log::error('El archivo no se pudo guardar ' . $imagen->getClientOriginalName());
                    }
                } else {
                    Log::error('El archivo no es válido ' . $imagen->getClientOriginalName());
                }
            }
        }

        if ($request->deleted_images) {
            $deletedImages = explode(',', $request->deleted_images);
            foreach ($deletedImages as $imageName) {
                if (!empty($imageName)) {
                    $image = EmbrionImagen::where('url_imagen', 'embrion_imagenes/' . $imageName)->first();
                    if ($image) {
                        Storage::disk('public')->delete($image->url_imagen);
                        $image->delete();
                    }
                }
            }
        }

        if ($request->hasFile('video')) {
            $videoFile = $request->file('video');
            $videoPath = $videoFile->store('embrion_videos', 'public');

            EmbrionVideo::create([
                'idproducto' => $embrion->idproducto,
                'url_video' => $videoPath,
                'nombre_video' => $videoFile->getClientOriginalName(),
                'tamaño' => $videoFile->getSize()
            ]);
        }

        return redirect('/admin/products/addNewEmbrion')->with('message', 'Embrion agregado con éxito')->with('typealert', 'success');
    }

    public function getEmbriones(){
        $id = Auth::id();
        $products = Embrion::where('vendedorid', $id)->orderBy('idproducto', 'desc')->paginate(25);
        $data = ['products' => $products];
        return view('Admin.Embrion.embrionHome', $data);
    }

    public function deleteEmbrion($id){
        $embrion = Embrion::find($id);

        if ($embrion) {
            $imagenes = EmbrionImagen::where('idproducto', $id)->get();
            foreach ($imagenes as $imagen) {
                Storage::disk('webp_images_emb')->delete($imagen->url_imagen);
                $imagen->delete();
            }
            $video = EmbrionVideo::where('idproducto', $id)->first();
            if ($video) {
                Storage::disk('public')->delete($video->url_video);
                $video->delete();
            }
            $embrion->delete();
            return redirect()->back()->with('message', 'Producto eliminado con éxito')->with('typealert', 'success');
        } else {
            return redirect()->back()->with('message', 'El producto no existe')->with('typealert', 'danger');
        }
    }

}
