<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class FixEtablissementCreateMethod extends Command
{
    protected $signature = 'fix:etablissement-create';
    protected $description = 'Corrige create() pour renvoyer du JSON';

    public function handle(): int
    {
        $this->line('');
        $this->line('+==========================================================+');
        $this->line('|   [TOOL] CORRECTION create() - RENVOIE DU JSON                |');
        $this->line('+==========================================================+');
        $this->line('');

        $path = app_path('Http/Controllers/Admin/EtablissementController.php');

        if (!File::exists($path)) {
            $this->error("[X] Fichier introuvable");
            return self::FAILURE;
        }

        $content = File::get($path);
        $original = $content;

        // ===============================================
        // 1. Backup
        // ===============================================
        $this->line('> 1. Backup');
        File::copy($path, $path . '.bak.' . date('Y-m-d_His'));
        $this->info('   [SAVE] Backup créé');

        // ===============================================
        // 2. Nouvelle méthode create()
        // ===============================================
        $this->line('');
        $this->line('> 2. Remplacement de create()');

        $newCreate = <<<'PHP'
    public function create(Request $request)
    {
        // Requête AJAX -> renvoie JSON avec le HTML du formulaire
        if ($request->ajax()
            || $request->wantsJson()
            || $request->header('X-Requested-With') === 'XMLHttpRequest') {

            $errors = session()->get('errors', new \Illuminate\Support\ViewErrorBag());

            $html = view('admin.etablissements.partials._form', [
                'errors' => $errors,
            ])->render();

            return response()->json(['html' => $html]);
        }

        // Requête normale -> vue complète
        return view('admin.etablissements.create');
    }
PHP;

        // Remplacer UNIQUEMENT la méthode create() existante
        // Pattern : "public function create()" ... jusqu'à la première "}" suivie d'une ligne vide
        $pattern = '/public function create\s*\([^)]*\)\s*\{[^{}]*\}/s';

        if (preg_match($pattern, $content)) {
            $content = preg_replace($pattern, $newCreate, $content, 1);
            $this->info('   [OK] Méthode create() remplacée');
        } else {
            $this->error('   [X] Pattern create() introuvable');
            return self::FAILURE;
        }

        // ===============================================
        // 3. Sauvegarder
        // ===============================================
        $this->line('');
        $this->line('> 3. Sauvegarde');
        File::put($path, $content);
        $this->info('   [OK] Fichier enregistré');
        $this->line('   [BOX] Taille : ' . File::size($path) . ' octets');

        // ===============================================
        // 4. Vérifier syntaxe
        // ===============================================
        $this->line('');
        $this->line('> 4. Vérification syntaxe PHP');

        $output = [];
        $returnCode = 0;
        exec('php -l "' . $path . '" 2>&1', $output, $returnCode);

        if ($returnCode === 0) {
            $this->info('   [OK] Syntaxe valide');
        } else {
            $this->error('   [X] ERREUR :');
            foreach ($output as $o) $this->line('      ' . $o);
            File::put($path, $original);
            $this->warn('   [RELOAD] Fichier restauré');
            return self::FAILURE;
        }

        // ===============================================
        // 5. Vérifier partial _form.blade.php
        // ===============================================
        $this->line('');
        $this->line('> 5. Vérification partial _form');

        $partialPath = resource_path('views/admin/etablissements/partials/_form.blade.php');
        if (File::exists($partialPath)) {
            $this->info('   [OK] partials/_form.blade.php (' . File::size($partialPath) . ' octets)');
        } else {
            $this->error('   [X] partials/_form.blade.php MANQUANT !');
        }

        // ===============================================
        // 6. Vider les caches
        // ===============================================
        $this->line('');
        $this->line('> 6. Vidage des caches');
        $this->call('optimize:clear');
        $this->call('view:clear');
        $this->info('   [OK] Caches vidés');

        $this->line('');
        $this->line('+==========================================================+');
        $this->line('|   [SUCCESS] TERMINÉ                                              |');
        $this->line('+==========================================================+');
        $this->line('');
        $this->line('-> Testez : http://localhost:8000/admin/etablissements (Ctrl+F5)');

        return self::SUCCESS;
    }
}