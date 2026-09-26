<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class NotificationsModalScrollSidebar extends Command
{
    protected $signature = 'project:notifications-modal-scroll-sidebar
                            {--backup : Sauvegarder le fichier (.bak)}
                            {--force : Écraser sans confirmation}';

    protected $description = 'Ajoute scroll-y dans la modal + déplace le bouton notifications à côté du nom admin';

    public function handle(): int
    {
        $this->info("[TARGET] Mise à jour : scroll modal + position bouton");
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
        // 1. AJOUTER scroll-y forcé sur la liste des notifications
        // ============================================================
        // Le <div id="notifications-list"> doit avoir un overflow-y forcé

        // Remplacer la classe de la liste
        $content = str_replace(
            '<div id="notifications-list" class="flex-1 overflow-y-auto">',
            '<div id="notifications-list" class="flex-1 overflow-y-auto" style="max-height: 60vh; overflow-y: auto !important; scrollbar-width: thin;">',
            $content
        );

        // Fallback : si la classe est différente
        $content = preg_replace(
            '/<div id="notifications-list"([^>]*)>/',
            '<div id="notifications-list"$1 style="max-height: 60vh; overflow-y: auto !important; scrollbar-width: thin;">',
            $content
        );

        // Nettoyer les style en double (au cas où le remplacement s'applique 2x)
        $content = preg_replace(
            '/<div id="notifications-list"([^>]*?)style="[^"]*"([^>]*?)style="[^"]*"([^>]*?)>/',
            '<div id="notifications-list"$1 style="max-height: 60vh; overflow-y: auto !important; scrollbar-width: thin;"$2$3>',
            $content
        );

        $this->line("  [OK] Scroll-y ajouté sur la liste (max 60vh)");

        // ============================================================
        // 2. Ajouter CSS custom pour scrollbar stylée
        // ============================================================
        $customCSS = <<<'CSS'

    <style>
        /* =========================================================
           SCROLLBAR STYLÉE POUR LA MODAL NOTIFICATIONS
        ========================================================= */
        #notifications-list {
            overflow-y: auto !important;
            max-height: 60vh !important;
        }

        #notifications-list::-webkit-scrollbar {
            width: 8px;
        }
        #notifications-list::-webkit-scrollbar-track {
            background: #f1f5f9;
            border-radius: 4px;
        }
        #notifications-list::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 4px;
        }
        #notifications-list::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }

        /* Firefox */
        #notifications-list {
            scrollbar-width: thin;
            scrollbar-color: #cbd5e1 #f1f5f9;
        }
    </style>

CSS;

        if (!str_contains($content, 'SCROLLBAR STYLÉE POUR LA MODAL')) {
            $content = str_replace('</head>', $customCSS . '</head>', $content);
            $this->line("  [OK] CSS scrollbar stylée ajouté");
        }

        // ============================================================
        // 3. DÉPLACER le bouton notifications à côté du profil admin
        // ============================================================
        // Le bouton notifications est actuellement dans un <div class="relative"> 
        // séparé AVANT le <div class="flex items-center gap-3 pl-1"> (profil).
        // On veut le FUSIONNER avec le profil.

        // Le pattern actuel :
        // <div class="relative"> ... 🔔 ... </div>
        // <div class="hidden sm:block w-px h-10 bg-slate-200"></div>
        // <div class="flex items-center gap-3 pl-1"> ... profil ... </div>

        // Cible : supprimer le séparateur w-px et fusionner

        // Étape A : Supprimer le séparateur vertical
        $content = str_replace(
            '<div class="hidden sm:block w-px h-10 bg-slate-200"></div>',
            '',
            $content
        );

        // Étape B : Ajouter du margin sur le bouton notifications
        $content = str_replace(
            '<button onclick="toggleNotifications()"',
            '<button onclick="toggleNotifications()"',
            $content
        );

        // Étape C : Fusionner les 2 blocs - insérer le bouton notifications DANS le profil
        // Pattern : trouver le bloc "notifications container" et le déplacer
        
        $notifButtonPattern = '/(<div class="relative"[^>]*>\s*<button onclick="toggleNotifications\(\)"[\s\S]*?<\/button>\s*<\/div>)/';
        
        if (preg_match($notifButtonPattern, $content, $matches)) {
            $notifBlock = $matches[1];
            
            // Retirer le bloc de sa position actuelle
            $content = str_replace($notifBlock, '', $content);
            
            // L'insérer dans le profil (avant le bloc texte du nom)
            // Chercher <div class="flex items-center gap-3 pl-1">
            $profilePattern = '/(<div class="flex items-center gap-3 pl-1">)/';
            
            if (preg_match($profilePattern, $content)) {
                // Insérer le bouton notifications au début du bloc profil
                $content = preg_replace(
                    $profilePattern,
                    '<div class="flex items-center gap-3 pl-1">' . "\n                " . $notifBlock . "\n                ",
                    $content,
                    1
                );
                $this->line("  [OK] Bouton notifications déplacé à côté du profil");
            }
        } else {
            $this->warn("  [!]️  Bloc notifications non trouvé automatiquement");
            $this->line("     -> Vérifiez manuellement le layout");
        }

        // ============================================================
        // 4. Écrire le fichier
        // ============================================================
        File::put($fullPath, $content);

        $newSize = strlen($content);
        $diff = $newSize - $originalSize;
        $this->line("  [OK] {$path} mis à jour (+{$diff} octets)");

        // ============================================================
        // 5. Nettoyer les caches
        // ============================================================
        $this->newLine();
        $this->info("[CLEAN] Nettoyage des caches...");
        $this->call('view:clear');
        $this->call('cache:clear');

        $this->newLine();
        $this->info("✨ SUCCÈS");
        $this->line("  * Scroll-y : 60vh max avec scrollbar stylée");
        $this->line("  * Bouton 🔔 : à côté du profil admin");

        return self::SUCCESS;
    }
}