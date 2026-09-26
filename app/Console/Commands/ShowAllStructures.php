<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ShowAllStructures extends Command
{
    protected $signature = 'tanjona:structures
                            {--table= : Voir une seule table}';

    protected $description = 'Affiche la structure complete de toutes les tables';

    protected array $excludedTables = [
        'cache', 'cache_locks', 'failed_jobs', 'job_batches', 'jobs',
        'migrations', 'password_reset_tokens', 'sessions',
    ];

    public function handle(): int
    {
        $this->newLine();
        $this->line('+------------------------------------------------------+');
        $this->line('|   TANJONA - STRUCTURE DES TABLES                     |');
        $this->line('+------------------------------------------------------+');
        $this->newLine();

        $tables = $this->option('table')
            ? [$this->option('table')]
            : $this->getTables();

        foreach ($tables as $table) {
            $this->showStructure($table);
            $this->newLine();
        }

        return self::SUCCESS;
    }

    protected function showStructure(string $table): void
    {
        try {
            $columns = DB::select("PRAGMA table_info({$table})");
        } catch (\Throwable $e) {
            $this->error("[X] Table introuvable : {$table}");
            return;
        }

        $count = DB::table($table)->count();

        $this->line("+------------------------------------------------------+");
        $this->line("|   TABLE : " . str_pad($table, 42) . " |");
        $this->line("+------------------------------------------------------+");
        $this->line("|   Lignes : " . str_pad((string) $count, 41) . " |");
        $this->line("+------------------------------------------------------+");
        $this->newLine();

        $data = [];
        foreach ($columns as $col) {
            $data[] = [
                $col->cid,
                $col->name,
                $col->type,
                $col->notnull ? 'NON' : 'OUI',
                $col->dflt_value ?? '',
                $col->pk ? 'PK' : '',
            ];
        }

        $this->table(
            ['#', 'Colonne', 'Type', 'Nullable', 'Defaut', 'Cle'],
            $data
        );
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