<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;

class AddDemandesLinkToSidebar extends Command
{
    protected $signature = 'add:demandes-link-sidebar';
    protected $description = 'Ajoute le lien "Demandes formateurs" dans la sidebar admin avec badge';

    public function handle(): int
    {
        $this->line('');
        $this->line('+==========================================================+');
        $this->line('|   [LINK] AJOUT LIEN SIDEBAR ADMIN                             |');
        $this->line('+==========================================================+');

        // Chercher les fichiers layout/sidebar
        $candidates = [
            resource_path('views/layouts/admin.blade.php'),
            resource_path('views/layouts/partials/sidebar.blade.php'),
            resource_path('views/layouts/sidebar.blade.php'),
            resource_path('views/partials/sidebar.blade.php'),
            resource_path('views/admin/partials/sidebar.blade.php'),
        ];

        $found = null;
        foreach ($candidates as $p) {
            if (File::exists($p)) {
                $content = File::get($p);
                // Vérifier que c'est bien une sidebar
                if (str_contains($content, 'Formateurs') || str_contains($content, 'sidebar') || str_contains($content, 'Sidebar')) {
                    $found = $p;
                    $this->info("   [OK] Sidebar trouvée : " . str_replace(base_path(), '', $p));
                    break;
                }
            }
        }

        if (!$found) {
            $this->error('   [X] Impossible de trouver la sidebar');
            $this->line('   -> Cherchez manuellement le fichier contenant "Formateurs"');
            return self::FAILURE;
        }

        // Backup
        File::copy($found, $found . '.bak.' . date('Y-m-d_His'));
        $this->line('   [SAVE] Backup créé');

        $content = File::get($found);

        // Vérifier si déjà présent
        if (str_contains($content, 'demandes-formateurs')) {
            $this->warn('   >>️  Lien déjà présent');
            return self::SUCCESS;
        }

        // ===============================================
        // Trouver où insérer (après "Formateurs" ou "Établissements")
        // ===============================================

        // Bloc à insérer
        $linkBlock = <<<'BLADE'

            {{-- Demandes formateurs --}}
            <a href="{{ route('admin.demandes-formateurs.index') }}"
               class="sidebar-item @if(request()->routeIs('admin.demandes-formateurs.*')) active @endif">
                <span class="material-symbols-rounded">how_to_reg</span>
                <span>Demandes formateurs</span>
                @php
                    $pendingCount = \Infrastructure\Persistence\Eloquent\Models\FormateurUserModel::where('statut', 'en_attente')->count();
                @endphp
                @if($pendingCount > 0)
                    <span class="ml-auto inline-flex items-center justify-center min-w-[22px] h-[22px] px-1.5 text-[11px] font-bold text-white bg-red-500 rounded-full">
                        {{ $pendingCount }}
                    </span>
                @endif
            </a>
BLADE;

        // Essayer de trouver un point d'insertion après le lien "Formateurs"
        $patterns = [
            // Après le lien Formateurs
            '/(<a[^>]*href="[^"]*formateurs[^"]*"[^>]*>.*?<\/a>)/s',
            // Après le lien Établissements
            '/(<a[^>]*href="[^"]*etablissements[^"]*"[^>]*>.*?<\/a>)/s',
            // Après "Utilisateurs"
            '/(<a[^>]*href="[^"]*users[^"]*"[^>]*>.*?<\/a>)/s',
        ];

        $inserted = false;
        foreach ($patterns as $pattern) {
            if (preg_match($pattern, $content, $m)) {
                $content = str_replace($m[0], $m[0] . "\n" . $linkBlock, $content);
                $inserted = true;
                $this->info('   [OK] Lien inséré après le bloc Formateurs');
                break;
            }
        }

        if (!$inserted) {
            // Fallback : insérer avant </nav> ou </aside> ou la fin du groupe
            if (preg_match('/(<\/nav>|<\/aside>)/', $content, $m, PREG_OFFSET_CAPTURE)) {
                $pos = $m[0][1];
                $content = substr($content, 0, $pos) . $linkBlock . "\n\n" . substr($content, $pos);
                $inserted = true;
                $this->info('   [OK] Lien inséré avant </nav>');
            }
        }

        if (!$inserted) {
            $this->error('   [X] Impossible d\'insérer automatiquement');
            $this->line('   -> Ajoutez manuellement dans la sidebar :');
            $this->line($linkBlock);
            return self::FAILURE;
        }

        File::put($found, $content);

        // Vider les caches
        $this->call('optimize:clear');
        $this->call('view:clear');
        $this->info('   [OK] Caches vidés');

        $this->line('');
        $this->info('[SUCCESS] TERMINÉ !');
        $this->line('');
        $this->line('-> Rafraîchissez votre page admin (Ctrl+F5)');
        $this->line('   Vous verrez le lien "Demandes formateurs" avec un badge rouge');

        return self::SUCCESS;
    }
}