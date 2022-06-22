<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\CulturaController;
use App\Http\Controllers\PublicoController;
use App\Http\Controllers\ObjetosDigitaleController;
use App\Http\Controllers\ColeccionController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group(['prefix' => 'publicos'], function () {    
    Route::get('/', [PublicoController::class, 'getAll']);
    Route::get('/{slug}', [PublicoController::class, 'getOne']);

});

Route::group(['prefix' => 'objetos'], function () {    
    Route::get('/', [ObjetosDigitaleController::class, 'getObjetosSearch']);
    Route::get('/{slug}', [ObjetosDigitaleController::class, 'getOneObjeto']);  

});


Route::group(['prefix' => 'culturas'], function () {    
    Route::get('/', [CulturaController::class, 'getAll']);
    Route::get('/{slug}', [CulturaController::class, 'getOne']);

});

Route::group(['prefix' => 'categorias'], function () {    
    Route::get('/', [CategoriaController::class, 'getAll']);
    Route::get('/{slug}', [CategoriaController::class, 'getOne']); 
});


Route::group(['prefix' => 'colecciones'], function () {    
    Route::get('/principales', [ColeccionController::class, 'principales']);
    Route::get('/diccionarios', [ColeccionController::class, 'diccionarios']); 
});