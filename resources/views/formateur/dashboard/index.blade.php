@extends('layouts.formateur')
@section('title', 'Tableau de bord')

@section('content')

{{-- ============================================================
     1. HERO - Bandeau de bienvenue avec infos de base
     ============================================================ --}}
<div class="bg-white border border-slate-200
            rounded-3xl p-8 lg:p-10  mb-6 relative overflow-hidden
            shadow-sm">

    
    

    <div class="relative z-10 flex flex-col md:flex-row items-start md:items-center gap-6">

        {{-- Avatar --}}
        <div class="w-20 h-20 rounded-2xl bg-emerald-50
                    flex items-center justify-center
                    border-2 border-emerald-100 shrink-0">
            <span class="text-emerald-700 text-3xl font-bold">
                {{ strtoupper(substr($user->prenom ?? 'F', 0, 1) . substr($user->nom ?? 'M', 0, 1)) }}
            </span>
        </div>

        {{-- Infos --}}
        <div class="flex-1">
            <div class="flex items-center gap-2 text-[13px] text-slate-500 mb-2">
                <span class="material-symbols-rounded text-base">waving_hand</span>
                Bonjour
            </div>

            <h1 class="font-display text-3xl lg:text-4xl font-bold text-slate-900">
                {{ $formateurMetier->prenom ?? $user->prenom }}
                {{ $formateurMetier->nom ?? $user->nom }}
            </h1>

            <div class="flex flex-wrap items-center gap-3 mt-3">
                <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full
                            bg-emerald-50 border border-emerald-100">
                    <span class="material-symbols-rounded text-sm">badge</span>
                    <span class="text-sm font-mono text-emerald-700">
                        {{ $formateurMetier->matricule ?? $user->matricule }}
                    </span>
                </div>

                @if($formateurMetier && $formateurMetier->statut)
                    <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full
                                bg-emerald-50 border border-emerald-100">
                        <span class="w-1.5 h-1.5 rounded-full
                                     {{ $formateurMetier->statut === 'actif' ? 'bg-emerald-300' : 'bg-amber-300' }}">
                        </span>
                        <span class="text-sm font-semibold capitalize text-emerald-700">
                            {{ $formateurMetier->statut }}
                        </span>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

{{-- ============================================================
     2. STATISTIQUES - 3 cartes
     ============================================================ --}}
<div class="grid grid-cols-1 sm:grid-cols-3 gap-5 mb-6">

    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6
                border-l-4 border-green-500">
        <div class="flex items-center gap-3 mb-3">
            <span class="material-symbols-rounded text-green-600 text-2xl"
                  style="font-variation-settings: 'FILL' 1;">assignment_ind</span>
        </div>
        <div class="font-display text-3xl font-bold text-slate-900">
            {{ $stats['affectations'] }}
        </div>
        <div class="text-[13px] text-slate-500 mt-1">Affectations</div>
    </div>

    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6
                border-l-4 border-emerald-500">
        <div class="flex items-center gap-3 mb-3">
            <span class="material-symbols-rounded text-emerald-600 text-2xl"
                  style="font-variation-settings: 'FILL' 1;">event</span>
        </div>
        <div class="font-display text-3xl font-bold text-slate-900">
            {{ $stats['sessions'] }}
        </div>
        <div class="text-[13px] text-slate-500 mt-1">Sessions totales</div>
    </div>

    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6
                border-l-4 border-teal-500">
        <div class="flex items-center gap-3 mb-3">
            <span class="material-symbols-rounded text-teal-600 text-2xl"
                  style="font-variation-settings: 'FILL' 1;">check_circle</span>
        </div>
        <div class="font-display text-3xl font-bold text-slate-900">
            {{ $stats['sessions_actives'] }}
        </div>
        <div class="text-[13px] text-slate-500 mt-1">Sessions actives</div>
    </div>
</div>

{{-- ============================================================
     3. MON PROFIL + ÉTABLISSEMENT + FILIÈRE
     ============================================================ --}}
