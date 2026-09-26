@extends('layouts.admin')
@section('title', 'Formateurs')

@section('content')

<div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-6">
    <div>
        <h1 class="font-display text-2xl font-bold text-slate-900">Formateurs</h1>
        <p class="text-sm text-slate-500 mt-1">Liste de tous les formateurs du réseau</p>
    </div>
    <button type="button" onclick="openFormateurModal()" class="btn-primary">
        <span class="material-symbols-rounded text-[18px]">add</span>
        Ajouter un formateur
    </button>
</div>

<div class="bg-white rounded-xl border border-slate-200 p-4 mb-4">
    <form method="GET" class="grid grid-cols-1 md:grid-cols-5 gap-3">
        <div class="relative md:col-span-2">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Rechercher un formateur..." class="form-input pl-10">
        </div>
        <select name="etablissement_id" class="form-input">
            <option value="">Tous les établissements</option>
            @foreach($etablissements ?? [] as $e)
                <option value="{{ $e->id }}" @selected(request('etablissement_id') == $e->id)>{{ $e->nom }}</option>
            @endforeach
        </select>
        <select name="statut" class="form-input">
            <option value="">Tous les statuts</option>
            <option value="actif" @selected(request('statut') === 'actif')>Actif</option>
            <option value="inactif" @selected(request('statut') === 'inactif')>Inactif</option>
            <option value="suspendu" @selected(request('statut') === 'suspendu')>Suspendu</option>
        </select>
        <div class="flex items-center gap-2">
            <button type="submit" class="btn-primary">Filtrer</button>
            <a href="{{ route('admin.formateurs.index') }}" class="btn-secondary">Reset</a>
        </div>
    </form>
</div>

<div class="bg-white rounded-xl border border-slate-200 overflow-hidden">
    <table class="table-modern">
        <thead>
            <tr>
                <th>Matricule</th>
                <th>Nom complet</th>
                <th>Établissement</th>
                <th>Filière</th>
                <th>Statut</th>
                <th class="text-right">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($formateurs ?? [] as $f)
            <tr>
                <td class="font-mono text-xs">{{ $f->matricule }}</td>
                <td class="font-semibold">
                    <a href="{{ route('admin.formateurs.show', $f->id) }}" class="hover:text-brand-700">{{ $f->nom }} {{ $f->prenom }}</a>
                </td>
                <td>{{ $f->etablissement->nom ?? '-' }}</td>
                <td class="text-xs">{{ $f->filiere->libelle ?? '-' }}</td>
                <td>
                    @if(($f->statut ?? 'actif') === 'actif')
                        <span class="badge-success">Actif</span>
                    @elseif(($f->statut ?? '') === 'suspendu')
                        <span class="badge-warning">Suspendu</span>
                    @else
                        <span class="badge-danger">Inactif</span>
                    @endif
                </td>
                <td>
                    <div class="flex items-center justify-end gap-1">
                        <a href="{{ route('admin.formateurs.show', $f->id) }}" class="w-8 h-8 rounded-lg flex items-center justify-center text-slate-500 hover:bg-brand-50">
                            <span class="material-symbols-rounded text-[18px]">visibility</span>
                        </a>
                        <a href="{{ route('admin.formateurs.edit', $f->id) }}" class="w-8 h-8 rounded-lg flex items-center justify-center text-slate-500 hover:bg-brand-50">
                            <span class="material-symbols-rounded text-[18px]">edit</span>
                        </a>
                        <form action="{{ route('admin.formateurs.destroy', $f->id) }}" method="POST" class="inline" onsubmit="return confirm('Supprimer ?')">
                            @csrf @method('DELETE')
                            <button class="w-8 h-8 rounded-lg flex items-center justify-center text-slate-500 hover:bg-red-50">
                                <span class="material-symbols-rounded text-[18px]">delete</span>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr><td colspan="6" class="text-center py-16 text-slate-400">Aucun formateur trouvé</td></tr>
            @endforelse
        </tbody>
    </table>
    <div class="px-4 py-3 border-t border-slate-200 flex justify-between items-center text-xs text-slate-500">
        <span>Total : {{ $formateurs->total() ?? 0 }} formateurs</span>
        <div>{{ $formateurs->links() }}</div>
    </div>
