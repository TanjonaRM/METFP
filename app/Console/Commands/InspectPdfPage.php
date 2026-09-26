<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class InspectPdfPage extends Command
{
    protected $signature = 'inspect:pdf-page';
    protected $description = 'Inspecte la page PDF et le dashboard pour harmonisation';

    public function handle(): int
    {
        // ---------------------------------------------
        // 1. Trouver la vue PDF
        // ---------------------------------------------
        $this->line('');
        $this->line('> 1. Vue PDF');

        $pdfViews = [
            'admin/pdf/index.blade.php',
            'admin/pdf.blade.php',
            'admin/pdfs/index.blade.php',
            'admin/pdf/dashboard.blade.php',
        ];

        foreach ($pdfViews as $v) {
            $path = resource_path('views/' . $v);
            if (File::exists($path)) {
                $this->info("   [OK] {$v} (" . File::size($path) . " octets)");
            } else {
                $this->line("   >>️  {$v} introuvable");
            }
        }

        // Chercher toutes les vues avec "pdf" dans le nom
        $this->line('');
        $this->line('   Toutes les vues contenant "pdf" :');
        foreach (File::allFiles(resource_path('views')) as $f) {
            if (stripos($f->getFilename(), 'pdf') !== false) {
                $this->line('   * ' . str_replace(
                    [resource_path('views') . DIRECTORY_SEPARATOR, '.blade.php'],
                    ['', ''],
                    $f->getPathname()
                ));
            }
        }

        // ---------------------------------------------
        // 2. Trouver la vue Dashboard admin (pour le style des cartes)
        // ---------------------------------------------
        $this->line('');
        $this->line('> 2. Vue Dashboard admin (référence style)');

        $dashboardViews = [
            'admin/dashboard.blade.php',
            'admin/dashboard/index.blade.php',
        ];

        foreach ($dashboardViews as $v) {
            $path = resource_path('views/' . $v);
            if (File::exists($path)) {
                $this->info("   [OK] {$v} (" . File::size($path) . " octets)");
            }
        }

        // ---------------------------------------------
        // 3. Chercher le controller qui gère /admin/pdf
        // ---------------------------------------------
        $this->line('');
        $this->line('> 3. Contrôleurs liés à PDF');

        foreach (File::allFiles(app_path('Http/Controllers')) as $f) {
            if (stripos($f->getFilename(), 'pdf') !== false) {
                $this->info("   [OK] " . $f->getFilename() . " (" . File::size($f->getPathname()) . " octets)");
            }
        }

        // ---------------------------------------------
        // 4. Routes /admin/pdf
        // ---------------------------------------------
        $this->line('');
        $this->line('> 4. Routes PDF');

        foreach (\Illuminate\Support\Facades\Route::getRoutes() as $route) {
            if (str_contains($route->uri(), 'pdf')) {
                $this->line(sprintf(
                    "   %-10s %-35s -> %s",
                    implode('|', $route->methods()),
                    $route->uri(),
                    $route->getActionName()
                ));
            }
        }

        $this->line('');
        $this->line('-> Envoyez-moi TOUT ce rapport.');

        return self::SUCCESS;
    }
}