<div class="space-y-5">

    {{-- Identité --}}
    <div class="bg-white border-2 border-slate-300 rounded-lg p-5">
        <div class="flex items-center gap-2 pb-3 mb-4 border-b-2 border-slate-200">
            <span class="material-symbols-rounded text-brand-700 text-lg">person</span>
            <h3 class="text-sm font-bold text-brand-700 uppercase tracking-wide">Identité</h3>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-semibold text-slate-900 mb-1.5">Nom <span class="text-red-600">*</span></label>
                <input type="text" name="nom" value="{{ old('nom', $user->nom ?? '') }}"
                       class="w-full px-4 py-3 text-base border-2 border-slate-300 rounded-md focus:outline-none focus:border-brand-700 focus:ring-4 focus:ring-brand-100"
                       required>
                @error('nom') <p class="text-sm text-red-600 mt-1.5">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-900 mb-1.5">Prénom <span class="text-red-600">*</span></label>
                <input type="text" name="prenom" value="{{ old('prenom', $user->prenom ?? '') }}"
                       class="w-full px-4 py-3 text-base border-2 border-slate-300 rounded-md focus:outline-none focus:border-brand-700 focus:ring-4 focus:ring-brand-100"
                       required>
                @error('prenom') <p class="text-sm text-red-600 mt-1.5">{{ $message }}</p> @enderror
            </div>
        </div>
    </div>

    {{-- Compte --}}
    <div class="bg-white border-2 border-slate-300 rounded-lg p-5">
        <div class="flex items-center gap-2 pb-3 mb-4 border-b-2 border-slate-200">
            <span class="material-symbols-rounded text-brand-700 text-lg">mail</span>
            <h3 class="text-sm font-bold text-brand-700 uppercase tracking-wide">Compte</h3>
        </div>

        <div class="space-y-4">
            <div>
                <label class="block text-sm font-semibold text-slate-900 mb-1.5">Email <span class="text-red-600">*</span></label>
                <input type="email" name="email" value="{{ old('email', $user->email ?? '') }}"
                       class="w-full px-4 py-3 text-base border-2 border-slate-300 rounded-md focus:outline-none focus:border-brand-700 focus:ring-4 focus:ring-brand-100"
                       required>
                @error('email') <p class="text-sm text-red-600 mt-1.5">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-900 mb-1.5">
                    Mot de passe {{ isset($user) ? '(laisser vide pour ne pas changer)' : '*' }}
                </label>
                <input type="password" name="password"
                       class="w-full px-4 py-3 text-base border-2 border-slate-300 rounded-md focus:outline-none focus:border-brand-700 focus:ring-4 focus:ring-brand-100"
                       {{ isset($user) ? '' : 'required' }}>
                @error('password') <p class="text-sm text-red-600 mt-1.5">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-900 mb-1.5">Confirmer le mot de passe</label>
                <input type="password" name="password_confirmation"
                       class="w-full px-4 py-3 text-base border-2 border-slate-300 rounded-md focus:outline-none focus:border-brand-700 focus:ring-4 focus:ring-brand-100">
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-900 mb-1.5">Rôle <span class="text-red-600">*</span></label>
                <select name="role" class="w-full px-4 py-3 text-base border-2 border-slate-300 rounded-md focus:outline-none focus:border-brand-700 focus:ring-4 focus:ring-brand-100" required>
                    <option value="admin" @selected(old('role', $user->role ?? 'admin') === 'admin')>Admin</option>
                    <option value="gestionnaire" @selected(old('role', $user->role ?? '') === 'gestionnaire')>Gestionnaire</option>
                    <option value="super_admin" @selected(old('role', $user->role ?? '') === 'super_admin')>Super Admin</option>
                </select>
                @error('role') <p class="text-sm text-red-600 mt-1.5">{{ $message }}</p> @enderror
            </div>
        </div>
    </div>

</div>