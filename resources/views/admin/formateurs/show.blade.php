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