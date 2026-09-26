<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use SplFileInfo;

class DetectEnglishTexts extends Command
{
    protected $signature = 'tanjona:detect-english-texts
                            {--path= : Dossier a analyser}
                            {--top=50 : Nombre de textes a afficher}';

    protected $description = 'Detecte UNIQUEMENT les vrais textes anglais visibles par l utilisateur';

    protected array $excludedDirs = [
        'vendor', 'node_modules', 'storage', 'bootstrap/cache',
        '.git', '.idea', '.vscode', 'public/build', 'public/hot',
    ];

    protected array $englishWords = [
        'save', 'cancel', 'delete', 'edit', 'update', 'create', 'add', 'remove',
        'submit', 'confirm', 'close', 'back', 'next', 'previous', 'search',
        'reset', 'clear', 'apply', 'download', 'upload', 'print', 'export',
        'import', 'login', 'logout', 'register', 'send', 'show', 'hide',
        'name', 'email', 'password', 'username', 'phone', 'address',
        'title', 'description', 'content', 'message', 'comment', 'note',
        'date', 'time', 'type', 'category', 'status', 'priority',
        'total', 'amount', 'price',
        'welcome', 'hello', 'thanks', 'thank', 'sorry',
        'error', 'warning', 'success', 'failed', 'invalid', 'required',
        'please', 'must', 'should', 'cannot', 'will', 'would',
        'not', 'found', 'access', 'denied', 'forbidden', 'unauthorized',
        'server', 'connection', 'network', 'timeout', 'expired',
        'missing', 'wrong', 'correct', 'try', 'again', 'later', 'soon', 'now',
        'home', 'dashboard', 'profile', 'settings', 'account', 'users',
        'admin', 'about', 'contact', 'help', 'support',
        'privacy', 'terms', 'legal', 'faq',
        'the', 'and', 'or', 'but', 'if', 'then', 'when', 'where', 'what',
        'which', 'who', 'why', 'how', 'this', 'that', 'these', 'those',
        'with', 'without', 'from', 'into', 'over', 'under', 'between',
    ];

    public function handle(): int
    {
        $this->renderHeader();

        $path = $this->option('path') ?: base_path();
        $top = (int) $this->option('top');

        if (!is_dir($path)) {
            $this->error("[X] Dossier introuvable : {$path}");
            return self::FAILURE;
        }

        $this->line("Analyse de : {$path}");
        $this->newLine();

        $files = $this->findFiles($path);
        $this->line(count($files) . ' fichier(s) a analyser');
        $this->newLine();

        $results = [];

        foreach ($files as $filePath) {
            $content = @file_get_contents($filePath);
            if ($content === false) continue;

            $relative = str_replace(base_path() . DIRECTORY_SEPARATOR, '', $filePath);
            $relative = str_replace('\\', '/', $relative);

            $ext = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));
            $strings = $this->extractStrings($content, $ext);

