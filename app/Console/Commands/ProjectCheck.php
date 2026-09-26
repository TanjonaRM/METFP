<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use SplFileInfo;

class ProjectCheck extends Command
{
    protected $signature = 'project:check
                            {--skip-db : Sauter les vérifications de base de données}
                            {--skip-syntax : Sauter la vérification syntaxique}
                            {--skip-classes : Sauter la vérification des références de classes}
                            {--only= : Ne lancer qu\'une catégorie (env,db,routes,syntax,classes,logs)}';

    protected $description = 'Vérifie l\'intégrité complète du projet Laravel et affiche un rapport détaillé';

    protected int $passed = 0;
    protected int $failed = 0;
    protected int $warnings = 0;
    protected array $issues = [];

    public function handle(): int
    {
        $this->renderHeader();

        $only = $this->option('only');

        $checks = [
            'env'     => 'checkEnvironment',
            'db'      => 'checkDatabase',
            'routes'  => 'checkRoutes',
            'syntax'  => 'checkSyntax',
            'classes' => 'checkClasses',
            'logs'    => 'checkLogs',
        ];

        foreach ($checks as $key => $method) {
            if ($only && $only !== $key) {
                continue;
            }
            if (!$this->shouldRun($key)) {
                continue;
            }
            $this->{$method}();
        }

        $this->renderFooter();

        return $this->failed === 0 ? self::SUCCESS : self::FAILURE;
    }

    protected function shouldRun(string $key): bool
    {
        return match ($key) {
            'db'      => !$this->option('skip-db'),
            'syntax'  => !$this->option('skip-syntax'),
            'classes' => !$this->option('skip-classes'),
            default   => true,
        };
    }

    // =================================================================
    // 1. ENVIRONNEMENT
    // =================================================================
    protected function checkEnvironment(): void
    {
        $this->section('[WORLD] Environnement');

        // Version PHP
        $phpVersion = PHP_VERSION;
        $this->result(
            version_compare($phpVersion, '8.2.0', '>='),
            "PHP {$phpVersion}",
            'PHP < 8.2 détecté'
        );

        // Version Laravel
        $laravelVersion = app()->version();
        $this->result(true, "Laravel {$laravelVersion}");

        // Fichier .env
        $this->result(
            file_exists(base_path('.env')),
            '.env présent',
            '.env MANQUANT'
        );

        // Clé d'application
        $appKey = config('app.key');
        $this->result(
            !empty($appKey),
            'APP_KEY définie',
            'APP_KEY vide - lancez: php artisan key:generate'
        );

        // Mode debug
        if (config('app.debug')) {
            $this->warn2('APP_DEBUG=true (à désactiver en production)');
        } else {
            $this->result(true, 'APP_DEBUG=false');
        }

        // Dossiers inscriptibles
        foreach (['storage', 'storage/logs', 'storage/framework', 'bootstrap/cache'] as $dir) {
            $path = base_path($dir);
            $writable = is_dir($path) && is_writable($path);
            $this->result(
                $writable,
                "{$dir} inscriptible",
                "{$dir} NON inscriptible"
            );
        }
    }

    // =================================================================
    // 2. BASE DE DONNÉES
    // =================================================================
    protected function checkDatabase(): void
    {
        $this->section('[DB]️  Base de données');

        try {
            DB::connection()->getPdo();
            $this->result(true, 'Connexion PDO OK');
        } catch (\Throwable $e) {
            $this->result(false, '', 'Connexion impossible : ' . $e->getMessage());
            return;
        }

        // Nom de la base
        try {
            $dbName = DB::connection()->getDatabaseName();
            $this->result(true, "Base : {$dbName}");
        } catch (\Throwable $e) {
            $this->warn2('Impossible de récupérer le nom de la base');
        }

        // Compter les tables
        try {
            $tables = DB::select('SHOW TABLES');
            $this->result(true, count($tables) . ' table(s)');
        } catch (\Throwable $e) {
            $this->warn2('Impossible de lister les tables');
        }

        // Vérifier les migrations en attente
        try {
            $migrations = DB::table('migrations')->count();
            $this->result(true, "{$migrations} migration(s) exécutée(s)");
        } catch (\Throwable $e) {
            $this->warn2('Table migrations introuvable - lancez: php artisan migrate');
        }
    }

    // =================================================================
    // 3. ROUTES
    // =================================================================
    protected function checkRoutes(): void
    {
        $this->section('🛣️  Routes');

        try {
            $routes = Route::getRoutes();
            $this->result(true, count($routes) . ' route(s) enregistrée(s)');
        } catch (\Throwable $e) {
            $this->result(false, '', 'Impossible de charger les routes : ' . $e->getMessage());
            return;
        }

        // Routes avec closures (non cacheables)
        $closures = 0;
        foreach ($routes as $route) {
            if ($route->getAction('uses') instanceof \Closure) {
                $closures++;
            }
        }
        if ($closures > 0) {
            $this->warn2("{$closures} route(s) avec closure (route:cache impossible)");
        } else {
            $this->result(true, 'Toutes les routes sont cacheables');
        }

        // Vérifier les doublons de noms
        $names = [];
        $duplicates = 0;
        foreach ($routes as $route) {
            $name = $route->getName();
            if ($name) {
                if (isset($names[$name])) {
                    $duplicates++;
                }
                $names[$name] = true;
            }
        }
        if ($duplicates > 0) {
            $this->warn2("{$duplicates} nom(s) de route dupliqué(s)");
        } else {
            $this->result(true, 'Aucun nom de route dupliqué');
        }
    }

    // =================================================================
    // 4. SYNTAXE PHP
    // =================================================================
    protected function checkSyntax(): void
    {
        $this->section('[NOTE] Syntaxe PHP');

        $dirs = ['app', 'config', 'routes', 'database', 'bootstrap'];
        $errors = [];
        $total = 0;

        foreach ($dirs as $dir) {
            $path = base_path($dir);
            if (!is_dir($path)) {
                continue;
            }

            $iterator = new RecursiveIteratorIterator(
                new RecursiveDirectoryIterator($path, RecursiveDirectoryIterator::SKIP_DOTS)
            );

            foreach ($iterator as $file) {
                /** @var SplFileInfo $file */
                if (!$file->isFile() || $file->getExtension() !== 'php') {
                    continue;
                }
                $total++;

                $output = shell_exec('php -l ' . escapeshellarg($file->getPathname()) . ' 2>&1');
                if ($output && !str_contains($output, 'No syntax errors')) {
                    $errors[] = str_replace(base_path() . DIRECTORY_SEPARATOR, '', $file->getPathname());
                }
            }
        }

        if (empty($errors)) {
            $this->result(true, "{$total} fichier(s) PHP valide(s)");
        } else {
            $this->result(false, '', count($errors) . " fichier(s) avec erreur de syntaxe :");
            foreach (array_slice($errors, 0, 10) as $e) {
                $this->line("     * {$e}");
            }
            if (count($errors) > 10) {
                $this->line('     ... et ' . (count($errors) - 10) . ' autre(s)');
            }
        }
    }

    // =================================================================
    // 5. RÉFÉRENCES DE CLASSES
    // =================================================================
    protected function checkClasses(): void
    {
        $this->section('[LINK] Références de classes');

        $path = base_path('app');
        if (!is_dir($path)) {
            $this->warn2('Dossier app/ introuvable');
            return;
        }

        $iterator = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator($path, RecursiveDirectoryIterator::SKIP_DOTS)
        );

        $broken = [];
        $total = 0;

        foreach ($iterator as $file) {
            /** @var SplFileInfo $file */
            if (!$file->isFile() || $file->getExtension() !== 'php') {
                continue;
            }

            $content = @file_get_contents($file->getPathname());
            if ($content === false) {
                continue;
            }

            if (!preg_match_all('/^use\s+([A-Za-z0-9_\\\\]+)(?:\s+as\s+\w+)?;/m', $content, $matches)) {
                continue;
            }

            $relative = str_replace(base_path() . DIRECTORY_SEPARATOR, '', $file->getPathname());

            foreach ($matches[1] as $class) {
                // Ignorer les imports de fonctions et constantes
                if (str_contains($class, 'function ') || str_contains($class, 'const ')) {
                    continue;
                }
                // Ignorer les classes PHP natives et Composer
                if (str_starts_with($class, 'Illuminate\\')
                    || str_starts_with($class, 'Symfony\\')
                    || str_starts_with($class, 'Psr\\')
                    || str_starts_with($class, 'Carbon\\')
                    || !str_contains($class, '\\')) {
                    continue;
                }
                $total++;
                if (!class_exists($class) && !interface_exists($class) && !trait_exists($class) && !enum_exists($class)) {
                    $broken[] = "{$relative}  ->  use {$class}";
                }
            }
        }

        if (empty($broken)) {
            $this->result(true, "{$total} référence(s) de classes valides");
        } else {
            $this->result(false, '', count($broken) . " référence(s) cassée(s) :");
            foreach (array_slice($broken, 0, 15) as $b) {
                $this->line("     * {$b}");
            }
            if (count($broken) > 15) {
                $this->line('     ... et ' . (count($broken) - 15) . ' autre(s)');
            }
        }
    }

