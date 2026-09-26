@extends('layouts.admin')
@section('title', 'Nouveau secteur')

@section('content')
<div class="flex items-center gap-4 mb-8">
    <a href="{{ route('admin.secteurs.index') }}" class="w-10 h-10 rounded-xl bg-white border border-slate-200 flex items-center justify-center text-slate-600 hover:text-primary-700 transition">
        <span class="material-symbols-rounded">arrow_back</span>
    </a>
    <h1 class="font-display text-3xl font-bold text-slate-900">Nouveau secteur</h1>
</div>

<form action="{{ route('admin.secteurs.store') }}" method="POST">
    @csrf
    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden mb-6">
        <div class="p-8 space-y-6">
            <div>
                <label class="block text-[13px] font-semibold text-slate-700 mb-2">Code *</label>
                <input type="text" name="code" value="{{ old('code') }}" placeholder="ex: IND" required
                       class="w-full px-4 py-3 rounded-xl border-[1.5px] border-slate-200 bg-white text-sm outline-none transition-all focus:border-primary-500 focus:ring-4 focus:ring-primary-50">
            </div>
            <div>
                <label class="block text-[13px] font-semibold text-slate-700 mb-2">Libellé *</label>
                <input type="text" name="libelle" value="{{ old('libelle') }}" required
                       class="w-full px-4 py-3 rounded-xl border-[1.5px] border-slate-200 bg-white text-sm outline-none">
            </div>
        </div>
    </div>

    <div class="flex items-center justify-end gap-3">
        <a href="{{ route('admin.secteurs.index') }}" class="btn btn-outline-secondary">Annuler</a>
        <button type="submit" class="btn btn-primary">
            <span class="material-symbols-rounded text-[18px]">save</span>Enregistrer
        </button>
    </div>
</form>
@endsection