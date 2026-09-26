<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class ShowAllTables extends Command
{
    protected $signature = 'tanjona:show-all
                            {--table= : Voir une seule table}
                            {--limit=10 : Nombre de lignes a afficher}
                            {--list : Lister uniquement les tables}';

    protected $description = 'Affiche le contenu de toutes les tables';

    protected array $excludedTables = [
        'cache', 'cache_locks', 'failed_jobs', 'job_batches', 'jobs',
        'migrations', 'password_reset_tokens', 'sessions',
    ];

    public function handle(): int
    {
        $this->newLine();
        $this->line('+------------------------------------------------------+');
        $this->line('|   TANJONA - CONTENU DE LA BASE DE DONNEES            |');
        $this->line('+------------------------------------------------------+');
        $this->newLine();

        if ($table = $this->option('table')) {
            return $this->showTable($table, (int) $this->option('limit'));
        }

        $tables = $this->getTables();

        if ($this->option('list')) {
            return $this->listTables($tables);
        }

        foreach ($tables as $table) {
            $this->showTable($table, (int) $this->option('limit'));
            $this->newLine();
        }

        return self::SUCCESS;
    }

    protected function listTables(array $tables): int
    {
        $data = [];
        foreach ($tables as $table) {
            $count = DB::table($table)->count();
            $cols = count(Schema::getColumnListing($table));
            $data[] = [$table, $count, $cols];
        }

        $this->table(['Table', 'Enregistrements', 'Colonnes'], $data);
        return self::SUCCESS;
    }

    protected function showTable(string $table, int $limit): int
    {
        if (!Schema::hasTable($table)) {
            $this->error("[X] Table introuvable : {$table}");
            return self::FAILURE;
        }

        $total = DB::table($table)->count();
        $columns = Schema::getColumnListing($table);

        $this->line("+------------------------------------------------------+");
        $this->line("|   TABLE : " . str_pad($table, 42) . " |");
        $this->line("+------------------------------------------------------+");
        $this->line("|   Enregistrements : " . str_pad((string) $total, 34) . " |");
        $this->line("|   Colonnes        : " . str_pad((string) count($columns), 34) . " |");
        $this->line("+------------------------------------------------------+");
        $this->newLine();

        if ($total === 0) {
            $this->warn('   [!] Table vide');
            $this->newLine();
            return self::SUCCESS;
        }

        $rows = DB::table($table)->limit($limit)->get();

        if ($rows->isEmpty()) {
            $this->warn('   [!] Aucune donnee');
            return self::SUCCESS;
        }

        $headers = $columns;
        $data = [];

        foreach ($rows as $row) {
            $line = [];
            foreach ($columns as $col) {
                $val = $row->$col ?? '';
                if (is_string($val) && strlen($val) > 30) {
                    $val = substr($val, 0, 27) . '...';
                }
                $line[] = $val;
            }
            $data[] = $line;
        }

        $this->table($headers, $data);

        if ($total > $limit) {
            $this->line("   ... et " . ($total - $limit) . " autre(s) ligne(s)");
            $this->newLine();
        }

        return self::SUCCESS;
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