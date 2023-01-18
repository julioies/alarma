<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HorariosController;
use App\Http\Controllers\CancionesController;
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

Route::get('/prueba', [HorariosController::class, 'prueba'])->name('prueba');

Route::get('/horario', [HorariosController::class, 'mostrar'])->name('horario');
Route::post('/nuevaFila', [HorariosController::class, 'nuevaFila'])->name('nuevaFila');
Route::delete('/borrar/{id}', [HorariosController::class, 'borrar'])->name('borrar');
Route::patch('/actualizar/{id}', [HorariosController::class, 'actualizar'])->name('actualizar');

Route::post('/subirCancion',[CancionesController::class, 'subirCancion'])->name('subirCancion');
Route::post('/elegirCancion',[CancionesController::class, 'elegirCancion'])->name('elegirCancion');

Route::get('/borrarCanciones', [CancionesController::class, 'borrarCanciones'])->name('borrarCanciones');
Route::delete('/eliminarCancion/{id}', [CancionesController::class, 'eliminarCancion'])->name('eliminarCancion');




// Route::view('/insertar','insertar');
// Route::get('/', function () {
//     return view('welcome');
// });
