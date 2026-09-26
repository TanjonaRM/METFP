@extends('layouts.admin')
@section('title', 'Secteurs')

@section('content')
<div class="flex flex-col gap-5 mb-8 md:flex-row md:items-center md:justify-between">
    <div class="flex items-center gap-4">
        <div class="w-14 h-14 rounded-2xl bg-linear-to-br from-primary-100 to-primary-200 flex items-center justify-center text-primary-700 shrink-0">
            <span class="material-symbols-rounded text-[28px]" style="font-variation-settings: 'FILL' 1;">category</span>
        </div>
        <div>
            <h1 class="font-display text-3xl font-bold text-slate-900">Secteurs</h1>
            <p class="text-sm text-slate-500 mt-1">Gérez les secteurs d'activité</p>
        </div>
    </div>
    <a href="{{ route('admin.secteurs.create') }}" class="btn btn-primary">
        <span class="material-symbols-rounded text-[18px]">add</span>Nouveau secteur
    </a>
</div>

@if(session('success'))
    <div class="flex items-start gap-3 px-5 py-4 rounded-2xl mb-6 bg-primary-50 border border-primary-200 text-primary-800 text-sm">
        <span class="material-symbols-rounded">check_circle</span><div>{{ session('success') }}</div>
    </div>
@endif

<div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
    <table class="w-full">
        <thead class="bg-slate-50 border-b border-slate-200">
            <tr>
                <th class="text-left px-6 py-3.5 text-[11px] font-bold text-slate-500 uppercase tracking-wider">Code</th>
                <th class="text-left px-6 py-3.5 text-[11px] font-bold text-slate-500 uppercase tracking-wider">Libellé</th>
                <th class="text-left px-6 py-3.5 text-[11px] font-bold text-slate-500 uppercase tracking-wider">Filières</th>
                <th class="text-right px-6 py-3.5 text-[11px] font-bold text-slate-500 uppercase tracking-wider">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($secteurs as $s)
            <tr class="border-b border-slate-100 hover:bg-primary-50/40 transition-colors last:border-0">
                <td class="px-6 py-4 font-mono text-sm text-slate-700">{{ $s->code }}</td>
                <td class="px-6 py-4 font-semibold text-slate-900 text-sm">{{ $s->libelle }}</td>
                <td class="px-6 py-4">
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[11px] font-semibold bg-primary-50 text-primary-700">
                        {{ $s->filieres_count }}
                    </span>
                </td>
                <td class="px-6 py-4">
                    <div class="flex items-center justify-end gap-1">
                        <a href="{{ route('admin.secteurs.show', $s->id) }}" class="w-9 h-9 rounded-lg flex items-center justify-center text-slate-500 hover:bg-primary-50 hover:text-primary-700 transition">
                            <span class="material-symbols-rounded text-[20px]">visibility</span>
                        </a>
                        <a href="{{ route('admin.secteurs.edit', $s->id) }}" class="w-9 h-9 rounded-lg flex items-center justify-center text-slate-500 hover:bg-primary-50 hover:text-primary-700 transition">
                            <span class="material-symbols-rounded text-[20px]">edit</span>
                        </a>
                        <form action="{{ route('admin.secteurs.destroy', $s->id) }}" method="POST" onsubmit="return confirm('Supprimer ?');" class="inline">
                            @csrf @method('DELETE')
                            <button type="submit" class="w-9 h-9 rounded-lg flex items-center justify-center text-slate-500 hover:bg-red-50 hover:text-red-600 transition">
                                <span class="material-symbols-rounded text-[20px]">delete</span>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr><td colspan="4" class="px-6 py-16 text-center">
                <div class="flex flex-col items-center gap-3 text-slate-400">
                    <span class="material-symbols-rounded text-6xl">category</span>
                    <div class="text-[15px] font-semibold text-slate-600">Aucun secteur trouvé</div>
                </div>
            </td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection