
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController; // Importa el HomeController
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\JugadoresController;
use App\Http\Controllers\NoticiasController;
use App\Http\Controllers\CalendarioController;
use App\Http\Controllers\ClasificacionController;
use App\Http\Controllers\FavoritosController;
use App\Http\Controllers\JugadorController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminJugadoresController;


Route::get('/', [HomeController::class, 'index'])->name('home');





Route::get('/noticias', [NoticiasController::class, 'index'])->name('noticias');
Route::get('/calendario', [CalendarioController::class, 'index'])->name('calendario');
Route::get('/clasificacion', [ClasificacionController::class, 'index'])->name('clasificacion');
Route::get('/favoritos', [FavoritosController::class, 'index'])->name('favoritos');

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');



Route::get('/contacto', 'App\Http\Controllers\ContactController@show')->name('contacto');
Route::post('/contacto/enviar', 'App\Http\Controllers\ContactController@enviarMensaje')->name('enviarMensaje');
Route::get('/admin/mensajes', 'App\Http\Controllers\ContactController@verMensajes')->name('admin.mensajes');
Route::post('/limpiar-mensajes', 'App\Http\Controllers\ContactController@limpiarMensajes')->name('limpiarMensajes');
Route::get('/mostrar-mensajes', 'App\Http\Controllers\ContactController@verMensajes')->name('mostrarMensajes');


Route::get('/jugadores', [JugadoresController::class, 'index'])->name('jugadores');
Route::get('/jugadores/{id}', [JugadoresController::class, 'show'])->name('jugadores.show');
// Dentro de routes/web.php



Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');

// Ruta para manejar el envío del formulario (añadir jugador) sin restricción de autenticación
Route::post('/admin', [AdminController::class, 'store'])->name('admin.store');



Route::get('/adminjugadores', [AdminJugadoresController::class, 'index']);
Route::post('/adminjugadores/eliminar/{id}', [AdminJugadoresController::class, 'eliminar']);
Route::post('/adminjugadores/eliminar-masa', [AdminJugadoresController::class, 'eliminarMasa']);
Route::post('/adminjugadores/crear', [AdminJugadoresController::class, 'crear']);
Route::get('/adminjugadores/datos/{id}', [AdminJugadoresController::class, 'getDatos'])->name('jugadores.getDatos');
Route::post('/adminjugadores/actualizar/{id}', [AdminJugadoresController::class, 'actualizar'])->name('jugadores.actualizar');



Route::post('/adminjugadores/eliminar-todos', [AdminJugadoresController::class, 'eliminarTodos']);
Route::post('/admin/insertar-jugadores', [AdminJugadoresController::class, 'insertarJugadores']);

