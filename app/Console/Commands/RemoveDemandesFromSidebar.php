<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class RemoveDemandesFromSidebar extends Command
{
    protected $signature = 'project:remove-demandes-from-sidebar
                            {--backup : Sauvegarder le fichier (.bak)}
                            {--force : Écraser sans confirmation}';

    protected $description = 'Supprime les liens "Demandes affect." et "Demandes sessions" du menu sidebar admin';

    public function handle(): int
    {
        $this->info("[DEL]️  Suppression des liens Demandes du sidebar");
        $this->newLine();

        $path = 'resources/views/layouts/admin.blade.php';
        $fullPath = base_path($path);

        if (!File::exists($fullPath)) {
            $this->error("[X] Fichier introuvable : {$path}");
            return self::FAILURE;
        }

        if ($this->option('backup')) {
            $backupPath = $fullPath . '.bak.' . date('Y-m-d_H-i-s');
            File::copy($fullPath, $backupPath);
            $this->line("  [SAVE] Backup : " . basename($backupPath));
        }

        $content = File::get($fullPath);
        $originalSize = strlen($content);

        // ============================================================
        // 1. Supprimer "Demandes affect."
        // ============================================================
        $affectationPattern = "/\s*\['route'\s*=>\s*'admin\.demandes-affectations\.\*'[^\]]*\],\s*\n/";

        if (preg_match($affectationPattern, $content)) {
            $content = preg_replace($affectationPattern, '', $content);
            $this->line("  [OK] Lien 'Demandes affect.' supprimé");
        } else {
            // Fallback : pattern plus souple
            $fallback = "/\s*\[\s*'route'\s*=>\s*'admin\.demandes-affectations[^\]]*\],/s";
            if (preg_match($fallback, $content)) {
                $content = preg_replace($fallback, '', $content);
                $this->line("  [OK] Lien 'Demandes affect.' supprimé (fallback)");
            } else {
                $this->warn("  [!]️  Lien 'Demandes affect.' non trouvé");
            }
        }

        // ============================================================
        // 2. Supprimer "Demandes sessions"
        // ============================================================
        $sessionPattern = "/\s*\['route'\s*=>\s*'admin\.demandes-sessions\.\*'[^\]]*\],\s*\n/";

        if (preg_match($sessionPattern, $content)) {
            $content = preg_replace($sessionPattern, '', $content);
            $this->line("  [OK] Lien 'Demandes sessions' supprimé");
        } else {
            $fallback = "/\s*\[\s*'route'\s*=>\s*'admin\.demandes-sessions[^\]]*\],/s";
            if (preg_match($fallback, $content)) {
                $content = preg_replace($fallback, '', $content);
                $this->line("  [OK] Lien 'Demandes sessions' supprimé (fallback)");
            } else {
                $this->warn("  [!]️  Lien 'Demandes sessions' non trouvé");
            }
        }

        // ============================================================
        // 3. Nettoyer les lignes vides multiples
        // ============================================================
        $content = preg_replace("/\n{3,}/", "\n\n", $content);

        // ============================================================
        // 4. Écrire le fichier
        // ============================================================
        File::put($fullPath, $content);

        $newSize = strlen($content);
        $diff = $originalSize - $newSize;
        $this->line("  [OK] Fichier mis à jour (-{$diff} octets)");

        // ============================================================
        // 5. Nettoyer les caches
        // ============================================================
        $this->newLine();
        $this->info("[CLEAN] Nettoyage des caches...");
        $this->call('view:clear');
        $this->call('cache:clear');

        $this->newLine();
        $this->info("✨ SUCCÈS : Menu sidebar nettoyé");
        $this->line("  * Les demandes sont maintenant DANS Affectations et Sessions");
        $this->line("  * Menu simplifié");

        return self::SUCCESS;
    }
}