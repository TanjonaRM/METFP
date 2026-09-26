<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class PatchFullProjectAudit extends Command
{
    protected $signature = 'patch:audit';
    protected $description = 'Corrige le bug de FullProjectAudit (toArray on array)';

    public function handle(): int
    {
        $path = app_path('Console/Commands/FullProjectAudit.php');

        if (!File::exists($path)) {
            $this->error("[X] Fichier introuvable : {$path}");
            return self::FAILURE;
        }

        // Backup
        File::copy($path, $path . '.bak.' . date('Y-m-d_His'));
        $this->line('[SAVE] Backup créé');

        $content = File::get($path);

        // ---------------------------------------------
        // PATCH 1 : ligne 201 - array_merge avec File::allFiles
        // ---------------------------------------------
        $badBlock = <<<'PHP'
        $allPhp = array_merge(
            File::allFiles(app_path())->toArray(),
            File::allFiles(resource_path('views'))->toArray()
        );
PHP;

        $goodBlock = <<<'PHP'
        $allPhp = array_merge(
            iterator_to_array(File::allFiles(app_path())),
            iterator_to_array(File::allFiles(resource_path('views')))
        );
PHP;

        if (str_contains($content, $badBlock)) {
            $content = str_replace($badBlock, $goodBlock, $content);
            $this->info('[OK] PATCH 1 : array_merge corrigé (ligne 201)');
        } else {
            $this->warn('[!]️  PATCH 1 : motif exact non trouvé - passe au patch générique');
            // Fallback : regex
            $content = preg_replace(
                '/File::allFiles\(([^)]+)\)->toArray\(\)/',
                'iterator_to_array(File::allFiles($1))',
                $content
            );
            $this->info('[OK] PATCH 1 (fallback regex) appliqué');
        }

        // ---------------------------------------------
        // PATCH 2 : ligne 62 (handle) - File::allFiles()->toArray() ailleurs
        // ---------------------------------------------
        $content = str_replace(
            'File::allFiles(resource_path(\'views\'))->toArray()',
            'iterator_to_array(File::allFiles(resource_path(\'views\')))',
            $content
        );

        // ---------------------------------------------
        // PATCH 3 : améliorer le checkViews() pour éviter les faux positifs
        // ---------------------------------------------
        $this->patchCheckViews($content);

        File::put($path, $content);
        $this->info('[OK] Fichier enregistré');

        $this->newLine();
        $this->line('> Test de la commande...');
        $this->newLine();

        // Lancer l'audit
        $this->call('audit:full', ['--only' => 'views']);

        return self::SUCCESS;
    }

    private function patchCheckViews(string &$content): void
    {
        // Remplacer la méthode checkViews entière par une version plus robuste
        $newMethod = <<<'PHP'
    private function checkViews(): void
    {
        $viewsDir = resource_path('views');

        // Collecter toutes les vues existantes
        $existingViews = [];
        foreach (File::allFiles($viewsDir) as $v) {
            if (str_contains($v->getFilename(), '.bak')) continue;
            if (!str_ends_with($v->getFilename(), '.blade.php')) continue;

            // Convertir le chemin en notation "dot"
            $relative = str_replace(
                [$viewsDir . DIRECTORY_SEPARATOR, '.blade.php'],
                ['', ''],
                $v->getPathname()
            );
            $relative = str_replace(DIRECTORY_SEPARATOR, '.', $relative);
            $existingViews[] = $relative;
        }

        // Chercher toutes les références
        $referenced = [];

        // 1. Dans app/ (Controllers, Providers, etc.)
        foreach (File::allFiles(app_path()) as $file) {
            if ($file->getExtension() !== 'php') continue;
            if (str_contains($file->getFilename(), '.bak')) continue;

            $content = File::get($file->getPathname());

            preg_match_all('/@(?:include|extends|component)\s*\(\s*[\'"]([^\'"]+)[\'"]/', $content, $m);
            foreach ($m[1] as $ref) $referenced[$ref] = $file->getFilename();

            preg_match_all('/view\s*\(\s*[\'"]([^\'"]+)[\'"]/', $content, $m2);
            foreach ($m2[1] as $ref) $referenced[$ref] = $file->getFilename();
        }

        // 2. Dans resources/views/ (Blade)
        foreach (File::allFiles($viewsDir) as $file) {
            if (!str_ends_with($file->getFilename(), '.blade.php')) continue;
            if (str_contains($file->getFilename(), '.bak')) continue;

            $content = File::get($file->getPathname());

            preg_match_all('/@(?:include|extends|component)\s*\(\s*[\'"]([^\'"]+)[\'"]/', $content, $m);
            foreach ($m[1] as $ref) $referenced[$ref] = $file->getFilename();

            preg_match_all('/view\s*\(\s*[\'"]([^\'"]+)[\'"]/', $content, $m2);
            foreach ($m2[1] as $ref) $referenced[$ref] = $file->getFilename();
        }

        // Vérifier les vues référencées
        $missing = 0;
        foreach ($referenced as $ref => $source) {
            // Ignorer les composants natifs (: ou ::)
            if (str_contains($ref, '::')) continue;

            // Chercher avec/sans prefix
            $found = false;
            foreach ($existingViews as $ev) {
                if ($ev === $ref || str_ends_with($ev, '.' . $ref)) {
                    $found = true;
                    break;
                }
            }

            if (!$found) {
                // Vérifier s'il s'agit d'un composant anonyme (x-...)
                if (str_contains($ref, '.')) {
                    $this->addWarning("Vue référencée introuvable : {$ref} (dans {$source})");
                    $missing++;
                }
            }
        }

        // Vues orphelines (partiels commençant par _)
        $orphans = 0;
        foreach ($existingViews as $view) {
            $basename = basename(str_replace('.', '/', $view));
            if (!str_starts_with($basename, '_')) continue;
            if (!isset($referenced[$view])) {
                // Ne pas signaler les vues qu'on sait optionnelles
                $this->addWarning("Vue partielle possiblement orpheline : {$view}");
                $orphans++;
            }
        }

        if ($missing === 0 && $orphans === 0) {
            $this->addOk(count($existingViews) . ' vues analysées [OK]');
        }
    }
PHP;

        // Remplacer la méthode checkViews complète
        $content = preg_replace(
            '/private function checkViews\(\): void\s*\{.*?\n    \}/s',
            $newMethod,
            $content,
            1
        );
    }
}