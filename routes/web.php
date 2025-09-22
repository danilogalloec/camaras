<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AuthAdminController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\VisitaController;
use App\Http\Controllers\Admin\CotizacionController;

/*
|--------------------------------------------------------------------------
| Rutas Web
|--------------------------------------------------------------------------
*/

// === LOGIN CLIENTE ===
Route::get('/', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// === LOGIN ADMIN ===
Route::get('/admin/login', [AuthAdminController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AuthAdminController::class, 'login'])->name('admin.login.post');
Route::post('/admin/logout', [AuthAdminController::class, 'logout'])->name('admin.logout');

// === PERFIL CLIENTE (protegido con middleware cliente) ===
Route::middleware('cliente')->group(function () {
    Route::get('/cliente/dashboard', [ClienteController::class, 'dashboard'])->name('cliente.dashboard');
    Route::get('/cliente/visitas', [ClienteController::class, 'visitas'])->name('cliente.visitas');
    Route::get('/cliente/agendar-visita', [ClienteController::class, 'agendarVisita'])->name('cliente.agendar_visita');
    Route::post('/cliente/agendar-visita', [ClienteController::class, 'storeVisita'])->name('cliente.agendar_visita.store');
});

// === ADMIN ===
Route::prefix('admin')->middleware('admin')->group(function () {

    // ====== Dashboard ======
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    // ====== CLIENTES ======
    Route::get('/clientes', [AdminController::class, 'clientes'])->name('admin.clientes');
    Route::get('/clientes/nuevo', [AdminController::class, 'nuevoCliente'])->name('admin.clientes.nuevo');
    Route::post('/clientes', [AdminController::class, 'crearCliente'])->name('admin.clientes.store');
    Route::get('/clientes/{cliente}', [AdminController::class, 'showCliente'])->name('admin.clientes.show');
    Route::get('/clientes/{cliente}/editar', [AdminController::class, 'editarCliente'])->name('admin.clientes.editar');
    Route::put('/clientes/{cliente}', [AdminController::class, 'actualizarCliente'])->name('admin.clientes.actualizar');
    Route::delete('/clientes/{cliente}', [AdminController::class, 'eliminarCliente'])->name('admin.clientes.eliminar');

    // --- Equipos por cliente ---
    Route::get('/clientes/{cliente}/equipos/crear', [AdminController::class, 'crearEquipo'])
        ->name('admin.clientes.equipos.create');
    Route::post('/clientes/{cliente}/equipos', [AdminController::class, 'guardarEquipo'])
        ->name('admin.clientes.equipos.store');

    // ====== VISITAS ======
    Route::get('/visitas', [VisitaController::class, 'index'])->name('admin.visitas');
    Route::post('/visitas/{id}/atender', [VisitaController::class, 'atender'])->name('admin.visitas.atender');

    // ====== COTIZACIONES ======
    Route::get('/cotizaciones', [CotizacionController::class, 'index'])->name('admin.cotizaciones.index');
    Route::get('/cotizaciones/nueva', [CotizacionController::class, 'create'])->name('admin.cotizaciones.create');
    Route::post('/cotizaciones', [CotizacionController::class, 'store'])->name('admin.cotizaciones.store');
    Route::get('/cotizaciones/{cotizacion}', [CotizacionController::class, 'show'])->name('admin.cotizaciones.show');
    Route::get('/cotizaciones/{cotizacion}/editar', [CotizacionController::class, 'edit'])->name('admin.cotizaciones.edit');
    Route::put('/cotizaciones/{cotizacion}', [CotizacionController::class, 'update'])->name('admin.cotizaciones.update');
    Route::delete('/cotizaciones/{cotizacion}', [CotizacionController::class, 'destroy'])->name('admin.cotizaciones.destroy');
    Route::post('/cotizaciones/{cotizacion}/aprobar', [CotizacionController::class, 'aprobar'])->name('admin.cotizaciones.aprobar');
    Route::get('/cotizaciones/{cotizacion}/pdf', [CotizacionController::class, 'exportPdf'])->name('admin.cotizaciones.pdf');
});
