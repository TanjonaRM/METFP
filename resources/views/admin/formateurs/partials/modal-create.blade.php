{{-- Modal : Ajouter un formateur --}}
<div id="modalCreateFormateur"
     class="hidden fixed inset-0 z-50 overflow-y-auto"
     role="dialog"
     aria-modal="true">

    {{-- Overlay --}}
    <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm"
         onclick="closeFormateurModal()"></div>

    {{-- Contenu --}}
    <div class="relative min-h-screen flex items-center justify-center p-4">
        <div class="relative bg-white rounded-2xl shadow-2xl max-w-4xl w-full max-h-[90vh] overflow-hidden flex flex-col">

            {{-- Header --}}
            <div class="flex items-center justify-between px-6 py-4 border-b border-slate-200 bg-slate-50">
                <div class="flex items-center gap-3">
                    <span class="material-symbols-rounded text-brand-700 text-[28px]">person_add</span>
                    <div>
                        <h2 class="font-display text-lg font-bold text-slate-900">Ajouter un formateur</h2>
                        <p class="text-xs text-slate-500">Remplissez les informations ci-dessous</p>
                    </div>
                </div>
                <button type="button" onclick="closeFormateurModal()"
                        class="p-2 rounded-lg hover:bg-slate-200 transition">
                    <span class="material-symbols-rounded text-slate-600">close</span>
                </button>
            </div>

            {{-- Body (formulaire scrollable) --}}
            <form method="POST"
                  action="{{ route('admin.formateurs.store') }}"
                  class="flex-1 overflow-y-auto">
                @csrf

                <div class="px-6 py-5">
                    @include('admin.formateurs.partials.form', [
                        'etablissements' => $etablissements ?? [],
                        'filieres' => $filieres ?? [],
                    ])
                </div>

                {{-- Footer --}}
                <div class="flex items-center justify-end gap-2 px-6 py-4 border-t border-slate-200 bg-slate-50">
                    <button type="button" onclick="closeFormateurModal()" class="btn-secondary">
                        Annuler
                    </button>
                    <button type="submit" class="btn-primary">
                        <span class="material-symbols-rounded text-[18px]">save</span>
                        Enregistrer
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Script du modal --}}
@push('scripts')
<script>
    function openFormateurModal() {
        const modal = document.getElementById('modalCreateFormateur');
        if (!modal) { console.error('Modal #modalCreateFormateur introuvable'); return; }
        modal.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }
    function closeFormateurModal() {
        const modal = document.getElementById('modalCreateFormateur');
        if (!modal) return;
        modal.classList.add('hidden');
        document.body.style.overflow = '';
    }
    // Fermer avec ESC
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') closeFormateurModal();
    });
    // Ouvrir automatiquement si erreurs de validation
    @if($errors->any())
        document.addEventListener('DOMContentLoaded', openFormateurModal);
    @endif
</script>
@endpush