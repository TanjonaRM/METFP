<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class TranslatePaginationButtons extends Command
{
    protected $signature = 'translate:pagination-buttons
                            {--restore : Restaurer les fichiers originaux}';

    protected $description = 'Traduit Previous/Next en Précédent/Suivant';

    public function handle(): int
    {
        $this->line('');
        $this->line('+==========================================================+');
        $this->line('|   [WORLD] TRADUCTION PAGINATION EN FRANÇAIS                    |');
        $this->line('+==========================================================+');
        $this->line('');

        if ($this->option('restore')) {
            return $this->restore();
        }

        // ===============================================
        // Étape 1 : Supprimer le CSS qui cachait le texte
        // ===============================================
        $this->line('> 1. Nettoyage du CSS de masquage');

        $layoutPath = resource_path('views/layouts/admin.blade.php');

        if (File::exists($layoutPath)) {
            File::copy($layoutPath, $layoutPath . '.bak.' . date('Y-m-d_His'));
            $content = File::get($layoutPath);

            // Retirer le bloc CSS injecté précédemment
            $pattern = '/\{\{-- =+ --\}\}\s*\{\{-- [THEME] Masquer.*?<\/style>/s';
            if (preg_match($pattern, $content)) {
                $content = preg_replace($pattern, '', $content);
                File::put($layoutPath, $content);
                $this->info('   [OK] CSS de masquage retiré');
            } else {
                // Essayer de retirer uniquement le <style id="pagination-hidden-text">
                $pattern2 = '/<style id="pagination-hidden-text">.*?<\/style>/s';
                if (preg_match($pattern2, $content)) {
                    $content = preg_replace($pattern2, '', $content);
                    File::put($layoutPath, $content);
                    $this->info('   [OK] CSS de masquage retiré');
                } else {
                    $this->line('   >>️  Aucun CSS à retirer');
                }
            }
        }

        // ===============================================
        // Étape 2 : Créer la vue de pagination custom en français
        // ===============================================
        $this->line('');
        $this->line('> 2. Création vue de pagination FR');

        $dir = resource_path('views/vendor/pagination');
        if (!File::exists($dir)) {
            File::makeDirectory($dir, 0755, true);
        }

        // Tailwind
        File::put($dir . '/tailwind.blade.php', $this->getFrenchPagination());
        $this->info('   [OK] vendor/pagination/tailwind.blade.php créé');

        // Bootstrap 4/5
        File::put($dir . '/bootstrap-4.blade.php', $this->getFrenchPagination());
        File::put($dir . '/bootstrap-5.blade.php', $this->getFrenchPagination());
        $this->info('   [OK] vendor/pagination/bootstrap-*.blade.php créés');

        // Default
        File::put($dir . '/default.blade.php', $this->getFrenchPagination());
        $this->info('   [OK] vendor/pagination/default.blade.php créé');

        // ===============================================
        // Étape 3 : Forcer la locale en français
        // ===============================================
        $this->line('');
        $this->line('> 3. Configuration locale FR');

        $appConfig = config_path('app.php');
        if (File::exists($appConfig)) {
            $config = File::get($appConfig);
            if (preg_match("/'locale'\s*=>\s*'([^']+)'/", $config, $m)) {
                $this->line("   Locale actuelle : {$m[1]}");
                if ($m[1] !== 'fr') {
                    $config = preg_replace(
                        "/'locale'\s*=>\s*'[^']+'/",
                        "'locale' => 'fr'",
                        $config
                    );
                    $config = preg_replace(
                        "/'fallback_locale'\s*=>\s*'[^']+'/",
                        "'fallback_locale' => 'fr'",
                        $config
                    );
                    File::copy($appConfig, $appConfig . '.bak.' . date('Y-m-d_His'));
                    File::put($appConfig, $config);
                    $this->info('   [OK] Locale changée en FR');
                } else {
                    $this->line('   [OK] Déjà en FR');
                }
            }
        }

        // ===============================================
        // Étape 4 : Vider les caches
        // ===============================================
        $this->line('');
        $this->line('> 4. Vidage des caches');
        $this->call('view:clear');
        $this->call('optimize:clear');
        $this->call('config:clear');
        $this->info('   [OK] Caches vidés');

        $this->line('');
        $this->line('+==========================================================+');
        $this->line('|   [SUCCESS] TERMINÉ                                              |');
        $this->line('+==========================================================+');
        $this->line('');
        $this->line('-> Testez : http://localhost:8000/admin/etablissements?page=2 (Ctrl+F5)');
        $this->line('   -> "« Précédent" et "Suivant »" en français');
        $this->line('   -> "Affichage de X à Y sur Z résultats" en français');

        return self::SUCCESS;
    }

    private function getFrenchPagination(): string
    {
        return <<<'BLADE'
{{-- =========================================================== --}}
{{-- Pagination FRANÇAIS - Tailwind CSS                        --}}
{{-- =========================================================== --}}

@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination" class="flex items-center justify-between">
        {{-- Informations texte (gauche) --}}
        <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
            <div>
                <p class="text-sm text-slate-700">
                    Affichage de
                    <span class="font-medium">{{ $paginator->firstItem() }}</span>
                    à
                    <span class="font-medium">{{ $paginator->lastItem() }}</span>
                    sur
                    <span class="font-medium">{{ $paginator->total() }}</span>
                    résultats
                </p>
            </div>

            {{-- Boutons de pagination (droite) --}}
            <div>
                <span class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px" aria-label="Pagination">

                    {{-- <-️ Bouton PRÉCÉDENT --}}
                    @if ($paginator->onFirstPage())
                        <span aria-disabled="true" aria-label="Précédent">
                            <span class="relative inline-flex items-center px-3 py-2 text-sm font-medium text-slate-400 bg-white border border-slate-300 cursor-not-allowed rounded-l-md">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                                <span class="ml-1">Précédent</span>
                            </span>
                        </span>
                    @else
                        <a href="{{ $paginator->previousPageUrl() }}" rel="prev"
                           class="relative inline-flex items-center px-3 py-2 text-sm font-medium text-slate-700 bg-white border border-slate-300 rounded-l-md hover:bg-slate-50 transition"
                           aria-label="Précédent">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                            </svg>
                            <span class="ml-1">Précédent</span>
                        </a>
                    @endif

                    {{-- [NUM] Numéros de page --}}
                    @foreach ($elements as $element)
                        @if (is_string($element))
                            <span aria-disabled="true">
                                <span class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-slate-700 bg-white border border-slate-300 cursor-default">
                                    {{ $element }}
                                </span>
                            </span>
                        @endif

                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                @if ($page == $paginator->currentPage())
                                    <span aria-current="page">
                                        <span class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-semibold text-white bg-emerald-600 border border-emerald-600 cursor-default">
                                            {{ $page }}
                                        </span>
                                    </span>
                                @else
                                    <a href="{{ $url }}"
                                       class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-slate-700 bg-white border border-slate-300 hover:bg-slate-50 transition"
                                       aria-label="Aller à la page {{ $page }}">
                                        {{ $page }}
                                    </a>
                                @endif
                            @endforeach
                        @endif
                    @endforeach

                    {{-- ->️ Bouton SUIVANT --}}
                    @if ($paginator->hasMorePages())
                        <a href="{{ $paginator->nextPageUrl() }}" rel="next"
                           class="relative inline-flex items-center px-3 py-2 -ml-px text-sm font-medium text-slate-700 bg-white border border-slate-300 rounded-r-md hover:bg-slate-50 transition"
                           aria-label="Suivant">
                            <span class="mr-1">Suivant</span>
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                            </svg>
                        </a>
                    @else
                        <span aria-disabled="true" aria-label="Suivant">
                            <span class="relative inline-flex items-center px-3 py-2 -ml-px text-sm font-medium text-slate-400 bg-white border border-slate-300 cursor-not-allowed rounded-r-md">
                                <span class="mr-1">Suivant</span>
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                </svg>
                            </span>
                        </span>
                    @endif
                </span>
            </div>
        </div>

        {{-- Version mobile --}}
        <div class="flex items-center justify-between w-full sm:hidden">
            <div class="text-sm text-slate-700">
                Page <span class="font-medium">{{ $paginator->currentPage() }}</span>
                sur <span class="font-medium">{{ $paginator->lastPage() }}</span>
            </div>

            <div class="flex gap-2">
                @if ($paginator->onFirstPage())
                    <span class="px-3 py-1.5 text-sm text-slate-400 bg-white border border-slate-300 rounded-md cursor-not-allowed">
                        Précédent
                    </span>
                @else
                    <a href="{{ $paginator->previousPageUrl() }}"
                       class="px-3 py-1.5 text-sm text-slate-700 bg-white border border-slate-300 rounded-md hover:bg-slate-50">
                        Précédent
                    </a>
                @endif

                @if ($paginator->hasMorePages())
                    <a href="{{ $paginator->nextPageUrl() }}"
                       class="px-3 py-1.5 text-sm text-slate-700 bg-white border border-slate-300 rounded-md hover:bg-slate-50">
                        Suivant
                    </a>
                @else
                    <span class="px-3 py-1.5 text-sm text-slate-400 bg-white border border-slate-300 rounded-md cursor-not-allowed">
                        Suivant
                    </span>
                @endif
            </div>
        </div>
    </nav>
@endif
BLADE;
    }

    private function restore(): int
    {
        $this->line('> Restauration des backups');

        $targets = [
            resource_path('views/layouts/admin.blade.php'),
            resource_path('views/vendor/pagination/tailwind.blade.php'),
            resource_path('views/vendor/pagination/bootstrap-4.blade.php'),
            resource_path('views/vendor/pagination/bootstrap-5.blade.php'),
            resource_path('views/vendor/pagination/default.blade.php'),
            config_path('app.php'),
        ];

        foreach ($targets as $target) {
            $backups = glob($target . '.bak.*');
            if (empty($backups)) continue;

            rsort($backups);
            File::copy($backups[0], $target);
            $this->info('   [OK] Restauré : ' . basename($target));
        }

        // Supprimer les vues de pagination custom
        foreach (['tailwind', 'bootstrap-4', 'bootstrap-5', 'default'] as $f) {
            $p = resource_path("views/vendor/pagination/{$f}.blade.php");
            if (File::exists($p)) {
                File::delete($p);
                $this->info("   [DEL]️  Supprimé : {$f}.blade.php");
            }
        }

        $this->call('view:clear');
        $this->call('optimize:clear');
        $this->call('config:clear');

        return self::SUCCESS;
    }
}