<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class FixModalPlacement extends Command
{
    protected $signature = 'fix:modal-placement
                            {--module= : filiere, etablissement ou tous}';

    protected $description = 'Corrige le placement du modal dans index.blade.php';

    public function handle(): int
    {
        $this->line('');
        $this->line('+==========================================================+');
        $this->line('|   [TOOL] CORRECTION DU PLACEMENT DU MODAL                     |');
        $this->line('+==========================================================+');
        $this->line('');

        $modules = [
            'filiere'       => ['singular' => 'Filiere',       'plural' => 'filieres'],
            'etablissement' => ['singular' => 'Etablissement', 'plural' => 'etablissements'],
        ];

        $only = $this->option('module');
        if ($only && isset($modules[$only])) {
            $modules = [$only => $modules[$only]];
        }

        foreach ($modules as $key => $info) {
            $this->processModule($info['singular'], $info['plural']);
            $this->line('');
        }

        // Vider les caches
        $this->line('> Vidage des caches');
        $this->call('optimize:clear');
        $this->call('view:clear');
        $this->call('route:clear');
        $this->info('[OK] Caches vidés');

        $this->line('');
        $this->line('+==========================================================+');
        $this->line('|   [SUCCESS] TERMINÉ                                              |');
        $this->line('+==========================================================+');
        $this->line('');
        $this->line('-> Testez : http://localhost:8000/admin/filieres (Ctrl+F5)');

        return self::SUCCESS;
    }

    private function processModule(string $singular, string $plural): void
    {
        $this->line('===========================================================');
        $this->line("[BOX] MODULE : {$singular}");
        $this->line('===========================================================');

        // ---------------------------------------------
        // 1. Afficher le contenu actuel
        // ---------------------------------------------
        $indexPath = resource_path("views/admin/{$plural}/index.blade.php");

        if (!File::exists($indexPath)) {
            $this->error("[X] Fichier introuvable : {$indexPath}");
            return;
        }

        File::copy($indexPath, $indexPath . '.bak.' . date('Y-m-d_His'));
        $this->line('[SAVE] Backup créé');

        $content = File::get($indexPath);

        // ---------------------------------------------
        // 2. Vérifier si @include est AVANT ou APRÈS @endsection
        // ---------------------------------------------
        $includePattern = "@include('admin.{$plural}.partials.modal-create')";
        $includePos = strpos($content, $includePattern);
        $lastEndSectionPos = strrpos($content, '@endsection');

        $this->line('');
        $this->line('> Analyse du positionnement');
        $this->line("   @include présent à la position : " . ($includePos !== false ? $includePos : 'ABSENT'));
        $this->line("   Dernier @endsection à la position : " . ($lastEndSectionPos !== false ? $lastEndSectionPos : 'ABSENT'));

        if ($includePos === false) {
            $this->error('   [X] @include absent - relancez add:modals-filiere-etablissement');
            return;
        }

        if ($lastEndSectionPos !== false && $includePos > $lastEndSectionPos) {
            $this->warn('   [!]️  @include est APRÈS @endsection -> IGNORÉ par Blade !');
            $this->line('   -> On va le déplacer AVANT');

            // Retirer l'include de sa position actuelle
            $content = str_replace("\n" . $includePattern, '', $content);
            $content = str_replace($includePattern . "\n", '', $content);
            $content = str_replace($includePattern, '', $content);

            // Réinsérer AVANT @endsection
            $lastEndSectionPos = strrpos($content, '@endsection');
            if ($lastEndSectionPos !== false) {
                $content = substr($content, 0, $lastEndSectionPos)
                    . "\n" . $includePattern . "\n\n"
                    . substr($content, $lastEndSectionPos);
                $this->info('   [OK] @include déplacé AVANT @endsection');
            }
        } else {
            $this->info('   [OK] @include bien placé (avant @endsection)');
        }

        // ---------------------------------------------
        // 3. Modifier le bouton "Ajouter"
        // ---------------------------------------------
        $this->line('');
        $this->line('> Modification du bouton "Ajouter"');

        $onclick = "onclick=\"open{$singular}Modal()\"";
        $hasOnclick = str_contains($content, $onclick);

        if ($hasOnclick) {
            $this->info('   [OK] Bouton a déjà onclick');
        } else {
            // Chercher le bouton "Ajouter" (plusieurs patterns)
            $patterns = [
                // Pattern 1 : <a href="{{ route('admin.filieres.create') }}" ...>Ajouter</a>
                '/(<a[^>]*href="\{\{\s*route\([\'"]admin\.' . $plural . '\.create[\'"]\)\s*\}\}"[^>]*)>(.*?Ajouter[^<]*)<\/a>/is',
                // Pattern 2 : <a href="...create..." ...>Ajouter</a>
                '/(<a[^>]*href="[^"]*' . $plural . '\/create"[^>]*)>(.*?Ajouter[^<]*)<\/a>/is',
                // Pattern 3 : bouton avec n'importe quel texte Ajouter
                '/(<a[^>]*class="[^"]*btn[^"]*"[^>]*>)\s*(<span[^>]*>[^<]*<\/span>)?\s*([^<]*Ajouter[^<]*)/is',
            ];

            $found = false;
            foreach ($patterns as $pattern) {
                if (preg_match($pattern, $content, $m)) {
                    // Extraire les attributs du <a>
                    $attrs = $m[1];

                    // Retirer href
                    $attrs = preg_replace('/\s*href="[^"]*"/', '', $attrs);

                    // Ajouter onclick et type="button"
                    if (!str_contains($attrs, 'onclick')) {
                        $attrs .= ' ' . $onclick;
                    }
                    if (!str_contains($attrs, 'type=')) {
                        $attrs .= ' type="button"';
                    }

                    // Reconstruire
                    $newBtn = '<button' . $attrs . '>' . $m[2] . '</button>';

                    $content = str_replace($m[0], $newBtn, $content);
                    $found = true;
                    $this->info('   [OK] Bouton "Ajouter" modifié avec onclick');
                    break;
                }
            }

            if (!$found) {
                $this->warn('   [!]️  Bouton introuvable automatiquement');
                $this->line('   -> Modifiez manuellement dans index.blade.php :');
                $this->line('      <button type="button" onclick="open' . $singular . 'Modal()" class="btn-primary">');
                $this->line('          <span class="material-symbols-rounded">add</span>');
                $this->line('          Ajouter');
                $this->line('      </button>');
            }
        }

        // ---------------------------------------------
        // 4. Vérifier que le contenu du modal est dans le HTML final
        // ---------------------------------------------
        $this->line('');
        $this->line('> Enregistrement');

        File::put($indexPath, $content);
        $this->info('   [OK] index.blade.php sauvegardé');
    }
}