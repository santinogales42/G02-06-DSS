
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
Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');
Route::get('/confirmar-cerrar-sesion', [LogoutController::class, 'confirmarCerrarSesion'])->name('confirmar.cerrar.sesion');



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


//Rutas para la Administración de Partidos
Route::get('/admin/partidos', [AdminPartidoController::class, 'index'])->name('admin.partidos.index');
Route::get('/admin/partidos/create', [AdminPartidoController::class, 'create'])->name('admin.partidos.create');
Route::post('/admin/partidos/store', [AdminPartidoController::class, 'store'])->name('admin.partidos.store');
Route::get('/admin/partidos/{id}/edit', [AdminPartidoController::class, 'edit'])->name('admin.partidos.edit');
Route::get('/admin/partidos/{equipo}/show', [AdminPartidoController::class, 'show'])->name('admin.partidos.show');
Route::put('/admin/partidos/{id}/update/', [AdminPartidoController::class, 'update'])->name('admin.partidos.update');
Route::delete('/admin/partidos/{id}/delete', [AdminPartidoController::class, 'delete'])->name('admin.partidos.delete');
Route::post('/admin/partidos/search', [AdminPartidoController::class, 'search'])->name('admin.partidos.search');

//Rutas para AdminUsuarios
Route::get('/admin/usuarios', [AdminUsuariosController::class, 'index'])->name('admin.usuarios.index');
Route::get('/admin/usuarios/create', [AdminUsuariosController::class, 'create'])->name('admin.usuarios.create');
Route::get('/admin/usuarios/{id}/edit', [AdminUsuariosController::class, 'edit'])->name('admin.usuarios.edit');
Route::delete('/admin/usuarios/{id}', [AdminUsuariosController::class, 'destroy'])->name('admin.usuarios.destroy');
Route::post('/admin/usuarios/store', [AdminUsuariosController::class, 'store'])->name('admin.usuarios.store');
Route::put('/admin/usuarios/{id}/update', [AdminUsuariosController::class, 'update'])->name('admin.usuarios.update');

// Rutas para EquipoController
Route::get('/clasificacion', [ClasificacionController::class, 'index'])->name('clasificacion');
Route::get('/equipos', [EquipoController::class, 'index'])->name('equipos.index');
Route::get('/equipos/{equipo}', [EquipoController::class, 'show'])->name('equipos.show');

// Rutas para AdminEquipoController
Route::get('/adminequipos', [AdminEquipoController::class, 'index'])->name('admin.equipos');
Route::post('/adminequipos/crear', [AdminEquipoController::class, 'crear'])->name('admin.equipos.crear');
Route::delete('/adminequipos/eliminar-todos', [AdminEquipoController::class, 'eliminarTodos'])->name('admin.equipos.eliminar-todos');
Route::get('/adminequipos/datos/{id}', [AdminEquipoController::class, 'getDatos'])->name('equipos.getDatos');
Route::delete('/adminequipos/eliminar/{id}', [AdminEquipoController::class, 'eliminar'])->name('admin.equipos.eliminar');
Route::post('/adminequipos/actualizar/{id}', [AdminEquipoController::class, 'actualizar'])->name('equipos.actualizar');
Route::post('/adminequipos/eliminar-masa', [AdminEquipoController::class, 'eliminarMasa'])->name('equipos.eliminarMasa');

// Rutas para administrar noticias
Route::get('/adminnoticias', [AdminNoticiasController::class, 'index'])->name('adminnoticias');
Route::post('/adminnoticias/crear', [AdminNoticiasController::class, 'crear'])->name('admin.noticias.crear');
Route::delete('/adminnoticias/eliminar-todas', [AdminNoticiasController::class, 'eliminarTodas'])->name('admin.noticias.eliminar-todas');
Route::get('/adminnoticias/datos/{id}', [AdminNoticiasController::class, 'getDatos'])->name('noticias.getDatos');
Route::delete('/adminnoticias/eliminar/{id}', [AdminNoticiasController::class, 'eliminar'])->name('admin.noticias.eliminar');
Route::post('/adminnoticias/actualizar/{id}', [AdminNoticiasController::class, 'actualizar'])->name('noticias.actualizar');
Route::get('/adminnoticias/equipo/{id}', [AdminNoticiasController::class, 'getEquipoName']);
Route::post('/adminnoticias/eliminar-masa', [AdminNoticiasController::class, 'eliminarMasa']);
Route::get('/noticias/{id}', [AdminNoticiasController::class, 'getDatos'])->name('jugadores.show');
Route::get('/noticias/equipo/{id}', [AdminNoticiasController::class, 'getEquipoName']);








// Rutas para EquipoController
Route::get('/clasificacion', [ClasificacionController::class, 'index'])->name('clasificacion');
Route::get('/equipos', [EquipoController::class, 'index'])->name('equipos.index');
Route::get('/equipos/{equipo}', [EquipoController::class, 'show'])->name('equipos.show');

// Rutas para AdminEquipoController
Route::get('/admin/equipos/create', [AdminEquipoController::class, 'create'])->name('admin.equipos.create');
Route::post('/admin/equipos', [AdminEquipoController::class, 'store'])->name('admin.equipos.store');
Route::get('/admin/equipos/{equipo}/edit', [AdminEquipoController::class, 'edit'])->name('admin.equipos.edit');
Route::put('/admin/equipos/{equipo}', [AdminEquipoController::class, 'update'])->name('admin.equipos.update');
Route::delete('/admin/equipos/{equipo}', [AdminEquipoController::class, 'destroy'])->name('admin.equipos.destroy');
Route::get('/admin/usuarios', [AdminUsuariosController::class, 'index'])->name('admin.usuarios.index');
Route::get('/admin/usuarios/create', [AdminUsuariosController::class, 'create'])->name('admin.usuarios.create');
Route::get('/admin/usuarios/{id}/edit', [AdminUsuariosController::class, 'edit'])->name('admin.usuarios.edit');
Route::delete('/admin/usuarios/{id}', [AdminUsuariosController::class, 'destroy'])->name('admin.usuarios.destroy');
Route::post('/admin/usuarios/store', [AdminUsuariosController::class, 'store'])->name('admin.usuarios.store');
Route::put('/admin/usuarios/{id}/update', [AdminUsuariosController::class, 'update'])->name('admin.usuarios.update');