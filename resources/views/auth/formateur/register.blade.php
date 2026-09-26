@extends('layouts.guest')

@section('title', 'Inscription Formateur')

@section('content')

<div class="flex" style="min-height: 100vh; height: 100vh;">

    <div class="hidden lg:block relative overflow-hidden flex-shrink-0"
     style="width: 55%; height: 100vh; min-height: 100vh; position: relative;">

    <img src="https://images.unsplash.com/photo-1523240795612-9a054b0db644?auto=format&fit=crop&w=1600&q=80"
         alt="Formation"
         style="position: absolute; top: 0; left: 0;
                width: 100%; height: 100%;
                object-fit: cover; object-position: center;">

    <div style="position: absolute; inset: 0;
                background: linear-gradient(135deg,
                    rgba(6, 78, 59, 0.92) 0%,
                    rgba(4, 120, 87, 0.85) 50%,
                    rgba(24, 24, 27, 0.92) 100%);"></div>

    <div style="position: absolute; inset: 0; opacity: 0.08;
                background-image:
                    linear-gradient(rgba(255,255,255,0.5) 1px, transparent 1px),
                    linear-gradient(90deg, rgba(255,255,255,0.5) 1px, transparent 1px);
                background-size: 60px 60px;"></div>

    <div class="relative z-10 flex flex-col justify-between text-white"
         style="height: 100vh; padding: 3rem; position: relative;">

        <div class="flex items-center gap-2"
             style="font-size: 11px; font-weight: 700;
                    letter-spacing: 0.14em; text-transform: uppercase;
                    color: #a7f3d0;">
            <span style="width: 24px; height: 1px; background: #6ee7b7;"></span>
            METFP · Madagascar
        </div>

        <div>
            <div style="width: 48px; height: 2px; background: #6ee7b7;
                        border-radius: 2px; margin-bottom: 2rem;"></div>

            <p class="font-display"
               style="font-size: 2.25rem; font-weight: 700;
                      line-height: 1.15; letter-spacing: -0.02em;
                      max-width: 32rem; color: white;">
                Rejoignez le réseau,
                <span style="color: #6ee7b7;">dès aujourd'hui.</span>
            </p>

            <p style="font-size: 15px; color: rgba(209, 250, 229, 0.85);
                      margin-top: 1.5rem; max-width: 28rem;
                      line-height: 1.6;">
                Créez votre compte formateur et accédez à vos affectations, sessions et profil.
            </p>
        </div>

        
            <div class="flex items-center"
                 style="gap: 1.5rem; padding-top: 1.5rem;
                        border-top: 1px solid rgba(255,255,255,0.15);">
                <div>
                    <div class="font-display"
                         style="font-size: 1.5rem; font-weight: 700; color: white;">
                        14+
                    </div>
                    <div style="font-size: 10px; color: #a7f3d0;
                                text-transform: uppercase; letter-spacing: 0.1em;
                                margin-top: 0.25rem;">
                        Établissements
                    </div>
                </div>
                <div style="width: 1px; height: 32px; background: rgba(255,255,255,0.2);"></div>
                <div>
                    <div class="font-display"
                         style="font-size: 1.5rem; font-weight: 700; color: white;">
                        80+
                    </div>
                    <div style="font-size: 10px; color: #a7f3d0;
                                text-transform: uppercase; letter-spacing: 0.1em;
                                margin-top: 0.25rem;">
                        Filières
                    </div>
                </div>
                <div style="width: 1px; height: 32px; background: rgba(255,255,255,0.2);"></div>
                <div>
                    <div class="font-display"
                         style="font-size: 1.5rem; font-weight: 700; color: white;">
                        5
                    </div>
                    <div style="font-size: 10px; color: #a7f3d0;
                                text-transform: uppercase; letter-spacing: 0.1em;
                                margin-top: 0.25rem;">
                        Niveaux
                    </div>
                </div>
            </div>
    </div>
