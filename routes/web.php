<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\ConnectController;
use App\Http\Controllers\TiendaController;
use App\Http\Controllers\SupportConversationController;
use App\Http\Controllers\Admin\ConversationController;
use App\Http\Livewire\Chat;
use App\Http\Controllers\APIAuthController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\ReviewController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('index');
});

Route::get('/api/products', [ApiController::class, 'getProducts']);
Route::get('/register', [ConnectController::class, 'getRegister']);
Route::post('/register', [ConnectController::class, 'postRegister']);
Route::get('/pago', [ConnectController::class, 'showPago']);
Route::post('/guardar-contacto', [ConnectController::class, 'guardarContacto'])->name('guardar.contacto');
Route::get('/login', [ConnectController::class, 'getLogin']);
Route::post('/login', [ConnectController::class, 'postLogin'])->name('login');
Route::get('/logout', [ConnectController::class, 'getLogout']);
Route::get('/migrate-passwords', [ConnectController::class, 'migratePasswords']);
/*tienda*/
///nueva ruta reviews
Route::post('/tienda/producto/{product}/review', [ReviewController::class,'store'])
        ->name('reviews.store');
Route::get('/tienda', [TiendaController::class, 'tiendaHome']);
Route::post('/contactInfo', [TiendaController::class, 'contactInfo'])->name('contactInfo');
Route::get('/tienda/producto/{id}/{ruta}', [TiendaController::class, 'tiendaProducto']);
Route::post('/tienda/producto/{id}/{ruta}', [TiendaController::class, 'tiendaProductoMsg'])->name('tiendaProductoMsg');
Route::get('/tianguisTienda', [TiendaController::class, 'getTianguisTienda'])->name('tiendaHome');
Route::get('/gratis', [TiendaController::class, 'getTianguis'])->name('subirTianguis');
Route::post('/gratis', [TiendaController::class, 'postTianguis'])->name('postTianguis');
Route::get('/tianguis/producto/{id}', [TiendaController::class, 'tianguisProducto'])->name('tianguisProducto');
Route::get('/subastas', [TiendaController::class, 'getSubastas'])->name('getSubastas');
Route::post('/sendOffer/{id}',  [TiendaController::class, 'sendOffer'])->name('sendOffer');
Route::get('/subastas/{id}', [TiendaController::class, 'getSubasta'])->name('getSubasta');
Route::get('/politicaPrivacidad', [TiendaController::class, 'getPoliticaPrivacidad']);
Route::get('/recomendaciones', [TiendaController::class, 'getRecomendaciones']);
Route::get('/suscripcion', [TiendaController::class, 'getSuscripcion']);
//posts
Route::get('/blog', [PostController::class, 'getPosts']);
Route::get('/blog/{id}', [PostController::class, 'show']);

Route::get('/embriones', [TiendaController::class, 'getEmbriones'])->name('getEmbrionesTienda');
Route::get('/embriones/producto/{id}', [TiendaController::class, 'getEmbrionesProducto'])->name('embrion.detalle');
Route::get('/pajillas', [TiendaController::class, 'getPajillas'])->name('getPajillasTienda');
Route::get('/pajillas/producto/{id}', [TiendaController::class, 'getProductPajillas'])->name('pajilla.detalle');

/*ciudades*/
Route::get('/get-estados', [TiendaController::class, 'getEstados']);
Route::get('/get-estadosRegister', [TiendaController::class, 'getEstadosRegister']);
Route::get('/get-ciudades-by-estado/{estadoId}', [TiendaController::class, 'getCiudadesByEstado']);
Route::get('/get-comisarias-by-ciudad/{ciudadId}', [TiendaController::class, 'getComisariasByCiudad']);
Route::middleware('auth')->group(function () {
    Route::post('support-conversations', [SupportConversationController::class, 'store']);

	Route::get('/support/conversations/{conversation}', [ConversationController::class, 'show'])
    ->name('conversation.show');
    Route::get('/startChat', [Chat::class, 'sendMessage'])->name('startChat');
    Broadcast::channel('admin-channel', function ($user) {
    return $user->isAdmin();
	});
});


Route::post('/loginAPI', [APIAuthController::class, 'login']);
/* test de chat*/
/*
Route::get('/test-event', function(){
    $user = auth()->user();
    $message = "Este es un mensaje de prueba";
    event(new App\Events\SupportConversationStarted($user, $message));
    return "evento funciono";
});*/