<div class="grid grid-cols-1 lg:grid-cols-3 gap-5 mb-6">

    {{-- Carte Profil --}}
    <div class="bg-white rounded-2xl border border-slate-200 p-6">
        <div class="flex items-center gap-3 mb-5 pb-4 border-b border-slate-100">
            <div class="w-10 h-10 rounded-xl bg-emerald-50 flex items-center justify-center">
                <span class="material-symbols-rounded text-emerald-600 text-[22px]"
                      style="font-variation-settings: 'FILL' 1;">person</span>
            </div>
            <div>
                <h2 class="font-display font-bold text-slate-900 text-[15px]">
                    Mon profil
                </h2>
                <p class="text-[11px] text-slate-500 mt-0.5">Informations personnelles</p>
            </div>
        </div>

        <div class="space-y-3.5">
            <div>
                <div class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1">
                    Nom complet
                </div>
                <div class="text-[14px] font-semibold text-slate-900">
                    {{ $formateurMetier->prenom ?? '-' }} {{ $formateurMetier->nom ?? '-' }}
                </div>
            </div>

            <div>
                <div class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1">
                    Email
                </div>
                <div class="text-[13px] text-slate-700 break-all">
                    {{ $formateurMetier->email ?? $user->email ?? '-' }}
                </div>
            </div>

            <div>
                <div class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1">
                    Téléphone
                </div>
                <div class="text-[13px] text-slate-700">
                    {{ $formateurMetier->telephone ?? '-' }}
                </div>
            </div>

            <div>
                <div class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1">
                    Grade
                </div>
                <div class="text-[13px] text-slate-700">
                    {{ $formateurMetier->grade ?? '-' }}
                </div>
            </div>
        </div>

        <a href="{{ route('formateur.profile.edit') }}"
           class="inline-flex items-center gap-1.5 mt-5 text-[12px] font-semibold
                  text-emerald-600 hover:text-emerald-700">
            Modifier mon profil
            <span class="material-symbols-rounded text-[14px]">arrow_forward</span>
        </a>
    </div>

    {{-- Carte Établissement --}}
    <div class="bg-white rounded-2xl border border-slate-200 p-6">
        <div class="flex items-center gap-3 mb-5 pb-4 border-b border-slate-100">
            <div class="w-10 h-10 rounded-xl bg-teal-50 flex items-center justify-center">
                <span class="material-symbols-rounded text-teal-600 text-[22px]"
                      style="font-variation-settings: 'FILL' 1;">apartment</span>
            </div>
            <div>
                <h2 class="font-display font-bold text-slate-900 text-[15px]">
                    Mon établissement
                </h2>
                <p class="text-[11px] text-slate-500 mt-0.5">Lieu d'affectation</p>
            </div>
        </div>

        @if($formateurMetier && $formateurMetier->etablissement)
            <div class="space-y-3.5">
                <div>
                    <div class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1">
                        Nom
                    </div>
                    <div class="text-[14px] font-semibold text-slate-900">
                        {{ $formateurMetier->etablissement->nom }}
                    </div>
                </div>

                <div>
                    <div class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1">
                        Code
                    </div>
                    <div class="text-[13px] text-slate-700 font-mono">
                        {{ $formateurMetier->etablissement->code ?? '-' }}
                    </div>
                </div>

                <div>
                    <div class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1">
                        Type
                    </div>
                    <div class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full
                                bg-teal-50 text-teal-700 text-[11px] font-semibold">
                        {{ $formateurMetier->etablissement->type ?? '-' }}
                    </div>
                </div>

                <div>
                    <div class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1">
                        Région
                    </div>
                    <div class="text-[13px] text-slate-700">
                        {{ $formateurMetier->etablissement->region ?? '-' }}
                    </div>
                </div>
            </div>
        @else
            <div class="text-center py-8">
                <span class="material-symbols-rounded text-4xl text-slate-300 block mb-2">
                    apartment
                </span>
                <p class="text-[13px] text-slate-500">
                    Aucun établissement assigné
                </p>
            </div>
        @endif
    </div>

    {{-- Carte Filière --}}
    <div class="bg-white rounded-2xl border border-slate-200 p-6">
        <div class="flex items-center gap-3 mb-5 pb-4 border-b border-slate-100">
            <div class="w-10 h-10 rounded-xl bg-green-50 flex items-center justify-center">
                <span class="material-symbols-rounded text-green-600 text-[22px]"
                      style="font-variation-settings: 'FILL' 1;">school</span>
            </div>
            <div>
                <h2 class="font-display font-bold text-slate-900 text-[15px]">
                    Ma filière
                </h2>
                <p class="text-[11px] text-slate-500 mt-0.5">Spécialité principale</p>
            </div>
        </div>

        @if($formateurMetier && $formateurMetier->filiere)
            <div class="space-y-3.5">
                <div>
                    <div class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1">
                        Libellé
                    </div>
                    <div class="text-[14px] font-semibold text-slate-900">
                        {{ $formateurMetier->filiere->libelle }}
                    </div>
                </div>

                <div>
                    <div class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1">
                        Code
                    </div>
                    <div class="text-[13px] text-slate-700 font-mono">
                        {{ $formateurMetier->filiere->code ?? '-' }}
                    </div>
                </div>

                @if($formateurMetier->filiere->niveau)
                    <div>
                        <div class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1">
                            Niveau
                        </div>
                        <div class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full
                                    bg-green-50 text-green-700 text-[11px] font-semibold">
                            {{ $formateurMetier->filiere->niveau->code ?? '-' }}
                        </div>
                    </div>
                @endif

                @if($formateurMetier->filiere->secteur)
                    <div>
                        <div class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1">
                            Secteur
                        </div>
                        <div class="text-[13px] text-slate-700">
                            {{ $formateurMetier->filiere->secteur->libelle ?? '-' }}
                        </div>
                    </div>
                @endif
            </div>
        @else
            <div class="text-center py-8">
                <span class="material-symbols-rounded text-4xl text-slate-300 block mb-2">
                    school
                </span>
                <p class="text-[13px] text-slate-500">
                    Aucune filière assignée
                </p>
            </div>
        @endif
    </div>
</div>

{{-- ============================================================
     4. MES DERNIÈRES SESSIONS
     ============================================================ --}}
<div class="bg-white rounded-2xl border border-slate-200 overflow-hidden mb-6">

    <div class="px-6 py-4 border-b border-slate-200 flex justify-between items-center">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-xl bg-emerald-50 flex items-center justify-center">
                <span class="material-symbols-rounded text-emerald-600 text-[22px]"
                      style="font-variation-settings: 'FILL' 1;">event</span>
            </div>
            <div>
                <h2 class="font-display font-bold text-slate-900 text-[15px]">
                    Mes dernières sessions
                </h2>
                <p class="text-[11px] text-slate-500 mt-0.5">3 plus récentes</p>
            </div>
        </div>

        <a href="{{ route('formateur.sessions.index') }}"
           class="text-[12px] font-semibold text-emerald-600 hover:text-emerald-700">
            Voir tout ->
        </a>
    </div>

    @if($dernieresSessions->count() > 0)
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-slate-50 border-b border-slate-200">
                    <tr>
                        <th class="text-left px-6 py-3 text-[11px] font-bold text-slate-500 uppercase tracking-wider">
                            Code
                        </th>
                        <th class="text-left px-6 py-3 text-[11px] font-bold text-slate-500 uppercase tracking-wider">
                            Filière
                        </th>
                        <th class="text-left px-6 py-3 text-[11px] font-bold text-slate-500 uppercase tracking-wider">
                            Établissement
                        </th>
                        <th class="text-left px-6 py-3 text-[11px] font-bold text-slate-500 uppercase tracking-wider">
                            Période
                        </th>
                        <th class="text-left px-6 py-3 text-[11px] font-bold text-slate-500 uppercase tracking-wider">
                            Statut
                        </th>
                        <th class="text-right px-6 py-3 text-[11px] font-bold text-slate-500 uppercase tracking-wider">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($dernieresSessions as $session)
                    <tr class="border-b border-slate-100 hover:bg-emerald-50/40 transition last:border-0">
                        <td class="px-6 py-4">
                            <span class="font-mono text-[12px] font-bold text-slate-900">
                                {{ $session->code }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-[13px] text-slate-700">
                            {{ $session->filiere->libelle ?? '-' }}
                        </td>
                        <td class="px-6 py-4 text-[13px] text-slate-700">
                            {{ $session->etablissement->nom ?? '-' }}
                        </td>
                        <td class="px-6 py-4 text-[12px] text-slate-600">
                            {{ $session->date_debut?->format('d/m/Y') ?? '-' }}
                            -> {{ $session->date_fin?->format('d/m/Y') ?? '-' }}
                        </td>
                        <td class="px-6 py-4">
                            @if($session->estEnCours())
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full
                                             text-[10px] font-bold bg-emerald-50 text-emerald-700">
                                    En cours
                                </span>
                            @elseif($session->estTerminee())
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full
                                             text-[10px] font-bold bg-slate-100 text-slate-600">
                                    Terminée
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full
                                             text-[10px] font-bold bg-green-50 text-green-700">
                                    À venir
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-right">
                            <a href="{{ route('formateur.sessions.show', $session->id) }}"
                               class="text-[12px] font-semibold text-emerald-600 hover:text-emerald-700">
                                Détails ->
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="p-12 text-center">
            <span class="material-symbols-rounded text-5xl text-slate-300 block mb-3">event</span>
            <p class="text-slate-500 font-semibold">Aucune session</p>
            <p class="text-sm text-slate-400 mt-1">
                Vos sessions apparaîtront ici
            </p>
        </div>
    @endif
</div>

{{-- ============================================================
     5. MES DERNIÈRES AFFECTATIONS
     ============================================================ --}}
<div class="bg-white rounded-2xl border border-slate-200 overflow-hidden">

    <div class="px-6 py-4 border-b border-slate-200 flex justify-between items-center">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-xl bg-green-50 flex items-center justify-center">
                <span class="material-symbols-rounded text-green-600 text-[22px]"
                      style="font-variation-settings: 'FILL' 1;">assignment_ind</span>
            </div>
            <div>
                <h2 class="font-display font-bold text-slate-900 text-[15px]">
                    Mes dernières affectations
                </h2>
                <p class="text-[11px] text-slate-500 mt-0.5">3 plus récentes</p>
            </div>
        </div>

        <a href="{{ route('formateur.demandes.index') }}"
           class="text-[12px] font-semibold text-emerald-600 hover:text-emerald-700">
            Voir tout ->
        </a>
    </div>

    @if($dernieresAffectations->count() > 0)
        <div class="divide-y divide-slate-100">
            @foreach($dernieresAffectations as $affectation)
            <div class="px-6 py-4 hover:bg-emerald-50/40 transition flex items-center gap-4">
                <div class="w-10 h-10 rounded-lg bg-green-50 flex items-center justify-center shrink-0">
                    <span class="material-symbols-rounded text-green-600 text-[20px]"
                          style="font-variation-settings: 'FILL' 1;">school</span>
                </div>
                <div class="flex-1 min-w-0">
                    <div class="font-semibold text-[14px] text-slate-900">
                        {{ $affectation->filiere->libelle ?? '-' }}
                    </div>
                    <div class="text-[12px] text-slate-500 mt-0.5">
                        {{ $affectation->etablissement->nom ?? '-' }}
                    </div>
                </div>
                <div class="text-right">
                    <div class="text-[11px] text-slate-500">
                        {{ $affectation->date_debut?->format('d/m/Y') ?? '-' }}
                    </div>
                    @if($affectation->statut === 'actif')
                        <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full
                                     text-[10px] font-bold bg-emerald-50 text-emerald-700 mt-1">
                            Actif
                        </span>
                    @elseif($affectation->statut === 'termine')
                        <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full
                                     text-[10px] font-bold bg-slate-100 text-slate-600 mt-1">
                            Terminé
                        </span>
                    @else
                        <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full
                                     text-[10px] font-bold bg-amber-50 text-amber-700 mt-1">
                            Suspendu
                        </span>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
    @else
        <div class="p-12 text-center">
            <span class="material-symbols-rounded text-5xl text-slate-300 block mb-3">assignment_ind</span>
            <p class="text-slate-500 font-semibold">Aucune affectation</p>
            <p class="text-sm text-slate-400 mt-1">
                Vos affectations apparaîtront ici
            </p>
        </div>
    @endif
</div>

@endsection