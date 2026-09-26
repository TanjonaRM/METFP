@extends('layouts.admin')
@section('title', $etablissement->nom)

@section('content')

<div class="mb-6">
    <a href="{{ route('admin.etablissements.index') }}"
       class="inline-flex items-center gap-1 text-[12px] text-slate-500 hover:text-emerald-700 mb-2 transition">
        <span class="material-symbols-rounded text-[16px]">arrow_back</span>
        Retour à la liste
    </a>

    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
        <div>
            <h1 class="font-display text-2xl font-bold text-slate-900">
                {{ $etablissement->nom }}
            </h1>
            <p class="text-sm text-slate-500 mt-1">
                Code : <span class="font-mono">{{ $etablissement->code }}</span>
                · Type : <span class="badge-info">{{ $etablissement->type }}</span>
            </p>
        </div>
        <div class="flex items-center gap-2">
            <a href="{{ route('admin.pdf.formateurs.par-etablissement', ['etablissement_id' => $etablissement->id]) }}"
               target="_blank" class="btn-outline-primary">
                <span class="material-symbols-rounded text-[18px]">picture_as_pdf</span>
                Export PDF
            </a>
            <a href="{{ route('admin.etablissements.edit', $etablissement->id) }}" class="btn-primary">
                <span class="material-symbols-rounded text-[18px]">edit</span>
                Modifier
            </a>
        </div>
    </div>
</div>

{{-- ========== CARTES STATS ========== --}}
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
    <div class="stat-card">
        <div class="stat-icon bg-brand-50">
            <span class="material-symbols-rounded text-brand-700 text-2xl"
                  style="font-variation-settings: 'FILL' 1;">groups</span>
        </div>
        <div class="flex-1">
            <div class="stat-value">{{ $etablissement->formateurs->count() }}</div>
            <div class="stat-label">Formateurs</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon bg-emerald-50">
            <span class="material-symbols-rounded text-emerald-600 text-2xl"
                  style="font-variation-settings: 'FILL' 1;">event</span>
        </div>
        <div class="flex-1">
            <div class="stat-value">{{ $etablissement->sessions->count() }}</div>
            <div class="stat-label">Sessions</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon bg-teal-50">
            <span class="material-symbols-rounded text-teal-600 text-2xl"
                  style="font-variation-settings: 'FILL' 1;">map</span>
        </div>
        <div class="flex-1">
            <div class="stat-value text-xl">{{ $etablissement->region ?? '-' }}</div>
            <div class="stat-label">Région</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon bg-amber-50">
            <span class="material-symbols-rounded text-amber-600 text-2xl"
                  style="font-variation-settings: 'FILL' 1;">contact_phone</span>
        </div>
        <div class="flex-1">
            <div class="stat-value text-sm leading-tight">
                {{ $etablissement->contact ?? '-' }}
            </div>
            <div class="stat-label">Contact Responsable</div>
        </div>
    </div>
</div>

{{-- ========== INFOS DÉTAILLÉES ========== --}}
<div class="bg-white rounded-xl border border-slate-200 p-5 mb-6">
    <h2 class="font-display font-bold text-slate-900 mb-4">Informations</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
        <div>
            <span class="text-slate-500">Adresse :</span>
            <span class="text-slate-800 font-medium">{{ $etablissement->adresse ?? '-' }}</span>
        </div>
        <div>
            <span class="text-slate-500">Email :</span>
            <span class="text-slate-800 font-medium">{{ $etablissement->email ?? '-' }}</span>
        </div>
    </div>
</div>

