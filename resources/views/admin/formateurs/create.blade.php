@extends('layouts.admin')
@section('title', 'Nouveau formateur')

@section('content')
<div class="mb-6">
    <a href="{{ route('admin.formateurs.index') }}" class="text-[12px] text-slate-500 hover:text-brand-700">Retour à la liste</a>
    <h1 class="font-display text-2xl font-bold text-slate-900 mt-2">Ajouter un formateur</h1>
</div>

<form method="POST" action="{{ route('admin.formateurs.store') }}" class="bg-white rounded-xl border border-slate-200 p-6 max-w-3xl mx-auto">
    @csrf
    @include('admin.formateurs.partials.form')

    <div class="flex items-center justify-end gap-2 mt-6 pt-6 border-t border-slate-200">
        <a href="{{ route('admin.formateurs.index') }}" class="btn-secondary">Annuler</a>
        <button type="submit" class="btn-primary">
            <span class="material-symbols-rounded text-[18px]">save</span>
            Enregistrer
        </button>
    </div>
</form>
@endsection