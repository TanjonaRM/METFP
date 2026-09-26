<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class InstallAllEmerald extends Command
{
    protected $signature = 'project:install-all-emerald
                            {--backup : Sauvegarder les fichiers existants (.bak)}
                            {--force : Écraser sans confirmation}';

    protected $description = 'Installe toutes les pages (vert large + boutons verts)';

    public function handle(): int
    {
        $this->info("✨ Installation des pages (vert élargi + boutons verts)");
        $this->newLine();

        if (!$this->option('force') && !$this->confirm('Remplacer les 5 vues ?', true)) {
            $this->warn('Annulé.');
            return self::FAILURE;
        }

        $files = $this->getFiles();
        $count = 0;

        foreach ($files as $path => $content) {
            $fullPath = base_path($path);
            $dir = dirname($fullPath);

            if (!File::exists($dir)) {
                File::makeDirectory($dir, 0755, true);
            }

            if ($this->option('backup') && File::exists($fullPath)) {
                $backupPath = $fullPath . '.bak.' . date('Y-m-d_H-i-s');
                File::copy($fullPath, $backupPath);
                $this->line("  [SAVE] Backup : " . basename($backupPath));
            }

            File::put($fullPath, $content);
            $size = round(strlen($content) / 1024, 2);
            $this->line("  [OK] {$path} ({$size} Ko)");
            $count++;
        }

        $this->newLine();
        $this->info("[CLEAN] Nettoyage des caches...");
        $this->call('view:clear');
        $this->call('cache:clear');

        $this->newLine();
        $this->info("✨ SUCCÈS : {$count} fichier(s) installé(s)");
        $this->newLine();
        $this->line("  [FILE] Accueil      : http://localhost:8000/");
        $this->line("  [FILE] Login admin  : http://localhost:8000/admin/login");
        $this->line("  [FILE] Login form.  : http://localhost:8000/formateur/login");
        $this->line("  [FILE] Inscription  : http://localhost:8000/formateur/register");

        return self::SUCCESS;
    }

    protected function getFiles(): array
    {
        return [
            'resources/views/layouts/guest.blade.php'            => $this->getGuestLayout(),
            'resources/views/welcome.blade.php'                  => $this->getWelcomePage(),
            'resources/views/auth/admin/login.blade.php'         => $this->getAdminLogin(),
            'resources/views/auth/formateur/login.blade.php'     => $this->getFormateurLogin(),
            'resources/views/auth/formateur/register.blade.php'  => $this->getFormateurRegister(),
        ];
    }

    // ============================================================
    // LAYOUT GUEST
    // ============================================================
    protected function getGuestLayout(): string
    {
        return <<<'BLADE'
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'SGFORMATEURS')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Space+Grotesk:wght@500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" rel="stylesheet">

    <style>
        * { -webkit-font-smoothing: antialiased; -moz-osx-font-smoothing: grayscale;
            box-sizing: border-box; margin: 0; padding: 0; }
        html, body { width: 100%; min-height: 100vh; }
        body {
            background: #fafafa;
            color: #18181b;
            font-family: 'Inter', ui-sans-serif, system-ui, sans-serif;
        }
        .font-display { font-family: 'Space Grotesk', ui-sans-serif, system-ui, sans-serif; }

        .material-symbols-rounded {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
            line-height: 1;
            vertical-align: middle;
        }
        ::selection { background: #10b981; color: #ffffff; }

        .rule-emerald { width: 48px; height: 2px; background: #059669; border-radius: 2px; }
        .rule-emerald-light { width: 48px; height: 2px; background: #6ee7b7; border-radius: 2px; }

        .label-caps {
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 0.14em;
            text-transform: uppercase;
            color: #71717a;
        }
        .label-caps-light {
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 0.14em;
            text-transform: uppercase;
            color: #a7f3d0;
        }

        .input-editorial {
            width: 100%;
            padding: 14px 16px;
            font-size: 14px;
            color: #18181b;
            background: #ffffff;
            border: 1.5px solid #e4e4e7;
            border-radius: 10px;
            outline: none;
            transition: all 0.15s ease;
            font-family: inherit;
        }
        .input-editorial::placeholder { color: #a1a1aa; }
        .input-editorial:hover { border-color: #d4d4d8; }
        .input-editorial:focus {
            border-color: #059669;
            box-shadow: 0 0 0 4px rgba(5, 150, 105, 0.10);
        }

        /* Bouton vert émeraude (par défaut) */
        .btn-emerald {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 14px 24px;
            border-radius: 12px;
            background: #059669;
            color: #ffffff;
            font-size: 14px;
            font-weight: 600;
            border: none;
            cursor: pointer;
            transition: all 0.2s ease;
            text-decoration: none;
        }
        .btn-emerald:hover {
            background: #047857;
            transform: translateY(-1px);
            box-shadow: 0 8px 20px -6px rgba(5, 150, 105, 0.4);
        }

        /* Bouton vert émeraude outline */
        .btn-emerald-outline {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 14px 24px;
            border-radius: 12px;
            background: #ffffff;
            color: #059669;
            font-size: 14px;
            font-weight: 600;
            border: 2px solid #059669;
            cursor: pointer;
            transition: all 0.2s ease;
            text-decoration: none;
        }
        .btn-emerald-outline:hover {
            background: #ecfdf5;
            transform: translateY(-1px);
        }

        a { text-decoration: none; color: inherit; transition: color 0.15s ease; }
    </style>
</head>
<body>
    @yield('content')
</body>
</html>
BLADE;
    }

    // ============================================================
    // COLONNE VERTE (largeur 55%)
    // ============================================================
    protected function getEmeraldColumn(string $quote, string $accent, string $subQuote, bool $showStats = true): string
    {
        $stats = $showStats ? <<<'HTML'

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
HTML : '';

        // [!]️ CHANGEMENT : 45% -> 55%
        return <<<HTML
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
                {$quote}
                <span style="color: #6ee7b7;">{$accent}</span>
            </p>

            <p style="font-size: 15px; color: rgba(209, 250, 229, 0.85);
                      margin-top: 1.5rem; max-width: 28rem;
                      line-height: 1.6;">
                {$subQuote}
            </p>
        </div>

        {$stats}
    </div>
</div>
HTML;
    }

    // ============================================================
    // PAGE D'ACCUEIL
    // ============================================================
    protected function getWelcomePage(): string
    {
        $emerald = $this->getEmeraldColumn(
            'La gestion des formateurs,',
            'simplifiée.',
            "Une plateforme centralisée pour piloter l'ensemble du réseau de formation professionnelle.",
            true
        );

        return <<<BLADE
@extends('layouts.guest')

@section('title', 'Bienvenue - SGFORMATEURS')

@section('content')

<div class="flex" style="min-height: 100vh; height: 100vh;">

    {$emerald}

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
BLADE;
    }

    // ============================================================
    // LOGIN ADMIN
    // ============================================================
    protected function getAdminLogin(): string
    {
        $emerald = $this->getEmeraldColumn(
            'Espace administrateur,',
            'sécurisé.',
            'Gérez les formateurs, établissements, filières, affectations et sessions du réseau.',
            true
        );

        return <<<BLADE
@extends('layouts.guest')

@section('title', 'Connexion Administrateur')

@section('content')

<div class="flex" style="min-height: 100vh; height: 100vh;">

    {$emerald}

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

                <div class="label-caps">Espace administrateur</div>
                <div class="rule-emerald" style="margin-top: 12px; margin-bottom: 20px;"></div>

                <h1 class="font-display"
                    style="font-size: 2.25rem; font-weight: 700;
                           color: #18181b; line-height: 1.05;
                           letter-spacing: -0.02em;">
                    Connexion.
                </h1>

                <p style="font-size: 14px; color: #71717a;
                          margin-top: 1rem; line-height: 1.6;">
                    Accédez au tableau de bord pour gérer les formateurs,
                    établissements et filières.
                </p>

                @if (\$errors->any())
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
                            @foreach (\$errors->all() as \$error)
                                <div>{{ \$error }}</div>
                            @endforeach
                        </div>
                    </div>
                @endif

                @if (session('status'))
                    <div class="flex items-start"
                         style="margin-top: 2rem; gap: 12px;
                                padding: 1rem; border-radius: 12px;
                                background: #ecfdf5;
                                border: 1px solid #a7f3d0;">
                        <span class="material-symbols-rounded"
                              style="color: #059669; font-size: 20px; flex-shrink: 0;">
                            check_circle
                        </span>
                        <div style="font-size: 13px; color: #065f46;
                                    line-height: 1.6;">
                            {{ session('status') }}
                        </div>
                    </div>
                @endif

                <form action="{{ route('admin.login') }}" method="POST"
                      style="margin-top: 2rem; display: flex;
                             flex-direction: column; gap: 1.25rem;">
                    @csrf

                    <div>
                        <label for="email" class="label-caps"
                               style="display: block; margin-bottom: 8px;">
                            Email
                        </label>
                        <input type="email" name="email" id="email"
                               value="{{ old('email') }}"
                               placeholder="admin@sgformateurs.mg"
                               required autofocus autocomplete="email"
                               class="input-editorial">
                    </div>

                    <div>
                        <div class="flex items-center justify-between"
                             style="margin-bottom: 8px;">
                            <label for="password" class="label-caps">
                                Mot de passe
                            </label>
                            <a href="{{ route('admin.password.request') }}"
                               style="font-size: 11px; font-weight: 600;
                                      color: #71717a;">
                                Oublié ?
                            </a>
                        </div>
                        <div style="position: relative;">
                            <input type="password" name="password" id="password"
                                   placeholder="********"
                                   required autocomplete="current-password"
                                   class="input-editorial"
                                   style="padding-right: 3rem;">
                            <button type="button" onclick="togglePassword()"
                                    style="position: absolute; right: 14px;
                                           top: 50%; transform: translateY(-50%);
                                           color: #a1a1aa; padding: 4px;
                                           background: transparent; border: none;
                                           cursor: pointer;">
                                <span class="material-symbols-rounded"
                                      style="font-size: 20px;" id="toggleIcon">
                                    visibility
                                </span>
                            </button>
                        </div>
                    </div>

                    <div style="padding-top: 4px;">
                        <label class="inline-flex items-center"
                               style="gap: 10px; cursor: pointer;">
                            <input type="checkbox" name="remember"
                                   style="width: 16px; height: 16px;
                                          border-radius: 4px;
                                          accent-color: #059669;">
                            <span style="font-size: 13px; color: #52525b;">
                                Se souvenir de moi
                            </span>
                        </label>
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
                        Se connecter
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
                        Pas de compte ?
                        <a href="{{ route('formateur.register') }}"
                           style="font-weight: 600; color: #059669;">
                            S'inscrire
                        </a>
                    </p>
                    <a href="{{ route('formateur.login') }}"
                       class="inline-flex items-center"
                       style="gap: 4px; font-size: 12px;
                              font-weight: 600; color: #71717a;">
                        Espace formateur
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

<script>
    function togglePassword() {
        const input = document.getElementById('password');
        const icon = document.getElementById('toggleIcon');
        if (input.type === 'password') {
            input.type = 'text';
            icon.textContent = 'visibility_off';
        } else {
            input.type = 'password';
            icon.textContent = 'visibility';
        }
    }
</script>

@endsection
BLADE;
    }

    // ============================================================
    // LOGIN FORMATEUR
    // ============================================================
    protected function getFormateurLogin(): string
    {
        $emerald = $this->getEmeraldColumn(
            'Votre espace formateur,',
            'en un clic.',
            'Consultez vos affectations, sessions et gérez votre profil.',
            false
        );

        return <<<BLADE
@extends('layouts.guest')

@section('title', 'Connexion Formateur')

@section('content')

<div class="flex" style="min-height: 100vh; height: 100vh;">

    {$emerald}

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

                <div class="label-caps">Espace formateur</div>
                <div class="rule-emerald" style="margin-top: 12px; margin-bottom: 20px;"></div>

                <h1 class="font-display"
                    style="font-size: 2.25rem; font-weight: 700;
                           color: #18181b; line-height: 1.05;
                           letter-spacing: -0.02em;">
                    Connexion.
                </h1>

                <p style="font-size: 14px; color: #71717a;
                          margin-top: 1rem; line-height: 1.6;">
                    Accédez à vos affectations, sessions et à votre profil formateur.
                </p>

                @if (\$errors->any())
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
                            @foreach (\$errors->all() as \$error)
                                <div>{{ \$error }}</div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <form action="{{ route('formateur.login') }}" method="POST"
                      style="margin-top: 2rem; display: flex;
                             flex-direction: column; gap: 1.25rem;">
                    @csrf

                    <div>
                        <label for="email" class="label-caps"
                               style="display: block; margin-bottom: 8px;">
                            Email
                        </label>
                        <input type="email" name="email" id="email"
                               value="{{ old('email') }}"
                               placeholder="votre.email@metfp.mg"
                               required autofocus autocomplete="email"
                               class="input-editorial">
                    </div>

                    <div>
                        <div class="flex items-center justify-between"
                             style="margin-bottom: 8px;">
                            <label for="password" class="label-caps">
                                Mot de passe
                            </label>
                            <a href="{{ route('formateur.password.request') }}"
                               style="font-size: 11px; font-weight: 600;
                                      color: #71717a;">
                                Oublié ?
                            </a>
                        </div>
                        <div style="position: relative;">
                            <input type="password" name="password" id="password"
                                   placeholder="********"
                                   required autocomplete="current-password"
                                   class="input-editorial"
                                   style="padding-right: 3rem;">
                            <button type="button" onclick="togglePassword()"
                                    style="position: absolute; right: 14px;
                                           top: 50%; transform: translateY(-50%);
                                           color: #a1a1aa; padding: 4px;
                                           background: transparent; border: none;
                                           cursor: pointer;">
                                <span class="material-symbols-rounded"
                                      style="font-size: 20px;" id="toggleIcon">
                                    visibility
                                </span>
                            </button>
                        </div>
                    </div>

                    <div style="padding-top: 4px;">
                        <label class="inline-flex items-center"
                               style="gap: 10px; cursor: pointer;">
                            <input type="checkbox" name="remember"
                                   style="width: 16px; height: 16px;
                                          border-radius: 4px;
                                          accent-color: #059669;">
                            <span style="font-size: 13px; color: #52525b;">
                                Se souvenir de moi
                            </span>
                        </label>
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
                        Se connecter
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
                        Pas de compte ?
                        <a href="{{ route('formateur.register') }}"
                           style="font-weight: 600; color: #059669;">
                            S'inscrire
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

<script>
    function togglePassword() {
        const input = document.getElementById('password');
        const icon = document.getElementById('toggleIcon');
        if (input.type === 'password') {
            input.type = 'text';
            icon.textContent = 'visibility_off';
        } else {
            input.type = 'password';
            icon.textContent = 'visibility';
        }
    }
</script>

@endsection
BLADE;
    }

    // ============================================================
    // REGISTER FORMATEUR
    // ============================================================
    protected function getFormateurRegister(): string
    {
        $emerald = $this->getEmeraldColumn(
            'Rejoignez le réseau,',
            "dès aujourd'hui.",
            'Créez votre compte formateur et accédez à vos affectations, sessions et profil.',
            true
        );

        return <<<BLADE
@extends('layouts.guest')

@section('title', 'Inscription Formateur')

@section('content')

<div class="flex" style="min-height: 100vh; height: 100vh;">

    {$emerald}

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

                @if (\$errors->any())
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
                            @foreach (\$errors->all() as \$error)
                                <div>{{ \$error }}</div>
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
BLADE;
    }
}