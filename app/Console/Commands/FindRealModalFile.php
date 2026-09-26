<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class FindRealModalFile extends Command
{
    protected $signature = 'find:real-modal';
    protected $description = 'Trouve le fichier qui contient le vrai modal formateur';

    public function handle(): int
    {
        $this->line('');
        $this->line('+==========================================================+');
        $this->line('|   🔎 RECHERCHE DU VRAI FICHIER MODAL                      |');
        $this->line('+==========================================================+');
        $this->line('');

        // Mots-clés UNIQUES vus dans la capture d'écran
        $keywords = [
            'Remplissez les informations ci-dessous',
            'IDENTITÉ',
            'STATUT GLOBAL',
            'auto-généré',
            'Ex: RAKOTO',
            'Ex: Jean',
            'Ex: 10123456789',
        ];

        $this->line('[SEARCH] Recherche des mots-clés dans TOUT le projet...');
        $this->line('');

        $searchDirs = [
            resource_path('views'),
            app_path(),
            base_path('routes'),
        ];

        $matches = [];

        foreach ($searchDirs as $dir) {
            if (!File::exists($dir)) continue;

            foreach (File::allFiles($dir) as $file) {
                if ($file->getExtension() !== 'php' && !str_contains($file->getFilename(), '.blade.php')) {
                    continue;
                }
                if (str_contains($file->getFilename(), '.bak')) continue;

                $content = File::get($file->getPathname());

                foreach ($keywords as $kw) {
                    if (stripos($content, $kw) !== false) {
                        $relPath = str_replace(base_path() . DIRECTORY_SEPARATOR, '', $file->getPathname());
                        $matches[$relPath][] = $kw;
                        break;
                    }
                }
            }
        }

        if (empty($matches)) {
            $this->error('[X] Aucun fichier trouvé contenant ces mots-clés !');
            $this->line('');
            $this->line('-> Testez avec d\'autres mots vus dans la capture :');
            $this->line('   * "Statut global"');
            $this->line('   * "IDENTITE"');
            $this->line('   * "auto-genere"');
            return self::FAILURE;
        }

        $this->info('[OK] Fichiers contenant ces mots-clés :');
        $this->line('');

        foreach ($matches as $file => $foundKws) {
            $size = File::size(base_path($file));
            $this->line("   [FILE] {$file}");
            $this->line("      Taille : {$size} octets");
            $this->line("      Mots-clés : " . implode(', ', $foundKws));
            $this->line('');
        }

        $this->line('===========================================================');
        $this->line('-> Envoyez-moi la liste ci-dessus');
        $this->line('===========================================================');

        return self::SUCCESS;
    }
}