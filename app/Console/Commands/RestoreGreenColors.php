<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class RestoreGreenColors extends Command
{
    protected $signature = 'restore:green-colors
                            {--dry-run : Afficher sans restaurer}
                            {--remove-baks : Supprimer les .bak après restauration}';

    protected $description = 'Restaure les couleurs vertes depuis les fichiers .bak';

    public function handle(): int
    {
        $this->line('');
        $this->line('+==========================================================+');
        $this->line('|   [THEME] RESTAURATION DES COULEURS VERTES                     |');
        $this->line('+==========================================================+');
        $this->line('');

        $dryRun = $this->option('dry-run');

        if ($dryRun) {
            $this->warn('[SEARCH] MODE DRY-RUN : aucune modification');
            $this->line('');
        }

        // ===============================================
        // 1. Trouver tous les backups dans resources/
        // ===============================================
        $this->line('> 1. Recherche des backups dans resources/');

        $dirs = [
            resource_path('views'),
            resource_path('css'),
            resource_path('js'),
        ];

        $backups = collect();
        foreach ($dirs as $dir) {
            if (!File::exists($dir)) continue;
            foreach (File::allFiles($dir) as $f) {
                if (preg_match('/\.bak\.\d{4}-\d{2}-\d{2}_\d{6}$/', $f->getFilename())) {
                    $backups->push($f);
                }
            }
        }

        if ($backups->isEmpty()) {
            $this->warn('   [!]️  Aucun backup trouvé dans resources/');
            $this->line('');
            $this->line('   -> Solutions alternatives :');
            $this->line('      1. VS Code History -> chercher les versions');
            $this->line('      2. Git -> git checkout');
            $this->line('      3. Inverser les couleurs rouge -> vert');

            if ($this->confirm('Voulez-vous inverser rouge -> vert à la place ?', true)) {
                return $this->reverseColors();
            }

            return self::FAILURE;
        }

        $this->info("   [OK] {$backups->count()} backup(s) trouvé(s)");
        $this->line('');

        // ===============================================
        // 2. Grouper par fichier original (garder le PLUS RÉCENT)
        // ===============================================
        $this->line('> 2. Groupement par fichier');

        $grouped = [];
        foreach ($backups as $b) {
            $original = preg_replace('/\.bak\.\d{4}-\d{2}-\d{2}_\d{6}$/', '', $b->getPathname());
            $grouped[$original][] = $b;
        }

        $this->info("   " . count($grouped) . " fichier(s) à restaurer");

        // ===============================================
        // 3. Restaurer
        // ===============================================
        $this->line('');
        $this->line('> 3. Restauration');

        $restored = 0;
        $errors = 0;

        foreach ($grouped as $original => $baks) {
            // Prendre le backup le plus récent
            $latest = collect($baks)->sortByDesc(fn($b) => $b->getMTime())->first();

            $relPath = str_replace(base_path() . DIRECTORY_SEPARATOR, '', $original);

            if (!$dryRun) {
                // Backup actuel au cas où
                if (File::exists($original)) {
                    File::copy($original, $original . '.red.bak.' . date('Y-m-d_His'));
                }

                // Restaurer depuis le .bak
                try {
                    File::copy($latest->getPathname(), $original);
                    $this->line("   [OK] {$relPath}");
                    $restored++;
                } catch (\Throwable $e) {
                    $this->line("   [X] {$relPath} : " . $e->getMessage());
                    $errors++;
                }
            } else {
                $this->line("   * {$relPath} <- " . $latest->getFilename());
                $restored++;
            }
        }

        // ===============================================
        // 4. Supprimer les .bak si demandé
        // ===============================================
        if ($this->option('remove-baks') && !$dryRun) {
            $this->line('');
            $this->line('> 4. Suppression des fichiers .bak');

            $deleted = 0;
            foreach ($backups as $b) {
                try {
                    File::delete($b->getPathname());
                    $deleted++;
                } catch (\Throwable $e) {}
            }
            $this->info("   [OK] {$deleted} fichier(s) .bak supprimé(s)");
        }

        // ===============================================
        // 5. Vider les caches
        // ===============================================
        if (!$dryRun) {
            $this->line('');
            $this->line('> 5. Vidage des caches');
            $this->call('view:clear');
            $this->call('optimize:clear');
            $this->info('   [OK] Caches vidés');
        }

        // Résumé
        $this->line('');
        $this->line('+==========================================================+');
        $this->line("|   [OK] {$restored} restauré(s) | [X] {$errors} erreur(s)");
        $this->line('+==========================================================+');
        $this->line('');

        if ($dryRun) {
            $this->warn('[SEARCH] DRY-RUN terminé. Relancez sans --dry-run pour appliquer.');
        } else {
            $this->info('[SUCCESS] RESTAURATION TERMINÉE !');
            $this->line('');
            $this->line('-> Testez : http://localhost:8000/admin/dashboard (Ctrl+F5)');
        }

        return self::SUCCESS;
    }

    /**
     * Inverser les couleurs ROUGE -> VERT (si aucun backup)
     */
    private function reverseColors(): int
    {
        $this->line('');
        $this->line('> Inversion ROUGE -> VERT');

        $colorMap = [
            // Tailwind Red -> Emerald
            'red-50'   => 'emerald-50',
            'red-100'  => 'emerald-100',
            'red-200'  => 'emerald-200',
            'red-300'  => 'emerald-300',
            'red-400'  => 'emerald-400',
            'red-500'  => 'emerald-500',
            'red-600'  => 'emerald-600',
            'red-700'  => 'emerald-700',
            'red-800'  => 'emerald-800',
            'red-900'  => 'emerald-900',

            // Hex Red -> Emerald
            '#dc2626' => '#059669',
            '#b91c1c' => '#047857',
            '#991b1b' => '#065f46',
            '#7f1d1d' => '#064e3b',
            '#ef4444' => '#10b981',
            '#f87171' => '#34d399',
            '#fca5a5' => '#6ee7b7',
            '#fecaca' => '#a7f3d0',
            '#fee2e2' => '#d1fae5',
            '#fef2f2' => '#ecfdf5',

            // RGB
            'rgba(220, 38, 38' => 'rgba(5, 150, 105',
            'rgba(185, 28, 28'  => 'rgba(4, 120, 87',
            'rgba(239, 68, 68'  => 'rgba(16, 185, 129',
            'rgba(127, 29, 29'  => 'rgba(6, 78, 59',
            'rgb(220, 38, 38)'  => 'rgb(5, 150, 105)',
            'rgb(239, 68, 68)'  => 'rgb(16, 185, 129)',
        ];

        $dirs = [
            resource_path('views'),
            resource_path('css'),
            resource_path('js'),
        ];

        $totalFiles = 0;
        $totalMods = 0;

        foreach ($dirs as $dir) {
            if (!File::exists($dir)) continue;

            foreach (File::allFiles($dir) as $file) {
                $ext = $file->getExtension();
                if (!in_array($ext, ['php', 'css', 'js'])) continue;
                if (str_contains($file->getFilename(), '.bak')) continue;
                if (str_contains($file->getFilename(), '.red.')) continue;

                $content = File::get($file->getPathname());
                $original = $content;
                $mods = 0;

                foreach ($colorMap as $from => $to) {
                    if (str_contains($content, $from)) {
                        $count = substr_count($content, $from);
                        $content = str_replace($from, $to, $content);
                        $mods += $count;
                    }
                }

                if ($content !== $original) {
                    $totalFiles++;
                    $totalMods += $mods;

                    // Backup
                    File::copy($file->getPathname(), $file->getPathname() . '.bak.' . date('Y-m-d_His'));
                    File::put($file->getPathname(), $content);

                    $relPath = str_replace(base_path() . DIRECTORY_SEPARATOR, '', $file->getPathname());
                    $this->line("   [OK] {$relPath} ({$mods} modif)");
                }
            }
        }

        $this->call('view:clear');
        $this->call('optimize:clear');

        $this->line('');
        $this->line("+==========================================================+");
        $this->line("|   [OK] {$totalFiles} fichiers | {$totalMods} modifications           |");
        $this->line('+==========================================================+');

        return self::SUCCESS;
    }
}