@extends('layouts.formateur')
@section('title', 'Mes affectations')

@section('content')
<div class="mb-8">
    <h1 class="font-display text-3xl font-bold text-slate-900">Mes affectations</h1>
    <p class="text-sm text-slate-500 mt-1">Total : {{ $affectations->count() }} affectation(s)</p>
</div>

@if(!$formateurMetier)
    <div class="flex items-start gap-3 px-5 py-4 rounded-2xl bg-green-50 border border-green-200 text-green-800 text-sm">
        <span class="material-symbols-rounded">warning</span>
        <div>Votre profil formateur n'est pas encore configuré. Contactez l'administration.</div>
    </div>
@else

@php
    $actives = $affectations->where('statut', 'actif')->count();
    $terminees = $affectations->where('statut', 'termine')->count();
    $suspendues = $affectations->where('statut', 'suspendu')->count();
@endphp

<div class="grid grid-cols-1 sm:grid-cols-4 gap-4 mb-6">
    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-5 border-l-4 border-green-500">
        <div class="font-display text-3xl font-bold text-green-600">{{ $affectations->count() }}</div>
        <div class="text-xs text-slate-500 uppercase tracking-wider mt-1">Total</div>
    </div>
    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-5 border-l-4 border-emerald-500">
        <div class="font-display text-3xl font-bold text-emerald-600">{{ $actives }}</div>
        <div class="text-xs text-slate-500 uppercase tracking-wider mt-1">Actives</div>
    </div>
    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-5 border-l-4 border-slate-500">
        <div class="font-display text-3xl font-bold text-slate-600">{{ $terminees }}</div>
        <div class="text-xs text-slate-500 uppercase tracking-wider mt-1">Terminées</div>
    </div>
    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-5 border-l-4 border-green-500">
        <div class="font-display text-3xl font-bold text-green-600">{{ $suspendues }}</div>
        <div class="text-xs text-slate-500 uppercase tracking-wider mt-1">Suspendues</div>
    </div>
</div>

@if($affectations->count() === 0)
    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-16 text-center">
        <span class="material-symbols-rounded text-6xl text-slate-300 block mb-3">inbox</span>
        <p class="text-slate-500 font-semibold">Aucune affectation pour le moment.</p>
    </div>
@else
    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
        <table class="w-full">
            <thead class="bg-slate-50 border-b border-slate-200">
                <tr>
                    <th class="text-left px-6 py-3.5 text-[11px] font-bold text-slate-500 uppercase">Filière</th>
                    <th class="text-left px-6 py-3.5 text-[11px] font-bold text-slate-500 uppercase">Niveau</th>
                    <th class="text-left px-6 py-3.5 text-[11px] font-bold text-slate-500 uppercase">Secteur</th>
                    <th class="text-left px-6 py-3.5 text-[11px] font-bold text-slate-500 uppercase">Établissement</th>
                    <th class="text-left px-6 py-3.5 text-[11px] font-bold text-slate-500 uppercase">Période</th>
                    <th class="text-left px-6 py-3.5 text-[11px] font-bold text-slate-500 uppercase">Statut</th>
                    <th class="text-right px-6 py-3.5 text-[11px] font-bold text-slate-500 uppercase">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($affectations as $a)
                <tr class="border-b border-slate-100 hover:bg-emerald-50/40 transition last:border-0">
                    <td class="px-6 py-4">
                        <div class="font-semibold text-slate-900 text-sm">{{ $a->filiere?->libelle ?? '-' }}</div>
                        <div class="text-xs text-slate-500 font-mono">{{ $a->filiere?->code ?? '' }}</div>
                    </td>
                    <td class="px-6 py-4 text-sm text-slate-700">{{ $a->filiere?->niveau?->code ?? '-' }}</td>
                    <td class="px-6 py-4 text-sm text-slate-700">{{ $a->filiere?->secteur?->libelle ?? '-' }}</td>
                    <td class="px-6 py-4 text-sm text-slate-700">{{ $a->etablissement?->nom ?? '-' }}</td>
                    <td class="px-6 py-4 text-xs text-slate-700">
                        Du {{ $a->date_debut?->format('d/m/Y') ?? '-' }}<br>
                        Au {{ $a->date_fin?->format('d/m/Y') ?? 'En cours' }}
                    </td>
                    <td class="px-6 py-4">
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[11px] font-semibold
                            @if($a->statut === 'actif') bg-emerald-50 text-emerald-700
                            @elseif($a->statut === 'termine') bg-slate-100 text-slate-600
                            @else bg-green-50 text-green-700 @endif">
                            {{ ucfirst($a->statut) }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-right">
                        <a href="{{ route('formateur.affectations.show', $a->id) }}" class="text-emerald-700 hover:text-emerald-500 font-semibold text-sm">
                            Détails ->
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endif
@endif
@endsection