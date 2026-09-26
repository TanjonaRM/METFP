<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class RedirectNotificationsToTabs extends Command
{
    protected $signature = 'project:redirect-notifications-to-tabs
                            {--backup : Sauvegarder les fichiers (.bak)}
                            {--force : Écraser sans confirmation}';

    protected $description = 'Redirige les notifications vers les pages fusionnées (Affectations/Sessions)';

    public function handle(): int
    {
        $this->info("[RELOAD] Redirection des notifications");
        $this->newLine();

        if (!$this->option('force') && !$this->confirm('Continuer ?', true)) {
            $this->warn('Annulé.');
            return self::FAILURE;
        }

        // ============================================================
        // 1. Mettre à jour NotificationService
        // ============================================================
        $servicePath = base_path('app/Services/NotificationService.php');

        if (File::exists($servicePath)) {
            if ($this->option('backup')) {
                File::copy($servicePath, $servicePath . '.bak.' . date('Y-m-d_H-i-s'));
            }
            File::put($servicePath, $this->getNotificationService());
            $this->line("  [OK] NotificationService mis à jour");
        } else {
            // Fallback : app/Services/NotificationService.php n'existe pas, utiliser l'ancien
            $altPath = base_path('app/Services/NotificationService.php');
            if (!File::exists(dirname($altPath))) {
                File::makeDirectory(dirname($altPath), 0755, true);
            }
            File::put($altPath, $this->getNotificationService());
            $this->line("  [OK] NotificationService créé");
        }

        // ============================================================
        // 2. Mettre à jour le contrôleur Admin (NotificationController)
        // ============================================================
        $controllerPath = base_path('app/Http/Controllers/Admin/NotificationController.php');

        if (File::exists($controllerPath)) {
            if ($this->option('backup')) {
                File::copy($controllerPath, $controllerPath . '.bak.' . date('Y-m-d H:i:s'));
            }
            File::put($controllerPath, $this->getNotificationController());
            $this->line("  [OK] NotificationController mis à jour");
        }

        // ============================================================
        // 3. Nettoyer les caches
        // ============================================================
        $this->newLine();
        $this->info("[CLEAN] Nettoyage des caches...");
        $this->call('view:clear');
        $this->call('cache:clear');
        $this->call('route:clear');

        $this->newLine();
        $this->info("✨ SUCCÈS : Notifications redirigées");
        $this->line("  * Demande affectation -> /admin/affectations (onglet Demandes)");
        $this->line("  * Demande session -> /admin/sessions (onglet Demandes)");

        return self::SUCCESS;
    }

    // ============================================================
    // SERVICE NOTIFICATIONS
    // ============================================================
    protected function getNotificationService(): string
    {
        return <<<'PHP'
<?php

namespace App\Services;

use App\Models\Notification;
use Infrastructure\Persistence\Eloquent\Models\DemandeAffectationModel;
use Infrastructure\Persistence\Eloquent\Models\DemandeSessionModel;

class NotificationService
{
    // ============================================================
    // NOTIFICATIONS ADMIN (demande créée par formateur)
    // ============================================================

    /**
     * Nouvelle demande d'affectation créée
     * -> Lien : /admin/affectations (onglet Demandes)
     */
    public static function demandeAffectationCreee(DemandeAffectationModel $demande): void
    {
        Notification::create([
            'user_id' => null,
            'titre'   => '[LIST] Nouvelle demande d\'affectation',
            'message' => ($demande->formateur->prenom ?? '') . ' ' . ($demande->formateur->nom ?? '')
                . ' (' . ($demande->formateur->matricule ?? '') . ') a soumis une demande d\'affectation.'
                . ($demande->filiere ? ' - Filière : ' . $demande->filiere->libelle : ''),
            'type'    => 'info',
            'icone'   => 'assignment',
            'lu'      => false,
            'lien'    => '/admin/affectations?tab=demandes',  // [OK] REDIRECTION VERS ONGLET
            'data'    => json_encode([
                'demande_id'   => $demande->id,
                'formateur_id' => $demande->formateur_id,
                'type'         => 'demande_affectation',
            ]),
        ]);
    }

    /**
     * Nouvelle demande de session créée
     * -> Lien : /admin/sessions (onglet Demandes)
     */
    public static function demandeSessionCreee(DemandeSessionModel $demande): void
    {
        Notification::create([
            'user_id' => null,
            'titre'   => '📅 Nouvelle demande de session',
            'message' => ($demande->formateur->prenom ?? '') . ' ' . ($demande->formateur->nom ?? '')
                . ' (' . ($demande->formateur->matricule ?? '') . ') a soumis une demande de session.'
                . ($demande->titre ? ' - ' . $demande->titre : ''),
            'type'    => 'info',
            'icone'   => 'event',
            'lu'      => false,
            'lien'    => '/admin/sessions?tab=demandes',  // [OK] REDIRECTION VERS ONGLET
            'data'    => json_encode([
                'demande_id'   => $demande->id,
                'formateur_id' => $demande->formateur_id,
                'type'         => 'demande_session',
            ]),
        ]);
    }

    // ============================================================
    // NOTIFICATIONS FORMATEUR (réponse admin)
    // ============================================================

    /**
     * Demande d'affectation traitée
     */
    public static function demandeAffectationTraitee(DemandeAffectationModel $demande): void
    {
        $approuvee = $demande->statut === DemandeAffectationModel::STATUT_APPROUVEE;

        Notification::create([
            'user_id' => $demande->formateur_id,
            'titre'   => $approuvee
                ? '[OK] Votre demande d\'affectation est approuvée'
                : '[X] Votre demande d\'affectation est refusée',
            'message' => ($approuvee
                    ? 'Votre demande a été approuvée par l\'administration.'
                    : 'Votre demande a été refusée par l\'administration.')
                . ($demande->reponse_admin ? "\n\nRéponse : " . $demande->reponse_admin : ''),
            'type'    => $approuvee ? 'success' : 'danger',
            'icone'   => $approuvee ? 'check_circle' : 'cancel',
            'lu'      => false,
            'lien'    => '/formateur/demandes',
            'data'    => json_encode([
                'demande_id' => $demande->id,
                'statut'     => $demande->statut,
            ]),
        ]);
    }

    /**
     * Demande de session traitée
     */
    public static function demandeSessionTraitee(DemandeSessionModel $demande): void
    {
        $approuvee = $demande->statut === DemandeSessionModel::STATUT_APPROUVEE;

        Notification::create([
            'user_id' => $demande->formateur_id,
            'titre'   => $approuvee
                ? '[OK] Votre demande de session est approuvée'
                : '[X] Votre demande de session est refusée',
            'message' => ($approuvee
                    ? 'Votre demande de session a été approuvée.'
                    : 'Votre demande de session a été refusée.')
                . ($demande->reponse_admin ? "\n\nRéponse : " . $demande->reponse_admin : ''),
            'type'    => $approuvee ? 'success' : 'danger',
            'icone'   => $approuvee ? 'event_available' : 'event_busy',
            'lu'      => false,
            'lien'    => '/formateur/sessions',
            'data'    => json_encode([
                'demande_id' => $demande->id,
                'statut'     => $demande->statut,
            ]),
        ]);
    }
}
PHP;
    }

    // ============================================================
    // CONTRÔLEUR NOTIFICATIONS
    // ============================================================
    protected function getNotificationController(): string
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

        if ($request->filled('statut')) {
            if ($request->statut === 'non_lues') $query->where('lu', false);
            elseif ($request->statut === 'lues') $query->where('lu', true);
        }

        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        if ($request->filled('search')) {
            $s = $request->search;
            $query->where(function ($q) use ($s) {
                $q->where('titre', 'like', "%{$s}%")
                  ->orWhere('message', 'like', "%{$s}%");
            });
        }

        $notifications = $query->paginate(20)->withQueryString();

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
     * Nombre de non lues (pour le badge)
     */
    public function count()
    {
        $nonLues = Notification::where(function ($q) {
                $q->whereNull('user_id')
                  ->orWhere('user_id', Auth::guard('admin')->id());
            })
            ->where('lu', false)
            ->count();

        return response()->json(['non_lues' => $nonLues]);
    }

    /**
     * 15 dernières notifications (pour la modal)
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
     * Affiche le détail d'une notification
     * [AJAX] REDIRECTION AUTOMATIQUE VERS L'ONGLET CONCERNÉ
     */
    public function show(int $id)
    {
        $notification = Notification::findOrFail($id);

        if (!$notification->lu) {
            $notification->update(['lu' => true]);
        }

        // Décoder les données pour savoir où rediriger
        $data = is_string($notification->data)
            ? json_decode($notification->data, true)
            : $notification->data;

        // [AJAX] Si c'est une demande, rediriger vers l'onglet approprié
        if (isset($data['type'])) {
            if ($data['type'] === 'demande_affectation') {
                return redirect()->to('/admin/affectations?tab=demandes');
            }
            if ($data['type'] === 'demande_session') {
                return redirect()->to('/admin/sessions?tab=demandes');
            }
        }

        // Sinon, utiliser le lien classique
        if ($notification->lien) {
            return redirect($notification->lien);
        }

        // Fallback
        return redirect()->route('admin.dashboard');
    }

    public function markAsRead(int $id)
    {
        Notification::findOrFail($id)->update(['lu' => true]);
        return response()->json(['success' => true]);
    }

    public function markAllAsRead()
    {
        Notification::where(function ($q) {
                $q->whereNull('user_id')
                  ->orWhere('user_id', Auth::guard('admin')->id());
            })
            ->where('lu', false)
            ->update(['lu' => true]);

        return response()->json(['success' => true]);
    }

    public function destroy(int $id)
    {
        Notification::findOrFail($id)->delete();
        return response()->json(['success' => true]);
    }

    public function destroyAll()
    {
        Notification::where(function ($q) {
                $q->whereNull('user_id')
                  ->orWhere('user_id', Auth::guard('admin')->id());
            })
            ->where('lu', true)
            ->delete();

        return response()->json(['success' => true]);
    }
}
PHP;
    }
}