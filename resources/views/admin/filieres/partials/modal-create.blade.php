{{-- Modal "Ajouter Filiere" - style dashboard vert émeraude --}}

<div id="modalCreateFiliere"
     class="hidden fixed inset-0 z-50 flex items-center justify-center p-4">

    {{-- Overlay --}}
    <div class="absolute inset-0 bg-slate-900/50 backdrop-blur-sm"
         onclick="closeFiliereModal()"></div>

    {{-- Boîte --}}
    <div class="relative bg-white rounded-2xl shadow-2xl w-full max-w-3xl
                max-h-[90vh] flex flex-col">

        {{-- Header --}}
        <div class="flex items-start justify-between px-6 py-5 border-b border-slate-200">
            <div class="flex items-center gap-3">
                <div class="w-11 h-11 rounded-xl bg-emerald-600 flex items-center justify-center shrink-0">
                    <span class="material-symbols-rounded text-white text-[24px]">add</span>
                </div>
                <div>
                    <h2 class="font-display text-lg font-bold text-slate-900">
                        Ajouter un filieres
                    </h2>
                    <p class="text-xs text-slate-500 mt-0.5">
                        Remplissez les informations ci-dessous
                    </p>
                </div>
            </div>
            <button type="button"
                    onclick="closeFiliereModal()"
                    class="p-2 -mt-1 -mr-1 rounded-lg text-slate-400 hover:text-slate-700 hover:bg-slate-100 transition">
                <span class="material-symbols-rounded text-[22px]">close</span>
            </button>
        </div>

        {{-- Body --}}
        <form id="formFiliere"
              method="POST"
              action="{{ route('admin.filieres.store') }}"
              class="flex-1 flex flex-col min-h-0">
            @csrf

            <div id="FiliereFormContent"
                 class="flex-1 overflow-y-auto px-6 py-5">
                <div class="text-center py-16 text-slate-400">
                    <span class="material-symbols-rounded text-4xl animate-spin block mb-3">progress_activity</span>
                    <p class="text-sm">Chargement du formulaire...</p>
                </div>
            </div>

            {{-- Footer --}}
            <div class="flex items-center justify-end gap-3 px-6 py-4 border-t border-slate-200 bg-slate-50 rounded-b-2xl">
                <button type="button"
                        onclick="closeFiliereModal()"
                        class="px-4 py-2 text-sm font-medium text-slate-700 bg-white
                               border border-slate-300 rounded-lg hover:bg-slate-50 transition">
                    Annuler
                </button>
                <button type="submit"
                        id="submitFiliereBtn"
                        class="inline-flex items-center gap-2 px-4 py-2 text-sm font-semibold text-white
                               bg-emerald-600 rounded-lg hover:bg-emerald-700 transition">
                    <span class="material-symbols-rounded text-[18px]">save</span>
                    Enregistrer
                </button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
    function openFiliereModal() {
        const modal = document.getElementById('modalCreateFiliere');
        if (!modal) return;
        modal.classList.remove('hidden');
        document.body.style.overflow = 'hidden';

        fetch('{{ route("admin.filieres.create") }}', {
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json'
            },
            credentials: 'same-origin'
        })
        .then(r => r.json())
        .then(data => {
            document.getElementById('FiliereFormContent').innerHTML = data.html;
        })
        .catch(err => {
            console.error('[X] Erreur :', err);
            document.getElementById('FiliereFormContent').innerHTML =
                '<div class="text-center py-12 text-red-500">Erreur : ' + err.message + '</div>';
        });
    }

    function closeFiliereModal() {
        const modal = document.getElementById('modalCreateFiliere');
        if (!modal) return;
        modal.classList.add('hidden');
        document.body.style.overflow = '';
    }

    document.addEventListener('keydown', e => {
        if (e.key === 'Escape') closeFiliereModal();
    });

    document.addEventListener('submit', function(e) {
        if (e.target.id !== 'formFiliere') return;
        e.preventDefault();

        const form = e.target;
        const btn = document.getElementById('submitFiliereBtn');
        const originalText = btn.innerHTML;

        btn.disabled = true;
        btn.innerHTML = '<span class="material-symbols-rounded text-[18px] animate-spin">progress_activity</span> Enregistrement...';

        fetch(form.action, {
            method: 'POST',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: new FormData(form)
        })
        .then(r => r.json())
        .then(data => {
            if (data.success || data.redirect) {
                window.location.href = data.redirect || window.location.href;
            } else {
                btn.disabled = false;
                btn.innerHTML = originalText;
                alert(data.message || 'Erreur');
            }
        })
        .catch(err => {
            console.error('[X] Erreur :', err);
            btn.disabled = false;
            btn.innerHTML = originalText;
            alert('Erreur lors de l\'enregistrement');
        });
    });
</script>
@endpush