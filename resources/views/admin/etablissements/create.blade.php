@extends('layouts.admin')
@section('title', 'Nouvel établissement')

@section('content')

<div class="mb-6">
    <a href="{{ route('admin.etablissements.index') }}"
       class="inline-flex items-center gap-1 text-[12px] text-slate-500 hover:text-brand-700 mb-2">
        <span class="material-symbols-rounded text-[16px]">arrow_back</span>
        Retour à la liste
    </a>
    <h1 class="font-display text-2xl font-bold text-slate-900">Ajouter un établissement</h1>
    <p class="text-sm text-slate-500 mt-1">Remplissez les informations de l'établissement</p>
</div>

<form method="POST" action="{{ route('admin.etablissements.store') }}"
      class="bg-white rounded-xl border border-slate-200 p-6">
    @csrf

    @include('admin.etablissements.partials.form')

    <div class="flex items-center justify-end gap-2 mt-6 pt-6 border-t border-slate-200">
        <a href="{{ route('admin.etablissements.index') }}" class="btn-secondary">Annuler</a>
        <button type="submit" class="btn-primary">
            <span class="material-symbols-rounded text-[18px]">save</span>
            Enregistrer
        </button>
    </div>
</form>

@endsection