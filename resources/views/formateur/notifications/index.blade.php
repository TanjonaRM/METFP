@extends('layouts.formateur')
@section('title', 'Notifications')

@section('content')

<div class="max-w-5xl mx-auto">

    {{-- Header --}}
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-6">
        <div class="flex items-center gap-4">
            <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-emerald-500 to-emerald-700
                        flex items-center justify-center shadow-lg">
                <span class="material-symbols-rounded text-white text-3xl"
                      style="font-variation-settings: 'FILL' 1;">notifications</span>
            </div>
            <div>
                <h1 class="font-display text-2xl font-bold text-slate-900">Notifications</h1>
                <p class="text-sm text-slate-500 mt-1">Toutes vos activités récentes</p>
            </div>
        </div>

        @if($stats['non_lues'] > 0)
            <form method="POST" action="{{ route('formateur.notifications.read-all') }}">
                @csrf
                <button type="submit" class="btn-secondary">
                    <span class="material-symbols-rounded text-lg">done_all</span>
                    Tout marquer comme lu
                </button>
            </form>
        @endif
    </div>

    {{-- Stats --}}
    <div class="grid grid-cols-3 gap-4 mb-6">
        <div class="bg-white rounded-xl border border-slate-200 p-4">
            <div class="text-xs font-bold text-slate-500 uppercase tracking-wide">Total</div>
            <div class="text-2xl font-bold text-slate-900 mt-1">{{ $stats['total'] }}</div>
        </div>
        <div class="bg-white rounded-xl border border-slate-200 p-4">
            <div class="text-xs font-bold text-slate-500 uppercase tracking-wide">Non lues</div>
            <div class="text-2xl font-bold text-emerald-600 mt-1">{{ $stats['non_lues'] }}</div>
        </div>
        <div class="bg-white rounded-xl border border-slate-200 p-4">
            <div class="text-xs font-bold text-slate-500 uppercase tracking-wide">Lues</div>
            <div class="text-2xl font-bold text-slate-400 mt-1">{{ $stats['lues'] }}</div>
        </div>
    </div>

    {{-- Liste --}}
    <div class="bg-white rounded-xl border border-slate-200 overflow-hidden">

        @forelse($notifications as $notif)
            @php
                $colors = [
                    'info'    => ['bg' => 'bg-blue-50',    'text' => 'text-blue-600',    'border' => 'border-blue-200'],
                    'success' => ['bg' => 'bg-emerald-50', 'text' => 'text-emerald-600', 'border' => 'border-emerald-200'],
                    'warning' => ['bg' => 'bg-amber-50',   'text' => 'text-amber-600',   'border' => 'border-amber-200'],
                    'danger'  => ['bg' => 'bg-red-50',     'text' => 'text-red-600',     'border' => 'border-red-200'],
                ];
                $c = $colors[$notif->type] ?? $colors['info'];
            @endphp

            <div class="flex items-start gap-4 px-5 py-4 border-b border-slate-100 last:border-0
                        {{ $notif->lu ? 'opacity-60' : 'bg-white' }}">

                <div class="w-10 h-10 rounded-lg {{ $c['bg'] }} border {{ $c['border'] }}
                            flex items-center justify-center shrink-0">
                    <span class="material-symbols-rounded {{ $c['text'] }} text-xl">
                        {{ $notif->icone ?? 'info' }}
                    </span>
                </div>

                <div class="flex-1 min-w-0">
                    <div class="flex items-start justify-between gap-2">
                        <div>
                            <div class="font-bold text-slate-900">{{ $notif->titre }}</div>
                            <div class="text-sm text-slate-600 mt-0.5">{{ $notif->message }}</div>
                        </div>
                        <div class="text-xs text-slate-400 whitespace-nowrap">
                            {{ $notif->created_at?->diffForHumans() }}
                        </div>
                    </div>

                    <div class="flex items-center gap-3 mt-2">
                        @if($notif->lien)
                            <a href="{{ $notif->lien }}"
                               class="text-xs font-semibold text-emerald-600 hover:text-emerald-700">
                                Voir ->
                            </a>
                        @endif

                        @if(!$notif->lu)
                            <form method="POST" action="{{ route('formateur.notifications.mark-read', $notif->id) }}" class="inline">
                                @csrf
                                <button type="submit" class="text-xs font-semibold text-slate-500 hover:text-slate-700">
                                    Marquer comme lu
                                </button>
                            </form>
                        @endif

                        <form method="POST" action="{{ route('formateur.notifications.destroy', $notif->id) }}" class="inline"
                              onsubmit="return confirm('Supprimer ?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-xs font-semibold text-red-500 hover:text-red-700">
                                Supprimer
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="text-center py-16">
                <span class="material-symbols-rounded text-5xl text-slate-300 block mb-3">notifications_off</span>
                <p class="text-slate-500">Aucune notification</p>
            </div>
        @endforelse

        @if($notifications->hasPages())
            <div class="px-4 py-3 border-t border-slate-200">
                {{ $notifications->links() }}
            </div>
        @endif
    </div>

</div>

@endsection