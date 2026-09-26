@extends('layouts.admin')
@section('title', 'Affectations')

@section('content')

<style>
    /* =========================================================
       TABS
    ========================================================= */
    .tab-btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 12px 20px;
        border-radius: 12px;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s ease;
        border: none;
        background: transparent;
    }
    .tab-btn-active {
        background: #059669 !important;
        color: #ffffff !important;
    }
    .tab-btn-active .material-symbols-rounded,
    .tab-btn-active span {
        color: #ffffff !important;
    }
    .tab-btn-inactive {
        color: #64748b;
    }
    .tab-btn-inactive:hover {
        background: #f1f5f9;
    }

    /* =========================================================
       CARTES STATS - Style des cartes d'accueil
    ========================================================= */
    .stat-card-hover {
        position: relative;
        background: white;
        border: 1px solid #e4e4e7;
        border-radius: 16px;
        padding: 20px;
        display: flex;
        align-items: flex-start;
        gap: 16px;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        overflow: hidden;
        cursor: pointer;
        min-height: 130px;
    }

    .stat-card-hover:hover {
        border-color: #a7f3d0;
        box-shadow: 0 12px 30px -10px rgba(5, 150, 105, 0.2);
        transform: translateY(-2px);
    }

    .stat-card-hover::before {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(180deg,
                    transparent 0%,
                    transparent 60%,
                    rgba(5, 150, 105, 0.04) 100%);
        opacity: 0;
        transition: opacity 0.3s ease;
        pointer-events: none;
    }
    .stat-card-hover:hover::before {
        opacity: 1;
    }

    .stat-card-content {
        display: flex;
        align-items: flex-start;
        gap: 16px;
        flex: 1;
        transition: transform 0.3s ease;
    }

    .stat-icon-hover {
        transition: transform 0.3s ease, background 0.3s ease;
    }
    .stat-card-hover:hover .stat-icon-hover {
        transform: scale(1.08);
    }

    .stat-value {
        font-family: 'Space Grotesk', sans-serif;
        font-size: 1.75rem;
        font-weight: 700;
        color: #18181b;
        line-height: 1;
    }

    .stat-label {
        font-size: 0.75rem;
        color: #71717a;
        margin-top: 4px;
    }

    .stat-detail {
        font-size: 0.6875rem;
        color: #71717a;
        margin-top: 8px;
        display: flex;
        align-items: center;
        gap: 4px;
    }

    /* Barre de progression */
    .progress-bar {
        width: 100%;
        height: 4px;
        background: #f1f5f9;
        border-radius: 2px;
        margin-top: 10px;
        overflow: hidden;
    }
    .progress-fill {
        height: 100%;
        border-radius: 2px;
        transition: width 0.5s ease;
    }
</style>

{{-- Header --}}
<div class="mb-6 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
    <div>
        <h1 class="font-display text-2xl font-bold text-slate-900">Affectations</h1>
        <p class="text-sm text-slate-500 mt-1">Gérez les affectations et les demandes</p>
    </div>
    <div class="flex items-center gap-2">
        <a href="{{ route('admin.pdf.affectations') }}" target="_blank"
           class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl
                  bg-slate-100 text-slate-700 text-sm font-semibold hover:bg-slate-200 transition">
            <span class="material-symbols-rounded text-[18px]">picture_as_pdf</span>
            PDF
        </a>
        <button type="button" onclick="openAffectationModal()"
                style="background-color: #059669 !important; color: #ffffff !important;"
                class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl
                       text-sm font-semibold shadow-md hover:shadow-lg transition">
            <span class="material-symbols-rounded text-[18px]" style="color: #ffffff !important;">add</span>
            <span style="color: #ffffff !important;">Nouvelle affectation</span>
        </button>
    </div>
</div>

@if(session('success'))
    <div class="mb-4 flex items-start gap-3 px-4 py-3 rounded-xl
                bg-emerald-50 border border-emerald-200 text-emerald-800 text-sm">
        <span class="material-symbols-rounded">check_circle</span>
        <div>{{ session('success') }}</div>
    </div>
@endif

{{-- ONGLETS --}}
<div class="mb-6 flex items-center gap-2 p-1.5 bg-white rounded-xl border border-slate-200 w-fit">
    <button type="button" id="tab-affectations" onclick="switchTab('affectations')"
            class="tab-btn tab-btn-active">
        <span class="material-symbols-rounded text-[20px]"
              style="font-variation-settings: 'FILL' 1;">assignment_ind</span>
        Affectations
        <span class="ml-1 px-2 py-0.5 rounded-full text-[11px] bg-white/20 font-bold"
              id="count-affectations">0</span>
    </button>
    <button type="button" id="tab-demandes" onclick="switchTab('demandes')"
            class="tab-btn tab-btn-inactive">
        <span class="material-symbols-rounded text-[20px]"
              style="font-variation-settings: 'FILL' 1;">pending_actions</span>
        Demandes
        <span class="ml-1 px-2 py-0.5 rounded-full text-[11px] bg-amber-100 text-amber-700 font-bold"
              id="count-demandes">0</span>
    </button>
</div>

{{-- ============================================================
     ONGLET 1 : AFFECTATIONS
     ============================================================ --}}
<div id="content-affectations">
    <div class="bg-white rounded-xl border border-slate-200 p-4 mb-4">
        <form method="GET" class="grid grid-cols-1 md:grid-cols-5 gap-3">
            <div class="md:col-span-2">
                <input type="text" name="search" value="{{ request('search') }}"
                       placeholder="Rechercher un formateur..."
                       class="w-full px-4 py-2.5 text-sm border-2 border-slate-200 rounded-lg
                              focus:outline-none focus:border-emerald-500">
            </div>
            <select name="etablissement_id" class="px-3 py-2.5 text-sm border-2 border-slate-200 rounded-lg">
                <option value="">Tous les établissements</option>
                @foreach($etablissements ?? [] as $e)
                    <option value="{{ $e->id }}" @selected(request('etablissement_id') == $e->id)>{{ $e->nom }}</option>
                @endforeach
            </select>
            <select name="filiere_id" class="px-3 py-2.5 text-sm border-2 border-slate-200 rounded-lg">
                <option value="">Toutes les filières</option>
                @foreach($filieres ?? [] as $f)
                    <option value="{{ $f->id }}" @selected(request('filiere_id') == $f->id)>{{ $f->libelle }}</option>
                @endforeach
            </select>
            <select name="statut" class="px-3 py-2.5 text-sm border-2 border-slate-200 rounded-lg">
                <option value="">Tous les statuts</option>
                <option value="actif" @selected(request('statut') === 'actif')>Actif</option>
                <option value="termine" @selected(request('statut') === 'termine')>Terminé</option>
                <option value="suspendu" @selected(request('statut') === 'suspendu')>Suspendu</option>
            </select>
            <div class="md:col-span-5 flex items-center gap-2">
                <button type="submit" class="px-4 py-2.5 rounded-lg bg-emerald-600 text-white text-sm font-semibold">Filtrer</button>
                <a href="{{ route('admin.affectations.index') }}" class="px-4 py-2.5 rounded-lg bg-slate-100 text-slate-700 text-sm font-semibold">Reset</a>
            </div>
        </form>
    </div>

    <div class="bg-white rounded-xl border border-slate-200 overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-slate-50 border-b border-slate-200">
                <tr>
                    <th class="text-left px-5 py-3 text-[11px] font-bold text-slate-500 uppercase">Formateur</th>
                    <th class="text-left px-5 py-3 text-[11px] font-bold text-slate-500 uppercase">Filière</th>
                    <th class="text-left px-5 py-3 text-[11px] font-bold text-slate-500 uppercase">Établissement</th>
                    <th class="text-left px-5 py-3 text-[11px] font-bold text-slate-500 uppercase">Période</th>
                    <th class="text-left px-5 py-3 text-[11px] font-bold text-slate-500 uppercase">Statut</th>
                    <th class="text-right px-5 py-3 text-[11px] font-bold text-slate-500 uppercase">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($affectations ?? [] as $a)
                    <tr class="border-b border-slate-100 hover:bg-slate-50">
                        <td class="px-5 py-4">
                            <div class="flex items-center gap-2">
                                <div class="w-8 h-8 rounded-full bg-gradient-to-br from-emerald-400 to-emerald-700
                                            flex items-center justify-center text-white font-bold text-[10px]">
                                    {{ strtoupper(substr($a->formateur->prenom ?? 'U', 0, 1) . substr($a->formateur->nom ?? 'N', 0, 1)) }}
                                </div>
                                <div>
                                    <div class="font-semibold text-slate-900 text-[13px]">
                                        {{ $a->formateur->nom ?? '-' }} {{ $a->formateur->prenom ?? '' }}
                                    </div>
                                    <div class="text-[10px] text-slate-500 font-mono">{{ $a->formateur->matricule ?? '' }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-5 py-4 text-slate-700">{{ $a->filiere->libelle ?? '-' }}</td>
                        <td class="px-5 py-4 text-slate-700">{{ $a->etablissement->nom ?? '-' }}</td>
                        <td class="px-5 py-4 text-xs text-slate-600">
                            {{ $a->date_debut?->format('d/m/Y') }} -> {{ $a->date_fin?->format('d/m/Y') ?? 'En cours' }}
                        </td>
                        <td class="px-5 py-4">
                            @if($a->statut === 'actif')
                                <span class="px-2.5 py-1 rounded-full text-[10px] font-bold bg-emerald-50 text-emerald-700">Actif</span>
                            @elseif($a->statut === 'termine')
                                <span class="px-2.5 py-1 rounded-full text-[10px] font-bold bg-slate-100 text-slate-600">Terminé</span>
                            @else
                                <span class="px-2.5 py-1 rounded-full text-[10px] font-bold bg-amber-50 text-amber-700">Suspendu</span>
                            @endif
                        </td>
                        <td class="px-5 py-4 text-right">
                            <form action="{{ route('admin.affectations.destroy', $a->id) }}" method="POST"
                                  class="inline" onsubmit="return confirm('Supprimer ?')">
                                @csrf @method('DELETE')
                                <button class="w-8 h-8 rounded-lg flex items-center justify-center
                                               text-slate-500 hover:bg-red-50 hover:text-red-600">
                                    <span class="material-symbols-rounded text-[18px]">delete</span>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="6" class="text-center py-16 text-slate-400">Aucune affectation</td></tr>
                @endforelse
            </tbody>
        </table>
        @if(isset($affectations) && $affectations->hasPages())
            <div class="px-5 py-3 border-t">{{ $affectations->links() }}</div>
        @endif
    </div>
</div>

{{-- ============================================================
     ONGLET 2 : DEMANDES (avec cartes design accueil)
     ============================================================ --}}
<div id="content-demandes" style="display: none;">

    {{-- 4 CARTES STATS - Style des cartes d'accueil --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">

        {{-- Carte 1 : Total --}}
        <div class="stat-card-hover">
            <div class="stat-card-content">
                <div class="stat-icon-hover w-12 h-12 rounded-lg flex items-center justify-center shrink-0 bg-emerald-50">
                    <span class="material-symbols-rounded text-emerald-600 text-[24px]"
                          style="font-variation-settings: 'FILL' 1;">assignment</span>
                </div>
                <div class="flex-1">
                    <div class="stat-value">{{ $statsDemandes['total'] ?? 0 }}</div>
                    <div class="stat-label">Total demandes</div>
                    <div class="stat-detail">
                        <span class="material-symbols-rounded text-[14px]">trending_up</span>
                        Toutes catégories
                    </div>
                </div>
            </div>
        </div>

        {{-- Carte 2 : En attente --}}
        <div class="stat-card-hover">
            <div class="stat-card-content">
                <div class="stat-icon-hover w-12 h-12 rounded-lg flex items-center justify-center shrink-0 bg-amber-50">
                    <span class="material-symbols-rounded text-amber-600 text-[24px]"
                          style="font-variation-settings: 'FILL' 1;">pending_actions</span>
                </div>
                <div class="flex-1">
                    <div class="stat-value text-amber-600">{{ $statsDemandes['en_attente'] ?? 0 }}</div>
                    <div class="stat-label">En attente</div>
                    <div class="stat-detail">
                        <span class="material-symbols-rounded text-[14px]">schedule</span>
                        À traiter
                    </div>
                    {{-- Barre de progression --}}
                    @php
                        $total = max($statsDemandes['total'] ?? 1, 1);
                        $pct = round(($statsDemandes['en_attente'] ?? 0) / $total * 100);
                    @endphp
                    <div class="progress-bar">
                        <div class="progress-fill bg-amber-500" style="width: {{ $pct }}%;"></div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Carte 3 : Approuvées --}}
        <div class="stat-card-hover">
            <div class="stat-card-content">
                <div class="stat-icon-hover w-12 h-12 rounded-lg flex items-center justify-center shrink-0 bg-emerald-50">
                    <span class="material-symbols-rounded text-emerald-600 text-[24px]"
                          style="font-variation-settings: 'FILL' 1;">check_circle</span>
                </div>
                <div class="flex-1">
                    <div class="stat-value text-emerald-600">{{ $statsDemandes['approuvees'] ?? 0 }}</div>
                    <div class="stat-label">Approuvées</div>
                    <div class="stat-detail">
                        <span class="material-symbols-rounded text-[14px]">trending_up</span>
                        Validées
                    </div>
                    @php
                        $pct = round(($statsDemandes['approuvees'] ?? 0) / $total * 100);
                    @endphp
                    <div class="progress-bar">
                        <div class="progress-fill bg-emerald-500" style="width: {{ $pct }}%;"></div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Carte 4 : Refusées --}}
        <div class="stat-card-hover">
            <div class="stat-card-content">
                <div class="stat-icon-hover w-12 h-12 rounded-lg flex items-center justify-center shrink-0 bg-red-50">
                    <span class="material-symbols-rounded text-red-600 text-[24px]"
                          style="font-variation-settings: 'FILL' 1;">cancel</span>
                </div>
                <div class="flex-1">
                    <div class="stat-value text-red-600">{{ $statsDemandes['refusees'] ?? 0 }}</div>
                    <div class="stat-label">Refusées</div>
                    <div class="stat-detail">
                        <span class="material-symbols-rounded text-[14px]">trending_down</span>
                        Rejetées
                    </div>
                    @php
                        $pct = round(($statsDemandes['refusees'] ?? 0) / $total * 100);
                    @endphp
                    <div class="progress-bar">
                        <div class="progress-fill bg-red-500" style="width: {{ $pct }}%;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Tableau des demandes --}}
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
                @forelse($demandes ?? [] as $demande)
                    <tr class="border-b border-slate-100 hover:bg-slate-50">
                        <td class="px-5 py-4">
                            <div class="font-semibold text-slate-900 text-[13px]">
                                {{ $demande->formateur->prenom ?? '' }} {{ $demande->formateur->nom ?? '' }}
                            </div>
                            <div class="text-[10px] text-slate-500 font-mono">{{ $demande->formateur->matricule ?? '' }}</div>
                        </td>
                        <td class="px-5 py-4 text-slate-700">{{ $demande->filiere->libelle ?? '-' }}</td>
                        <td class="px-5 py-4 text-xs text-slate-600 max-w-xs" title="{{ $demande->motif }}">
                            {{ Str::limit($demande->motif, 50) }}
                        </td>
                        <td class="px-5 py-4 text-xs text-slate-500">
                            {{ $demande->created_at?->format('d/m/Y H:i') }}
                        </td>
                        <td class="px-5 py-4">
                            @if($demande->statut === 'en_attente')
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full
                                             text-[10px] font-bold bg-amber-50 text-amber-700">
                                    <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>En attente
                                </span>
                            @elseif($demande->statut === 'approuvee')
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full
                                             text-[10px] font-bold bg-emerald-50 text-emerald-700">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>Approuvée
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full
                                             text-[10px] font-bold bg-red-50 text-red-700">
                                    <span class="w-1.5 h-1.5 rounded-full bg-red-500"></span>Refusée
                                </span>
                            @endif
                        </td>
                        <td class="px-5 py-4 text-right">
                            @if($demande->statut === 'en_attente')
                                <button type="button"
                                        onclick="openApprovalModal(
                                            {{ $demande->id }},
                                            '{{ addslashes($demande->formateur->prenom ?? '') }} {{ addslashes($demande->formateur->nom ?? '') }}',
                                            '{{ addslashes($demande->formateur->matricule ?? '') }}'
                                        )"
                                        style="background-color: #059669 !important; color: #ffffff !important;"
                                        class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl
                                               text-[12px] font-bold shadow-sm hover:shadow-md transition">
                                    <span class="material-symbols-rounded text-[16px]" style="color: #ffffff !important;">task_alt</span>
                                    <span style="color: #ffffff !important;">Traiter</span>
                                </button>
                            @else
                                <span class="text-xs text-slate-400">
                                    Traitée le {{ $demande->traitee_le?->format('d/m/Y') }}
                                </span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="6" class="text-center py-16 text-slate-400">Aucune demande</td></tr>
                @endforelse
            </tbody>
        </table>
        @if(isset($demandes) && $demandes->hasPages())
            <div class="px-5 py-3 border-t">{{ $demandes->links() }}</div>
        @endif
    </div>
