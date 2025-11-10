<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductT;
use App\Models\ProductS;
use Auth;
use App\Models\Estado;
use App\Models\Ciudad;
use App\Models\Comisaria;
use Validator;
use App\Models\PGallery;
use App\Models\Persona;
use App\Models\PTGallery;
use App\Models\PSubGallery;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use App\Utilities\ImageConverter;
use Intervention\Image\ImageManagerStatic as Image;
use App\Models\Video;
use App\Models\VideoT;
use Illuminate\Support\Facades\Log;
class APIProductsController extends Controller
{
    public function show(){
        $vendedorId = Auth::id();
        $products = Product::where('status', '1')
                            ->where('vendedorid', $vendedorId)
                            ->with(['images', 'videos'])
                            ->orderBy('idproducto', 'desc')
                            ->paginate(10);
        $products->each(function ($product) {
            $product->gallery = $product->images->map(function($image) use ($product) {
                return asset('uploads/' . $product->carpeta . '/' . $image->img . '.webp');
            });
        });     
        $products->each(function($product){
            $product->videosG = $product->videos->map(function($video){
                if($video->ruta){
                    return asset('uploads/videos/' . $video->ruta);
                }else{
                    return '';
                }
            });
            if($product->videos->isEmpty()){
                $product->videosG= [''];
            }
        });

        return response()->json(['products' => $products]);
    }
    public function showCom() {
        $vendedorId = Auth::id();
        $products = ProductT::where('status', '2')
                            ->where('vendedorid', $vendedorId)
                            ->with(['portada' => function ($query) {
                                $query->orderBy('id')->take(1); 
                            }, 'videos'])
                            ->orderBy('idproducto', 'desc')
                            ->paginate(10);

        $products->each(function ($product) {
            if ($product->images->isNotEmpty()) {
                $firstImage = $product->images->first();
                $product->portada_url = asset('uploads/tianguis/' . $product->imagen . '/' . $firstImage->ruta . '.webp');
            } else {
                $product->portada_url = null;
            }
        });
        $products->each(function ($product) {
            $product->galleryT = $product->images->map(function($image) use ($product) {
                return asset('uploads/tianguis/' . $product->imagen . '/' . $image->ruta . '.webp');
            });
        });
        $products->each(function($product) {
            $product->videosT = $product->videos->map(function($video) {
                if ($video->ruta) {
                    return asset('uploads/videost/' . $video->ruta);
                } else {
                    return '';
                }
            });
    
            if ($product->videosT->isEmpty()) {
                $product->videosT = [''];
            }
        });
        
        return response()->json(['products' => $products]);
    }
    public function showSub(){
        $vendedorId = Auth::id();
        $products = ProductS::where('status', '1')->where('vendedorid', $vendedorId)->orderBy('id_producto', 'desc')->paginate(10);
        return response()->json(['products' => $products]);
    }
    public function getEstados() {
        $estados = Estado::all();
        return response()->json($estados);
    }

    public function getCiudadesByEstado($estadoId) {
        $ciudades = Ciudad::where('estado_id', $estadoId)->get();
        return response()->json($ciudades);
    }

