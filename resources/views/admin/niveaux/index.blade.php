@extends('layouts.admin')

@section('title', 'Gestion des Niveaux')

@section('content')
<div class="p-6 lg:p-8 max-w-7xl mx-auto animate-slide-up">

    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-6">
        <div>
            <div class="flex items-center gap-3">
                <span class="material-symbols-outlined text-green-700 text-3xl p-2 bg-green-50 rounded-xl">stairs</span>
                <h1 class="text-2xl md:text-3xl font-extrabold text-gray-800">Gestion des Niveaux</h1>
                <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm font-semibold">
                    {{ $niveaux->count() }}
                </span>
            </div>
            <p class="text-gray-500 mt-1">Gérez les niveaux d'études.</p>
        </div>
        <a href="{{ route('admin.niveaux.create') }}" class="btn-primary text-sm inline-flex items-center gap-2">
            <span class="material-symbols-outlined">add</span>
            Nouveau Niveau
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl mb-6 flex items-center gap-2 animate-slide-in">
            <span class="material-symbols-outlined">check_circle</span>
            {{ session('success') }}
        </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        @forelse($niveaux as $niveau)
        <div class="bg-white rounded-2xl shadow-soft p-6 border border-gray-100 hover:shadow-hover transition-all group">
            <div class="flex items-start justify-between mb-3">
                <div class="w-12 h-12 rounded-xl bg-green-100 flex items-center justify-center text-green-700">
                    <span class="material-symbols-outlined text-2xl">stairs</span>
                </div>
                <div class="flex gap-1 opacity-0 group-hover:opacity-100 transition-opacity">
                    <a href="{{ route('admin.niveaux.show', $niveau->id) }}" class="p-1.5 rounded-lg hover:bg-gray-100 text-gray-400 hover:text-green-600">
                        <span class="material-symbols-outlined">visibility</span>
                    </a>
                    <a href="{{ route('admin.niveaux.edit', $niveau->id) }}" class="p-1.5 rounded-lg hover:bg-gray-100 text-gray-400 hover:text-green-600">
                        <span class="material-symbols-outlined">edit</span>
                    </a>
                    <form action="{{ route('admin.niveaux.destroy', $niveau->id) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr ?');" class="inline">
                        @csrf @method('DELETE')
                        <button type="submit" class="p-1.5 rounded-lg hover:bg-red-50 text-gray-400 hover:text-red-600">
                            <span class="material-symbols-outlined">delete</span>
                        </button>
                    </form>
                </div>
            </div>
            <h3 class="font-bold text-gray-800">{{ $niveau->libelle ?? '-' }}</h3>
            <p class="text-sm text-gray-500 mt-1 font-mono">{{ $niveau->code ?? '' }}</p>
            <p class="text-xs text-gray-400 mt-2">{{ $niveau->filieres_count ?? 0 }} filière(s)</p>
        </div>
        @empty
        <div class="col-span-full text-center py-12">
            <span class="material-symbols-outlined text-5xl text-gray-300 block mb-2">stairs</span>
            <p class="text-gray-500">Aucun niveau trouvé.</p>
        </div>
        @endforelse
    </div>
</div>
@endsection