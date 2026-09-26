<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class ProjectInspectUsers extends Command
{
    protected $signature = 'project:inspect-users';
    protected $description = 'Inspecte les fichiers du module Comptes admin';

    public function handle(): int
    {
        $this->info("Inspection du module Comptes admin");
        $this->newLine();

        $files = $this->getFiles();
        $ok = 0;
        $empty = 0;
        $missing = 0;

        $this->line(sprintf("%-6s %-12s %-70s %s", 'STATUT', 'LIGNES', 'CHEMIN', 'TAILLE'));
        $this->line(str_repeat('-', 130));

        foreach ($files as $file) {
            $fullPath = base_path($file);

            if (File::exists($fullPath)) {
                $size = File::size($fullPath);
                $lines = count(file($fullPath));

                if ($size < 10) {
                    $this->line(sprintf("%-6s %-12s %-70s %s o", 'VIDE', $lines, $file, $size));
                    $empty++;
                } else {
                    $sizeKB = round($size / 1024, 1);
                    $this->line(sprintf("%-6s %-12s %-70s %s Ko", 'OK', $lines, $file, $sizeKB));
                    $ok++;
                }
            } else {
                $this->line(sprintf("%-6s %-12s %-70s %s", 'MANQ', '-', $file, '-'));
                $missing++;
            }
        }

        $this->newLine();
        $this->info("Resume :");
        $this->line("  OK       : {$ok}");
        $this->line("  Vides    : {$empty}");
        $this->line("  Manquants: {$missing}");

        return self::SUCCESS;
    }

    protected function getFiles(): array
    {
        return [
            'app/Http/Controllers/Admin/UserController.php',
            'app/Http/Requests/User/StoreUserRequest.php',
            'app/Http/Requests/User/UpdateUserRequest.php',
            'app/Infrastructure/Persistence/Eloquent/Models/AdminModel.php',
            'resources/views/admin/users/index.blade.php',
            'resources/views/admin/users/create.blade.php',
            'resources/views/admin/users/edit.blade.php',
            'resources/views/admin/users/show.blade.php',
            'resources/views/admin/users/partials/form.blade.php',
            'database/migrations/2024_01_01_000001_create_admins_table.php',
            'routes/admin.php',
        ];
    }
}