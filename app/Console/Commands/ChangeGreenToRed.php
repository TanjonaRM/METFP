<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class ChangeGreenToRed extends Command
{
    protected $signature = 'change:green-to-red
                            {--dry-run : Afficher sans modifier}
                            {--only= : Limiter à un dossier (views, css, resources)}';

    protected $description = 'Remplace toutes les couleurs vertes par du rouge';

    /**
     * Mapping des couleurs vertes -> rouges
     */
    protected array $colorMap = [
        // ===============================================
        // TAILWIND - Émeraude -> Rouge
        // ===============================================
        'emerald-50'   => 'red-50',
        'emerald-100'  => 'red-100',
        'emerald-200'  => 'red-200',
        'emerald-300'  => 'red-300',
        'emerald-400'  => 'red-400',
        'emerald-500'  => 'red-500',
        'emerald-600'  => 'red-600',
        'emerald-700'  => 'red-700',
        'emerald-800'  => 'red-800',
        'emerald-900'  => 'red-900',

        // Vert (green) -> Rouge
        'green-50'   => 'red-50',
        'green-100'  => 'red-100',
        'green-200'  => 'red-200',
        'green-300'  => 'red-300',
        'green-400'  => 'red-400',
        'green-500'  => 'red-500',
        'green-600'  => 'red-600',
        'green-700'  => 'red-700',
        'green-800'  => 'red-800',
        'green-900'  => 'red-900',

        // Teal -> Rouge
        'teal-50'  => 'red-50',
        'teal-100' => 'red-100',
        'teal-200' => 'red-200',
        'teal-300' => 'red-300',
        'teal-400' => 'red-400',
        'teal-500' => 'red-500',
        'teal-600' => 'red-600',
        'teal-700' => 'red-700',

        // Lime -> Rouge
        'lime-50'  => 'red-50',
        'lime-100' => 'red-100',
        'lime-500' => 'red-500',
        'lime-600' => 'red-600',
        'lime-700' => 'red-700',

        // Brand (custom vert) -> Rouge
        'brand-50'  => 'red-50',
        'brand-100' => 'red-100',
        'brand-200' => 'red-200',
        'brand-300' => 'red-300',
        'brand-400' => 'red-400',
        'brand-500' => 'red-500',
        'brand-600' => 'red-600',
        'brand-700' => 'red-700',
        'brand-800' => 'red-800',
        'brand-900' => 'red-900',

        // ===============================================
        // HEX - Verts -> Rouges
        // ===============================================
        // Émeraude
        '#10b981' => '#dc2626',   // emerald-500 -> red-600
        '#059669' => '#dc2626',   // emerald-600 -> red-600
        '#047857' => '#b91c1c',   // emerald-700 -> red-700
        '#065f46' => '#991b1b',   // emerald-800 -> red-800
        '#064e3b' => '#7f1d1d',   // emerald-900 -> red-900
        '#34d399' => '#f87171',   // emerald-400 -> red-400
        '#6ee7b7' => '#fca5a5',   // emerald-300 -> red-300
        '#a7f3d0' => '#fecaca',   // emerald-200 -> red-200
        '#d1fae5' => '#fee2e2',   // emerald-100 -> red-100
        '#ecfdf5' => '#fef2f2',   // emerald-50  -> red-50

        // Green
        '#22c55e' => '#ef4444',   // green-500 -> red-500
        '#16a34a' => '#dc2626',   // green-600 -> red-600
        '#15803d' => '#b91c1c',   // green-700 -> red-700

        // Teal
        '#14b8a6' => '#ef4444',
        '#0d9488' => '#dc2626',

        // ===============================================
        // RGB - Verts -> Rouges
        // ===============================================
        'rgba(5, 150, 105' => 'rgba(220, 38, 38',
        'rgba(4, 120, 87'  => 'rgba(185, 28, 28',
        'rgba(16, 185, 129' => 'rgba(239, 68, 68',
        'rgba(6, 78, 59'   => 'rgba(127, 29, 29',
        'rgba(110, 231, 183' => 'rgba(252, 165, 165',
        'rgba(167, 243, 208' => 'rgba(254, 202, 202',
        'rgba(209, 250, 229' => 'rgba(254, 226, 226',
        'rgb(5, 150, 105)' => 'rgb(220, 38, 38)',
        'rgb(16, 185, 129)' => 'rgb(239, 68, 68)',
        'rgb(4, 120, 87)'  => 'rgb(185, 28, 28)',

        // ===============================================
        // CSS GRADIENTS
        // ===============================================
        'from-brand-500' => 'from-red-500',
        'to-brand-700'   => 'to-red-700',
        'from-brand-600' => 'from-red-600',
        'to-brand-800'   => 'to-red-800',
    ];

    public function handle(): int
    {
        $this->line('');
        $this->line('+==========================================================+');
        $this->line('|   [THEME] VERT -> ROUGE                                         |');
        $this->line('+==========================================================+');
        $this->line('');

        $dryRun = $this->option('dry-run');
        $only = $this->option('only');

        if ($dryRun) {
            $this->warn('[SEARCH] MODE DRY-RUN : aucune modification ne sera appliquée');
            $this->line('');
        }

        // Dossiers à scanner
        $dirs = [];
        if (!$only || $only === 'views') {
            $dirs[] = resource_path('views');
        }
        if (!$only || $only === 'css') {
            $dirs[] = resource_path('css');
        }
        if (!$only || $only === 'resources') {
            $dirs[] = resource_path();
        }

        $totalFiles = 0;
        $totalReplacements = 0;

        foreach ($dirs as $dir) {
            if (!File::exists($dir)) continue;

            $this->line("[DIR] " . str_replace(base_path(), '', $dir));

            foreach (File::allFiles($dir) as $file) {
                // Seulement .blade.php, .css, .js
                $ext = $file->getExtension();
                if (!in_array($ext, ['php', 'css', 'js'])) continue;
                if (str_contains($file->getFilename(), '.bak')) continue;

                $content = File::get($file->getPathname());
                $original = $content;
                $fileReplacements = 0;

                // Appliquer le mapping
                foreach ($this->colorMap as $from => $to) {
                    if (str_contains($content, $from)) {
                        $count = substr_count($content, $from);
                        $content = str_replace($from, $to, $content);
                        $fileReplacements += $count;
                    }
                }

                if ($content !== $original) {
                    $totalFiles++;
                    $totalReplacements += $fileReplacements;

                    $relPath = str_replace(base_path() . DIRECTORY_SEPARATOR, '', $file->getPathname());
                    $this->line("   [OK] {$relPath} ({$fileReplacements} modif)");

                    if (!$dryRun) {
                        // Backup
                        File::copy($file->getPathname(), $file->getPathname() . '.bak.' . date('Y-m-d_His'));
                        File::put($file->getPathname(), $content);
                    }
                }
            }
        }

        // Vider les caches
        if (!$dryRun) {
            $this->line('');
            $this->line('> Vidage des caches');
            $this->call('view:clear');
            $this->call('optimize:clear');
            $this->info('   [OK] Caches vidés');
        }

        // Résumé
        $this->line('');
        $this->line('+==========================================================+');
        $this->line("|   [STATS] {$totalFiles} fichiers | {$totalReplacements} modifications");
        $this->line('+==========================================================+');
        $this->line('');

        if ($dryRun) {
            $this->warn('[SEARCH] DRY-RUN terminé. Relancez sans --dry-run pour appliquer.');
        } else {
            $this->info('[SUCCESS] TERMINÉ !');
            $this->line('');
            $this->line('-> Testez : http://localhost:8000/admin/dashboard (Ctrl+F5)');
            $this->line('');
            $this->line('💡 Astuce : si vous voulez revenir en arrière, restaurez les .bak.');
        }

        return self::SUCCESS;
    }
}