<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class RestoreAndDiagnose extends Command
{
    protected $signature = 'restore:diagnose';
    protected $description = 'Restaure les fichiers corrompus et affiche l\'état réel';

    public function handle(): int
    {
        $this->line('');
        $this->line('+==========================================================+');
        $this->line('|   [RELOAD] RESTAURATION + DIAGNOSTIC HONNÊTE                   |');
        $this->line('+==========================================================+');

        // ===============================================
        // 1. Lister les .bak disponibles par fichier
        // ===============================================
        $this->line('');
        $this->line('> 1. Backups disponibles');

        $backupDirs = [
            storage_path('backups'),
            app_path('Http/Requests'),
            app_path('Infrastructure/Persistence/Eloquent/Models'),
        ];

        $allBackups = [];
        foreach ($backupDirs as $dir) {
            if (!File::exists($dir)) continue;
            foreach (File::allFiles($dir) as $f) {
                if (str_contains($f->getFilename(), '.bak')) {
                    $allBackups[] = $f->getPathname();
                }
            }
        }

        $this->line('   ' . count($allBackups) . ' backups trouvés');
        foreach (array_slice($allBackups, 0, 20) as $b) {
            $this->line('   * ' . basename($b));
        }

        // ===============================================
        // 2. Vérifier la santé des Form Requests
        // ===============================================
        $this->line('');
        $this->line('> 2. État des Form Requests');

        $requests = [
            'Http/Requests/Auth/Formateur/LoginFormateurRequest.php',
            'Http/Requests/Filiere/StoreFiliereRequest.php',
            'Http/Requests/Session/StoreSessionRequest.php',
        ];

        foreach ($requests as $rel) {
            $path = app_path($rel);
            if (!File::exists($path)) {
                $this->error("   [X] Manquant : {$rel}");
                continue;
            }

            $content = File::get($path);
            $hasAuthorize = preg_match('/public function authorize\s*\(/', $content);
            $hasRules     = preg_match('/public function rules\s*\(/', $content);
            $hasClass     = preg_match('/class\s+\w+\s+extends\s+\w+/', $content);

            $status = [];
            if ($hasClass)     $status[] = 'class[OK]';
            if ($hasAuthorize) $status[] = 'authorize[OK]'; else $status[] = 'authorize[X]';
            if ($hasRules)     $status[] = 'rules[OK]'; else $status[] = 'rules[X]';

            $this->line("   " . basename($rel) . " : " . implode(' ', $status));

            // Détecter une corruption : méthodes après dernière }
            $lastBrace = strrpos($content, '}');
            $tail = substr($content, $lastBrace - 50, 200);
            if (preg_match('/\}\s*public function/', $content)) {
                $this->error("      [!]️  CORROMPU : méthodes après la fermeture de classe !");
            }
        }

        // ===============================================
        // 3. État de UserModel
        // ===============================================
        $this->line('');
        $this->line('> 3. État de UserModel');

        $userModelPath = app_path('Infrastructure/Persistence/Eloquent/Models/UserModel.php');
        if (File::exists($userModelPath)) {
            $content = File::get($userModelPath);
            $this->line('   Fichier : ' . File::size($userModelPath) . ' octets');

            // Extraire la déclaration de classe
            if (preg_match('/class\s+(\w+)\s+extends\s+([\w\\\\]+)/', $content, $m)) {
                $this->line("   Classe : {$m[1]} extends {$m[2]}");
            } else {
                $this->error("   [!]️  Déclaration de classe non reconnue !");
            }

            if (str_contains($content, '$fillable')) {
                $this->line('   [OK] $fillable défini');
            } else {
                $this->line('   [!]️  $fillable absent');
            }

            if (str_contains($content, '$guarded')) {
                $this->line('   [OK] $guarded défini');
            } else {
                $this->line('   [!]️  $guarded absent');
            }

            // Afficher la ligne de classe complète
            $lines = explode("\n", $content);
            foreach ($lines as $i => $line) {
                if (str_contains($line, 'class UserModel')) {
                    $this->line("   Ligne " . ($i + 1) . " : " . trim($line));
                    break;
                }
            }
        } else {
            $this->error("   [X] UserModel.php introuvable");
        }

        // ===============================================
        // 4. Nettoyage réel des .bak (SANS en recréer)
        // ===============================================
        $this->line('');
        $this->line('> 4. Nettoyage des .bak');

        $baksInApp = collect(File::allFiles(app_path()))
            ->filter(fn($f) => str_contains($f->getFilename(), '.bak'));

        $this->line('   ' . $baksInApp->count() . ' fichiers .bak dans app/');

        if ($baksInApp->count() > 0) {
            $dest = storage_path('backups/' . date('Y-m-d_His'));
            if (!File::exists($dest)) File::makeDirectory($dest, 0755, true);

            foreach ($baksInApp as $b) {
                $relative = str_replace(
                    [app_path() . DIRECTORY_SEPARATOR, DIRECTORY_SEPARATOR],
                    ['', '_'],
                    $b->getPathname()
                );
                File::move($b->getPathname(), $dest . DIRECTORY_SEPARATOR . $relative);
            }
            $this->info('   [OK] Déplacés vers ' . $dest);
        }

        // ===============================================
        // 5. Vérification que les fichiers clés sont intacts
        // ===============================================
        $this->line('');
        $this->line('> 5. Vérification syntaxe PHP des fichiers critiques');

        $criticalFiles = [
            app_path('Http/Controllers/Admin/FormateurController.php'),
            app_path('Http/Requests/Auth/Formateur/LoginFormateurRequest.php'),
            app_path('Http/Requests/Filiere/StoreFiliereRequest.php'),
            app_path('Http/Requests/Session/StoreSessionRequest.php'),
            app_path('Infrastructure/Persistence/Eloquent/Models/UserModel.php'),
        ];

        foreach ($criticalFiles as $file) {
            if (!File::exists($file)) {
                $this->error('   [X] ' . basename($file) . ' introuvable');
                continue;
            }

            $output = [];
            $return = 0;
            exec('php -l "' . $file . '" 2>&1', $output, $return);

            if ($return === 0) {
                $this->info('   [OK] ' . basename($file) . ' - syntaxe OK');
            } else {
                $this->error('   [X] ' . basename($file) . ' - ERREUR SYNTAXE :');
                foreach ($output as $o) $this->line('      ' . $o);
            }
        }

        // ===============================================
        // 6. Caches
        // ===============================================
        $this->line('');
        $this->line('> 6. Vidage des caches');
        $this->call('optimize:clear');
        $this->call('view:clear');
        $this->call('route:clear');
        $this->call('config:clear');

        $this->line('');
        $this->line('+==========================================================+');
        $this->line('|   -> ENVOYEZ-MOI TOUT CE RAPPORT                         |');
        $this->line('+==========================================================+');

        return self::SUCCESS;
    }
}