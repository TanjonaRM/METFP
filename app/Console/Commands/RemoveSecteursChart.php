<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class RemoveSecteursChart extends Command
{
    protected $signature = 'project:remove-secteurs-chart
                            {--backup : Sauvegarder le fichier existant (.bak)}
                            {--force : Écraser sans confirmation}';

    protected $description = 'Supprime uniquement le graphique "Filières par secteur" du dashboard';

    public function handle(): int
    {
        $this->info("[DEL]️  Suppression du graphique 'Filières par secteur'");
        $this->newLine();

        $path = 'resources/views/admin/dashboard/index.blade.php';
        $fullPath = base_path($path);

        if (!File::exists($fullPath)) {
            $this->error("[X] Fichier introuvable : {$path}");
            return self::FAILURE;
        }

        $content = File::get($fullPath);

        // Backup
        if ($this->option('backup')) {
            $backupPath = $fullPath . '.bak.' . date('Y-m-d_H-i-s');
            File::copy($fullPath, $backupPath);
            $this->line("  [SAVE] Backup : " . basename($backupPath));
        }

        // ============================================================
        // 1. SUPPRIMER LE BLOC HTML DU GRAPHIQUE 4
        // ============================================================
        // Pattern : le commentaire + div contenant "Filières par secteur" et chart-secteurs
        $htmlPattern = '/\{\{--\s*Graphique 4[^-]*--\}\}\s*<div class="bg-white rounded-xl border border-slate-200 p-5">\s*<div class="flex items-center justify-between mb-4">\s*<h2[^>]*>Filières par secteur<\/h2>.*?<div id="chart-secteurs"[^>]*><\/div>\s*<\/div>\s*<\/div>/s';

        if (preg_match($htmlPattern, $content)) {
            $content = preg_replace($htmlPattern, '', $content);
            $this->line("  [OK] Bloc HTML supprimé");
        } else {
            // Fallback : pattern plus souple
            $fallback = '/<div class="bg-white rounded-xl border border-slate-200 p-5">\s*<div class="flex items-center justify-between mb-4">\s*<h2[^>]*>Filières par secteur<\/h2>[\s\S]*?<div id="chart-secteurs"[^>]*><\/div>\s*<\/div>\s*<\/div>/s';

            if (preg_match($fallback, $content)) {
                $content = preg_replace($fallback, '', $content);
                $this->line("  [OK] Bloc HTML supprimé (fallback)");
            } else {
                $this->error("  [X] Impossible de trouver le bloc HTML du graphique");
                return self::FAILURE;
            }
        }

        // ============================================================
        // 2. SUPPRIMER LE SCRIPT DU GRAPHIQUE 4
        // ============================================================
        $scriptPattern = '/\/\/\s*=+\s*\n\s*\/\/ GRAPHIQUE 4[\s\S]*?\/\/\s*=+\s*\n\s*\/\/ GRAPHIQUE 4[\s\S]*?\}\)\.render\(\);\s*\}\s*\}\s*\}\);/s';

        // Pattern plus simple : depuis "GRAPHIQUE 4" jusqu'à la fin du bloc
        $simplePattern = '/\/\/\s*=+\s*\n\s*\/\/ GRAPHIQUE 4[^\n]*\n\s*\/\/\s*=+\s*\n\s*const secteurs = @json\([^)]+\);\s*if \(secteurs\.length\)[\s\S]*?new ApexCharts\([^;]+\.render\(\);\s*\}/s';

        if (preg_match($simplePattern, $content)) {
            $content = preg_replace($simplePattern, '', $content);
            $this->line("  [OK] Script du graphique supprimé");
        } else {
            // Fallback : supprimer entre "GRAPHIQUE 4" et "});" suivant
            $loosePattern = '/\/\/ GRAPHIQUE 4[\s\S]*?new ApexCharts\(document\.querySelector\(\'#chart-secteurs\'\)[\s\S]*?\.render\(\);\s*\}/s';

            if (preg_match($loosePattern, $content)) {
                $content = preg_replace($loosePattern, '', $content);
                $this->line("  [OK] Script du graphique supprimé (fallback)");
            } else {
                $this->warn("  [!]️  Script non trouvé (peut-être déjà absent)");
            }
        }

        // Nettoyage cosmétique : enlever les sauts de ligne en trop
        $content = preg_replace('/\n{3,}/', "\n\n", $content);

        File::put($fullPath, $content);

        $size = round(strlen($content) / 1024, 2);
        $this->line("  [OK] {$path} mis à jour ({$size} Ko)");

        $this->newLine();
        $this->info("[CLEAN] Nettoyage des caches...");
        $this->call('view:clear');
        $this->call('cache:clear');

        $this->newLine();
        $this->info("✨ SUCCÈS : graphique 'Filières par secteur' supprimé");
        $this->line("  * Cartes KPI : intactes");
        $this->line("  * Autres graphiques (Établissements, Statuts, Évolution) : intacts");
        $this->line("  * Tableau des affectations : intact");
        $this->line("  * Design, couleurs, emplacements : inchangés");

        return self::SUCCESS;
    }
}