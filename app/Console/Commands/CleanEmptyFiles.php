<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use SplFileInfo;

class CleanEmptyFiles extends Command
{
    /**
     * Le nom et la signature de la commande.
     */
    protected $signature = 'files:clean-empty
                            {--dry-run : Afficher les fichiers qui seraient supprimés sans rien supprimer}
                            {--force : Ne pas demander de confirmation}
                            {--path= : Dossier à analyser (défaut : tout le projet sauf exclusions)}
                            {--backup : Créer une sauvegarde .bak avant suppression (uniquement pour les vides)}
                            {--with-backups : Supprimer aussi les fichiers de sauvegarde (.bak, .old, .orig, etc.)}
                            {--backups-only : Supprimer UNIQUEMENT les fichiers de sauvegarde}';

    /**
     * La description de la commande.
     */
    protected $description = 'Supprime les fichiers PHP vides (0 octet) non référencés et/ou les fichiers de sauvegarde (.bak, .old, .orig, ...)';

    /**
     * Dossiers à TOUJOURS ignorer.
     */
    protected array $excludedDirs = [
        'vendor',
        'node_modules',
        'bootstrap/cache',
        '.git',
        '.idea',
        '.vscode',
    ];

    /**
     * Dossiers où chercher les références (pour la détection des fichiers utilisés).
     */
    protected array $searchDirs = [
        'app',
        'routes',
        'config',
        'bootstrap',
        'database',
        'tests',
        'resources/views',
    ];

    /**
     * Noms de fichiers à TOUJOURS protéger, même s'ils sont vides.
     */
    protected array $protectedFiles = [
        'HexagonalServiceProvider.php',
        'AppServiceProvider.php',
        'AuthServiceProvider.php',
        'EventServiceProvider.php',
        'RouteServiceProvider.php',
        'BroadcastServiceProvider.php',
        'config/hexagonal.php',
        'bootstrap/app.php',
        'public/index.php',
        'artisan',
        '.env',
        '.env.example',
    ];

    /**
     * Motifs de fichiers de sauvegarde à détecter.
     */
    protected array $backupPatterns = [
        '/\.bak$/i',              // fichier.bak
        '/\.bak\..+$/i',          // fichier.php.bak.2026-09-21_094927
        '/\.old$/i',              // fichier.old
        '/\.orig$/i',             // fichier.orig
        '/\.save$/i',             // fichier.save
        '/\.swp$/i',              // fichier.swp (Vim)
        '/\.swo$/i',              // fichier.swo (Vim)
        '/~$/',                   // fichier~ (éditeurs)
        '/\.copy$/i',             // fichier.copy
        '/\.backup$/i',           // fichier.backup
    ];

    public function handle(): int
    {
        $basePath      = base_path();
        $dryRun        = (bool) $this->option('dry-run');
        $force         = (bool) $this->option('force');
        $backup        = (bool) $this->option('backup');
        $withBackups   = (bool) $this->option('with-backups');
        $backupsOnly   = (bool) $this->option('backups-only');

        // Si --backups-only, on force la suppression des backups et on ignore les vides
        if ($backupsOnly) {
            $withBackups = true;
        }

        // Déterminer la racine d'analyse
        $pathOption = $this->option('path');
        $scanPath   = $pathOption
            ? $basePath . DIRECTORY_SEPARATOR . ltrim($pathOption, '/\\')
            : $basePath;

        if (!is_dir($scanPath)) {
            $this->error("[X] Le dossier n'existe pas : {$scanPath}");
            return self::FAILURE;
        }

        $this->info("[SEARCH] Analyse du dossier : {$scanPath}");
        $this->newLine();

        // ============================================================
        // 1. FICHIERS DE SAUVEGARDE (.bak, .old, .orig, ...)
        // ============================================================
        $backupFiles = [];
        if ($withBackups) {
            $backupFiles = $this->findBackupFiles($scanPath, $basePath);
        }

        // ============================================================
        // 2. FICHIERS VIDES (0 octet) NON RÉFÉRENCÉS
        // ============================================================
        $safeEmpty      = [];
        $referencedEmpty = [];
        if (!$backupsOnly) {
            $emptyFiles = $this->findEmptyFiles($scanPath, $basePath);
            [$safeEmpty, $referencedEmpty] = $this->partitionByReferences($emptyFiles, $basePath);
        }

        // ============================================================
        // 3. RAPPORT
        // ============================================================
        $this->renderReport($safeEmpty, $referencedEmpty, $backupFiles, $dryRun);

        $totalToDelete = count($safeEmpty) + count($backupFiles);

        if ($totalToDelete === 0) {
            $this->info('[OK] Aucun fichier à supprimer.');
            return self::SUCCESS;
        }

        if ($dryRun) {
            $this->warn('🛈 Mode --dry-run : aucun fichier n\'a été supprimé.');
            return self::SUCCESS;
        }

        // ============================================================
        // 4. CONFIRMATION
        // ============================================================
        if (!$force && !$this->confirm(
            sprintf('[!]️  Supprimer %d fichier(s) ? (%d vide(s) + %d backup(s))',
                $totalToDelete, count($safeEmpty), count($backupFiles)),
            false
        )) {
            $this->info('Opération annulée.');
            return self::SUCCESS;
        }

        // ============================================================
        // 5. SUPPRESSION
        // ============================================================
        $deleted = 0;
        $failed  = 0;

        // 5a. Fichiers vides (avec backup optionnel)
        foreach ($safeEmpty as $file) {
            try {
                if ($backup) {
                    copy($file, $file . '.bak.' . date('Y-m-d_H-i-s'));
                }
                if (@unlink($file)) {
                    $this->line("  [DEL]️  [vide]   " . $this->relative($file, $basePath));
                    $deleted++;
                } else {
                    $this->error("  [X] Échec : " . $this->relative($file, $basePath));
                    $failed++;
                }
            } catch (\Throwable $e) {
                $this->error("  [X] Erreur sur {$file} : {$e->getMessage()}");
                $failed++;
            }
        }

        // 5b. Fichiers de sauvegarde (suppression directe, pas de re-backup)
        foreach ($backupFiles as $file) {
            try {
                if (@unlink($file)) {
                    $this->line("  [DEL]️  [backup] " . $this->relative($file, $basePath));
                    $deleted++;
                } else {
                    $this->error("  [X] Échec : " . $this->relative($file, $basePath));
                    $failed++;
                }
            } catch (\Throwable $e) {
                $this->error("  [X] Erreur sur {$file} : {$e->getMessage()}");
                $failed++;
            }
        }

        // ============================================================
        // 6. NETTOYAGE DES DOSSIERS VIDES
        // ============================================================
        $removedDirs = $this->removeEmptyDirs($scanPath);

        $this->newLine();
        $this->info("[OK] {$deleted} fichier(s) supprimé(s).");
        if ($removedDirs > 0) {
            $this->info("[OK] {$removedDirs} dossier(s) vide(s) supprimé(s).");
        }
        if ($failed > 0) {
            $this->warn("[!]️  {$failed} échec(s).");
        }

        return self::SUCCESS;
    }

