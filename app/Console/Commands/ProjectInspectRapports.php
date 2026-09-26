<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class ProjectInspectRapports extends Command
{
    protected $signature = 'project:inspect-rapports';
    protected $description = 'Inspecte les fichiers du module Rapports/PDF';

    public function handle(): int
    {
        $this->info("Inspection du module Rapports/PDF");
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
            'app/Http/Controllers/Admin/PdfController.php',
            'app/Infrastructure/Adapters/Pdf/DompdfExporter.php',
            'app/Infrastructure/Services/PdfExporterInterface.php',
            'resources/views/admin/rapports/index.blade.php',
            'resources/views/pdf/layouts/base.blade.php',
            'resources/views/pdf/formateurs/liste.blade.php',
            'resources/views/pdf/formateurs/fiche.blade.php',
            'resources/views/pdf/formateurs/par-etablissement.blade.php',
            'resources/views/pdf/formateurs/par-filiere.blade.php',
            'resources/views/pdf/affectations/liste.blade.php',
            'resources/views/pdf/statistiques/global.blade.php',
            'routes/admin.php',
        ];
    }
}