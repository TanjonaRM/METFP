<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Route;

class FixDuplicateRoutes extends Command
{
    protected $signature = 'routes:fix-duplicates
                            {--dry-run : Afficher les doublons sans rien modifier}
                            {--force : Corriger sans demander de confirmation}';

    protected $description = 'Détecte et corrige les noms de routes dupliqués dans le projet';

    public function handle(): int
    {
        $this->renderHeader();

        $dryRun = (bool) $this->option('dry-run');
        $force  = (bool) $this->option('force');

        // 1. Récupérer toutes les routes
        $routes = Route::getRoutes();

        // 2. Regrouper par nom
        $byName = [];
        foreach ($routes as $route) {
            $name = $route->getName();
            if (!$name) {
                continue;
            }
            $byName[$name][] = [
                'uri'     => $route->uri(),
                'methods' => implode('|', $route->methods()),
                'action'  => $route->getActionName(),
            ];
        }

        // 3. Filtrer les doublons
        $duplicates = array_filter($byName, fn($list) => count($list) > 1);

        if (empty($duplicates)) {
            $this->info('[OK] Aucun nom de route dupliqué détecté.');
            return self::SUCCESS;
        }

        // 4. Afficher les doublons
        $this->warn('[!]️  ' . count($duplicates) . ' nom(s) de route dupliqué(s) :');
        $this->newLine();

        foreach ($duplicates as $name => $list) {
            $this->line("  [RED] <fg=red>{$name}</>");
            foreach ($list as $i => $r) {
                $marker = $i === 0 ? '👑 (prioritaire)' : '[!]️  (écrasée)';
                $this->line("     {$marker}  [{$r['methods']}] /{$r['uri']}");
                $this->line("              -> {$r['action']}");
            }
            $this->newLine();
        }

        if ($dryRun) {
            $this->warn('🛈 Mode --dry-run : aucune modification effectuée.');
            $this->newLine();
            $this->line('Pour corriger automatiquement, lancez :');
            $this->line('  <fg=cyan>php artisan routes:fix-duplicates</>');
            return self::SUCCESS;
        }

        // 5. Confirmation
        if (!$force && !$this->confirm(
            'Voulez-vous afficher les fichiers à corriger manuellement ?',
            true
        )) {
            return self::SUCCESS;
        }

        // 6. Chercher où chaque doublon est défini dans les fichiers de routes
        $this->showWhereToFix($duplicates);

        $this->newLine();
        $this->info('[NOTE] Instructions :');
        $this->line('  1. Ouvrez chaque fichier listé ci-dessus');
        $this->line('  2. Renommez l\'un des deux ->name(\'...\') en un nom unique');
        $this->line('  3. Relancez : php artisan routes:fix-duplicates');
        $this->newLine();

        return self::SUCCESS;
    }

    /**
     * Cherche dans les fichiers de routes où chaque nom dupliqué est défini.
     */
    protected function showWhereToFix(array $duplicates): void
    {
        $this->section('📂 Fichiers concernés');

        $routeFiles = $this->getRouteFiles();
        $found = [];

        foreach (array_keys($duplicates) as $name) {
            foreach ($routeFiles as $file) {
                $content = @file_get_contents($file);
                if ($content === false) {
                    continue;
                }

                // Chercher ->name('xxx') ou ->name("xxx")
                if (preg_match_all(
                    '/->name\(\s*[\'"]([^\'"]+)[\'"]\s*\)/',
                    $content,
                    $matches,
                    PREG_OFFSET_CAPTURE
                )) {
                    foreach ($matches[1] as $match) {
                        if ($match[0] === $name) {
                            $line = substr_count(substr($content, 0, $match[1]), "\n") + 1;
                            $found[$name][] = [
                                'file' => str_replace(base_path() . DIRECTORY_SEPARATOR, '', $file),
                                'line' => $line,
                            ];
                        }
                    }
                }
            }
        }

        if (empty($found)) {
            $this->warn('  Aucune occurrence trouvée dans les fichiers routes/*.php');
            $this->line('  (Les routes peuvent être définies dans un autre fichier ou un package)');
            return;
        }

        foreach ($found as $name => $locations) {
            $this->line("  [RED] <fg=red>{$name}</>");
            foreach ($locations as $loc) {
                $this->line("     [FILE] {$loc['file']}  <fg=yellow>ligne {$loc['line']}</>");
            }
            $this->newLine();
        }
    }

    /**
     * Liste tous les fichiers de routes du projet.
     */
    protected function getRouteFiles(): array
    {
        $files = [];
        $routesDir = base_path('routes');

        if (is_dir($routesDir)) {
            foreach (scandir($routesDir) as $f) {
                if (str_ends_with($f, '.php')) {
                    $files[] = $routesDir . DIRECTORY_SEPARATOR . $f;
                }
            }
        }

        // Ajouter aussi bootstrap/app.php (Laravel 11/12)
        $bootstrapApp = base_path('bootstrap/app.php');
        if (file_exists($bootstrapApp)) {
            $files[] = $bootstrapApp;
        }

        return $files;
    }

    protected function renderHeader(): void
    {
        $this->newLine();
        $this->line('+======================================================+');
        $this->line('|   DÉTECTION DES ROUTES DUPLIQUÉES                    |');
        $this->line('+======================================================+');
        $this->newLine();
    }

    protected function section(string $title): void
    {
        $this->newLine();
        $this->line('--- ' . $title . ' ' . str_repeat('-', max(0, 50 - strlen($title))));
    }
}