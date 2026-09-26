<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

// ===============================================================
// [LIST] VALIDATION DES INSCRIPTIONS FORMATEURS (ADMIN)
// ===============================================================
Route::middleware(['auth:admin', 'admin'])->prefix('admin')->group(function () {
    Route::get('/demandes-formateurs',
        [\App\Http\Controllers\Admin\DemandeFormateurController::class, 'index'])
        ->name('admin.demandes-formateurs.index');

    Route::post('/demandes-formateurs/{id}/approuver',
        [\App\Http\Controllers\Admin\DemandeFormateurController::class, 'approuver'])
        ->name('admin.demandes-formateurs.approuver');

    Route::post('/demandes-formateurs/{id}/refuser',
        [\App\Http\Controllers\Admin\DemandeFormateurController::class, 'refuser'])
        ->name('admin.demandes-formateurs.refuser');
});