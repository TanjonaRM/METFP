<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class ProjectInstall extends Command
{
    protected $signature = 'project:install {module}';

    protected $description = 'Installe les fichiers d\'un module (formateurs, etablissements, filieres...)';

    public function handle(): int
    {
        $module = $this->argument('module');
        $modules = $this->getModules();

        if (!isset($modules[$module])) {
            $this->error("Module inconnu : {$module}");
            $this->info("Modules disponibles : " . implode(', ', array_keys($modules)));
            return self::FAILURE;
        }

        $this->info("Installation du module : {$module}");
        $this->newLine();

        $count = 0;
        foreach ($modules[$module] as $relativePath => $content) {
            $fullPath = base_path($relativePath);
            $directory = dirname($fullPath);

            if (!File::exists($directory)) {
                File::makeDirectory($directory, 0755, true);
            }

            File::put($fullPath, $content);
            $size = strlen($content);
            $this->line("  OK  {$relativePath} ({$size} car.)");
            $count++;
        }

        $this->newLine();
        $this->info("Nettoyage des caches...");
        $this->call('optimize:clear');

        $this->newLine();
        $this->info("SUCCES : {$count} fichier(s) installe(s) !");
        return self::SUCCESS;
    }

    protected function getModules(): array
    {
        return [
            'formateurs' => $this->getFormateursFiles(),
        ];
    }

    // ============================================================
    // MODULE FORMATEURS
    // ============================================================
    protected function getFormateursFiles(): array
    {
        return [

            // =====================================================
            // 1. CONTROLLER
            // =====================================================
            'app/Http/Controllers/Admin/FormateurController.php' => <<<'PHP'
<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Formateur\StoreFormateurRequest;
use App\Http\Requests\Formateur\UpdateFormateurRequest;
use Application\Formateurs\DTOs\CreateFormateurDTO;
use Application\Formateurs\DTOs\UpdateFormateurDTO;
use Application\Formateurs\UseCases\CreateFormateur\CreateFormateurUseCase;
use Application\Formateurs\UseCases\DeleteFormateur\DeleteFormateurUseCase;
use Application\Formateurs\UseCases\UpdateFormateur\UpdateFormateurUseCase;
use Domain\Formateurs\Ports\FormateurRepositoryInterface;
use Infrastructure\Persistence\Eloquent\Models\EtablissementModel;
use Infrastructure\Persistence\Eloquent\Models\FiliereModel;
use Infrastructure\Persistence\Eloquent\Models\FormateurModel;

class FormateurController extends Controller
{
    public function __construct(
        private FormateurRepositoryInterface $repository,
        private CreateFormateurUseCase $createUseCase,
        private UpdateFormateurUseCase $updateUseCase,
        private DeleteFormateurUseCase $deleteUseCase,
    ) {}

    public function index()
    {
        $formateurs = FormateurModel::with(['etablissement', 'filiere'])
            ->search(request('search'))
            ->when(request('etablissement_id'), fn($q, $id) => $q->where('etablissement_id', $id))
            ->when(request('filiere_id'), fn($q, $id) => $q->where('filiere_id', $id))
            ->when(request('statut'), fn($q, $s) => $q->where('statut', $s))
            ->orderBy('nom')
            ->orderBy('prenom')
            ->paginate(15)
            ->withQueryString();

        $etablissements = EtablissementModel::orderBy('nom')->get();
        $filieres = FiliereModel::orderBy('libelle')->get();

        return view('admin.formateurs.index', compact('formateurs', 'etablissements', 'filieres'));
    }

    public function create()
    {
        $etablissements = EtablissementModel::orderBy('nom')->get();
        $filieres = FiliereModel::orderBy('libelle')->get();
        $nextMatricule = FormateurModel::generateNextMatricule();

        if (request()->ajax() || request()->wantsJson()) {
            return response()->json([
                'html' => view('admin.formateurs.partials.form', compact(
                    'etablissements', 'filieres', 'nextMatricule'
                ))->render(),
                'matricule' => $nextMatricule,
            ]);
        }

        return view('admin.formateurs.create', compact('etablissements', 'filieres', 'nextMatricule'));
    }

    public function store(StoreFormateurRequest $request)
    {
        try {
            $dto = CreateFormateurDTO::fromArray($request->validated());
            $this->createUseCase->execute($dto);

            $model = FormateurModel::where('matricule', $request->matricule)->first();
            if ($model) {
                $model->update([
                    'filiere_id' => $request->filiere_id,
                    'statut'     => $request->statut,
                ]);
            }

            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success'  => true,
                    'message'  => 'Formateur cree avec succes.',
                    'redirect' => route('admin.formateurs.index'),
                ]);
            }

            return redirect()->route('admin.formateurs.index')
                ->with('success', 'Formateur cree avec succes.');
        } catch (\Exception $e) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json(['success' => false, 'message' => $e->getMessage()], 422);
            }
            return back()->withErrors(['error' => $e->getMessage()])->withInput();
        }
    }

    public function show(int $id)
    {
        $formateur = FormateurModel::with([
            'etablissement', 'filiere',
            'affectations.filiere', 'affectations.etablissement',
            'sessions.filiere', 'sessions.etablissement',
        ])->findOrFail($id);

        $stats = [
            'affectations_total'   => $formateur->affectations->count(),
            'affectations_actives' => $formateur->affectations->where('statut', 'actif')->count(),
            'sessions_total'       => $formateur->sessions->count(),
            'filieres_total'       => $formateur->filiere ? 1 : 0,
        ];

        return view('admin.formateurs.show', compact('formateur', 'stats'));
    }

    public function edit(int $id)
    {
        $formateur = FormateurModel::findOrFail($id);
        $etablissements = EtablissementModel::orderBy('nom')->get();
        $filieres = FiliereModel::orderBy('libelle')->get();

        return view('admin.formateurs.edit', compact('formateur', 'etablissements', 'filieres'));
    }

    public function update(UpdateFormateurRequest $request, int $id)
    {
        try {
            $dto = UpdateFormateurDTO::fromArray($id, $request->validated());
            $this->updateUseCase->execute($dto);

            $model = FormateurModel::find($id);
            if ($model) {
                $model->update([
                    'filiere_id' => $request->filiere_id,
                    'statut'     => $request->statut,
                ]);
            }

            return redirect()->route('admin.formateurs.index')
                ->with('success', 'Formateur mis a jour.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()])->withInput();
        }
    }

    public function destroy(int $id)
    {
        try {
            $this->deleteUseCase->execute($id);
            return redirect()->route('admin.formateurs.index')
                ->with('success', 'Formateur supprime.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
PHP,

            // =====================================================
            // 2. STORE REQUEST
            // =====================================================
            'app/Http/Requests/Formateur/StoreFormateurRequest.php' => <<<'PHP'
<?php

namespace App\Http\Requests\Formateur;

use Illuminate\Foundation\Http\FormRequest;

class StoreFormateurRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth('admin')->check();
    }

    public function rules(): array
    {
        return [
            'matricule'        => ['required', 'string', 'max:50', 'unique:formateurs,matricule', 'regex:/^FORM-\d{3,}$/'],
            'nom'              => ['required', 'string', 'max:100'],
            'prenom'           => ['required', 'string', 'max:100'],
            'email'            => ['required', 'email', 'max:255', 'unique:formateurs,email'],
            'telephone'        => ['nullable', 'string', 'max:20'],
            'sexe'             => ['nullable', 'in:Masculin,Feminin'],
            'date_naissance'   => ['nullable', 'date'],
            'lieu_naissance'   => ['nullable', 'string', 'max:150'],
            'cin'              => ['nullable', 'string', 'max:50'],
            'adresse'          => ['nullable', 'string', 'max:255'],
            'grade'            => ['required', 'string', 'max:50'],
            'date_recrutement' => ['nullable', 'date'],
            'etablissement_id' => ['nullable', 'exists:etablissements,id'],
            'filiere_id'       => ['nullable', 'exists:filieres,id'],
            'statut'           => ['required', 'in:actif,inactif,suspendu'],
        ];
    }

    public function messages(): array
    {
        return [
            'matricule.regex'  => 'Le matricule doit suivre le format FORM-XXX.',
            'matricule.unique' => 'Ce matricule est deja utilise.',
            'email.unique'     => 'Cet email est deja utilise.',
            'statut.in'        => 'Le statut doit etre : actif, inactif ou suspendu.',
        ];
    }
}
PHP,

            // =====================================================
            // 3. UPDATE REQUEST
            // =====================================================
            'app/Http/Requests/Formateur/UpdateFormateurRequest.php' => <<<'PHP'
<?php

namespace App\Http\Requests\Formateur;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateFormateurRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth('admin')->check();
    }

    public function rules(): array
    {
        $id = $this->route('formateur');

        return [
            'matricule'        => ['required', 'string', 'max:50', Rule::unique('formateurs', 'matricule')->ignore($id), 'regex:/^FORM-\d{3,}$/'],
            'nom'              => ['required', 'string', 'max:100'],
            'prenom'           => ['required', 'string', 'max:100'],
            'email'            => ['required', 'email', 'max:255', Rule::unique('formateurs', 'email')->ignore($id)],
            'telephone'        => ['nullable', 'string', 'max:20'],
            'sexe'             => ['nullable', 'in:Masculin,Feminin'],
            'date_naissance'   => ['nullable', 'date'],
            'lieu_naissance'   => ['nullable', 'string', 'max:150'],
            'cin'              => ['nullable', 'string', 'max:50'],
            'adresse'          => ['nullable', 'string', 'max:255'],
            'grade'            => ['required', 'string', 'max:50'],
            'date_recrutement' => ['nullable', 'date'],
            'etablissement_id' => ['nullable', 'exists:etablissements,id'],
            'filiere_id'       => ['nullable', 'exists:filieres,id'],
            'statut'           => ['required', 'in:actif,inactif,suspendu'],
        ];
    }
}
PHP,

            // =====================================================
            // 4. FORM PARTIAL (CADRES VISIBLES)
            // =====================================================
            'resources/views/admin/formateurs/partials/form.blade.php' => <<<'BLADE'
