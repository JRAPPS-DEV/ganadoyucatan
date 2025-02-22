<?php 
use App\Http\Controllers\Admin\ProductsController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\ConversationController;
use App\Http\Controllers\Admin\PostController;
Route::prefix('/admin')->middleware(['verificarRol'])->group(function(){

/*ciudades*/
Route::get('/get-estados', [ProductsController::class, 'getEstados']);
Route::get('/get-ciudades-by-estado/{estadoId}', [ProductsController::class, 'getCiudadesByEstado']);
Route::get('/get-comisarias-by-ciudad/{ciudadId}', [ProductsController::class, 'getComisariasByCiudad']);
/*productos*/
Route::get('/products/home', [ProductsController::class, 'getProductsHome'])->name('productsHome')->withoutMiddleware(['verificarRol']);
Route::get('/products/TianguisAdmin', [ProductsController::class, 'getTianguisAll'])->name('getTianguisAll');
Route::get('/products/TianguisAdminInfo/{id}', [ProductsController::class, 'getTianguisView'])->name('getTianguisView');
Route::get('/products/aprobProduct/{id}', [ProductsController::class, 'aprobTianguisProduct'])->name('aprobProduct');
Route::get('/products/getAllGanado', [ProductsController::class, 'getAllGanado'])->name('getAllGanado');
Route::get('/products/deleteGen/{id}', [ProductsController::class, 'deleteGen'])->name('deleteGen');

Route::post('/products/image-action', [ProductsController::class, 'imageAction'])->name('product.image_action');
Route::post('/products/image-actionS', [ProductsController::class, 'imageActionSub'])->name('product.image_actionS');
Route::post('/products/image-actionC', [ProductsController::class, 'imageActionCom'])->name('product.image_actionC');



Route::post('/products/image-actionPart', [ProductsController::class, 'imageActionPart'])->name('product.image_actionPart');
Route::post('/products/add-images', [ProductsController::class, 'addImages'])->name('product.add_images');
Route::post('/products/image-actionCom', [ProductsController::class, 'imageActionPartCom'])->name('product.image_actionCom');
Route::post('/products/add-imagesCom', [ProductsController::class, 'addImagesCom'])->name('product.add_imagesCom');
Route::post('/products/add-imagesSub', [ProductsController::class, 'addImagesSub'])->name('product.add_imagesSub');

/*----*/
Route::get('products/getProductImages/{id}', [ProductsController::class, 'getProductImages'])->name('getProductImages');

Route::post('/products/addNewGen', [ProductsController::class, 'postNewGen'])->name('addNewGen');
Route::get('/products/addNewGen', [ProductsController::class, 'getNewGen'])->name('getNewGen');
Route::get('/products/getProductInfo/{id}', [ProductsController::class, 'getProductEdit'])->name('getProductEdit');
Route::post('/products/postProductInfo/{id}', [ProductsController::class, 'postProductEditGen'])->name('postProductEdit');
Route::get('/products/deleteGenImage/{id}/{portada}', [ProductsController::class, 'deleteGenImage'])->name('deleteGenImage');

Route::get('/products/addNewCom', [ProductsController::class, 'getNewCom'])->name('getNewCom');
Route::post('/products/addNewCom', [ProductsController::class, 'postNewCom'])->name('postNewCom');
Route::get('/products/getComInfo/{id}', [ProductsController::class, 'getComEdit'])->name('getComEdit');
Route::post('/products/postComInfo/{id}', [ProductsController::class, 'postComInfo'])->name('postComInfo');
Route::get('/products/deleteCom/{id}', [ProductsController::class, 'deleteCom'])->name('deleteCom');
Route::get('/products/deleteComImage/{id}/{portada}', [ProductsController::class, 'deleteComImage'])->name('deleteComImage');

Route::get('/products/addNewSub', [ProductsController::class, 'getNewSub'])->name('getNewSub');
Route::post('/products/addNewSub', [ProductsController::class, 'postNewSub'])->name('postNewSub');
Route::get('/products/getSubInfo/{id}', [ProductsController::class, 'getSubEdit'])->name('getSubEdit');
Route::post('/products/postsubtInfo/{id}', [ProductsController::class, 'postsubtInfo'])->name('postsubtInfo');
Route::get('/products/deleteSub/{id}', [ProductsController::class, 'deleteSub'])->name('deleteSub');
Route::get('/products/deleteSubImage/{id}/{portada}', [ProductsController::class, 'deleteSubImage'])->name('deleteSubImage');

/*mensajes*/
Route::get('/mensajes', [ProductsController::class, 'getMensajesHome'])->name('mensajesHome');
Route::post('/mensajes/{id}', [ProductsController::class, 'readMensajesHome'])->name('readMensajesHome');
Route::post('/readMsgs', [ProductsController::class, 'markMultipleAsRead'])->name('markMultipleAsRead');
/*Usuarios*/
Route::get('/users', [UsersController::class, 'getUsers'])->name('usersHome')->middleware(['IsAdmin']);
Route::get('/get-user-info/{id}', [UsersController::class, 'getUserInfo'])->middleware(['IsAdmin']);
Route::post('/users/edit/{id}', [UsersController::class, 'postEditUser'])->name('postEditUser')->middleware(['IsAdmin']);
Route::get('/users/deleteUsr/{id}', [UsersController::class, 'deleteUsr'])->name('deleteUsr')->middleware(['IsAdmin']);
Route::get('/reactiveAccount/{id}', [UsersController::class, 'reactiveAccount'])->name('reactiveAccount')->middleware(['IsAdmin']);
Route::get('users/profile', [UsersController::class, 'getUProfInfo']);
Route::post('users/profile/{id}', [UsersController::class, 'postUProfInfo']);
//rutas post 
Route::resource('posts', PostController::class);
//rutas pagilla
Route::get('/products/addNewPajilla', [ProductsController::class, 'getPajillas'])->name('getPajillas');
Route::post('/products/addNewPaj', [ProductsController::class, 'postNewPajilla'])->name('addNewPaj');
Route::delete('/products/deletePaj/{id}', [ProductsController::class, 'deletePajilla'])->name('deletePaj');
/*chat soporte*/
 Route::get('/conversation', [ConversationController::class, 'index'])->name('conversationIndex');
  Route::get('/conversation/{conversation}', [ConversationController::class, 'show'])->name('conversationShow');
 	//Route::get('/conversation/{conversation}', Chat::class)->name('conversationShow');
    /*Route::get('/startChat', [Chat::class, 'sendMessage'])->name('startChat');*/
});
