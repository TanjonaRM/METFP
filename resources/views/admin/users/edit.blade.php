@extends('layouts.admin')
@section('title', 'Modifier l\'utilisateur')

@section('content')
<div class="flex items-center gap-4 mb-8">
    <a href="{{ route('admin.users.index') }}" class="w-10 h-10 rounded-xl bg-white border border-slate-200 flex items-center justify-center text-slate-600 hover:text-primary-700 transition">
        <span class="material-symbols-rounded">arrow_back</span>
    </a>
    <h1 class="font-display text-3xl font-bold text-slate-900">Modifier : {{ $user->prenom }} {{ $user->nom }}</h1>
</div>

<form action="{{ route('admin.users.update', $user->id) }}" method="POST">
    @csrf @method('PUT')
    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden mb-6">
        <div class="p-8 grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-[13px] font-semibold text-slate-700 mb-2">Nom *</label>
                <input type="text" name="nom" value="{{ old('nom', $user->nom) }}" required
                       class="w-full px-4 py-3 rounded-xl border-[1.5px] border-slate-200 bg-white text-sm outline-none">
            </div>
            <div>
                <label class="block text-[13px] font-semibold text-slate-700 mb-2">Prénom *</label>
                <input type="text" name="prenom" value="{{ old('prenom', $user->prenom) }}" required
                       class="w-full px-4 py-3 rounded-xl border-[1.5px] border-slate-200 bg-white text-sm outline-none">
            </div>
            <div class="md:col-span-2">
                <label class="block text-[13px] font-semibold text-slate-700 mb-2">Email *</label>
                <input type="email" name="email" value="{{ old('email', $user->email) }}" required
                       class="w-full px-4 py-3 rounded-xl border-[1.5px] border-slate-200 bg-white text-sm outline-none">
            </div>
            <div>
                <label class="block text-[13px] font-semibold text-slate-700 mb-2">Rôle *</label>
                <select name="role" required class="w-full px-4 py-3 rounded-xl border-[1.5px] border-slate-200 bg-white text-sm outline-none">
                    <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Administrateur</option>
                    <option value="super_admin" {{ old('role', $user->role) == 'super_admin' ? 'selected' : '' }}>Super Admin</option>
                    <option value="gestionnaire" {{ old('role', $user->role) == 'gestionnaire' ? 'selected' : '' }}>Gestionnaire</option>
                </select>
            </div>
            <div>
                <label class="block text-[13px] font-semibold text-slate-700 mb-2">Nouveau mot de passe (optionnel)</label>
                <input type="password" name="password"
                       class="w-full px-4 py-3 rounded-xl border-[1.5px] border-slate-200 bg-white text-sm outline-none">
            </div>
        </div>
    </div>

    <div class="flex items-center justify-end gap-3">
        <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary">Annuler</a>
        <button type="submit" class="btn btn-primary">
            <span class="material-symbols-rounded text-[18px]">save</span>Mettre à jour
        </button>
    </div>
</form>
@endsection