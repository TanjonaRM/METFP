<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class InstallAffectationsViews extends Command
{
    protected $signature = 'install:affectations-views';
    protected $description = 'Installe les vues du module Affectations (sobre + modal + vert principal)';

    public function handle(): int
    {
        $this->info("Installation des vues Affectations");
        $this->newLine();

        $files = $this->getFiles();
        $count = 0;

        foreach ($files as $path => $content) {
            $fullPath = base_path($path);
            $dir = dirname($fullPath);

            if (!File::exists($dir)) {
                File::makeDirectory($dir, 0755, true);
            }

            File::put($fullPath, $content);
            $size = strlen($content);
            $this->line("  OK  {$path} ({$size} car.)");
            $count++;
        }

        $this->newLine();
        $this->info("Nettoyage des caches...");
        $this->call('optimize:clear');

        $this->newLine();
        $this->info("SUCCES : {$count} fichier(s) installe(s) !");
        return self::SUCCESS;
    }

    protected function getFiles(): array
    {
        return [

            // =====================================================
            // 1. PARTIALS FORM
            // =====================================================
            'resources/views/admin/affectations/partials/form.blade.php' => <<<'BLADE'
<div class="space-y-5">

    {{-- ========== SECTION : AFFECTATION ========== --}}
    <div class="bg-white border-2 border-slate-300 rounded-lg p-5">
        <div class="flex items-center gap-2 pb-3 mb-4 border-b-2 border-slate-200">
            <span class="material-symbols-rounded text-brand-700 text-lg">link</span>
            <h3 class="text-sm font-bold text-brand-700 uppercase tracking-wide">Affectation</h3>
        </div>

        <div class="space-y-4">

            {{-- Formateur --}}
            <div>
                <label class="block text-sm font-semibold text-slate-900 mb-1.5">
                    Formateur <span class="text-red-600">*</span>
                </label>
                <select name="formateur_id"
                        class="w-full px-4 py-3 text-base text-slate-900 bg-white
                               border-2 border-slate-300 rounded-md
                               transition-all appearance-none cursor-pointer
                               hover:border-slate-400
                               focus:outline-none focus:border-brand-700 focus:ring-4 focus:ring-brand-100">
                    <option value="">- Sélectionner un formateur -</option>
                    @foreach($formateurs ?? [] as $f)
                        <option value="{{ $f->id }}" @selected(old('formateur_id', $affectation->formateur_id ?? '') == $f->id)>
                            {{ $f->nom }} {{ $f->prenom }} ({{ $f->matricule }})
                        </option>
                    @endforeach
                </select>
                @error('formateur_id')
                    <p class="text-sm text-red-600 mt-1.5">{{ $message }}</p>
                @enderror
            </div>

            {{-- Filière --}}
            <div>
                <label class="block text-sm font-semibold text-slate-900 mb-1.5">
                    Filière <span class="text-red-600">*</span>
                </label>
                <select name="filiere_id"
                        class="w-full px-4 py-3 text-base text-slate-900 bg-white
                               border-2 border-slate-300 rounded-md
                               transition-all appearance-none cursor-pointer
                               hover:border-slate-400
                               focus:outline-none focus:border-brand-700 focus:ring-4 focus:ring-brand-100">
                    <option value="">- Sélectionner une filière -</option>
                    @foreach($filieres ?? [] as $f)
                        <option value="{{ $f->id }}" @selected(old('filiere_id', $affectation->filiere_id ?? '') == $f->id)>
                            {{ $f->libelle }} ({{ $f->code }})
                        </option>
                    @endforeach
                </select>
                @error('filiere_id')
                    <p class="text-sm text-red-600 mt-1.5">{{ $message }}</p>
                @enderror
            </div>

            {{-- Établissement --}}
            <div>
                <label class="block text-sm font-semibold text-slate-900 mb-1.5">
                    Établissement <span class="text-red-600">*</span>
                </label>
                <select name="etablissement_id"
                        class="w-full px-4 py-3 text-base text-slate-900 bg-white
                               border-2 border-slate-300 rounded-md
                               transition-all appearance-none cursor-pointer
                               hover:border-slate-400
                               focus:outline-none focus:border-brand-700 focus:ring-4 focus:ring-brand-100">
                    <option value="">- Sélectionner un établissement -</option>
                    @foreach($etablissements ?? [] as $e)
                        <option value="{{ $e->id }}" @selected(old('etablissement_id', $affectation->etablissement_id ?? '') == $e->id)>
                            {{ $e->nom }} ({{ $e->code }})
                        </option>
                    @endforeach
                </select>
                @error('etablissement_id')
                    <p class="text-sm text-red-600 mt-1.5">{{ $message }}</p>
                @enderror
            </div>

        </div>
    </div>

    {{-- ========== SECTION : PÉRIODE ========== --}}
    <div class="bg-white border-2 border-slate-300 rounded-lg p-5">
        <div class="flex items-center gap-2 pb-3 mb-4 border-b-2 border-slate-200">
            <span class="material-symbols-rounded text-brand-700 text-lg">event</span>
            <h3 class="text-sm font-bold text-brand-700 uppercase tracking-wide">Période</h3>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

            <div>
                <label class="block text-sm font-semibold text-slate-900 mb-1.5">
                    Date de début <span class="text-red-600">*</span>
                </label>
                <input type="date" name="date_debut"
                       value="{{ old('date_debut', isset($affectation) && $affectation->date_debut ? $affectation->date_debut->format('Y-m-d') : '') }}"
                       class="w-full px-4 py-3 text-base text-slate-900 bg-white
                              border-2 border-slate-300 rounded-md
                              transition-all cursor-pointer
                              hover:border-slate-400
                              focus:outline-none focus:border-brand-700 focus:ring-4 focus:ring-brand-100"
                       required>
                @error('date_debut')
                    <p class="text-sm text-red-600 mt-1.5">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-900 mb-1.5">Date de fin</label>
                <input type="date" name="date_fin"
                       value="{{ old('date_fin', isset($affectation) && $affectation->date_fin ? $affectation->date_fin->format('Y-m-d') : '') }}"
                       class="w-full px-4 py-3 text-base text-slate-900 bg-white
                              border-2 border-slate-300 rounded-md
                              transition-all cursor-pointer
                              hover:border-slate-400
                              focus:outline-none focus:border-brand-700 focus:ring-4 focus:ring-brand-100">
                @error('date_fin')
                    <p class="text-sm text-red-600 mt-1.5">{{ $message }}</p>
                @enderror
                <p class="text-xs text-slate-500 mt-1.5">Laisser vide si en cours</p>
            </div>

        </div>
    </div>

    {{-- ========== SECTION : STATUT ========== --}}
    <div class="bg-white border-2 border-slate-300 rounded-lg p-5">
        <div class="flex items-center gap-2 pb-3 mb-4 border-b-2 border-slate-200">
            <span class="material-symbols-rounded text-brand-700 text-lg">toggle_on</span>
            <h3 class="text-sm font-bold text-brand-700 uppercase tracking-wide">Statut</h3>
        </div>

        @php $currentStatut = old('statut', $affectation->statut ?? 'actif'); @endphp

        <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">

            <label class="cursor-pointer">
                <input type="radio" name="statut" value="actif" class="peer sr-only"
                       @checked($currentStatut === 'actif')>
                <div class="flex flex-col items-center gap-1.5 px-3 py-4
                            border-2 border-slate-300 rounded-md
                            transition-all
                            hover:border-slate-400 hover:bg-slate-50
                            peer-checked:border-brand-700 peer-checked:bg-brand-50
                            peer-checked:shadow-md">
                    <span class="material-symbols-rounded text-brand-700 text-3xl">check_circle</span>
                    <span class="text-sm font-bold text-slate-900">Actif</span>
                </div>
            </label>

            <label class="cursor-pointer">
                <input type="radio" name="statut" value="suspendu" class="peer sr-only"
                       @checked($currentStatut === 'suspendu')>
                <div class="flex flex-col items-center gap-1.5 px-3 py-4
                            border-2 border-slate-300 rounded-md
                            transition-all
                            hover:border-slate-400 hover:bg-slate-50
                            peer-checked:border-amber-600 peer-checked:bg-amber-50
                            peer-checked:shadow-md">
                    <span class="material-symbols-rounded text-amber-600 text-3xl">pause_circle</span>
                    <span class="text-sm font-bold text-slate-900">Suspendu</span>
                </div>
            </label>

            <label class="cursor-pointer">
                <input type="radio" name="statut" value="termine" class="peer sr-only"
                       @checked($currentStatut === 'termine')>
                <div class="flex flex-col items-center gap-1.5 px-3 py-4
                            border-2 border-slate-300 rounded-md
                            transition-all
                            hover:border-slate-400 hover:bg-slate-50
                            peer-checked:border-slate-700 peer-checked:bg-slate-100
                            peer-checked:shadow-md">
                    <span class="material-symbols-rounded text-slate-700 text-3xl">cancel</span>
                    <span class="text-sm font-bold text-slate-900">Terminé</span>
                </div>
            </label>

        </div>

        @error('statut')
            <p class="text-sm text-red-600 mt-3">{{ $message }}</p>
        @enderror
    </div>

</div>
BLADE,

            // =====================================================
            // 2. INDEX VIEW (avec 3 MODALS : Create / Edit / Show)
            // =====================================================
            'resources/views/admin/affectations/index.blade.php' => <<<'BLADE'
@extends('layouts.admin')
@section('title', 'Affectations')

@section('content')

<div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-6">
    <div>
        <h1 class="font-display text-2xl font-bold text-slate-900">Affectations</h1>
        <p class="text-sm text-slate-500 mt-1">Liste des affectations des formateurs</p>
    </div>
    <div class="flex items-center gap-2">
        <a href="{{ route('admin.pdf.affectations') }}" target="_blank" class="btn-secondary">
            <span class="material-symbols-rounded text-lg">picture_as_pdf</span>
            PDF
        </a>
        <button type="button" onclick="openCreateModal()" class="btn-primary">
            <span class="material-symbols-rounded text-lg">add</span>
            Nouvelle affectation
        </button>
    </div>
</div>

{{-- Filtres --}}
<div class="bg-white rounded-lg border-2 border-slate-300 p-4 mb-4">
    <form method="GET" class="grid grid-cols-1 md:grid-cols-5 gap-3">
        <div class="md:col-span-2">
            <input type="text" name="search" value="{{ request('search') }}"
                   placeholder="Rechercher un formateur..."
                   class="w-full px-4 py-2.5 text-sm border-2 border-slate-300 rounded-md
                          focus:outline-none focus:border-brand-700 focus:ring-2 focus:ring-brand-100">
        </div>
        <select name="etablissement_id" class="px-3 py-2.5 text-sm border-2 border-slate-300 rounded-md focus:outline-none focus:border-brand-700">
            <option value="">Tous les établissements</option>
            @foreach($etablissements ?? [] as $e)
                <option value="{{ $e->id }}" @selected(request('etablissement_id') == $e->id)>{{ $e->nom }}</option>
            @endforeach
        </select>
        <select name="filiere_id" class="px-3 py-2.5 text-sm border-2 border-slate-300 rounded-md focus:outline-none focus:border-brand-700">
            <option value="">Toutes les filières</option>
            @foreach($filieres ?? [] as $f)
                <option value="{{ $f->id }}" @selected(request('filiere_id') == $f->id)>{{ $f->libelle }}</option>
            @endforeach
        </select>
        <select name="statut" class="px-3 py-2.5 text-sm border-2 border-slate-300 rounded-md focus:outline-none focus:border-brand-700">
            <option value="">Tous les statuts</option>
            <option value="actif" @selected(request('statut') === 'actif')>Actif</option>
            <option value="termine" @selected(request('statut') === 'termine')>Terminé</option>
            <option value="suspendu" @selected(request('statut') === 'suspendu')>Suspendu</option>
        </select>
        <div class="md:col-span-5 flex items-center gap-2">
            <button type="submit" class="btn-primary">Filtrer</button>
            <a href="{{ route('admin.affectations.index') }}" class="btn-secondary">Reset</a>
        </div>
    </form>
</div>

{{-- Tableau --}}
<div class="bg-white rounded-lg border-2 border-slate-300 overflow-hidden">
    <table class="table-modern">
        <thead>
            <tr>
                <th>Formateur</th>
                <th>Filière</th>
                <th>Établissement</th>
                <th>Période</th>
                <th>Statut</th>
                <th class="text-right">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($affectations ?? [] as $a)
            <tr>
                <td>
                    <a href="{{ route('admin.formateurs.show', $a->formateur->id ?? 0) }}" class="flex items-center gap-2 group">
                        <div class="avatar avatar-sm avatar-primary">
                            {{ strtoupper(substr($a->formateur->prenom ?? 'U', 0, 1) . substr($a->formateur->nom ?? 'N', 0, 1)) }}
                        </div>
                        <div>
                            <div class="font-semibold text-sm group-hover:text-brand-700">{{ $a->formateur->nom ?? '-' }} {{ $a->formateur->prenom ?? '' }}</div>
                            <div class="text-[10px] text-slate-500 font-mono">{{ $a->formateur->matricule ?? '' }}</div>
                        </div>
                    </a>
                </td>
                <td class="font-semibold">{{ $a->filiere->libelle ?? '-' }}</td>
                <td>{{ $a->etablissement->nom ?? '-' }}</td>
                <td class="text-xs">{{ $a->date_debut?->format('d/m/Y') }} -> {{ $a->date_fin?->format('d/m/Y') ?? 'En cours' }}</td>
                <td>
                    @if($a->statut === 'actif')
                        <span class="badge-success">Actif</span>
                    @elseif($a->statut === 'termine')
                        <span class="badge-gray">Terminé</span>
                    @else
                        <span class="badge-warning">Suspendu</span>
                    @endif
                </td>
                <td>
                    <div class="flex items-center justify-end gap-1">
                        <button type="button" onclick="openShowModal({{ $a->id }})" class="w-8 h-8 rounded-md flex items-center justify-center text-slate-500 hover:bg-brand-50 hover:text-brand-700">
                            <span class="material-symbols-rounded text-lg">visibility</span>
                        </button>
                        <button type="button" onclick="openEditModal({{ $a->id }})" class="w-8 h-8 rounded-md flex items-center justify-center text-slate-500 hover:bg-brand-50 hover:text-brand-700">
                            <span class="material-symbols-rounded text-lg">edit</span>
                        </button>
                        <form action="{{ route('admin.affectations.destroy', $a->id) }}" method="POST" class="inline" onsubmit="return confirm('Supprimer ?')">
                            @csrf @method('DELETE')
                            <button class="w-8 h-8 rounded-md flex items-center justify-center text-slate-500 hover:bg-red-50 hover:text-red-600">
                                <span class="material-symbols-rounded text-lg">delete</span>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr><td colspan="6" class="text-center py-16 text-slate-400">Aucune affectation trouvée</td></tr>
            @endforelse
        </tbody>
    </table>
    <div class="px-4 py-3 border-t border-slate-200 flex justify-between items-center text-xs text-slate-500">
        <span>Total : {{ $affectations->total() ?? 0 }} affectations</span>
        <div>{{ $affectations->links() }}</div>
    </div>
</div>

{{-- ========== MODAL CREATE ========== --}}
<div id="createModal" class="fixed inset-0 z-[9999] items-center justify-center p-4" style="display:none;"
     onclick="if(event.target === this) closeCreateModal()">
    <div class="absolute inset-0 bg-black/50"></div>
    <div class="relative bg-white rounded-xl shadow-2xl w-full max-w-2xl max-h-[90vh] flex flex-col">
        <div class="px-6 py-4 border-b border-slate-200 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-lg bg-brand-700 flex items-center justify-center">
                    <span class="material-symbols-rounded text-white text-xl">add_task</span>
                </div>
                <div>
                    <h2 class="font-display text-lg font-bold text-slate-900">Nouvelle affectation</h2>
                    <p class="text-xs text-slate-500">Créer une affectation pour un formateur</p>
                </div>
            </div>
            <button type="button" onclick="closeCreateModal()" class="w-9 h-9 rounded-md flex items-center justify-center text-slate-500 hover:bg-slate-100">
                <span class="material-symbols-rounded">close</span>
            </button>
        </div>
        <form id="createForm" method="POST" action="{{ route('admin.affectations.store') }}" class="flex flex-col flex-1 min-h-0">
            @csrf
            <div id="createFormContent" class="flex-1 overflow-y-auto px-6 py-5">
                <div class="text-center py-12 text-slate-400">Chargement...</div>
            </div>
            <div class="px-6 py-4 border-t border-slate-200 flex justify-end gap-2 bg-slate-50 rounded-b-xl">
                <button type="button" onclick="closeCreateModal()" class="btn-secondary">Annuler</button>
                <button type="submit" class="btn-primary">
                    <span class="material-symbols-rounded text-lg">save</span>
                    Enregistrer
                </button>
            </div>
        </form>
    </div>
</div>

{{-- ========== MODAL EDIT ========== --}}
<div id="editModal" class="fixed inset-0 z-[9999] items-center justify-center p-4" style="display:none;"
     onclick="if(event.target === this) closeEditModal()">
    <div class="absolute inset-0 bg-black/50"></div>
    <div class="relative bg-white rounded-xl shadow-2xl w-full max-w-2xl max-h-[90vh] flex flex-col">
        <div class="px-6 py-4 border-b border-slate-200 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-lg bg-brand-700 flex items-center justify-center">
                    <span class="material-symbols-rounded text-white text-xl">edit</span>
                </div>
                <div>
                    <h2 class="font-display text-lg font-bold text-slate-900">Modifier l'affectation</h2>
                    <p class="text-xs text-slate-500">Mettre à jour les informations</p>
                </div>
            </div>
            <button type="button" onclick="closeEditModal()" class="w-9 h-9 rounded-md flex items-center justify-center text-slate-500 hover:bg-slate-100">
                <span class="material-symbols-rounded">close</span>
            </button>
        </div>
        <form id="editForm" method="POST" class="flex flex-col flex-1 min-h-0">
            @csrf
            @method('PUT')
            <div id="editFormContent" class="flex-1 overflow-y-auto px-6 py-5">
                <div class="text-center py-12 text-slate-400">Chargement...</div>
            </div>
            <div class="px-6 py-4 border-t border-slate-200 flex justify-end gap-2 bg-slate-50 rounded-b-xl">
                <button type="button" onclick="closeEditModal()" class="btn-secondary">Annuler</button>
                <button type="submit" class="btn-primary">
                    <span class="material-symbols-rounded text-lg">save</span>
                    Mettre à jour
                </button>
            </div>
        </form>
    </div>
</div>

{{-- ========== MODAL SHOW ========== --}}
<div id="showModal" class="fixed inset-0 z-[9999] items-center justify-center p-4" style="display:none;"
     onclick="if(event.target === this) closeShowModal()">
    <div class="absolute inset-0 bg-black/50"></div>
    <div class="relative bg-white rounded-xl shadow-2xl w-full max-w-2xl max-h-[90vh] flex flex-col">
        <div class="px-6 py-4 border-b border-slate-200 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-lg bg-brand-700 flex items-center justify-center">
                    <span class="material-symbols-rounded text-white text-xl">visibility</span>
                </div>
                <div>
                    <h2 class="font-display text-lg font-bold text-slate-900">Détail de l'affectation</h2>
                    <p class="text-xs text-slate-500">Informations complètes</p>
                </div>
            </div>
            <button type="button" onclick="closeShowModal()" class="w-9 h-9 rounded-md flex items-center justify-center text-slate-500 hover:bg-slate-100">
                <span class="material-symbols-rounded">close</span>
            </button>
        </div>
        <div id="showContent" class="flex-1 overflow-y-auto px-6 py-5">
            <div class="text-center py-12 text-slate-400">Chargement...</div>
        </div>
    </div>
</div>

<style>
    #createModal:not([style*="display:none"]),
    #editModal:not([style*="display:none"]),
    #showModal:not([style*="display:none"]) {
        display: flex !important;
    }

    body.modal-open {
        overflow: hidden !important;
    }
</style>

<script>
    console.log('[OK] Script affectations chargé');

    // ============ CREATE ============
    function openCreateModal() {
        console.log('[BLUE] Ouverture modal CREATE');
        const modal = document.getElementById('createModal');
        modal.style.display = 'flex';
        document.body.classList.add('modal-open');

        fetch('{{ route("admin.affectations.create") }}', {
            headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' }
        })
        .then(r => r.json())
        .then(data => {
            document.getElementById('createFormContent').innerHTML = data.html;
            console.log('[BOX] Formulaire CREATE chargé');
        })
        .catch(err => {
            console.error('[X]', err);
            document.getElementById('createFormContent').innerHTML =
                '<div class="text-center py-12 text-red-500">Erreur : ' + err.message + '</div>';
        });
    }

    function closeCreateModal() {
        document.getElementById('createModal').style.display = 'none';
        document.body.classList.remove('modal-open');
    }

    // ============ EDIT ============
    function openEditModal(id) {
        console.log('[BLUE] Ouverture modal EDIT', id);
        const modal = document.getElementById('editModal');
        modal.style.display = 'flex';
        document.body.classList.add('modal-open');

        const form = document.getElementById('editForm');
        form.action = `/admin/affectations/${id}`;

        fetch(`/admin/affectations/${id}/edit`, {
            headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' }
        })
        .then(r => r.json())
        .then(data => {
            document.getElementById('editFormContent').innerHTML = data.html;
            console.log('[BOX] Formulaire EDIT chargé');
        })
        .catch(err => {
            console.error('[X]', err);
            document.getElementById('editFormContent').innerHTML =
                '<div class="text-center py-12 text-red-500">Erreur : ' + err.message + '</div>';
        });
    }

    function closeEditModal() {
        document.getElementById('editModal').style.display = 'none';
        document.body.classList.remove('modal-open');
    }

    // ============ SHOW ============
    function openShowModal(id) {
        console.log('[BLUE] Ouverture modal SHOW', id);
        const modal = document.getElementById('showModal');
        modal.style.display = 'flex';
        document.body.classList.add('modal-open');

        fetch(`/admin/affectations/${id}`, {
            headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' }
        })
        .then(r => {
            if (r.headers.get('content-type')?.includes('application/json')) {
                return r.json().then(data => ({ html: data.html }));
            }
            return r.text().then(html => ({ html }));
        })
        .then(data => {
            document.getElementById('showContent').innerHTML = data.html;
        })
        .catch(err => {
            console.error('[X]', err);
            document.getElementById('showContent').innerHTML =
                '<div class="text-center py-12 text-red-500">Erreur : ' + err.message + '</div>';
        });
    }

    function closeShowModal() {
        document.getElementById('showModal').style.display = 'none';
        document.body.classList.remove('modal-open');
    }

    // ============ SUBMIT AJAX (délégation) ============
    document.addEventListener('submit', function(e) {
        const form = e.target;
        if (form.id !== 'createForm' && form.id !== 'editForm') return;

        e.preventDefault();
        console.log('[EXPORT] Soumission AJAX', form.id);

        const submitBtn = form.querySelector('button[type="submit"]');
        const originalText = submitBtn.innerHTML;
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<span class="material-symbols-rounded text-lg animate-spin">progress_activity</span> Enregistrement...';

        fetch(form.action, {
            method: 'POST',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
            },
            body: new FormData(form),
        })
        .then(r => r.json())
        .then(data => {
            if (data.success) {
                console.log('[OK] Succès');
                window.location.href = data.redirect || window.location.href;
            } else {
                alert(data.message || 'Erreur');
                submitBtn.disabled = false;
                submitBtn.innerHTML = originalText;
            }
        })
        .catch(err => {
            console.error('[X]', err);
            alert('Erreur : ' + err.message);
            submitBtn.disabled = false;
            submitBtn.innerHTML = originalText;
        });
    });

    // ============ ECHAP ============
    document.addEventListener('keydown', e => {
        if (e.key === 'Escape') {
            closeCreateModal();
            closeEditModal();
            closeShowModal();
        }
    });
</script>

@endsection
BLADE,
        ];
    }
}