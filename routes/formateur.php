<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Formateur\DashboardController;
use App\Http\Controllers\Formateur\DemandeAffectationController;
use App\Http\Controllers\Formateur\SessionController;
use App\Http\Controllers\Formateur\ProfileController;
use App\Http\Controllers\Formateur\DemandeSessionController;
use App\Http\Controllers\Formateur\NotificationController;
use App\Http\Controllers\Formateur\PdfFormateurController;

/*
|--------------------------------------------------------------------------
| Routes de l'espace formateur
|--------------------------------------------------------------------------
*/

Route::middleware(['auth:formateur', 'formateur'])
    ->prefix('formateur')
    ->name('formateur.')
    ->group(function () {

        // DASHBOARD
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        // DEMANDES D'AFFECTATIONS
        Route::prefix('demandes')->name('demandes.')->group(function () {
            Route::get('/', [DemandeAffectationController::class, 'index'])->name('index');
            Route::post('/', [DemandeAffectationController::class, 'store'])->name('store');
            Route::get('/{id}', [DemandeAffectationController::class, 'show'])->name('show');
        });

        // SESSIONS
        Route::prefix('sessions')->name('sessions.')->group(function () {
            Route::get('/', [SessionController::class, 'index'])->name('index');
            Route::get('/{id}', [SessionController::class, 'show'])->name('show');
        });


        // ============================================================
        // DEMANDES DE SESSIONS (formateur)
        // ============================================================
        Route::prefix('demandes-sessions')->name('demandes-sessions.')->group(function () {
            Route::get('/', [DemandeSessionController::class, 'index'])->name('index');
            Route::post('/', [DemandeSessionController::class, 'store'])->name('store');
        });
        // NOTIFICATIONS
        Route::prefix('notifications')->name('notifications.')->group(function () {
            Route::get('/', [NotificationController::class, 'index'])->name('index');
            Route::post('/{id}/read', [NotificationController::class, 'markAsRead'])->name('mark-read');
            Route::post('/read-all', [NotificationController::class, 'markAllAsRead'])->name('read-all');
            Route::delete('/{id}', [NotificationController::class, 'destroy'])->name('destroy');
        });

        // PROFIL
        Route::prefix('profile')->name('profile.')->group(function () {
            Route::get('/', [ProfileController::class, 'edit'])->name('edit');
            Route::put('/', [ProfileController::class, 'update'])->name('update');
            Route::put('/password', [ProfileController::class, 'updatePassword'])->name('password');
        });

        // PDF
        Route::prefix('pdf')->name('pdf.')->group(function () {
            Route::get('/ma-fiche', [PdfFormateurController::class, 'maFiche'])->name('ma-fiche');
            Route::get('/mes-affectations', [PdfFormateurController::class, 'mesAffectations'])->name('mes-affectations');
            Route::get('/mes-sessions', [PdfFormateurController::class, 'mesSessions'])->name('mes-sessions');
        });
    });