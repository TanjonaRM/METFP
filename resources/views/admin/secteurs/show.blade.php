@extends('layouts.admin')

@section('title', 'Détails du Secteur')

@section('content')
<div class="p-6 lg:p-8 max-w-4xl mx-auto animate-slide-up">

    <div class="flex items-center gap-3 mb-6">
        <a href="{{ route('admin.secteurs.index') }}" class="btn-ghost text-sm">
            <span class="material-symbols-outlined">arrow_back</span>
            Retour
        </a>
        <h1 class="text-2xl font-extrabold text-gray-800">
            <span class="text-gradient-primary">Détails du Secteur</span>
        </h1>
    </div>

    <div class="bg-white rounded-2xl shadow-soft p-6 border border-gray-100">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <p class="text-sm text-gray-500">Libellé</p>
                <p class="font-semibold text-gray-800">{{ $secteur->libelle ?? '-' }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-500">Code</p>
                <p class="font-semibold text-gray-800 font-mono">{{ $secteur->code ?? '-' }}</p>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-2xl shadow-soft p-6 border border-gray-100 mt-6">
        <h3 class="font-semibold text-gray-700 mb-4">Filières rattachées ({{ $secteur->filieres->count() ?? 0 }})</h3>
        @forelse($secteur->filieres ?? [] as $f)
            <div class="flex items-center justify-between py-2 border-b border-gray-100 last:border-0">
                <div>
                    <p class="text-sm font-semibold text-gray-800">{{ $f->libelle }}</p>
                    <p class="text-xs text-gray-500 font-mono">{{ $f->code }}</p>
                </div>
                <a href="{{ route('admin.filieres.show', $f->id) }}" class="text-green-600 hover:underline text-sm">Voir -></a>
            </div>
        @empty
            <p class="text-sm text-gray-500">Aucune filière rattachée.</p>
        @endforelse
    </div>

    <div class="flex items-center gap-3 mt-6">
        <a href="{{ route('admin.secteurs.edit', $secteur->id) }}" class="btn-primary">
            <span class="material-symbols-outlined">edit</span>
            Modifier
        </a>
    </div>
</div>
@endsection