</div>

{{-- MODAL APPROBATION --}}
<div id="approvalModal" class="fixed inset-0 z-[9999] items-center justify-center p-4" style="display:none;"
     onclick="if(event.target === this) closeApprovalModal()">
    <div class="absolute inset-0 bg-black/50 backdrop-blur-sm"></div>
    <div class="relative bg-white rounded-2xl shadow-2xl w-full max-w-lg flex flex-col overflow-hidden" style="max-height: 90vh;">
        <div class="px-6 py-4 border-b border-slate-200 flex items-center justify-between shrink-0">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl flex items-center justify-center" style="background-color: #059669;">
                    <span class="material-symbols-rounded text-white text-xl" style="color: #ffffff !important; font-variation-settings: 'FILL' 1;">task_alt</span>
                </div>
                <div>
                    <h2 class="font-display text-lg font-bold text-slate-900">Traiter la demande</h2>
                    <p class="text-xs text-slate-500">Demande d'affectation</p>
                </div>
            </div>
            <button type="button" onclick="closeApprovalModal()" class="w-9 h-9 rounded-lg flex items-center justify-center text-slate-400 hover:bg-slate-100">
                <span class="material-symbols-rounded text-[20px]">close</span>
            </button>
        </div>

        <form id="approvalForm" method="POST" data-base-url="{{ url('/admin/demandes-affectations') }}" class="flex flex-col flex-1 min-h-0">
            @csrf
            <div class="flex-1 overflow-y-auto px-6 py-5 space-y-5">
                <div class="bg-slate-50 rounded-xl p-4">
                    <div class="text-[10px] font-bold text-slate-500 uppercase tracking-widest mb-1">Formateur</div>
                    <div class="font-semibold text-slate-900" id="modalFormateur">-</div>
                    <div class="text-xs text-slate-500 font-mono mt-0.5" id="modalMatricule">-</div>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-3">Votre décision <span class="text-red-500">*</span></label>
                    <div class="grid grid-cols-2 gap-3">
                        <label class="cursor-pointer">
                            <input type="radio" name="decision" value="approuver" class="peer sr-only" checked>
                            <div class="flex flex-col items-center gap-2 px-4 py-5 border-2 border-slate-200 rounded-xl
                                        transition-all hover:border-emerald-300 hover:bg-emerald-50/30
                                        peer-checked:border-emerald-500 peer-checked:bg-emerald-50 peer-checked:shadow-md">
                                <span class="material-symbols-rounded text-emerald-600 text-3xl" style="font-variation-settings: 'FILL' 1;">check_circle</span>
                                <span class="text-sm font-bold text-slate-900">Accepter</span>
                                <span class="text-[11px] text-slate-500">Approuver</span>
                            </div>
                        </label>
                        <label class="cursor-pointer">
                            <input type="radio" name="decision" value="refuser" class="peer sr-only">
                            <div class="flex flex-col items-center gap-2 px-4 py-5 border-2 border-slate-200 rounded-xl
                                        transition-all hover:border-red-300 hover:bg-red-50/30
                                        peer-checked:border-red-500 peer-checked:bg-red-50 peer-checked:shadow-md">
                                <span class="material-symbols-rounded text-red-600 text-3xl" style="font-variation-settings: 'FILL' 1;">cancel</span>
                                <span class="text-sm font-bold text-slate-900">Refuser</span>
                                <span class="text-[11px] text-slate-500">Rejeter</span>
                            </div>
                        </label>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">
                        Message au formateur <span class="text-slate-400 font-normal">(optionnel)</span>
                    </label>
                    <textarea name="reponse_admin" id="reponse_admin" rows="4" placeholder="Expliquez votre décision..."
                              class="w-full px-4 py-3 text-sm border-2 border-slate-200 rounded-xl
                                     focus:outline-none focus:border-emerald-500 resize-none"></textarea>
                </div>
            </div>

            <div class="px-6 py-4 border-t border-slate-200 flex justify-end gap-2 bg-slate-50 rounded-b-2xl shrink-0">
                <button type="button" onclick="closeApprovalModal()"
                        class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl
                               bg-slate-100 text-slate-700 text-sm font-semibold hover:bg-slate-200">
                    Annuler
                </button>
                <button type="submit" style="background-color: #059669 !important; color: #ffffff !important;"
                        class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl text-sm font-semibold shadow-md">
                    <span class="material-symbols-rounded text-[18px]" style="color: #ffffff !important;">send</span>
                    <span style="color: #ffffff !important;">Valider la décision</span>
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function switchTab(tab) {
        ['affectations', 'demandes'].forEach(t => {
            document.getElementById('content-' + t).style.display = (t === tab) ? 'block' : 'none';
            const btn = document.getElementById('tab-' + t);
            if (t === tab) {
                btn.classList.add('tab-btn-active');
                btn.classList.remove('tab-btn-inactive');
            } else {
                btn.classList.remove('tab-btn-active');
                btn.classList.add('tab-btn-inactive');
            }
        });
        localStorage.setItem('affectationsTab', tab);
    }

    document.addEventListener('DOMContentLoaded', () => {
        const urlParams = new URLSearchParams(window.location.search);
        const tabFromUrl = urlParams.get('tab');
        const savedTab = tabFromUrl || localStorage.getItem('affectationsTab') || 'affectations';
        switchTab(savedTab);
        if (tabFromUrl) window.history.replaceState({}, '', window.location.pathname);
        document.getElementById('count-affectations').textContent = {{ $affectations->total() ?? 0 }};
        document.getElementById('count-demandes').textContent = {{ $statsDemandes['en_attente'] ?? 0 }};
    });

    let currentDemandeId = null;
    function openApprovalModal(id, formateur, matricule) {
        currentDemandeId = id;
        document.getElementById('modalFormateur').textContent = formateur;
        document.getElementById('modalMatricule').textContent = matricule;
        document.querySelector('#approvalForm input[value="approuver"]').checked = true;
        document.getElementById('reponse_admin').value = '';
        document.getElementById('approvalModal').style.display = 'flex';
        document.body.style.overflow = 'hidden';
    }
    function closeApprovalModal() {
        document.getElementById('approvalModal').style.display = 'none';
        document.body.style.overflow = '';
        currentDemandeId = null;
    }
    document.getElementById('approvalForm')?.addEventListener('submit', function(e) {
        e.preventDefault();
        if (!currentDemandeId) return;
        const decision = this.querySelector('input[name="decision"]:checked').value;
        this.action = this.getAttribute('data-base-url') + '/' + currentDemandeId + '/' + decision;
        this.submit();
    });
    document.addEventListener('keydown', e => { if (e.key === 'Escape') closeApprovalModal(); });
</script>

@endsection