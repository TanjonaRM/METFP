@extends('layouts.guest')

@section('title', 'Bienvenue - SGFORMATEURS')

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
                La gestion des formateurs,
                <span style="color: #6ee7b7;">simplifiée.</span>
            </p>

            <p style="font-size: 15px; color: rgba(209, 250, 229, 0.85);
                      margin-top: 1.5rem; max-width: 28rem;
                      line-height: 1.6;">
                Une plateforme centralisée pour piloter l'ensemble du réseau de formation professionnelle.
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

    {{-- COLONNE DROITE : BLANC --}}
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

                <span class="hidden sm:inline-flex items-center"
                      style="gap: 8px; font-size: 11px; font-weight: 700;
                             letter-spacing: 0.14em; text-transform: uppercase;
                             color: #71717a;">
                    <span style="width: 24px; height: 1px; background: #d4d4d8;"></span>
                    METFP
                </span>
            </div>
        </header>

        <div class="flex-1 flex items-center justify-center"
             style="padding: 2.5rem 2rem;">
            <div class="w-full" style="max-width: 32rem;">

                <div class="label-caps">Plateforme officielle</div>
                <div class="rule-emerald" style="margin-top: 12px; margin-bottom: 20px;"></div>

                <h1 class="font-display"
                    style="font-size: 2.5rem; font-weight: 700;
                           color: #18181b; line-height: 1.05;
                           letter-spacing: -0.03em;">
                    Système de<br>
                    Gestion des<br>
                    <span style="color: #059669;">Formateurs.</span>
                </h1>

                <p style="font-size: 14px; color: #52525b;
                          margin-top: 1.25rem; line-height: 1.7;
                          max-width: 26rem;">
                    Plateforme officielle du Ministère de l'Enseignement
                    Technique et de la Formation Professionnelle.
                </p>

                <div style="margin-top: 2rem; padding-top: 1.75rem;
                            border-top: 1px solid #e4e4e7;">
                    <div class="label-caps" style="margin-bottom: 0.75rem;">Objectif</div>
                    <p style="font-size: 14px; color: #3f3f46; line-height: 1.7;">
                        Centraliser la gestion des
                        <span style="color: #059669; font-weight: 600;">formateurs</span>
                        et de leur écosystème : établissements, filières,
                        affectations, sessions et rapports.
                    </p>
                </div>

                <div style="margin-top: 2rem; padding-top: 1.75rem;
                            border-top: 1px solid #e4e4e7;">
                    <div class="label-caps" style="margin-bottom: 1rem;">Accès</div>

                    <div style="display: flex; flex-direction: column; gap: 12px;">

                        {{-- CONNEXION : BOUTON VERT ÉMERAUDE --}}
                        <a href="{{ route('admin.login') }}"
                           class="flex items-center justify-between"
                           style="gap: 16px; padding: 16px 24px;
                                  border-radius: 12px;
                                  background: #059669; color: white;
                                  transition: all 0.2s ease;">
                            <div class="flex items-center" style="gap: 16px;">
                                <span class="material-symbols-rounded"
                                      style="color: #ffffff; font-size: 22px;
                                             font-variation-settings: 'FILL' 1;">
                                    login
                                </span>
                                <div style="text-align: left;">
                                    <div style="font-weight: 600; font-size: 15px;">
                                        Connexion
                                    </div>
                                    <div style="font-size: 12px;
                                                color: rgba(255,255,255,0.75);
                                                margin-top: 2px;">
                                        Accédez à votre espace
                                    </div>
                                </div>
                            </div>
                            <span class="material-symbols-rounded"
                                  style="color: rgba(255,255,255,0.8); font-size: 20px;">
                                arrow_forward
                            </span>
                        </a>

                        {{-- INSCRIPTION : BOUTON VERT OUTLINE --}}
                        <a href="{{ route('formateur.register') }}"
                           class="flex items-center justify-between"
                           style="gap: 16px; padding: 16px 24px;
                                  border-radius: 12px;
                                  background: white;
                                  border: 2px solid #059669;
                                  transition: all 0.2s ease;">
                            <div class="flex items-center" style="gap: 16px;">
                                <span class="material-symbols-rounded"
                                      style="color: #059669; font-size: 22px;
                                             font-variation-settings: 'FILL' 1;">
                                    person_add
                                </span>
                                <div style="text-align: left;">
                                    <div style="font-weight: 600; font-size: 15px;
                                                color: #059669;">
                                        Inscription
                                    </div>
                                    <div style="font-size: 12px;
                                                color: #71717a;
                                                margin-top: 2px;">
                                        Créer un compte formateur
                                    </div>
                                </div>
                            </div>
                            <span class="material-symbols-rounded"
                                  style="color: #059669; font-size: 20px;">
                                arrow_forward
                            </span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection