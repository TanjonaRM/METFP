@extends('layouts.admin')
@section('title', 'Détails de l\'utilisateur')

@section('content')
<div class="flex items-center gap-4 mb-8">
    <a href="{{ route('admin.users.index') }}" class="w-10 h-10 rounded-xl bg-white border border-slate-200 flex items-center justify-center text-slate-600 hover:text-primary-700 transition">
        <span class="material-symbols-rounded">arrow_back</span>
    </a>
    <h1 class="font-display text-3xl font-bold text-slate-900">Détails de l'utilisateur</h1>
</div>

<div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden mb-6">
    <div class="p-8 grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
            <p class="text-xs font-semibold text-slate-500 uppercase mb-1">Nom complet</p>
            <p class="font-semibold text-slate-900">{{ $user->prenom }} {{ $user->nom }}</p>
        </div>
        <div>
            <p class="text-xs font-semibold text-slate-500 uppercase mb-1">Email</p>
            <p class="font-semibold text-slate-900">{{ $user->email }}</p>
        </div>
        <div>
            <p class="text-xs font-semibold text-slate-500 uppercase mb-1">Rôle</p>
            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[11px] font-semibold bg-primary-50 text-primary-700">{{ $user->role }}</span>
        </div>
    </div>
</div>

<a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-primary">
    <span class="material-symbols-rounded text-[18px]">edit</span>Modifier
</a>
@endsection