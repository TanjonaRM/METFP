<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class FixNotificationsDropdown extends Command
{
    protected $signature = 'project:fix-notifications-dropdown
                            {--backup : Sauvegarder les fichiers (.bak)}
                            {--force : Écraser sans confirmation}';

    protected $description = 'Corrige le dropdown de notifications admin (endpoint JSON dédié)';

    public function handle(): int
    {
        $this->info("🔔 Correction du dropdown notifications admin");
        $this->newLine();

        if (!$this->option('force') && !$this->confirm('Corriger route + contrôleur + layout ?', true)) {
            $this->warn('Annulé.');
            return self::FAILURE;
        }

        // ============================================================
        // 1. Ajouter la route /admin/notifications/recent
        // ============================================================
        $routesPath = base_path('routes/admin.php');

        if (!File::exists($routesPath)) {
            $this->error("[X] routes/admin.php introuvable");
            return self::FAILURE;
        }

        if ($this->option('backup')) {
            File::copy($routesPath, $routesPath . '.bak.' . date('Y-m-d_H-i-s'));
        }

        $routesContent = File::get($routesPath);

        if (!str_contains($routesContent, 'notifications/recent')) {
            $pattern = "/(Route::get\('\/count',\s*\[NotificationController::class,\s*'count'\]\)->name\('count'\);)/";

            if (preg_match($pattern, $routesContent)) {
                $routesContent = preg_replace(
                    $pattern,
                    '$1' . "\n            Route::get('/recent', [NotificationController::class, 'recent'])->name('recent');",
                    $routesContent
                );
                File::put($routesPath, $routesContent);
                $this->line("  [OK] Route /admin/notifications/recent ajoutée");
            } else {
                $this->error("  [X] Impossible de trouver la route count");
                return self::FAILURE;
            }
        } else {
            $this->line("  [!]️  Route recent existe déjà");
        }

        // ============================================================
        // 2. Ajouter la méthode recent() au contrôleur
        // ============================================================
        $controllerPath = base_path('app/Http/Controllers/Admin/NotificationController.php');

        if (!File::exists($controllerPath)) {
            $this->error("  [X] NotificationController introuvable");
            return self::FAILURE;
        }

        if ($this->option('backup')) {
            File::copy($controllerPath, $controllerPath . '.bak.' . date('Y-m-d_H-i-s'));
        }

        $controllerContent = File::get($controllerPath);

        if (!str_contains($controllerContent, 'public function recent()')) {
            $method = <<<'PHP'

    /**
     * Retourne les 15 dernières notifications (JSON)
     * Utilisé par le dropdown dans le header
     */
    public function recent()
    {
        $notifications = Notification::where(function ($q) {
                $q->whereNull('user_id')
                  ->orWhere('user_id', \Illuminate\Support\Facades\Auth::guard('admin')->id());
            })
            ->latest()
            ->take(15)
            ->get()
            ->map(fn($n) => [
                'id'      => $n->id,
                'titre'   => $n->titre,
                'message' => $n->message,
                'type'    => $n->type,
                'icone'   => $n->icone ?? 'notifications',
                'lu'      => (bool) $n->lu,
                'lien'    => $n->lien,
                'date'    => $n->created_at?->diffForHumans(),
            ]);

        $nonLues = Notification::where(function ($q) {
                $q->whereNull('user_id')
                  ->orWhere('user_id', \Illuminate\Support\Facades\Auth::guard('admin')->id());
            })
            ->where('lu', false)
            ->count();

        return response()->json([
            'notifications' => $notifications,
            'non_lues'      => $nonLues,
        ]);
    }
PHP;

            // Insérer avant la dernière accolade
            $lastBracePos = strrpos($controllerContent, '}');
            $controllerContent = substr_replace($controllerContent, $method . "\n", $lastBracePos);

            File::put($controllerPath, $controllerContent);
            $this->line("  [OK] Méthode recent() ajoutée au contrôleur");
        } else {
            $this->line("  [!]️  Méthode recent() existe déjà");
        }

        // ============================================================
        // 3. Corriger le JS dans layouts/admin.blade.php
        // ============================================================
        $layoutPath = base_path('resources/views/layouts/admin.blade.php');

        if (!File::exists($layoutPath)) {
            $this->error("  [X] Layout admin introuvable");
            return self::FAILURE;
        }

        if ($this->option('backup')) {
            File::copy($layoutPath, $layoutPath . '.bak.' . date('Y-m-d_H-i-s'));
        }

        $layoutContent = File::get($layoutPath);

        // Remplacer l'URL de chargement des notifications dans chargerNotifications()
        // On remplace UNIQUEMENT à l'intérieur de la fonction chargerNotifications

        // Pattern : dans chargerNotifications, remplacer admin.notifications.index par admin.notifications.recent
        $pattern = "/(async function chargerNotifications\(\) \{[\s\S]*?fetch\('{{ route\(\"admin\.notifications)\.index(\"\) }}')/";

        $replaced = preg_replace(
            $pattern,
            '$1.recent$2',
            $layoutContent,
            1
        );

        if ($replaced !== null && $replaced !== $layoutContent) {
            $layoutContent = $replaced;
            $this->line("  [OK] JS chargerNotifications() mis à jour");
        } else {
            // Fallback : chercher et remplacer manuellement dans chargerNotifications
            $this->warn("  [!]️  Pattern principal non trouvé, essai alternatif...");

            // Trouver la fonction chargerNotifications et remplacer dedans
            $funcPattern = "/(async function chargerNotifications\(\) \{[\s\S]*?\n    \})/";

            if (preg_match($funcPattern, $layoutContent, $matches)) {
                $oldFunc = $matches[1];
                $newFunc = str_replace(
                    "admin.notifications.index",
                    "admin.notifications.recent",
                    $oldFunc
                );
                $layoutContent = str_replace($oldFunc, $newFunc, $layoutContent);
                $this->line("  [OK] JS chargerNotifications() corrigé (fallback)");
            } else {
                $this->error("  [X] Impossible de trouver chargerNotifications()");
                return self::FAILURE;
            }
        }

        File::put($layoutPath, $layoutContent);

        // ============================================================
        // 4. Nettoyer les caches
        // ============================================================
        $this->newLine();
        $this->info("[CLEAN] Nettoyage des caches...");
        $this->call('route:clear');
        $this->call('view:clear');
        $this->call('cache:clear');

        $this->newLine();
        $this->info("✨ SUCCÈS : dropdown notifications corrigé");
        $this->line("  * Route JSON : /admin/notifications/recent");
        $this->line("  * Méthode : NotificationController::recent()");
        $this->line("  * JS : chargerNotifications() pointe vers recent");

        return self::SUCCESS;
    }
}