<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;

class DiagnoseModals extends Command
{
    protected $signature = 'diagnose:modals
                            {--module= : Module à inspecter (filiere, etablissement, formateur)}';

    protected $description = 'Diagnostic complet des modals Filière/Etablissement/Formateur';

    public function handle(): int
    {
        $this->line('');
        $this->line('+==========================================================+');
        $this->line('|   🔬 DIAGNOSTIC DES MODALS                                |');
        $this->line('+==========================================================+');

        $modules = [
            'filiere'       => ['singular' => 'Filiere',       'plural' => 'filieres'],
            'etablissement' => ['singular' => 'Etablissement', 'plural' => 'etablissements'],
            'formateur'     => ['singular' => 'Formateur',     'plural' => 'formateurs'],
        ];

        $only = $this->option('module');
        if ($only && isset($modules[$only])) {
            $modules = [$only => $modules[$only]];
        }

        foreach ($modules as $key => $info) {
            $this->inspectModule($key, $info['singular'], $info['plural']);
        }

        $this->line('');
        $this->line('+==========================================================+');
        $this->line('|   -> ENVOYEZ-MOI TOUT CE RAPPORT                          |');
        $this->line('+==========================================================+');

        return self::SUCCESS;
    }

    private function inspectModule(string $key, string $singular, string $plural): void
    {
        $this->line('');
        $this->line('===========================================================');
        $this->line("[BOX] MODULE : {$singular}");
        $this->line('===========================================================');

        // ---------------------------------------------
        // 1. Fichiers présents
        // ---------------------------------------------
        $this->line('');
        $this->line('> 1. Fichiers');

        $files = [
            "views/admin/{$plural}/index.blade.php"           => 'Vue index',
            "views/admin/{$plural}/partials/_form.blade.php" => 'Partial _form (JSON-safe)',
            "views/admin/{$plural}/partials/modal-create.blade.php" => 'Partial modal',
            "views/admin/{$plural}/partials/form.blade.php"  => 'Partial form (original)',
        ];

        foreach ($files as $rel => $label) {
            $path = resource_path($rel);
            if (File::exists($path)) {
                $size = File::size($path);
                $this->info("   [OK] {$label} ({$size} octets)");
            } else {
                $this->error("   [X] {$label} INTROUVABLE : {$rel}");
            }
        }

        // ---------------------------------------------
        // 2. Route create
        // ---------------------------------------------
        $this->line('');
        $this->line('> 2. Routes');

        $routeName = "admin.{$plural}.create";
        if (Route::has($routeName)) {
            $route = Route::getRoutes()->getByName($routeName);
            $this->info("   [OK] Route {$routeName} : {$route->uri()}");
            $mw = $route->gatherMiddleware();
            $this->line('   Middlewares : ' . implode(', ', $mw));
        } else {
            $this->error("   [X] Route {$routeName} introuvable");
        }

        // ---------------------------------------------
        // 3. Contrôleur create()
        // ---------------------------------------------
        $this->line('');
        $this->line('> 3. Contrôleur');

        $ctrlPath = app_path("Http/Controllers/Admin/{$singular}Controller.php");
        if (!File::exists($ctrlPath)) {
            $this->error("   [X] Controller introuvable");
            return;
        }

        $ctrl = File::get($ctrlPath);

        if (preg_match('/public function create\s*\([^)]*\)\s*\{(.*?)\n    \}/s', $ctrl, $m)) {
            $body = trim($m[1]);

            if (str_contains($body, 'response()->json')) {
                $this->info("   [OK] create() renvoie du JSON");
            } else {
                $this->error("   [X] create() NE renvoie PAS de JSON");
                $this->line("   -> Code actuel :");
                foreach (explode("\n", $body) as $line) {
                    $this->line('      ' . $line);
                }
            }

            if (str_contains($body, '_form')) {
                $this->info("   [OK] Utilise partials._form");
            } else {
                $this->warn("   [!]️  N'utilise PAS partials._form");
            }
        } else {
            $this->error("   [X] Méthode create() introuvable");
        }

        // ---------------------------------------------
        // 4. Modal présent dans index.blade.php
        // ---------------------------------------------
        $this->line('');
        $this->line('> 4. Modal dans index.blade.php');

        $indexPath = resource_path("views/admin/{$plural}/index.blade.php");
        if (File::exists($indexPath)) {
            $index = File::get($indexPath);

            $checks = [
                "@include('admin.{$plural}.partials.modal-create')" => '@include modal-create',
                "modal-create"                                       => 'Référence modal-create',
                "open{$singular}Modal"                              => "Fonction open{$singular}Modal",
                "close{$singular}Modal"                             => "Fonction close{$singular}Modal",
                "modalCreate{$singular}"                            => 'ID modalCreate' . $singular,
                "form{$singular}"                                   => "ID form{$singular}",
            ];

            foreach ($checks as $needle => $label) {
                if (str_contains($index, $needle)) {
                    $this->info("   [OK] {$label}");
                } else {
                    $this->warn("   [!]️  {$label} MANQUANT");
                }
            }

            // Vérifier le bouton "Ajouter"
            $this->line('');
            $this->line('   📌 Bouton "Ajouter" dans index :');
            if (preg_match_all('/<a[^>]*href="[^"]*' . $plural . '\/create"[^>]*>.*?<\/a>/s', $index, $btnMatches)) {
                foreach ($btnMatches[0] as $btn) {
                    $this->warn('   [!]️  Bouton avec href (à changer en onclick) :');
                    $this->line('      ' . substr(preg_replace('/\s+/', ' ', $btn), 0, 200));
                }
            }
            if (preg_match('/onclick="open' . $singular . 'Modal\(\)"/', $index)) {
                $this->info("   [OK] Bouton avec onclick correct");
            } else {
                $this->warn("   [!]️  Pas de bouton avec onclick=\"open{$singular}Modal()\"");
            }
        } else {
            $this->error("   [X] index.blade.php introuvable");
        }

        // ---------------------------------------------
        // 5. Layout @stack('scripts')
        // ---------------------------------------------
        $this->line('');
        $this->line('> 5. Layout admin');

        $layoutPath = resource_path('views/layouts/admin.blade.php');
        if (File::exists($layoutPath)) {
            $layout = File::get($layoutPath);

            if (str_contains($layout, "@stack('scripts')")) {
                $this->info("   [OK] @stack('scripts') présent");
            } else {
                $this->error("   [X] @stack('scripts') MANQUANT");
                $this->line("      -> Ajoutez : @stack('scripts') avant </body>");
            }

            if (str_contains($layout, "@stack('styles')")) {
                $this->line("   ℹ️  @stack('styles') présent");
            }
        } else {
            $this->error("   [X] layouts/admin.blade.php introuvable");
        }

        // ---------------------------------------------
        // 6. Test de la route AJAX (simulation)
        // ---------------------------------------------
        $this->line('');
        $this->line('> 6. Test route AJAX (simulation)');

        try {
            $request = \Illuminate\Http\Request::create(
                "/admin/{$plural}/create",
                'GET', [], [], [],
                ['HTTP_X-REQUESTED-WITH' => 'XMLHttpRequest', 'HTTP_ACCEPT' => 'application/json']
            );

            // Simuler un admin connecté
            $admin = \DB::table('admins')->first();
            if ($admin) {
                auth('admin')->loginUsingId($admin->id);
            }

            $response = app()->handle($request);
            $status = $response->getStatusCode();
            $body = $response->getContent();

            $this->line("   Statut HTTP : {$status}");

            if ($status === 200) {
                $json = json_decode($body, true);
                if (isset($json['html'])) {
                    $this->info("   [OK] JSON avec 'html' (" . strlen($json['html']) . " octets)");
                    $this->line("   Première ligne : " . substr(trim(strip_tags($json['html'])), 0, 100));
                } else {
                    $this->error("   [X] JSON SANS clé 'html'");
                    $this->line("   Body : " . substr($body, 0, 300));
                }
            } else {
                $this->error("   [X] Statut HTTP non-200");
                $this->line("   Body : " . substr($body, 0, 300));
            }
        } catch (\Throwable $e) {
            $this->error("   [X] Erreur test : " . $e->getMessage());
        }
    }
}