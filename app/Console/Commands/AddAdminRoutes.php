<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class AddAdminRoutes extends Command
{
    protected $signature = 'add:admin-routes';
    protected $description = 'Ajoute les routes admin pour la validation formateur';

    public function handle(): int
    {
        $this->line('');
        $this->line('+==========================================================+');
        $this->line('|   🛣️  AJOUT DES ROUTES ADMIN                              |');
        $this->line('+==========================================================+');

        $path = base_path('routes/web.php');

        if (!File::exists($path)) {
            $this->error('[X] routes/web.php introuvable');
            return self::FAILURE;
        }

        File::copy($path, $path . '.bak.' . date('Y-m-d_His'));
        $this->line('[SAVE] Backup créé');

        $content = File::get($path);

        // Vérifier si déjà ajoutées
        if (str_contains($content, 'admin.demandes-formateurs')) {
            $this->warn('>>️  Routes déjà présentes');
            return self::SUCCESS;
        }

        // Les 3 routes à ajouter
        $routes = <<<'PHP'

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
PHP;

        // Ajouter à la fin du fichier
        $content .= "\n" . $routes;

        File::put($path, $content);
        $this->info('[OK] Routes ajoutées à routes/web.php');

        // Vider caches
        $this->call('route:clear');
        $this->call('optimize:clear');
        $this->info('[OK] Caches vidés');

        // Tester les routes
        $this->line('');
        $this->line('> Vérification');
        try {
            $hasRoutes = \Route::has('admin.demandes-formateurs.index');
            if ($hasRoutes) {
                $this->info('[OK] Route admin.demandes-formateurs.index existe');
            } else {
                $this->warn('[!]️  Route non détectée (relancez `php artisan route:clear`)');
            }
        } catch (\Throwable $e) {
            $this->warn('[!]️  Vérifiez avec `php artisan route:list | findstr demandes`');
        }

        $this->line('');
        $this->line('+==========================================================+');
        $this->line('|   [SUCCESS] TOUT EST PRÊT !                                      |');
        $this->line('+==========================================================+');
        $this->line('');
        $this->line('-> Testez :');
        $this->line('   1. http://localhost:8000/admin/demandes-formateurs');
        $this->line('   2. Vous verrez la liste des inscriptions en attente');

        return self::SUCCESS;
    }
}