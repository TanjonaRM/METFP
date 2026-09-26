<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;

class InspectFormateursPage extends Command
{
    protected $signature = 'inspect:formateurs-page';
    protected $description = 'Inspection complète de la page /admin/formateurs';

    public function handle(): int
    {
        $this->line('');
        $this->line('+==============================================================+');
        $this->line('|   [SEARCH] INSPECTION PAGE /admin/formateurs                       |');
        $this->line('+==============================================================+');

        $this->inspectRoutes();
        $this->inspectController();
        $this->inspectViews();
        $this->inspectPartials();
        $this->inspectJS();
        $this->inspectRequest();
        $this->finalSummary();

        return self::SUCCESS;
    }

    // ===============================================================
    // 1. ROUTES
    // ===============================================================
    private function inspectRoutes(): void
    {
        $this->line('');
        $this->line('> 1. ROUTES');
        $this->line(str_repeat('-', 62));

        $routes = collect(Route::getRoutes())->filter(function ($r) {
            return str_contains($r->uri(), 'formateurs');
        });

        foreach ($routes->sortBy('uri') as $route) {
            $methods = implode('|', array_diff($route->methods(), ['HEAD']));
            $this->line(sprintf(
                "   %-10s %-45s",
                $methods,
                $route->uri()
            ));
            $this->line(sprintf(
                "   %-10s -> %s",
                '',
                $route->getActionName()
            ));

            // Middlewares
            $mw = $route->gatherMiddleware();
            $this->line('              Middlewares : ' . implode(', ', $mw));
            $this->line('');
        }
    }

    // ===============================================================
    // 2. CONTROLLER
    // ===============================================================
    private function inspectController(): void
    {
        $this->line('');
        $this->line('> 2. CONTROLLER FormateurController');
        $this->line(str_repeat('-', 62));

        $path = app_path('Http/Controllers/Admin/FormateurController.php');

        if (!File::exists($path)) {
            $this->error("   [X] Fichier introuvable : {$path}");
            return;
        }

        $this->info('   [OK] ' . $path);
        $this->line('   [BOX] Taille : ' . File::size($path) . ' octets');
        $this->line('');

        $content = File::get($path);

        // Lister les méthodes publiques
        preg_match_all('/public function (\w+)\s*\(/', $content, $m);
        $this->line('   Méthodes publiques trouvées :');
        foreach ($m[1] as $method) {
            $this->line("      [OK] {$method}()");
        }

        // Vérifier create() en détail
        $this->line('');
        if (preg_match('/public function create\s*\([^)]*\)\s*\{(.*?)\n    \}/s', $content, $cm)) {
            $body = trim($cm[1]);
            $this->line('   📌 Méthode create() :');
            $this->line('');

            if (str_contains($body, 'response()->json')) {
                $this->info('      [OK] Renvoie du JSON');
            } else {
                $this->error('      [X] NE renvoie PAS de JSON');
            }

            if (str_contains($body, "'html'")) {
                $this->info("      [OK] Contient la clé 'html'");
            } else {
                $this->error("      [X] NE contient PAS la clé 'html'");
            }

            if (str_contains($body, 'partials._form')) {
                $this->info('      [OK] Utilise partials._form');
            } else {
                $this->warn('      [!]️  N\'utilise PAS partials._form');
            }

            $this->line('');
            $this->line('      Code :');
            foreach (explode("\n", $body) as $line) {
                $this->line('      ' . $line);
            }
        } else {
            $this->error('   [X] Méthode create() introuvable !');
        }
    }

    // ===============================================================
    // 3. VUES
    // ===============================================================
    private function inspectViews(): void
    {
        $this->line('');
        $this->line('> 3. VUES admin/formateurs/');
        $this->line(str_repeat('-', 62));

        $dir = resource_path('views/admin/formateurs');

        if (!File::exists($dir)) {
            $this->error("   [X] Dossier introuvable : {$dir}");
            return;
        }

        foreach (File::allFiles($dir) as $file) {
            $size = File::size($file->getPathname());
            $rel = str_replace($dir . DIRECTORY_SEPARATOR, '', $file->getPathname());

            if (str_contains($file->getFilename(), '.bak')) {
                $this->warn("   [!]️  {$rel} ({$size} octets) - fichier .bak");
            } elseif ($size === 0) {
                $this->error("   [X] {$rel} - VIDE");
            } else {
                $this->info("   [OK] {$rel} ({$size} octets)");
            }
        }

        // Analyser index.blade.php
        $indexPath = $dir . '/index.blade.php';
        if (File::exists($indexPath)) {
            $this->line('');
            $this->line('   📌 Analyse de index.blade.php :');
            $content = File::get($indexPath);

            $checks = [
                'id="formateurModal"'       => 'Conteneur modal',
                'id="formateurFormContent"' => 'Zone de contenu modal',
                'id="submitBtn"'            => 'Bouton Enregistrer',
                'openFormateurModal()'      => 'Fonction ouverture',
                'closeFormateurModal()'     => 'Fonction fermeture',
                'Chargement du formulaire'  => 'Texte "Chargement" (spinner)',
                'route("admin.formateurs.create")' => 'Route AJAX',
                'fetch('                    => 'Appel AJAX',
            ];

            foreach ($checks as $needle => $label) {
                if (str_contains($content, $needle)) {
                    $this->info("      [OK] {$label}");
                } else {
                    $this->line("      ⚪ {$label}");
                }
            }
        }
    }

