
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController; // Importa el HomeController
use App\Http\Controllers\JugadoresController;
use App\Http\Controllers\NoticiasController;
use App\Http\Controllers\CalendarioController;
use App\Http\Controllers\ClasificacionController;
use App\Http\Controllers\FavoritosController;
use App\Http\Controllers\JugadorController;
use App\Http\Controllers\AdminController;

Route::get('/', [HomeController::class, 'index'])->name('home');



Route::get('/noticias', [NoticiasController::class, 'index'])->name('noticias');
Route::get('/calendario/{jornada?}', [CalendarioController::class, 'index'])->name('calendario');
Route::get('/clasificacion', [ClasificacionController::class, 'index'])->name('clasificacion');
Route::get('/favoritos', [FavoritosController::class, 'index'])->name('favoritos');


Route::get('/contacto', 'App\Http\Controllers\ContactController@show')->name('contacto');
Route::post('/contacto/enviar', 'App\Http\Controllers\ContactController@enviarMensaje')->name('enviarMensaje');
Route::get('/admin/mensajes', 'App\Http\Controllers\ContactController@verMensajes')->name('admin.mensajes');
Route::post('/limpiar-mensajes', 'App\Http\Controllers\ContactController@limpiarMensajes')->name('limpiarMensajes');
Route::get('/mostrar-mensajes', 'App\Http\Controllers\ContactController@verMensajes')->name('mostrarMensajes');


Route::get('/jugadores', [JugadoresController::class, 'index']);
Route::get('/jugadores/{id}', [JugadoresController::class, 'show'])->name('jugadores.show');
// Dentro de routes/web.php



Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');

// Ruta para manejar el envío del formulario (añadir jugador) sin restricción de autenticación
Route::post('/admin', [AdminController::class, 'store'])->name('admin.store');



/*
 * Rutas para Usuarios
 */
Route::get('/admin/usuarios', [UsuarioController::class, 'index'])->name('usuarios.index');
Route::post('/admin/usuarios', [UsuarioController::class, 'store'])->name('usuarios.store');

/*
 * Rutas para Ligas
 */
Route::get('/admin/ligas', [LigaController::class, 'index'])->name('ligas.index');
Route::post('/admin/ligas', [LigaController::class, 'store'])->name('ligas.store');

/*
 * Rutas para Equipos
 */
Route::get('/admin/equipos', [EquipoController::class, 'index'])->name('equipos.index');
Route::post('/admin/equipos', [EquipoController::class, 'store'])->name('equipos.store');

/*
 * Rutas para Jugadores
 */
Route::get('/admin/jugadores', [JugadorController::class, 'index'])->name('jugadores.index');
Route::post('/admin/jugadores', [JugadorController::class, 'store'])->name('jugadores.store');

// Añade más rutas para las otras entidades de forma similar

