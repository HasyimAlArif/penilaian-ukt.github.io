<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('users', \App\Http\Controllers\UserController::class);
    Route::resource('soal', \App\Http\Controllers\SoalController::class);
    Route::resource('penilaian', \App\Http\Controllers\PenilaianController::class);
    Route::get('penilaian/{penilaian}/export-excel', [\App\Http\Controllers\PenilaianController::class, 'export_excel'])->name('penilaian.export_excel');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