    // ===============================================================
    // 4. PARTIALS
    // ===============================================================
    private function inspectPartials(): void
    {
        $this->line('');
        $this->line('> 4. PARTIALS admin/formateurs/partials/');
        $this->line(str_repeat('-', 62));

        $dir = resource_path('views/admin/formateurs/partials');

        if (!File::exists($dir)) {
            $this->error("   [X] Dossier introuvable : {$dir}");
            return;
        }

        foreach (File::allFiles($dir) as $file) {
            $size = File::size($file->getPathname());

            if (str_contains($file->getFilename(), '.bak')) {
                $this->warn("   [!]️  " . $file->getFilename() . " ({$size} octets) - .bak");
                continue;
            }

            $this->info("   [OK] " . $file->getFilename() . " ({$size} octets)");

            $content = File::get($file->getPathname());

            // Vérifier le contenu
            if (str_contains($content, '<form')) {
                $this->line('      [!]️  Contient un <form> (attention si imbriqué !)');
            }

            if (str_contains($content, '@error')) {
                $this->line('      [!]️  Utilise @error (peut crasher sans $errors)');
            }

            if (str_contains($content, '$errors')) {
                $this->line('      ℹ️  Utilise $errors');
            }

            if (str_contains($content, '$errs')) {
                $this->line('      [OK] Utilise $errs (safe)');
            }

            if (str_contains($content, 'id="formateurForm"')) {
                $this->line('      [OK] Contient id="formateurForm"');
            }
        }
    }

    // ===============================================================
    // 5. JS
    // ===============================================================
    private function inspectJS(): void
    {
        $this->line('');
        $this->line('> 5. JavaScript du modal (dans index.blade.php)');
        $this->line(str_repeat('-', 62));

        $path = resource_path('views/admin/formateurs/index.blade.php');
        if (!File::exists($path)) {
            $this->error('   [X] index.blade.php introuvable');
            return;
        }

        $content = File::get($path);

        // Extraire le script
        if (preg_match('/<script[^>]*>(.*?)<\/script>/s', $content, $m)) {
            $script = $m[1];

            // Vérifier les fonctions clés
            $checks = [
                'function openFormateurModal'    => 'Fonction openFormateurModal',
                'function closeFormateurModal'   => 'Fonction closeFormateurModal',
                'fetch('                         => 'Appel fetch AJAX',
                'formateurFormContent'           => 'Cible : formateurFormContent',
                'innerHTML'                      => 'Écriture innerHTML',
                'data.html'                      => 'Utilise data.html',
                'submitBtn'                      => 'Gestion du bouton submit',
            ];

            foreach ($checks as $needle => $label) {
                if (str_contains($script, $needle)) {
                    $this->info("   [OK] {$label}");
                } else {
                    $this->warn("   [!]️  {$label} MANQUANT");
                }
            }

            // Afficher le fetch
            if (preg_match('/fetch\([^)]+\).*?\}\);/s', $script, $fm)) {
                $this->line('');
                $this->line('   📌 Code du fetch :');
                foreach (explode("\n", $fm[0]) as $line) {
                    $this->line('      ' . $line);
                }
            }
        } else {
            $this->error('   [X] Aucun <script> trouvé');
        }
    }

    // ===============================================================
    // 6. FORM REQUEST
    // ===============================================================
    private function inspectRequest(): void
    {
        $this->line('');
        $this->line('> 6. Form Requests Formateur');
        $this->line(str_repeat('-', 62));

        $files = [
            app_path('Http/Requests/Formateur/StoreFormateurRequest.php'),
            app_path('Http/Requests/Formateur/UpdateFormateurRequest.php'),
        ];

        foreach ($files as $f) {
            if (!File::exists($f)) {
                $this->error("   [X] " . basename($f) . " introuvable");
                continue;
            }

            $size = File::size($f);
            $content = File::get($f);
            $name = basename($f);

            $this->info("   [OK] {$name} ({$size} octets)");

            if (preg_match('/public function authorize/', $content)) {
                $this->line('      [OK] authorize() présent');
            }
            if (preg_match('/public function rules/', $content)) {
                $this->line('      [OK] rules() présent');
            }
        }
    }

    // ===============================================================
    // RÉSUMÉ
    // ===============================================================
    private function finalSummary(): void
    {
        $this->line('');
        $this->line('+==============================================================+');
        $this->line('|   -> ENVOYEZ-MOI TOUT CE RAPPORT                              |');
        $this->line('+==============================================================+');
        $this->line('');
    }
}