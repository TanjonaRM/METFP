<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class AddUniqueSuffixToCode extends Command
{
    protected $signature = 'add:unique-suffix-code';
    protected $description = 'Ajoute un suffixe unique (-2, -3...) au code si doublon';

    public function handle(): int
    {
        $this->line('');
        $this->line('+==========================================================+');
        $this->line('|   [TOOL] SUFFIXE UNIQUE POUR CODE ÉTABLISSEMENT               |');
        $this->line('+==========================================================+');
        $this->line('');

        $path = app_path('Http/Controllers/Admin/EtablissementController.php');

        if (!File::exists($path)) {
            $this->error("[X] Fichier introuvable");
            return self::FAILURE;
        }

        // Backup
        File::copy($path, $path . '.bak.' . date('Y-m-d_His'));
        $this->line('[SAVE] Backup créé');

        $content = File::get($path);

        // ===============================================
        // Remplacer le bloc d'auto-génération du code
        // ===============================================

        // Ancien bloc (avec ou sans suffixe)
        $oldPattern = '/\/\/ [AJAX] Auto-génération du code.*?\$validated\[\'code\'\]\s*=\s*\$type\s*\.\s*\'-\'\s*\.\s*\$mot;\s*\n        \}/s';

        $newBlock = <<<'PHP'
        // [AJAX] Auto-génération du code : TYPE-PREMIER-MOT + suffixe unique
        if (empty($validated['code'])) {
            $type = strtoupper(trim($validated['type'] ?? 'ETB'));
            $nom  = trim($validated['nom'] ?? '');

            // Retirer le type du début du nom si présent
            $nom = preg_replace('/^' . preg_quote($type, '/') . '\s+/i', '', $nom);

            // Prendre le premier mot (ou les 3 premiers caractères si trop court)
            $parts = preg_split('/[\s\-]+/', $nom);
            $mot   = strtoupper($parts[0] ?? 'X');

            if (strlen($mot) < 2) {
                $mot = strtoupper(substr(preg_replace('/\s+/', '', $nom), 0, 3));
            }
            if (empty($mot)) {
                $mot = 'X';
            }

            // Base du code : TYPE-MOT
            $baseCode = $type . '-' . $mot;
            $code     = $baseCode;
            $counter  = 1;

            // Boucler tant que le code existe déjà
            // CFP-TANJONA existe -> CFP-TANJONA-2 -> CFP-TANJONA-3 -> etc.
            while (\Infrastructure\Persistence\Eloquent\Models\EtablissementModel::where('code', $code)->exists()) {
                $counter++;
                $code = $baseCode . '-' . $counter;

                // Sécurité anti-boucle-infinie
                if ($counter > 999) {
                    $code = $baseCode . '-' . time();
                    break;
                }
            }

            $validated['code'] = $code;
        }
PHP;

        if (preg_match($oldPattern, $content)) {
            $content = preg_replace($oldPattern, $newBlock, $content, 1);
            $this->info('   [OK] Bloc remplacé (avec suffixe unique)');
        } else {
            $this->error('   [X] Bloc d\'auto-génération introuvable');
            $this->line('');
            $this->line('   -> Vérifiez que le bloc existe dans store() :');
            $this->line('      "// [AJAX] Auto-génération du code"');
            return self::FAILURE;
        }

        // Sauvegarder
        File::put($path, $content);

        // Vérifier syntaxe
        $output = [];
        $rc = 0;
        exec('php -l "' . $path . '" 2>&1', $output, $rc);
        if ($rc === 0) {
            $this->info('   [OK] Syntaxe valide');
        } else {
            $this->error('   [X] Erreur syntaxe');
            foreach ($output as $o) $this->line('      ' . $o);
            return self::FAILURE;
        }

        // Vider les caches
        $this->line('');
        $this->line('> Vidage des caches');
        $this->call('optimize:clear');
        $this->call('view:clear');
        $this->info('   [OK] Caches vidés');

        $this->line('');
        $this->line('+==========================================================+');
        $this->line('|   [SUCCESS] TERMINÉ                                              |');
        $this->line('+==========================================================+');
        $this->line('');
        $this->line('[NOTE] Exemples de codes générés :');
        $this->line('   * 1er "CFP TANJONA"  -> CFP-TANJONA');
        $this->line('   * 2ème "CFP TANJONA" -> CFP-TANJONA-2 (mais nom refusé en double)');
        $this->line('   * "CFP TANA"         -> CFP-TANA');
        $this->line('   * "CFP TANANA"       -> CFP-TANANA');
        $this->line('');
        $this->line('-> Testez : http://localhost:8000/admin/etablissements');

        return self::SUCCESS;
    }
}