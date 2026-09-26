<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class NotificationsModalEnhanced extends Command
{
    protected $signature = 'project:notifications-modal-enhanced
                            {--backup : Sauvegarder les fichiers (.bak)}
                            {--force : Écraser sans confirmation}';

    protected $description = 'Supprime la page notifications + ajoute liens et bouton supprimer dans la modal';

    public function handle(): int
    {
        $this->info("[TARGET] Amélioration de la modal notifications");
        $this->newLine();

        if (!$this->option('force') && !$this->confirm('Continuer ?', true)) {
            $this->warn('Annulé.');
            return self::FAILURE;
        }

        // ============================================================
        // 1. SUPPRIMER les routes de la page notifications
        // ============================================================
        $routesPath = base_path('routes/admin.php');

        if (File::exists($routesPath)) {
            if ($this->option('backup')) {
                File::copy($routesPath, $routesPath . '.bak.' . date('Y-m-d_H-i-s'));
            }

            $routesContent = File::get($routesPath);

            // Supprimer la route GET /notifications (index)
            $routesContent = preg_replace(
                "/Route::get\('\/',\s*\[NotificationController::class,\s*'index'\]\)->name\('index'\);\s*\n/",
                '',
                $routesContent
            );

            // Supprimer la route GET /notifications/recent (dropdown supprimé)
            $routesContent = preg_replace(
                "/Route::get\('\/recent',\s*\[NotificationController::class,\s*'recent'\]\)->name\('recent'\);\s*\n/",
                '',
                $routesContent
            );

            // Supprimer la route count (badge supprimé car on utilise modal)
            // On garde count pour le badge
            // $routesContent = preg_replace(...);

            File::put($routesPath, $routesContent);
            $this->line("  [OK] routes/admin.php : routes index + recent supprimées");
        }

        // ============================================================
        // 2. SUPPRIMER la vue de la page notifications
        // ============================================================
        $viewPath = base_path('resources/views/admin/notifications/index.blade.php');

        if (File::exists($viewPath)) {
            if ($this->option('backup')) {
                File::copy($viewPath, $viewPath . '.bak.' . date('Y-m-d_H-i-s'));
            }
            File::delete($viewPath);
            $this->line("  [OK] Vue admin/notifications/index.blade.php supprimée");
        }

        // ============================================================
        // 3. MODIFIER la modal dans layouts/admin.blade.php
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

        // ============================================================
        // 3a. Remplacer le rendu des notifications (avec lien + bouton supprimer)
        // ============================================================
        $oldRenderPattern = '/list\.innerHTML = notifications\.map\(n => \{[\s\S]*?\}\)\.join\(\'\'\);/';

        $newRender = <<<'JS'
list.innerHTML = notifications.map(n => {
                const style = icons[n.type] || icons.info;
                const luClass = n.lu ? 'opacity-60' : '';
                const bgClass = n.lu ? '' : 'bg-emerald-50/20';
                const titre = escapeHtml(n.titre || 'Sans titre');
                const message = escapeHtml(n.message || '');
                const date = escapeHtml(n.date || '');
                const icone = escapeHtml(n.icone || 'info');
                const lien = n.lien || '';

                return `
                    <div class="group relative flex items-start gap-4 px-6 py-4
                                border-b border-slate-100 last:border-0
                                hover:bg-slate-50 transition ${luClass} ${bgClass}">

                        <div class="w-10 h-10 rounded-lg ${style.bg} border ${style.border}
                                    flex items-center justify-center shrink-0">
                            <span class="material-symbols-rounded ${style.color} text-[20px]">${icone}</span>
                        </div>

                        <div class="flex-1 min-w-0">
                            <div class="flex items-start justify-between gap-2">
                                <div class="font-bold text-slate-900 text-[14px]">${titre}</div>
                                <div class="text-[11px] text-slate-400 whitespace-nowrap">${date}</div>
                            </div>
                            <div class="text-[13px] text-slate-600 mt-1 leading-relaxed">${message}</div>

                            <div class="flex items-center gap-3 mt-3">
                                ${lien ? `
                                    <a href="${lien}"
                                       class="inline-flex items-center gap-1 text-[12px] font-semibold
                                              text-emerald-700 hover:text-emerald-800 transition">
                                        Voir
                                        <span class="material-symbols-rounded text-[14px]">arrow_forward</span>
                                    </a>
                                ` : ''}

                                ${!n.lu ? `
                                    <button type="button"
                                            onclick="marquerCommeLu(${n.id})"
                                            class="inline-flex items-center gap-1 text-[12px] font-semibold
                                                   text-slate-500 hover:text-slate-700 transition">
                                        <span class="material-symbols-rounded text-[14px]">done</span>
                                        Marquer comme lu
                                    </button>
                                ` : ''}

                                <button type="button"
                                        onclick="supprimerNotification(${n.id})"
                                        class="inline-flex items-center gap-1 text-[12px] font-semibold
                                               text-red-500 hover:text-red-700 transition">
                                    <span class="material-symbols-rounded text-[14px]">delete</span>
                                    Supprimer
                                </button>
                            </div>
                        </div>
                    </div>
                `;
            }).join('');
JS;

        if (preg_match($oldRenderPattern, $layoutContent)) {
            $layoutContent = preg_replace($oldRenderPattern, $newRender, $layoutContent);
            $this->line("  [OK] Rendu notifications remplacé (avec lien + boutons)");
        } else {
            $this->warn("  [!]️  Rendu notifications non trouvé");
        }

        // ============================================================
        // 3b. Ajouter les fonctions JS marquerCommeLu() et supprimerNotification()
        // ============================================================
        $newFunctions = <<<'JS'

    // ============================================
    // Marquer une notification comme lue
    // ============================================
    async function marquerCommeLu(id) {
        try {
            const response = await fetch(`/admin/notifications/${id}/read`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                }
            });

            if (response.ok) {
                // Recharger la liste
                chargerNotifications();

                // Mettre à jour le badge
                fetch('{{ route("admin.notifications.count") }}', {
                    headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' }
                })
                .then(r => r.json())
                .then(data => {
                    const badge = document.getElementById('notif-badge');
                    const nonLues = parseInt(data.non_lues) || 0;
                    if (badge) {
                        if (nonLues > 0) {
                            badge.textContent = nonLues > 99 ? '99+' : nonLues;
                            badge.classList.remove('hidden');
                        } else {
                            badge.classList.add('hidden');
                        }
                    }
                });
            }
        } catch (error) {
            console.error('Erreur:', error);
        }
    }

    // ============================================
    // Supprimer une notification
    // ============================================
    async function supprimerNotification(id) {
        if (!confirm('Supprimer cette notification ?')) {
            return;
        }

        try {
            const response = await fetch(`/admin/notifications/${id}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                }
            });

            if (response.ok) {
                // Recharger la liste
                chargerNotifications();

                // Mettre à jour le badge
                fetch('{{ route("admin.notifications.count") }}', {
                    headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' }
                })
                .then(r => r.json())
                .then(data => {
                    const badge = document.getElementById('notif-badge');
                    const nonLues = parseInt(data.non_lues) || 0;
                    if (badge) {
                        if (nonLues > 0) {
                            badge.textContent = nonLues > 99 ? '99+' : nonLues;
                            badge.classList.remove('hidden');
                        } else {
                            badge.classList.add('hidden');
                        }
                    }
                });
            }
        } catch (error) {
            console.error('Erreur:', error);
        }
    }

    // ============================================
    // Ouvrir une notification (rediriger vers le lien)
    // ============================================
    function ouvrirNotification(id, lien) {
        if (lien) {
            window.location.href = lien;
        }
    }

JS;

        // Insérer avant la fermeture </script>
        if (!str_contains($layoutContent, 'async function marquerCommeLu')) {
            $lastScriptClose = strrpos($layoutContent, '</script>');
            if ($lastScriptClose !== false) {
                $layoutContent = substr_replace($layoutContent, $newFunctions, $lastScriptClose, 0);
                $this->line("  [OK] Fonctions JS marquerCommeLu + supprimerNotification ajoutées");
            }
        }

        // ============================================================
        // 3c. Supprimer le lien footer "Voir toutes les notifications"
        // ============================================================
        $footerPattern = '/<div class="px-6 py-3\.5 border-t border-slate-200 bg-slate-50 text-center shrink-0">[\s\S]*?<\/div>/';
        $layoutContent = preg_replace($footerPattern, '', $layoutContent);

        // ============================================================
        // 4. Écrire
        // ============================================================
        File::put($layoutPath, $layoutContent);
        $this->line("  [OK] Layout admin mis à jour");

        // ============================================================
        // 5. Nettoyer les caches
        // ============================================================
        $this->newLine();
        $this->info("[CLEAN] Nettoyage des caches...");
        $this->call('route:clear');
        $this->call('view:clear');
        $this->call('cache:clear');

        $this->newLine();
        $this->info("✨ SUCCÈS");
        $this->line("  * Page /admin/notifications : SUPPRIMÉE");
        $this->line("  * Modal : liens + boutons ajoutés");
        $this->line("  * Bouton 'Marquer comme lu' : actif");
        $this->line("  * Bouton 'Supprimer' : actif");
        $this->newLine();
        $this->info("-> Testez : http://localhost:8000/admin/dashboard");

        return self::SUCCESS;
    }
}