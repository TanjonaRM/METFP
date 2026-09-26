<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class InstallSessionModalSimple extends Command
{
    protected $signature = 'project:install-session-modal-simple
                            {--backup : Sauvegarder les fichiers (.bak)}
                            {--force : Écraser sans confirmation}';

    protected $description = 'Ajoute le bouton vert + modal de demande de session sur /formateur/sessions (sans champ places)';

    public function handle(): int
    {
        $this->info("[TARGET] Installation : bouton + modal sur sessions formateur");
        $this->newLine();

        if (!$this->option('force') && !$this->confirm('Installer le module ?', true)) {
            $this->warn('Annulé.');
            return self::FAILURE;
        }

        // ============================================================
        // 1. Mettre à jour la vue sessions/index
        // ============================================================
        $viewPath = base_path('resources/views/formateur/sessions/index.blade.php');

        if (!File::exists(dirname($viewPath))) {
            File::makeDirectory(dirname($viewPath), 0755, true);
        }

        if ($this->option('backup') && File::exists($viewPath)) {
            File::copy($viewPath, $viewPath . '.bak.' . date('Y-m-d_H-i-s'));
            $this->line("  [SAVE] Backup : index.blade.php");
        }

        File::put($viewPath, $this->getView());
        $this->line("  [OK] Vue sessions/index.blade.php mise à jour");

        // ============================================================
        // 2. Mettre à jour le contrôleur formateur (sans nb_places)
        // ============================================================
        $controllerPath = base_path('app/Http/Controllers/Formateur/DemandeSessionController.php');

        if (File::exists($controllerPath)) {
            if ($this->option('backup')) {
                File::copy($controllerPath, $controllerPath . '.bak.' . date('Y-m-d_H-i-s'));
            }

            File::put($controllerPath, $this->getController());
            $this->line("  [OK] DemandeSessionController mis à jour");
        }

        // ============================================================
        // 3. Nettoyer les caches
        // ============================================================
        $this->newLine();
        $this->info("[CLEAN] Nettoyage des caches...");
        $this->call('view:clear');
        $this->call('cache:clear');

        $this->newLine();
        $this->info("✨ SUCCÈS");
        $this->line("  * Bouton vert sur /formateur/sessions");
        $this->line("  * Modal avec formulaire (sans champ places)");
        $this->line("  * Envoi -> notification admin");

        return self::SUCCESS;
    }

    // ============================================================
    // VUE SESSIONS/INDEX
    // ============================================================
    protected function getView(): string
    {
        return <<<'BLADE'
@extends('layouts.formateur')
@section('title', 'Mes sessions')

@section('content')

{{-- ============================================================
     HEADER + BOUTON VERT
     ============================================================ --}}
<div class="mb-6 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
    <div>
        <h1 class="font-display text-2xl font-bold text-slate-900">Mes sessions</h1>
        <p class="text-sm text-slate-500 mt-1">
            Total : {{ $sessions->count() }} session(s)
        </p>
    </div>

    {{-- [OK] BOUTON VERT - Tailwind pur (pas de classe custom) --}}
    <button type="button"
            onclick="openSessionModal()"
            style="background-color: #059669 !important; color: #ffffff !important;"
            class="inline-flex items-center justify-center gap-2
                   px-5 py-3 rounded-xl
                   text-[14px] font-semibold
                   shadow-md hover:shadow-lg hover:-translate-y-0.5
                   transition-all duration-200
                   border-0 cursor-pointer">
        <span class="material-symbols-rounded text-[20px]"
              style="color: #ffffff !important; font-variation-settings: 'FILL' 1;">
            add_circle
        </span>
        <span style="color: #ffffff !important;">Nouvelle demande de session</span>
    </button>
</div>

{{-- ============================================================
     MESSAGES
     ============================================================ --}}
@if(session('success'))
    <div class="mb-4 flex items-start gap-3 px-4 py-3 rounded-xl
                bg-emerald-50 border border-emerald-200 text-emerald-800 text-sm">
        <span class="material-symbols-rounded">check_circle</span>
        <div>{{ session('success') }}</div>
    </div>
@endif

@if($errors->any())
    <div class="mb-4 flex items-start gap-3 px-4 py-3 rounded-xl
                bg-red-50 border border-red-200 text-red-800 text-sm">
        <span class="material-symbols-rounded">error</span>
        <div>
            @foreach($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    </div>
@endif

{{-- ============================================================
     CONTENU
     ============================================================ --}}
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
                Cliquez sur "Nouvelle demande de session" pour commencer.
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

{{-- ============================================================
     MODAL : NOUVELLE DEMANDE DE SESSION
     ([!]️ SANS le champ "nombre de places")
     ============================================================ --}}
<div id="sessionModal"
     class="fixed inset-0 z-[9999] items-center justify-center p-4"
     style="display:none;"
     onclick="if(event.target === this) closeSessionModal()">

    <div class="absolute inset-0 bg-black/50 backdrop-blur-sm"></div>

    <div class="relative bg-white rounded-2xl shadow-2xl w-full max-w-xl
                flex flex-col overflow-hidden"
         style="max-height: 90vh;">

        {{-- Header --}}
        <div class="px-6 py-4 border-b border-slate-200 flex items-center justify-between shrink-0">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl flex items-center justify-center shadow-sm"
                     style="background-color: #059669;">
                    <span class="material-symbols-rounded text-white text-xl"
                          style="font-variation-settings: 'FILL' 1; color: #ffffff;">
                        event
                    </span>
                </div>
                <div>
                    <h2 class="font-display text-lg font-bold text-slate-900">
                        Nouvelle demande de session
                    </h2>
                    <p class="text-xs text-slate-500">
                        Remplissez le formulaire ci-dessous
                    </p>
                </div>
            </div>
            <button type="button" onclick="closeSessionModal()"
                    class="w-9 h-9 rounded-lg flex items-center justify-center
                           text-slate-400 hover:bg-slate-100 hover:text-slate-700 transition">
                <span class="material-symbols-rounded text-[20px]">close</span>
            </button>
        </div>

        {{-- Form --}}
        <form action="{{ route('formateur.demandes-sessions.store') }}"
              method="POST"
              class="flex flex-col flex-1 min-h-0">
            @csrf

            <div class="flex-1 overflow-y-auto px-6 py-5 space-y-4">

                {{-- Titre --}}
                <div>
                    <label for="titre" class="block text-sm font-semibold text-slate-700 mb-2">
                        Titre de la session <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="titre" id="titre"
                           value="{{ old('titre') }}"
                           required
                           placeholder="Ex: Session de formation continue"
                           class="w-full px-4 py-3 text-sm border-2 border-slate-200 rounded-xl
                                  focus:outline-none focus:border-emerald-500 focus:ring-2 focus:ring-emerald-100">
                </div>

                {{-- Filière + Établissement --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                    <div>
                        <label for="filiere_id" class="block text-sm font-semibold text-slate-700 mb-2">
                            Filière
                        </label>
                        <select name="filiere_id" id="filiere_id"
                                class="w-full px-4 py-3 text-sm border-2 border-slate-200 rounded-xl
                                       focus:outline-none focus:border-emerald-500 focus:ring-2 focus:ring-emerald-100">
                            <option value="">- Aucune -</option>
                            @foreach($filieres ?? [] as $f)
                                <option value="{{ $f->id }}" @selected(old('filiere_id') == $f->id)>
                                    {{ $f->libelle }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="etablissement_id" class="block text-sm font-semibold text-slate-700 mb-2">
                            Établissement
                        </label>
                        <select name="etablissement_id" id="etablissement_id"
                                class="w-full px-4 py-3 text-sm border-2 border-slate-200 rounded-xl
                                       focus:outline-none focus:border-emerald-500 focus:ring-2 focus:ring-emerald-100">
                            <option value="">- Aucun -</option>
                            @foreach($etablissements ?? [] as $e)
                                <option value="{{ $e->id }}" @selected(old('etablissement_id') == $e->id)>
                                    {{ $e->nom }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                {{-- Dates --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                    <div>
                        <label for="date_debut_souhaitee" class="block text-sm font-semibold text-slate-700 mb-2">
                            Date de début souhaitée
                        </label>
                        <input type="date" name="date_debut_souhaitee" id="date_debut_souhaitee"
                               value="{{ old('date_debut_souhaitee') }}"
                               min="{{ date('Y-m-d') }}"
                               class="w-full px-4 py-3 text-sm border-2 border-slate-200 rounded-xl
                                      focus:outline-none focus:border-emerald-500 focus:ring-2 focus:ring-emerald-100">
                    </div>
                    <div>
                        <label for="date_fin_souhaitee" class="block text-sm font-semibold text-slate-700 mb-2">
                            Date de fin souhaitée
                        </label>
                        <input type="date" name="date_fin_souhaitee" id="date_fin_souhaitee"
                               value="{{ old('date_fin_souhaitee') }}"
                               class="w-full px-4 py-3 text-sm border-2 border-slate-200 rounded-xl
                                      focus:outline-none focus:border-emerald-500 focus:ring-2 focus:ring-emerald-100">
                    </div>
                </div>

                {{-- [!]️ SUPPRIMÉ : Nombre de places souhaitées --}}

                {{-- Motif --}}
                <div>
                    <label for="motif" class="block text-sm font-semibold text-slate-700 mb-2">
                        Motif <span class="text-red-500">*</span>
                    </label>
                    <textarea name="motif" id="motif" rows="4" required minlength="10"
                              placeholder="Expliquez brièvement la raison de votre demande (min. 10 caractères)..."
                              class="w-full px-4 py-3 text-sm border-2 border-slate-200 rounded-xl
                                     focus:outline-none focus:border-emerald-500 focus:ring-2 focus:ring-emerald-100
                                     resize-none">{{ old('motif') }}</textarea>
                    <p class="text-[11px] text-slate-400 mt-1.5">
                        ⓘ Cette demande sera envoyée à l'administration pour approbation.
                    </p>
                </div>
            </div>

            {{-- Footer --}}
            <div class="px-6 py-4 border-t border-slate-200 flex justify-end gap-2 bg-slate-50 rounded-b-2xl shrink-0">
                <button type="button" onclick="closeSessionModal()"
                        class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl
                               bg-slate-100 text-slate-700 text-sm font-semibold
                               hover:bg-slate-200 transition">
                    Annuler
                </button>
                <button type="submit"
                        style="background-color: #059669 !important; color: #ffffff !important;"
                        class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl
                               text-sm font-semibold
                               shadow-md hover:shadow-lg transition">
                    <span class="material-symbols-rounded text-[18px]"
                          style="color: #ffffff !important;">
                        send
                    </span>
                    <span style="color: #ffffff !important;">Envoyer la demande</span>
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function openSessionModal() {
        document.getElementById('sessionModal').style.display = 'flex';
        document.body.style.overflow = 'hidden';
    }

    function closeSessionModal() {
        document.getElementById('sessionModal').style.display = 'none';
        document.body.style.overflow = '';
    }

    document.addEventListener('keydown', e => {
        if (e.key === 'Escape') closeSessionModal();
    });
</script>

@endsection
BLADE;
    }

    // ============================================================
    // CONTRÔLEUR (sans nb_places)
    // ============================================================
    protected function getController(): string
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
        // [!]️ Validation SANS le champ nb_places_souhaitees
        $validated = $request->validate([
            'filiere_id'            => 'nullable|exists:filieres,id',
            'etablissement_id'      => 'nullable|exists:etablissements,id',
            'titre'                 => 'required|string|max:255',
            'date_debut_souhaitee'  => 'nullable|date|after_or_equal:today',
            'date_fin_souhaitee'    => 'nullable|date|after_or_equal:date_debut_souhaitee',
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
            'nb_places_souhaitees' => 0,  // [!]️ valeur par défaut (champ supprimé)
            'motif'                => $validated['motif'],
            'statut'               => DemandeSessionModel::STATUT_EN_ATTENTE,
        ]);

        // [AJAX] Notification automatique aux admins
        NotificationService::demandeSessionCreee($demande);

        return back()->with('success', 'Votre demande a été envoyée avec succès !');
    }
}
PHP;
    }
}