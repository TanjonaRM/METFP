<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;

class WhereIsColumnUsed extends Command
{
    protected $signature = 'tanjona:where-column
                            {column : Nom de la colonne}
                            {--limit=30 : Nombre max de resultats}';

    protected $description = 'Affiche OU une colonne est utilisee dans le projet';

    protected array $excludedDirs = [
        'vendor', 'node_modules', 'storage', 'bootstrap/cache',
        '.git', '.idea', '.vscode', 'public/build',
    ];

    public function handle(): int
    {
        $column = $this->argument('column');
        $limit = (int) $this->option('limit');

        $this->newLine();
        $this->line('+------------------------------------------------------+');
        $this->line('|   TANJONA - OU EST UTILISEE LA COLONNE ?            |');
        $this->line('|   Colonne : ' . str_pad($column, 40) . ' |');
        $this->line('+------------------------------------------------------+');
        $this->newLine();

        $results = [];
        $iterator = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator(base_path(), RecursiveDirectoryIterator::SKIP_DOTS)
        );

        foreach ($iterator as $file) {
            if (!$file->isFile()) continue;

            $relative = str_replace(base_path() . DIRECTORY_SEPARATOR, '', $file->getPathname());
            $relative = str_replace('\\', '/', $relative);

            foreach ($this->excludedDirs as $excluded) {
                if (str_starts_with($relative, $excluded . '/')) continue 2;
            }

            $ext = strtolower($file->getExtension());
            if (!in_array($ext, ['php', 'js', 'html', 'json', 'md'])) continue;

            if (str_contains($file->getFilename(), '.bak.')) continue;

            $content = @file_get_contents($file->getPathname());
            if ($content === false) continue;

            $lines = explode("\n", $content);
            foreach ($lines as $num => $line) {
                if (stripos($line, $column) !== false) {
                    $results[] = [
                        'file' => $relative,
                        'line' => $num + 1,
                        'text' => trim(substr($line, 0, 120)),
                    ];
                }
            }
        }

        if (empty($results)) {
            $this->warn("[!] La colonne '{$column}' n'apparait NULLE PART.");
            $this->line('    -> Elle est probablement INUTILISEE.');
            return self::SUCCESS;
        }

        // Grouper par dossier
        $byFolder = [];
        foreach ($results as $r) {
            $parts = explode('/', $r['file']);
            $folder = $parts[0];
            if (count($parts) > 1) $folder = $parts[0] . '/' . $parts[1];
            $byFolder[$folder][] = $r;
        }

        $this->line("Trouve " . count($results) . " occurrence(s) dans " . count($byFolder) . " dossier(s)");
        $this->newLine();

        $shown = 0;
        foreach ($byFolder as $folder => $items) {
            if ($shown >= $limit) break;

            $this->line("DOSSIER : {$folder}  (" . count($items) . " occurrence(s))");
            foreach (array_slice($items, 0, 5) as $item) {
                $this->line("   {$item['file']}:{$item['line']}");
                $this->line("      {$item['text']}");
                $shown++;
                if ($shown >= $limit) break;
            }
            $this->newLine();
        }

        // Verdict
        $this->newLine();
        $byFolderKeys = array_keys($byFolder);

        $usefulFolders = ['app/Http', 'app/Models', 'app/Services', 'app/Console', 'resources/views', 'routes'];

        $useful = false;
        foreach ($usefulFolders as $uf) {
            foreach ($byFolderKeys as $k) {
                if (str_starts_with($k, $uf)) {
                    $useful = true;
                    break 2;
                }
            }
        }

        if ($useful) {
            $this->info("[OK] La colonne '{$column}' est UTILISEE dans le code.");
        } else {
            $this->warn("[!] La colonne '{$column}' n'apparait que dans des migrations/seeders.");
            $this->line("    -> Probablement INUTILISEE dans l'interface.");
        }

        return self::SUCCESS;
    }
}