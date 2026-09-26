<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class InstallRapports extends Command
{
    protected $signature = 'install:rapports';
    protected $description = 'Installe le module Rapports + PDF';

    public function handle(): int
    {
        $this->info("Installation du module Rapports + PDF");
        $this->newLine();

        $files = $this->getFiles();
        $count = 0;

        foreach ($files as $path => $content) {
            $fullPath = base_path($path);
            $dir = dirname($fullPath);

            if (!File::exists($dir)) {
                File::makeDirectory($dir, 0755, true);
            }

            File::put($fullPath, $content);
            $size = strlen($content);
            $this->line("  OK  {$path} ({$size} car.)");
            $count++;
        }

        $this->newLine();
        $this->info("Nettoyage des caches...");
        $this->call('optimize:clear');

        $this->newLine();
        $this->info("SUCCES : {$count} fichier(s) installe(s) !");
        return self::SUCCESS;
    }

    protected function getFiles(): array
    {
        return [

            // =====================================================
            // RAPPORTS INDEX VIEW
            // =====================================================
            'resources/views/admin/rapports/index.blade.php' => <<<'BLADE'
@extends('layouts.admin')
@section('title', 'Rapports')

@section('content')

<div class="max-w-5xl mx-auto">

    <div class="flex items-center gap-4 mb-6">
        <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-brand-500 to-brand-700 flex items-center justify-center shadow-lg">
            <span class="material-symbols-rounded text-white text-3xl" style="font-variation-settings: 'FILL' 1;">description</span>
        </div>
        <div>
            <h1 class="font-display text-2xl font-bold text-slate-900">Rapports</h1>
            <p class="text-sm text-slate-500 mt-1">Générez vos rapports et listes au format PDF</p>
        </div>
    </div>

    @php
        $rapports = [
            [
                'icon'  => 'groups',
                'titre' => 'Liste des formateurs',
                'desc'  => 'Exporter la liste complète des formateurs du réseau',
                'route' => route('admin.pdf.formateurs'),
            ],
            [
                'icon'  => 'apartment',
                'titre' => 'Formateurs par établissement',
                'desc'  => 'Liste des formateurs regroupés par établissement',
                'route' => route('admin.pdf.formateurs.par-etablissement'),
            ],
            [
                'icon'  => 'school',
                'titre' => 'Formateurs par filière',
                'desc'  => 'Liste des formateurs regroupés par filière',
                'route' => route('admin.pdf.formateurs.par-filiere'),
            ],
            [
                'icon'  => 'assignment_ind',
                'titre' => 'Affectations',
                'desc'  => 'Liste complète des affectations des formateurs',
                'route' => route('admin.pdf.affectations'),
            ],
            [
                'icon'  => 'monitoring',
                'titre' => 'Statistiques globales',
                'desc'  => 'Tableau de bord chiffré et statistiques complètes',
                'route' => route('admin.pdf.statistiques'),
            ],
        ];
    @endphp

    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-4 mb-8">
        @foreach($rapports as $r)
            <a href="{{ $r['route'] }}" target="_blank"
               class="bg-white rounded-xl border-2 border-slate-300 p-5 flex flex-col gap-3
                      transition-all hover:border-brand-700 hover:shadow-lg group">
                <div class="w-12 h-12 rounded-lg bg-brand-50 flex items-center justify-center">
                    <span class="material-symbols-rounded text-brand-700 text-2xl">{{ $r['icon'] }}</span>
                </div>
                <div class="flex-1">
                    <div class="font-display font-bold text-slate-900">{{ $r['titre'] }}</div>
                    <p class="text-sm text-slate-500 mt-1 leading-relaxed">{{ $r['desc'] }}</p>
                </div>
                <div class="flex items-center gap-1 text-sm font-semibold text-brand-700">
                    Ouvrir le PDF
                    <span class="material-symbols-rounded text-lg group-hover:translate-x-1 transition">arrow_forward</span>
                </div>
            </a>
        @endforeach
    </div>

    <div class="space-y-6">

        <div class="bg-white rounded-xl border-2 border-slate-300">
            <div class="px-5 py-4 border-b-2 border-slate-200">
                <div class="font-display font-bold text-slate-900">Export personnalisé - Formateurs</div>
                <p class="text-sm text-slate-500 mt-0.5">Filtrez la liste avant de générer le PDF</p>
            </div>

            <form method="GET" action="{{ route('admin.pdf.formateurs') }}" target="_blank"
                  class="p-5 grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">Établissement</label>
                    <select name="etablissement_id" class="w-full px-3 py-2.5 text-sm border-2 border-slate-300 rounded-md focus:outline-none focus:border-brand-700">
                        <option value="">Tous les établissements</option>
                        @foreach($etablissements ?? [] as $e)
                            <option value="{{ $e->id }}">{{ $e->nom }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">Statut</label>
                    <select name="statut" class="w-full px-3 py-2.5 text-sm border-2 border-slate-300 rounded-md focus:outline-none focus:border-brand-700">
                        <option value="">Tous les statuts</option>
                        <option value="actif">Actif</option>
                        <option value="inactif">Inactif</option>
                        <option value="suspendu">Suspendu</option>
                    </select>
                </div>

                <div class="flex items-end">
                    <button type="submit" class="w-full btn-primary justify-center">
                        <span class="material-symbols-rounded text-lg">picture_as_pdf</span>
                        Générer le PDF
                    </button>
                </div>
            </form>
        </div>

        <div class="bg-white rounded-xl border-2 border-slate-300">
            <div class="px-5 py-4 border-b-2 border-slate-200">
                <div class="font-display font-bold text-slate-900">Export personnalisé - Affectations</div>
                <p class="text-sm text-slate-500 mt-0.5">Filtrez les affectations par statut, établissement ou période</p>
            </div>

            <form method="GET" action="{{ route('admin.pdf.affectations') }}" target="_blank"
                  class="p-5 grid grid-cols-1 md:grid-cols-4 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">Établissement</label>
                    <select name="etablissement_id" class="w-full px-3 py-2.5 text-sm border-2 border-slate-300 rounded-md focus:outline-none focus:border-brand-700">
                        <option value="">Tous</option>
                        @foreach($etablissements ?? [] as $e)
                            <option value="{{ $e->id }}">{{ $e->nom }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">Statut</label>
                    <select name="statut" class="w-full px-3 py-2.5 text-sm border-2 border-slate-300 rounded-md focus:outline-none focus:border-brand-700">
                        <option value="">Tous</option>
                        <option value="actif">Actif</option>
                        <option value="termine">Terminé</option>
                        <option value="suspendu">Suspendu</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">Date début (≥)</label>
                    <input type="date" name="date_debut" class="w-full px-3 py-2.5 text-sm border-2 border-slate-300 rounded-md focus:outline-none focus:border-brand-700">
                </div>

                <div class="flex items-end">
                    <button type="submit" class="w-full btn-primary justify-center">
                        <span class="material-symbols-rounded text-lg">picture_as_pdf</span>
                        Générer
                    </button>
                </div>
            </form>
        </div>

    </div>

</div>

@endsection
BLADE,

            // =====================================================
            // ROUTES (mise à jour)
            // =====================================================
            'routes/admin.php' => <<<'PHP'
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\FormateurController;
use App\Http\Controllers\Admin\EtablissementController;
use App\Http\Controllers\Admin\FiliereController;
use App\Http\Controllers\Admin\AffectationController;
use App\Http\Controllers\Admin\SessionController;
use App\Http\Controllers\Admin\NotificationController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\PdfController;

Route::middleware(['auth:admin', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        Route::resource('formateurs', FormateurController::class);
        Route::resource('etablissements', EtablissementController::class);
        Route::resource('filieres', FiliereController::class);
        Route::resource('affectations', AffectationController::class);

        Route::get('/sessions', [SessionController::class, 'index'])->name('sessions.index');
        Route::get('/sessions/{id}', [SessionController::class, 'show'])->name('sessions.show');

        Route::prefix('notifications')->name('notifications.')->group(function () {
            Route::get('/', [NotificationController::class, 'index'])->name('index');
            Route::post('/{id}/read', [NotificationController::class, 'markAsRead'])->name('mark-read');
            Route::post('/read-all', [NotificationController::class, 'markAllAsRead'])->name('read-all');
            Route::delete('/{id}', [NotificationController::class, 'destroy'])->name('destroy');
            Route::delete('/destroy-all', [NotificationController::class, 'destroyAll'])->name('destroy-all');
        });

        Route::resource('users', UserController::class);

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
PHP,
        ];
    }
}