</div>

{{-- ========== MODAL AJOUTER (z-index MAX) ========== --}}
<div id="formateurModal" class="hidden"
     style="display: none; position: fixed !important; inset: 0 !important; z-index: 2147483647 !important; align-items: center; justify-content: center; padding: 1rem;"
     onclick="if(event.target === this) closeFormateurModal()">

    <div class="absolute inset-0 bg-black/60 backdrop-blur-sm" style="z-index: 1;"></div>

    <div class="relative bg-white rounded-2xl shadow-2xl w-full max-w-2xl flex flex-col"
         style="z-index: 2; max-height: calc(100vh - 2rem);">

        <div class="px-6 py-4 border-b border-slate-200 flex items-center justify-between shrink-0">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-brand-500 to-brand-700 flex items-center justify-center shadow-md">
                    <span class="material-symbols-rounded text-white text-xl" style="font-variation-settings: 'FILL' 1;">person_add</span>
                </div>
                <div>
                    <h2 class="font-display text-lg font-bold text-slate-900">Ajouter un formateur</h2>
                    <p class="text-xs text-slate-500 mt-0.5">Le statut sera propagé à toutes les tables liées</p>
                </div>
            </div>
            <button type="button" onclick="closeFormateurModal()"
                    class="w-9 h-9 rounded-lg flex items-center justify-center text-slate-400 hover:bg-slate-100 hover:text-slate-700 transition">
                <span class="material-symbols-rounded text-[20px]">close</span>
            </button>
        </div>

        <form id="formateurForm" method="POST" action="{{ route('admin.formateurs.store') }}"
              class="flex flex-col flex-1 min-h-0">
            @csrf

            <div id="formateurFormContent"
                 class="flex-1 min-h-0 overflow-y-auto overflow-x-hidden px-6 py-5">
                <div class="text-center py-16 text-slate-400">
                    <span class="material-symbols-rounded text-4xl animate-spin block mb-3">progress_activity</span>
                    <p class="text-sm">Chargement du formulaire...</p>
                </div>
            </div>

            <div class="px-6 py-4 border-t border-slate-200 flex items-center justify-end gap-2 bg-slate-50 rounded-b-2xl shrink-0">
                <button type="button" onclick="closeFormateurModal()" class="btn-secondary">Annuler</button>
                <button type="submit" class="btn-primary" id="submitBtn">
                    <span class="material-symbols-rounded text-[18px]">save</span>
                    Enregistrer
                </button>
            </div>
        </form>
    </div>
</div>

<style>
    /* ===== MODAL AU-DESSUS DE TOUT ===== */
    #formateurModal:not(.hidden) {
        display: flex !important;
    }

    #formateurModal > .absolute {
        z-index: 1 !important;
    }

    #formateurModal > .relative {
        z-index: 2 !important;
        position: relative;
    }

    #formateurForm {
        display: flex;
        flex-direction: column;
        flex: 1 1 auto;
        min-height: 0;
        overflow: hidden;
    }

    #formateurFormContent {
        flex: 1 1 auto;
        min-height: 0;
        overflow-y: auto;
        overflow-x: hidden;
        scroll-behavior: smooth;
    }

    #formateurFormContent::-webkit-scrollbar { width: 8px; }
    #formateurFormContent::-webkit-scrollbar-track { background: #f1f5f9; border-radius: 4px; }
    #formateurFormContent::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 4px; }
    #formateurFormContent::-webkit-scrollbar-thumb:hover { background: #94a3b8; }

    /* ===== BLOQUER TOUT LE RESTE ===== */
    body.modal-open {
        overflow: hidden !important;
    }

    body.modal-open > *:not(#formateurModal) {
        pointer-events: none !important;
        user-select: none !important;
    }

    body.modal-open #formateurModal,
    body.modal-open #formateurModal * {
        pointer-events: auto !important;
        user-select: auto !important;
    }
