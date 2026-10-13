<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\PesertaController;
use App\Http\Controllers\SkemaController;
use App\Http\Controllers\User\ProfileController;

Route::view('/', 'welcome')->name('welcome');

Route::middleware(['auth'])->group(function () {

    // Dashboard dan CRUD khusus admin
    Route::middleware(['role:admin'])
        ->prefix('admin')
        ->name('admin.')
        ->group(function () {
            Route::get('/dashboard', [
                DashboardController::class,
                'index'
            ])->name('dashboard');

            Route::resource('peserta', PesertaController::class);

            Route::resource('skema', SkemaController::class);
        });

    // Dashboard dan profil khusus peserta
    Route::middleware(['role:user'])
        ->prefix('user')
        ->name('user.')
        ->group(function () {
            Route::get('/dashboard', [
                ProfileController::class,
                'dashboard'
            ])->name('dashboard');

            Route::get('/profil', [
                ProfileController::class,
                'edit'
            ])->name('profil.edit');

            Route::put('/profil', [
                ProfileController::class,
                'update'
            ])->name('profil.update');
        });
});

require __DIR__.'/auth.php';