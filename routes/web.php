<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\NotaController;

Route::get('/', fn() => redirect('/notas'));

Route::middleware('guest')->group(function () {
    Route::get('/login',     [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login',    [AuthController::class, 'login']);
    Route::get('/registro',  [AuthController::class, 'showRegistro']);
    Route::post('/registro', [AuthController::class, 'registro']);
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/notas', [NotaController::class, 'index'])->name('notas.index');

Route::middleware('auth')->group(function () {
    Route::get('/notas/create',       [NotaController::class, 'create'])->name('notas.create');
    Route::post('/notas',             [NotaController::class, 'store'])->name('notas.store');
    Route::get('/notas/{nota}',       [NotaController::class, 'show'])->name('notas.show');
    Route::get('/notas/{nota}/edit',  [NotaController::class, 'edit'])->name('notas.edit');
    Route::put('/notas/{nota}',       [NotaController::class, 'update'])->name('notas.update');
    Route::delete('/notas/{nota}',    [NotaController::class, 'destroy'])->name('notas.destroy');
});
