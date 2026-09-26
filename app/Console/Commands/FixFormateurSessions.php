<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class FixFormateurSessions extends Command
{
    protected $signature = 'project:fix-formateur-sessions
                            {--backup : Sauvegarder les fichiers existants (.bak)}
                            {--force : Écraser sans confirmation}';

    protected $description = 'Corrige le module Sessions formateur (retire toutes les références à presences)';

    public function handle(): int
    {
        $this->info("[TOOL] Correction du module Sessions formateur");
        $this->newLine();

        if (!$this->option('force') && !$this->confirm('Corriger SessionController + SessionModel + vues ?', true)) {
            $this->warn('Annulé.');
            return self::FAILURE;
        }

        $files = [
            'app/Http/Controllers/Formateur/SessionController.php'              => $this->getController(),
            'app/Infrastructure/Persistence/Eloquent/Models/SessionModel.php'   => $this->getModel(),
            'resources/views/formateur/sessions/index.blade.php'                => $this->getIndexView(),
            'resources/views/formateur/sessions/show.blade.php'                 => $this->getShowView(),
        ];

        $count = 0;
        foreach ($files as $path => $content) {
            $fullPath = base_path($path);
            $dir = dirname($fullPath);

            if (!File::exists($dir)) {
                File::makeDirectory($dir, 0755, true);
            }

            if ($this->option('backup') && File::exists($fullPath)) {
                $backupPath = $fullPath . '.bak.' . date('Y-m-d_H-i-s');
                File::copy($fullPath, $backupPath);
                $this->line("  [SAVE] Backup : " . basename($backupPath));
            }

            File::put($fullPath, $content);
            $size = round(strlen($content) / 1024, 2);
            $this->line("  [OK] {$path} ({$size} Ko)");
            $count++;
        }

        $this->newLine();
        $this->info("[CLEAN] Nettoyage des caches...");
        $this->call('view:clear');
        $this->call('cache:clear');
        $this->call('route:clear');

        $this->newLine();
        $this->info("✨ SUCCÈS : {$count} fichier(s) corrigé(s)");
        $this->line("  * SessionController : sans ->withCount('presences')");
        $this->line("  * SessionModel      : sans méthode presences()");
        $this->line("  * Vues              : sans références aux présences");
        $this->newLine();
        $this->info("-> Testez : http://localhost:8000/formateur/sessions");

        return self::SUCCESS;
    }

    // ============================================================
    // CONTROLLER
    // ============================================================
    protected function getController(): string
    {
        return <<<'PHP'
<?php

namespace App\Http\Controllers\Formateur;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Infrastructure\Persistence\Eloquent\Models\FormateurModel;
use Infrastructure\Persistence\Eloquent\Models\SessionModel;

class SessionController extends Controller
{
    /**
     * Récupère la fiche formateur liée au compte connecté
     */
    private function getFormateurMetier()
    {
        $user = Auth::guard('formateur')->user();

        if (!$user) {
            return null;
        }

        return FormateurModel::where('matricule', $user->matricule)
            ->orWhere('email', $user->email)
            ->first();
    }

    /**
     * Liste des sessions du formateur connecté
     */
    public function index()
    {
        $formateurMetier = $this->getFormateurMetier();

        if (!$formateurMetier) {
            return view('formateur.sessions.index', [
                'sessions' => collect(),
                'formateurMetier' => null,
            ]);
        }

        // [!]️ AUCUNE référence à 'presences'
        $sessions = SessionModel::where('formateur_id', $formateurMetier->id)
            ->with(['filiere.niveau', 'filiere.secteur', 'etablissement'])
            ->latest('date_debut')
            ->get();

        return view('formateur.sessions.index', compact('sessions', 'formateurMetier'));
    }

    /**
     * Détail d'une session
     */
    public function show(int $id)
    {
        $formateurMetier = $this->getFormateurMetier();
        abort_if(!$formateurMetier, 403);

        // [!]️ AUCUNE référence à 'presences'
        $session = SessionModel::where('formateur_id', $formateurMetier->id)
            ->with(['filiere.niveau', 'filiere.secteur', 'etablissement'])
            ->findOrFail($id);

        return view('formateur.sessions.show', compact('session', 'formateurMetier'));
    }
}
PHP;
    }

    // ============================================================
    // MODÈLE SESSION
    // ============================================================
    protected function getModel(): string
    {
        return <<<'PHP'
<?php

namespace Infrastructure\Persistence\Eloquent\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SessionModel extends Model
{
    protected $table = 'formations_sessions';

    public const STATUT_ACTIF    = 'actif';
    public const STATUT_INACTIF  = 'inactif';
    public const STATUT_SUSPENDU = 'suspendu';

    public const STATUTS = [
        self::STATUT_ACTIF,
        self::STATUT_INACTIF,
        self::STATUT_SUSPENDU,
    ];

    protected $fillable = [
        'code', 'titre', 'filiere_id', 'formateur_id', 'etablissement_id',
        'date_debut', 'date_fin', 'nb_places', 'description', 'statut', 'expire_le',
    ];

    protected $casts = [
        'date_debut' => 'date',
        'date_fin'   => 'date',
        'expire_le'  => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // ==================== RELATIONS ====================

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

    // [!]️ La relation presences() a été SUPPRIMÉE
    // (table 'presences' supprimée de la base de données)

    // ==================== SCOPES ====================

    public function scopeSearch($query, ?string $term)
    {
        if (!$term) return $query;

        return $query->where(function ($q) use ($term) {
            $q->where('code', 'like', "%{$term}%")
              ->orWhere('titre', 'like', "%{$term}%")
              ->orWhereHas('formateur', function ($qq) use ($term) {
                  $qq->where('nom', 'like', "%{$term}%")
                     ->orWhere('prenom', 'like', "%{$term}%")
                     ->orWhere('matricule', 'like', "%{$term}%");
              });
        });
    }

    public function scopeActif($query)
    {
        return $query->where('statut', self::STATUT_ACTIF);
    }

    public function scopeInactif($query)
    {
        return $query->where('statut', self::STATUT_INACTIF);
    }

    public function scopeSuspendu($query)
    {
        return $query->where('statut', self::STATUT_SUSPENDU);
    }

    // ==================== HELPERS ====================

    public function estEnCours(): bool
    {
        return $this->statut === self::STATUT_ACTIF
            && $this->date_debut <= now()
            && $this->date_fin >= now();
    }

    public function estTerminee(): bool
    {
        return $this->statut === self::STATUT_INACTIF
            || ($this->date_fin && $this->date_fin < now());
    }

    public function estAVenir(): bool
    {
        return $this->statut === self::STATUT_ACTIF
            && $this->date_debut > now();
    }

    public function estSuspendue(): bool
    {
        return $this->statut === self::STATUT_SUSPENDU;
    }

    public function estExpiree(): bool
    {
        return $this->date_fin && $this->date_fin < now();
    }

    // ==================== GÉNÉRATION CODE AUTO ====================

    public static function generateNextCode(): string
    {
        $annee = (int) date('Y');
        $prefix = sprintf('SESS-%d-', $annee);

        $last = self::where('code', 'like', $prefix . '%')
            ->orderByRaw('CAST(SUBSTR(code, ' . (strlen($prefix) + 1) . ') AS INTEGER) DESC')
            ->value('code');

        $numero = $last ? (int) substr($last, strlen($prefix)) + 1 : 1;

        return sprintf('%s%04d', $prefix, $numero);
    }
}
PHP;
    }

    // ============================================================
    // VUE INDEX
    // ============================================================
    protected function getIndexView(): string
    {
        return <<<'BLADE'
@extends('layouts.formateur')
@section('title', 'Mes sessions')

@section('content')

<div class="mb-8">
    <h1 class="font-display text-3xl font-bold text-slate-900">Mes sessions</h1>
    <p class="text-sm text-slate-500 mt-1">
        Total : {{ $sessions->count() }} session(s)
    </p>
</div>

@if(!$formateurMetier)
    <div class="flex items-start gap-3 px-5 py-4 rounded-2xl bg-amber-50 border border-amber-200 text-amber-800 text-sm">
        <span class="material-symbols-rounded">warning</span>
        <div>
            Votre profil formateur n'est pas encore configuré.
            Contactez l'administration.
        </div>
    </div>
@else

    @if($sessions->count() === 0)
        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-16 text-center">
            <span class="material-symbols-rounded text-6xl text-slate-300 block mb-3">
                event
            </span>
            <p class="text-slate-500 font-semibold">Aucune session pour le moment.</p>
            <p class="text-sm text-slate-400 mt-1">
                Vos sessions apparaîtront ici dès qu'elles seront créées.
            </p>
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
            @foreach($sessions as $session)
            <div class="bg-white rounded-2xl border border-slate-100 shadow-sm
                        hover:shadow-lg transition-all group">

                <div class="p-6">
                    <div class="flex items-start justify-between mb-4">

                        <div class="w-12 h-12 rounded-xl
                                    bg-gradient-to-br from-emerald-50 to-emerald-100
                                    flex items-center justify-center text-emerald-600">
                            <span class="material-symbols-rounded text-2xl"
                                  style="font-variation-settings: 'FILL' 1;">
                                event
                            </span>
                        </div>

                        @if($session->estEnCours())
                            <span class="inline-flex items-center gap-1.5 px-3 py-1
                                         rounded-full text-[11px] font-semibold
                                         bg-emerald-50 text-emerald-700">
                                En cours
                            </span>
                        @elseif($session->estTerminee())
                            <span class="inline-flex items-center gap-1.5 px-3 py-1
                                         rounded-full text-[11px] font-semibold
                                         bg-slate-100 text-slate-600">
                                Terminée
                            </span>
                        @else
                            <span class="inline-flex items-center gap-1.5 px-3 py-1
                                         rounded-full text-[11px] font-semibold
                                         bg-green-50 text-green-700">
                                À venir
                            </span>
                        @endif
                    </div>

                    <h3 class="font-display font-bold text-lg text-slate-900 font-mono">
                        {{ $session->code }}
                    </h3>
                    <p class="text-sm text-slate-500 mt-1">
                        {{ $session->filiere->libelle ?? '-' }}
                    </p>
                    <p class="text-xs text-slate-400 mt-1">
                        {{ $session->etablissement->nom ?? '-' }}
                    </p>
                </div>

                <div class="px-6 py-4 border-t border-slate-100
                            flex items-center justify-between">
                    <div class="flex items-center gap-1.5 text-xs text-slate-500">
                        <span class="material-symbols-rounded text-sm">
                            calendar_today
                        </span>
                        {{ $session->date_debut?->format('d/m/Y') ?? '-' }}
                    </div>

                    <a href="{{ route('formateur.sessions.show', $session->id) }}"
                       class="text-emerald-700 hover:text-emerald-500
                              font-semibold text-sm">
                        Détails ->
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    @endif
@endif

@endsection
BLADE;
    }

    // ============================================================
    // VUE SHOW
    // ============================================================
    protected function getShowView(): string
    {
        return <<<'BLADE'
@extends('layouts.formateur')
@section('title', 'Détails de la session')

@section('content')

<div class="flex items-center gap-4 mb-8">
    <a href="{{ route('formateur.sessions.index') }}"
       class="w-10 h-10 rounded-xl bg-white border border-slate-200
              flex items-center justify-center text-slate-600
              hover:text-emerald-700 transition">
        <span class="material-symbols-rounded">arrow_back</span>
    </a>
    <h1 class="font-display text-3xl font-bold text-slate-900">
        Détails de la session
    </h1>
</div>

<div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden mb-6">
    <div class="p-8 grid grid-cols-1 md:grid-cols-2 gap-6">

        <div class="md:col-span-2">
            <p class="text-xs font-semibold text-slate-500 uppercase mb-1">Code</p>
            <p class="font-display font-bold text-xl text-slate-900 font-mono">
                {{ $session->code }}
            </p>
        </div>

        <div>
            <p class="text-xs font-semibold text-slate-500 uppercase mb-1">Filière</p>
            <p class="font-semibold text-slate-900">
                {{ $session->filiere->libelle ?? '-' }}
            </p>
        </div>

        <div>
            <p class="text-xs font-semibold text-slate-500 uppercase mb-1">Établissement</p>
            <p class="font-semibold text-slate-900">
                {{ $session->etablissement->nom ?? '-' }}
            </p>
        </div>

        <div>
            <p class="text-xs font-semibold text-slate-500 uppercase mb-1">Date début</p>
            <p class="font-semibold text-slate-900">
                {{ $session->date_debut?->format('d/m/Y') ?? '-' }}
            </p>
        </div>

        <div>
            <p class="text-xs font-semibold text-slate-500 uppercase mb-1">Date fin</p>
            <p class="font-semibold text-slate-900">
                {{ $session->date_fin?->format('d/m/Y') ?? '-' }}
            </p>
        </div>

        <div>
            <p class="text-xs font-semibold text-slate-500 uppercase mb-1">Places</p>
            <p class="font-semibold text-slate-900">
                {{ $session->nb_places ?? 0 }}
            </p>
        </div>

        <div>
            <p class="text-xs font-semibold text-slate-500 uppercase mb-1">Statut</p>
            @if($session->estEnCours())
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full
                             text-[11px] font-semibold bg-emerald-50 text-emerald-700">
                    En cours
                </span>
            @elseif($session->estTerminee())
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full
                             text-[11px] font-semibold bg-slate-100 text-slate-600">
                    Terminée
                </span>
            @else
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full
                             text-[11px] font-semibold bg-green-50 text-green-700">
                    À venir
                </span>
            @endif
        </div>

    </div>
</div>

@endsection
BLADE;
    }
}