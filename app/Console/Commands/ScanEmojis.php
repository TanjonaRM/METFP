<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use SplFileInfo;

class ScanEmojis extends Command
{
    protected $signature = 'code:scan-emojis
                            {--path= : Dossier à analyser (défaut : tout le projet)}
                            {--export= : Exporter le rapport en CSV (chemin du fichier)}
                            {--group=file : Grouper le rapport (file|emoji)}';

    protected $description = 'Inventorie tous les emojis présents dans le projet sans rien modifier';

    /**
     * Dossiers à TOUJOURS ignorer.
     */
    protected array $excludedDirs = [
        'vendor',
        'node_modules',
        'storage',
        'bootstrap/cache',
        '.git',
        '.idea',
        '.vscode',
        'public/build',
        'public/hot',
    ];

    /**
     * Extensions à analyser.
     */
    protected array $extensions = [
        'php',
        'blade.php',
        'js',
        'ts',
        'css',
        'scss',
        'json',
        'md',
        'env',
        'yml',
        'yaml',
        'xml',
        'txt',
    ];

    /**
     * Détecte si un caractère est un emoji.
     * Couvre les plages Unicode principales.
     */
    protected function isEmoji(string $char): bool
    {
        $code = mb_ord($char, 'UTF-8');
        if ($code === false) {
            return false;
        }

        return (
            // Symboles et pictogrammes
            ($code >= 0x1F300 && $code <= 0x1F9FF) ||   // Emojis principaux
            ($code >= 0x1FA00 && $code <= 0x1FAFF) ||   // Emojis récents
            ($code >= 0x2600  && $code <= 0x27BF)  ||   // Symboles divers
            ($code >= 0x2190  && $code <= 0x21FF)  ||   // Flèches
            ($code >= 0x2300  && $code <= 0x23FF)  ||   // Symboles techniques
            ($code >= 0x2500  && $code <= 0x257F)  ||   // Bordures de cadre
            ($code >= 0x25A0  && $code <= 0x25FF)  ||   // Formes géométriques
            ($code >= 0x2000  && $code <= 0x206F)  ||   // Ponctuation générale
            in_array($code, [0x2705, 0x274C, 0x2757, 0x26A0]) // Emojis spécifiques
        );
    }

    /**
     * Récupère les emojis d'une chaîne.
     */
    protected function extractEmojis(string $text): array
    {
        $emojis = [];
        $length = mb_strlen($text, 'UTF-8');

        for ($i = 0; $i < $length; $i++) {
            $char = mb_substr($text, $i, 1, 'UTF-8');
            if ($this->isEmoji($char)) {
                $emojis[] = $char;
            }
        }

        return $emojis;
    }

    public function handle(): int
    {
        $this->renderHeader();

        $basePath = base_path();
        $pathOption = $this->option('path');
        $scanPath = $pathOption
            ? $basePath . DIRECTORY_SEPARATOR . ltrim($pathOption, '/\\')
            : $basePath;

        if (!is_dir($scanPath)) {
            $this->error("Dossier introuvable : {$scanPath}");
            return self::FAILURE;
        }

        $this->line("Scan en cours...");
        $this->newLine();

        $files = $this->findFiles($scanPath, $basePath);

        $this->line("  " . count($files) . " fichier(s) à analyser");
        $this->newLine();

        $byFile  = [];
        $byEmoji = [];
        $total   = 0;

        $bar = $this->output->createProgressBar(count($files));
        $bar->start();

        foreach ($files as $file) {
            $content = @file_get_contents($file);
            if ($content === false) {
                $bar->advance();
                continue;
            }

            $lines = explode("\n", $content);
            $relative = str_replace($basePath . DIRECTORY_SEPARATOR, '', $file);
            $relative = str_replace('\\', '/', $relative);

            foreach ($lines as $lineNum => $line) {
                $emojis = $this->extractEmojis($line);
                if (empty($emojis)) {
                    continue;
                }

                foreach ($emojis as $emoji) {
                    $total++;
                    $byFile[$relative][] = [
                        'line'  => $lineNum + 1,
                        'emoji' => $emoji,
                        'code'  => 'U+' . strtoupper(dechex(mb_ord($emoji, 'UTF-8'))),
                        'text'  => trim($line),
                    ];
                    $byEmoji[$emoji] = ($byEmoji[$emoji] ?? 0) + 1;
                }
            }

            $bar->advance();
        }

        $bar->finish();
        $this->newLine(2);

        if ($total === 0) {
            $this->info('[OK] Aucun emoji trouvé dans le projet.');
            return self::SUCCESS;
        }

        // ============================================================
        // RAPPORT
        // ============================================================
        $this->renderSummary($total, $byFile, $byEmoji);

        $group = $this->option('group');

        if ($group === 'emoji') {
            $this->renderByEmoji($byEmoji, $byFile);
        } else {
            $this->renderByFile($byFile);
        }

        // ============================================================
        // EXPORT CSV
        // ============================================================
        if ($export = $this->option('export')) {
            $this->exportCsv($export, $byFile);
        }

        return self::SUCCESS;
    }