{{-- ========== FORMATEURS ========== --}}
<div id="formateurs" class="bg-white rounded-xl border border-slate-200 overflow-hidden mb-6">
    <div class="px-5 py-4 border-b border-slate-100 flex items-center justify-between">
        <h2 class="font-display font-bold text-slate-900">
            Formateurs de cet établissement ({{ $etablissement->formateurs->count() }})
        </h2>
        <a href="{{ route('admin.formateurs.create') }}?etablissement_id={{ $etablissement->id }}"
           class="text-[12px] font-semibold text-brand-700 hover:text-brand-800">
            + Ajouter un formateur
        </a>
    </div>
    <table class="table-modern">
        <thead>
            <tr>
                <th>Photo</th>
                <th>Matricule</th>
                <th>Nom complet</th>
                <th>Filière</th>
                <th>Grade</th>
                <th>Statut</th>
                <th class="text-right">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($etablissement->formateurs as $f)
            <tr>
                <td>
                    <div class="avatar avatar-md avatar-primary">
                        {{ strtoupper(substr($f->prenom ?? 'U', 0, 1) . substr($f->nom ?? 'N', 0, 1)) }}
                    </div>
                </td>
                <td class="font-mono text-xs">{{ $f->matricule }}</td>
                <td class="font-semibold">
                    <a href="{{ route('admin.formateurs.show', $f->id) }}"
                       class="hover:text-brand-700 transition">
                        {{ $f->nom }} {{ $f->prenom }}
                    </a>
                </td>
                <td class="text-xs">
                    {{-- [AJAX] CORRECTION : `filiere` (singulier) au lieu de `filieres` (pluriel) --}}
                    @if($f->filiere)
                        <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full
                                     bg-emerald-50 text-emerald-700 text-[10px] font-semibold">
                            {{ $f->filiere->libelle ?? '-' }}
                        </span>
                    @else
                        <span class="text-slate-400">-</span>
                    @endif
                </td>
                <td class="text-xs">{{ $f->grade ?? '-' }}</td>
                <td>
                    @if($f->statut === 'actif')
                        <span class="badge-success">Actif</span>
                    @elseif($f->statut === 'en_attente')
                        <span class="badge-warning">En attente</span>
                    @else
                        <span class="badge-danger">Inactif</span>
                    @endif
                </td>
                <td>
                    <div class="flex items-center justify-end gap-1">
                        <a href="{{ route('admin.formateurs.show', $f->id) }}"
                           class="w-8 h-8 rounded-lg flex items-center justify-center
                                  text-slate-500 hover:bg-brand-50 hover:text-brand-700 transition">
                            <span class="material-symbols-rounded text-[18px]">visibility</span>
                        </a>
                        <a href="{{ route('admin.formateurs.edit', $f->id) }}"
                           class="w-8 h-8 rounded-lg flex items-center justify-center
                                  text-slate-500 hover:bg-brand-50 hover:text-brand-700 transition">
                            <span class="material-symbols-rounded text-[18px]">edit</span>
                        </a>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" class="text-center py-12 text-slate-400 text-sm">
                    Aucun formateur dans cet établissement
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

{{-- ========== SESSIONS RÉCENTES ========== --}}
<div class="bg-white rounded-xl border border-slate-200 overflow-hidden">
    <div class="px-5 py-4 border-b border-slate-100">
        <h2 class="font-display font-bold text-slate-900">Sessions récentes</h2>
    </div>
    <table class="table-modern">
        <thead>
            <tr>
                <th>Code</th>
                <th>Formateur</th>
                <th>Filière</th>
                <th>Période</th>
                <th>Statut</th>
            </tr>
        </thead>
        <tbody>
            @forelse($etablissement->sessions->take(10) as $s)
            <tr>
                <td class="font-mono text-xs">{{ $s->code }}</td>
                <td class="text-sm">
                    {{ $s->formateur->nom ?? '-' }} {{ $s->formateur->prenom ?? '' }}
                </td>
                <td class="text-sm">{{ $s->filiere->libelle ?? '-' }}</td>
                <td class="text-xs">
                    {{ $s->date_debut?->format('d/m/Y') }} -> {{ $s->date_fin?->format('d/m/Y') }}
                </td>
                <td>
                    @if($s->statut === 'actif')
                        <span class="badge-success">Active</span>
                    @elseif($s->statut === 'inactif')
                        <span class="badge-gray">Terminée</span>
                    @elseif($s->statut === 'suspendu')
                        <span class="badge-warning">Suspendue</span>
                    @else
                        <span class="badge-gray">{{ $s->statut }}</span>
                    @endif
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="text-center py-8 text-slate-400 text-sm">
                    Aucune session
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection