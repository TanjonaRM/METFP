<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <div class="md:col-span-2">
        <label class="block text-sm font-medium text-gray-700 mb-1">Libellé *</label>
        <input type="text" name="libelle" value="{{ old('libelle', $niveau->libelle ?? '') }}" class="input-modern" required>
        @error('libelle') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Code *</label>
        <input type="text" name="code" value="{{ old('code', $niveau->code ?? '') }}" class="input-modern" placeholder="ex: BAC" required>
        @error('code') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
    </div>

    <div class="md:col-span-2">
        <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
        <textarea name="description" rows="3" class="input-modern">{{ old('description', $niveau->description ?? '') }}</textarea>
        @error('description') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
    </div>
</div>