    /**
     * Affiche le résumé global.
     */
    protected function renderSummary(int $total, array $byFile, array $byEmoji): void
    {
        $this->line('+------------------------------------------------------+');
        $this->line('|   RESUME DU SCAN                                     |');
        $this->line('+------------------------------------------------------+');
        $this->line("|   Total emojis trouves   : " . str_pad((string) $total, 25) . '|');
        $this->line("|   Fichiers concernes     : " . str_pad((string) count($byFile), 25) . '|');
        $this->line("|   Emojis distincts       : " . str_pad((string) count($byEmoji), 25) . '|');
        $this->line('+------------------------------------------------------+');
        $this->newLine();

        // Top emojis
        arsort($byEmoji);
        $top = array_slice($byEmoji, 0, 10, true);

        $this->line('TOP 10 EMOJIS LES PLUS UTILISES :');
        foreach ($top as $emoji => $count) {
            $code = 'U+' . strtoupper(dechex(mb_ord($emoji, 'UTF-8')));
            $this->line("   {$emoji}   {$code}   x {$count}");
        }
        $this->newLine();
    }

    /**
     * Affiche le rapport groupé par fichier.
     */
    protected function renderByFile(array $byFile): void
    {
        $this->line('+------------------------------------------------------+');
        $this->line('|   DETAIL PAR FICHIER                                 |');
        $this->line('+------------------------------------------------------+');
        $this->newLine();

        ksort($byFile);

        foreach ($byFile as $file => $items) {
            $this->line("FICHIER : {$file}");
            $this->line("  ({$this->countItems($items)} emoji(s))");

            foreach ($items as $item) {
                $this->line("  Ligne {$item['line']}  [{$item['emoji']}]  {$item['code']}");
            }
            $this->newLine();
        }
    }

    /**
     * Affiche le rapport groupé par emoji.
     */
    protected function renderByEmoji(array $byEmoji, array $byFile): void
    {
        $this->line('+------------------------------------------------------+');
        $this->line('|   DETAIL PAR EMOJI                                   |');
        $this->line('+------------------------------------------------------+');
        $this->newLine();

        arsort($byEmoji);

        foreach ($byEmoji as $emoji => $count) {
            $code = 'U+' . strtoupper(dechex(mb_ord($emoji, 'UTF-8')));
            $this->line("EMOJI : {$emoji}  ({$code})  x{$count}");

            foreach ($byFile as $file => $items) {
                foreach ($items as $item) {
                    if ($item['emoji'] === $emoji) {
                        $this->line("  {$file}:{$item['line']}");
                    }
                }
            }
            $this->newLine();
        }
    }

    /**
     * Exporte le rapport en CSV.
     */
    protected function exportCsv(string $path, array $byFile): void
    {
        $fullPath = base_path($path);

        $fp = fopen($fullPath, 'w');
        if ($fp === false) {
            $this->error("Impossible d'écrire dans : {$fullPath}");
            return;
        }

        // BOM UTF-8 pour Excel
        fwrite($fp, "\xEF\xBB\xBF");

        fputcsv($fp, ['Fichier', 'Ligne', 'Emoji', 'Code Unicode', 'Contenu de la ligne']);

        foreach ($byFile as $file => $items) {
            foreach ($items as $item) {
                fputcsv($fp, [
                    $file,
                    $item['line'],
                    $item['emoji'],
                    $item['code'],
                    mb_substr($item['text'], 0, 200),
                ]);
            }
        }

        fclose($fp);

        $this->newLine();
        $this->info("[OK] Rapport CSV exporté : {$fullPath}");
    }

    /**
     * Compte les items uniques par ligne.
     */
    protected function countItems(array $items): int
    {
        return count($items);
    }

    /**
     * Trouve tous les fichiers à analyser.
     */
    protected function findFiles(string $scanPath, string $basePath): array
    {
        $files = [];
        $iterator = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator($scanPath, RecursiveDirectoryIterator::SKIP_DOTS)
        );

        foreach ($iterator as $file) {
            /** @var SplFileInfo $file */
            if (!$file->isFile()) {
                continue;
            }

            $relative = str_replace($basePath . DIRECTORY_SEPARATOR, '', $file->getPathname());
            $relative = str_replace('\\', '/', $relative);

            // Ignorer les dossiers exclus
            foreach ($this->excludedDirs as $excluded) {
                if (str_starts_with($relative, $excluded . '/')
                    || str_contains($relative, '/' . $excluded . '/')) {
                    continue 2;
                }
            }

            // Ignorer les .bak et .log
            $filename = $file->getFilename();
            if (str_contains($filename, '.bak.') || str_ends_with($filename, '.log')) {
                continue;
            }

            // Vérifier l'extension
            $ext = $file->getExtension();
            if (!in_array($ext, $this->extensions)) {
                continue;
            }

            $files[] = $file->getPathname();
        }

        sort($files);
        return $files;
    }

    protected function renderHeader(): void
    {
        $this->newLine();
        $this->line('+------------------------------------------------------+');
        $this->line('|   INVENTAIRE DES EMOJIS DU PROJET                    |');
        $this->line('|   ' . str_pad(now()->format('Y-m-d H:i:s'), 50) . ' |');
        $this->line('+------------------------------------------------------+');
        $this->newLine();
    }
}