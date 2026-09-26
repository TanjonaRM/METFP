<div class="space-y-4">

    {{-- Formateur --}}
    <div class="bg-white border-2 border-slate-300 rounded-lg p-4">
        <div class="text-xs font-bold text-slate-500 uppercase tracking-wide mb-2">Formateur</div>
        <a href="{{ route('admin.formateurs.show', $affectation->formateur->id ?? 0) }}"
           class="flex items-center gap-3 group">
            <div class="w-12 h-12 rounded-lg bg-brand-100 flex items-center justify-center">
                <span class="text-brand-700 font-bold text-lg">
                    {{ strtoupper(substr($affectation->formateur->prenom ?? 'U', 0, 1) . substr($affectation->formateur->nom ?? 'N', 0, 1)) }}
                </span>
            </div>
            <div>
                <div class="font-bold text-slate-900 group-hover:text-brand-700">
                    {{ $affectation->formateur->nom ?? '-' }} {{ $affectation->formateur->prenom ?? '' }}
                </div>
                <div class="text-xs text-slate-500 font-mono">{{ $affectation->formateur->matricule ?? '' }}</div>
            </div>
        </a>
    </div>

    {{-- Filière + Établissement --}}
    <div class="grid grid-cols-2 gap-4">
        <div class="bg-white border-2 border-slate-300 rounded-lg p-4">
            <div class="text-xs font-bold text-slate-500 uppercase tracking-wide mb-1">Filière</div>
            <div class="font-semibold text-slate-900">{{ $affectation->filiere->libelle ?? '-' }}</div>
            <div class="text-xs text-slate-500 font-mono">{{ $affectation->filiere->code ?? '' }}</div>
        </div>

        <div class="bg-white border-2 border-slate-300 rounded-lg p-4">
            <div class="text-xs font-bold text-slate-500 uppercase tracking-wide mb-1">Établissement</div>
            <div class="font-semibold text-slate-900">{{ $affectation->etablissement->nom ?? '-' }}</div>
            <div class="text-xs text-slate-500">{{ $affectation->etablissement->region ?? '' }}</div>
        </div>
    </div>

    {{-- Période + Statut --}}
    <div class="grid grid-cols-2 gap-4">
        <div class="bg-white border-2 border-slate-300 rounded-lg p-4">
            <div class="text-xs font-bold text-slate-500 uppercase tracking-wide mb-1">Période</div>
            <div class="text-sm text-slate-900">
                Du <strong>{{ $affectation->date_debut?->format('d/m/Y') }}</strong>
                @if($affectation->date_fin)
                    au <strong>{{ $affectation->date_fin->format('d/m/Y') }}</strong>
                @else
                    <span class="text-brand-700 font-semibold">- En cours</span>
                @endif
            </div>
        </div>

        <div class="bg-white border-2 border-slate-300 rounded-lg p-4">
            <div class="text-xs font-bold text-slate-500 uppercase tracking-wide mb-1">Statut</div>
            @if($affectation->statut === 'actif')
                <span class="badge-success">Actif</span>
            @elseif($affectation->statut === 'termine')
                <span class="badge-gray">Terminé</span>
            @else
                <span class="badge-warning">Suspendu</span>
            @endif
        </div>
    </div>

</div>