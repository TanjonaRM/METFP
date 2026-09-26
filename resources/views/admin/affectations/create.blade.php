@extends('layouts.admin')
@section('title', 'Nouvelle affectation')

@section('content')

<div class="max-w-4xl mx-auto">

    {{-- Header --}}
    <div class="mb-6">
        <a href="{{ route('admin.affectations.index') }}"
           class="inline-flex items-center gap-1 text-sm text-slate-500 hover:text-brand-700 mb-3 transition">
            <span class="material-symbols-rounded text-lg">arrow_back</span>
            Retour à la liste
        </a>
        <div class="flex items-center gap-4">
            <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-brand-500 to-brand-700
                        flex items-center justify-center shadow-lg">
                <span class="material-symbols-rounded text-white text-3xl"
                      style="font-variation-settings: 'FILL' 1;">add_task</span>
            </div>
            <div>
                <h1 class="font-display text-2xl font-bold text-slate-900">Nouvelle affectation</h1>
                <p class="text-sm text-slate-500 mt-1">Créer une affectation pour un formateur</p>
            </div>
        </div>
    </div>

    {{-- Formulaire --}}
    <form method="POST" action="{{ route('admin.affectations.store') }}"
          class="bg-white rounded-2xl border-2 border-slate-200 p-6 shadow-sm">
        @csrf

        @include('admin.affectations.partials.form')

        {{-- Actions --}}
        <div class="flex items-center justify-end gap-3 mt-8 pt-6 border-t-2 border-slate-100">
            <a href="{{ route('admin.affectations.index') }}" class="btn-secondary">
                <span class="material-symbols-rounded text-lg">close</span>
                Annuler
            </a>
            <button type="submit" class="btn-primary">
                <span class="material-symbols-rounded text-lg">save</span>
                Enregistrer
            </button>
        </div>
    </form>

</div>

@endsection