<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class FixNotificationControllerSyntax extends Command
{
    protected $signature = 'project:fix-notification-controller-syntax
                            {--backup : Sauvegarder les fichiers (.bak)}
                            {--force : Écraser sans confirmation}';

    protected $description = 'Répare la syntaxe du NotificationController admin (fichier cassé)';

    public function handle(): int
    {
        $this->info("[TOOL] Réparation du NotificationController admin");
        $this->newLine();

        if (!$this->option('force') && !$this->confirm('Réécrire complètement le fichier ?', true)) {
            $this->warn('Annulé.');
            return self::FAILURE;
        }

        $path = 'app/Http/Controllers/Admin/NotificationController.php';
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

        // ============================================================
        // Réécrire complètement le fichier proprement
        // ============================================================
        $content = $this->getController();
        File::put($fullPath, $content);

        $size = round(strlen($content) / 1024, 2);
        $this->line("  [OK] {$path} réécrit ({$size} Ko)");

        // ============================================================
        // Vérifier la syntaxe PHP
        // ============================================================
        $this->newLine();
        $this->info("[SEARCH] Vérification de la syntaxe...");

        $output = [];
        $returnCode = 0;
        exec('php -l "' . $fullPath . '"', $output, $returnCode);

        if ($returnCode === 0) {
            $this->line("  [OK] Syntaxe PHP correcte");
        } else {
            $this->error("  [X] Erreur de syntaxe :");
            foreach ($output as $line) {
                $this->line("     " . $line);
            }
        }

        // ============================================================
        // Vérifier aussi routes/admin.php
        // ============================================================
        $routesPath = base_path('routes/admin.php');

        if (File::exists($routesPath)) {
            $this->info("[SEARCH] Vérification de routes/admin.php...");
            exec('php -l "' . $routesPath . '"', $routesOutput, $routesCode);

            if ($routesCode === 0) {
                $this->line("  [OK] routes/admin.php syntaxe correcte");
            } else {
                $this->error("  [X] Erreur dans routes/admin.php :");
                foreach ($routesOutput as $line) {
                    $this->line("     " . $line);
                }
            }
        }

        // ============================================================
        // Nettoyer les caches
        // ============================================================
        $this->newLine();
        $this->info("[CLEAN] Nettoyage des caches...");
        $this->call('route:clear');
        $this->call('view:clear');
        $this->call('cache:clear');

        $this->newLine();
        $this->info("✨ SUCCÈS : NotificationController réparé");
        $this->line("  * Fichier réécrit proprement");
        $this->line("  * Méthodes : index, count, recent, markAsRead, markAllAsRead, destroy, destroyAll");
        $this->line("  * Testez : http://localhost:8000/admin/notifications");

        return self::SUCCESS;
    }

    protected function getController(): string
    {
        return <<<'PHP'
<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    /**
     * Liste des notifications (page HTML)
     */
    public function index(Request $request)
    {
        $query = Notification::query()
            ->where(function ($q) {
                $q->whereNull('user_id')
                  ->orWhere('user_id', Auth::guard('admin')->id());
            })
            ->latest();

        // Filtre par statut
        if ($request->filled('statut')) {
            if ($request->statut === 'non_lues') {
                $query->where('lu', false);
            } elseif ($request->statut === 'lues') {
                $query->where('lu', true);
            }
        }

        // Filtre par type
        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        // Recherche
        if ($request->filled('search')) {
            $s = $request->search;
            $query->where(function ($q) use ($s) {
                $q->where('titre', 'like', "%{$s}%")
                  ->orWhere('message', 'like', "%{$s}%");
            });
        }

        $notifications = $query->paginate(20)->withQueryString();

        // Statistiques
        $baseQuery = Notification::where(function ($q) {
            $q->whereNull('user_id')
              ->orWhere('user_id', Auth::guard('admin')->id());
        });

        $stats = [
            'total'    => (clone $baseQuery)->count(),
            'non_lues' => (clone $baseQuery)->where('lu', false)->count(),
            'lues'     => (clone $baseQuery)->where('lu', true)->count(),
        ];

        return view('admin.notifications.index', compact('notifications', 'stats'));
    }

    /**
     * Nombre de notifications non lues (JSON) - pour le badge
     */
    public function count()
    {
        $nonLues = Notification::where(function ($q) {
                $q->whereNull('user_id')
                  ->orWhere('user_id', Auth::guard('admin')->id());
            })
            ->where('lu', false)
            ->count();

        return response()->json([
            'non_lues' => $nonLues,
        ]);
    }

    /**
     * 15 dernières notifications (JSON) - pour le dropdown
     */
    public function recent()
    {
        $notifications = Notification::where(function ($q) {
                $q->whereNull('user_id')
                  ->orWhere('user_id', Auth::guard('admin')->id());
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
                  ->orWhere('user_id', Auth::guard('admin')->id());
            })
            ->where('lu', false)
            ->count();

        return response()->json([
            'notifications' => $notifications,
            'non_lues'      => $nonLues,
        ]);
    }

    /**
     * Marquer une notification comme lue
     */
    public function markAsRead(int $id)
    {
        $notification = Notification::findOrFail($id);
        $notification->update(['lu' => true]);

        if (request()->ajax() || request()->wantsJson()) {
            return response()->json(['success' => true]);
        }

        return back()->with('success', 'Notification marquée comme lue.');
    }

    /**
     * Tout marquer comme lu
     */
    public function markAllAsRead()
    {
        Notification::where(function ($q) {
                $q->whereNull('user_id')
                  ->orWhere('user_id', Auth::guard('admin')->id());
            })
            ->where('lu', false)
            ->update(['lu' => true]);

        if (request()->ajax() || request()->wantsJson()) {
            return response()->json(['success' => true]);
        }

        return back()->with('success', 'Toutes les notifications sont marquées comme lues.');
    }

    /**
     * Supprimer une notification
     */
    public function destroy(int $id)
    {
        Notification::findOrFail($id)->delete();

        if (request()->ajax() || request()->wantsJson()) {
            return response()->json(['success' => true]);
        }

        return back()->with('success', 'Notification supprimée.');
    }

    /**
     * Supprimer toutes les notifications lues
     */
    public function destroyAll()
    {
        Notification::where(function ($q) {
                $q->whereNull('user_id')
                  ->orWhere('user_id', Auth::guard('admin')->id());
            })
            ->where('lu', true)
            ->delete();

        if (request()->ajax() || request()->wantsJson()) {
            return response()->json(['success' => true]);
        }

        return back()->with('success', 'Notifications lues supprimées.');
    }
}
PHP;
    }
}