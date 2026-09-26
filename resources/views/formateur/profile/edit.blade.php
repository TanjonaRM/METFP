@extends('layouts.formateur')
@section('title', 'Mon profil')

@section('content')

<div class="mb-6">
    <h1 class="font-display text-2xl font-bold text-slate-900">Mon profil</h1>
    <p class="text-sm text-slate-500 mt-1">Gérez vos informations personnelles</p>
</div>

{{-- [LOCK] STATUT EN LECTURE SEULE --}}
<div class="bg-slate-50 border border-slate-200 rounded-xl p-4 mb-6">
    <div class="flex items-center justify-between">
        <div>
            <div class="text-[11px] text-slate-500 uppercase font-semibold mb-1">
                Mon statut actuel
            </div>
            <div class="flex items-center gap-2">
                @if($formateur->statut === 'actif')
                    <span class="badge-success">Actif</span>
                @elseif($formateur->statut === 'suspendu')
                    <span class="badge-warning">Suspendu</span>
                @else
                    <span class="badge-danger">Inactif</span>
                @endif
            </div>
        </div>
        <div class="text-right">
            <div class="text-[11px] text-slate-500">
                Statut géré par l'administration
            </div>
            <div class="text-[10px] text-slate-400 mt-1">
                [LOCK] Non modifiable
            </div>
        </div>
    </div>
</div>

{{-- Formulaire de modification --}}
<form method="POST" action="{{ route('formateur.profile.update') }}"
      class="bg-white rounded-xl border border-slate-200 p-6">
    @csrf
    @method('PUT')

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Nom *</label>
            <input type="text" name="nom" value="{{ old('nom', $formateur->nom) }}"
                   class="input-modern" required>
            @error('nom') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Prénom *</label>
            <input type="text" name="prenom" value="{{ old('prenom', $formateur->prenom) }}"
                   class="input-modern" required>
            @error('prenom') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Email *</label>
            <input type="email" name="email" value="{{ old('email', $formateur->email) }}"
                   class="input-modern" required>
            @error('email') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Téléphone</label>
            <input type="text" name="telephone" value="{{ old('telephone', $formateur->telephone) }}"
                   class="input-modern">
            @error('telephone') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="md:col-span-2">
            <label class="block text-sm font-medium text-gray-700 mb-1">Adresse</label>
            <textarea name="adresse" rows="2" class="input-modern">{{ old('adresse', $formateur->adresse) }}</textarea>
        </div>

    </div>

    <div class="flex items-center justify-end gap-2 mt-6 pt-6 border-t border-slate-200">
        <button type="submit" class="btn-primary">
            <span class="material-symbols-rounded text-[18px]">save</span>
            Enregistrer
        </button>
    </div>
</form>

@endsection