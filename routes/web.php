
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
use App\Http\Controllers\AdminUsuariosController;
use App\Http\Controllers\AdminPartidoController;
use App\Http\Controllers\AdminNoticiasController;
use App\Http\Controllers\EquipoController;
use App\Http\Controllers\AdminEquipoController;
use App\Http\Controllers\LogoutController;

Route::get('/', [HomeController::class, 'index'])->name('home');


Route::get('/noticias', [NoticiasController::class, 'index'])->name('noticias');
Route::get('/calendario/{jornada?}', [CalendarioController::class, 'index'])->name('calendario.index');
Route::get('/calendario/{equipo}/show', [CalendarioController::class, 'show'])->name('calendario.show');
Route::get('/partidos/{id}', [CalendarioController::class, 'showEstadisticas'])->name('partidos');
Route::get('/clasificacion', [ClasificacionController::class, 'index'])->name('clasificacion');
Route::get('/favoritos', [FavoritosController::class, 'index'])->name('favoritos');

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::get('/confirmar-cerrar-sesion', [LogoutController::class, 'confirmarCerrarSesion'])->name('confirmar.cerrar.sesion');
Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');




Route::get('/contacto', 'App\Http\Controllers\ContactController@show')->name('contacto');
Route::post('/contacto/enviar', 'App\Http\Controllers\ContactController@enviarMensaje')->name('enviarMensaje');
Route::get('/admin/mensajes', 'App\Http\Controllers\ContactController@verMensajes')->name('admin.mensajes');
Route::post('/limpiar-mensajes', 'App\Http\Controllers\ContactController@limpiarMensajes')->name('limpiarMensajes');
Route::get('/mostrar-mensajes', 'App\Http\Controllers\ContactController@verMensajes')->name('mostrarMensajes');


Route::get('/jugadores', [JugadoresController::class, 'index'])->name('jugadores');
Route::get('/jugadores/{id}', [JugadoresController::class, 'show'])->name('jugadores.show');
// Dentro de routes/web.php



Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
    Route::post('/admin', [AdminController::class, 'store'])->name('admin.store');

    // Administración de jugadores
    Route::prefix('/adminjugadores')->group(function () {
        Route::get('/', [AdminJugadoresController::class, 'index'])->name('admin.adminjugador');
        Route::post('/eliminar/{id}', [AdminJugadoresController::class, 'eliminar']);
        Route::post('/crear', [AdminJugadoresController::class, 'crear']);
        Route::get('/datos/{id}', [AdminJugadoresController::class, 'getDatos'])->name('jugadores.getDatos');
        Route::post('/actualizar/{id}', [AdminJugadoresController::class, 'actualizar'])->name('jugadores.actualizar');
    });

    // Administración de partidos
    Route::prefix('/admin/partidos')->group(function () {
        Route::get('/', [AdminPartidoController::class, 'index'])->name('admin.partidos.index');
        Route::get('/create', [AdminPartidoController::class, 'create'])->name('admin.partidos.create');
        Route::post('/store', [AdminPartidoController::class, 'store'])->name('admin.partidos.store');
        Route::get('/{id}/edit', [AdminPartidoController::class, 'edit'])->name('admin.partidos.edit');
        Route::put('/{id}/update', [AdminPartidoController::class, 'update'])->name('admin.partidos.update');
        Route::delete('/{id}/delete', [AdminPartidoController::class, 'delete'])->name('admin.partidos.delete');
    });

    // Administración de usuarios
    Route::prefix('/admin/usuarios')->group(function () {
        Route::get('/', [AdminUsuariosController::class, 'index'])->name('admin.usuarios.index');
        Route::get('/create', [AdminUsuariosController::class, 'create'])->name('admin.usuarios.create');
        Route::post('/store', [AdminUsuariosController::class, 'store'])->name('admin.usuarios.store');
        Route::get('/{id}/edit', [AdminUsuariosController::class, 'edit'])->name('admin.usuarios.edit');
        Route::put('/{id}/update', [AdminUsuariosController::class, 'update'])->name('admin.usuarios.update');
        Route::delete('/{id}', [AdminUsuariosController::class, 'destroy'])->name('admin.usuarios.destroy');
    });

    // Administración de noticias
    Route::prefix('/adminnoticias')->group(function () {
        Route::get('/', [AdminNoticiasController::class, 'index'])->name('admin.noticias.index');
        Route::post('/crear', [AdminNoticiasController::class, 'crear'])->name('admin.noticias.crear');
        Route::get('/datos/{id}', [AdminNoticiasController::class, 'getDatos'])->name('noticias.getDatos');
        Route::delete('/eliminar/{id}', [AdminNoticiasController::class, 'eliminar'])->name('admin.noticias.eliminar');
        Route::post('/actualizar/{id}', [AdminNoticiasController::class, 'actualizar'])->name('noticias.actualizar');
    });

    // Administración de equipos
    Route::prefix('/adminequipos')->group(function () {
        Route::get('/', [AdminEquipoController::class, 'index'])->name('admin.equipos.index');
        Route::post('/crear', [AdminEquipoController::class, 'crear'])->name('admin.equipos.crear');
        Route::get('/datos/{id}', [AdminEquipoController::class, 'getDatos'])->name('equipos.getDatos');
        Route::delete('/eliminar/{id}', [AdminEquipoController::class, 'eliminar'])->name('admin.equipos.eliminar');
        Route::post('/actualizar/{id}', [AdminEquipoController::class, 'actualizar'])->name('equipos.actualizar');
    });
});
// Rutas para EquipoController
Route::get('/clasificacion', [ClasificacionController::class, 'index'])->name('clasificacion');
Route::get('/equipos', [EquipoController::class, 'index'])->name('equipos.index');
Route::get('/equipos/{equipo}', [EquipoController::class, 'show'])->name('equipos.show');
Route::post('/equipos/{equipo}/favorito', [EquipoController::class, 'agregarFavorito'])->name('equipos.agregarFavorito');
Route::delete('/equipos/{equipo}/favorito', [EquipoController::class, 'eliminarFavorito'])->name('equipos.eliminarFavorito');




Route::get('/favoritos', [FavoritosController::class, 'index'])->name('favoritos.index');
Route::get('/favoritos/{nombreEquipo}/edit', [FavoritosController::class, 'editar'])->name('favoritos.edit');
Route::delete('/favoritos/{nombreEquipo}', [FavoritosController::class, 'delete'])->name('favoritos.delete');
