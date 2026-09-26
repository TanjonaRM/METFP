<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class InspectFormateurModalJS extends Command
{
    protected $signature = 'inspect:formateur-modal-js';
    protected $description = 'Analyse le JS et le HTML du modal formateur';

    public function handle(): int
    {
        $indexPath = resource_path('views/admin/formateurs/index.blade.php');
        $content = File::get($indexPath);

        $this->info("[FILE] Analyse de index.blade.php");
        $this->newLine();

        // 1. Chercher les mots-clés AJAX
        $patterns = [
            'fetch('           => 'Appel AJAX fetch',
            'axios'            => 'Appel axios',
            '$.ajax'           => 'Appel jQuery AJAX',
            'XMLHttpRequest'   => 'Appel XHR brut',
            'loadingFormateur' => 'Élément de chargement',
            'Chargement'       => 'Texte "Chargement"',
            'openFormateurModal' => 'Fonction ouverture modal',
            'modalCreateFormateur' => 'ID du modal',
        ];

        foreach ($patterns as $needle => $label) {
            $found = str_contains($content, $needle);
            $this->line(sprintf(
                "  %s %s",
                $found ? "[OK]" : "[X]",
                $label . " ('{$needle}')"
            ));
        }

        $this->newLine();

        // 2. Afficher les blocs <script>
        preg_match_all('/<script[^>]*>(.*?)<\/script>/s', $content, $matches);
        if (!empty($matches[0])) {
            $this->info("[SEARCH] Blocs <script> trouvés : " . count($matches[0]));
            foreach ($matches[0] as $i => $script) {
                $this->newLine();
                $this->line("--- Script #" . ($i + 1) . " ---");
                $this->line($script);
            }
        }

        // 3. Afficher tout ce qui contient "modal" et "formateur"
        $this->newLine();
        $this->info("[SEARCH] Extrait : contexte autour du modal");
        $lines = explode("\n", $content);
        foreach ($lines as $i => $line) {
            if (stripos($line, 'modal') !== false
                || stripos($line, 'Chargement') !== false
                || stripos($line, 'fetch') !== false) {
                $this->line(sprintf("%4d | %s", $i + 1, $line));
            }
        }

        return self::SUCCESS;
    }
}