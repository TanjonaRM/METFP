<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CheckApprovalFlow extends Command
{
    protected $signature = 'check:approval-flow';
    protected $description = 'Vérifie le flux d\'approbation admin';

    public function handle(): int
    {
        $this->line('');
        $this->line('+==========================================================+');
        $this->line('|   [SEARCH] VÉRIFICATION DU FLUX D\'APPROBATION                  |');
        $this->line('+==========================================================+');

        // ===============================================
        // 1. Routes admin
        // ===============================================
        $this->line('');
        $this->line('> 1. Routes admin demandes-formateurs');

        $routes = [
            'admin.demandes-formateurs.index',
            'admin.demandes-formateurs.approuver',
            'admin.demandes-formateurs.refuser',
            'admin.demandes-formateurs.edit',
            'admin.demandes-formateurs.update',
        ];

        foreach ($routes as $r) {
            if (Route::has($r)) {
                $route = Route::getRoutes()->getByName($r);
                $this->info("   [OK] {$r} -> {$route->uri()}");
            } else {
                $this->error("   [X] {$r} MANQUANTE");
            }
        }

        // ===============================================
        // 2. Controller admin
        // ===============================================
        $this->line('');
        $this->line('> 2. Controller DemandeFormateurController');

        $ctrlPath = app_path('Http/Controllers/Admin/DemandeFormateurController.php');

        if (!File::exists($ctrlPath)) {
            $this->error('   [X] Controller introuvable');
        } else {
            $content = File::get($ctrlPath);
            $this->info('   [OK] Controller existe (' . File::size($ctrlPath) . ' octets)');

            // Vérifier les méthodes
            $methods = ['index', 'approuver', 'refuser', 'edit', 'update'];
            foreach ($methods as $m) {
                if (preg_match("/public function {$m}\s*\(/", $content)) {
                    $this->info("   [OK] {$m}()");
                } else {
                    $this->warn("   [!]️  {$m}() manquante");
                }
            }
        }

        // ===============================================
        // 3. Vue admin
        // ===============================================
        $this->line('');
        $this->line('> 3. Vue admin demandes-formateurs');

        $views = [
            'admin/demandes-formateurs/index.blade.php',
            'admin/demandes-formateurs/edit.blade.php',
        ];

        foreach ($views as $v) {
            $p = resource_path('views/' . $v);
            if (File::exists($p)) {
                $this->info("   [OK] {$v} (" . File::size($p) . " octets)");
            } else {
                $this->error("   [X] {$v} MANQUANTE");
            }
        }

        // ===============================================
        // 4. Lien dans la sidebar admin
        // ===============================================
        $this->line('');
        $this->line('> 4. Lien dans la sidebar admin');

        $layoutPath = resource_path('views/layouts/admin.blade.php');
        if (File::exists($layoutPath)) {
            $layout = File::get($layoutPath);

            if (str_contains($layout, 'demandes-formateurs')) {
                $this->info('   [OK] Lien présent dans la sidebar');
            } else {
                $this->warn('   [!]️  PAS de lien dans la sidebar');
                $this->line('   -> Ajoutez :');
                $this->line('      <a href="{{ route(\'admin.demandes-formateurs.index\') }}">Demandes formateurs</a>');
            }
        }

        // ===============================================
        // 5. Statut par défaut à l'inscription
        // ===============================================
        $this->line('');
        $this->line('> 5. Statut par défaut à l\'inscription');

        $registerPath = app_path('Http/Controllers/Auth/Formateur/RegisterController.php');
        if (File::exists($registerPath)) {
            $content = File::get($registerPath);

            if (str_contains($content, "'en_attente'") || str_contains($content, '"en_attente"')) {
                $this->info('   [OK] Inscription crée avec statut "en_attente"');
            } else {
                $this->error('   [X] L\'inscription ne met PAS "en_attente"');
                $this->line('   -> Le formateur peut se connecter DIRECTEMENT');
            }
        }

        // ===============================================
        // 6. Middleware vérifie statut
        // ===============================================
        $this->line('');
        $this->line('> 6. Middleware vérifie le statut');

        $mwPath = app_path('Http/Middleware/FormateurMiddleware.php');
        if (File::exists($mwPath)) {
            $content = File::get($mwPath);

            if (str_contains($content, 'statut') && str_contains($content, 'actif')) {
                $this->info('   [OK] Middleware vérifie statut');
            } else {
                $this->error('   [X] Middleware NE vérifie PAS le statut');
            }
        }

        // ===============================================
        // 7. Login vérifie statut
        // ===============================================
        $this->line('');
        $this->line('> 7. LoginController vérifie le statut');

        $loginPath = app_path('Http/Controllers/Auth/Formateur/LoginController.php');
        if (File::exists($loginPath)) {
            $content = File::get($loginPath);

            if (str_contains($content, "statut !== 'actif'") || str_contains($content, 'en_attente')) {
                $this->info('   [OK] Login vérifie statut');
            } else {
                $this->warn('   [!]️  Login ne vérifie PAS le statut');
            }
        }

        // ===============================================
        // 8. Comptes en attente
        // ===============================================
        $this->line('');
        $this->line('> 8. Comptes formateurs par statut');

        try {
            $stats = DB::table('formateurs_users')
                ->select('statut', DB::raw('count(*) as nb'))
                ->groupBy('statut')
                ->get();

            foreach ($stats as $s) {
                $marker = $s->statut === 'en_attente' ? '⏳' : '[OK]';
                $this->line("   {$marker} {$s->statut} : {$s->nb}");
            }

            $enAttente = DB::table('formateurs_users')->where('statut', 'en_attente')->count();
            if ($enAttente > 0) {
                $this->line('');
                $this->warn("   [!]️  {$enAttente} formateur(s) en attente d'approbation");
                $this->line("   -> Allez sur : " . url('/admin/demandes-formateurs'));
            }
        } catch (\Throwable $e) {
            $this->error('   [X] Erreur : ' . $e->getMessage());
        }

        // ===============================================
        // RÉSUMÉ
        // ===============================================
        $this->line('');
        $this->line('+==========================================================+');
        $this->line('|   [STATS] RÉSUMÉ                                               |');
        $this->line('+==========================================================+');
        $this->line('');
        $this->line('-> Testez le flux :');
        $this->line('   1. URL admin : ' . url('/admin/demandes-formateurs'));
        $this->line('   2. Créez un formateur (formulaire inscription)');
        $this->line('   3. Il doit apparaître dans la liste admin');
        $this->line('   4. Cliquez Approuver -> il peut se connecter');
        $this->line('   5. Sans approbation -> il ne peut PAS se connecter');

        return self::SUCCESS;
    }
}