</style>

<script>
    console.log('[OK] Script formateur chargé');

    let savedScrollPosition = 0;

    function openFormateurModal() {
        console.log('[BLUE] Ouverture modal');
        const modal = document.getElementById('formateurModal');
        if (!modal) return;

        savedScrollPosition = window.scrollY || document.documentElement.scrollTop;

        modal.style.display = 'flex';
        modal.classList.remove('hidden');

        document.body.classList.add('modal-open');
        document.body.style.position = 'fixed';
        document.body.style.top = `-${savedScrollPosition}px`;
        document.body.style.left = '0';
        document.body.style.right = '0';
        document.body.style.width = '100%';

        fetch('{{ route("admin.formateurs.create") }}', {
            headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' }
        })
        .then(r => r.json())
        .then(data => {
            console.log('[BOX] Formulaire chargé');
            document.getElementById('formateurFormContent').innerHTML = data.html;
        })
        .catch(err => {
            console.error('[X] Erreur chargement:', err);
            document.getElementById('formateurFormContent').innerHTML =
                '<div class="text-center py-12 text-red-500">Erreur : ' + err.message + '</div>';
        });
    }

    function closeFormateurModal() {
        console.log('[RED] Fermeture modal');
        const modal = document.getElementById('formateurModal');
        if (!modal) return;

        modal.classList.add('hidden');
        modal.style.display = 'none';

        document.body.classList.remove('modal-open');
        document.body.style.position = '';
        document.body.style.top = '';
        document.body.style.left = '';
        document.body.style.right = '';
        document.body.style.width = '';

        window.scrollTo(0, savedScrollPosition);
    }

    // =====================================================
    // DÉLÉGATION SUR LE CLIC DU BOUTON ENREGISTRER (principal)
    // =====================================================
    document.addEventListener('click', function(e) {
        const btn = e.target.closest('#submitBtn');
        if (!btn) return;

        e.preventDefault();
        console.log('🖱️ Clic sur Enregistrer détecté');

        const form = document.getElementById('formateurForm');
        if (!form) {
            console.error('[X] Formulaire introuvable');
            return;
        }

        const submitBtn = document.getElementById('submitBtn');
        const originalText = submitBtn.innerHTML;

        submitBtn.disabled = true;
        submitBtn.innerHTML = '<span class="material-symbols-rounded text-[18px] animate-spin">progress_activity</span> Enregistrement...';

        const formData = new FormData(form);

        fetch(form.action, {
            method: 'POST',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
            },
            body: formData,
        })
        .then(r => {
            console.log('📡 Réponse HTTP:', r.status);
            return r.json();
        })
        .then(data => {
            console.log('[BOX] Data reçue:', data);

            if (data.success) {
                console.log('[OK] Succès - Redirection vers:', data.redirect);
                window.location.href = data.redirect;
            } else {
                alert(data.message || 'Erreur');
                submitBtn.disabled = false;
                submitBtn.innerHTML = originalText;
            }
        })
        .catch(err => {
            console.error('[X] Erreur:', err);
            alert('Erreur lors de l\'enregistrement : ' + err.message);
            submitBtn.disabled = false;
            submitBtn.innerHTML = originalText;
        });
    });

    // =====================================================
    // DÉLÉGATION SUR LE SUBMIT (fallback)
    // =====================================================
    document.addEventListener('submit', function(e) {
        const form = e.target;
        if (form.id !== 'formateurForm') return;

        e.preventDefault();
        console.log('[EXPORT] Soumission AJAX détectée (submit)');
    });

    // Fermer avec Échap
    document.addEventListener('keydown', e => {
        if (e.key === 'Escape') {
            const modal = document.getElementById('formateurModal');
            if (modal && !modal.classList.contains('hidden')) {
                closeFormateurModal();
            }
        }
    });
</script>


@include('admin.formateurs.partials.modal-create')
@endsection