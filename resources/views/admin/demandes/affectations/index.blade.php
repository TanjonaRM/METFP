@extends('layouts.admin')
@section('title', 'Demandes d\'affectations')

@section('content')

<div class="mb-6">
    <h1 class="font-display text-2xl font-bold text-slate-900">Demandes d'affectations</h1>
    <p class="text-sm text-slate-500 mt-1">Traiter les demandes des formateurs</p>
</div>

@if(session('success'))
    <div class="mb-4 px-4 py-3 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-sm flex items-center gap-2">
        <span class="material-symbols-rounded">check_circle</span>
        {{ session('success') }}
    </div>
@endif

<div class="grid grid-cols-4 gap-4 mb-6">
    <div class="bg-white rounded-xl border border-slate-200 p-4">
        <div class="text-xs font-bold text-slate-500 uppercase">Total</div>
        <div class="text-2xl font-bold text-slate-900 mt-1">{{ $stats['total'] }}</div>
    </div>
    <div class="bg-white rounded-xl border border-slate-200 p-4">
        <div class="text-xs font-bold text-slate-500 uppercase">En attente</div>
        <div class="text-2xl font-bold text-amber-600 mt-1">{{ $stats['en_attente'] }}</div>
    </div>
    <div class="bg-white rounded-xl border border-slate-200 p-4">
        <div class="text-xs font-bold text-slate-500 uppercase">Approuvées</div>
        <div class="text-2xl font-bold text-emerald-600 mt-1">{{ $stats['approuvees'] }}</div>
    </div>
    <div class="bg-white rounded-xl border border-slate-200 p-4">
        <div class="text-xs font-bold text-slate-500 uppercase">Refusées</div>
        <div class="text-2xl font-bold text-red-600 mt-1">{{ $stats['refusees'] }}</div>
    </div>
</div>

<div class="bg-white rounded-xl border border-slate-200 overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-slate-50 border-b border-slate-200">
            <tr>
                <th class="text-left px-5 py-3 text-[11px] font-bold text-slate-500 uppercase">Formateur</th>
                <th class="text-left px-5 py-3 text-[11px] font-bold text-slate-500 uppercase">Filière</th>
                <th class="text-left px-5 py-3 text-[11px] font-bold text-slate-500 uppercase">Motif</th>
                <th class="text-left px-5 py-3 text-[11px] font-bold text-slate-500 uppercase">Date</th>
                <th class="text-left px-5 py-3 text-[11px] font-bold text-slate-500 uppercase">Statut</th>
                <th class="text-right px-5 py-3 text-[11px] font-bold text-slate-500 uppercase">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($demandes as $demande)
                <tr class="border-b border-slate-100 hover:bg-slate-50">
                    <td class="px-5 py-4">
                        <div class="font-semibold text-slate-900">
                            {{ $demande->formateur->prenom ?? '' }} {{ $demande->formateur->nom ?? '' }}
                        </div>
                        <div class="text-xs text-slate-500 font-mono">{{ $demande->formateur->matricule ?? '' }}</div>
                    </td>
                    <td class="px-5 py-4 text-slate-700">{{ $demande->filiere->libelle ?? '-' }}</td>
                    <td class="px-5 py-4 text-slate-600 max-w-xs" title="{{ $demande->motif }}">
                        {{ Str::limit($demande->motif, 50) }}
                    </td>
                    <td class="px-5 py-4 text-xs text-slate-500">
                        {{ $demande->created_at?->format('d/m/Y H:i') }}
                    </td>
                    <td class="px-5 py-4">
                        @if($demande->statut === 'en_attente')
                            <span class="px-2.5 py-1 rounded-full text-[10px] font-bold bg-amber-50 text-amber-700">En attente</span>
                        @elseif($demande->statut === 'approuvee')
                            <span class="px-2.5 py-1 rounded-full text-[10px] font-bold bg-emerald-50 text-emerald-700">Approuvée</span>
                        @else
                            <span class="px-2.5 py-1 rounded-full text-[10px] font-bold bg-red-50 text-red-700">Refusée</span>
                        @endif
                    </td>
                    <td class="px-5 py-4 text-right">
                        @if($demande->statut === 'en_attente')
                            <button type="button"
                                    onclick="openApprovalModal(
                                        {{ $demande->id }},
                                        '{{ addslashes($demande->formateur->prenom ?? '') }} {{ addslashes($demande->formateur->nom ?? '') }}',
                                        '{{ addslashes($demande->formateur->matricule ?? '') }}'
                                    )"
                                    class="inline-flex items-center gap-1.5 px-4 py-2 rounded-lg
                                           bg-emerald-600 text-white text-[12px] font-bold
                                           hover:bg-emerald-700 transition">
                                <span class="material-symbols-rounded text-[16px]">task_alt</span>
                                Traiter
                            </button>
                        @else
                            <span class="text-xs text-slate-400">
                                Traitée le {{ $demande->traitee_le?->format('d/m/Y') }}
                            </span>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center py-16 text-slate-400">
                        <span class="material-symbols-rounded text-5xl text-slate-300 block mb-2">inbox</span>
                        Aucune demande
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
    @if($demandes->hasPages())
        <div class="px-5 py-3 border-t">{{ $demandes->links() }}</div>
    @endif
