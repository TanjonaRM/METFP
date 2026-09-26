<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use SplFileInfo;

class DetectEnglishWords extends Command
{
    protected $signature = 'tanjona:detect-english
                            {--path= : Dossier a analyser}
                            {--only-strings : Analyser uniquement les chaines de caracteres}
                            {--min=4 : Longueur minimum d\'un mot}
                            {--top=50 : Nombre de mots a afficher}';

    protected $description = 'Detecte les mots anglais dans le projet';

    protected array $excludedDirs = [
        'vendor', 'node_modules', 'storage', 'bootstrap/cache',
        '.git', '.idea', '.vscode', 'public/build', 'public/hot',
    ];

    /**
     * Mots anglais tres courants a detecter.
     */
    protected array $commonEnglishWords = [
        // Verbes
        'create', 'update', 'delete', 'edit', 'show', 'index', 'store', 'destroy',
        'get', 'post', 'put', 'patch', 'save', 'load', 'find', 'search', 'filter',
        'send', 'receive', 'return', 'redirect', 'validate', 'check', 'verify',
        'login', 'logout', 'register', 'reset', 'forgot', 'remember', 'refresh',
        'install', 'remove', 'enable', 'disable', 'start', 'stop', 'run', 'exec',
        'build', 'compile', 'deploy', 'publish', 'merge', 'commit', 'push', 'pull',
        'fetch', 'process', 'handle', 'apply', 'cancel', 'confirm', 'submit',
        'approve', 'reject', 'accept', 'deny', 'grant', 'revoke', 'assign',

        // Noms
        'user', 'admin', 'formateur', 'trainer', 'student', 'teacher', 'school',
        'name', 'email', 'password', 'token', 'session', 'cookie', 'header',
        'body', 'request', 'response', 'controller', 'model', 'view', 'route',
        'middleware', 'provider', 'service', 'repository', 'interface', 'trait',
        'class', 'method', 'function', 'property', 'variable', 'constant',
        'file', 'folder', 'directory', 'path', 'url', 'link', 'image', 'video',
        'document', 'report', 'export', 'import', 'upload', 'download',
        'status', 'state', 'type', 'category', 'tag', 'label', 'value',
        'title', 'description', 'content', 'body', 'message', 'error',
        'warning', 'info', 'success', 'failed', 'pending', 'active', 'inactive',
        'enabled', 'disabled', 'valid', 'invalid', 'null', 'empty', 'full',
        'list', 'item', 'element', 'object', 'array', 'string', 'number',
        'integer', 'boolean', 'float', 'double', 'date', 'time', 'datetime',
        'timestamp', 'duration', 'interval', 'period', 'range', 'limit',
        'offset', 'page', 'size', 'count', 'total', 'sum', 'average',
        'minimum', 'maximum', 'first', 'last', 'next', 'previous', 'current',
        'new', 'old', 'default', 'custom', 'public', 'private', 'protected',

        // Adjectifs
        'true', 'false', 'yes', 'no', 'on', 'off', 'open', 'closed',
        'available', 'unavailable', 'ready', 'busy', 'free', 'used',
        'required', 'optional', 'mandatory', 'allowed', 'forbidden',
        'important', 'urgent', 'normal', 'critical', 'high', 'low', 'medium',
        'small', 'large', 'big', 'little', 'short', 'long', 'wide', 'narrow',
        'fast', 'slow', 'quick', 'late', 'early', 'now', 'later', 'today',
        'tomorrow', 'yesterday',

        // Mots techniques Laravel
        'artisan', 'composer', 'php', 'laravel', 'eloquent', 'blade',
        'migration', 'seeder', 'factory', 'middleware', 'guard', 'policy',
        'gate', 'event', 'listener', 'job', 'queue', 'notification', 'mail',
        'cache', 'session', 'storage', 'filesystem', 'validation', 'authorization',
        'authentication', 'throttle', 'cors', 'csrf', 'xss', 'sql', 'http',
        'https', 'api', 'json', 'xml', 'csv', 'pdf', 'excel', 'word',

        // Mots vides anglais
        'the', 'and', 'or', 'but', 'if', 'else', 'then', 'when', 'where',
        'what', 'which', 'who', 'whose', 'why', 'how', 'this', 'that',
        'these', 'those', 'here', 'there', 'with', 'without', 'from', 'to',
        'in', 'on', 'at', 'by', 'for', 'of', 'about', 'into', 'over', 'under',
        'before', 'after', 'during', 'between', 'through', 'against',
    ];

    public function handle(): int
    {
        $this->renderHeader();

        $path = $this->option('path') ?: base_path();
        $onlyStrings = (bool) $this->option('only-strings');
        $minLength = (int) $this->option('min');
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

        $found = [];
        $byFile = [];

        foreach ($files as $file) {
            $content = @file_get_contents($file);
            if ($content === false) continue;

            $relative = str_replace(base_path() . DIRECTORY_SEPARATOR, '', $file);
            $relative = str_replace('\\', '/', $relative);

            // Si --only-strings, extraire uniquement les chaines entre quotes
            if ($onlyStrings) {
                preg_match_all('/[\'"]([^\'"]{3,})[\'"]/', $content, $matches);
                $content = implode(' ', $matches[1]);
            }

            // Extraire les mots (lettres uniquement, min N caracteres)
            preg_match_all('/\b[a-zA-Z]{' . $minLength . ',}\b/', $content, $matches);

            if (empty($matches[0])) continue;

            $words = array_map('strtolower', $matches[0]);
            $words = array_unique($words);

            foreach ($words as $word) {
                if (in_array($word, $this->commonEnglishWords)) {
                    $found[$word] = ($found[$word] ?? 0) + 1;
                    $byFile[$relative][$word] = ($byFile[$relative][$word] ?? 0) + 1;
                }
            }
        }

        if (empty($found)) {
            $this->info('[OK] Aucun mot anglais courant detecte.');
            return self::SUCCESS;
        }

        // ============================================================
        // RAPPORT
        // ============================================================
        arsort($found);

        $this->line('+------------------------------------------------------+');
        $this->line('|   MOTS ANGLAIS DETECTES                              |');
        $this->line('+------------------------------------------------------+');
        $this->line('|   Mots distincts   : ' . str_pad((string) count($found), 32) . '|');
        $this->line('|   Occurrences      : ' . str_pad((string) array_sum($found), 32) . '|');
        $this->line('|   Fichiers touches : ' . str_pad((string) count($byFile), 32) . '|');
        $this->line('+------------------------------------------------------+');
        $this->newLine();

        $this->line("TOP {$top} DES MOTS LES PLUS FREQUENTS :");
        $i = 1;
        foreach (array_slice($found, 0, $top, true) as $word => $count) {
            $this->line("   " . str_pad((string) $i, 3) . "  " . str_pad($word, 20) . " x {$count}");
            $i++;
        }
        $this->newLine();

        return self::SUCCESS;
    }

    protected function findFiles(string $path): array
    {
        $files = [];
        $basePath = base_path();

        if (is_file($path)) {
            return [$path];
        }

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
            if (!in_array($ext, ['php', 'js', 'ts', 'css', 'scss', 'json', 'md', 'txt', 'html', 'xml', 'yml', 'yaml'])) {
                continue;
            }

            $files[] = $file->getPathname();
        }

        return array_unique($files);
    }

    protected function renderHeader(): void
    {
        $this->newLine();
        $this->line('+------------------------------------------------------+');
        $this->line('|   TANJONA - DETECTION DES MOTS ANGLAIS               |');
        $this->line('|   ' . str_pad(now()->format('Y-m-d H:i:s'), 50) . ' |');
        $this->line('+------------------------------------------------------+');
        $this->newLine();
    }
}