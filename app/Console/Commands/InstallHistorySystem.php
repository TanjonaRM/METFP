<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class InstallHistorySystem extends Command
{
    protected $signature = 'project:install-history-system
                            {--backup : Sauvegarder les fichiers (.bak)}
                            {--force : Écraser sans confirmation}';

    protected $description = 'Installe le système d\'historique (affectations, sessions, établissements, filières)';

    public function handle(): int
    {
        $this->info("📚 Installation du système d'historique");
        $this->newLine();

        if (!$this->option('force') && !$this->confirm('Continuer ?', true)) {
            $this->warn('Annulé.');
            return self::FAILURE;
        }

        // ============================================================
        // 1. Migration : table historique_formateurs
        // ============================================================
        $migrationPath = base_path('database/migrations/' . date('Y_m_d_His') . '_create_historique_formateurs_table.php');

        File::put($migrationPath, $this->getMigration());
        $this->line("  [OK] Migration historique_formateurs créée");

        // ============================================================
        // 2. Modèle HistoriqueFormateurModel
        // ============================================================
        $modelPath = base_path('app/Infrastructure/Persistence/Eloquent/Models/HistoriqueFormateurModel.php');

        File::put($modelPath, $this->getModel());
        $this->line("  [OK] HistoriqueFormateurModel créé");

        // ============================================================
        // 3. Service HistoriqueService
        // ============================================================
        $servicePath = base_path('app/Services/HistoriqueService.php');

        if (!File::exists(dirname($servicePath))) {
            File::makeDirectory(dirname($servicePath), 0755, true);
        }

        File::put($servicePath, $this->getService());
        $this->line("  [OK] HistoriqueService créé");

        // ============================================================
        // 4. Mettre à jour le contrôleur Admin DemandesAffectations
        // ============================================================
        $affControllerPath = base_path('app/Http/Controllers/Admin/DemandeAffectationAdminController.php');

        if (File::exists($affControllerPath)) {
            if ($this->option('backup')) {
                File::copy($affControllerPath, $affControllerPath . '.bak.' . date('Y-m-d_H-i-s'));
            }
            File::put($affControllerPath, $this->getAffectationAdminController());
            $this->line("  [OK] DemandeAffectationAdminController mis à jour");
        }

        // ============================================================
        // 5. Mettre à jour le contrôleur Admin DemandesSessions
        // ============================================================
        $sessControllerPath = base_path('app/Http/Controllers/Admin/DemandeSessionAdminController.php');

        if (File::exists($sessControllerPath)) {
            if ($this->option('backup')) {
                File::copy($sessControllerPath, $sessControllerPath . '.bak.' . date('Y-m-d_H-i-s'));
            }
            File::put($sessControllerPath, $this->getSessionAdminController());
            $this->line("  [OK] DemandeSessionAdminController mis à jour");
        }

        // ============================================================
        // 6. Mettre à jour FormateurController (admin) pour afficher historique
        // ============================================================
        $formateurControllerPath = base_path('app/Http/Controllers/Admin/FormateurController.php');

        if (File::exists($formateurControllerPath)) {
            if ($this->option('backup')) {
                File::copy($formateurControllerPath, $formateurControllerPath . '.bak.' . date('Y-m-d_H-i-s'));
            }
            File::put($formateurControllerPath, $this->getFormateurAdminController());
            $this->line("  [OK] FormateurController mis à jour (historique intégré)");
        }

        // ============================================================
        // 7. Vue formateur show avec historique
        // ============================================================
        $showViewPath = base_path('resources/views/admin/formateurs/show.blade.php');

        if (File::exists($showViewPath)) {
            if ($this->option('backup')) {
                File::copy($showViewPath, $showViewPath . '.bak.' . date('Y-m-d_H-i-s'));
            }
            File::put($showViewPath, $this->getFormateurShowView());
            $this->line("  [OK] Vue formateurs/show mise à jour");
        }

        // ============================================================
        // 8. Migrer
        // ============================================================
        $this->newLine();
        $this->info("[DB]️  Migration de la base...");
        $this->call('migrate', ['--force' => true]);

        // ============================================================
        // 9. Nettoyer les caches
        // ============================================================
        $this->newLine();
        $this->info("[CLEAN] Nettoyage des caches...");
        $this->call('view:clear');
        $this->call('cache:clear');

        $this->newLine();
        $this->info("✨ SUCCÈS : système d'historique installé");
        $this->line("  * Table historique_formateurs créée");
        $this->line("  * HistoriqueService pour tracer les changements");
        $this->line("  * Approbation -> Affectation/Session créée automatiquement");
        $this->line("  * Vue formateur affiche l'historique complet");

        return self::SUCCESS;
    }

    // ============================================================
    // MIGRATION
    // ============================================================
    protected function getMigration(): string
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
        Schema::create('historique_formateurs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('formateur_id')->constrained('formateurs')->cascadeOnDelete();

            // Type d'événement
            $table->enum('type', [
                'affectation',      // affectation ajoutée
                'session',          // session créée
                'etablissement',    // changement établissement
                'filiere',          // changement filière
                'statut',           // changement de statut
            ]);

            // Référence à l'entité liée
            $table->string('entite_type')->nullable();  // 'Etablissement', 'Filiere', 'Affectation', 'Session'
            $table->unsignedBigInteger('entite_id')->nullable();

            // Valeurs (avant/après)
            $table->string('valeur_avant')->nullable();
            $table->string('valeur_apres')->nullable();

            // Détails complets (JSON pour flexibilité)
            $table->json('details')->nullable();

            // Qui a fait l'action
            $table->string('source')->default('admin');  // 'admin', 'system', 'formateur'

            // Quand
            $table->timestamp('survenu_le');

            $table->timestamps();

            $table->index(['formateur_id', 'type']);
            $table->index('survenu_le');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('historique_formateurs');
    }
};
PHP;
    }

    // ============================================================
    // MODÈLE
    // ============================================================
    protected function getModel(): string
    {
        return <<<'PHP'
<?php

namespace Infrastructure\Persistence\Eloquent\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class HistoriqueFormateurModel extends Model
{
    protected $table = 'historique_formateurs';

    public const TYPE_AFFECTATION    = 'affectation';
    public const TYPE_SESSION        = 'session';
    public const TYPE_ETABLISSEMENT  = 'etablissement';
    public const TYPE_FILIERE        = 'filiere';
    public const TYPE_STATUT         = 'statut';

    protected $fillable = [
        'formateur_id',
        'type',
        'entite_type',
        'entite_id',
        'valeur_avant',
        'valeur_apres',
        'details',
        'source',
        'survenu_le',
    ];

    protected $casts = [
        'details'    => 'array',
        'survenu_le' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // ==================== RELATIONS ====================

    public function formateur(): BelongsTo
    {
        return $this->belongsTo(FormateurModel::class, 'formateur_id');
    }

    // ==================== HELPERS ====================

    public function getIconeAttribute(): string
    {
        return match ($this->type) {
            self::TYPE_AFFECTATION   => 'assignment_ind',
            self::TYPE_SESSION       => 'event',
            self::TYPE_ETABLISSEMENT => 'apartment',
            self::TYPE_FILIERE       => 'school',
            self::TYPE_STATUT        => 'toggle_on',
            default                  => 'history',
        };
    }

    public function getCouleurAttribute(): string
    {
        return match ($this->type) {
            self::TYPE_AFFECTATION   => 'emerald',
            self::TYPE_SESSION       => 'blue',
            self::TYPE_ETABLISSEMENT => 'teal',
            self::TYPE_FILIERE       => 'amber',
            self::TYPE_STATUT        => 'violet',
            default                  => 'slate',
        };
    }

    public function getLibelleAttribute(): string
    {
        return match ($this->type) {
            self::TYPE_AFFECTATION   => 'Affectation',
            self::TYPE_SESSION       => 'Session',
            self::TYPE_ETABLISSEMENT => 'Établissement',
            self::TYPE_FILIERE       => 'Filière',
            self::TYPE_STATUT        => 'Statut',
            default                  => 'Événement',
        };
    }
}
PHP;
    }

    // ============================================================
    // SERVICE HISTORIQUE
    // ============================================================
    protected function getService(): string
    {
        return <<<'PHP'
<?php

namespace App\Services;

use Infrastructure\Persistence\Eloquent\Models\HistoriqueFormateurModel;

class HistoriqueService
{
    /**
     * Enregistre un changement d'affectation
     */
    public static function affectation(
        int $formateurId,
        ?string $etablissementAvant,
        ?string $etablissementApres,
        ?string $filiereAvant,
        ?string $filiereApres,
        ?int $affectationId = null,
        ?string $source = 'admin'
    ): void {
        // Changement établissement
        if ($etablissementAvant !== $etablissementApres) {
            HistoriqueFormateurModel::create([
                'formateur_id'   => $formateurId,
                'type'           => HistoriqueFormateurModel::TYPE_ETABLISSEMENT,
                'entite_type'    => 'Etablissement',
                'valeur_avant'   => $etablissementAvant,
                'valeur_apres'   => $etablissementApres,
                'survenu_le'     => now(),
                'source'         => $source,
            ]);
        }

        // Changement filière
        if ($filiereAvant !== $filiereApres) {
            HistoriqueFormateurModel::create([
                'formateur_id'   => $formateurId,
                'type'           => HistoriqueFormateurModel::TYPE_FILIERE,
                'entite_type'    => 'Filiere',
                'valeur_avant'   => $filiereAvant,
                'valeur_apres'   => $filiereApres,
                'survenu_le'     => now(),
                'source'         => $source,
            ]);
        }

        // Affectation créée
        HistoriqueFormateurModel::create([
            'formateur_id'   => $formateurId,
            'type'           => HistoriqueFormateurModel::TYPE_AFFECTATION,
            'entite_type'    => 'Affectation',
            'entite_id'      => $affectationId,
            'valeur_apres'   => ($filiereApres ?? '-') . ' à ' . ($etablissementApres ?? '-'),
            'survenu_le'     => now(),
            'source'         => $source,
        ]);
    }

    /**
     * Enregistre la création d'une session
     */
    public static function session(
        int $formateurId,
        string $codeSession,
        ?string $titre,
        ?string $filiere,
        ?string $etablissement,
        ?int $sessionId = null,
        ?string $source = 'admin'
    ): void {
        HistoriqueFormateurModel::create([
            'formateur_id'   => $formateurId,
            'type'           => HistoriqueFormateurModel::TYPE_SESSION,
            'entite_type'    => 'Session',
            'entite_id'      => $sessionId,
            'valeur_apres'   => $codeSession . ($titre ? ' - ' . $titre : ''),
            'details'        => [
                'code'          => $codeSession,
                'titre'         => $titre,
                'filiere'       => $filiere,
                'etablissement' => $etablissement,
            ],
            'survenu_le'     => now(),
            'source'         => $source,
        ]);
    }

    /**
     * Enregistre un changement de statut
     */
    public static function statut(
        int $formateurId,
        string $statutAvant,
        string $statutApres,
        ?string $source = 'system'
    ): void {
        HistoriqueFormateurModel::create([
            'formateur_id'   => $formateurId,
            'type'           => HistoriqueFormateurModel::TYPE_STATUT,
            'valeur_avant'   => $statutAvant,
            'valeur_apres'   => $statutApres,
            'survenu_le'     => now(),
            'source'         => $source,
        ]);
    }
}
PHP;
    }

    // ============================================================
    // CONTRÔLEUR ADMIN - DEMANDES D'AFFECTATIONS (mis à jour)
    // ============================================================
    protected function getAffectationAdminController(): string
    {
        return <<<'PHP'
<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\HistoriqueService;
use App\Services\NotificationService;
use Illuminate\Http\Request;
use Infrastructure\Persistence\Eloquent\Models\AffectationModel;
use Infrastructure\Persistence\Eloquent\Models\DemandeAffectationModel;
use Infrastructure\Persistence\Eloquent\Models\FormateurModel;
use Infrastructure\Persistence\Eloquent\Models\SessionModel;

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

    /**
     * Approuver une demande
     * -> Crée automatiquement une Affectation + une Session
     * -> Redirige vers /admin/affectations
     */
    public function approuver(Request $request, int $id)
    {
        $demande = DemandeAffectationModel::findOrFail($id);

        // Récupérer le formateur
        $formateur = FormateurModel::find($demande->formateur_id);

        if (!$formateur) {
            return back()->with('error', 'Formateur introuvable');
        }

        // Récupérer les valeurs AVANT
        $etablissementAvant = $formateur->etablissement?->nom;
        $filiereAvant       = $formateur->filiere?->libelle;

        // Mettre à jour la demande
        $demande->update([
            'statut'        => DemandeAffectationModel::STATUT_APPROUVEE,
            'reponse_admin' => $request->input('reponse_admin', 'Approuvée.'),
            'traitee_le'    => now(),
        ]);

        // ============================================================
        // Créer l'affectation
        // ============================================================
        $affectation = AffectationModel::create([
            'formateur_id'     => $demande->formateur_id,
            'filiere_id'       => $demande->filiere_id,
            'etablissement_id' => $demande->etablissement_id,
            'date_debut'       => now()->toDateString(),
            'date_fin'         => now()->addMonths(6)->toDateString(),
            'statut'           => 'actif',
        ]);

        // ============================================================
        // Mettre à jour le formateur
        // ============================================================
        $formateur->update([
            'etablissement_id' => $demande->etablissement_id,
            'filiere_id'       => $demande->filiere_id,
        ]);

        // ============================================================
        // Créer la session
        // ============================================================
        $session = SessionModel::create([
            'code'             => SessionModel::generateNextCode(),
            'titre'            => 'Session ' . ($demande->filiere?->libelle ?? 'Affectation'),
            'filiere_id'       => $demande->filiere_id,
            'formateur_id'     => $demande->formateur_id,
            'etablissement_id' => $demande->etablissement_id,
            'date_debut'       => now()->toDateString(),
            'date_fin'         => now()->addMonths(6)->toDateString(),
            'nb_places'        => 0,
            'statut'           => 'actif',
        ]);

        // ============================================================
        // [AJAX] HISTORIQUE
        // ============================================================
        HistoriqueService::affectation(
            formateurId:          $demande->formateur_id,
            etablissementAvant:   $etablissementAvant,
            etablissementApres:   $demande->etablissement?->nom,
            filiereAvant:         $filiereAvant,
            filiereApres:         $demande->filiere?->libelle,
            affectationId:        $affectation->id,
            source:               'admin'
        );

        HistoriqueService::session(
            formateurId:    $demande->formateur_id,
            codeSession:    $session->code,
            titre:          $session->titre,
            filiere:        $demande->filiere?->libelle,
            etablissement:  $demande->etablissement?->nom,
            sessionId:      $session->id,
            source:         'admin'
        );

        // ============================================================
        // [AJAX] NOTIFICATION FORMATEUR
        // ============================================================
        NotificationService::demandeAffectationTraitee($demande);

        // ============================================================
        // [AJAX] REDIRECTION vers /admin/affectations
        // ============================================================
        return redirect()
            ->route('admin.affectations.index')
            ->with('success', 'Demande approuvée. Affectation et session créées. Formateur notifié.');
    }

    /**
     * Refuser une demande
     * -> Redirige vers /admin/demandes-affectations
     */
    public function refuser(Request $request, int $id)
    {
        $demande = DemandeAffectationModel::findOrFail($id);

        $demande->update([
            'statut'        => DemandeAffectationModel::STATUT_REFUSEE,
            'reponse_admin' => $request->input('reponse_admin', 'Refusée.'),
            'traitee_le'    => now(),
        ]);

        NotificationService::demandeAffectationTraitee($demande);

        return redirect()
            ->route('admin.demandes-affectations.index')
            ->with('success', 'Demande refusée. Formateur notifié.');
    }
}
PHP;
    }

    // ============================================================
    // CONTRÔLEUR ADMIN - DEMANDES DE SESSIONS (mis à jour)
    // ============================================================
    protected function getSessionAdminController(): string
    {
        return <<<'PHP'
<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\HistoriqueService;
use App\Services\NotificationService;
use Illuminate\Http\Request;
use Infrastructure\Persistence\Eloquent\Models\DemandeSessionModel;
use Infrastructure\Persistence\Eloquent\Models\FormateurModel;
use Infrastructure\Persistence\Eloquent\Models\SessionModel;

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

    /**
     * Approuver une demande de session
     * -> Crée la Session
     * -> Redirige vers /admin/sessions
     */
    public function approuver(Request $request, int $id)
    {
        $demande = DemandeSessionModel::findOrFail($id);

        $formateur = FormateurModel::find($demande->formateur_id);

        if (!$formateur) {
            return back()->with('error', 'Formateur introuvable');
        }

        // Mettre à jour la demande
        $demande->update([
            'statut'        => DemandeSessionModel::STATUT_APPROUVEE,
            'reponse_admin' => $request->input('reponse_admin', 'Approuvée.'),
            'traitee_le'    => now(),
        ]);

        // ============================================================
        // Créer la session
        // ============================================================
        $session = SessionModel::create([
            'code'             => SessionModel::generateNextCode(),
            'titre'            => $demande->titre ?? 'Session de formation',
            'filiere_id'       => $demande->filiere_id,
            'formateur_id'     => $demande->formateur_id,
            'etablissement_id' => $demande->etablissement_id,
            'date_debut'       => $demande->date_debut_souhaitee ?? now()->toDateString(),
            'date_fin'         => $demande->date_fin_souhaitee ?? now()->addMonths(6)->toDateString(),
            'nb_places'        => $demande->nb_places_souhaitees ?? 0,
            'statut'           => 'actif',
        ]);

        // ============================================================
        // [AJAX] HISTORIQUE
        // ============================================================
        HistoriqueService::session(
            formateurId:    $demande->formateur_id,
            codeSession:    $session->code,
            titre:          $session->titre,
            filiere:        $demande->filiere?->libelle,
            etablissement:  $demande->etablissement?->nom,
            sessionId:      $session->id,
            source:         'admin'
        );

        // ============================================================
        // [AJAX] NOTIFICATION FORMATEUR
        // ============================================================
        NotificationService::demandeSessionTraitee($demande);

        // ============================================================
        // [AJAX] REDIRECTION vers /admin/sessions
        // ============================================================
        return redirect()
            ->route('admin.sessions.index')
            ->with('success', 'Demande approuvée. Session créée. Formateur notifié.');
    }

    /**
     * Refuser une demande de session
     */
    public function refuser(Request $request, int $id)
    {
        $demande = DemandeSessionModel::findOrFail($id);

        $demande->update([
            'statut'        => DemandeSessionModel::STATUT_REFUSEE,
            'reponse_admin' => $request->input('reponse_admin', 'Refusée.'),
            'traitee_le'    => now(),
        ]);

        NotificationService::demandeSessionTraitee($demande);

        return redirect()
            ->route('admin.demandes-sessions.index')
            ->with('success', 'Demande refusée. Formateur notifié.');
    }
}
PHP;
    }

    // ============================================================
    // CONTRÔLEUR ADMIN - FORMATEUR (avec historique)
    // ============================================================
    protected function getFormateurAdminController(): string
    {
        return <<<'PHP'
<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Infrastructure\Persistence\Eloquent\Models\EtablissementModel;
use Infrastructure\Persistence\Eloquent\Models\FiliereModel;
use Infrastructure\Persistence\Eloquent\Models\FormateurModel;
use Infrastructure\Persistence\Eloquent\Models\HistoriqueFormateurModel;

class FormateurController extends Controller
{
    public function index(Request $request)
    {
        $formateurs = FormateurModel::with(['etablissement', 'filiere'])
            ->when($request->filled('search'), function ($q) use ($request) {
                $s = $request->search;
                $q->where(function ($qq) use ($s) {
                    $qq->where('nom', 'like', "%{$s}%")
                       ->orWhere('prenom', 'like', "%{$s}%")
                       ->orWhere('matricule', 'like', "%{$s}%");
                });
            })
            ->when($request->filled('etablissement_id'), fn($q, $id) => $q->where('etablissement_id', $id))
            ->when($request->filled('statut'), fn($q, $s) => $q->where('statut', $s))
            ->orderBy('nom')
            ->paginate(15)
            ->withQueryString();

        $etablissements = EtablissementModel::orderBy('nom')->get();
        $filieres = FiliereModel::orderBy('libelle')->get();

        return view('admin.formateurs.index', compact('formateurs', 'etablissements', 'filieres'));
    }

    public function show(int $id)
    {
        $formateur = FormateurModel::with([
            'etablissement',
            'filiere',
            'affectations.filiere',
            'affectations.etablissement',
            'sessions.filiere',
            'sessions.etablissement',
        ])->findOrFail($id);

        // Historique complet
        $historique = HistoriqueFormateurModel::where('formateur_id', $id)
            ->latest('survenu_le')
            ->get();

        // Statistiques
        $stats = [
            'affectations_total'   => $formateur->affectations->count(),
            'affectations_actives' => $formateur->affectations->where('statut', 'actif')->count(),
            'sessions_total'       => $formateur->sessions->count(),
            'sessions_actives'     => $formateur->sessions->where('statut', 'actif')->count(),
        ];

        return view('admin.formateurs.show', compact(
            'formateur',
            'historique',
            'stats'
        ));
    }

    // ... create, store, edit, update, destroy (inchangés)
}
PHP;
    }

    // ============================================================
    // VUE FORMATEUR SHOW (avec historique)
    // ============================================================
    protected function getFormateurShowView(): string
    {
        return <<<'BLADE'
@extends('layouts.admin')
@section('title', 'Fiche formateur')

@section('content')

<div class="mb-6">
    <a href="{{ route('admin.formateurs.index') }}" class="text-[12px] text-slate-500 hover:text-brand-700">
        <- Retour à la liste
    </a>
</div>

{{-- Header --}}
<div class="bg-white rounded-xl border border-slate-200 p-6 mb-6">
    <div class="flex items-center gap-6">
        <div class="w-24 h-24 rounded-2xl bg-gradient-to-br from-brand-400 to-brand-700 flex items-center justify-center shrink-0">
            <span class="text-white text-3xl font-bold">
                {{ strtoupper(substr($formateur->prenom ?? 'U', 0, 1) . substr($formateur->nom ?? 'N', 0, 1)) }}
            </span>
        </div>
        <div class="flex-1">
            <h1 class="font-display text-2xl font-bold text-slate-900">
                {{ $formateur->nom }} {{ $formateur->prenom }}
            </h1>
            <div class="text-[13px] text-slate-500 mt-2 flex flex-wrap gap-4">
                <span>Matricule : <span class="font-mono">{{ $formateur->matricule }}</span></span>
                @if($formateur->grade)
                    <span>Grade : {{ $formateur->grade }}</span>
                @endif
            </div>
        </div>
        <div>
            @if($formateur->statut === 'actif')
                <span class="badge-success">Actif</span>
            @elseif($formateur->statut === 'suspendu')
                <span class="badge-warning">Suspendu</span>
            @else
                <span class="badge-danger">Inactif</span>
            @endif
        </div>
    </div>
</div>

{{-- Stats rapides --}}
<div class="grid grid-cols-4 gap-4 mb-6">
    <div class="bg-white rounded-xl border border-slate-200 p-4 border-l-4 border-emerald-500">
        <div class="text-2xl font-bold text-slate-900">{{ $stats['affectations_total'] }}</div>
        <div class="text-xs text-slate-500 mt-1">Affectations</div>
    </div>
    <div class="bg-white rounded-xl border border-slate-200 p-4 border-l-4 border-emerald-600">
        <div class="text-2xl font-bold text-emerald-600">{{ $stats['affectations_actives'] }}</div>
        <div class="text-xs text-slate-500 mt-1">Affectations actives</div>
    </div>
    <div class="bg-white rounded-xl border border-slate-200 p-4 border-l-4 border-blue-500">
        <div class="text-2xl font-bold text-slate-900">{{ $stats['sessions_total'] }}</div>
        <div class="text-xs text-slate-500 mt-1">Sessions</div>
    </div>
    <div class="bg-white rounded-xl border border-slate-200 p-4 border-l-4 border-blue-600">
        <div class="text-2xl font-bold text-blue-600">{{ $stats['sessions_actives'] }}</div>
        <div class="text-xs text-slate-500 mt-1">Sessions actives</div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
    {{-- Infos --}}
    <div class="lg:col-span-2 bg-white rounded-xl border border-slate-200 p-5">
        <h2 class="font-bold text-slate-900 mb-4">Informations</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
            <div><span class="text-slate-500">Email :</span> {{ $formateur->email ?? '-' }}</div>
            <div><span class="text-slate-500">Téléphone :</span> {{ $formateur->telephone ?? '-' }}</div>
            <div><span class="text-slate-500">Grade :</span> {{ $formateur->grade ?? '-' }}</div>
            <div><span class="text-slate-500">CIN :</span> {{ $formateur->cin ?? '-' }}</div>
            <div><span class="text-slate-500">Sexe :</span> {{ $formateur->sexe ?? '-' }}</div>
            <div><span class="text-slate-500">Date naissance :</span> {{ $formateur->date_naissance?->format('d/m/Y') ?? '-' }}</div>
        </div>
    </div>

    {{-- Établissement + Filière actuelle --}}
    <div class="bg-white rounded-xl border border-slate-200 p-5">
        <h2 class="font-bold text-slate-900 mb-4">Affectation actuelle</h2>
        <div class="space-y-3">
            <div>
                <div class="text-[10px] font-bold text-slate-500 uppercase tracking-wide">Établissement</div>
                <div class="font-semibold text-slate-900 text-sm mt-0.5">
                    {{ $formateur->etablissement->nom ?? '-' }}
                </div>
            </div>
            <div>
                <div class="text-[10px] font-bold text-slate-500 uppercase tracking-wide">Filière</div>
                <div class="font-semibold text-slate-900 text-sm mt-0.5">
                    {{ $formateur->filiere->libelle ?? '-' }}
                </div>
            </div>
        </div>
    </div>
</div>

{{-- ============================================================
     HISTORIQUE
     ============================================================ --}}
<div class="bg-white rounded-xl border border-slate-200 overflow-hidden mb-6">

    <div class="px-5 py-4 border-b border-slate-200 flex justify-between items-center">
        <div>
            <h2 class="font-bold text-slate-900">Historique complet</h2>
            <p class="text-xs text-slate-500 mt-0.5">
                Toutes les affectations, sessions, changements d'établissement et de filière
            </p>
        </div>
        <span class="text-xs font-bold text-slate-500">{{ $historique->count() }} événement(s)</span>
    </div>

    @if($historique->count() > 0)
        <div class="divide-y divide-slate-100">
            @foreach($historique as $evt)
                @php
                    $colors = [
                        'emerald' => ['bg' => 'bg-emerald-50', 'text' => 'text-emerald-600', 'border' => 'border-emerald-200'],
                        'blue'    => ['bg' => 'bg-blue-50',    'text' => 'text-blue-600',    'border' => 'border-blue-200'],
                        'teal'    => ['bg' => 'bg-teal-50',    'text' => 'text-teal-600',    'border' => 'border-teal-200'],
                        'amber'   => ['bg' => 'bg-amber-50',   'text' => 'text-amber-600',   'border' => 'border-amber-200'],
                        'violet'  => ['bg' => 'bg-violet-50',  'text' => 'text-violet-600',  'border' => 'border-violet-200'],
                        'slate'   => ['bg' => 'bg-slate-50',   'text' => 'text-slate-600',   'border' => 'border-slate-200'],
                    ];
                    $c = $colors[$evt->couleur] ?? $colors['slate'];
                @endphp

                <div class="flex items-start gap-4 px-5 py-4 hover:bg-slate-50 transition">
                    <div class="w-10 h-10 rounded-lg {{ $c['bg'] }} border {{ $c['border'] }}
                                flex items-center justify-center shrink-0">
                        <span class="material-symbols-rounded {{ $c['text'] }} text-[20px]"
                              style="font-variation-settings: 'FILL' 1;">
                            {{ $evt->icone }}
                        </span>
                    </div>

                    <div class="flex-1 min-w-0">
                        <div class="flex items-start justify-between gap-3">
                            <div>
                                <div class="font-bold text-slate-900 text-[14px]">
                                    {{ $evt->libelle }}
                                </div>
                                <div class="text-[13px] text-slate-600 mt-1">
                                    @if($evt->valeur_avant && $evt->valeur_apres)
                                        <span class="text-slate-400">{{ $evt->valeur_avant }}</span>
                                        <span class="material-symbols-rounded text-[14px] text-slate-400 align-middle mx-1">arrow_forward</span>
                                        <span class="font-semibold text-slate-800">{{ $evt->valeur_apres }}</span>
                                    @elseif($evt->valeur_apres)
                                        <span class="font-semibold text-slate-800">{{ $evt->valeur_apres }}</span>
                                    @elseif($evt->valeur_avant)
                                        <span class="text-slate-500">{{ $evt->valeur_avant }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="text-right">
                                <div class="text-[11px] text-slate-400 whitespace-nowrap">
                                    {{ $evt->survenu_le?->format('d/m/Y H:i') }}
                                </div>
                                <div class="text-[10px] text-slate-400 mt-0.5">
                                    {{ $evt->survenu_le?->diffForHumans() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="p-12 text-center">
            <span class="material-symbols-rounded text-5xl text-slate-300 block mb-3">history</span>
            <p class="text-slate-500 font-semibold">Aucun historique</p>
            <p class="text-sm text-slate-400 mt-1">L'historique apparaîtra à la première affectation</p>
        </div>
    @endif
</div>

{{-- Affectations --}}
<div class="bg-white rounded-xl border border-slate-200 overflow-hidden mb-6">
    <div class="px-5 py-4 border-b">
        <h2 class="font-bold text-slate-900">Affectations ({{ $formateur->affectations->count() }})</h2>
    </div>
    <table class="table-modern">
        <thead>
            <tr>
                <th>Filière</th>
                <th>Établissement</th>
                <th>Période</th>
                <th>Statut</th>
            </tr>
        </thead>
        <tbody>
            @forelse($formateur->affectations as $a)
            <tr>
                <td>{{ $a->filiere->libelle ?? '-' }}</td>
                <td>{{ $a->etablissement->nom ?? '-' }}</td>
                <td class="text-xs">{{ $a->date_debut?->format('d/m/Y') }} -> {{ $a->date_fin?->format('d/m/Y') ?? 'En cours' }}</td>
                <td>
                    @if($a->statut === 'actif')
                        <span class="badge-success">Actif</span>
                    @elseif($a->statut === 'suspendu')
                        <span class="badge-warning">Suspendu</span>
                    @else
                        <span class="badge-gray">Inactif</span>
                    @endif
                </td>
            </tr>
            @empty
            <tr><td colspan="4" class="text-center py-8 text-slate-400">Aucune affectation</td></tr>
            @endforelse
        </tbody>
    </table>
</div>

{{-- Sessions --}}
<div class="bg-white rounded-xl border border-slate-200 overflow-hidden">
    <div class="px-5 py-4 border-b">
        <h2 class="font-bold text-slate-900">Sessions ({{ $formateur->sessions->count() }})</h2>
    </div>
    <table class="table-modern">
        <thead>
            <tr>
                <th>Code</th>
                <th>Filière</th>
                <th>Établissement</th>
                <th>Période</th>
                <th>Statut</th>
            </tr>
        </thead>
        <tbody>
            @forelse($formateur->sessions as $s)
            <tr>
                <td class="font-mono text-xs">{{ $s->code }}</td>
                <td>{{ $s->filiere->libelle ?? '-' }}</td>
                <td>{{ $s->etablissement->nom ?? '-' }}</td>
                <td class="text-xs">{{ $s->date_debut?->format('d/m/Y') }} -> {{ $s->date_fin?->format('d/m/Y') }}</td>
                <td>
                    @if($s->statut === 'actif')
                        <span class="badge-success">Active</span>
                    @elseif($s->statut === 'suspendu')
                        <span class="badge-warning">Suspendue</span>
                    @else
                        <span class="badge-gray">Terminée</span>
                    @endif
                </td>
            </tr>
            @empty
            <tr><td colspan="5" class="text-center py-8 text-slate-400">Aucune session</td></tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection
BLADE;
    }
}