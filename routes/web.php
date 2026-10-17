<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

use App\Http\Controllers\EquipoController;
use App\Http\Controllers\JugadorController;
use App\Http\Controllers\PartidoController;
use App\Http\Controllers\DashboardController;

// Página principal después de iniciar sesión
Route::get('/', [DashboardController::class, 'index'])
    ->middleware('auth')
    ->name('home');

// Ruta dashboard que necesita el registro y el inicio de sesión
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware('auth')
    ->name('dashboard');

// Módulos protegidos
Route::middleware('auth')->group(function () {
    Route::resource('equipos', EquipoController::class);
    Route::resource('jugadores', JugadorController::class);
    Route::resource('partidos', PartidoController::class);

    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')
        ->name('settings.profile');

    Volt::route('settings/password', 'settings.password')
        ->name('settings.password');

    Volt::route('settings/appearance', 'settings.appearance')
        ->name('settings.appearance');
});

require __DIR__.'/auth.php';
