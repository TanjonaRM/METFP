@php
    $grades = [
        'Assistant', 'Assistant Principal', 'Maitre-Assistant',
        'Maitre de Conferences', 'Professeur Habilité',
        'Professeur de l\'Enseignement Supérieur', 'Professeur Titulaire',
        'Vacataire', 'Contractuel',
    ];
@endphp

<style>
    .form-field { width:100%; padding:0.75rem 1rem; font-size:0.9375rem; line-height:1.5; color:#0f172a; background-color:#fff; border:1.5px solid #e2e8f0; border-radius:0.5rem; transition:all 0.15s ease; font-family:inherit; }
    .form-field::placeholder { color:#94a3b8; }
    .form-field:focus { outline:none; border-color:#059669; box-shadow:0 0 0 3px rgba(5,150,105,0.12); }
    .form-field:read-only, .form-field:disabled { background-color:#f8fafc; color:#64748b; cursor:not-allowed; }
    .form-label { display:block; font-size:0.875rem; font-weight:600; color:#1e293b; margin-bottom:0.375rem; }
    .form-label .required { color:#ef4444; margin-left:0.125rem; }
    .form-hint { font-size:0.75rem; color:#64748b; margin-top:0.375rem; }
    .form-card { background-color:#fff; border:1.5px solid #e2e8f0; border-radius:0.75rem; padding:1.25rem; }
    .form-card + .form-card { margin-top:1rem; }
    .form-card-header { display:flex; align-items:center; gap:0.5rem; margin-bottom:1rem; padding-bottom:0.75rem; border-bottom:1px dashed #e2e8f0; }
    .form-card-icon { width:1.75rem; height:1.75rem; display:inline-flex; align-items:center; justify-content:center; background:#d1fae5; color:#059669; border-radius:0.5rem; font-size:1.125rem; }
    .form-card-title { font-size:0.8125rem; font-weight:700; color:#059669; text-transform:uppercase; letter-spacing:0.05em; }
    .form-error { font-size:0.75rem; color:#ef4444; margin-top:0.25rem; }
</style>

<div class="space-y-4">

    <div class="form-card">
        <div class="form-card-header">
            <span class="form-card-icon material-symbols-rounded">badge</span>
            <span class="form-card-title">Identité</span>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="md:col-span-2">
                <label class="form-label">Matricule <span class="required">*</span> <span class="text-xs font-normal text-emerald-600 ml-1">(auto-généré)</span></label>
                <input class="text-black font-medium font-mono font-semibold bg-slate-50 cursor-not-allowed" type="text" name="matricule" readonly value="{{ old('matricule', $formateur->matricule ?? ($nextMatricule ?? '')) }}" class="form-field font-mono" readonly required>
                @error('matricule') <p class="form-error">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="form-label">Nom <span class="required">*</span></label>
                <input type="text" name="nom" value="{{ old('nom', $formateur->nom ?? '') }}" class="form-field" placeholder="Ex: RAKOTO" required>
                @error('nom') <p class="form-error">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="form-label">Prénom <span class="required">*</span></label>
                <input type="text" name="prenom" value="{{ old('prenom', $formateur->prenom ?? '') }}" class="form-field" placeholder="Ex: Jean" required>
                @error('prenom') <p class="form-error">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="form-label">Sexe</label>
                <select name="sexe" class="form-field">
                    <option value="">- Sélectionner -</option>
                    <option value="Masculin" @selected(old('sexe', $formateur->sexe ?? '') === 'Masculin')>Masculin</option>
                    <option value="Feminin" @selected(old('sexe', $formateur->sexe ?? '') === 'Feminin')>Féminin</option>
                </select>
            </div>
            <div>
                <label class="form-label">CIN</label>
                <input type="text" name="cin" value="{{ old('cin', $formateur->cin ?? '') }}" class="form-field" placeholder="Ex: 101234567890">
            </div>
            <div class="md:col-span-2">
                <label class="form-label">Date de naissance</label>
                <input type="date" name="date_naissance" value="{{ old('date_naissance', isset($formateur) && $formateur->date_naissance ? $formateur->date_naissance->format('Y-m-d') : '') }}" class="form-field">
            </div>
        </div>
    </div>

    <div class="form-card">
        <div class="form-card-header">
            <span class="form-card-icon material-symbols-rounded">toggle_on</span>
            <span class="form-card-title">Statut global</span>
        </div>
        <div>
            <label class="form-label">Statut <span class="required">*</span></label>
            <select name="statut" class="form-field" required>
                <option value="actif" @selected(old('statut', $formateur->statut ?? 'actif') === 'actif')>Actif - Le formateur est en activité</option>
                <option value="inactif" @selected(old('statut', $formateur->statut ?? '') === 'inactif')>Inactif - Le formateur a terminé</option>
                <option value="suspendu" @selected(old('statut', $formateur->statut ?? '') === 'suspendu')>Suspendu - Le formateur est en pause</option>
            </select>
            <p class="form-hint">Ce statut sera appliqué au formateur, ses affectations, sessions, établissement et filière</p>
            @error('statut') <p class="form-error">{{ $message }}</p> @enderror
        </div>
    </div>

    <div class="form-card">
        <div class="form-card-header">
            <span class="form-card-icon material-symbols-rounded">link</span>
            <span class="form-card-title">Affectation</span>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="md:col-span-2">
                <label class="form-label">Établissement</label>
                <select name="etablissement_id" class="form-field">
                    <option value="">- Aucun -</option>
                    @foreach($etablissements ?? [] as $etablissement)
                        <option value="{{ $etablissement->id }}" @selected(old('etablissement_id', $formateur->etablissement_id ?? '') == $etablissement->id)>{{ $etablissement->nom }}</option>
                    @endforeach
                </select>
            </div>
            <div class="md:col-span-2">
                <label class="form-label">Filière</label>
                <select name="filiere_id" class="form-field">
                    <option value="">- Aucune -</option>
                    @foreach($filieres ?? [] as $filiere)
                        <option value="{{ $filiere->id }}" @selected(old('filiere_id', $formateur->filiere_id ?? '') == $filiere->id)>{{ $filiere->libelle }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="form-label">Grade <span class="required">*</span></label>
                <select name="grade" class="form-field" required>
                    <option value="">- Sélectionner -</option>
                    @foreach($grades as $g)
                        <option value="{{ $g }}" @selected(old('grade', $formateur->grade ?? '') === $g)>{{ $g }}</option>
                    @endforeach
                </select>
                @error('grade') <p class="form-error">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="form-label">Date de recrutement</label>
                <input type="date" name="date_recrutement" value="{{ old('date_recrutement', isset($formateur) && $formateur->date_recrutement ? $formateur->date_recrutement->format('Y-m-d') : '') }}" class="form-field">
            </div>
        </div>
    </div>

    <div class="form-card">
        <div class="form-card-header">
            <span class="form-card-icon material-symbols-rounded">contact_mail</span>
            <span class="form-card-title">Coordonnées</span>
        </div>
        <div class="grid grid-cols-1 gap-4">
            <div>
                <label class="form-label">Email <span class="required">*</span></label>
                <input type="email" name="email" value="{{ old('email', $formateur->email ?? '') }}" class="form-field" placeholder="Ex: jean.rakoto@example.com" required>
                @error('email') <p class="form-error">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="form-label">Téléphone</label>
                <input type="text" name="telephone" value="{{ old('telephone', $formateur->telephone ?? '') }}" class="form-field" placeholder="Ex: 034 12 345 67">
            </div>
            <div>
                <label class="form-label">Adresse</label>
                <input type="text" name="adresse" value="{{ old('adresse', $formateur->adresse ?? '') }}" class="form-field" placeholder="Ex: Lot II M 45 Bis, Antananarivo">
            </div>
        </div>
    </div>

</div>