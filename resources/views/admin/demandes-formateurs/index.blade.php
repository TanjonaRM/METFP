@extends('layouts.admin')
@section('title', 'Demandes formateurs')

@section('content')

<div class="mb-6">
    <h1 class="font-display text-2xl font-bold text-slate-900">Demandes d'inscription formateur</h1>
    <p class="text-sm text-slate-500 mt-1">Validez ou refusez les nouvelles inscriptions</p>
</div>

@if(session('success'))
    <div class="mb-4 p-4 rounded-lg bg-emerald-50 border border-emerald-200">
        <p class="text-sm text-emerald-800">{{ session('success') }}</p>
    </div>
@endif

@if(session('error'))
    <div class="mb-4 p-4 rounded-lg bg-red-50 border border-red-200">
        <p class="text-sm text-red-800">{{ session('error') }}</p>
    </div>
@endif

<div class="bg-white rounded-xl border border-slate-200 overflow-hidden">
    <table class="w-full">
        <thead class="bg-slate-50 border-b border-slate-200">
            <tr>
                <th class="px-4 py-3 text-left text-xs font-semibold text-slate-700 uppercase">Formateur</th>
                <th class="px-4 py-3 text-left text-xs font-semibold text-slate-700 uppercase">Email</th>
                <th class="px-4 py-3 text-left text-xs font-semibold text-slate-700 uppercase">Date</th>
                <th class="px-4 py-3 text-right text-xs font-semibold text-slate-700 uppercase">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($demandes ?? [] as $d)
                <tr class="border-b border-slate-100 hover:bg-slate-50">
                    <td class="px-4 py-3 text-sm font-semibold text-slate-900">{{ $d->prenom }} {{ $d->nom }}</td>
                    <td class="px-4 py-3 text-sm text-slate-600">{{ $d->email }}</td>
                    <td class="px-4 py-3 text-xs text-slate-500">{{ $d->created_at->diffForHumans() }}</td>
                    <td class="px-4 py-3 text-right space-x-2">
                        <form method="POST" action="{{ route('admin.demandes-formateurs.approuver', $d->id) }}" class="inline">
                            @csrf
                            <button type="submit" class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg bg-emerald-600 text-white text-xs font-semibold hover:bg-emerald-700">
                                <span class="material-symbols-rounded text-[16px]">check</span>
                                Approuver
                            </button>
                        </form>
                        <button type="button" onclick="document.getElementById('refus-{{ $d->id }}').classList.toggle('hidden')"
                                class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg bg-red-600 text-white text-xs font-semibold hover:bg-red-700">
                            <span class="material-symbols-rounded text-[16px]">close</span>
                            Refuser
                        </button>
                    </td>
                </tr>
                <tr id="refus-{{ $d->id }}" class="hidden bg-red-50">
                    <td colspan="4" class="px-4 py-3">
                        <form method="POST" action="{{ route('admin.demandes-formateurs.refuser', $d->id) }}" class="flex items-center gap-3">
                            @csrf
                            <input type="text" name="motif" placeholder="Motif du refus..." required
                                   class="flex-1 px-3 py-2 text-sm border border-red-300 rounded-lg focus:ring-2 focus:ring-red-500">
                            <button type="submit" class="px-4 py-2 bg-red-600 text-white text-sm font-semibold rounded-lg hover:bg-red-700">
                                Confirmer le refus
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center py-12 text-slate-400">
                        <span class="material-symbols-rounded text-4xl block mb-2">inbox</span>
                        <p class="text-sm">Aucune demande en attente</p>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

@if(isset($demandes) && method_exists($demandes, 'links'))
    <div class="mt-4">{{ $demandes->links() }}</div>
@endif

@endsection