    public function getComisariasByCiudad($ciudadId) {
        $comisarias = Comisaria::where('ciudad_id', $ciudadId)->get();
        return response()->json($comisarias);
    }
    public function getProductGen(Request $request){
        $producto = Auth::id();
        $product;
        return "in process";
    }
    public function postNewGen(Request $request){
        $data = $request->all();
        $rules = [
            'nombre' => 'required',
            'rancho' => 'required',
            'descripcion' => 'required',
        ];
        $messages = [
            'nombre.required' => 'El nombre del producto es obligatorio',
            'rancho.required' => 'El rancho es obligatorio',
            'descripcion.required' => 'La descripción es obligatoria',
        ];
        $validator = Validator::make($data, $rules, $messages);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $nombre = $data['nombre'];
        $ruta = strtolower(str_replace(" ", "-", $nombre));
        $product = new Product;
        $product->nombre = $nombre;
        $product->descripcion = $data['descripcion'];
        $product->rancho = $data['rancho'];
        $product->raza = $data['raza'];
        $product->ruta = $ruta;
        $product->precio = $data['precio'];
        $product->edad = $data['edad'];
        $product->stock = $data['stock'];
        $product->vacunado = $data['vacu'];
        $product->peso = $data['peso'];
        $product->estado = $data['estado'];
        $product->ciudad = $data['ciudad'];
        $product->comisaria = $data['comisaria'];
        $product->portada = "";
        $product->carpeta = "";
        $product->vendedorid = Auth::id();
        $product->save(); 

        if ($request->hasFile('images')) {
            $images = $request->file('images');
            $dateFolder = date('Y-m-d');
            $uploadPath = 'uploads/' . $dateFolder;
            if (!File::exists($uploadPath)) {
                File::makeDirectory($uploadPath, 0755, true);
            }
            foreach ($images as $index => $image) {
                $filename = $image->getClientOriginalName();
                $filenameWithoutExtension = pathinfo($filename, PATHINFO_FILENAME);
                $webpPath = $dateFolder . '/' . $filenameWithoutExtension . '.webp';
                $destinationPath = Storage::disk('webp_images')->path($webpPath);

                try {
                    $img = Image::make($image->getRealPath());
                    $img->encode('webp', 10)->save($destinationPath);
                } catch (Exception $e) {
                    return response()->json(['error' => 'No se pudo guardar la imagen: ' . $e->getMessage()], 500);
                }

                if ($index === 0) {
                    $product->portada = $filenameWithoutExtension;
                    $product->carpeta = $dateFolder;
                    $product->save();
                }

                $imageEntry = new PGallery;
                $productoid = Product::orderBy('datecreated', 'desc')->value('idproducto');
                $imageEntry->productoid = $productoid;
                $imageEntry->img = $filenameWithoutExtension;
                $imageEntry->save();
            }
        }


        if ($request->hasFile('videos')) {
            $videos = $request->file('videos');

            foreach ($videos as $videoFile) {
                $destinationPath = Storage::disk('videos')->path($videoFile);
                $videoPath = $videoFile->store('', 'videos');
                $productoid = Product::orderBy('datecreated', 'desc')->value('idproducto');

                $video = new Video();
                $video->nombre = $videoFile->getClientOriginalName();
                $video->ruta = $videoPath;
                $video->tamaño = $videoFile->getSize();
                $video->producto_id = $productoid;
                $video->save();
            }
        }   

        return response()->json(['message' => 'Producto agregado con éxito'], 200);
    }
    public function postNewCom(Request $request){
        try{
            $data = $request->all();
            $rules = [
                'nombre' => 'required',
                'rancho' => 'required',
                'descripcion' => 'required',
            ];
            $messages = [
                'nombre.required' => 'El nombre del producto es obligatorio',
                'rancho.required' => 'El rancho es obligatorio',
                'descripcion.required' => 'La descripción es obligatoria',
            ];
            $validator = Validator::make($data, $rules, $messages);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 422);
            }
            $numero = Auth::user()->email_user;
            $nombres = Auth::user()->nombres;
            $nombre = $data['nombre'];
            $ruta = strtolower(str_replace(" ", "-", $nombre));
            $product = new ProductT;
            $product->nombre = $nombre;
            $product->descripcion = $data['descripcion'];
            $product->rancho = $data['rancho'];
            $product->raza = $data['raza'];
            $product->ruta = $ruta;
            $product->precio = $data['precio'];
            $product->stock = $data['stock'];
            $product->vacunado = $data['vacu'];
            $product->tipo = $data['tipo'];
            $product->peso = $data['peso'];
            $product->estado = $data['estado'];
            $product->ciudad = $data['ciudad'];
            $product->status = '2';
            //$product->comisaria = "1";
            //$product->comisaria = $data['comisaria'];
            $product->vendedorid = Auth::id();
            $product->propietario = $nombres;
            $product->imagen = "";
            $product->numero = $numero;
            $product->save(); 

            if ($request->hasFile('images')) {
                    $images = $request->file('images');
                    $dateFolder = date('Y-m-d');
                    $uploadPath = 'uploads/tianguis/' . $dateFolder;
                    if (!File::exists($uploadPath)) {
                        File::makeDirectory($uploadPath, 0755, true);
                    }
                    foreach ($images as $index => $image) {
                        $filename = $image->getClientOriginalName();
                        $filenameWithoutExtension = pathinfo($filename, PATHINFO_FILENAME);
                        $webpPath = $dateFolder . '/' . $filenameWithoutExtension . '.webp';
                        $destinationPath = Storage::disk('webp_images_com')->path($webpPath);
                        try {
                            $img = Image::make($image->getRealPath());
                            $img->encode('webp', 10)->save($destinationPath);
                        } catch (Exception $e) {
                            return response()->json(['error' => 'No se pudo guardar la imagen: ' . $e->getMessage()], 500);
                        }
                        if ($index === 0) {
                            //$product->portada = $filenameWithoutExtension . '.webp';
                            $product->imagen = $dateFolder;
                            $product->save();
                        }
                        $imageEntry = new PTGallery;
                        $productoid = ProductT::orderBy('datecreated', 'desc')->value('idproducto');
                        $imageEntry->id_producto = $productoid;
                        $imageEntry->ruta = $filenameWithoutExtension;
                        $imageEntry->save();
                    }
                }

