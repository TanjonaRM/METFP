<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class InstallHomeEditorial extends Command
{
    protected $signature = 'project:install-home-editorial
                            {--backup : Sauvegarder les fichiers existants (.bak)}
                            {--force : Écraser sans confirmation}';

    protected $description = 'Installe la page d\'accueil Editorial avec image de fond (hero)';

    public function handle(): int
    {
        $this->info("✨ Installation de la page d'accueil Editorial + image");
        $this->newLine();

        if (!$this->option('force') && !$this->confirm('Remplacer welcome.blade.php et guest.blade.php ?', true)) {
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
        $this->info("-> Ouvrez http://localhost:8000/");

        return self::SUCCESS;
    }

    protected function getFiles(): array
    {
        return [
            'resources/views/layouts/guest.blade.php' => $this->getGuestLayout(),
            'resources/views/welcome.blade.php'       => $this->getWelcomePage(),
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
        * { -webkit-font-smoothing: antialiased; -moz-osx-font-smoothing: grayscale; }
        html { scroll-behavior: smooth; }
        body { background: #fafafa; color: #18181b; }
        .material-symbols-rounded {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
            line-height: 1;
            vertical-align: middle;
        }
        ::selection { background: #10b981; color: #ffffff; }

        /* Fine ligne décorative sous les titres */
        .rule-emerald {
            width: 48px;
            height: 2px;
            background: #059669;
            border-radius: 2px;
        }

        /* Label majuscule avec tracking */
        .label-caps {
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 0.14em;
            text-transform: uppercase;
            color: #71717a;
        }
    </style>
</head>
<body class="font-sans antialiased">
    @yield('content')
</body>
</html>
BLADE;
    }

    // ============================================================
    // PAGE D'ACCUEIL EDITORIAL + IMAGE DE FOND
    // ============================================================
    protected function getWelcomePage(): string
    {
        return <<<'BLADE'
@extends('layouts.guest')

@section('title', 'Bienvenue - SGFORMATEURS')

@section('content')

<div class="min-h-screen flex flex-col bg-zinc-50">

    {{-- ============================================================
         HERO AVEC IMAGE DE FOND
         ============================================================ --}}
    <section class="relative overflow-hidden">

        {{-- Image de fond --}}
        <div class="absolute inset-0 z-0">
            <img src="https://images.unsplash.com/photo-1523240795612-9a054b0db644?auto=format&fit=crop&w=2000&q=80"
                 alt="Salle de formation"
                 class="w-full h-full object-cover object-center">
        </div>

        {{-- Overlay dégradé : blanc opaque à gauche -> transparent à droite --}}
        <div class="absolute inset-0 z-10
                    bg-gradient-to-r
                    from-white via-white/95 to-white/40
                    lg:from-white lg:via-white/90 lg:to-white/20"></div>

        {{-- Overlay supplémentaire : assombrit légèrement pour le contraste --}}
        <div class="absolute inset-0 z-10 bg-white/30"></div>

        {{-- Barre décorative verte en haut --}}
        <div class="absolute top-0 left-0 right-0 h-[3px] bg-emerald-600 z-30"></div>

        {{-- Contenu --}}
        <div class="relative z-20">

            {{-- Header --}}
            <header class="border-b border-zinc-200/50 backdrop-blur-sm">
                <div class="max-w-6xl mx-auto px-6 lg:px-8 h-16 flex items-center justify-between">

                    <a href="{{ route('home') }}" class="flex items-center gap-2.5">
                        <div class="w-8 h-8 rounded-lg bg-zinc-900 flex items-center justify-center">
                            <span class="material-symbols-rounded text-white text-[18px]"
                                  style="font-variation-settings: 'FILL' 1;">school</span>
                        </div>
                        <span class="font-bold text-zinc-900 text-[15px] tracking-tight">
                            SGFORMATEURS
                        </span>
                    </a>

                    <span class="hidden sm:inline-flex items-center gap-2 text-[11px] font-bold
                                 tracking-[0.14em] uppercase text-zinc-700">
                        <span class="w-6 h-px bg-zinc-500"></span>
                        METFP · Madagascar
                    </span>
                </div>
            </header>

            {{-- Hero content --}}
            <div class="max-w-6xl mx-auto px-6 lg:px-8 pt-24 pb-32">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">

                    {{-- Titre --}}
                    <div class="lg:col-span-8">
                        <h1 class="font-display text-5xl sm:text-6xl lg:text-7xl font-bold
                                   text-zinc-900 leading-[1.02] tracking-tight
                                   drop-shadow-sm">
                            Système de
                            <br>
                            Gestion des
                            <br>
                            <span class="text-emerald-600">Formateurs.</span>
                        </h1>

                        <div class="rule-emerald mt-8"></div>
                    </div>

                    {{-- Description --}}
                    <div class="lg:col-span-4 lg:pt-4">
                        <p class="text-[15px] text-zinc-700 leading-relaxed
                                  bg-white/60 backdrop-blur-sm rounded-xl p-5
                                  border border-white/80 shadow-sm">
                            Plateforme officielle du Ministère de l'Enseignement
                            Technique et de la Formation Professionnelle.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ============================================================
         CONTENU PRINCIPAL (fond blanc cassé)
         ============================================================ --}}
    <main class="flex-1 bg-zinc-50">

        {{-- ==================== OBJECTIF GLOBAL ==================== --}}
        <section class="max-w-6xl mx-auto px-6 lg:px-8 py-20">
            <div class="border-t border-zinc-200 pt-16">

                <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">

                    {{-- Label --}}
                    <div class="lg:col-span-3">
                        <div class="label-caps">Objectif</div>
                        <div class="rule-emerald mt-3"></div>
                    </div>

                    {{-- Texte --}}
                    <div class="lg:col-span-9">
                        <p class="text-2xl sm:text-3xl lg:text-[32px] text-zinc-900
                                  leading-[1.35] tracking-tight font-medium">
                            Centraliser la gestion des
                            <span class="text-emerald-600">formateurs</span>
                            et de leur écosystème complet :
                            <span class="text-zinc-500">établissements, filières,
                            affectations, sessions de formation</span>
                            et rapports - dans une seule plateforme.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        {{-- ==================== ACCÈS ==================== --}}
        <section class="max-w-6xl mx-auto px-6 lg:px-8 pb-24">
            <div class="border-t border-zinc-200 pt-16">

                <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">

                    {{-- Label --}}
                    <div class="lg:col-span-3">
                        <div class="label-caps">Accès</div>
                        <div class="rule-emerald mt-3"></div>
                    </div>

                    {{-- Options --}}
                    <div class="lg:col-span-9">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">

                            {{-- CONNEXION --}}
                            <a href="{{ route('admin.login') }}"
                               class="group relative flex flex-col justify-between
                                      p-7 rounded-2xl bg-zinc-900 text-white
                                      hover:bg-black transition-all duration-200
                                      min-h-[180px] overflow-hidden">

                                <div class="absolute -top-20 -right-20 w-40 h-40 rounded-full
                                            bg-emerald-500/0 group-hover:bg-emerald-500/20
                                            blur-3xl transition-all duration-500"></div>

                                <div class="relative">
                                    <div class="flex items-center justify-between mb-8">
                                        <span class="label-caps text-zinc-500">Accès 01</span>
                                        <span class="material-symbols-rounded text-[24px]
                                                     text-zinc-500
                                                     group-hover:text-emerald-400
                                                     group-hover:translate-x-1
                                                     transition-all">
                                            arrow_outward
                                        </span>
                                    </div>

                                    <h3 class="font-display text-2xl font-bold tracking-tight">
                                        Connexion
                                    </h3>
                                    <p class="text-[13px] text-zinc-400 mt-2 leading-relaxed">
                                        Accédez à votre espace administrateur
                                        ou formateur.
                                    </p>
                                </div>
                            </a>

                            {{-- INSCRIPTION --}}
                            <a href="{{ route('formateur.register') }}"
                               class="group relative flex flex-col justify-between
                                      p-7 rounded-2xl bg-white border-2 border-zinc-200
                                      hover:border-emerald-500 transition-all duration-200
                                      min-h-[180px] overflow-hidden">

                                <div class="absolute -top-20 -right-20 w-40 h-40 rounded-full
                                            bg-emerald-500/0 group-hover:bg-emerald-500/10
                                            blur-3xl transition-all duration-500"></div>

                                <div class="relative">
                                    <div class="flex items-center justify-between mb-8">
                                        <span class="label-caps">Accès 02</span>
                                        <span class="material-symbols-rounded text-[24px]
                                                     text-zinc-400
                                                     group-hover:text-emerald-600
                                                     group-hover:translate-x-1
                                                     transition-all">
                                            arrow_outward
                                        </span>
                                    </div>

                                    <h3 class="font-display text-2xl font-bold tracking-tight
                                               text-zinc-900">
                                        Inscription
                                    </h3>
                                    <p class="text-[13px] text-zinc-500 mt-2 leading-relaxed">
                                        Créez votre compte formateur
                                        en quelques minutes.
                                    </p>
                                </div>
                            </a>

                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    {{-- ============================================================
         FOOTER
         ============================================================ --}}
    <footer class="border-t border-zinc-200 bg-zinc-50">
        <div class="max-w-6xl mx-auto px-6 lg:px-8 py-8">

            <div class="flex flex-col md:flex-row items-center justify-between gap-4">

                <div class="flex items-center gap-2.5">
                    <div class="w-7 h-7 rounded-lg bg-zinc-900 flex items-center justify-center">
                        <span class="material-symbols-rounded text-white text-[16px]"
                              style="font-variation-settings: 'FILL' 1;">school</span>
                    </div>
                    <span class="font-bold text-zinc-900 text-[13px] tracking-tight">
                        SGFORMATEURS
                    </span>
                </div>

                <p class="text-[12px] text-zinc-500 text-center md:text-left">
                    © {{ date('Y') }} - Ministère de l'Enseignement Technique
                    et de la Formation Professionnelle
                </p>

                <div class="flex items-center gap-1.5 text-[11px] text-zinc-500">
                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                    Système opérationnel
                </div>
            </div>
        </div>
    </footer>

</div>

@endsection
BLADE;
    }
}