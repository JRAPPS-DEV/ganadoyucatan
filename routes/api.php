
<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\APIAuthController;
use App\Http\Controllers\APIProductsController;
use App\Http\Controllers\APIUserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|jwt-auth secret [USIGw4ul7sQHhircDfkSVv2mMAhGH1Ep7N7ZN2zt17Pq0s2NTrLF0arlCdkCbmWP] set successfully.  
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/register', [APIAuthController::class, 'register']);
Route::post('/login', [APIAuthController::class, 'login']);



/*get Products methods*/
Route::middleware('jwt.auth')->get('/productsAll', [APIProductsController::class, 'show']);
Route::middleware('jwt.auth')->get('/productsAllCom', [APIProductsController::class, 'showCom']);
Route::middleware('jwt.auth')->get('/productsAllSub', [APIProductsController::class, 'showSub']);
/*data User methods*/
Route::middleware('jwt.auth')->get('/userProfile', [APIUserController::class, 'getUProfInfo']);
Route::middleware('jwt.auth')->post('/updateProfile', [APIUserController::class, 'updateProfile']);
Route::middleware('jwt.auth')->post('/updateFiscoData', [APIUserController::class, 'updateFiscoData']);

Route::middleware('jwt.auth')->get('/getUserMsgs', [APIUserController::class, 'getUserMsgs']);
Route::middleware('jwt.auth')->post('/updateMessageStatus', [APIUserController::class, 'updateMessageStatus']);
/*fetching data*/
Route::get('/estados', [APIProductsController::class, 'getEstados']);
Route::get('/ciudades/{estadoId}', [APIProductsController::class, 'getCiudadesByEstado'])->withoutMiddleware('throttle');
Route::get('/comisarias/{ciudadId}', [APIProductsController::class, 'getComisariasByCiudad']);
/*product post methods*/
Route::middleware('jwt.auth')->post('/products/addNewGen', [APIProductsController::class, 'postNewGen'])->name('api.addNewGen');

//Route::middleware('jwt.auth')->put('/updateProduct/{id}', [APIProductsController::class, 'updateGen']);
Route::post('/updateProduct/{id}', [APIProductsController::class, 'updateGen']);

Route::middleware('jwt.auth')->post('/products/addNewCom', [APIProductsController::class, 'postNewCom'])->name('api.addNewCom');

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    //return $request->user();
});
/*
Route::middleware('auth')->group(function () {
    Route::post('support-conversations', [SupportConversationController::class, 'store']);
});*/