    // =================================================================
    // 6. LOGS
    // =================================================================
    protected function checkLogs(): void
    {
        $this->section('[LIST] Logs récents');

        $logFile = storage_path('logs/laravel.log');
        if (!file_exists($logFile)) {
            $this->result(true, 'Aucun log (fichier absent)');
            return;
        }

        $size = filesize($logFile);
        if ($size === 0) {
            $this->result(true, 'Log vide (aucune erreur)');
            return;
        }

        $this->result(true, 'Fichier log : ' . $this->formatBytes($size));

        // Chercher les erreurs récentes
        $content = @file_get_contents($logFile);
        if ($content === false) {
            return;
        }

        // Prendre les 100 dernières lignes
        $lines = array_slice(explode("\n", $content), -500);
        $recent = implode("\n", $lines);

        $errorCount = preg_match_all('/\.ERROR:/', $recent);
        $criticalCount = preg_match_all('/\.CRITICAL:/', $recent);
        $exceptionCount = preg_match_all('/Exception/', $recent);

        if ($criticalCount > 0) {
            $this->warn2("{$criticalCount} CRITICAL récent(s) dans les logs");
        }
        if ($errorCount > 0) {
            $this->warn2("{$errorCount} ERROR récent(s) dans les logs");
        }
        if ($errorCount === 0 && $criticalCount === 0) {
            $this->result(true, 'Aucune erreur récente');
        }
    }