            foreach ($strings as $str) {
                $str = trim($str);
                if (strlen($str) < 8 || strlen($str) > 300) continue;

                if ($this->looksLikeCode($str)) continue;

                preg_match_all('/\b[a-zA-Z]{3,}\b/', $str, $words);
                if (empty($words[0])) continue;

                $words = array_map('strtolower', $words[0]);
                $englishCount = 0;
                $totalWords = count($words);

                foreach ($words as $word) {
                    if (in_array($word, $this->englishWords)) {
                        $englishCount++;
                    }
                }

                if ($englishCount >= 2 && ($englishCount / $totalWords) >= 0.3) {
                    $results[] = [
                        'file' => $relative,
                        'text' => $str,
                        'english' => $englishCount,
                    ];
                }
            }
        }

        if (empty($results)) {
            $this->info('[OK] Aucun texte anglais visible detecte.');
            return self::SUCCESS;
        }

        $byFile = [];
        foreach ($results as $r) {
            $byFile[$r['file']][] = $r;
        }

        uasort($byFile, fn($a, $b) => count($b) <=> count($a));

        $this->line('+------------------------------------------------------+');
        $this->line('|   TEXTES ANGLAIS DETECTES                            |');
        $this->line('+------------------------------------------------------+');
        $this->line('|   Textes distincts : ' . str_pad((string) count($results), 32) . '|');
        $this->line('|   Fichiers touches : ' . str_pad((string) count($byFile), 32) . '|');
        $this->line('+------------------------------------------------------+');
        $this->newLine();

        $shown = 0;
        foreach ($byFile as $file => $texts) {
            if ($shown >= $top) break;

            $this->line("FICHIER : {$file}  (" . count($texts) . " texte(s))");
            foreach (array_slice($texts, 0, 10) as $t) {
                $text = strlen($t['text']) > 90 ? substr($t['text'], 0, 87) . '...' : $t['text'];
                $this->line("   [{$t['english']}] \"{$text}\"");
                $shown++;
                if ($shown >= $top) break;
            }
            $this->newLine();
        }

        return self::SUCCESS;
    }

    protected function looksLikeCode(string $str): bool
    {
        if (preg_match('/[{};<>\[\]\\\\]/', $str)) return true;
        if (preg_match('/\$\w+/', $str)) return true;
        if (preg_match('/->|::/', $str)) return true;
        if (preg_match('/\w+\(/', $str)) return true;
        if (preg_match('/=\s*[\'"]?/', $str)) return true;
        if (preg_match('/\b(function|class|return|public|private|protected|static|new|use|namespace)\b/i', $str)) return true;
        if (preg_match('/\b(if|else|foreach|while|for|switch|case|break|continue)\b/i', $str)) return true;

        $codeChars = preg_match_all('/[{}()\[\];:,<>=!+\-*\/\\\\|&%$#@]/', $str);
        if ($codeChars > strlen($str) / 4) return true;

        return false;
    }

    protected function extractStrings(string $content, string $ext): array
    {
        $strings = [];

        $isBlade = str_contains($content, '@extends')
                || str_contains($content, '@section')
                || str_contains($content, '@if')
                || str_contains($content, '@foreach');

        if ($isBlade) {
            if (preg_match_all('/>([^<>{}@]{8,300})</', $content, $m)) {
                $strings = array_merge($strings, $m[1]);
            }
            if (preg_match_all('/(?:placeholder|title|label|alt|aria-label)\s*=\s*[\'"]([^\'"]{8,200})[\'"]/', $content, $m)) {
                $strings = array_merge($strings, $m[1]);
            }
        }

        if ($ext === 'php') {
            if (preg_match_all('/[\'"]([A-Z][a-zA-Z\s,\.!\?\'\-]{7,200})[\'"]/', $content, $m)) {
                $strings = array_merge($strings, $m[1]);
            }
            if (preg_match_all('/->with\(\s*[\'"][^\'"]+[\'"]\s*,\s*[\'"]([^\'"]{8,200})[\'"]/', $content, $m)) {
                $strings = array_merge($strings, $m[1]);
            }
        }

        return array_unique($strings);
    }

    protected function findFiles(string $path): array
    {
        $files = [];
        $basePath = base_path();

        $iterator = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator($path, RecursiveDirectoryIterator::SKIP_DOTS)
        );

        foreach ($iterator as $file) {
            /** @var SplFileInfo $file */
            if (!$file->isFile()) continue;

            $relative = str_replace($basePath . DIRECTORY_SEPARATOR, '', $file->getPathname());
            $relative = str_replace('\\', '/', $relative);

            foreach ($this->excludedDirs as $excluded) {
                if (str_starts_with($relative, $excluded . '/') || str_contains($relative, '/' . $excluded . '/')) {
                    continue 2;
                }
            }

            $fn = $file->getFilename();
            if (str_contains($fn, '.bak.') || str_ends_with($fn, '.log')
                || str_ends_with($fn, '.cache') || str_ends_with($fn, '.lock')) {
                continue;
            }

            $ext = strtolower($file->getExtension());
            $isBlade = str_ends_with(strtolower($fn), '.blade.php');

            if ($ext !== 'php' && !$isBlade) continue;

            $files[] = $file->getPathname();
        }

        return array_unique($files);
    }

    protected function renderHeader(): void
    {
        $this->newLine();
        $this->line('+------------------------------------------------------+');
        $this->line('|   TANJONA - DETECTION DES TEXTES ANGLAIS             |');
        $this->line('|   ' . str_pad(now()->format('Y-m-d H:i:s'), 50) . ' |');
        $this->line('+------------------------------------------------------+');
        $this->newLine();
    }
}