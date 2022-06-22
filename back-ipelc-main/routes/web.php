<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ArchivoController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\FormaController;
use App\Http\Controllers\FormatoController;
use App\Http\Controllers\ColeccionController;
use App\Http\Controllers\CulturaController;
use App\Http\Controllers\IdiomaController;
use App\Http\Controllers\ObjetosDigitaleController;
use App\Http\Controllers\PublicoController;
use App\Http\Controllers\UsuarioController;


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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('categorias', CategoriaController::class)->middleware('auth');
Route::resource('formas', FormaController::class)->middleware('auth');
Route::resource('formatos', FormatoController::class)->middleware('auth');
Route::resource('colecciones', ColeccionController::class)->middleware('auth');
Route::resource('idiomas', IdiomaController::class)->middleware('auth');
Route::resource('culturas', CulturaController::class)->middleware('auth');
Route::resource('publicos', PublicoController::class)->middleware('auth');
Route::resource('objetos-digitales', ObjetosDigitaleController::class)->middleware('auth');
Route::get('uploadMultimediaObjetos/{id}', [ObjetosDigitaleController::class, "uploadMultimediaObjetos"])->name('uploadMultimediaObjetos')->middleware('auth');
Route::patch('uploadFilePortada/{id}', [ObjetosDigitaleController::class, "uploadFilePortada"])->name('uploadFilePortada')->middleware('auth');
Route::get('deleteFileObjetos/{id}', [ObjetosDigitaleController::class, "deleteFileObjetos"])->name('deleteFileObjetos')->middleware('auth');
Route::get('search', [ObjetosDigitaleController::class, "search"])->name('search')->middleware('auth');


Route::resource('archivos', ArchivoController::class)->middleware('auth');

Route::post('addAtributo/{id}', [ObjetosDigitaleController::class, 'addAtributo'])->name('addAtributo');
Route::get('deleteAtributos/{key}/{objeto}', [ObjetosDigitaleController::class, 'deleteAtributos'])->name('deleteAtributos');
Route::post('updateAtributo/{id}', [ObjetosDigitaleController::class, 'updateAtributo'])->name('updateAtributo');

Route::get('deleteArchivos/{archivo}/{objeto}', [ArchivoController::class, 'destroy'])->name('deleteArchivos');
Route::post('uploadArchivo', [ArchivoController::class, "uploadArchivo"])->name('uploadArchivo')->middleware('auth');
Route::post('file-upload/upload-large-files', [ArchivoController::class, 'uploadLargeFiles'])->name('files.upload.large');


Route::get('deleteFileCategoria/{id}', [CategoriaController::class, "deleteFileCategoria"])->name('deleteFileCategoria')->middleware('auth');

Route::get('deleteFileCulturaListado/{id}', [CulturaController::class, "deleteFileCulturaListado"])->name('deleteFileCulturaListado')->middleware('auth');
Route::get('deleteFileCulturaHome/{id}', [CulturaController::class, "deleteFileCulturaHome"])->name('deleteFileCulturaHome')->middleware('auth');


Route::get('deleteFilePublicoListado/{id}', [PublicoController::class, "deleteFilePublicoListado"])->name('deleteFilePublicoListado')->middleware('auth');
Route::get('deleteFilePublicoHome/{id}', [PublicoController::class, "deleteFilePublicoHome"])->name('deleteFilePublicoHome')->middleware('auth');




Route::get('usuarios', [UsuarioController::class, "index"])->name('usuarios.index')->middleware('auth');
Route::get('usuarios/create', [UsuarioController::class, "create"])->name('usuarios.create')->middleware('auth');
Route::get('usuarios/{id}', [UsuarioController::class, "show"])->name('usuarios.show')->middleware('auth');
Route::post('usuarios/store', [UsuarioController::class, "store"])->name('usuarios.store')->middleware('auth');
Route::get('usuarios/{id}/edit', [UsuarioController::class, "edit"])->name('usuarios.edit')->middleware('auth');
Route::PATCH('usuarios/{id}', [UsuarioController::class, "update"])->name('usuarios.update')->middleware('auth');
Route::delete('usuarios/{id}', [UsuarioController::class, "destroy"])->name('usuarios.destroy')->middleware('auth');


Route::get('testftp', [UsuarioController::class, "testftp"])->name('testftp.index')->middleware('auth');
Route::post('testftp/store', [UsuarioController::class, "storeFtp"])->name('testftp.store')->middleware('auth');

Route::get('routes', function () {
    $routeCollection = Route::getRoutes();
    echo '<a href="/home"><h3>Ir a Inicio</h3></a>';
    echo "<table style='width:100%'>";
    echo "<tr>";
    echo "<td width='10%'><h4>HTTP Method</h4></td>";
    echo "<td width='10%'><h4>Route</h4></td>";
    echo "<td width='10%'><h4>Name</h4></td>";
    echo "<td width='70%'><h4>Corresponding Action</h4></td>";
    echo "</tr>";
    foreach ($routeCollection as $value) {
        echo "<tr>";
        echo "<td>" . $value->methods()[0] . "</td>";
        echo "<td>" . $value->uri() . "</td>";
        echo "<td>" . $value->getName() . "</td>";
        echo "<td>" . $value->getActionName() . "</td>";
        echo "</tr>";
    }
    echo "</table>";
    echo '<a href="/home">Ir a Inicio</a>';
})->middleware('auth');

//Route::post('addArchivos/{id}', [ObjetosDigitaleController::class, 'addArchivos'])->name('addArchivos');
