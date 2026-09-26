<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class FixEtablissementSafe extends Command
{
    protected $signature = 'fix:etablissement-safe';
    protected $description = 'Corrige EtablissementController - version sécurisée';

    public function handle(): int
    {
        $this->line('');
        $this->line('+==========================================================+');
        $this->line('|   [TOOL] CORRECTION SÉCURISÉE ETABLISSEMENT CONTROLLER        |');
        $this->line('+==========================================================+');
        $this->line('');

        $path = app_path('Http/Controllers/Admin/EtablissementController.php');

        if (!File::exists($path)) {
            $this->error("[X] Fichier introuvable");
            return self::FAILURE;
        }

        $content = File::get($path);

        // ===============================================
        // 0. ÉTAT ACTUEL
        // ===============================================
        $this->line('> 1. État actuel');
        $this->line('   Taille : ' . File::size($path) . ' octets');

        // Compter les imports NotificationService
        $importCount = substr_count($content, 'use App\Services\NotificationService;');
        $this->line("   Imports NotificationService : {$importCount}");

        $hasData = str_contains($content, '$data[');
        $this->line('   ' . ($hasData ? '[!]️' : '[OK]') . ' Contient $data[');

        // ===============================================
        // 1. BACKUP
        // ===============================================
        $this->line('');
        $this->line('> 2. Backup');
        $backupPath = $path . '.bak.' . date('Y-m-d_His');
        File::copy($path, $backupPath);
        $this->info('   [SAVE] ' . basename($backupPath));

        // ===============================================
        // 2. DÉDUPLIQUER LES IMPORTS
        // ===============================================
        $this->line('');
        $this->line('> 3. Déduplication des imports');

        // Trouver tous les blocs "use ...;" au début
        if (preg_match_all('/^use\s+([^;]+);/m', $content, $matches, PREG_OFFSET_CAPTURE)) {
            $seen = [];
            $toRemove = [];

            // Parcourir à l'envers pour ne pas casser les positions
            foreach (array_reverse($matches[0]) as $i => $m) {
                $useStatement = trim($m[0]);
                if (isset($seen[$useStatement])) {
                    // Doublon -> à retirer
                    $toRemove[] = $m;
                } else {
                    $seen[$useStatement] = true;
                }
            }

            if (!empty($toRemove)) {
                foreach ($toRemove as $m) {
                    // Retirer la ligne complète (avec le \n)
                    $pos = $m[1];
                    $len = strlen($m[0]);
                    // Chercher le \n suivant
                    $nextNewline = strpos($content, "\n", $pos + $len);
                    if ($nextNewline !== false) {
                        $content = substr($content, 0, $pos)
                            . substr($content, $nextNewline + 1);
                    }
                }
                $this->info('   [OK] ' . count($toRemove) . ' import(s) en double supprimé(s)');
            } else {
                $this->line('   >>️  Aucun import en double');
            }
        }

        // Revérifier le nombre d'imports
        $importCountAfter = substr_count($content, 'use App\Services\NotificationService;');
        $this->line("   Imports NotificationService après : {$importCountAfter}");

        // ===============================================
        // 3. CORRIGER $data -> $validated
        // ===============================================
        $this->line('');
        $this->line('> 4. Correction $data -> $validated');

        $count = 0;
        $content = preg_replace_callback(
            '/\$data\[/',
            function ($m) use (&$count) {
                $count++;
                return '$validated[';
            },
            $content
        );

        if ($count > 0) {
            $this->info("   [OK] {$count} occurrence(s) corrigée(s)");
        } else {
            $this->line('   >>️  Aucun $data[ trouvé');
        }

        // ===============================================
        // 4. CORRIGER required -> nullable
        // ===============================================
        $this->line('');
        $this->line('> 5. Correction validation code');

        $newContent = preg_replace(
            "/'code'\s*=>\s*'required\|string\|unique:etablissements,code'/",
            "'code' => 'nullable|string|unique:etablissements,code'",
            $content
        );

        if ($newContent !== $content) {
            $this->info("   [OK] 'code' rendu nullable");
            $content = $newContent;
        } else {
            $this->line('   >>️  Déjà nullable ou pattern non trouvé');
        }

        // ===============================================
        // 5. SAUVEGARDER
        // ===============================================
        $this->line('');
        $this->line('> 6. Sauvegarde');
        File::put($path, $content);
        $this->info('   [OK] Fichier enregistré');
        $this->line('   [BOX] Nouvelle taille : ' . File::size($path) . ' octets');

        // ===============================================
        // 6. VÉRIFIER SYNTAXE
        // ===============================================
        $this->line('');
        $this->line('> 7. Vérification syntaxe PHP');

        $output = [];
        $returnCode = 0;
        exec('php -l "' . $path . '" 2>&1', $output, $returnCode);

        if ($returnCode === 0) {
            $this->info('   [OK] Syntaxe valide');

            // Vidage caches
            $this->line('');
            $this->line('> 8. Vidage des caches');
            $this->call('optimize:clear');
            $this->call('view:clear');
            $this->info('   [OK] Caches vidés');

            $this->line('');
            $this->line('+==========================================================+');
            $this->line('|   [SUCCESS] CORRECTION TERMINÉE                                  |');
            $this->line('+==========================================================+');
            $this->line('');
            $this->line('-> Testez : http://localhost:8000/admin/etablissements');

            return self::SUCCESS;
        } else {
            $this->error('   [X] Erreur syntaxe :');
            foreach ($output as $o) {
                $this->line('      ' . $o);
            }
            $this->warn('   -> Restaurez : ' . basename($backupPath));
            return self::FAILURE;
        }
    }
}