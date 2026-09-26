<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class ProjectInspectNotifications extends Command
{
    protected $signature = 'project:inspect-notifications';
    protected $description = 'Inspecte les fichiers du module Notifications';

    public function handle(): int
    {
        $this->info("Inspection du module Notifications");
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
        $this->info("Résumé :");
        $this->line("  OK       : {$ok}");
        $this->line("  Vides    : {$empty}");
        $this->line("  Manquants: {$missing}");

        return self::SUCCESS;
    }

    protected function getFiles(): array
    {
        return [
            'app/Http/Controllers/Admin/NotificationController.php',
            'app/Http/Controllers/Admin/DashboardController.php',
            'app/Models/Notification.php',
            'app/Infrastructure/Persistence/Eloquent/Models/NotificationModel.php',
            'app/Application/Notifications/Services/NotificationService.php',
            'resources/views/admin/notifications/index.blade.php',
            'resources/views/layouts/admin.blade.php',
            'routes/admin.php',
            'database/migrations/2026_09_17_122707_create_notifications_table.php',
            'database/migrations/2026_09_17_134108_fix_notifications_table.php',
        ];
    }
}