            if ($request->hasFile('videos')) {
                $videos = $request->file('videos');

                foreach ($videos as $videoFile) {
                    $destinationPath = Storage::disk('videost')->path($videoFile);
                    $videoPath = $videoFile->store('', 'videost');
                    $productoid = ProductT::orderBy('datecreated', 'desc')->value('idproducto');

                    $video = new VideoT();
                    $video->nombre = $videoFile->getClientOriginalName();
                    $video->ruta = $videoPath;
                    $video->tamaño = $videoFile->getSize();
                    $video->producto_id = $productoid;
                    $video->save();
                }
            }   

            return response()->json(['message' => 'Producto agregado con éxito'], 200);        
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'Error al agregar producto: ' . $e->getMessage(), 'trace' => $e->getTraceAsString()], 500);
        }
    }
    public function updateGen(Request $request, $id) {
        print('Entrando en updateGen');

        if ($request->input('_method') !== 'PUT') {
            return response()->json(['error' => 'Método no permitido'], 405);
        }

        $data = $request->all();
        print('Datos recibidos: ' . json_encode($data));

        $rules = [
            'nombre' => 'required',
            'rancho' => 'required',
            'descripcion' => 'required',
        ];
        $messages = [
            'nombre.required' => 'El nombre del producto es obligatorio',
            'rancho.required' => 'El rancho es obligatorio',
            'descripcion.required' => 'La descripción es obligatoria',
        ];
        $validator = Validator::make($data, $rules, $messages);

        if ($validator->fails()) {
            print('Validación fallida: ' . json_encode($validator->errors()->toArray()));
            return response()->json(['errors' => $validator->errors()], 422);
        }

        try {
            $product = Product::find($id);
            if (!$product) {
                print('Producto no encontrado');
                return response()->json(['error' => 'Producto no encontrado'], 404);
            }

            $nombre = $data['nombre'];
            $ruta = strtolower(str_replace(" ", "-", $nombre));
            $product->nombre = $nombre;
            $product->descripcion = $data['descripcion'];
            $product->rancho = $data['rancho'];
            $product->raza = $data['raza'];
            $product->ruta = $ruta;
            $product->precio = $data['precio'];
            $product->edad = $data['edad'];
            $product->stock = $data['stock'];
            $product->vacunado = $data['vacunado'];
            $product->peso = $data['peso'];
            $product->estado = $data['estado'];
            $product->ciudad = $data['ciudad'];
            $product->comisaria = $data['comisaria'] ?? $product->comisaria;
            $product->save();

            if ($request->hasFile('images')) {
                print('Procesando imágenes');
                $images = $request->file('images');
                $dateFolder = $product->carpeta ?: date('Y-m-d');
                $uploadPath = 'uploads/' . $dateFolder;
                if (!File::exists($uploadPath)) {
                    File::makeDirectory($uploadPath, 0755, true);
                }
                foreach ($images as $index => $image) {
                    $filename = $image->getClientOriginalName();
                    $filenameWithoutExtension = pathinfo($filename, PATHINFO_FILENAME);
                    $webpPath = $dateFolder . '/' . $filenameWithoutExtension . '.webp';
                    $destinationPath = Storage::disk('webp_images')->path($webpPath);

                    try {
                        $img = Image::make($image->getRealPath());
                        $img->encode('webp', 10)->save($destinationPath);
                    } catch (Exception $e) {
                        print('Error al guardar la imagen: ' . $e->getMessage());
                        return response()->json(['error' => 'No se pudo guardar la imagen: ' . $e->getMessage()], 500);
                    }

                    if ($index === 0) {
                        $product->portada = $filenameWithoutExtension;
                        $product->carpeta = $dateFolder;
                        $product->save();
                    }

                    $imageEntry = new PGallery;
                    $imageEntry->productoid = $product->idproducto;
                    $imageEntry->img = $filenameWithoutExtension;
                    $imageEntry->save();
                }
            }

            if ($request->hasFile('videos')) {
                print('Procesando videos');
                $videos = $request->file('videos');

                foreach ($videos as $videoFile) {
                    $destinationPath = Storage::disk('videos')->path($videoFile);
                    $videoPath = $videoFile->store('', 'videos');
                    $video = new Video();
                    $video->nombre = $videoFile->getClientOriginalName();
                    $video->ruta = $videoPath;
                    $video->tamaño = $videoFile->getSize();
                    $video->producto_id = $product->idproducto;
                    $video->save();
                }
            }
            if ($request->filled('deleted_images')) {
                $deletedImages = json_decode($request->input('deleted_images'), true);
                foreach ($deletedImages as $imageUrl) {
                    $imagePath = parse_url($imageUrl, PHP_URL_PATH);
                    $imageNameWithExtension = basename($imagePath);
                    $filenameWithoutExtension = pathinfo($imageNameWithExtension, PATHINFO_FILENAME);
                    $dateFolder = explode('/', ltrim($imagePath, '/'))[2];
                    $fullImagePath = "$dateFolder/$filenameWithoutExtension.webp";
                    Storage::disk('webp_images')->delete($fullImagePath);
                    PGallery::where('img', $filenameWithoutExtension)->delete();
                }
            }
            if ($request->filled('deleted_videos')) {
                $deletedVideos = json_decode($request->input('deleted_videos'), true);
                foreach ($deletedVideos as $videoUrl) {
                    $videoPath = parse_url($videoUrl, PHP_URL_PATH);
                    $videoName = basename($videoPath);
                    Storage::disk('videos')->delete($videoName);
                    Video::where('ruta', $videoName)->delete();
                }
            }

            print('Producto actualizado con éxito');
            return response()->json(['message' => 'Producto actualizado con éxito'], 200);
        } catch (Exception $e) {
            print('Error al actualizar producto: ' . $e->getMessage());
            return response()->json(['error' => 'Error al actualizar producto: ' . $e->getMessage(), 'trace' => $e->getTraceAsString()], 500);
        }
    }    
    public function postGratis(Request $request){
        try{
            $data = $request->all();
            $rules = [
                'nombre' => 'required',
                'rancho' => 'required',
                'descripcion' => 'required',
            ];
            $messages = [
                'nombre.required' => 'El nombre del producto es obligatorio',
                'rancho.required' => 'El rancho es obligatorio',
                'descripcion.required' => 'La descripción es obligatoria',
            ];
            $validator = Validator::make($data, $rules, $messages);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 422);
            }
            $numero = $data['numero'];
            $nombres = $data['nombres'];
            $nombre = $data['nombre'];
            $ruta = strtolower(str_replace(" ", "-", $nombre));
            $product = new ProductT;
            $product->nombre = $nombre;
            $product->descripcion = $data['descripcion'];
            $product->rancho = $data['rancho'];
            $product->raza = $data['raza'];
            $product->ruta = $ruta;
            $product->precio = $data['precio'];
            $product->stock = $data['stock'];
            $product->vacunado = $data['vacu'];
            $product->tipo = $data['tipo'];
            $product->peso = $data['peso'];
            $product->estado = $data['estado'];
            $product->ciudad = $data['ciudad'];
            //$product->comisaria = "1";
            //$product->comisaria = $data['comisaria'];
            $product->vendedorid = 1;
            $product->propietario = $nombres;
            $product->imagen = "";
            $product->numero = $numero;
            $product->save(); 

            if ($request->hasFile('images')) {
                    $images = $request->file('images');
                    $dateFolder = date('Y-m-d');
                    $uploadPath = 'uploads/tianguis/' . $dateFolder;
                    if (!File::exists($uploadPath)) {
                        File::makeDirectory($uploadPath, 0755, true);
                    }
                    foreach ($images as $index => $image) {
                        $filename = $image->getClientOriginalName();
                        $filenameWithoutExtension = pathinfo($filename, PATHINFO_FILENAME);
                        $webpPath = $dateFolder . '/' . $filenameWithoutExtension . '.webp';
                        $destinationPath = Storage::disk('webp_images_com')->path($webpPath);
                        try {
                            $img = Image::make($image->getRealPath());
                            $img->encode('webp', 10)->save($destinationPath);
                        } catch (Exception $e) {
                            return response()->json(['error' => 'No se pudo guardar la imagen: ' . $e->getMessage()], 500);
                        }
                        if ($index === 0) {
                            //$product->portada = $filenameWithoutExtension . '.webp';
                            $product->imagen = $dateFolder;
                            $product->save();
                        }
                        $imageEntry = new PTGallery;
                        $productoid = ProductT::orderBy('datecreated', 'desc')->value('idproducto');
                        $imageEntry->id_producto = $productoid;
                        $imageEntry->ruta = $filenameWithoutExtension;
                        $imageEntry->save();
                    }
                }

            if ($request->hasFile('videos')) {
                $videos = $request->file('videos');

                foreach ($videos as $videoFile) {
                    $destinationPath = Storage::disk('videost')->path($videoFile);
                    $videoPath = $videoFile->store('', 'videost');
                    $productoid = ProductT::orderBy('datecreated', 'desc')->value('idproducto');

                    $video = new Video();
                    $video->nombre = $videoFile->getClientOriginalName();
                    $video->ruta = $videoPath;
                    $video->tamaño = $videoFile->getSize();
                    $video->producto_id = $productoid;
                    $video->save();
                }
            }   

            return response()->json(['message' => 'Producto agregado con éxito'], 200);        
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'Error al agregar producto: ' . $e->getMessage(), 'trace' => $e->getTraceAsString()], 500);
        }
    }
    public function editProductCom(Request $request, $id) {
        try {
            $data = $request->all();
            $rules = [
                'nombre' => 'required',
                'rancho' => 'required',
                'descripcion' => 'required',
            ];
            $messages = [
                'nombre.required' => 'El nombre del producto es obligatorio',
                'rancho.required' => 'El rancho es obligatorio',
                'descripcion.required' => 'La descripción es obligatoria',
            ];
            $validator = Validator::make($data, $rules, $messages);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 422);
            }

            $product = ProductT::find($id);
            if (!$product) {
                return response()->json(['error' => 'Producto no encontrado'], 404);
            }

            $nombre = $data['nombre'];
            $ruta = strtolower(str_replace(" ", "-", $nombre));
            $product->nombre = $nombre;
            $product->descripcion = $data['descripcion'];
            $product->rancho = $data['rancho'];
            $product->raza = $data['raza'];
            $product->ruta = $ruta;
            $product->precio = $data['precio'];
            $product->stock = $data['stock'];
            $product->vacunado = $data['vacunado'];
            $product->tipo = $data['tipo'];
            $product->peso = $data['peso'];
            $product->estado = $data['estado'];
            $product->ciudad = $data['ciudad'];
            $product->save();

            if ($request->hasFile('images')) {
                $images = $request->file('images');
                $dateFolder = $product->imagen ?: date('Y-m-d');
                $uploadPath = 'uploads/tianguis/' . $dateFolder;

                if (!File::exists($uploadPath)) {
                    File::makeDirectory($uploadPath, 0755, true);
                }

                foreach ($images as $index => $image) {
                    $filename = $image->getClientOriginalName();
                    $filenameWithoutExtension = pathinfo($filename, PATHINFO_FILENAME);
                    $webpPath = $dateFolder . '/' . $filenameWithoutExtension . '.webp';
                    $destinationPath = Storage::disk('webp_images_com')->path($webpPath);

                    try {
                        $img = Image::make($image->getRealPath());
                        $img->encode('webp', 10)->save($destinationPath);
                    } catch (Exception $e) {
                        return response()->json(['error' => 'No se pudo guardar la imagen: ' . $e->getMessage()], 500);
                    }

                    if ($index === 0) {
                        $product->imagen = $dateFolder;
                        $product->save();
                    }

                    $imageEntry = new PTGallery();
                    $imageEntry->id_producto = $product->idproducto;
                    $imageEntry->ruta = $filenameWithoutExtension;
                    $imageEntry->save();
                }
            }
            if ($request->filled('deleted_images')) {
                $deletedImages = json_decode($request->input('deleted_images'), true);
                foreach ($deletedImages as $imageUrl) {
                    $imagePath = parse_url($imageUrl, PHP_URL_PATH);
                    $imageNameWithExtension = basename($imagePath);
                    $filenameWithoutExtension = pathinfo($imageNameWithExtension, PATHINFO_FILENAME);
                    $dateFolder = explode('/', ltrim($imagePath, '/'))[2];
                    $fullImagePath = "$dateFolder/$filenameWithoutExtension.webp";
                    Storage::disk('webp_images_com')->delete($fullImagePath);
                    PTGallery::where('ruta', $filenameWithoutExtension)->delete();
                }
            }
            if ($request->filled('deleted_videos')) {
                $deletedVideos = json_decode($request->input('deleted_videos'), true);
                foreach ($deletedVideos as $videoUrl) {
                    $videoPath = parse_url($videoUrl, PHP_URL_PATH);
                    $videoName = basename($videoPath);
                    Storage::disk('videost')->delete($videoName);
                    VideoT::where('ruta', $videoName)->delete();
                }
            }
            if ($request->hasFile('videos')) {
                $videos = $request->file('videos');

                foreach ($videos as $videoFile) {
                    $destinationPath = Storage::disk('videost')->path($videoFile);
                    $videoPath = $videoFile->store('', 'videost');

                    $video = new VideoT();
                    $video->nombre = $videoFile->getClientOriginalName();
                    $video->ruta = $videoPath;
                    $video->tamaño = $videoFile->getSize();
                    $video->producto_id = $product->idproducto;
                    $video->save();
                }
            }

            return response()->json(['message' => 'Producto actualizado con éxito'], 200);
        } catch (Exception $e) {
            return response()->json(['error' => 'Error al actualizar producto: ' . $e->getMessage(), 'trace' => $e->getTraceAsString()], 500);
        }
    }
    public function deleteProductT($id){
      try{
        $product = ProductT::findOrFail($id);
        $product->delete();
        return response()->json(['message' => 'Producto eliminado con éxito'], 200);
      }catch(Exception $e){
        return response()->json(['error' => 'Error al eliminar product:' . $e->getMessage()], 500);
      }
    }
    public function deleteProduct($id){
        try {
            $product = Product::findOrFail($id);
            $product->delete();
            return response()->json(['message' => 'Producto eliminado con éxito'], 200);
        } catch (Exception $e) {
            return response()->json(['error' => 'Error al eliminar el producto: ' . $e->getMessage()], 500);
        }
    }
    public function getAllProductsByState(){
        $user = Auth::user();
        try{
            $vendedorId = $user->estado;
            $products = Product::where('status', '1')
                                ->where('estado', $vendedorId)
                                ->with(['images', 'videos'])
                                ->orderBy('idproducto', 'desc')
                                ->paginate(10);
            $products->each(function ($product) {
                $product->gallery = $product->images->map(function($image) use ($product) {
                    return asset('uploads/' . $product->carpeta . '/' . $image->img . '.webp');
                });
                if($product->owner){
                    $product->owner = $product->owner->email_user;
                }else{
                    $product->owner = null;
                }
            });     
            $products->each(function($product){
                $product->videosG = $product->videos->map(function($video){
                    if($video->ruta){
                        return asset('uploads/videos/' . $video->ruta);
                    }else{
                        return '';
                    }
                });
                if($product->videos->isEmpty()){
                    $product->videosG= [''];
                }
            });
        $productsT = ProductT::where('status', '2')
                            ->where('estado', $vendedorId)
                            ->with(['portada' => function ($query) {
                                $query->orderBy('id')->take(1); 
                            }, 'videos'])
                            ->orderBy('idproducto', 'desc')
                            ->paginate(10);

        $productsT->each(function ($productT) {
            if ($productT->images->isNotEmpty()) {
                $firstImage = $productT->images->first();
                $productT->portada_url = asset('uploads/tianguis/' . $productT->imagen . '/' . $firstImage->ruta . '.webp');
            }else{
                $productT->portada_url = null;
            }

        });
        $productsT->each(function ($productT) {
            if($productT->owner){
                    $productT->owner = $productT->owner->email_user;
                }else{
                    $productT->owner = null;
                }

        });     
        $productsT->each(function ($productT) {
            $productT->galleryT = $productT->images->map(function($image) use ($productT) {
                return asset('uploads/tianguis/' . $productT->imagen . '/' . $image->ruta . '.webp');
            });
        });
        $productsT->each(function($productT) {
            $productT->videosT = $productT->videos->map(function($video) {
                if ($video->ruta) {
                    return asset('uploads/videost/' . $video->ruta);
                } else {
                    return '';
                }
            });
    
            if ($productT->videosT->isEmpty()) {
                $productT->videosT = [''];
            }
        });
        return response()->json([
            'products' => $products,
            'productsT' => $productsT
        ]);
        }catch (Exception $e){
            return response()->json(['error' => 'Error al eliminar el producto: ' . $e->getMessage()], 500);
        }
    }
    public function getEstadosRegister(){
        $estados = Estado::where('id', 1)->get();
        return response()->json($estados);
    }
}
//imagen, titulo, raza, peso, precio, vistas, estatus