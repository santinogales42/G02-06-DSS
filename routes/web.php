
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController; // Importa el HomeController
use App\Http\Controllers\JugadoresController;
use App\Http\Controllers\NoticiasController;
use App\Http\Controllers\CalendarioController;
use App\Http\Controllers\ClasificacionController;
use App\Http\Controllers\FavoritosController;


Route::get('/', [HomeController::class, 'index']);


Route::get('/jugadores', [JugadoresController::class, 'index'])->name('jugadores');
Route::get('/noticias', [NoticiasController::class, 'index'])->name('noticias');
Route::get('/calendario', [CalendarioController::class, 'index'])->name('calendario');
Route::get('/clasificacion', [ClasificacionController::class, 'index'])->name('clasificacion');
Route::get('/favoritos', [FavoritosController::class, 'index'])->name('favoritos');
Route::get('/contacto', 'App\Http\Controllers\ContactController@show')->name('contacto');
Route::post('/contacto/enviar', 'App\Http\Controllers\ContactController@enviarMensaje')->name('enviarMensaje');
Route::get('/admin/mensajes', 'App\Http\Controllers\ContactController@verMensajes')->name('admin.mensajes');
Route::post('/limpiar-mensajes', 'App\Http\Controllers\ContactController@limpiarMensajes')->name('limpiarMensajes');
Route::get('/mostrar-mensajes', 'App\Http\Controllers\ContactController@verMensajes')->name('mostrarMensajes');
