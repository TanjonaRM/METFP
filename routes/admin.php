<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\FormateurController;
use App\Http\Controllers\Admin\EtablissementController;
use App\Http\Controllers\Admin\FiliereController;
use App\Http\Controllers\Admin\AffectationController;
use App\Http\Controllers\Admin\SessionController;
use App\Http\Controllers\Admin\NotificationController;
use App\Http\Controllers\Admin\DemandeAffectationAdminController;
use App\Http\Controllers\Admin\DemandeSessionAdminController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\PdfController;

Route::middleware(['auth:admin', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        // ============================================================
        // DASHBOARD
        // ============================================================
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        // [AJAX] Endpoint AJAX pour le rafraîchissement temps réel
        Route::get('/dashboard/data', [DashboardController::class, 'data'])->name('dashboard.data');

        // ============================================================
        // RESSOURCES
        // ============================================================
        Route::resource('formateurs', FormateurController::class);
        Route::resource('etablissements', EtablissementController::class);
        Route::resource('filieres', FiliereController::class);
        Route::resource('affectations', AffectationController::class);

        Route::get('/sessions', [SessionController::class, 'index'])->name('sessions.index');
        Route::get('/sessions/{id}', [SessionController::class, 'show'])->name('sessions.show');

        // ============================================================
        // NOTIFICATIONS
        // ============================================================
        Route::prefix('notifications')->name('notifications.')->group(function () {
            Route::get('/recent', [NotificationController::class, 'recent'])->name('recent');
            Route::get('/count', [NotificationController::class, 'count'])->name('count');
            Route::get('/{id}/show', [NotificationController::class, 'show'])->where('id', '[0-9]+')->name('show');

            Route::get('/count', [NotificationController::class, 'count'])->name('count');
            Route::get('/{id}/show', [NotificationController::class, 'show'])->where('id', '[0-9]+')->name('show');
                                    Route::post('/{id}/read', [NotificationController::class, 'markAsRead'])->name('mark-read');
            Route::post('/read-all', [NotificationController::class, 'markAllAsRead'])->name('read-all');
            Route::delete('/{id}', [NotificationController::class, 'destroy'])->name('destroy');
            Route::delete('/destroy-all', [NotificationController::class, 'destroyAll'])->name('destroy-all');
        });


        // ============================================================
        // DEMANDES D'AFFECTATIONS
        // ============================================================
        Route::prefix('demandes-affectations')->name('demandes-affectations.')->group(function () {
            Route::get('/', [DemandeAffectationAdminController::class, 'index'])->name('index');
            Route::post('/{id}/approuver', [DemandeAffectationAdminController::class, 'approuver'])->name('approuver');
            Route::post('/{id}/refuser', [DemandeAffectationAdminController::class, 'refuser'])->name('refuser');
        });

        // ============================================================
        // DEMANDES DE SESSIONS
        // ============================================================
        Route::prefix('demandes-sessions')->name('demandes-sessions.')->group(function () {
            Route::get('/', [DemandeSessionAdminController::class, 'index'])->name('index');
            Route::post('/{id}/approuver', [DemandeSessionAdminController::class, 'approuver'])->name('approuver');
            Route::post('/{id}/refuser', [DemandeSessionAdminController::class, 'refuser'])->name('refuser');
        });
        Route::resource('users', UserController::class);

        // ============================================================
        // PDF
        // ============================================================
        Route::prefix('pdf')->name('pdf.')->group(function () {
            Route::get('/', [PdfController::class, 'index'])->name('index');
            Route::get('/formateurs', [PdfController::class, 'formateurs'])->name('formateurs');
            Route::get('/formateurs/par-etablissement', [PdfController::class, 'formateursParEtablissement'])->name('formateurs.par-etablissement');
            Route::get('/formateurs/par-filiere', [PdfController::class, 'formateursParFiliere'])->name('formateurs.par-filiere');
            Route::get('/formateurs/{id}', [PdfController::class, 'formateur'])->where('id', '[0-9]+')->name('formateur');
            Route::get('/affectations', [PdfController::class, 'affectations'])->name('affectations');
            Route::get('/statistiques', [PdfController::class, 'statistiques'])->name('statistiques');
        });

        Route::get('/search', [DashboardController::class, 'search'])->name('search');
        Route::get('/formateurs-by-etablissement', [DashboardController::class, 'formateursByEtablissement'])->name('formateurs.by.etablissement');
    });