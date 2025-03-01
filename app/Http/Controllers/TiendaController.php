<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\Product;
use App\Models\ProductT;
use App\Models\ProductS;
use App\Models\Estado;
use App\Models\Ciudad;
use App\Models\PGallery;
use App\Models\PTGallery;
use App\Models\PSubGallery;
use App\Models\MensajeProducto;
use App\Models\OfertaSubasta;
use App\Models\Visits;
use App\Models\Video;
use App\Models\VideoT;
use App\Models\VideoS;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Utilities\ImageConverter;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Session;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Pajilla;
use App\Models\PajillaImagen;
use App\Models\PajillaVideo;
use App\Models\Embrion;
use App\Models\EmbrionImagen;
use App\Models\EmbrionVideo;
class TiendaController extends Controller
{
    public function getEstados(){
        $estados = Estado::all();
        return response()->json($estados);
    }
    public function getCiudadesByEstado($estadoId){
        $ciudades = Ciudad::where('estado_id', $estadoId)->get();
        return response()->json($ciudades);
    }
    public function tiendaHome(Request $request){
        $query = Product::where('status', '1');
        if ($request->has('estado_id')) {
            $query->where('estado', $request->estado_id);
        }    if ($request->has('ciudad_id')) {
            $query->where('ciudad', $request->ciudad_id);
        }
        if ($request->has('lisTipo')) {
            $query->where('tipo', $request->lisTipo);
        }
        if ($request->has('min_price')) {
            $query->where('precio', '>=', $request->min_price);
        }
        if ($request->has('max_price')) {

            $query->where('precio', '<=', $request->max_price);
        }
        $products = $query->orderBy('idproducto', 'desc')->paginate(10);

        if ($products->count() >= 10) {
            $random = $query->get()->random(3);
            $products = $query->orderBy('idproducto', 'desc')->whereNotIn('idproducto', [$random[0]->idproducto, $random[1]->idproducto, $random[2]->idproducto])->paginate(9);
        }else{
            $random = null;
        }

        $estados = Estado::all();
        $data = ['products' => $products, 'random' => $random, 'estados' => $estados];

        return view('Tienda.home', $data);
    }
    public function tiendaProducto($id, $ruta){
        $product = Product::where('idproducto', $id)->where('ruta', $ruta)->get();
        $random = Product::where('status', '1')->whereNot('idproducto', $id)->get();
        if ($random->count() >= 6) {
            $random = Product::where('status', '1')->whereNot('idproducto', $id)->get()->random(6);
        }else if($random->count() == 5){
            $random = Product::where('status', '1')->whereNot('idproducto', $id)->get()->random(5);
        }else if($random->count() == 4){
            $random = Product::where('status', '1')->whereNot('idproducto', $id)->get()->random(4);
        }else if($random->count() == 3){
            $random = Product::where('status', '1')->whereNot('idproducto', $id)->get();
        }else{
           $random = null;
        }
        $images = PGallery::where('productoid', $id)->get();
        $video = Video::where('producto_id', $id)->get();

        Visits::create([
            'ip' => request()->ip(),
            'idproducto' => $id,
            'fecha' => date('Y-m-d h:i:s'),
            'vendedorid' => $product[0]['vendedorid'],
            'type' => 'gen']);
        $data = ['product' => $product, 'images' => $images, 'random' => $random, 'video' => $video];
        return view('Tienda.product', $data);
    }
    public function tiendaProductoMsg(Request $request, $id, $ruta){
            $nombre = ucwords(strtolower(trim($request->input('name'))));
            $email = strtolower(trim($request->input('phone')));
            $mensaje = $request->input('message');
            $useragent = $request->server('HTTP_USER_AGENT');
            $ip = $request->server('REMOTE_ADDR');
            $dispositivo = "PC";
            $vendedorid = $request->input('vendedorid');
            if(preg_match("/mobile/i", $useragent)){
                $dispositivo = "Móvil";
            } else if (preg_match("/tablet/i", $useragent)) {
                $dispositivo = "Tablet";
            } else if (preg_match("/iPhone/i", $useragent)) {
                $dispositivo = "iPhone";
            } else if (preg_match("/iPad/i", $useragent)) {
                $dispositivo = "iPad";
            }
            $product = Product::where('idproducto', $id)->pluck('nombre')->first();
            $msg = new MensajeProducto;
            $msg->nombre = $nombre;
            $msg->mensaje = $mensaje . ' Para el producto:' . $product;
            $msg->email = $email;
            $msg->ip = $ip;
            $msg->dispositivo = $dispositivo;
            $msg->useragent = $useragent;
            $msg->datecreated = date('Y-m-d');
            $msg->vendedorid = $vendedorid;
            $msg->status = 0;
            if($msg->save()){

                    Alert::success('Éxito', 'El mensaje se envió correctamente.');
                    return back();

            }
    }
    public function contactInfo(Request $request){
        $nombre = ucwords(strtolower(trim($request->input('name'))));
        $email = strtolower(trim($request->input('phone')));
        $mensaje = $request->input('message');
        $useragent = $request->server('HTTP_USER_AGENT');
        $ip = $request->server('REMOTE_ADDR');
        $dispositivo = "PC";
        if(preg_match("/mobile/i", $useragent)){
            $dispositivo = "Móvil";
        } else if (preg_match("/tablet/i", $useragent)) {
            $dispositivo = "Tablet";
        } else if (preg_match("/iPhone/i", $useragent)) {
            $dispositivo = "iPhone";
        } else if (preg_match("/iPad/i", $useragent)) {
            $dispositivo = "iPad";
        }
        $msg = new MensajeProducto;
        $msg->nombre = $nombre;
        $msg->mensaje = $mensaje;
        $msg->email = $email;
        $msg->ip = $ip;
        $msg->dispositivo = $dispositivo;
        $msg->useragent = $useragent;
        $msg->datecreated = date('Y-m-d');
        $msg->vendedorid =  '1';
        $msg->status = 0;
        if($msg->save()){
            event(new NewMessageNotification($msg));

            Alert::success('Éxito', 'El mensaje se envió correctamente.');
            return back();
        } else {
            Alert::error('Error', 'Hubo un problema al enviar el mensaje.');
            return back();
        }
    }
    public function getTianguisTienda(Request $request){
        $query = ProductT::where('status', '2');
        if ($request->has('estado_id')) {
            $query->where('estado', $request->estado_id);
        }    if ($request->has('ciudad_id')) {
            $query->where('ciudad', $request->ciudad_id);
        }
        if ($request->has('lisTipo')) {
            $query->where('tipo', $request->lisTipo);
        }
        if ($request->has('min_price')) {
            $query->where('precio', '>=', $request->min_price);
        }
        if ($request->has('max_price')) {

            $query->where('precio', '<=', $request->max_price);
        }
        //$products = $query->orderBy('idproducto', 'desc')->paginate(10);
        $products = $query->orderBy('idproducto', 'desc')->paginate(9);
        $random = ProductT::where('status', '2')->get();
        if ($products->count() >= 10) {
            $random = ProductT::where('status', '2')->get()->random(3);
            $products = ProductT::where('status', '2')->orderBy('idproducto', 'desc')->whereNotIn('idproducto', [$random[0]->idproducto, $random[1]->idproducto, $random[2]->idproducto])->paginate(9);
        }else{
           $random = null;
        }
        $estados = Estado::all();
        $data = ['products' => $products,'random' => $random, 'estados' => $estados];
        return view('Tienda.Tianguis.tianguisHome', $data);
    }
    public function getTianguis(){
        return view('Tienda.tianguisPost');
    }
    public function tianguisProducto($id){
        $product = ProductT::where('idproducto', $id)->get();
        $random = ProductT::where('status', '2')->whereNot('idproducto', $id)->get();
        if ($random->count() >= 6) {
            $random = ProductT::where('status', '2')->whereNot('idproducto', $id)->get()->random(6);
        }else if($random->count() == 5){
            $random = ProductT::where('status', '2')->whereNot('idproducto', $id)->get()->random(5);
        }else if($random->count() == 4){
            $random = ProductT::where('status', '2')->whereNot('idproducto', $id)->get()->random(4);
        }else if($random->count() == 3){
            $random = ProductT::where('status', '2')->whereNot('idproducto', $id)->get();
        }else{
           $random = null;
        }
        $product = $product[0];
        $images = PTGallery::where('id_producto', $id)->get();
        $video = VideoT::where('producto_id', $id)->get();
        if ($video->isEmpty()) {
            $video = null;
        };


        $imagesRandom = PTGallery::whereNot('id_producto', $id)->get();
        Visits::create([
            'ip' => request()->ip(),
            'idproducto' => $id,
            'fecha' => date('Y-m-d h:i:s'),
            'vendedorid' => $product['vendedorid'],
            'type' => 'com']);
        $data = ['product' => $product, 'images' => $images, 'random' => $random, 'imagesRandom' => $imagesRandom,  'video' => $video];
        return view('Tienda.Tianguis.tianguisProduct', $data);
    }
    public function getSubastas(){
        $today = now()->format('Y-m-d H:i:s');
        $query = ProductS::where('status', '1');
        //$products = ProductS::where('status', '1')->where('fechaCierre', '>', $today)->get();
        $products = $query->orderBy('id_producto', 'desc')->where('fechaCierre', '>', $today)->get();
        $random = ProductS::where('status', '1')->get();
        if ($products->count() >= 10) {
            $random = ProductS::where('status', '1')->get()->random(3);
            $products = ProductS::where('status', '1')->orderBy('id_producto', 'desc')->whereNotIn('id_producto', [$random[0]->idproducto, $random[1]->idproducto, $random[2]->idproducto])->paginate(9);
        }else{
           $random = null;
        }
        $estados = Estado::all();
        $data = ['products' => $products, 'random' => $random, 'estados' => $estados];

        return view('Tienda.Subasta.subastaHome', $data);
    }
    public function postTianguis(Request $request){
        $estado = $request->input('estados', 1);
        $ciudad = $request->input('ciudades', 1);
        $nombre = $request->input('nombre');
        $descripcion = $request->input('descripcion');
        $precio = $request->input('precio');
        $numero = $request->input('numero');
        $ruta = strtolower(str_replace(" ", "-", $nombre));
        $pesoG = $request->input('pesoG');
        $txtStock = $request->input('txtStock');
        $txtRaza = $request->input('txtRaza');
        $listVacu = $request->input('listVacu');
        $listArete = $request->input('listArete');
        $listCert = $request->input('listCert');
        $lisTipo = $request->input('lisTipo');
        $txtLink = $request->input('txtLink');
        $propietario = $request->input('propietario');
        $id_producto = DB::table('productot')->insertGetId([
            'estado' => $estado,
            'ciudad' => $ciudad,
            'nombre' => $nombre,
            'descripcion' => $descripcion,
            'precio' => $precio,
            'numero' => $numero,
            'ruta' => $ruta,
            'peso' => $pesoG,
            'stock' => $txtStock,
            'raza' => $txtRaza,
            'vacunado' => $listVacu,
            'arete' => $listArete,
            'certificado' => $listCert,
            'tipo' => $lisTipo,
            'link' => $txtLink,
            'propietario' => $propietario,
            'vendedorid' => '1',
        ]);
        $ruta_carpeta = "uploads/tianguis/$id_producto";
        if (!File::makeDirectory($ruta_carpeta, 0755, true)) {
            return "Error al crear la carpeta del producto $id_producto";
        }
        $includesImages = [];
        for ($i = 1; $i <= 9; $i++) {
            $imagen = "imagen" . $i;
            if ($request->hasFile($imagen) && $request->file($imagen)->isValid()) {
                $uploadPath = "tianguis/$id_producto";
                $ruta = "$ruta_carpeta/" . $request->file($imagen)->getClientOriginalName();
                $randomString = Str::random(3);
                $filename = 'GYT-'.date('md').'-'.$randomString . '.' . $request->file($imagen)->getClientOriginalExtension();
                $path = $filename;
                $ruta_webp = $uploadPath . '/' . pathinfo($path, PATHINFO_FILENAME) . '.webp';
                $destinationPath = Storage::disk('webp_images')->path($ruta_webp);
                $img = Image::make($request->file($imagen)->getRealPath())->resize(800, 600);
                $img->encode('webp', 10)->save($destinationPath);
                $includesImages[] = $ruta_webp;
            }
        }
        foreach ($includesImages as $ruta_webp) {
            DB::table('imagent')->insert([
                'id_producto' => $id_producto,
                'ruta' => $ruta_webp,
            ]);
        }
        if ($id_producto) {
            return "HOLA";
        } else {
            return "Error al agregar el producto";
        }
    }
    public function getSubasta($id){
        $p = ProductS::where('status', 1)->findOrFail($id);
        $images = PSubGallery::where('productoid', $id)->get();
        $video = VideoS::where('producto_id', $id)->get();
        Visits::create([
            'ip' => request()->ip(),
            'idproducto' => $id,
            'fecha' => date('Y-m-d h:i:s'),
            'vendedorid' => $p['vendedorid'],
            'type' => 'sub']);
        $data = ['p' => $p, 'images' => $images, 'video' => $video];
        return view('Tienda.Subasta.subastaProduct', $data);
    }
    public function sendOffer(Request $request, $id){
        $nombre = ucwords(strtolower(trim($request->input('name'))));
        $oferta = $request->input('oferta');
        $dispositivo = "PC";
        $id = Auth::id();
        if(!$id){
            return back()->with('message', 'Te recordamos que es necesario estar registrado para poder hacer una oferta')->with('typealert', 'danger');
        }
        $off = new OfertaSubasta;
        $off->idProducto = $id;
        $off->oferta = $oferta;
        $off->comprador = $nombre;
        $off->fecha = date('Y-m-d');
        if($off->save()){
            Alert::success('Éxito', 'La oferta se envió correctamente.');
            return back();
        }
    }
    public function getPoliticaPrivacidad(){
        return view('politicaPrivacidad');
    }
    public function getRecomendaciones(){
        return view('recomendaciones');
    }
    public function getSuscripcion(){
        return view('suscripcion');
    }
    public function getEmbriones(){
        $products = Embrion::with(['location', 'imagenes'])->orderBy('idproducto', 'desc')->paginate(25);
        return view('Tienda.Embriones.embrionesHome', compact('products'));
    }
    public function getEmbrionesProducto($id){
        $embrion = Embrion::with(['imagenes', 'videos', 'location'])->findOrFail($id);
        return view('Tienda.Embriones.embrionesProduct', compact('embrion'));
    }
    public function getPajillas(Request $request) {
        $query = Pajilla::with(['location', 'imagenes'])->orderBy('idproducto', 'desc');
        if ($request->filled('estado')) {
            $query->where('estado', $request->estado);
        }
        if ($request->filled('ciudad')) {
            $query->where('ciudad', $request->ciudad);
        }
        if ($request->filled('txtRaza')) {
            $query->where('raza', $request->txtRaza);
        }
        if ($request->filled('minPrecio') && $request->filled('maxPrecio')) {
            $query->whereBetween('precio', [$request->minPrecio, $request->maxPrecio]);
        }
        $products = $query->paginate(25);

        return view('Tienda.Pajillas.pajillasHome', compact('products'));
    }

    public function getProductPajillas($id){
        $pajilla = Pajilla::with(['imagenes', 'videos', 'location'])->findOrFail($id);
        return view('Tienda.Pajillas.pajillasProduct', compact('pajilla'));
    }

}
