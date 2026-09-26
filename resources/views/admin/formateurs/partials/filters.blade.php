<form action="{{ route('admin.formateurs.index') }}" method="GET" class="bg-white rounded-2xl shadow-soft p-4 md:p-6 mb-6 border border-gray-100">
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
        <div class="relative">
            <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-lg">search</span>
            <input type="text" name="search" placeholder="Rechercher..." value="{{ request('search') }}"
                   class="input-modern pl-10">
        </div>
        <div>
            <select name="etablissement_id" class="input-modern">
                <option value="">Tous les établissements</option>
                @foreach($etablissements ?? [] as $etablissement)
                    <option value="{{ $etablissement->id }}" {{ request('etablissement_id') == $etablissement->id ? 'selected' : '' }}>
                        {{ $etablissement->nom }}
                    </option>
                @endforeach
            </select>
        </div>
        <div>
            <select name="statut" class="input-modern">
                <option value="">Tous les statuts</option>
                <option value="actif" {{ request('statut') == 'actif' ? 'selected' : '' }}>Actif</option>
                <option value="inactif" {{ request('statut') == 'inactif' ? 'selected' : '' }}>Inactif</option>
            </select>
        </div>
        <div class="flex gap-2">
            <button type="submit" class="btn-primary text-sm flex-1">
                <span class="material-symbols-outlined text-lg">search</span>
                Filtrer
            </button>
            <a href="{{ route('admin.formateurs.index') }}" class="btn-outline-primary text-sm">
                <span class="material-symbols-outlined text-lg">filter_alt_off</span>
            </a>
        </div>
    </div>
</form>