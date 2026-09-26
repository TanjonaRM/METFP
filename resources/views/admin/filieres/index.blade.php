@extends('layouts.admin')
@section('title', 'Filières')

@section('content')

<div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-6">
    <div>
        <h1 class="font-display text-2xl font-bold text-slate-900">Filières</h1>
        <p class="text-sm text-slate-500 mt-1">Liste des filières de formation</p>
    </div>
    <button<a class="btn-primary" onclick="openFiliereModal()" type="button">
        <span class="material-symbols-rounded text-[18px]">add</span>
        Ajouter une filière
    </button>
</div>

{{-- Filtres --}}
<div class="bg-white rounded-xl border border-slate-200 p-4 mb-4">
    <form method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-3">
        <div class="relative md:col-span-2">
            <span class="absolute left-3 top-1/2 -translate-y-1/2
                         material-symbols-rounded text-slate-400 text-[18px]">search</span>
            <input type="text" name="search" value="{{ request('search') }}"
                   placeholder="Rechercher une filière (code, libellé...)"
                   class="form-input pl-10">
        </div>
        <select name="statut" class="form-input">
            <option value="">Tous les statuts</option>
            <option value="actif" @selected(request('statut') === 'actif')>Actif</option>
            <option value="inactif" @selected(request('statut') === 'inactif')>Inactif</option>
            <option value="suspendu" @selected(request('statut') === 'suspendu')>Suspendu</option>
        </select>
        <div class="flex items-center gap-2">
            <button type="submit" class="btn-primary">
                <span class="material-symbols-rounded text-[18px]">filter_alt</span>
                Filtrer
            </button>
            <a href="{{ route('admin.filieres.index') }}" class="btn-secondary">
                <span class="material-symbols-rounded text-[18px]">restart_alt</span>
            </a>
        </div>
    </form>
</div>

<div class="bg-white rounded-xl border border-slate-200 overflow-hidden">
    <table class="table-modern">
        <thead>
            <tr>
                <th>Code</th>
                <th>Libellé</th>
                <th>Options</th>
                <th class="text-center">Formateurs</th>
                <th>Statut</th>
                <th class="text-right">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($filieres ?? [] as $f)
            <tr class="cursor-pointer hover:bg-slate-50 transition"
                onclick="window.location='{{ route('admin.filieres.show', $f->id) }}'">

                <td class="font-mono text-xs font-semibold">{{ $f->code }}</td>

                <td class="font-semibold text-slate-800">
                    {{ $f->libelle }}
                </td>

                <td>
                    @if($f->options && $f->options->count())
                        <span class="badge-gray">{{ $f->options->count() }} option(s)</span>
                    @else
                        <span class="text-slate-400">-</span>
                    @endif
                </td>

                <td class="text-center">
                    <a href="{{ route('admin.filieres.show', $f->id) }}#formateurs"
                       onclick="event.stopPropagation()"
                       class="inline-flex items-center gap-1 px-3 py-1 rounded-full
                              bg-brand-50 text-brand-700 text-xs font-semibold
                              hover:bg-brand-100 transition cursor-pointer">
                        <span class="material-symbols-rounded text-[14px]">groups</span>
                        {{ $f->formateurs_count ?? 0 }}
                    </a>
                </td>

                <td onclick="event.stopPropagation()">
                    @if(($f->statut ?? 'actif') === 'actif')
                        <span class="badge-success">Actif</span>
                    @elseif(($f->statut ?? '') === 'suspendu')
                        <span class="badge-warning">Suspendu</span>
                    @else
                        <span class="badge-danger">Inactif</span>
                    @endif
                </td>

                <td>
                    <div class="flex items-center justify-end gap-1" onclick="event.stopPropagation()">
                        <a href="{{ route('admin.filieres.show', $f->id) }}"
                           class="w-8 h-8 rounded-lg flex items-center justify-center
                                  text-slate-500 hover:bg-brand-50 hover:text-brand-700 transition"
                           title="Voir">
                            <span class="material-symbols-rounded text-[18px]">visibility</span>
                        </a>
                        <a href="{{ route('admin.filieres.edit', $f->id) }}"
                           class="w-8 h-8 rounded-lg flex items-center justify-center
                                  text-slate-500 hover:bg-brand-50 hover:text-brand-700 transition"
                           title="Modifier">
                            <span class="material-symbols-rounded text-[18px]">edit</span>
                        </a>
                        <form action="{{ route('admin.filieres.destroy', $f->id) }}"
                              method="POST" class="inline"
                              onsubmit="event.stopPropagation(); return confirm('Supprimer ?')">
                            @csrf @method('DELETE')
                            <button class="w-8 h-8 rounded-lg flex items-center justify-center
                                           text-slate-500 hover:bg-red-50 hover:text-red-600 transition"
                                    title="Supprimer">
                                <span class="material-symbols-rounded text-[18px]">delete</span>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center py-16">
                    <span class="material-symbols-rounded text-5xl text-slate-300 block mb-2">
                        school
                    </span>
                    <p class="text-slate-500">Aucune filière trouvée</p>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
    <div class="px-4 py-3 border-t border-slate-200 flex justify-between items-center text-xs text-slate-500">
        <span>Total : {{ $filieres->total() ?? 0 }} filières</span>
        <div>{{ $filieres->links() }}</div>
    </div>
</div>


@include('admin.filieres.partials.modal-create')
@endsection