    // =================================================================
    // AFFICHAGE
    // =================================================================
    protected function renderHeader(): void
    {
        $this->newLine();
        $this->line('+======================================================+');
        $this->line('|   VÉRIFICATION COMPLÈTE DU PROJET LARAVEL            |');
        $this->line('|   ' . str_pad(now()->format('Y-m-d H:i:s'), 50) . ' |');
        $this->line('+======================================================+');
        $this->newLine();
    }

    protected function renderFooter(): void
    {
        $this->newLine();
        $this->line('+======================================================+');

        $total = $this->passed + $this->failed;

        if ($this->failed === 0 && $this->warnings === 0) {
            $this->line('|   [OK] PROJET SAIN                                     |');
        } elseif ($this->failed === 0) {
            $this->line('|   [!]️  PROJET FONCTIONNEL (avec avertissements)       |');
        } else {
            $this->line('|   [X] PROJET AVEC ERREURS                             |');
        }

        $this->line('╠======================================================╣');
        $this->line('|   [OK] Réussis       : ' . str_pad((string) $this->passed, 31) . '|');
        $this->line('|   [!]️  Avertissements: ' . str_pad((string) $this->warnings, 31) . '|');
        $this->line('|   [X] Échecs         : ' . str_pad((string) $this->failed, 31) . '|');
        $this->line('+======================================================+');
        $this->newLine();

        if ($this->failed > 0) {
            $this->error('[X] Des erreurs bloquantes ont été détectées. Corrigez-les avant de continuer.');
        } elseif ($this->warnings > 0) {
            $this->warn('[!]️  Le projet fonctionne mais des points sont à surveiller.');
        } else {
            $this->info('[OK] Toutes les vérifications sont passées avec succès.');
        }
    }

    protected function section(string $title): void
    {
        $this->newLine();
        $this->line('--- ' . $title . ' ' . str_repeat('-', max(0, 50 - strlen($title))));
    }

    protected function result(bool $ok, string $successMsg, string $errorMsg = ''): void
    {
        if ($ok) {
            $this->line("  [OK] {$successMsg}");
            $this->passed++;
        } else {
            $this->line("  [X] {$errorMsg}");
            $this->issues[] = $errorMsg;
            $this->failed++;
        }
    }

    protected function warn2(string $msg): void
    {
        $this->line("  [!]️  {$msg}");
        $this->warnings++;
    }

    protected function formatBytes(int $bytes): string
    {
        $units = ['B', 'KB', 'MB', 'GB'];
        $i = 0;
        while ($bytes >= 1024 && $i < count($units) - 1) {
            $bytes /= 1024;
            $i++;
        }
        return round($bytes, 2) . ' ' . $units[$i];
    }
}