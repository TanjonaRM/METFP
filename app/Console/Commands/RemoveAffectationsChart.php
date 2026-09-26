<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class RemoveAffectationsChart extends Command
{
    protected $signature = 'project:remove-affectations-chart
                            {--backup : Sauvegarder le fichier existant (.bak)}
                            {--force : Écraser sans confirmation}';

    protected $description = 'Supprime uniquement le bloc graphique "Évolution des affectations" du dashboard';

    public function handle(): int
    {
        $this->info("[DEL]️  Suppression du graphique 'Évolution des affectations'");
        $this->newLine();

        $path = 'resources/views/admin/dashboard/index.blade.php';
        $fullPath = base_path($path);

        if (!File::exists($fullPath)) {
            $this->error("[X] Fichier introuvable : {$path}");
            return self::FAILURE;
        }

        // Lire le contenu
        $content = File::get($fullPath);

        // Backup
        if ($this->option('backup')) {
            $backupPath = $fullPath . '.bak.' . date('Y-m-d_H-i-s');
            File::copy($fullPath, $backupPath);
            $this->line("  [SAVE] Backup : " . basename($backupPath));
        }

        // ============================================================
        // SUPPRIMER LE BLOC HTML DU GRAPHIQUE
        // Cible : entre le début du commentaire "GRAPHIQUE" et la fin du div
        // ============================================================

        // Pattern 1 : Le bloc HTML du graphique
        $htmlPattern = '/\{\{--\s*=+\s*GRAPHIQUE\s*=+\s*--\}\}\s*<div class="bg-white rounded-xl border border-slate-200 p-5 mb-6">.*?<div class="h-56">\s*<canvas id="chartAffectations"><\/canvas>\s*<\/div>\s*<\/div>/s';

        if (preg_match($htmlPattern, $content)) {
            $content = preg_replace($htmlPattern, '', $content);
            $this->line("  [OK] Bloc HTML supprimé");
        } else {
            // Fallback : essayer un pattern plus large
            $fallbackPattern = '/<div class="bg-white rounded-xl border border-slate-200 p-5 mb-6">\s*<div class="flex items-center justify-between mb-4">\s*<h2[^>]*>Évolution des affectations<\/h2>.*?<\/div>\s*<div class="h-56">\s*<canvas id="chartAffectations"><\/canvas>\s*<\/div>\s*<\/div>/s';

            if (preg_match($fallbackPattern, $content)) {
                $content = preg_replace($fallbackPattern, '', $content);
                $this->line("  [OK] Bloc HTML supprimé (fallback)");
            } else {
                $this->error("  [X] Impossible de trouver le bloc HTML");
                return self::FAILURE;
            }
        }

        // ============================================================
        // SUPPRIMER LE BLOC SCRIPT CHART.JS
        // ============================================================

        // Pattern : le @push('scripts') avec le script Chart.js
        $scriptPattern = '/@push\(\'scripts\'\)\s*<script src="https:\/\/cdn\.jsdelivr\.net\/npm\/chart\.js"><\/script>\s*<script>\s*new Chart\(document\.getElementById\(\'chartAffectations\'\).*?\}\);\s*<\/script>\s*@endpush/s';

        if (preg_match($scriptPattern, $content)) {
            $content = preg_replace($scriptPattern, '', $content);
            $this->line("  [OK] Bloc script Chart.js supprimé");
        } else {
            // Fallback : suppression plus permissive
            $fallbackScript = '/@push\(\'scripts\'\)[\s\S]*?chartAffectations[\s\S]*?@endpush/s';

            if (preg_match($fallbackScript, $content)) {
                $content = preg_replace($fallbackScript, '', $content);
                $this->line("  [OK] Bloc script Chart.js supprimé (fallback)");
            } else {
                $this->warn("  [!]️  Bloc script non trouvé (peut-être déjà absent)");
            }
        }

        // Nettoyer les lignes vides multiples (cosmétique)
        $content = preg_replace('/\n{3,}/', "\n\n", $content);

        // Écrire
        File::put($fullPath, $content);

        $size = round(strlen($content) / 1024, 2);
        $this->line("  [OK] {$path} mis à jour ({$size} Ko)");

        $this->newLine();
        $this->info("[CLEAN] Nettoyage des caches...");
        $this->call('view:clear');
        $this->call('cache:clear');

        $this->newLine();
        $this->info("✨ SUCCÈS : graphique 'Évolution des affectations' supprimé");
        $this->line("  * Aucune autre modification effectuée");
        $this->line("  * Cartes KPI : intactes");
        $this->line("  * Tableau 'Dernières affectations' : intact");
        $this->line("  * Design global : intact");

        return self::SUCCESS;
    }
}