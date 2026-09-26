<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class FixAdminNotificationsFilter extends Command
{
    protected $signature = 'project:fix-admin-notifications-filter
                            {--backup : Sauvegarder le fichier (.bak)}
                            {--force : Écraser sans confirmation}';

    protected $description = 'Corrige le NotificationController admin pour inclure les notifications globales (user_id = null)';

    public function handle(): int
    {
        $this->info("[TOOL] Correction du filtre Notifications Admin");
        $this->newLine();

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
        // Réécrire complètement le controller
        // ============================================================
        $content = $this->getController();
        File::put($fullPath, $content);

        $size = round(strlen($content) / 1024, 2);
        $this->line("  [OK] {$path} réécrit ({$size} Ko)");

        // ============================================================
        // Nettoyer les caches
        // ============================================================
        $this->newLine();
        $this->info("[CLEAN] Nettoyage des caches...");
        $this->call('view:clear');
        $this->call('cache:clear');

        $this->newLine();
        $this->info("✨ SUCCÈS : filtre corrigé");
        $this->line("  * Notifications globales (user_id=null) désormais visibles");
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
     * Liste des notifications visibles par l'admin connecté
     * -> Inclut les notifications globales (user_id = null)
     * -> ET les notifications personnelles de l'admin
     */
    public function index(Request $request)
    {
        $query = Notification::query()
            ->where(function ($q) {
                // Notifications globales OU personnelles pour cet admin
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