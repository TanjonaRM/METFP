<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class FixFormateurLoginView extends Command
{
    protected $signature = 'fix:formateur-login-view';
    protected $description = 'Restaure le design original de la page login formateur';

    public function handle(): int
    {
        $this->line('');
        $this->line('+==========================================================+');
        $this->line('|   [THEME] RESTAURATION LOGIN FORMATEUR                         |');
        $this->line('+==========================================================+');
        $this->line('');

        // ===============================================
        // 1. Chercher la version originale dans VS Code History
        // ===============================================
        $this->line('> 1. Recherche dans VS Code History');

        $historyBase = getenv('APPDATA') . '\\Code\\User\\History';
        $targetResource = 'SGFormateurs/resources/views/auth/formateur/login.blade.php';

        $found = null;
        $foundSize = 0;

        if (File::exists($historyBase)) {
            foreach (File::allFiles($historyBase) as $f) {
                if ($f->getFilename() !== 'entries.json') continue;

                $json = json_decode(File::get($f->getPathname()), true);
                $resource = $json['resource'] ?? '';

                // Décoder l'URL
                $decoded = urldecode($resource);

                if (str_contains($decoded, 'SGFormateurs/resources/views/auth/formateur/login.blade.php')) {
                    $dir = dirname($f->getPathname());

                    // Trier par timestamp DESC
                    $entries = collect($json['entries'])->sortByDesc('timestamp');

                    foreach ($entries as $entry) {
                        $file = $dir . DIRECTORY_SEPARATOR . $entry['id'];
                        if (File::exists($file)) {
                            $size = File::size($file);
                            // Prendre la première version > 3000 octets
                            if ($size > 3000) {
                                $found = $file;
                                $foundSize = $size;
                                $this->info("   [OK] Trouvé : {$entry['id']} ({$size} octets)");
                                break 2;
                            }
                        }
                    }
                }
            }
        }

        if (!$found) {
            $this->error('   [X] Version originale introuvable dans VS Code History');
            $this->line('');
            $this->line('   -> Restauration manuelle :');
            $this->line('      1. VS Code -> clic droit sur login.blade.php -> Open Timeline');
            $this->line('      2. Choisir une version > 5000 octets');
            $this->line('      3. Restore Contents');
            return self::FAILURE;
        }

        // ===============================================
        // 2. Restaurer
        // ===============================================
        $this->line('');
        $this->line('> 2. Restauration du fichier');

        $targetPath = resource_path('views/auth/formateur/login.blade.php');

        // Créer le dossier si besoin
        $targetDir = dirname($targetPath);
        if (!File::exists($targetDir)) {
            File::makeDirectory($targetDir, 0755, true);
        }

        // Backup de l'actuel si existe
        if (File::exists($targetPath)) {
            File::copy($targetPath, $targetPath . '.bak.' . date('Y-m-d_His'));
        }

        File::copy($found, $targetPath);
        $this->info('   [OK] Fichier restauré dans : resources/views/auth/formateur/login.blade.php');
        $this->line('   [BOX] Taille : ' . File::size($targetPath) . ' octets');

        // ===============================================
        // 3. Corriger le LoginController
        // ===============================================
        $this->line('');
        $this->line('> 3. Correction LoginController');

        $ctrlPath = app_path('Http/Controllers/Auth/Formateur/LoginController.php');

        if (File::exists($ctrlPath)) {
            File::copy($ctrlPath, $ctrlPath . '.bak.' . date('Y-m-d_His'));
            $content = File::get($ctrlPath);

            // Remplacer l'ancienne vue par la bonne
            $content = str_replace(
                "view('formateur.auth.login')",
                "view('auth.formateur.login')",
                $content
            );

            File::put($ctrlPath, $content);
            $this->info("   [OK] LoginController : 'formateur.auth.login' -> 'auth.formateur.login'");

            // Vérifier syntaxe
            $output = [];
            $rc = 0;
            exec('php -l "' . $ctrlPath . '" 2>&1', $output, $rc);
            if ($rc === 0) {
                $this->info('   [OK] Syntaxe valide');
            } else {
                $this->error('   [X] Erreur syntaxe');
                foreach ($output as $o) $this->line('      ' . $o);
            }
        }

        // ===============================================
        // 4. Supprimer les fichiers créés par erreur
        // ===============================================
        $this->line('');
        $this->line('> 4. Suppression du fichier créé par erreur');

        $badPaths = [
            resource_path('views/formateur/auth/login.blade.php'),
            resource_path('views/formateur/auth/register.blade.php'),
            resource_path('views/formateur/auth/pending.blade.php'),
            resource_path('views/formateur/auth/refused.blade.php'),
        ];

        foreach ($badPaths as $p) {
            if (File::exists($p)) {
                File::copy($p, $p . '.deleted.' . date('Y-m-d_His'));
                File::delete($p);
                $this->info('   [DEL]️  Supprimé : ' . str_replace(resource_path('views/'), '', $p));
            }
        }

        // Supprimer le dossier s'il est vide
        $badDir = resource_path('views/formateur/auth');
        if (File::exists($badDir) && count(File::files($badDir)) === 0) {
            File::deleteDirectory($badDir);
            $this->info('   [DEL]️  Dossier vide supprimé');
        }

        // ===============================================
        // 5. Vider les caches
        // ===============================================
        $this->line('');
        $this->line('> 5. Vidage des caches');
        $this->call('view:clear');
        $this->call('optimize:clear');
        $this->info('   [OK] Caches vidés');

        $this->line('');
        $this->line('+==========================================================+');
        $this->line('|   [SUCCESS] RESTAURATION TERMINÉE                                |');
        $this->line('+==========================================================+');
        $this->line('');
        $this->line('-> Testez : http://localhost:8000/formateur/login (Ctrl+F5)');

        return self::SUCCESS;
    }
}