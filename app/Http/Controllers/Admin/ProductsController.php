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
use App\Models\Estado;
use App\Models\Ciudad;
use App\Models\Comisaria;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Utilities\ImageConverter;
class ProductsController extends Controller
{
        public function __construct(){
        $this->middleware('auth');
    }
    public function getEstados(){
        $estados = Estado::all();
        return response()->json($estados);
    }
    public function getCiudadesByEstado($estadoId){
        $ciudades = Ciudad::where('estado_id', $estadoId)->get();
        return response()->json($ciudades);
    }
    public function imageAction(Request $request){
        if (!$request->session()->has('product.images')) {
            $request->session()->put('product.images', []);
            $request->session()->put('product.imageCount', 0);
        }
        if(!$request->session()->has('product.randomString')){
            $request->session()->put('product.randomString', Str::random(4));
        }
        $randomString = $request->session()->get('product.randomString');
        $action = $request->input('action');
        switch ($action) {
            case 'add':
                $imageCount = $request->session()->get('product.imageCount');
                $uploadedImage = $request->file('uploaded_image');
                $dateFolder = date('Y-m-d');
                $uploadPath = 'uploads/' . $dateFolder;
                $filename = $imageCount . '-' . 'GY-'.date('md').'-'.$randomString . '.' . $uploadedImage->getClientOriginalExtension();
                $request->session()->increment('product.imageCount');
                if (!File::exists($uploadPath)) {
                    File::makeDirectory($uploadPath, 0755, true);
                }
                $path = $filename;
                $webpPath = $dateFolder . '/' . pathinfo($path, PATHINFO_FILENAME) . '.webp';
                $destinationPath = Storage::disk('webp_images')->path($webpPath);
                $img = Image::make($uploadedImage->getRealPath())->resize(800, 600);
                $img->encode('webp', 10)->save($destinationPath);
                //ImageConverter::convertToWebp($uploadedImage->getRealPath(), $destinationPath);
    
                $images = $request->session()->get('product.images');
                $images[] = [
                    'path' => '/' . $webpPath //$dateFolder . '/' . $webpPath
                ];
                $request->session()->put('product.images', $images);
                return response()->json(['image' => ['path' => '/' . $webpPath]]); //$dateFolder . '/' . $webpPath
            case 'delete':
                $imagePath = $request->input('image_path');
                $images = $request->session()->get('product.images');
                $images = array_filter($images, function ($image) use ($imagePath) {
                    return $image['path'] != $imagePath;
                });
                $request->session()->put('product.images', $images);
                if (file_exists(public_path('uploads/' . $imagePath))) {
                    unlink(public_path('uploads/' . $imagePath));
                }
                //cualquier de los dos sirve
               /* $webpPath = 'uploads/' . $imagePath;
                if (File::exists($webpPath)) {
                    File::delete($webpPath);
                }*/
                return response()->json(['success' => true]);
            case 'update':
                $newOrder = $request->input('new_order');
                $images = $request->session()->get('product.images');
                $orderedImages = [];
                foreach ($newOrder as $imageId) {
                    $orderedImages[] = $images[array_search($imageId, array_column($images, 'id'))];
                }
                $request->session()->put('product.images', $orderedImages);
                return response()->json(['success' => true]);
            default:
                return response()->json(['error' => 'Accion invalida'], 400);
        }
    }
    public function getComisariasByCiudad($ciudadId){
        $comisarias = Comisaria::where('ciudad_id', $ciudadId)->get();
        return response()->json($comisarias);
    }    
    public function getProductsHome(){
        return view('Admin.Products.home');
    }
    public function getNewGen(){
        $id = Auth::id();
        $products = Product::where('vendedorid', $id)->orderBy('idproducto', 'desc')->paginate(25);
        $data = ['products' => $products];
        return view('Admin.Products.gen', $data);
    }   
    public function postNewGen(Request $request){
        $rules = [
            'name' => 'required',
            'price' => 'required',
            'content' => 'required'
        ];
        $messages = [
            'name.required' => 'Nombre de producto obligatorio',
            'price.required' => 'Precio obligatorio',
            'content.required' => 'Por favor agregue una descripcion'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if($validator->fails()):
            return back()->withErrors($validator)->with('message', 'Se ha producido un error')->with('typealert', 'danger')->withInput();
        else:


            $imagesJson = $request->input('images');
            $images = json_decode($imagesJson, true);
            if (!$images || count($images) == 0) {
                return back()->withErrors(['message' => 'Por favor, cargue al menos una imagen.'])->withInput();
            }
            $firstImage = $images[0];
            $dateFolder = date('Y-m-d');
            $product = new Product;
            $product->status = '1';
            $product->name = e($request->input('name'));
            $product->slug = Str::slug($request->input('slug'));
            $product->category_id = $request->input('category');
            $product->type_id = $request->input('type');
            $product->price = $request->input('price');
            $product->divs = $request->input('div');
            $product->in_discount = $request->input('indiscount');
            $product->urgente = false;
            $product->content = e($request->input('content'));
            $idv = Auth::id();
            if(Auth::user()->giroEmp == 1 && Auth::user()->giroEmp != "5"){
                $product->asesor_id = null;
            }else{
                $product->asesor_id = $request->input('asesor');
            }
            $product->asesor_id = $request->input('asesor');
            $product->vendedorid = $idv;
            $product->location = $request->input('estado');
            $product->sublocation = $request->input('ciudad');
            $product->sSublocation = $request->input('comisaria');
           
            $coords = [ 'latitud' => $request->input('latitude'),
                        'longitud' => $request->input('longitude')];           
            $coords = json_encode($coords);
            $latitud = $request->input('latitude');
            $longitud = $request->input('longitude');

            /*  $location = "";
            if ($latitud >= 20.6855 && $latitud <= 21.8945 && $longitud >= -90.5957 && $longitud <= -87.3730) {
                $location = "Yucatán";
              } elseif ($latitud >= 17.8409 && $latitud <= 19.7021 && $longitud >= -92.1094 && $longitud <= -90.1758) {
                $location = "Campeche";
              } elseif ($latitud >= 17.4133 && $latitud <= 21.2389 && $longitud >= -88.5839 && $longitud <= -85.2861) {
                $location = "Quintana Roo";
              } else {
                $location = "Ubicación fuera de los estados de Yucatán, Campeche y Quintana Roo";
              }
            $test = $latitud.'-'.$longitud;
              dd($test);*/
            $product->location = $request->input('state');
            $product->sublocation = $request->input('city');
            $product->sSublocation = $request->input('neighborhood');
            $product->coords = $coords;
            $randomString = Str::random(3);
            $amenidades = ['key' => 'SH-'.date('md').'-'.$randomString];
            $amenidades = json_encode($amenidades);
            $product->amenidades = $amenidades;
            $product->file_path = $dateFolder;
            $product->image = basename($firstImage['path']);
            $product->save();
            if (count($images) > 1) {
                for ($i = 1; $i < count($images); $i++) {
                $imageData = $images[$i];
                $image = new PGallery;
                $image->product_id = $product->id;
                $image->file_path = $dateFolder;
                $image->file_name = basename($imageData['path']);
                $image->save();
                }
            }
            $request->session()->forget('product_images');
            if($product->save()):
                return redirect('/admin/product/'.$product->id.'/edit')->with('message', 'Inmueble agregado con exito al sistema')->with('typealert', 'success'); 
            endif;
        endif;
    }
    public function getNewCom(){
        $id = Auth::id();
        $products = ProductT::where('vendedorid', $id)->orderBy('idproducto', 'desc')->paginate(25);
        $data = ['products' => $products];
        return view('Admin.Products.com', $data);
    }
    public function getNewSub(){
        $id = Auth::id();
        $products = ProductT::where('vendedorid', $id)->orderBy('idproducto', 'desc')->paginate(25);
        $data = ['products' => $products];
        return view('Admin.Products.sub', $data);
    }
}
