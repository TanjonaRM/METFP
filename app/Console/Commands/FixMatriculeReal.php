<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class FixMatriculeReal extends Command
{
    protected $signature = 'fix:matricule-real
                            {--show : Afficher le contenu du fichier avant modification}
                            {--readonly : Rendre le champ readonly}';

    protected $description = 'Modifie le VRAI fichier form.blade.php pour colorer le matricule';

    public function handle(): int
    {
        $this->line('');
        $this->line('+==========================================================+');
        $this->line('|   [THEME] COLORER LE CHAMP MATRICULE (VRAI FICHIER)            |');
        $this->line('+==========================================================+');
        $this->line('');

        $path = resource_path('views/admin/formateurs/partials/form.blade.php');

        if (!File::exists($path)) {
            $this->error("[X] Fichier introuvable : {$path}");
            return self::FAILURE;
        }

        // Mode affichage
        if ($this->option('show')) {
            $this->line('[FILE] Contenu du fichier :');
            $this->line('');
            $lines = explode("\n", File::get($path));
            foreach ($lines as $i => $line) {
                $this->line(sprintf('%4d | %s', $i + 1, $line));
            }
            return self::SUCCESS;
        }

        // Backup
        File::copy($path, $path . '.bak.' . date('Y-m-d_His'));
        $this->line('[SAVE] Backup créé');

        $content = File::get($path);
        $original = $content;
        $modifications = [];

        // ===============================================
        // 1. Chercher l'input matricule
        // ===============================================

        // Regex TRÈS LARGE pour trouver l'input matricule
        $pattern = '/(<input\b[^>]*name="matricule"[^>]*>)/s';

        if (preg_match($pattern, $content, $m)) {
            $input = $m[1];
            $this->info('[OK] Input matricule trouvé');
            $this->line('');
            $this->line('[FILE] Input actuel :');
            $this->line('   ' . $input);
            $this->line('');

            // Modifier la classe
            if (preg_match('/class="([^"]*)"/', $input, $cm)) {
                $classes = $cm[1];
                $addClasses = [];

                // Toujours ajouter
                if (!str_contains($classes, 'text-black'))   $addClasses[] = 'text-black';
                if (!str_contains($classes, 'font-medium'))  $addClasses[] = 'font-medium';

                // Si readonly demandé
                if ($this->option('readonly')) {
                    if (!str_contains($classes, 'bg-slate-50'))        $addClasses[] = 'bg-slate-50';
                    if (!str_contains($classes, 'cursor-not-allowed')) $addClasses[] = 'cursor-not-allowed';
                    if (!str_contains($classes, 'font-mono'))          $addClasses[] = 'font-mono';
                }

                if (!empty($addClasses)) {
                    $newClasses = $classes . ' ' . implode(' ', $addClasses);
                    $newInput = str_replace(
                        'class="' . $classes . '"',
                        'class="' . $newClasses . '"',
                        $input
                    );
                    $content = str_replace($input, $newInput, $content);

                    foreach ($addClasses as $c) {
                        $modifications[] = "[OK] Classe ajoutée : {$c}";
                    }
                } else {
                    $this->line('   ℹ️  Toutes les classes sont déjà présentes');
                }
            } else {
                // Pas de classe -> ajouter une classe complète
                $newInput = preg_replace(
                    '/<input\b/',
                    '<input class="text-black font-medium"',
                    $input,
                    1
                );
                $content = str_replace($input, $newInput, $content);
                $modifications[] = '[OK] Classe ajoutée (input sans class)';
            }

            // Si readonly demandé
            if ($this->option('readonly')) {
                if (!str_contains($input, 'readonly')) {
                    $content = preg_replace(
                        '/(<input\b[^>]*name="matricule")/',
                        '$1 readonly',
                        $content,
                        1
                    );
                    $modifications[] = '[OK] Attribut "readonly" ajouté';
                } else {
                    $this->line('   ℹ️  "readonly" déjà présent');
                }
            }
        } else {
            $this->error('[X] Impossible de trouver l\'input matricule');
            $this->line('');
            $this->line('-> Essayez de me montrer le contenu :');
            $this->line('   php artisan fix:matricule-real --show');
            return self::FAILURE;
        }

        // ===============================================
        // 2. Enregistrer
        // ===============================================

        if ($content === $original) {
            $this->line('');
            $this->warn('[!]️  Aucune modification');
        } else {
            File::put($path, $content);
            $this->line('');
            foreach ($modifications as $mod) {
                $this->info("   {$mod}");
            }
            $this->info('[SAVE] Fichier enregistré');
        }

        // ===============================================
        // 3. Vider les caches
        // ===============================================
        $this->line('');
        $this->line('> Vidage des caches');
        $this->call('view:clear');
        $this->call('optimize:clear');

        $this->line('');
        $this->line('+==========================================================+');
        $this->line('|   [SUCCESS] TERMINÉ                                              |');
        $this->line('+==========================================================+');
        $this->line('');
        $this->line('-> Testez : http://localhost:8000/admin/formateurs');
        $this->line('   Cliquez "Ajouter un formateur" (Ctrl+F5)');
        $this->line('   Le champ Matricule doit être NOIR');

        return self::SUCCESS;
    }
}