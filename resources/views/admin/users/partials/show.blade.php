<div class="space-y-4">

    <div class="bg-white border-2 border-slate-300 rounded-lg p-5">
        <div class="flex items-center gap-4">
            <div class="w-16 h-16 rounded-full bg-brand-700 flex items-center justify-center text-white font-bold text-2xl">
                {{ strtoupper(substr($user->prenom ?? 'A', 0, 1) . substr($user->nom ?? 'D', 0, 1)) }}
            </div>
            <div>
                <div class="font-bold text-lg text-slate-900">{{ $user->prenom }} {{ $user->nom }}</div>
                <div class="text-sm text-slate-500">{{ $user->email }}</div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-2 gap-4">
        <div class="bg-white border-2 border-slate-300 rounded-lg p-4">
            <div class="text-xs font-bold text-slate-500 uppercase tracking-wide mb-1">Rôle</div>
            @if($user->role === 'super_admin')
                <span class="badge-success">Super Admin</span>
            @elseif($user->role === 'admin')
                <span class="badge-info">Admin</span>
            @else
                <span class="badge-gray">Gestionnaire</span>
            @endif
        </div>

        <div class="bg-white border-2 border-slate-300 rounded-lg p-4">
            <div class="text-xs font-bold text-slate-500 uppercase tracking-wide mb-1">Créé le</div>
            <div class="font-semibold text-slate-900">{{ $user->created_at?->format('d/m/Y à H:i') }}</div>
        </div>
    </div>

</div>