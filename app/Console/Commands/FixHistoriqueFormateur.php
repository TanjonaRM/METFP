<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class FixHistoriqueFormateur extends Command
{
    protected $signature = 'fix:historique-formateur';
    protected $description = 'Corrige les appels HistoriqueFormateurModel (colonne type au lieu de action)';

    public function handle(): int
    {
        $this->line('');
        $this->line('+==========================================================+');
        $this->line('|   [TOOL] CORRECTION HISTORIQUE FORMATEUR                      |');
        $this->line('+==========================================================+');
        $this->line('');

        $path = app_path('Http/Controllers/Admin/FormateurController.php');

        if (!File::exists($path)) {
            $this->error("[X] Fichier introuvable : {$path}");
            return self::FAILURE;
        }

        // Backup
        File::copy($path, $path . '.bak.' . date('Y-m-d_His'));
        $this->line('[SAVE] Backup créé');

        $content = File::get($path);
        $original = $content;
        $modifications = 0;

        // ===============================================
        // 1. Remplacer 'action' => 'xxx' par 'type' => 'xxx'
        // ===============================================
        $this->line('');
        $this->line('> 1. Remplacement de \'action\' par \'type\'');

        $types = ['creation', 'modification', 'suppression'];

        foreach ($types as $type) {
            // Match souple : 'action' suivi de => puis 'creation' (avec espacements variables)
            $pattern = "/'action'\s*=>\s*'{$type}'/";
            $replacement = "'type'         => '{$type}'";

            if (preg_match($pattern, $content)) {
                $content = preg_replace($pattern, $replacement, $content);
                $this->info("   [OK] 'action' => '{$type}' remplacé par 'type' => '{$type}'");
                $modifications++;
            }
        }

        if ($modifications === 0) {
            $this->line('   ℹ️  Aucun remplacement effectué (déjà correct ?)');
        }

        // ===============================================
        // 2. Supprimer 'user_id' et ajouter 'source' + 'survenu_le'
        // ===============================================
        $this->line('');
        $this->line('> 2. Remplacement de \'user_id\' par \'source\' + \'survenu_le\'');

        $pattern = "/'user_id'\s*=>\s*auth\('admin'\)->id\(\),?/";
        if (preg_match($pattern, $content)) {
            $content = preg_replace(
                $pattern,
                "'source'       => 'admin',\n            'survenu_le'   => now(),",
                $content
            );
            $this->info("   [OK] 'user_id' remplacé par 'source' + 'survenu_le'");
        } else {
            $this->line('   ℹ️  Aucun \'user_id\' trouvé');
        }

        // ===============================================
        // 3. Sécurité : envelopper dans try/catch
        // ===============================================
        $this->line('');
        $this->line('> 3. Ajout de try/catch (sécurité)');

        // Chercher les blocs HistoriqueFormateurModel::create([...]);
        // et les envelopper
        $pattern = '/(HistoriqueFormateurModel::create\(\s*\[[^\]]*\]\s*\)\s*;)/s';

        if (preg_match_all($pattern, $content, $matches)) {
            $this->line('   📌 ' . count($matches[1]) . ' bloc(s) à sécuriser');
            // On ne modifie pas pour l'instant, on avertit juste
            $this->line('   ℹ️  Utilisez plutôt --safe pour envelopper dans try/catch');
        }

        // ===============================================
        // 4. Enregistrer
        // ===============================================
        if ($content === $original) {
            $this->line('');
            $this->warn('[!]️  Aucune modification appliquée');
        } else {
            File::put($path, $content);
            $this->line('');
            $this->info('[SAVE] Fichier enregistré');
        }

        // ===============================================
        // 5. Vérification syntaxe PHP
        // ===============================================
        $this->line('');
        $this->line('> 4. Vérification syntaxe PHP');

        $output = [];
        $returnCode = 0;
        exec('php -l "' . $path . '" 2>&1', $output, $returnCode);

        if ($returnCode === 0) {
            $this->info('   [OK] Syntaxe PHP valide');
        } else {
            $this->error('   [X] ERREUR SYNTAXE :');
            foreach ($output as $o) {
                $this->line('      ' . $o);
            }
            $this->warn('   -> Restaurez depuis le backup si besoin');
        }

        // ===============================================
        // 6. Vider les caches
        // ===============================================
        $this->line('');
        $this->line('> 5. Vidage des caches');
        $this->call('optimize:clear');
        $this->call('view:clear');
        $this->call('config:clear');
        $this->info('   [OK] Caches vidés');

        $this->line('');
        $this->line('+==========================================================+');
        $this->line('|   [SUCCESS] TERMINÉ                                              |');
        $this->line('+==========================================================+');
        $this->line('');
        $this->line('-> Testez : http://localhost:8000/admin/formateurs');
        $this->line('   * Cliquez "Ajouter un formateur"');
        $this->line('   * Remplissez les champs');
        $this->line('   * Enregistrez');
        $this->line('   * Vous devez être redirigé avec un message de succès [OK]');

        return self::SUCCESS;
    }
}