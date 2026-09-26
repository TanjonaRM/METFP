<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class InspectModalFormateur extends Command
{
    protected $signature = 'inspect:modal-formateur';
    protected $description = 'Inspecte les fichiers liés au modal Ajouter Formateur';

    public function handle(): int
    {
        $files = [
            'Vue index'        => resource_path('views/admin/formateurs/index.blade.php'),
            'Vue modal'        => resource_path('views/admin/formateurs/_modal.blade.php'),
            'Vue modal alt'    => resource_path('views/admin/formateurs/modal-create.blade.php'),
            'Vue create'       => resource_path('views/admin/formateurs/create.blade.php'),
            'Controller'       => app_path('Http/Controllers/Admin/FormateurController.php'),
            'Request Store'    => app_path('Http/Requests/Formateur/StoreFormateurRequest.php'),
            'Routes web'       => base_path('routes/web.php'),
        ];

        foreach ($files as $label => $path) {
            $this->newLine();
            $this->line("==========================================");
            $this->line("[FILE] <fg=cyan>{$label}</> : {$path}");

            if (!File::exists($path)) {
                $this->error("[X] Fichier introuvable");
                continue;
            }

            $size = File::size($path);
            $this->line("[BOX] Taille : {$size} octets");

            // Signaux d'alerte
            $content = File::get($path);

            if (str_contains($content, '@extends')) {
                $this->warn("[!]️  Contient @extends -> ne devrait PAS être dans un partial modal");
            }
            if (str_contains($content, '@section')) {
                $this->warn("[!]️  Contient @section -> suspect pour un modal");
            }
            if (str_contains($content, '<form')) {
                $this->info("[OK] Contient <form>");
            } else {
                $this->warn("[!]️  Aucun <form> trouvé");
            }

            // Afficher les 40 premières lignes
            $lines = explode("\n", $content);
            $preview = array_slice($lines, 0, 40);
            $this->newLine();
            $this->line("<fg=gray>--- Aperçu (40 premières lignes) ---</>");
            foreach ($preview as $i => $line) {
                $this->line(sprintf("%3d | %s", $i + 1, $line));
            }
        }

        return self::SUCCESS;
    }
}