</div>

{{-- ============================================================
     MODAL D'APPROBATION
     ============================================================ --}}
<div id="approvalModal" class="fixed inset-0 z-[9999] items-center justify-center p-4" style="display:none;"
     onclick="if(event.target === this) closeApprovalModal()">

    <div class="absolute inset-0 bg-black/50 backdrop-blur-sm"></div>

    <div class="relative bg-white rounded-2xl shadow-2xl w-full max-w-lg flex flex-col overflow-hidden"
         style="max-height: 90vh;">

        {{-- Header --}}
        <div class="px-6 py-4 border-b border-slate-200 flex items-center justify-between shrink-0">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-emerald-500 to-emerald-700
                            flex items-center justify-center shadow-sm">
                    <span class="material-symbols-rounded text-white text-xl"
                          style="font-variation-settings: 'FILL' 1;">task_alt</span>
                </div>
                <div>
                    <h2 class="font-display text-lg font-bold text-slate-900">Traiter la demande</h2>
                    <p class="text-xs text-slate-500">Demande d'affectation</p>
                </div>
            </div>
            <button type="button" onclick="closeApprovalModal()"
                    class="w-9 h-9 rounded-lg flex items-center justify-center
                           text-slate-400 hover:bg-slate-100 hover:text-slate-700 transition">
                <span class="material-symbols-rounded text-[20px]">close</span>
            </button>
        </div>

        {{-- Body --}}
        <form id="approvalForm"
              method="POST"
              data-base-url="{{ url('/admin/demandes-affectations') }}"
              class="flex flex-col flex-1 min-h-0">
            @csrf

            <div class="flex-1 overflow-y-auto px-6 py-5 space-y-5">

                {{-- Formateur --}}
                <div class="bg-slate-50 rounded-xl p-4">
                    <div class="text-[10px] font-bold text-slate-500 uppercase tracking-widest mb-1">
                        Formateur
                    </div>
                    <div class="font-semibold text-slate-900" id="modalFormateur">-</div>
                    <div class="text-xs text-slate-500 font-mono mt-0.5" id="modalMatricule">-</div>
                </div>

                {{-- Décision --}}
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-3">
                        Votre décision <span class="text-red-500">*</span>
                    </label>

                    <div class="grid grid-cols-2 gap-3">

                        {{-- Accepter --}}
                        <label class="cursor-pointer">
                            <input type="radio" name="decision" value="approuver" class="peer sr-only" checked>
                            <div class="flex flex-col items-center gap-2 px-4 py-5
                                        border-2 border-slate-200 rounded-xl
                                        transition-all
                                        hover:border-emerald-300 hover:bg-emerald-50/30
                                        peer-checked:border-emerald-500 peer-checked:bg-emerald-50
                                        peer-checked:shadow-md">
                                <span class="material-symbols-rounded text-emerald-600 text-3xl"
                                      style="font-variation-settings: 'FILL' 1;">check_circle</span>
                                <span class="text-sm font-bold text-slate-900">Accepter</span>
                                <span class="text-[11px] text-slate-500">Approuver la demande</span>
                            </div>
                        </label>

                        {{-- Refuser --}}
                        <label class="cursor-pointer">
                            <input type="radio" name="decision" value="refuser" class="peer sr-only">
                            <div class="flex flex-col items-center gap-2 px-4 py-5
                                        border-2 border-slate-200 rounded-xl
                                        transition-all
                                        hover:border-red-300 hover:bg-red-50/30
                                        peer-checked:border-red-500 peer-checked:bg-red-50
                                        peer-checked:shadow-md">
                                <span class="material-symbols-rounded text-red-600 text-3xl"
                                      style="font-variation-settings: 'FILL' 1;">cancel</span>
                                <span class="text-sm font-bold text-slate-900">Refuser</span>
                                <span class="text-[11px] text-slate-500">Rejeter la demande</span>
                            </div>
                        </label>
                    </div>
                </div>

                {{-- Message --}}
                <div>
                    <label for="reponse_admin" class="block text-sm font-semibold text-slate-700 mb-2">
                        Message au formateur
                        <span class="text-slate-400 font-normal">(optionnel)</span>
                    </label>
                    <textarea name="reponse_admin"
                              id="reponse_admin"
                              rows="4"
                              placeholder="Expliquez votre décision au formateur..."
                              class="w-full px-4 py-3 text-sm border-2 border-slate-200 rounded-xl
                                     focus:outline-none focus:border-emerald-500 focus:ring-2 focus:ring-emerald-100
                                     resize-none"></textarea>
                    <p class="text-[11px] text-slate-400 mt-1.5">
                        ⓘ Ce message sera envoyé au formateur dans sa notification.
                    </p>
                </div>
            </div>

            {{-- Footer --}}
            <div class="px-6 py-4 border-t border-slate-200 flex justify-end gap-2 bg-slate-50 rounded-b-2xl shrink-0">
                <button type="button" onclick="closeApprovalModal()"
                        class="inline-flex items-center gap-2 px-5 py-2.5 rounded-lg
                               bg-slate-100 text-slate-700 text-sm font-semibold
                               hover:bg-slate-200 transition">
                    Annuler
                </button>
                <button type="submit"
                        class="inline-flex items-center gap-2 px-5 py-2.5 rounded-lg
                               bg-emerald-600 text-white text-sm font-semibold
                               hover:bg-emerald-700 transition">
                    <span class="material-symbols-rounded text-[18px]">send</span>
                    Valider la décision
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    let currentDemandeId = null;

    function openApprovalModal(id, formateur, matricule) {
        currentDemandeId = id;

        const modal = document.getElementById('approvalModal');
        const form = document.getElementById('approvalForm');
        const formateurLabel = document.getElementById('modalFormateur');
        const matriculeLabel = document.getElementById('modalMatricule');

        // [!]️ NE PAS définir form.action ici - il sera défini au submit
        formateurLabel.textContent = formateur;
        matriculeLabel.textContent = matricule;

        // Réinitialiser
        form.querySelector('input[value="approuver"]').checked = true;
        document.getElementById('reponse_admin').value = '';

        modal.style.display = 'flex';
        document.body.style.overflow = 'hidden';
    }

    function closeApprovalModal() {
        document.getElementById('approvalModal').style.display = 'none';
        document.body.style.overflow = '';
        currentDemandeId = null;
    }

    // [AJAX] SOUMISSION : on définit l'URL au moment du submit
    document.getElementById('approvalForm')?.addEventListener('submit', function(e) {
        e.preventDefault();

        if (!currentDemandeId) {
            alert('Erreur : ID de demande manquant');
            return;
        }

        const decision = this.querySelector('input[name="decision"]:checked').value;
        const baseUrl = this.getAttribute('data-base-url');  // ex: http://localhost:8000/admin/demandes-affectations

        // URL correcte : /admin/demandes-affectations/{id}/{approuver|refuser}
        this.action = baseUrl + '/' + currentDemandeId + '/' + decision;

        console.log('[EXPORT] Envoi vers :', this.action);

        // Soumettre
        this.submit();
    });

    // Fermer avec Échap
    document.addEventListener('keydown', e => {
        if (e.key === 'Escape') closeApprovalModal();
    });
</script>

@endsection