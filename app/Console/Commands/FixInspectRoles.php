<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class FixInspectRoles extends Command
{
    protected $signature = 'fix:inspect-roles';
    protected $description = 'Corrige le conflit de nom line() dans InspectRoles';

    public function handle(): int
    {
        $path = app_path('Console/Commands/InspectRoles.php');

        if (!File::exists($path)) {
            $this->error("[X] Fichier introuvable : {$path}");
            return self::FAILURE;
        }

        // Backup
        File::copy($path, $path . '.bak.' . date('Y-m-d_His'));
        $this->line('[SAVE] Backup créé');

        $content = File::get($path);

        // 1. Renommer la déclaration de méthode
        $content = str_replace(
            'private function line(string $line, string $type = \'info\'): void',
            'private function myLine(string $line, string $type = \'info\'): void',
            $content
        );

        // 2. Dans la méthode myLine, remplacer $this->line( par $this->output->writeln(
        // On cible précisément la ligne dans myLine
        $content = str_replace(
            "        \$this->line(\$prefix . ' ' . \$line);",
            "        \$this->output->writeln(\$prefix . ' ' . \$line);",
            $content
        );

        // 3. Remplacer TOUS les autres appels $this->line( par $this->myLine( (en excluant celui qu'on vient de modifier)
        // On utilise une regex négative : pas suivi de "output"
        $content = preg_replace(
            '/\$this->line\((?!\$prefix)/',
            '$this->myLine(',
            $content
        );

        // 4. Corriger aussi le rapport : $this->report[] dans myLine
        // (déjà correct)

        File::put($path, $content);
        $this->info('[OK] InspectRoles.php corrigé');

        // 5. Tester
        $this->line('');
        $this->line('> Test de la commande...');
        $this->line('');
        $this->call('inspect:roles');

        return self::SUCCESS;
    }
}