</div>

    <div class="flex-1 flex flex-col overflow-y-auto" style="min-height: 100vh;">

        <div style="height: 3px; background: #059669;"></div>

        <header style="border-bottom: 1px solid #e4e4e7;">
            <div class="flex items-center justify-between"
                 style="padding: 0 2.5rem; height: 64px;">

                <a href="{{ route('home') }}" class="flex items-center" style="gap: 10px;">
                    <div class="flex items-center justify-center"
                         style="width: 32px; height: 32px;
                                background: #18181b; border-radius: 8px;">
                        <span class="material-symbols-rounded"
                              style="color: white; font-size: 18px;
                                     font-variation-settings: 'FILL' 1;">
                            school
                        </span>
                    </div>
                    <span style="font-weight: 700; color: #18181b;
                                 font-size: 15px; letter-spacing: -0.02em;">
                        SGFORMATEURS
                    </span>
                </a>

                <a href="{{ route('home') }}"
                   class="inline-flex items-center"
                   style="gap: 6px; font-size: 12px;
                          font-weight: 600; color: #71717a;">
                    <span class="material-symbols-rounded" style="font-size: 16px;">
                        arrow_back
                    </span>
                    Retour
                </a>
            </div>
        </header>

        <div class="flex-1 flex items-center justify-center"
             style="padding: 2.5rem 2rem;">

            <div class="w-full" style="max-width: 26rem;">

                <div class="label-caps">Créer un compte</div>
                <div class="rule-emerald" style="margin-top: 12px; margin-bottom: 20px;"></div>

                <h1 class="font-display"
                    style="font-size: 2.25rem; font-weight: 700;
                           color: #18181b; line-height: 1.05;
                           letter-spacing: -0.02em;">
                    Inscription.
                </h1>

                <p style="font-size: 14px; color: #71717a;
                          margin-top: 1rem; line-height: 1.6;">
                    Créez votre compte formateur en quelques minutes.
                </p>

                @if ($errors->any())
                    <div class="flex items-start"
                         style="margin-top: 2rem; gap: 12px;
                                padding: 1rem; border-radius: 12px;
                                background: #fef2f2;
                                border: 1px solid #fecaca;">
                        <span class="material-symbols-rounded"
                              style="color: #dc2626; font-size: 20px; flex-shrink: 0;">
                            error
                        </span>
                        <div style="font-size: 13px; color: #991b1b;
                                    line-height: 1.6;">
                            @foreach ($errors->all() as $error)
                                <div>{{ $error }}</div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <form action="{{ route('formateur.register') }}" method="POST"
                      style="margin-top: 2rem; display: flex;
                             flex-direction: column; gap: 1rem;">
                    @csrf

                    <div style="display: grid;
                                grid-template-columns: 1fr 1fr;
                                gap: 12px;">
                        <div>
                            <label for="nom" class="label-caps"
                                   style="display: block; margin-bottom: 8px;">
                                Nom
                            </label>
                            <input type="text" name="nom" id="nom"
                                   value="{{ old('nom') }}"
                                   placeholder="RAKOTO"
                                   required autocomplete="family-name"
                                   class="input-editorial">
                        </div>
                        <div>
                            <label for="prenom" class="label-caps"
                                   style="display: block; margin-bottom: 8px;">
                                Prénom
                            </label>
                            <input type="text" name="prenom" id="prenom"
                                   value="{{ old('prenom') }}"
                                   placeholder="Jean"
                                   required autocomplete="given-name"
                                   class="input-editorial">
                        </div>
                    </div>

                    <div>
                        <label for="email" class="label-caps"
                               style="display: block; margin-bottom: 8px;">
                            Email
                        </label>
                        <input type="email" name="email" id="email"
                               value="{{ old('email') }}"
                               placeholder="votre.email@metfp.mg"
                               required autocomplete="email"
                               class="input-editorial">
                    </div>

                    <div>
                        <label for="telephone" class="label-caps"
                               style="display: block; margin-bottom: 8px;">
                            Téléphone
                        </label>
                        <input type="tel" name="telephone" id="telephone"
                               value="{{ old('telephone') }}"
                               placeholder="+261 34 00 000 00"
                               autocomplete="tel"
                               class="input-editorial">
                    </div>

                    <div>
                        <label for="matricule" class="label-caps"
                               style="display: block; margin-bottom: 8px;">
                            Matricule
                        </label>
                        <input type="text" name="matricule" id="matricule"
                               value="{{ old('matricule') }}"
                               placeholder="FORM-001"
                               required
                               class="input-editorial"
                               style="font-family: ui-monospace, monospace;
                                      text-transform: uppercase;">
                    </div>

                    <div>
                        <label for="password" class="label-caps"
                               style="display: block; margin-bottom: 8px;">
                            Mot de passe
                        </label>
                        <input type="password" name="password" id="password"
                               placeholder="Min 8 caractères"
                               required autocomplete="new-password"
                               class="input-editorial">
                    </div>

                    <div>
                        <label for="password_confirmation" class="label-caps"
                               style="display: block; margin-bottom: 8px;">
                            Confirmation
                        </label>
                        <input type="password" name="password_confirmation"
                               id="password_confirmation"
                               placeholder="********"
                               required autocomplete="new-password"
                               class="input-editorial">
                    </div>

                    {{-- BOUTON VERT ÉMERAUDE --}}
                    <button type="submit"
                            class="w-full inline-flex items-center justify-center"
                            style="gap: 8px; padding: 14px 24px;
                                   border-radius: 12px;
                                   background: #059669; color: white;
                                   font-size: 14px; font-weight: 600;
                                   border: none; cursor: pointer;
                                   margin-top: 8px;
                                   transition: all 0.2s ease;">
                        Créer mon compte
                        <span class="material-symbols-rounded"
                              style="font-size: 18px;">
                            arrow_forward
                        </span>
                    </button>
                </form>

                <div class="flex items-center justify-between"
                     style="margin-top: 2rem; padding-top: 1.5rem;
                            border-top: 1px solid #e4e4e7;">
                    <p style="font-size: 12px; color: #71717a;">
                        Déjà un compte ?
                        <a href="{{ route('formateur.login') }}"
                           style="font-weight: 600; color: #059669;">
                            Se connecter
                        </a>
                    </p>
                    <a href="{{ route('admin.login') }}"
                       class="inline-flex items-center"
                       style="gap: 4px; font-size: 12px;
                              font-weight: 600; color: #71717a;">
                        Espace admin
                        <span class="material-symbols-rounded"
                              style="font-size: 14px;">
                            arrow_outward
                        </span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection