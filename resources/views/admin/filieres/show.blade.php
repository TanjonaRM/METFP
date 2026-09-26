@extends('layouts.admin')
@section('title', 'Détail filière')

@section('content')

<div class="mb-6">
    <a href="{{ route('admin.filieres.index') }}"
       class="inline-flex items-center gap-1 text-[12px] text-slate-500 hover:text-brand-700 mb-2">
        <span class="material-symbols-rounded text-[16px]">arrow_back</span>
        Retour à la liste
    </a>
    <div class="flex items-center justify-between">
        <div>
            <h1 class="font-display text-2xl font-bold text-slate-900">{{ $filiere->libelle }}</h1>
            <p class="text-sm text-slate-500 mt-1">
                Code : <span class="font-mono">{{ $filiere->code }}</span>
            </p>
        </div>
        <a href="{{ route('admin.filieres.edit', $filiere->id) }}" class="btn-primary">
            <span class="material-symbols-rounded text-[18px]">edit</span>
            Modifier
        </a>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
    <div class="bg-white rounded-xl border border-slate-200 p-5">
        <div class="text-[12px] text-slate-500 mb-1">Formateurs</div>
        <div class="font-display text-3xl font-bold text-brand-700">
            {{ $filiere->formateurs->count() }}
        </div>
    </div>
    <div class="bg-white rounded-xl border border-slate-200 p-5">
        <div class="text-[12px] text-slate-500 mb-1">Options</div>
        <div class="font-display text-3xl font-bold text-brand-700">
            {{ $filiere->options->count() }}
        </div>
    </div>
    <div class="bg-white rounded-xl border border-slate-200 p-5">
        <div class="text-[12px] text-slate-500 mb-1">Code</div>
        <div class="font-mono text-xl font-bold text-brand-700">
            {{ $filiere->code }}
        </div>
    </div>
</div>

@if($filiere->description)
<div class="bg-white rounded-xl border border-slate-200 p-5 mb-6">
    <div class="text-[12px] font-semibold text-slate-500 uppercase mb-2">Description</div>
    <p class="text-sm text-slate-700">{{ $filiere->description }}</p>
</div>
@endif

{{-- Options --}}
@if($filiere->options->count())
<div class="bg-white rounded-xl border border-slate-200 overflow-hidden mb-6">
    <div class="px-5 py-4 border-b border-slate-100">
        <h2 class="font-display font-bold text-slate-900">Options</h2>
    </div>
    <ul class="divide-y divide-slate-100">
        @foreach($filiere->options as $option)
            <li class="px-5 py-3 text-sm text-slate-700">{{ $option->libelle }}</li>
        @endforeach
    </ul>
</div>
@endif

{{-- Formateurs --}}
<div class="bg-white rounded-xl border border-slate-200 overflow-hidden">
    <div class="px-5 py-4 border-b border-slate-100 flex items-center justify-between">
        <h2 class="font-display font-bold text-slate-900">
            Formateurs de cette filière ({{ $filiere->formateurs->count() }})
        </h2>
    </div>
    <table class="table-modern">
        <thead>
            <tr>
                <th>Matricule</th>
                <th>Nom complet</th>
                <th>Établissement</th>
                <th>Statut</th>
                <th class="text-right">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($filiere->formateurs as $f)
            <tr>
                <td class="font-mono text-xs">{{ $f->matricule }}</td>
                <td class="font-semibold">
                    <a href="{{ route('admin.formateurs.show', $f->id) }}"
                       class="hover:text-brand-700 transition">
                        {{ $f->nom }} {{ $f->prenom }}
                    </a>
                </td>
                <td>{{ $f->etablissement->nom ?? '-' }}</td>
                <td>
                    @if($f->statut === 'actif')
                        <span class="badge-success">Actif</span>
                    @else
                        <span class="badge-danger">{{ $f->statut }}</span>
                    @endif
                </td>
                <td>
                    <div class="flex items-center justify-end gap-1">
                        <a href="{{ route('admin.formateurs.show', $f->id) }}"
                           class="w-8 h-8 rounded-lg flex items-center justify-center
                                  text-slate-500 hover:bg-brand-50 hover:text-brand-700 transition">
                            <span class="material-symbols-rounded text-[18px]">visibility</span>
                        </a>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="text-center py-12 text-slate-400 text-sm">
                    Aucun formateur affecté à cette filière
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection