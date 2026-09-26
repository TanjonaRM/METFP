<div class="space-y-6">
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Code *</label>
        <input type="text" name="code" value="{{ old('code', $secteur->code ?? '') }}" class="input-modern" placeholder="ex: IND" required>
        @error('code') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Libellé *</label>
        <input type="text" name="libelle" value="{{ old('libelle', $secteur->libelle ?? '') }}" class="input-modern" required>
        @error('libelle') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
    </div>
</div>