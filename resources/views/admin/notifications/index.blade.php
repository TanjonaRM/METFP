@extends('layouts.admin')
@section('title', 'Notifications')

@section('content')
<div class="mb-6 flex items-center justify-between">
    <div>
        <h1 class="font-display text-2xl font-bold text-slate-900">Notifications</h1>
        <p class="text-sm text-slate-500 mt-1">Toutes vos notifications</p>
    </div>
    @if(isset($notifications) && $notifications->count() > 0)
    <form method="POST" action="{{ route('admin.notifications.markAllAsRead') ?? '#' }}">
        @csrf
        <button type="submit" class="btn-secondary">
            <span class="material-symbols-rounded text-[18px]">done_all</span>
            Tout marquer comme lu
        </button>
    </form>
    @endif
</div>

<div class="bg-white rounded-xl border border-slate-200 overflow-hidden">
    @forelse($notifications ?? [] as $notif)
        <div class="flex items-start gap-4 p-4 border-b border-slate-100 hover:bg-slate-50 transition
                    {{ !$notif->read_at ? 'bg-emerald-50/40' : '' }}">
            <div class="w-10 h-10 rounded-xl bg-emerald-100 flex items-center justify-center shrink-0">
                <span class="material-symbols-rounded text-emerald-700 text-[22px]">
                    {{ $notif->type ?? 'notifications' }}
                </span>
            </div>
            <div class="flex-1 min-w-0">
                <div class="flex items-start justify-between gap-4">
                    <div>
                        <p class="text-sm font-semibold text-slate-900">{{ $notif->titre ?? 'Notification' }}</p>
                        <p class="text-xs text-slate-600 mt-1">{{ $notif->message ?? '' }}</p>
                    </div>
                    <span class="text-[11px] text-slate-400 whitespace-nowrap">
                        {{ isset($notif->created_at) ? $notif->created_at->diffForHumans() : '' }}
                    </span>
                </div>
            </div>
        </div>
    @empty
        <div class="text-center py-16 text-slate-400">
            <span class="material-symbols-rounded text-5xl block mb-3">notifications_off</span>
            <p class="text-sm">Aucune notification</p>
        </div>
    @endforelse
</div>

@if(isset($notifications) && method_exists($notifications, 'links'))
    <div class="mt-4">
        {{ $notifications->links() }}
    </div>
@endif
@endsection