<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class InstallApprovalWorkflow extends Command
{
    protected $signature = 'project:install-approval-workflow
                            {--backup : Sauvegarder les fichiers (.bak)}
                            {--force : Écraser sans confirmation}';

    protected $description = 'Installe le workflow complet de demandes (affectation + session) avec approbation admin';

    public function handle(): int
    {
        $this->info("[RELOAD] Installation du workflow d'approbation");
        $this->newLine();

        if (!$this->option('force') && !$this->confirm('Installer le workflow complet ?', true)) {
            $this->warn('Annulé.');
            return self::FAILURE;
        }

        // ============================================================
        // 1. Migration : table demande_sessions
        // ============================================================
        $migrationPath = base_path('database/migrations/' . date('Y_m_d_His') . '_create_demande_sessions_table.php');

        File::put($migrationPath, $this->getSessionMigration());
        $this->line("  [OK] Migration demande_sessions créée");

        // ============================================================
        // 2. Modèle DemandeSessionModel
        // ============================================================
        $sessionModelPath = base_path('app/Infrastructure/Persistence/Eloquent/Models/DemandeSessionModel.php');

        if (!File::exists(dirname($sessionModelPath))) {
            File::makeDirectory(dirname($sessionModelPath), 0755, true);
        }

        File::put($sessionModelPath, $this->getSessionModel());
        $this->line("  [OK] DemandeSessionModel créé");

        // ============================================================
        // 3. NotificationService centralisé
        // ============================================================
        $notifServicePath = base_path('app/Services/NotificationService.php');

        if (!File::exists(dirname($notifServicePath))) {
            File::makeDirectory(dirname($notifServicePath), 0755, true);
        }

        File::put($notifServicePath, $this->getNotificationService());
        $this->line("  [OK] NotificationService créé");

        // ============================================================
        // 4. Contrôleur Admin : DemandesAffectationsController
        // ============================================================
        $adminAffPath = base_path('app/Http/Controllers/Admin/DemandeAffectationAdminController.php');

        File::put($adminAffPath, $this->getAdminAffectationController());
        $this->line("  [OK] DemandeAffectationAdminController créé");

        // ============================================================
        // 5. Contrôleur Admin : DemandesSessionsController
        // ============================================================
        $adminSessPath = base_path('app/Http/Controllers/Admin/DemandeSessionAdminController.php');

        File::put($adminSessPath, $this->getAdminSessionController());
        $this->line("  [OK] DemandeSessionAdminController créé");

        // ============================================================
        // 6. Contrôleur Formateur : DemandeSessionController
        // ============================================================
        $formSessPath = base_path('app/Http/Controllers/Formateur/DemandeSessionController.php');

        File::put($formSessPath, $this->getFormateurSessionController());
        $this->line("  [OK] DemandeSessionController (formateur) créé");

        // ============================================================
        // 7. Mettre à jour DemandeAffectationController (formateur)
        // ============================================================
        $formAffPath = base_path('app/Http/Controllers/Formateur/DemandeAffectationController.php');

        if (File::exists($formAffPath)) {
            if ($this->option('backup')) {
                File::copy($formAffPath, $formAffPath . '.bak.' . date('Y-m-d_H-i-s'));
            }
            File::put($formAffPath, $this->getFormateurAffectationController());
            $this->line("  [OK] DemandeAffectationController mis à jour");
        }

        // ============================================================
        // 8. Vues Admin
        // ============================================================
        $this->createView('admin/demandes/affectations/index.blade.php', $this->getAdminAffectationView());
        $this->createView('admin/demandes/sessions/index.blade.php', $this->getAdminSessionView());
        $this->line("  [OK] Vues admin créées");

        // ============================================================
        // 9. Vues Formateur
        // ============================================================
        $this->createView('formateur/demandes/sessions.blade.php', $this->getFormateurSessionView());
        $this->line("  [OK] Vues formateur créées");

        // ============================================================
        // 10. Routes
        // ============================================================
        $this->updateRoutes();
        $this->line("  [OK] Routes mises à jour");

        // ============================================================
        // 11. Migrer la BDD
        // ============================================================
        $this->newLine();
        $this->info("[DB]️  Migration de la base de données...");
        $this->call('migrate', ['--force' => true]);

        // ============================================================
        // 12. Vider les caches
        // ============================================================
        $this->newLine();
        $this->info("[CLEAN] Nettoyage des caches...");
        $this->call('route:clear');
        $this->call('view:clear');
        $this->call('cache:clear');

        $this->newLine();
        $this->info("✨ SUCCÈS : workflow d'approbation installé");
        $this->line("  * Formateur -> Demande -> Admin");
        $this->line("  * Admin -> Approbation/Refus -> Notification Formateur");
        $this->line("  * Routes admin : /admin/demandes-affectations");
        $this->line("  * Routes admin : /admin/demandes-sessions");
        $this->line("  * Notifications automatiques dans les 2 sens");

        return self::SUCCESS;
    }

    protected function createView(string $relativePath, string $content): void
    {
        $fullPath = base_path('resources/views/' . $relativePath);
        if (!File::exists(dirname($fullPath))) {
            File::makeDirectory(dirname($fullPath), 0755, true);
        }
        File::put($fullPath, $content);
    }

    // ============================================================
    // MIGRATION SESSIONS
    // ============================================================
    protected function getSessionMigration(): string
    {
        return <<<'PHP'
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('demande_sessions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('formateur_id')->constrained('formateurs')->cascadeOnDelete();
            $table->foreignId('filiere_id')->nullable()->constrained('filieres')->nullOnDelete();
            $table->foreignId('etablissement_id')->nullable()->constrained('etablissements')->nullOnDelete();
            $table->string('titre')->nullable();
            $table->date('date_debut_souhaitee')->nullable();
            $table->date('date_fin_souhaitee')->nullable();
            $table->integer('nb_places_souhaitees')->default(0);
            $table->text('motif')->nullable();
            $table->enum('statut', ['en_attente', 'approuvee', 'refusee'])->default('en_attente');
            $table->text('reponse_admin')->nullable();
            $table->timestamp('traitee_le')->nullable();
            $table->timestamps();

            $table->index('statut');
            $table->index('formateur_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('demande_sessions');
    }
};
PHP;
    }

    // ============================================================
    // MODÈLE SESSION
    // ============================================================
    protected function getSessionModel(): string
    {
        return <<<'PHP'
<?php

namespace Infrastructure\Persistence\Eloquent\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DemandeSessionModel extends Model
{
    protected $table = 'demande_sessions';

    public const STATUT_EN_ATTENTE = 'en_attente';
    public const STATUT_APPROUVEE  = 'approuvee';
    public const STATUT_REFUSEE    = 'refusee';

    protected $fillable = [
        'formateur_id',
        'filiere_id',
        'etablissement_id',
        'titre',
        'date_debut_souhaitee',
        'date_fin_souhaitee',
        'nb_places_souhaitees',
        'motif',
        'statut',
        'reponse_admin',
        'traitee_le',
    ];

    protected $casts = [
        'date_debut_souhaitee' => 'date',
        'date_fin_souhaitee'   => 'date',
        'traitee_le'           => 'datetime',
        'created_at'           => 'datetime',
        'updated_at'           => 'datetime',
    ];

    public function formateur(): BelongsTo
    {
        return $this->belongsTo(FormateurModel::class, 'formateur_id');
    }

    public function filiere(): BelongsTo
    {
        return $this->belongsTo(FiliereModel::class, 'filiere_id');
    }

    public function etablissement(): BelongsTo
    {
        return $this->belongsTo(EtablissementModel::class, 'etablissement_id');
    }

    public function estEnAttente(): bool
    {
        return $this->statut === self::STATUT_EN_ATTENTE;
    }

    public function estApprouvee(): bool
    {
        return $this->statut === self::STATUT_APPROUVEE;
    }

    public function estRefusee(): bool
    {
        return $this->statut === self::STATUT_REFUSEE;
    }
}
PHP;
    }

    // ============================================================
    // SERVICE DE NOTIFICATIONS
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
            'lien'    => '/admin/demandes-affectations',
            'data'    => json_encode([
                'demande_id'   => $demande->id,
                'formateur_id' => $demande->formateur_id,
            ]),
        ]);
    }

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
            'lien'    => '/admin/demandes-sessions',
            'data'    => json_encode([
                'demande_id'   => $demande->id,
                'formateur_id' => $demande->formateur_id,
            ]),
        ]);
    }

    // ============================================================
    // NOTIFICATIONS FORMATEUR (réponse admin)
    // ============================================================

    public static function demandeAffectationTraitee(DemandeAffectationModel $demande): void
    {
        $approuvee = $demande->statut === DemandeAffectationModel::STATUT_APPROUVEE;

        Notification::create([
            'user_id' => $demande->formateur_id,  // [AJAX] lié au formateur
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
            'lien'    => '/formateur/demandes-sessions',
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
    // CONTRÔLEUR ADMIN : DEMANDES AFFECTATIONS
    // ============================================================
    protected function getAdminAffectationController(): string
    {
        return <<<'PHP'
<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\NotificationService;
use Illuminate\Http\Request;
use Infrastructure\Persistence\Eloquent\Models\DemandeAffectationModel;

class DemandeAffectationAdminController extends Controller
{
    public function index(Request $request)
    {
        $query = DemandeAffectationModel::with(['formateur', 'filiere', 'etablissement'])
            ->latest();

        if ($request->filled('statut')) {
            $query->where('statut', $request->statut);
        }

        $demandes = $query->paginate(20)->withQueryString();

        $stats = [
            'total'      => DemandeAffectationModel::count(),
            'en_attente' => DemandeAffectationModel::where('statut', 'en_attente')->count(),
            'approuvees' => DemandeAffectationModel::where('statut', 'approuvee')->count(),
            'refusees'   => DemandeAffectationModel::where('statut', 'refusee')->count(),
        ];

        return view('admin.demandes.affectations.index', compact('demandes', 'stats'));
    }

    public function approuver(Request $request, int $id)
    {
        $demande = DemandeAffectationModel::findOrFail($id);

        $demande->update([
            'statut'        => DemandeAffectationModel::STATUT_APPROUVEE,
            'reponse_admin' => $request->input('reponse_admin', 'Approuvée.'),
            'traitee_le'    => now(),
        ]);

        // [AJAX] NOTIFICATION AUTOMATIQUE AU FORMATEUR
        NotificationService::demandeAffectationTraitee($demande);

        return back()->with('success', 'Demande approuvée et formateur notifié.');
    }

    public function refuser(Request $request, int $id)
    {
        $demande = DemandeAffectationModel::findOrFail($id);

        $demande->update([
            'statut'        => DemandeAffectationModel::STATUT_REFUSEE,
            'reponse_admin' => $request->input('reponse_admin', 'Refusée.'),
            'traitee_le'    => now(),
        ]);

        // [AJAX] NOTIFICATION AUTOMATIQUE AU FORMATEUR
        NotificationService::demandeAffectationTraitee($demande);

        return back()->with('success', 'Demande refusée et formateur notifié.');
    }
}
PHP;
    }

    // ============================================================
    // CONTRÔLEUR ADMIN : DEMANDES SESSIONS
    // ============================================================
    protected function getAdminSessionController(): string
    {
        return <<<'PHP'
<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\NotificationService;
use Illuminate\Http\Request;
use Infrastructure\Persistence\Eloquent\Models\DemandeSessionModel;

class DemandeSessionAdminController extends Controller
{
    public function index(Request $request)
    {
        $query = DemandeSessionModel::with(['formateur', 'filiere', 'etablissement'])
            ->latest();

        if ($request->filled('statut')) {
            $query->where('statut', $request->statut);
        }

        $demandes = $query->paginate(20)->withQueryString();

        $stats = [
            'total'      => DemandeSessionModel::count(),
            'en_attente' => DemandeSessionModel::where('statut', 'en_attente')->count(),
            'approuvees' => DemandeSessionModel::where('statut', 'approuvee')->count(),
            'refusees'   => DemandeSessionModel::where('statut', 'refusee')->count(),
        ];

        return view('admin.demandes.sessions.index', compact('demandes', 'stats'));
    }

    public function approuver(Request $request, int $id)
    {
        $demande = DemandeSessionModel::findOrFail($id);

        $demande->update([
            'statut'        => DemandeSessionModel::STATUT_APPROUVEE,
            'reponse_admin' => $request->input('reponse_admin', 'Approuvée.'),
            'traitee_le'    => now(),
        ]);

        // [AJAX] NOTIFICATION AUTOMATIQUE AU FORMATEUR
        NotificationService::demandeSessionTraitee($demande);

        return back()->with('success', 'Demande approuvée et formateur notifié.');
    }

    public function refuser(Request $request, int $id)
    {
        $demande = DemandeSessionModel::findOrFail($id);

        $demande->update([
            'statut'        => DemandeSessionModel::STATUT_REFUSEE,
            'reponse_admin' => $request->input('reponse_admin', 'Refusée.'),
            'traitee_le'    => now(),
        ]);

        // [AJAX] NOTIFICATION AUTOMATIQUE AU FORMATEUR
        NotificationService::demandeSessionTraitee($demande);

        return back()->with('success', 'Demande refusée et formateur notifié.');
    }
}
PHP;
    }

    // ============================================================
    // CONTRÔLEUR FORMATEUR : DEMANDES SESSIONS
    // ============================================================
    protected function getFormateurSessionController(): string
    {
        return <<<'PHP'
<?php

namespace App\Http\Controllers\Formateur;

use App\Http\Controllers\Controller;
use App\Services\NotificationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Infrastructure\Persistence\Eloquent\Models\DemandeSessionModel;
use Infrastructure\Persistence\Eloquent\Models\EtablissementModel;
use Infrastructure\Persistence\Eloquent\Models\FiliereModel;
use Infrastructure\Persistence\Eloquent\Models\FormateurModel;

class DemandeSessionController extends Controller
{
    private function getFormateurMetier()
    {
        $user = Auth::guard('formateur')->user();
        if (!$user) return null;

        return FormateurModel::where('matricule', $user->matricule)
            ->orWhere('email', $user->email)
            ->first();
    }

    public function index()
    {
        $formateurMetier = $this->getFormateurMetier();

        if (!$formateurMetier) {
            return view('formateur.demandes.sessions', [
                'demandes' => collect(),
                'formateurMetier' => null,
                'filieres' => collect(),
                'etablissements' => collect(),
            ]);
        }

        $demandes = DemandeSessionModel::with(['filiere', 'etablissement'])
            ->where('formateur_id', $formateurMetier->id)
            ->latest()
            ->get();

        $filieres = FiliereModel::orderBy('libelle')->get();
        $etablissements = EtablissementModel::orderBy('nom')->get();

        return view('formateur.demandes.sessions', compact(
            'demandes',
            'formateurMetier',
            'filieres',
            'etablissements'
        ));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'filiere_id'            => 'nullable|exists:filieres,id',
            'etablissement_id'      => 'nullable|exists:etablissements,id',
            'titre'                 => 'required|string|max:255',
            'date_debut_souhaitee'  => 'nullable|date|after_or_equal:today',
            'date_fin_souhaitee'    => 'nullable|date|after_or_equal:date_debut_souhaitee',
            'nb_places_souhaitees'  => 'nullable|integer|min:1|max:200',
            'motif'                 => 'required|string|min:10|max:1000',
        ], [
            'titre.required' => 'Le titre est obligatoire.',
            'motif.required' => 'Le motif est obligatoire.',
            'motif.min'      => 'Le motif doit contenir au moins 10 caractères.',
        ]);

        $formateurMetier = $this->getFormateurMetier();

        if (!$formateurMetier) {
            return back()->withErrors(['error' => 'Profil formateur introuvable.']);
        }

        $demande = DemandeSessionModel::create([
            'formateur_id'         => $formateurMetier->id,
            'filiere_id'           => $validated['filiere_id'] ?? null,
            'etablissement_id'     => $validated['etablissement_id'] ?? null,
            'titre'                => $validated['titre'],
            'date_debut_souhaitee' => $validated['date_debut_souhaitee'] ?? null,
            'date_fin_souhaitee'   => $validated['date_fin_souhaitee'] ?? null,
            'nb_places_souhaitees' => $validated['nb_places_souhaitees'] ?? 0,
            'motif'                => $validated['motif'],
            'statut'               => DemandeSessionModel::STATUT_EN_ATTENTE,
        ]);

        // [AJAX] NOTIFICATION AUTOMATIQUE AUX ADMINS
        NotificationService::demandeSessionCreee($demande);

        return back()->with('success', 'Votre demande a été envoyée avec succès !');
    }
}
PHP;
    }

    // ============================================================
    // CONTRÔLEUR FORMATEUR : DEMANDES AFFECTATIONS (mis à jour)
    // ============================================================
    protected function getFormateurAffectationController(): string
    {
        return <<<'PHP'
<?php

namespace App\Http\Controllers\Formateur;

use App\Http\Controllers\Controller;
use App\Services\NotificationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Infrastructure\Persistence\Eloquent\Models\DemandeAffectationModel;
use Infrastructure\Persistence\Eloquent\Models\EtablissementModel;
use Infrastructure\Persistence\Eloquent\Models\FiliereModel;
use Infrastructure\Persistence\Eloquent\Models\FormateurModel;

class DemandeAffectationController extends Controller
{
    private function getFormateurMetier()
    {
        $user = Auth::guard('formateur')->user();
        if (!$user) return null;

        return FormateurModel::where('matricule', $user->matricule)
            ->orWhere('email', $user->email)
            ->first();
    }

    public function index()
    {
        $formateurMetier = $this->getFormateurMetier();

        if (!$formateurMetier) {
            return view('formateur.demandes.index', [
                'demandes' => collect(),
                'formateurMetier' => null,
                'filieres' => collect(),
                'etablissements' => collect(),
            ]);
        }

        $demandes = DemandeAffectationModel::with(['filiere', 'etablissement'])
            ->where('formateur_id', $formateurMetier->id)
            ->latest()
            ->get();

        $filieres = FiliereModel::orderBy('libelle')->get();
        $etablissements = EtablissementModel::orderBy('nom')->get();

        return view('formateur.demandes.index', compact(
            'demandes',
            'formateurMetier',
            'filieres',
            'etablissements'
        ));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'filiere_id'       => 'nullable|exists:filieres,id',
            'etablissement_id' => 'nullable|exists:etablissements,id',
            'date_souhaitee'   => 'nullable|date|after_or_equal:today',
            'motif'            => 'required|string|min:10|max:1000',
        ]);

        $formateurMetier = $this->getFormateurMetier();

        if (!$formateurMetier) {
            return back()->withErrors(['error' => 'Profil formateur introuvable.']);
        }

        $demande = DemandeAffectationModel::create([
            'formateur_id'     => $formateurMetier->id,
            'filiere_id'       => $validated['filiere_id'] ?? null,
            'etablissement_id' => $validated['etablissement_id'] ?? null,
            'date_souhaitee'   => $validated['date_souhaitee'] ?? null,
            'motif'            => $validated['motif'],
            'statut'           => DemandeAffectationModel::STATUT_EN_ATTENTE,
        ]);

        // [AJAX] NOTIFICATION AUTOMATIQUE AUX ADMINS
        NotificationService::demandeAffectationCreee($demande);

        return back()->with('success', 'Votre demande a été envoyée avec succès !');
    }
}
PHP;
    }

    // ============================================================
    // VUES ADMIN
    // ============================================================
    protected function getAdminAffectationView(): string
    {
        return <<<'BLADE'
@extends('layouts.admin')
@section('title', 'Demandes d\'affectations')

@section('content')

<div class="mb-6">
    <h1 class="font-display text-2xl font-bold text-slate-900">Demandes d'affectations</h1>
    <p class="text-sm text-slate-500 mt-1">Traiter les demandes des formateurs</p>
</div>

<div class="grid grid-cols-4 gap-4 mb-6">
    <div class="bg-white rounded-xl border border-slate-200 p-4">
        <div class="text-xs font-bold text-slate-500 uppercase">Total</div>
        <div class="text-2xl font-bold text-slate-900 mt-1">{{ $stats['total'] }}</div>
    </div>
    <div class="bg-white rounded-xl border border-slate-200 p-4">
        <div class="text-xs font-bold text-slate-500 uppercase">En attente</div>
        <div class="text-2xl font-bold text-amber-600 mt-1">{{ $stats['en_attente'] }}</div>
    </div>
    <div class="bg-white rounded-xl border border-slate-200 p-4">
        <div class="text-xs font-bold text-slate-500 uppercase">Approuvées</div>
        <div class="text-2xl font-bold text-emerald-600 mt-1">{{ $stats['approuvees'] }}</div>
    </div>
    <div class="bg-white rounded-xl border border-slate-200 p-4">
        <div class="text-xs font-bold text-slate-500 uppercase">Refusées</div>
        <div class="text-2xl font-bold text-red-600 mt-1">{{ $stats['refusees'] }}</div>
    </div>
</div>

<div class="bg-white rounded-xl border border-slate-200 overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-slate-50 border-b border-slate-200">
            <tr>
                <th class="text-left px-5 py-3 text-[11px] font-bold text-slate-500 uppercase">Formateur</th>
                <th class="text-left px-5 py-3 text-[11px] font-bold text-slate-500 uppercase">Filière</th>
                <th class="text-left px-5 py-3 text-[11px] font-bold text-slate-500 uppercase">Motif</th>
                <th class="text-left px-5 py-3 text-[11px] font-bold text-slate-500 uppercase">Date</th>
                <th class="text-left px-5 py-3 text-[11px] font-bold text-slate-500 uppercase">Statut</th>
                <th class="text-right px-5 py-3 text-[11px] font-bold text-slate-500 uppercase">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($demandes as $demande)
                <tr class="border-b border-slate-100 hover:bg-slate-50">
                    <td class="px-5 py-4">
                        <div class="font-semibold text-slate-900">
                            {{ $demande->formateur->prenom ?? '' }} {{ $demande->formateur->nom ?? '' }}
                        </div>
                        <div class="text-xs text-slate-500 font-mono">{{ $demande->formateur->matricule ?? '' }}</div>
                    </td>
                    <td class="px-5 py-4 text-slate-700">
                        {{ $demande->filiere->libelle ?? '-' }}
                    </td>
                    <td class="px-5 py-4 text-slate-600 max-w-xs truncate" title="{{ $demande->motif }}">
                        {{ Str::limit($demande->motif, 50) }}
                    </td>
                    <td class="px-5 py-4 text-xs text-slate-500">
                        {{ $demande->created_at?->format('d/m/Y H:i') }}
                    </td>
                    <td class="px-5 py-4">
                        @if($demande->statut === 'en_attente')
                            <span class="px-2.5 py-1 rounded-full text-[10px] font-bold bg-amber-50 text-amber-700">En attente</span>
                        @elseif($demande->statut === 'approuvee')
                            <span class="px-2.5 py-1 rounded-full text-[10px] font-bold bg-emerald-50 text-emerald-700">Approuvée</span>
                        @else
                            <span class="px-2.5 py-1 rounded-full text-[10px] font-bold bg-red-50 text-red-700">Refusée</span>
                        @endif
                    </td>
                    <td class="px-5 py-4 text-right">
                        @if($demande->statut === 'en_attente')
                            <form action="{{ route('admin.demandes-affectations.approuver', $demande->id) }}" method="POST" class="inline" onsubmit="return confirm('Approuver ?')">
                                @csrf
                                <input type="hidden" name="reponse_admin" value="Demande approuvée.">
                                <button type="submit" class="px-3 py-1.5 rounded-lg text-[11px] font-bold bg-emerald-600 text-white hover:bg-emerald-700">
                                    v Approuver
                                </button>
                            </form>
                            <form action="{{ route('admin.demandes-affectations.refuser', $demande->id) }}" method="POST" class="inline" onsubmit="return confirm('Refuser ?')">
                                @csrf
                                <input type="hidden" name="reponse_admin" value="Demande refusée.">
                                <button type="submit" class="px-3 py-1.5 rounded-lg text-[11px] font-bold bg-red-600 text-white hover:bg-red-700">
                                    ✕ Refuser
                                </button>
                            </form>
                        @else
                            <span class="text-xs text-slate-400">
                                Traitée le {{ $demande->traitee_le?->format('d/m/Y') }}
                            </span>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center py-16 text-slate-400">
                        Aucune demande
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
    @if($demandes->hasPages())
        <div class="px-5 py-3 border-t">{{ $demandes->links() }}</div>
    @endif
</div>

@endsection
BLADE;
    }

    protected function getAdminSessionView(): string
    {
        return <<<'BLADE'
@extends('layouts.admin')
@section('title', 'Demandes de sessions')

@section('content')

<div class="mb-6">
    <h1 class="font-display text-2xl font-bold text-slate-900">Demandes de sessions</h1>
    <p class="text-sm text-slate-500 mt-1">Traiter les demandes des formateurs</p>
</div>

<div class="grid grid-cols-4 gap-4 mb-6">
    <div class="bg-white rounded-xl border border-slate-200 p-4">
        <div class="text-xs font-bold text-slate-500 uppercase">Total</div>
        <div class="text-2xl font-bold text-slate-900 mt-1">{{ $stats['total'] }}</div>
    </div>
    <div class="bg-white rounded-xl border border-slate-200 p-4">
        <div class="text-xs font-bold text-slate-500 uppercase">En attente</div>
        <div class="text-2xl font-bold text-amber-600 mt-1">{{ $stats['en_attente'] }}</div>
    </div>
    <div class="bg-white rounded-xl border border-slate-200 p-4">
        <div class="text-xs font-bold text-slate-500 uppercase">Approuvées</div>
        <div class="text-2xl font-bold text-emerald-600 mt-1">{{ $stats['approuvees'] }}</div>
    </div>
    <div class="bg-white rounded-xl border border-slate-200 p-4">
        <div class="text-xs font-bold text-slate-500 uppercase">Refusées</div>
        <div class="text-2xl font-bold text-red-600 mt-1">{{ $stats['refusees'] }}</div>
    </div>
</div>

<div class="bg-white rounded-xl border border-slate-200 overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-slate-50 border-b border-slate-200">
            <tr>
                <th class="text-left px-5 py-3 text-[11px] font-bold text-slate-500 uppercase">Formateur</th>
                <th class="text-left px-5 py-3 text-[11px] font-bold text-slate-500 uppercase">Titre</th>
                <th class="text-left px-5 py-3 text-[11px] font-bold text-slate-500 uppercase">Période</th>
                <th class="text-left px-5 py-3 text-[11px] font-bold text-slate-500 uppercase">Statut</th>
                <th class="text-right px-5 py-3 text-[11px] font-bold text-slate-500 uppercase">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($demandes as $demande)
                <tr class="border-b border-slate-100 hover:bg-slate-50">
                    <td class="px-5 py-4">
                        <div class="font-semibold text-slate-900">
                            {{ $demande->formateur->prenom ?? '' }} {{ $demande->formateur->nom ?? '' }}
                        </div>
                        <div class="text-xs text-slate-500 font-mono">{{ $demande->formateur->matricule ?? '' }}</div>
                    </td>
                    <td class="px-5 py-4 text-slate-700">{{ $demande->titre }}</td>
                    <td class="px-5 py-4 text-xs text-slate-600">
                        {{ $demande->date_debut_souhaitee?->format('d/m/Y') ?? '-' }}
                        -> {{ $demande->date_fin_souhaitee?->format('d/m/Y') ?? '-' }}
                    </td>
                    <td class="px-5 py-4">
                        @if($demande->statut === 'en_attente')
                            <span class="px-2.5 py-1 rounded-full text-[10px] font-bold bg-amber-50 text-amber-700">En attente</span>
                        @elseif($demande->statut === 'approuvee')
                            <span class="px-2.5 py-1 rounded-full text-[10px] font-bold bg-emerald-50 text-emerald-700">Approuvée</span>
                        @else
                            <span class="px-2.5 py-1 rounded-full text-[10px] font-bold bg-red-50 text-red-700">Refusée</span>
                        @endif
                    </td>
                    <td class="px-5 py-4 text-right">
                        @if($demande->statut === 'en_attente')
                            <form action="{{ route('admin.demandes-sessions.approuver', $demande->id) }}" method="POST" class="inline" onsubmit="return confirm('Approuver ?')">
                                @csrf
                                <input type="hidden" name="reponse_admin" value="Demande approuvée.">
                                <button type="submit" class="px-3 py-1.5 rounded-lg text-[11px] font-bold bg-emerald-600 text-white hover:bg-emerald-700">
                                    v Approuver
                                </button>
                            </form>
                            <form action="{{ route('admin.demandes-sessions.refuser', $demande->id) }}" method="POST" class="inline" onsubmit="return confirm('Refuser ?')">
                                @csrf
                                <input type="hidden" name="reponse_admin" value="Demande refusée.">
                                <button type="submit" class="px-3 py-1.5 rounded-lg text-[11px] font-bold bg-red-600 text-white hover:bg-red-700">
                                    ✕ Refuser
                                </button>
                            </form>
                        @else
                            <span class="text-xs text-slate-400">
                                Traitée le {{ $demande->traitee_le?->format('d/m/Y') }}
                            </span>
                        @endif
                    </td>
                </tr>
            @empty
                <tr><td colspan="5" class="text-center py-16 text-slate-400">Aucune demande</td></tr>
            @endforelse
        </tbody>
    </table>
    @if($demandes->hasPages())
        <div class="px-5 py-3 border-t">{{ $demandes->links() }}</div>
    @endif
</div>

@endsection
BLADE;
    }

    // ============================================================
    // VUE FORMATEUR SESSIONS
    // ============================================================
    protected function getFormateurSessionView(): string
    {
        return <<<'BLADE'
@extends('layouts.formateur')
@section('title', 'Demandes de sessions')

@section('content')

<div class="mb-6 flex justify-between items-center">
    <div>
        <h1 class="font-display text-2xl font-bold text-slate-900">Demandes de sessions</h1>
        <p class="text-sm text-slate-500 mt-1">Soumettez vos demandes de sessions</p>
    </div>
    <button onclick="openDemandeSessionModal()" class="btn-primary">
        <span class="material-symbols-rounded text-lg">add</span>
        Nouvelle demande
    </button>
</div>

@if(session('success'))
    <div class="mb-4 px-4 py-3 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-sm">
        {{ session('success') }}
    </div>
@endif

<div class="bg-white rounded-xl border border-slate-200 overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-slate-50 border-b">
            <tr>
                <th class="text-left px-5 py-3 text-[11px] font-bold text-slate-500 uppercase">Titre</th>
                <th class="text-left px-5 py-3 text-[11px] font-bold text-slate-500 uppercase">Période</th>
                <th class="text-left px-5 py-3 text-[11px] font-bold text-slate-500 uppercase">Statut</th>
                <th class="text-left px-5 py-3 text-[11px] font-bold text-slate-500 uppercase">Réponse admin</th>
            </tr>
        </thead>
        <tbody>
            @forelse($demandes as $demande)
                <tr class="border-b border-slate-100">
                    <td class="px-5 py-4 font-semibold">{{ $demande->titre }}</td>
                    <td class="px-5 py-4 text-xs">
                        {{ $demande->date_debut_souhaitee?->format('d/m/Y') ?? '-' }} -> {{ $demande->date_fin_souhaitee?->format('d/m/Y') ?? '-' }}
                    </td>
                    <td class="px-5 py-4">
                        @if($demande->statut === 'en_attente')
                            <span class="px-2.5 py-1 rounded-full text-[10px] font-bold bg-amber-50 text-amber-700">En attente</span>
                        @elseif($demande->statut === 'approuvee')
                            <span class="px-2.5 py-1 rounded-full text-[10px] font-bold bg-emerald-50 text-emerald-700">Approuvée</span>
                        @else
                            <span class="px-2.5 py-1 rounded-full text-[10px] font-bold bg-red-50 text-red-700">Refusée</span>
                        @endif
                    </td>
                    <td class="px-5 py-4 text-xs text-slate-600">
                        {{ $demande->reponse_admin ?? '-' }}
                    </td>
                </tr>
            @empty
                <tr><td colspan="4" class="text-center py-16 text-slate-400">Aucune demande</td></tr>
            @endforelse
        </tbody>
    </table>
</div>

{{-- MODAL --}}
<div id="demandeSessionModal" class="fixed inset-0 z-[9999] items-center justify-center p-4" style="display:none;">
    <div class="absolute inset-0 bg-black/50" onclick="closeDemandeSessionModal()"></div>
    <div class="relative bg-white rounded-2xl shadow-2xl w-full max-w-2xl max-h-[90vh] flex flex-col">
        <div class="px-6 py-4 border-b flex justify-between items-center">
            <h2 class="font-display text-lg font-bold">Nouvelle demande de session</h2>
            <button onclick="closeDemandeSessionModal()" class="w-9 h-9 rounded-md flex items-center justify-center hover:bg-slate-100">
                <span class="material-symbols-rounded">close</span>
            </button>
        </div>
        <form action="{{ route('formateur.demandes-sessions.store') }}" method="POST" class="flex flex-col flex-1 min-h-0">
            @csrf
            <div class="flex-1 overflow-y-auto px-6 py-5 space-y-4">
                <div>
                    <label class="block text-sm font-semibold mb-2">Titre <span class="text-red-500">*</span></label>
                    <input type="text" name="titre" required class="w-full px-4 py-3 border-2 border-slate-200 rounded-lg focus:border-emerald-500">
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-semibold mb-2">Filière</label>
                        <select name="filiere_id" class="w-full px-4 py-3 border-2 border-slate-200 rounded-lg">
                            <option value="">- Aucune -</option>
                            @foreach($filieres as $f)
                                <option value="{{ $f->id }}">{{ $f->libelle }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold mb-2">Établissement</label>
                        <select name="etablissement_id" class="w-full px-4 py-3 border-2 border-slate-200 rounded-lg">
                            <option value="">- Aucun -</option>
                            @foreach($etablissements as $e)
                                <option value="{{ $e->id }}">{{ $e->nom }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-semibold mb-2">Date début souhaitée</label>
                        <input type="date" name="date_debut_souhaitee" min="{{ date('Y-m-d') }}" class="w-full px-4 py-3 border-2 border-slate-200 rounded-lg">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold mb-2">Date fin souhaitée</label>
                        <input type="date" name="date_fin_souhaitee" class="w-full px-4 py-3 border-2 border-slate-200 rounded-lg">
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-semibold mb-2">Nombre de places souhaitées</label>
                    <input type="number" name="nb_places_souhaitees" min="1" max="200" value="20" class="w-full px-4 py-3 border-2 border-slate-200 rounded-lg">
                </div>
                <div>
                    <label class="block text-sm font-semibold mb-2">Motif <span class="text-red-500">*</span></label>
                    <textarea name="motif" rows="4" required minlength="10" class="w-full px-4 py-3 border-2 border-slate-200 rounded-lg resize-none" placeholder="Expliquez la raison (min 10 caractères)..."></textarea>
                </div>
            </div>
            <div class="px-6 py-4 border-t flex justify-end gap-2 bg-slate-50">
                <button type="button" onclick="closeDemandeSessionModal()" class="btn-secondary">Annuler</button>
                <button type="submit" class="btn-primary">Envoyer la demande</button>
            </div>
        </form>
    </div>
</div>

<script>
    function openDemandeSessionModal() {
        document.getElementById('demandeSessionModal').style.display = 'flex';
        document.body.style.overflow = 'hidden';
    }
    function closeDemandeSessionModal() {
        document.getElementById('demandeSessionModal').style.display = 'none';
        document.body.style.overflow = '';
    }
</script>

@endsection
BLADE;
    }

    // ============================================================
    // ROUTES
    // ============================================================
    protected function updateRoutes(): void
    {
        // -------- ADMIN --------
        $adminRoutesPath = base_path('routes/admin.php');

        if (File::exists($adminRoutesPath)) {
            if ($this->option('backup')) {
                File::copy($adminRoutesPath, $adminRoutesPath . '.bak.' . date('Y-m-d_H-i-s'));
            }

            $content = File::get($adminRoutesPath);

            // Ajouter le use
            if (!str_contains($content, 'DemandeAffectationAdminController')) {
                $content = str_replace(
                    "use App\\Http\\Controllers\\Admin\\NotificationController;",
                    "use App\\Http\\Controllers\\Admin\\NotificationController;\nuse App\\Http\\Controllers\\Admin\\DemandeAffectationAdminController;\nuse App\\Http\\Controllers\\Admin\\DemandeSessionAdminController;",
                    $content
                );
            }

            // Ajouter les routes
            if (!str_contains($content, 'demandes-affectations')) {
                $routesBlock = <<<'PHP'

        // ============================================================
        // DEMANDES D'AFFECTATIONS
        // ============================================================
        Route::prefix('demandes-affectations')->name('demandes-affectations.')->group(function () {
            Route::get('/', [DemandeAffectationAdminController::class, 'index'])->name('index');
            Route::post('/{id}/approuver', [DemandeAffectationAdminController::class, 'approuver'])->name('approuver');
            Route::post('/{id}/refuser', [DemandeAffectationAdminController::class, 'refuser'])->name('refuser');
        });

        // ============================================================
        // DEMANDES DE SESSIONS
        // ============================================================
        Route::prefix('demandes-sessions')->name('demandes-sessions.')->group(function () {
            Route::get('/', [DemandeSessionAdminController::class, 'index'])->name('index');
            Route::post('/{id}/approuver', [DemandeSessionAdminController::class, 'approuver'])->name('approuver');
            Route::post('/{id}/refuser', [DemandeSessionAdminController::class, 'refuser'])->name('refuser');
        });

PHP;

                $content = str_replace(
                    "        Route::resource('users', UserController::class);",
                    $routesBlock . "        Route::resource('users', UserController::class);",
                    $content
                );
            }

            File::put($adminRoutesPath, $content);
        }

        // -------- FORMATEUR --------
        $formRoutesPath = base_path('routes/formateur.php');

        if (File::exists($formRoutesPath)) {
            if ($this->option('backup')) {
                File::copy($formRoutesPath, $formRoutesPath . '.bak.' . date('Y-m-d_H-i-s'));
            }

            $content = File::get($formRoutesPath);

            if (!str_contains($content, 'DemandeSessionController')) {
                $content = str_replace(
                    "use App\\Http\\Controllers\\Formateur\\ProfileController;",
                    "use App\\Http\\Controllers\\Formateur\\ProfileController;\nuse App\\Http\\Controllers\\Formateur\\DemandeSessionController;",
                    $content
                );
            }

            if (!str_contains($content, 'demandes-sessions')) {
                $routesBlock = <<<'PHP'

        // ============================================================
        // DEMANDES DE SESSIONS (formateur)
        // ============================================================
        Route::prefix('demandes-sessions')->name('demandes-sessions.')->group(function () {
            Route::get('/', [DemandeSessionController::class, 'index'])->name('index');
            Route::post('/', [DemandeSessionController::class, 'store'])->name('store');
        });

PHP;

                $content = str_replace(
                    "        // NOTIFICATIONS",
                    $routesBlock . "        // NOTIFICATIONS",
                    $content
                );
            }

            File::put($formRoutesPath, $content);
        }
    }
}