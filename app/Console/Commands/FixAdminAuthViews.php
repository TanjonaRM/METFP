<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class FixAdminAuthViews extends Command
{
    protected $signature = 'views:fix-admin-auth
                            {--dry-run : Afficher les modifications sans les appliquer}
                            {--force : Ne pas demander de confirmation}';

    protected $description = 'Corrige les formulaires et liens des vues auth admin (login, register)';

    /**
     * Corrections par fichier.
     * On utilise des expressions régulières pour matcher toutes les variantes.
     */
    protected array $fixes = [
        'resources/views/auth/admin/login.blade.php' => [
            // Formulaire POST login (regex)
            [
                'pattern' => '/<form(\s+[^>]*action\s*=\s*["\']\{\{\s*route\([\'"]admin\.login[\'"]\)\s*\}\}["\'][^>]*)>/i',
                'replace' => '<form$1>',
                'transform' => true,
            ],
        ],

        'resources/views/auth/admin/register.blade.php' => [
            // Formulaire POST register (regex)
            [
                'pattern' => '/(<form\b[^>]*action\s*=\s*["\'])(\{\{\s*route\([\'"]admin\.register[\'"]\)\s*\}\})(["\'][^>]*>)/i',
                'replace' => '$1{{ route(\'admin.register.submit\') }}$3',
                'transform' => false,
            ],
            // Bug lien "S'inscrire" : formateur.register -> admin.register
            [
                'pattern' => '/(<a\b[^>]*href\s*=\s*["\'])\{\{\s*route\([\'"]formateur\.register[\'"]\)\s*\}\}(["\'][^>]*>\s*S\'inscrire)/i',
                'replace' => '$1{{ route(\'admin.register\') }}$2',
                'transform' => false,
            ],
        ],
    ];

    public function handle(): int
    {
        $this->renderHeader();

        $dryRun = (bool) $this->option('dry-run');
        $force  = (bool) $this->option('force');

        $changes = [];

        foreach ($this->fixes as $relPath => $fixes) {
            $fullPath = base_path($relPath);

            if (!file_exists($fullPath)) {
                $this->warn("[!]️  Fichier introuvable : {$relPath}");
                continue;
            }

            $content  = file_get_contents($fullPath);
            $original = $content;

            foreach ($fixes as $fix) {
                $newContent = preg_replace($fix['pattern'], $fix['replace'], $content);

                if ($newContent !== null && $newContent !== $content) {
                    // Compter combien de fois
                    $count = 0;
                    preg_match_all($fix['pattern'], $content, $m);
                    $count = count($m[0]);

                    $changes[] = [
                        'file'   => $relPath,
                        'before' => 'pattern: ' . $fix['pattern'],
                        'after'  => 'replace: ' . $fix['replace'],
                        'count'  => $count,
                    ];

                    $content = $newContent;
                }
            }

            if ($content !== $original && !$dryRun) {
                copy($fullPath, $fullPath . '.bak.' . date('Y-m-d_H-i-s'));
                file_put_contents($fullPath, $content);
            }
        }

        if (empty($changes)) {
            $this->info('[OK] Aucune modification nécessaire.');
            return self::SUCCESS;
        }

        $this->warn('[NOTE] ' . count($changes) . ' modification(s) :');
        $this->newLine();

        foreach ($changes as $c) {
            $this->line("  [FILE] <fg=cyan>{$c['file']}</> ({$c['count']}x)");
            $this->line("     [X] avant : {$c['before']}");
            $this->line("     [OK] après : {$c['after']}");
            $this->newLine();
        }

        if ($dryRun) {
            $this->warn('🛈 Mode --dry-run : aucune modification appliquée.');
            return self::SUCCESS;
        }

        $this->info('[OK] Modification(s) appliquée(s).');
        $this->newLine();
        $this->line('[TARGET] Prochaines étapes :');
        $this->line('   1. php artisan view:clear');
        $this->line('   2. php artisan project:check');
        $this->line('   3. Testez http://127.0.0.1:8000/admin/login');

        return self::SUCCESS;
    }

    protected function renderHeader(): void
    {
        $this->newLine();
        $this->line('+======================================================+');
        $this->line('|   CORRECTION DES VUES AUTH ADMIN                     |');
        $this->line('+======================================================+');
        $this->newLine();
    }
}