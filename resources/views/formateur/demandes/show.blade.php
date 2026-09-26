@extends('layouts.admin')
@section('title', 'Demande d\'affectation')

@section('content')
<div class="mb-6">
    <a href="{{ route('formateur.demandes.index') }}" class="text-[12px] text-slate-500 hover:text-brand-700">
        <- Retour aux demandes
    </a>
    <h1 class="font-display text-2xl font-bold text-slate-900 mt-2">
        Demande #{{ $demande->id ?? '-' }}
    </h1>
</div>

<div class="bg-white rounded-xl border border-slate-200 p-6">
    <dl class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
        <div>
            <dt class="text-slate-500 text-xs uppercase tracking-wide mb-1">Statut</dt>
            <dd class="font-semibold">
                @php $statut = $demande->statut ?? 'en_attente'; @endphp
                <span class="inline-flex px-2 py-0.5 rounded-full text-xs font-semibold
                    @if($statut === 'approuvee') bg-emerald-100 text-emerald-800
                    @elseif($statut === 'refusee') bg-red-100 text-red-800
                    @else bg-amber-100 text-amber-800 @endif">
                    {{ ucfirst(str_replace('_', ' ', $statut)) }}
                </span>
            </dd>
        </div>

        <div>
            <dt class="text-slate-500 text-xs uppercase tracking-wide mb-1">Créée le</dt>
            <dd class="font-semibold">
                {{ isset($demande->created_at) ? $demande->created_at->format('d/m/Y H:i') : '-' }}
            </dd>
        </div>

        <div class="md:col-span-2">
            <dt class="text-slate-500 text-xs uppercase tracking-wide mb-1">Motif</dt>
            <dd class="text-slate-700">{{ $demande->motif ?? '-' }}</dd>
        </div>
    </dl>
</div>
@endsection