@php
    $grades = [
        'Assistant', 'Assistant Principal', 'Maitre-Assistant',
        'Maitre de Conferences', 'Professeur Habilité',
        'Professeur de l\'Enseignement Supérieur', 'Professeur Titulaire',
        'Vacataire', 'Contractuel',
    ];
@endphp

<style>
    .form-field { width:100%; padding:0.75rem 1rem; font-size:0.9375rem; line-height:1.5; color:#0f172a; background-color:#fff; border:1.5px solid #e2e8f0; border-radius:0.5rem; transition:all 0.15s ease; font-family:inherit; }
    .form-field::placeholder { color:#94a3b8; }
    .form-field:focus { outline:none; border-color:#059669; box-shadow:0 0 0 3px rgba(5,150,105,0.12); }
    .form-field:read-only, .form-field:disabled { background-color:#f8fafc; color:#64748b; cursor:not-allowed; }
    .form-label { display:block; font-size:0.875rem; font-weight:600; color:#1e293b; margin-bottom:0.375rem; }
    .form-label .required { color:#ef4444; margin-left:0.125rem; }
    .form-hint { font-size:0.75rem; color:#64748b; margin-top:0.375rem; }
    .form-card { background-color:#fff; border:1.5px solid #e2e8f0; border-radius:0.75rem; padding:1.25rem; }
    .form-card + .form-card { margin-top:1rem; }
    .form-card-header { display:flex; align-items:center; gap:0.5rem; margin-bottom:1rem; padding-bottom:0.75rem; border-bottom:1px dashed #e2e8f0; }
    .form-card-icon { width:1.75rem; height:1.75rem; display:inline-flex; align-items:center; justify-content:center; background:#d1fae5; color:#059669; border-radius:0.5rem; font-size:1.125rem; }
    .form-card-title { font-size:0.8125rem; font-weight:700; color:#059669; text-transform:uppercase; letter-spacing:0.05em; }
    .form-error { font-size:0.75rem; color:#ef4444; margin-top:0.25rem; }
</style>

<div class="space-y-4">

    <div class="form-card">
        <div class="form-card-header">
            <span class="form-card-icon material-symbols-rounded">badge</span>
            <span class="form-card-title">Identité</span>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="md:col-span-2">
                <label class="form-label">Matricule <span class="required">*</span> <span class="text-xs font-normal text-emerald-600 ml-1">(auto-généré)</span></label>
                <input type="text" name="matricule" value="{{ old('matricule', $formateur->matricule ?? ($nextMatricule ?? '')) }}" class="form-field font-mono" readonly required>
                @error('matricule') <p class="form-error">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="form-label">Nom <span class="required">*</span></label>
                <input type="text" name="nom" value="{{ old('nom', $formateur->nom ?? '') }}" class="form-field" placeholder="Ex: RAKOTO" required>
                @error('nom') <p class="form-error">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="form-label">Prénom <span class="required">*</span></label>
                <input type="text" name="prenom" value="{{ old('prenom', $formateur->prenom ?? '') }}" class="form-field" placeholder="Ex: Jean" required>
                @error('prenom') <p class="form-error">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="form-label">Sexe</label>
                <select name="sexe" class="form-field">
                    <option value="">- Sélectionner -</option>
                    <option value="Masculin" @selected(old('sexe', $formateur->sexe ?? '') === 'Masculin')>Masculin</option>
                    <option value="Feminin" @selected(old('sexe', $formateur->sexe ?? '') === 'Feminin')>Féminin</option>
                </select>
            </div>
            <div>
                <label class="form-label">CIN</label>
                <input type="text" name="cin" value="{{ old('cin', $formateur->cin ?? '') }}" class="form-field" placeholder="Ex: 101234567890">
            </div>
            <div class="md:col-span-2">
                <label class="form-label">Date de naissance</label>
                <input type="date" name="date_naissance" value="{{ old('date_naissance', isset($formateur) && $formateur->date_naissance ? $formateur->date_naissance->format('Y-m-d') : '') }}" class="form-field">
            </div>
        </div>
    </div>

    <div class="form-card">
        <div class="form-card-header">
            <span class="form-card-icon material-symbols-rounded">toggle_on</span>
            <span class="form-card-title">Statut global</span>
        </div>
        <div>
            <label class="form-label">Statut <span class="required">*</span></label>
            <select name="statut" class="form-field" required>
                <option value="actif" @selected(old('statut', $formateur->statut ?? 'actif') === 'actif')>Actif - Le formateur est en activité</option>
                <option value="inactif" @selected(old('statut', $formateur->statut ?? '') === 'inactif')>Inactif - Le formateur a terminé</option>
                <option value="suspendu" @selected(old('statut', $formateur->statut ?? '') === 'suspendu')>Suspendu - Le formateur est en pause</option>
            </select>
            <p class="form-hint">Ce statut sera appliqué au formateur, ses affectations, sessions, établissement et filière</p>
            @error('statut') <p class="form-error">{{ $message }}</p> @enderror
        </div>
    </div>

    <div class="form-card">
        <div class="form-card-header">
            <span class="form-card-icon material-symbols-rounded">link</span>
            <span class="form-card-title">Affectation</span>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="md:col-span-2">
                <label class="form-label">Établissement</label>
                <select name="etablissement_id" class="form-field">
                    <option value="">- Aucun -</option>
                    @foreach($etablissements ?? [] as $etablissement)
                        <option value="{{ $etablissement->id }}" @selected(old('etablissement_id', $formateur->etablissement_id ?? '') == $etablissement->id)>{{ $etablissement->nom }}</option>
                    @endforeach
                </select>
            </div>
            <div class="md:col-span-2">
                <label class="form-label">Filière</label>
                <select name="filiere_id" class="form-field">
                    <option value="">- Aucune -</option>
                    @foreach($filieres ?? [] as $filiere)
                        <option value="{{ $filiere->id }}" @selected(old('filiere_id', $formateur->filiere_id ?? '') == $filiere->id)>{{ $filiere->libelle }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="form-label">Grade <span class="required">*</span></label>
                <select name="grade" class="form-field" required>
                    <option value="">- Sélectionner -</option>
                    @foreach($grades as $g)
                        <option value="{{ $g }}" @selected(old('grade', $formateur->grade ?? '') === $g)>{{ $g }}</option>
                    @endforeach
                </select>
                @error('grade') <p class="form-error">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="form-label">Date de recrutement</label>
                <input type="date" name="date_recrutement" value="{{ old('date_recrutement', isset($formateur) && $formateur->date_recrutement ? $formateur->date_recrutement->format('Y-m-d') : '') }}" class="form-field">
            </div>
        </div>
    </div>

    <div class="form-card">
        <div class="form-card-header">
            <span class="form-card-icon material-symbols-rounded">contact_mail</span>
            <span class="form-card-title">Coordonnées</span>
        </div>
        <div class="grid grid-cols-1 gap-4">
            <div>
                <label class="form-label">Email <span class="required">*</span></label>
                <input type="email" name="email" value="{{ old('email', $formateur->email ?? '') }}" class="form-field" placeholder="Ex: jean.rakoto@example.com" required>
                @error('email') <p class="form-error">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="form-label">Téléphone</label>
                <input type="text" name="telephone" value="{{ old('telephone', $formateur->telephone ?? '') }}" class="form-field" placeholder="Ex: 034 12 345 67">
            </div>
            <div>
                <label class="form-label">Adresse</label>
                <input type="text" name="adresse" value="{{ old('adresse', $formateur->adresse ?? '') }}" class="form-field" placeholder="Ex: Lot II M 45 Bis, Antananarivo">
            </div>
        </div>
    </div>

</div>
BLADE,

            // =====================================================
            // 5. CREATE VIEW
            // =====================================================
            'resources/views/admin/formateurs/create.blade.php' => <<<'BLADE'
@extends('layouts.admin')
@section('title', 'Nouveau formateur')

@section('content')
<div class="mb-6">
    <a href="{{ route('admin.formateurs.index') }}" class="text-[12px] text-slate-500 hover:text-brand-700">Retour à la liste</a>
    <h1 class="font-display text-2xl font-bold text-slate-900 mt-2">Ajouter un formateur</h1>
</div>

<form method="POST" action="{{ route('admin.formateurs.store') }}" class="bg-white rounded-xl border border-slate-200 p-6 max-w-3xl mx-auto">
    @csrf
    @include('admin.formateurs.partials.form')

    <div class="flex items-center justify-end gap-2 mt-6 pt-6 border-t border-slate-200">
        <a href="{{ route('admin.formateurs.index') }}" class="btn-secondary">Annuler</a>
        <button type="submit" class="btn-primary">
            <span class="material-symbols-rounded text-[18px]">save</span>
            Enregistrer
        </button>
    </div>
</form>
@endsection
BLADE,

            // =====================================================
            // 6. EDIT VIEW
            // =====================================================
            'resources/views/admin/formateurs/edit.blade.php' => <<<'BLADE'
@extends('layouts.admin')
@section('title', 'Modifier formateur')

@section('content')
<div class="mb-6">
    <a href="{{ route('admin.formateurs.index') }}" class="text-[12px] text-slate-500 hover:text-brand-700">Retour à la liste</a>
    <h1 class="font-display text-2xl font-bold text-slate-900 mt-2">Modifier : {{ $formateur->nom }} {{ $formateur->prenom }}</h1>
</div>

<form method="POST" action="{{ route('admin.formateurs.update', $formateur->id) }}" class="bg-white rounded-xl border border-slate-200 p-6 max-w-3xl mx-auto">
    @csrf
    @method('PUT')
    @include('admin.formateurs.partials.form')

    <div class="flex items-center justify-end gap-2 mt-6 pt-6 border-t border-slate-200">
        <a href="{{ route('admin.formateurs.index') }}" class="btn-secondary">Annuler</a>
        <button type="submit" class="btn-primary">
            <span class="material-symbols-rounded text-[18px]">save</span>
            Mettre à jour
        </button>
    </div>
</form>
@endsection
BLADE,

            // =====================================================
            // 7. INDEX VIEW (MODAL Z-INDEX MAX + SCROLL Y)
            // =====================================================
            'resources/views/admin/formateurs/index.blade.php' => <<<'BLADE'
@extends('layouts.admin')
@section('title', 'Formateurs')

@section('content')

<div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-6">
    <div>
        <h1 class="font-display text-2xl font-bold text-slate-900">Formateurs</h1>
        <p class="text-sm text-slate-500 mt-1">Liste de tous les formateurs du réseau</p>
    </div>
    <button type="button" onclick="openFormateurModal()" class="btn-primary">
        <span class="material-symbols-rounded text-[18px]">add</span>
        Ajouter un formateur
    </button>
</div>

<div class="bg-white rounded-xl border border-slate-200 p-4 mb-4">
    <form method="GET" class="grid grid-cols-1 md:grid-cols-5 gap-3">
        <div class="relative md:col-span-2">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Rechercher un formateur..." class="form-input pl-10">
        </div>
        <select name="etablissement_id" class="form-input">
            <option value="">Tous les établissements</option>
            @foreach($etablissements ?? [] as $e)
                <option value="{{ $e->id }}" @selected(request('etablissement_id') == $e->id)>{{ $e->nom }}</option>
            @endforeach
        </select>
        <select name="statut" class="form-input">
            <option value="">Tous les statuts</option>
            <option value="actif" @selected(request('statut') === 'actif')>Actif</option>
            <option value="inactif" @selected(request('statut') === 'inactif')>Inactif</option>
            <option value="suspendu" @selected(request('statut') === 'suspendu')>Suspendu</option>
        </select>
        <div class="flex items-center gap-2">
            <button type="submit" class="btn-primary">Filtrer</button>
            <a href="{{ route('admin.formateurs.index') }}" class="btn-secondary">Reset</a>
        </div>
    </form>
</div>

<div class="bg-white rounded-xl border border-slate-200 overflow-hidden">
    <table class="table-modern">
        <thead>
            <tr>
                <th>Matricule</th>
                <th>Nom complet</th>
                <th>Établissement</th>
                <th>Filière</th>
                <th>Statut</th>
                <th class="text-right">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($formateurs ?? [] as $f)
            <tr>
                <td class="font-mono text-xs">{{ $f->matricule }}</td>
                <td class="font-semibold">
                    <a href="{{ route('admin.formateurs.show', $f->id) }}" class="hover:text-brand-700">{{ $f->nom }} {{ $f->prenom }}</a>
                </td>
                <td>{{ $f->etablissement->nom ?? '-' }}</td>
                <td class="text-xs">{{ $f->filiere->libelle ?? '-' }}</td>
                <td>
                    @if(($f->statut ?? 'actif') === 'actif')
                        <span class="badge-success">Actif</span>
                    @elseif(($f->statut ?? '') === 'suspendu')
                        <span class="badge-warning">Suspendu</span>
                    @else
                        <span class="badge-danger">Inactif</span>
                    @endif
                </td>
                <td>
                    <div class="flex items-center justify-end gap-1">
                        <a href="{{ route('admin.formateurs.show', $f->id) }}" class="w-8 h-8 rounded-lg flex items-center justify-center text-slate-500 hover:bg-brand-50">
                            <span class="material-symbols-rounded text-[18px]">visibility</span>
                        </a>
                        <a href="{{ route('admin.formateurs.edit', $f->id) }}" class="w-8 h-8 rounded-lg flex items-center justify-center text-slate-500 hover:bg-brand-50">
                            <span class="material-symbols-rounded text-[18px]">edit</span>
                        </a>
                        <form action="{{ route('admin.formateurs.destroy', $f->id) }}" method="POST" class="inline" onsubmit="return confirm('Supprimer ?')">
                            @csrf @method('DELETE')
                            <button class="w-8 h-8 rounded-lg flex items-center justify-center text-slate-500 hover:bg-red-50">
                                <span class="material-symbols-rounded text-[18px]">delete</span>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr><td colspan="6" class="text-center py-16 text-slate-400">Aucun formateur trouvé</td></tr>
            @endforelse
        </tbody>
    </table>
    <div class="px-4 py-3 border-t border-slate-200 flex justify-between items-center text-xs text-slate-500">
        <span>Total : {{ $formateurs->total() ?? 0 }} formateurs</span>
        <div>{{ $formateurs->links() }}</div>
    </div>
</div>

{{-- ========== MODAL AJOUTER (z-index MAX) ========== --}}
<div id="formateurModal"
     style="display: none; position: fixed !important; inset: 0 !important; z-index: 2147483647 !important; align-items: center; justify-content: center; padding: 1rem;"
     onclick="if(event.target === this) closeFormateurModal()">

    <div class="absolute inset-0 bg-black/60 backdrop-blur-sm" style="z-index: 1;"></div>

    <div class="relative bg-white rounded-2xl shadow-2xl w-full max-w-2xl flex flex-col"
         style="z-index: 2; max-height: calc(100vh - 2rem);">

        <div class="px-6 py-4 border-b border-slate-200 flex items-center justify-between shrink-0">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-brand-500 to-brand-700 flex items-center justify-center shadow-md">
                    <span class="material-symbols-rounded text-white text-xl" style="font-variation-settings: 'FILL' 1;">person_add</span>
                </div>
                <div>
                    <h2 class="font-display text-lg font-bold text-slate-900">Ajouter un formateur</h2>
                    <p class="text-xs text-slate-500 mt-0.5">Le statut sera propagé à toutes les tables liées</p>
                </div>
            </div>
            <button type="button" onclick="closeFormateurModal()"
                    class="w-9 h-9 rounded-lg flex items-center justify-center text-slate-400 hover:bg-slate-100 hover:text-slate-700 transition">
                <span class="material-symbols-rounded text-[20px]">close</span>
            </button>
        </div>

        <form id="formateurForm" method="POST" action="{{ route('admin.formateurs.store') }}"
              class="flex flex-col flex-1 min-h-0">
            @csrf

            <div id="formateurFormContent"
                 class="flex-1 min-h-0 overflow-y-auto overflow-x-hidden px-6 py-5">
                <div class="text-center py-16 text-slate-400">
                    <span class="material-symbols-rounded text-4xl animate-spin block mb-3">progress_activity</span>
                    <p class="text-sm">Chargement du formulaire...</p>
                </div>
            </div>

            <div class="px-6 py-4 border-t border-slate-200 flex items-center justify-end gap-2 bg-slate-50 rounded-b-2xl shrink-0">
                <button type="button" onclick="closeFormateurModal()" class="btn-secondary">Annuler</button>
                <button type="submit" class="btn-primary" id="submitBtn">
                    <span class="material-symbols-rounded text-[18px]">save</span>
                    Enregistrer
                </button>
            </div>
        </form>
    </div>
</div>

<style>
    /* ===== MODAL AU-DESSUS DE TOUT ===== */
    #formateurModal:not(.hidden) {
        display: flex !important;
    }

    #formateurModal > .absolute {
        z-index: 1 !important;
    }

    #formateurModal > .relative {
        z-index: 2 !important;
        position: relative;
    }

    #formateurForm {
        display: flex;
        flex-direction: column;
        flex: 1 1 auto;
        min-height: 0;
        overflow: hidden;
    }

    #formateurFormContent {
        flex: 1 1 auto;
        min-height: 0;
        overflow-y: auto;
        overflow-x: hidden;
        scroll-behavior: smooth;
    }

    #formateurFormContent::-webkit-scrollbar { width: 8px; }
    #formateurFormContent::-webkit-scrollbar-track { background: #f1f5f9; border-radius: 4px; }
    #formateurFormContent::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 4px; }
    #formateurFormContent::-webkit-scrollbar-thumb:hover { background: #94a3b8; }

    /* ===== BLOQUER TOUT LE RESTE ===== */
    body.modal-open {
        overflow: hidden !important;
    }

    body.modal-open > *:not(#formateurModal) {
        pointer-events: none !important;
        user-select: none !important;
    }

    body.modal-open #formateurModal,
    body.modal-open #formateurModal * {
        pointer-events: auto !important;
        user-select: auto !important;
    }
</style>

<script>
    let savedScrollPosition = 0;

    function openFormateurModal() {
        const modal = document.getElementById('formateurModal');
        if (!modal) return;

        savedScrollPosition = window.scrollY || document.documentElement.scrollTop;

        modal.style.display = 'flex';
        modal.classList.remove('hidden');

        document.body.classList.add('modal-open');
        document.body.style.position = 'fixed';
        document.body.style.top = `-${savedScrollPosition}px`;
        document.body.style.left = '0';
        document.body.style.right = '0';
        document.body.style.width = '100%';

        fetch('{{ route("admin.formateurs.create") }}', {
            headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' }
        })
        .then(r => r.json())
        .then(data => {
            document.getElementById('formateurFormContent').innerHTML = data.html;
        })
        .catch(err => {
            console.error(err);
            document.getElementById('formateurFormContent').innerHTML =
                '<div class="text-center py-12 text-red-500">Erreur : ' + err.message + '</div>';
        });
    }

    function closeFormateurModal() {
        const modal = document.getElementById('formateurModal');
        if (!modal) return;

        modal.classList.add('hidden');
        modal.style.display = 'none';

        document.body.classList.remove('modal-open');
        document.body.style.position = '';
        document.body.style.top = '';
        document.body.style.left = '';
        document.body.style.right = '';
        document.body.style.width = '';

        window.scrollTo(0, savedScrollPosition);
    }

    document.getElementById('formateurForm')?.addEventListener('submit', function(e) {
        e.preventDefault();
        const form = e.target;
        const submitBtn = document.getElementById('submitBtn');
        const originalText = submitBtn.innerHTML;

        submitBtn.disabled = true;
        submitBtn.innerHTML = '<span class="material-symbols-rounded text-[18px] animate-spin">progress_activity</span> Enregistrement...';

        const formData = new FormData(form);

        fetch(form.action, {
            method: 'POST',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
            },
            body: formData,
        })
        .then(r => r.json())
        .then(data => {
            if (data.success) {
                window.location.href = data.redirect;
            } else {
                alert(data.message || 'Erreur');
                submitBtn.disabled = false;
                submitBtn.innerHTML = originalText;
            }
        })
        .catch(err => {
            alert('Erreur lors de l\'enregistrement : ' + err.message);
            submitBtn.disabled = false;
            submitBtn.innerHTML = originalText;
        });
    });

    document.addEventListener('keydown', e => {
        if (e.key === 'Escape') {
            const modal = document.getElementById('formateurModal');
            if (modal && !modal.classList.contains('hidden')) {
                closeFormateurModal();
            }
        }
    });
</script>

@endsection
BLADE,

            // =====================================================
            // 8. SHOW VIEW
            // =====================================================
            'resources/views/admin/formateurs/show.blade.php' => <<<'BLADE'
@extends('layouts.admin')
@section('title', 'Fiche formateur')

@section('content')

<div class="mb-6">
    <a href="{{ route('admin.formateurs.index') }}" class="text-[12px] text-slate-500 hover:text-brand-700">Retour à la liste</a>
</div>

<div class="bg-white rounded-xl border border-slate-200 p-6 mb-6">
    <div class="flex items-center gap-6">
        <div class="w-24 h-24 rounded-2xl bg-gradient-to-br from-brand-400 to-brand-700 flex items-center justify-center shrink-0">
            <span class="text-white text-3xl font-bold">
                {{ strtoupper(substr($formateur->prenom ?? 'U', 0, 1) . substr($formateur->nom ?? 'N', 0, 1)) }}
            </span>
        </div>
        <div class="flex-1">
            <h1 class="font-display text-2xl font-bold text-slate-900">{{ $formateur->nom }} {{ $formateur->prenom }}</h1>
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

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
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

    <div class="bg-white rounded-xl border border-slate-200 p-5">
        <h2 class="font-bold text-slate-900 mb-4">Filière</h2>
        @if($formateur->filiere)
            <a href="{{ route('admin.filieres.show', $formateur->filiere->id) }}" class="block p-3 rounded-lg bg-slate-50 hover:bg-brand-50">
                {{ $formateur->filiere->libelle }}
            </a>
        @else
            <p class="text-slate-400 text-sm">Aucune filière</p>
        @endif
    </div>
</div>

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

@endsection
BLADE,
        ];
    }
}