@extends('layouts.admin')
@section('title', 'Détail de la notification')

@section('content')

<div class="max-w-3xl mx-auto">

    {{-- Header --}}
    <div class="mb-6">
        <a href="{{ route('admin.dashboard') }}"
           class="inline-flex items-center gap-1.5 text-[13px] text-slate-500 hover:text-emerald-600 transition mb-4">
            <span class="material-symbols-rounded text-[18px]">arrow_back</span>
            Retour au tableau de bord
        </a>
        <h1 class="font-display text-2xl font-bold text-slate-900">
            Détail de la notification
        </h1>
    </div>

    {{-- Carte --}}
    <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden">

        {{-- Header --}}
        @php
            $colors = [
                'info'    => ['bg' => 'bg-blue-50',    'text' => 'text-blue-600',    'border' => 'border-blue-200'],
                'success' => ['bg' => 'bg-emerald-50', 'text' => 'text-emerald-600', 'border' => 'border-emerald-200'],
                'warning' => ['bg' => 'bg-amber-50',   'text' => 'text-amber-600',   'border' => 'border-amber-200'],
                'danger'  => ['bg' => 'bg-red-50',     'text' => 'text-red-600',     'border' => 'border-red-200'],
            ];
            $c = $colors[$notification->type] ?? $colors['info'];
        @endphp

        <div class="px-6 py-5 border-b border-slate-200 flex items-start gap-4">
            <div class="w-12 h-12 rounded-xl {{ $c['bg'] }} border {{ $c['border'] }}
                        flex items-center justify-center shrink-0">
                <span class="material-symbols-rounded {{ $c['text'] }} text-2xl">
                    {{ $notification->icone ?? 'notifications' }}
                </span>
            </div>
            <div class="flex-1">
                <h2 class="font-display text-lg font-bold text-slate-900">
                    {{ $notification->titre }}
                </h2>
                <p class="text-[12px] text-slate-500 mt-1">
                    {{ $notification->created_at?->translatedFormat('d F Y à H:i') }}
                    @if($notification->created_at)
                        · {{ $notification->created_at->diffForHumans() }}
                    @endif
                </p>
            </div>
            <div>
                @if($notification->lu)
                    <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full
                                 text-[11px] font-bold bg-slate-100 text-slate-600">
                        Lue
                    </span>
                @else
                    <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full
                                 text-[11px] font-bold bg-emerald-50 text-emerald-700">
                        Non lue
                    </span>
                @endif
            </div>
        </div>

        {{-- Body --}}
        <div class="px-6 py-6">
            <div class="prose prose-slate max-w-none">
                <p class="text-[15px] text-slate-700 leading-relaxed">
                    {{ $notification->message }}
                </p>
            </div>

            @if($notification->data)
                <div class="mt-6 pt-6 border-t border-slate-100">
                    <h3 class="text-[11px] font-bold text-slate-500 uppercase tracking-widest mb-3">
                        Données associées
                    </h3>
                    <div class="bg-slate-50 rounded-xl p-4 font-mono text-[12px] text-slate-700">
                        <pre class="whitespace-pre-wrap">{{ json_encode($notification->data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}</pre>
                    </div>
                </div>
            @endif
        </div>

        {{-- Footer --}}
        <div class="px-6 py-4 bg-slate-50 border-t border-slate-200 flex items-center justify-between gap-3">

            @if($notification->lien)
                <a href="{{ $notification->lien }}"
                   class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl
                          bg-emerald-600 text-white text-[13px] font-semibold
                          hover:bg-emerald-700 transition">
                    <span class="material-symbols-rounded text-[18px]">open_in_new</span>
                    Aller à la ressource
                </a>
            @else
                <span class="text-[12px] text-slate-400">Aucun lien associé</span>
            @endif

            <div class="flex items-center gap-2">
                <form method="POST" action="{{ route('admin.notifications.destroy', $notification->id) }}"
                      onsubmit="return confirm('Supprimer cette notification ?')">
                    @csrf @method('DELETE')
                    <button type="submit"
                            class="inline-flex items-center gap-1.5 px-4 py-2.5 rounded-xl
                                   text-[13px] font-semibold text-red-600
                                   hover:bg-red-50 transition">
                        <span class="material-symbols-rounded text-[18px]">delete</span>
                        Supprimer
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection