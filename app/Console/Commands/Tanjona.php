<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use SplFileInfo;

class Tanjona extends Command
{
    protected $signature = 'tanjona:clean-emojis {--dry-run} {--backup}';
    protected $description = 'Tanjona - Remplace les emojis par ASCII';

    protected array $map = [];

    public function __construct()
    {
        parent::__construct();
        $this->map = [
            "\u{2705}" => '[OK]',
            "\u{274C}" => '[X]',
            "\u{26A0}" => '[!]',
            "\u{1F534}" => '[RED]',
            "\u{1F7E2}" => '[GREEN]',
            "\u{1F535}" => '[BLUE]',
            "\u{1F4CB}" => '[LIST]',
            "\u{1F4C4}" => '[FILE]',
            "\u{1F4C1}" => '[DIR]',
            "\u{1F4E6}" => '[BOX]',
            "\u{1F4E4}" => '[EXPORT]',
            "\u{1F4CA}" => '[STATS]',
            "\u{1F4DD}" => '[NOTE]',
            "\u{1F4BE}" => '[SAVE]',
            "\u{1F50D}" => '[SEARCH]',
            "\u{1F512}" => '[LOCK]',
            "\u{1F527}" => '[TOOL]',
            "\u{1F5D1}" => '[DEL]',
            "\u{1F5C4}" => '[DB]',
            "\u{1F504}" => '[RELOAD]',
            "\u{1F517}" => '[LINK]',
            "\u{1F3AF}" => '[TARGET]',
            "\u{1F3A8}" => '[THEME]',
            "\u{1F389}" => '[SUCCESS]',
            "\u{26A1}" => '[AJAX]',
            "\u{1F9F9}" => '[CLEAN]',
            "\u{1F30D}" => '[WORLD]',
            "\u{1F449}" => '->',
            "\u{1F448}" => '<-',
            "\u{1F522}" => '[NUM]',
            "\u{2554}" => '+',
            "\u{2557}" => '+',
            "\u{255A}" => '+',
            "\u{255D}" => '+',
            "\u{2551}" => '|',
            "\u{2550}" => '=',
            "\u{2500}" => '-',
            "\u{2502}" => '|',
            "\u{250C}" => '+',
            "\u{2510}" => '+',
            "\u{2514}" => '+',
            "\u{2518}" => '+',
            "\u{251C}" => '+',
            "\u{2524}" => '+',
            "\u{252C}" => '+',
            "\u{2534}" => '+',
            "\u{253C}" => '+',
            "\u{250F}" => '+',
            "\u{2513}" => '+',
            "\u{2517}" => '+',
            "\u{251B}" => '+',
            "\u{2503}" => '|',
            "\u{2501}" => '=',
            "\u{2192}" => '->',
            "\u{2190}" => '<-',
            "\u{2191}" => '^',
            "\u{2193}" => 'v',
            "\u{27A1}" => '->',
            "\u{2B05}" => '<-',
            "\u{279C}" => '->',
            "\u{23ED}" => '>>',
            "\u{25B6}" => '>',
            "\u{2605}" => '*',
            "\u{2606}" => '*',
            "\u{2022}" => '*',
            "\u{25AA}" => '#',
            "\u{25A0}" => '#',
            "\u{25B2}" => '^',
            "\u{25BC}" => 'v',
            "\u{25C4}" => '<',
            "\u{25BA}" => '>',
            "\u{25CF}" => '*',
            "\u{2611}" => '[x]',
            "\u{2713}" => 'v',
            "\u{2714}" => 'v',
            "\u{2717}" => 'x',
            "\u{274E}" => '[X]',
            "\u{2757}" => '!',
            "\u{2753}" => '?',
            "\u{2014}" => '-',
            "\u{2013}" => '-',
            "\u{2026}" => '...',
        ];
    }

    public function handle(): int
    {
        $this->info('TANJONA - Nettoyage des emojis');
        $dryRun = (bool) $this->option('dry-run');
        $backup = (bool) $this->option('backup');
        $files = $this->findFiles();
        if (empty($files)) { $this->error('Aucun fichier.'); return 1; }
        $this->line(count($files) . ' fichier(s) a analyser');
        $changes = [];
        $total = 0;
        foreach ($files as $file) {
            $content = @file_get_contents($file);
            if ($content === false) continue;
            $original = $content;
            $count = 0;
            foreach ($this->map as $from => $to) {
                if (str_contains($content, $from)) {
                    $n = substr_count($content, $from);
                    $content = str_replace($from, $to, $content);
                    $count += $n;
                }
            }
            if ($content !== $original) {
                $rel = str_replace(base_path() . DIRECTORY_SEPARATOR, '', $file);
                $rel = str_replace('\\', '/', $rel);
                $changes[$rel] = $count;
                $total += $count;
                if (!$dryRun) {
                    if ($backup) copy($file, $file . '.bak.' . date('Y-m-d_H-i-s'));
                    file_put_contents($file, $content);
                }
            }
        }
        if (empty($changes)) { $this->info('[OK] Aucun emoji.'); return 0; }
        $this->line('Fichiers modifies: ' . count($changes));
        $this->line('Remplacements    : ' . $total);
        arsort($changes);
        foreach (array_slice($changes, 0, 15, true) as $f => $c) {
            $this->line("  {$c} x {$f}");
        }
        if ($dryRun) { $this->warn('Mode --dry-run'); return 0; }
        $this->info('[OK] ' . count($changes) . ' fichier(s) modifie(s).');
        return 0;
    }

    protected function findFiles(): array
    {
        $files = [];
        $basePath = base_path();
        $targets = ['app','routes','config','database','resources/views','resources/css','resources/js','public','tests'];
        $excluded = ['vendor','node_modules','storage/logs','storage/framework','bootstrap/cache','.git','.idea','.vscode','public/build','public/hot'];
        $exts = ['php','blade.php','js','ts','css','scss','json','md','txt','html','xml','yml','yaml'];
        foreach ($targets as $target) {
            $dir = $basePath . DIRECTORY_SEPARATOR . $target;
            if (!is_dir($dir)) continue;
            $it = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($dir, RecursiveDirectoryIterator::SKIP_DOTS));
            foreach ($it as $file) {
                if (!$file->isFile()) continue;
                $rel = str_replace($basePath . DIRECTORY_SEPARATOR, '', $file->getPathname());
                $rel = str_replace('\\', '/', $rel);
                foreach ($excluded as $ex) {
                    if (str_starts_with($rel, $ex . '/') || str_contains($rel, '/' . $ex . '/')) continue 2;
                }
                $fn = $file->getFilename();
                if (str_contains($fn, '.bak.') || str_ends_with($fn, '.log') || str_ends_with($fn, '.cache') || str_ends_with($fn, '.lock')) continue;
                $ok = false;
                foreach ($exts as $ext) {
                    if (str_ends_with(strtolower($fn), '.' . $ext)) { $ok = true; break; }
                }
                if (!$ok) continue;
                $files[] = $file->getPathname();
            }
        }
        return array_unique($files);
    }
}