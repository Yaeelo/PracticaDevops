<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('INICIO');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::post('/denuncias/panico', [App\Http\Controllers\DenunciaController::class, 'panico'])->name('denuncias.panico');


use App\Http\Controllers\DenunciaController;

Route::middleware(['auth'])->group(function () {
    Route::get('/denuncias/crear', [DenunciaController::class, 'create'])->name('denuncias.create');
    Route::post('/denuncias', [DenunciaController::class, 'store'])->name('denuncias.store');
});

Route::post('/denuncia/panico', [DenunciaController::class, 'panic'])->name('denuncia.panic');
Route::get('/denuncias', [DenunciaController::class, 'index'])->name('denuncias.index');



require __DIR__.'/auth.php';