    // =================================================================
    // DÉTECTION DES FICHIERS
    // =================================================================

    /**
     * Trouve tous les fichiers de sauvegarde (.bak, .old, .orig, ...).
     */
    protected function findBackupFiles(string $scanPath, string $basePath): array
    {
        $result = [];
        $iterator = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator($scanPath, RecursiveDirectoryIterator::SKIP_DOTS),
            RecursiveIteratorIterator::LEAVES_ONLY
        );

        foreach ($iterator as $file) {
            /** @var SplFileInfo $file */
            if (!$file->isFile()) {
                continue;
            }

            $relative = $this->relative($file->getPathname(), $basePath);

            if ($this->isExcluded($relative)) {
                continue;
            }

            // Protéger les fichiers critiques même s'ils matchent un pattern
            if ($this->isProtected($relative)) {
                continue;
            }

            if ($this->isBackupFile($file->getFilename())) {
                $result[] = $file->getPathname();
            }
        }

        sort($result);
        return $result;
    }

    /**
     * Vérifie si un nom de fichier correspond à un motif de backup.
     */
    protected function isBackupFile(string $filename): bool
    {
        foreach ($this->backupPatterns as $pattern) {
            if (preg_match($pattern, $filename)) {
                return true;
            }
        }
        return false;
    }

    /**
     * Retourne la liste des fichiers vides (0 octet) non exclus.
     */
    protected function findEmptyFiles(string $scanPath, string $basePath): array
    {
        $result = [];
        $iterator = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator($scanPath, RecursiveDirectoryIterator::SKIP_DOTS),
            RecursiveIteratorIterator::LEAVES_ONLY
        );

        foreach ($iterator as $file) {
            /** @var SplFileInfo $file */
            if (!$file->isFile()) {
                continue;
            }

            $relative = $this->relative($file->getPathname(), $basePath);

            if ($this->isExcluded($relative)) {
                continue;
            }

            // Uniquement les vrais vides (0 octet)
            if ($file->getSize() !== 0) {
                continue;
            }

            // Ne traiter que les fichiers PHP
            if (strtolower($file->getExtension()) !== 'php') {
                continue;
            }

            // Ignorer les fichiers de sauvegarde (traités séparément)
            if ($this->isBackupFile($file->getFilename())) {
                continue;
            }

            // Fichier protégé ?
            if ($this->isProtected($relative)) {
                continue;
            }

            $result[] = $file->getPathname();
        }

        sort($result);
        return $result;
    }

    /**
     * Vérifie si un chemin est dans un dossier exclu.
     */
    protected function isExcluded(string $relative): bool
    {
        // Normaliser les séparateurs
        $normalized = str_replace('\\', '/', $relative);

        foreach ($this->excludedDirs as $excluded) {
            $excluded = str_replace('\\', '/', $excluded);
            if (str_starts_with($normalized, $excluded . '/') ||
                str_contains($normalized, '/' . $excluded . '/')) {
                return true;
            }
        }
        return false;
    }

    // =================================================================
    // DÉTECTION DES RÉFÉRENCES
    // =================================================================

    /**
     * Sépare les fichiers vides en deux groupes : safe vs referenced.
     */
    protected function partitionByReferences(array $files, string $basePath): array
    {
        $safe       = [];
        $referenced = [];

        foreach ($files as $file) {
            $className = pathinfo($file, PATHINFO_FILENAME);

            if ($this->isReferenced($className, $file, $basePath)) {
                $referenced[] = $file;
            } else {
                $safe[] = $file;
            }
        }

        return [$safe, $referenced];
    }

    /**
     * Vérifie si le nom de classe est référencé dans le projet.
     */
    protected function isReferenced(string $className, string $currentFile, string $basePath): bool
    {
        foreach ($this->searchDirs as $dir) {
            $fullDir = $basePath . DIRECTORY_SEPARATOR . $dir;
            if (!is_dir($fullDir)) {
                continue;
            }

            $it = new RecursiveIteratorIterator(
                new RecursiveDirectoryIterator($fullDir, RecursiveDirectoryIterator::SKIP_DOTS),
                RecursiveIteratorIterator::LEAVES_ONLY
            );

            foreach ($it as $f) {
                /** @var SplFileInfo $f */
                if (!$f->isFile() || $f->getExtension() !== 'php') {
                    continue;
                }
                if ($f->getPathname() === $currentFile) {
                    continue;
                }

                $content = @file_get_contents($f->getPathname());
                if ($content === false) {
                    continue;
                }

                if (preg_match('/\b' . preg_quote($className, '/') . '\b/', $content)) {
                    return true;
                }
            }
        }

        return false;
    }

    /**
     * Vérifie si un fichier est protégé.
     */
    protected function isProtected(string $relative): bool
    {
        $normalized = str_replace('\\', '/', $relative);
        foreach ($this->protectedFiles as $p) {
            $p = str_replace('\\', '/', $p);
            if (str_ends_with($normalized, $p) || $normalized === $p) {
                return true;
            }
        }
        return false;
    }

    // =================================================================
    // NETTOYAGE DES DOSSIERS VIDES
    // =================================================================

    /**
     * Supprime les dossiers vides (récursivement).
     */
    protected function removeEmptyDirs(string $scanPath): int
    {
        $count = 0;
        // Plusieurs passes pour gérer l'imbrication
        do {
            $removed = 0;
            $iterator = new RecursiveIteratorIterator(
                new RecursiveDirectoryIterator($scanPath, RecursiveDirectoryIterator::SKIP_DOTS),
                RecursiveIteratorIterator::CHILD_FIRST
            );

            foreach ($iterator as $file) {
                /** @var SplFileInfo $file */
                if (!$file->isDir()) {
                    continue;
                }

                $path = $file->getPathname();
                $relative = $this->relative($path, base_path());

                if ($this->isExcluded($relative)) {
                    continue;
                }

                // Ne supprimer que si le dossier est vide
                $items = @scandir($path);
                if ($items !== false && count($items) === 2) { // . et ..
                    if (@rmdir($path)) {
                        $removed++;
                        $count++;
                    }
                }
            }
        } while ($removed > 0);

        return $count;
    }

    // =================================================================
    // AFFICHAGE
    // =================================================================

    /**
     * Affiche le rapport complet avant suppression.
     */
    protected function renderReport(array $safeEmpty, array $referencedEmpty, array $backupFiles, bool $dryRun): void
    {
        $basePath = base_path();

        // Fichiers vides référencés (protégés)
        if (!empty($referencedEmpty)) {
            $this->warn('[LOCK] Fichiers vides MAIS référencés (protégés, non supprimés) :');
            foreach ($referencedEmpty as $f) {
                $this->line('   * ' . $this->relative($f, $basePath));
            }
            $this->newLine();
        }

        // Fichiers vides safe
        if (!empty($safeEmpty)) {
            $title = $dryRun
                ? '🧪 Fichiers vides SÛRS à supprimer (simulation) :'
                : '[CLEAN] Fichiers vides SÛRS à supprimer :';
            $this->info($title);
            foreach ($safeEmpty as $f) {
                $this->line('   * ' . $this->relative($f, $basePath));
            }
            $this->newLine();
        }

        // Fichiers de sauvegarde
        if (!empty($backupFiles)) {
            $this->info('[SAVE] Fichiers de sauvegarde à supprimer :');
            foreach ($backupFiles as $f) {
                $this->line('   * ' . $this->relative($f, $basePath));
            }
            $this->newLine();
        }
    }

    /**
     * Chemin relatif à la racine du projet.
     */
    protected function relative(string $path, string $basePath): string
    {
        return ltrim(str_replace($basePath, '', $path), '/\\');
    }
}