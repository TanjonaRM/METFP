<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;

class FindUnusedColumns extends Command
{
    protected $signature = 'tanjona:unused-columns
                            {--table= : Analyser une seule table}
                            {--min-refs=1 : Nombre minimum de references pour considerer comme utilise}';

    protected $description = 'Detecte les colonnes non utilisees dans le code';

    protected array $excludedTables = [
        'cache', 'cache_locks', 'failed_jobs', 'job_batches', 'jobs',
        'migrations', 'password_reset_tokens', 'sessions',
    ];

    /**
     * Colonnes techniques toujours ignorees.
     */
    protected array $ignoredColumns = [
        'id', 'created_at', 'updated_at', 'deleted_at', 'remember_token',
        'email_verified_at',
    ];

    public function handle(): int
    {
        $this->newLine();
        $this->line('+------------------------------------------------------+');
        $this->line('|   TANJONA - COLONNES INUTILISEES                     |');
        $this->line('+------------------------------------------------------+');
        $this->newLine();

        $tables = $this->option('table')
            ? [$this->option('table')]
            : $this->getTables();

        $code = $this->loadAllCode();
        $this->line('Analyse de ' . count($tables) . ' table(s)...');
        $this->newLine();

        $totalUnused = 0;
        $totalColumns = 0;

        foreach ($tables as $table) {
            if (!Schema::hasTable($table)) {
                $this->error("[X] Table introuvable : {$table}");
                continue;
            }

            $columns = Schema::getColumnListing($table);
            $count = DB::table($table)->count();

            $used = [];
            $unused = [];

            foreach ($columns as $col) {
                // Ignorer les colonnes techniques
                if (in_array($col, $this->ignoredColumns)) {
                    continue;
                }

                $totalColumns++;
                $refs = $this->countColumnRefs($col, $code);

                if ($refs >= (int) $this->option('min-refs')) {
                    $used[] = ['col' => $col, 'refs' => $refs];
                } else {
                    $unused[] = ['col' => $col, 'refs' => $refs];
                    $totalUnused++;
                }
            }

            $this->line("+------------------------------------------------------+");
            $this->line("|   TABLE : " . str_pad($table, 42) . " |");
            $this->line("|   Lignes : " . str_pad((string) $count, 41) . " |");
            $this->line("+------------------------------------------------------+");

            if (!empty($unused)) {
                $this->warn('   [!] COLONNES NON REFERENCEES :');
                $rows = [];
                foreach ($unused as $u) {
                    $rows[] = [$u['col'], $u['refs']];
                }
                $this->table(['Colonne', 'References'], $rows);
            } else {
                $this->info('   [OK] Toutes les colonnes sont referencees');
            }

            $this->newLine();
        }

        // Resume
        $this->line('+------------------------------------------------------+');
        $this->line('|   RESUME                                             |');
        $this->line('+------------------------------------------------------+');
        $this->line('|   Colonnes analysees : ' . str_pad((string) $totalColumns, 30) . ' |');
        $this->line('|   Colonnes inutilisees : ' . str_pad((string) $totalUnused, 28) . ' |');
        $this->line('+------------------------------------------------------+');
        $this->newLine();

        return self::SUCCESS;
    }

    protected function countColumnRefs(string $column, string $code): int
    {
        $patterns = [
            "->{$column}",            // $obj->col
            "'{$column}'",            // 'col'
            "\"{$column}\"",          // "col"
            "'{$column}' =>",         // 'col' =>
            "\"{$column}\" =>",       // "col" =>
            "{$column} :",            // col :
            "{$column},",             // col,
            "{$column})",             // col)
            "{$column}]",             // col]
            " '{$column} ",           // ' col
            " \"{$column} ",          // " col
        ];

        $count = 0;
        foreach ($patterns as $pattern) {
            $count += substr_count($code, $pattern);
        }

        return $count;
    }

    protected function loadAllCode(): string
    {
        $code = '';
        $dirs = ['app', 'routes', 'config', 'database', 'resources/views'];

        foreach ($dirs as $dir) {
            $path = base_path($dir);
            if (!is_dir($path)) continue;

            $iterator = new RecursiveIteratorIterator(
                new RecursiveDirectoryIterator($path, RecursiveDirectoryIterator::SKIP_DOTS)
            );
            foreach ($iterator as $file) {
                if (!$file->isFile()) continue;

                $ext = strtolower($file->getExtension());
                if (!in_array($ext, ['php', 'js', 'html'])) continue;

                // Ignorer les .bak
                if (str_contains($file->getFilename(), '.bak.')) continue;

                $code .= file_get_contents($file->getPathname()) . "\n";
            }
        }

        return $code;
    }

    protected function getTables(): array
    {
        $tables = DB::select("SELECT name FROM sqlite_master WHERE type='table' AND name NOT LIKE 'sqlite_%' ORDER BY name");

        return collect($tables)
            ->map(fn($t) => is_object($t) ? $t->name : $t)
            ->reject(fn($name) => in_array($name, $this->excludedTables))
            ->values()
            ->toArray();
    }
}