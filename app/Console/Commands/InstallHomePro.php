<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class InstallHomePro extends Command
{
    protected $signature = 'project:install-home-pro
                            {--backup : Sauvegarder les fichiers existants (.bak)}
                            {--force : Écraser sans confirmation}';

    protected $description = 'Installe une page d\'accueil PRO (dark theme, noir/blanc/gris + vert émeraude)';

    public function handle(): int
    {
        $this->info("✨ Installation de la page d'accueil PRO");
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
<html lang="fr" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'SGFORMATEURS') - SGFORMATEURS</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&family=Space+Grotesk:wght@400..700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" rel="stylesheet">

    <style>
        :root {
            --bg-primary: #0a0a0a;
            --bg-secondary: #111111;
            --bg-tertiary: #171717;
            --border-subtle: #1f1f1f;
            --border-visible: #2a2a2a;
            --text-primary: #fafafa;
            --text-secondary: #a1a1aa;
            --text-tertiary: #71717a;
            --emerald: #10b981;
            --emerald-bright: #34d399;
            --emerald-dark: #047857;
        }

        * { -webkit-font-smoothing: antialiased; -moz-osx-font-smoothing: grayscale; }

        body { background: var(--bg-primary); color: var(--text-primary); }

        /* Noise texture subtile */
        .noise::before {
            content: '';
            position: absolute;
            inset: 0;
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 200 200' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' /%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='0.4'/%3E%3C/svg%3E");
            opacity: 0.03;
            pointer-events: none;
        }

        /* Grid pattern */
        .grid-pattern {
            background-image:
                linear-gradient(rgba(255,255,255,0.025) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255,255,255,0.025) 1px, transparent 1px);
            background-size: 60px 60px;
        }

        /* Gradient text */
        .text-gradient {
            background: linear-gradient(135deg, #fafafa 0%, #a1a1aa 100%);
            -webkit-background-clip: text;
            background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .text-gradient-emerald {
            background: linear-gradient(135deg, #34d399 0%, #10b981 50%, #047857 100%);
            -webkit-background-clip: text;
            background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        /* Glow */
        .glow-emerald {
            box-shadow: 0 0 60px -15px rgba(16, 185, 129, 0.5);
        }

        /* Animations */
        @keyframes float-slow {
            0%, 100% { transform: translateY(0); }
            50%      { transform: translateY(-15px); }
        }
        .animate-float-slow { animation: float-slow 8s ease-in-out infinite; }

        @keyframes pulse-dot {
            0%, 100% { opacity: 1; transform: scale(1); }
            50%      { opacity: 0.5; transform: scale(1.2); }
        }
        .animate-pulse-dot { animation: pulse-dot 2s ease-in-out infinite; }

        @keyframes shimmer {
            0%   { background-position: -200% center; }
            100% { background-position: 200% center; }
        }
        .animate-shimmer {
            background: linear-gradient(90deg, transparent, rgba(52,211,153,0.15), transparent);
            background-size: 200% 100%;
            animation: shimmer 3s linear infinite;
        }

        @keyframes fade-up {
            from { opacity: 0; transform: translateY(24px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-up { animation: fade-up 0.8s cubic-bezier(0.16, 1, 0.3, 1) both; }

        @keyframes glow-pulse {
            0%, 100% { opacity: 0.4; }
            50%      { opacity: 0.8; }
        }
        .animate-glow-pulse { animation: glow-pulse 4s ease-in-out infinite; }

        /* Scrollbar */
        ::-webkit-scrollbar { width: 10px; height: 10px; }
        ::-webkit-scrollbar-track { background: #0a0a0a; }
        ::-webkit-scrollbar-thumb { background: #2a2a2a; border-radius: 5px; }
        ::-webkit-scrollbar-thumb:hover { background: #3a3a3a; }

        /* Selection */
        ::selection { background: rgba(16, 185, 129, 0.3); color: #fafafa; }

        /* Smooth scroll */
        html { scroll-behavior: smooth; }

        /* Material Symbols tuning */
        .material-symbols-rounded {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
            line-height: 1;
            vertical-align: middle;
        }
    </style>
</head>
<body class="font-sans antialiased bg-[#0a0a0a]">
    @yield('content')
</body>
</html>
BLADE;
    }

    // ============================================================
    // PAGE D'ACCUEIL PRO
    // ============================================================
    protected function getWelcomePage(): string
    {
        return <<<'BLADE'
@extends('layouts.guest')

@section('title', 'Bienvenue')

@section('content')

<div class="relative min-h-screen bg-[#0a0a0a] overflow-x-hidden noise">

    {{-- ============================================================
         BACKGROUND : halos + grid
         ============================================================ --}}
    <div class="fixed inset-0 grid-pattern pointer-events-none z-0"></div>

    <div class="fixed top-0 left-1/2 -translate-x-1/2 w-[900px] h-[900px]
                bg-emerald-500/8 rounded-full blur-[140px] pointer-events-none z-0
                animate-glow-pulse"></div>

    <div class="fixed bottom-0 left-0 w-[600px] h-[600px]
                bg-emerald-700/5 rounded-full blur-[120px] pointer-events-none z-0"></div>

    {{-- ============================================================
         NAVBAR
         ============================================================ --}}
    <nav class="sticky top-0 z-50 backdrop-blur-xl bg-[#0a0a0a]/80
                border-b border-white/[0.06]">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">

                {{-- Logo --}}
                <a href="{{ route('home') }}" class="flex items-center gap-2.5 group">
                    <div class="relative w-8 h-8">
                        <div class="absolute inset-0 bg-emerald-500 rounded-lg blur-md opacity-40
                                    group-hover:opacity-70 transition-opacity"></div>
                        <div class="relative w-8 h-8 rounded-lg bg-gradient-to-br
                                    from-emerald-400 to-emerald-600 flex items-center justify-center">
                            <span class="material-symbols-rounded text-black text-[18px] font-bold"
                                  style="font-variation-settings: 'FILL' 1;">school</span>
                        </div>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="font-display font-bold text-white text-[15px] tracking-tight">
                            SGFORMATEURS
                        </span>
                        <span class="hidden sm:inline-flex items-center px-1.5 py-0.5 rounded
                                     bg-emerald-500/10 border border-emerald-500/20
                                     text-[9px] font-bold text-emerald-400 uppercase tracking-wider">
                            v1.0
                        </span>
                    </div>
                </a>

                {{-- Menu --}}
                <div class="hidden md:flex items-center gap-1">
                    <a href="#features" class="px-3.5 py-2 rounded-lg text-[13px] font-medium
                                               text-zinc-400 hover:text-white hover:bg-white/[0.04]
                                               transition-all">
                        Fonctionnalités
                    </a>
                    <a href="#workflow" class="px-3.5 py-2 rounded-lg text-[13px] font-medium
                                               text-zinc-400 hover:text-white hover:bg-white/[0.04]
                                               transition-all">
                        Workflow
                    </a>
                    <a href="#stats" class="px-3.5 py-2 rounded-lg text-[13px] font-medium
                                            text-zinc-400 hover:text-white hover:bg-white/[0.04]
                                            transition-all">
                        Chiffres
                    </a>
                </div>

                {{-- CTA --}}
                <div class="flex items-center gap-2">
                    <a href="{{ route('formateur.login') }}"
                       class="hidden sm:inline-flex px-3.5 py-2 rounded-lg text-[13px] font-medium
                              text-zinc-400 hover:text-white transition-all">
                        Formateur
                    </a>
                    <a href="{{ route('admin.login') }}"
                       class="group relative inline-flex items-center gap-2 px-4 py-2 rounded-lg
                              bg-white text-black text-[13px] font-semibold
                              hover:bg-zinc-100 transition-all
                              shadow-[0_0_0_1px_rgba(255,255,255,0.1)]">
                        <span>Se connecter</span>
                        <span class="material-symbols-rounded text-[16px]
                                     group-hover:translate-x-0.5 transition-transform">arrow_forward</span>
                    </a>
                </div>
            </div>
        </div>
    </nav>

    {{-- ============================================================
         HERO
         ============================================================ --}}
    <section class="relative z-10 pt-20 lg:pt-28 pb-24">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">

            {{-- Badge --}}
            <div class="flex justify-center mb-8 animate-fade-up">
                <div class="inline-flex items-center gap-2.5 pl-1.5 pr-4 py-1.5 rounded-full
                            bg-white/[0.03] border border-white/[0.08]
                            backdrop-blur-sm">
                    <span class="inline-flex items-center gap-1.5 px-2 py-0.5 rounded-full
                                 bg-emerald-500/15 border border-emerald-500/25">
                        <span class="relative flex h-1.5 w-1.5">
                            <span class="absolute inline-flex h-full w-full rounded-full
                                         bg-emerald-400 animate-pulse-dot"></span>
                            <span class="relative inline-flex rounded-full h-1.5 w-1.5 bg-emerald-400"></span>
                        </span>
                        <span class="text-[10px] font-bold text-emerald-400 uppercase tracking-wider">
                            Live
                        </span>
                    </span>
                    <span class="text-[13px] text-zinc-400">
                        Plateforme officielle du METFP Madagascar
                    </span>
                </div>
            </div>

            {{-- Titre --}}
            <h1 class="text-center font-display text-5xl sm:text-6xl lg:text-7xl
                       font-bold leading-[1.05] tracking-tight text-gradient
                       max-w-5xl mx-auto animate-fade-up"
                style="animation-delay: 0.1s;">
                La gestion des formateurs
                <br>
                <span class="text-gradient-emerald">réinventée</span>
            </h1>

            {{-- Sous-titre --}}
            <p class="text-center text-lg lg:text-xl text-zinc-400 mt-8 max-w-2xl mx-auto
                      leading-relaxed animate-fade-up"
               style="animation-delay: 0.2s;">
                Centralisez, suivez et pilotez l'ensemble du réseau de formateurs
                dans une interface unique, moderne et puissante.
            </p>

            {{-- CTA --}}
            <div class="flex flex-wrap justify-center gap-3 mt-10 animate-fade-up"
                 style="animation-delay: 0.3s;">

                <a href="{{ route('admin.login') }}"
                   class="group relative inline-flex items-center gap-2.5 px-7 py-3.5 rounded-xl
                          bg-gradient-to-b from-emerald-400 to-emerald-600
                          text-black text-[15px] font-bold
                          glow-emerald hover:scale-[1.02] transition-all duration-200">
                    <span class="material-symbols-rounded text-[20px] font-bold"
                          style="font-variation-settings: 'FILL' 1;">rocket_launch</span>
                    Démarrer maintenant
                    <span class="material-symbols-rounded text-[18px]
                                 group-hover:translate-x-0.5 transition-transform">arrow_forward</span>
                </a>

                <a href="#features"
                   class="group inline-flex items-center gap-2.5 px-7 py-3.5 rounded-xl
                          bg-white/[0.04] border border-white/[0.08]
                          text-white text-[15px] font-semibold
                          hover:bg-white/[0.08] hover:border-white/[0.15] transition-all">
                    <span class="material-symbols-rounded text-[20px] text-emerald-400"
                          style="font-variation-settings: 'FILL' 1;">play_circle</span>
                    Explorer les fonctionnalités
                </a>
            </div>

            {{-- Meta info --}}
            <div class="flex flex-wrap justify-center items-center gap-x-6 gap-y-2 mt-10
                        text-[12px] text-zinc-500 animate-fade-up"
                 style="animation-delay: 0.4s;">
                <span class="inline-flex items-center gap-1.5">
                    <span class="material-symbols-rounded text-[14px] text-emerald-500">check_circle</span>
                    Accès sécurisé
                </span>
                <span class="inline-flex items-center gap-1.5">
                    <span class="material-symbols-rounded text-[14px] text-emerald-500">check_circle</span>
                    Temps réel
                </span>
                <span class="inline-flex items-center gap-1.5">
                    <span class="material-symbols-rounded text-[14px] text-emerald-500">check_circle</span>
                    Export PDF
                </span>
            </div>

            {{-- Mockup visuel --}}
            <div class="relative mt-20 max-w-5xl mx-auto animate-fade-up"
                 style="animation-delay: 0.5s;">

                {{-- Glow derrière --}}
                <div class="absolute inset-x-0 top-10 h-64 bg-emerald-500/20 blur-[100px]
                            pointer-events-none"></div>

                {{-- Faux navigateur --}}
                <div class="relative rounded-2xl overflow-hidden
                            bg-[#111111] border border-white/[0.08]
                            shadow-[0_20px_80px_-20px_rgba(0,0,0,0.8)]">

                    {{-- Barre navigateur --}}
                    <div class="flex items-center gap-2 px-4 py-3
                                bg-[#171717] border-b border-white/[0.06]">
                        <div class="flex gap-1.5">
                            <div class="w-3 h-3 rounded-full bg-red-500/80"></div>
                            <div class="w-3 h-3 rounded-full bg-amber-500/80"></div>
                            <div class="w-3 h-3 rounded-full bg-emerald-500/80"></div>
                        </div>
                        <div class="flex-1 ml-3">
                            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-md
                                        bg-white/[0.04] border border-white/[0.06]">
                                <span class="material-symbols-rounded text-[12px] text-emerald-500">
                                    lock
                                </span>
                                <span class="text-[11px] text-zinc-500 font-mono">
                                    sgformateurs.metfp.mg/dashboard
                                </span>
                            </div>
                        </div>
                    </div>

                    {{-- Contenu mockup --}}
                    <div class="grid grid-cols-12 min-h-[420px]">

                        {{-- Sidebar mockup --}}
                        <div class="col-span-3 border-r border-white/[0.06] p-4 space-y-1">
                            <div class="flex items-center gap-2 px-2 py-1.5 mb-3">
                                <div class="w-6 h-6 rounded-md bg-gradient-to-br
                                            from-emerald-400 to-emerald-600"></div>
                                <div class="h-2 w-20 bg-white/[0.08] rounded"></div>
                            </div>
                            <div class="px-2 py-1.5 rounded-md bg-emerald-500/10 border border-emerald-500/20">
                                <div class="flex items-center gap-2">
                                    <div class="w-3 h-3 rounded bg-emerald-400/60"></div>
                                    <div class="h-1.5 w-16 bg-emerald-400/40 rounded"></div>
                                </div>
                            </div>
                            @for($i = 0; $i < 5; $i++)
                                <div class="flex items-center gap-2 px-2 py-1.5">
                                    <div class="w-3 h-3 rounded bg-white/[0.08]"></div>
                                    <div class="h-1.5 rounded bg-white/[0.05]" style="width: {{ rand(40, 80) }}%"></div>
                                </div>
                            @endfor
                        </div>

                        {{-- Contenu principal --}}
                        <div class="col-span-9 p-6 space-y-5">

                            {{-- Header --}}
                            <div class="flex items-center justify-between">
                                <div class="space-y-1.5">
                                    <div class="h-3 w-32 bg-white/[0.1] rounded"></div>
                                    <div class="h-2 w-48 bg-white/[0.05] rounded"></div>
                                </div>
                                <div class="h-7 w-24 rounded-md bg-emerald-500/80"></div>
                            </div>

                            {{-- Stats cards --}}
                            <div class="grid grid-cols-4 gap-3">
                                @php
                                    $stats = [
                                        ['#10b981', '80%', '40%'],
                                        ['#34d399', '60%', '50%'],
                                        ['#059669', '70%', '30%'],
                                        ['#047857', '50%', '60%'],
                                    ];
                                @endphp
                                @foreach($stats as $s)
                                    <div class="rounded-xl bg-[#171717] border border-white/[0.06] p-3.5">
                                        <div class="w-6 h-6 rounded-md mb-2.5"
                                             style="background: {{ $s[0] }}33;"></div>
                                        <div class="h-3 rounded bg-white/[0.12] mb-1.5"
                                             style="width: {{ $s[1] }};"></div>
                                        <div class="h-1.5 rounded bg-white/[0.05]"
                                             style="width: {{ $s[2] }};"></div>
                                    </div>
                                @endforeach
                            </div>

                            {{-- Table --}}
                            <div class="rounded-xl bg-[#171717] border border-white/[0.06] overflow-hidden">
                                <div class="px-4 py-3 border-b border-white/[0.06]
                                            flex items-center justify-between">
                                    <div class="h-2 w-28 bg-white/[0.1] rounded"></div>
                                    <div class="h-2 w-16 bg-white/[0.05] rounded"></div>
                                </div>
                                @for($i = 0; $i < 5; $i++)
                                    <div class="px-4 py-3 border-b border-white/[0.03] last:border-0
                                                flex items-center gap-4">
                                        <div class="w-7 h-7 rounded-full bg-gradient-to-br
                                                    from-emerald-400/60 to-emerald-700/60 shrink-0"></div>
                                        <div class="h-2 rounded bg-white/[0.08]" style="width: 25%;"></div>
                                        <div class="h-2 rounded bg-white/[0.05]" style="width: 20%;"></div>
                                        <div class="h-2 rounded bg-white/[0.05]" style="width: 15%;"></div>
                                        <div class="ml-auto h-5 w-14 rounded-full bg-emerald-500/20
                                                    border border-emerald-500/30"></div>
                                    </div>
                                @endfor
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Reflet en bas --}}
                <div class="absolute -bottom-20 inset-x-20 h-40
                            bg-emerald-500/10 blur-[80px] pointer-events-none"></div>
            </div>
        </div>
    </section>

    {{-- ============================================================
         LOGOS / CONFIANCE (bandeau)
         ============================================================ --}}
    <section class="relative z-10 py-16 border-y border-white/[0.06]">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <p class="text-center text-[11px] font-bold text-zinc-500
                      uppercase tracking-[0.2em] mb-8">
                Utilisé par les établissements du réseau METFP
            </p>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 items-center opacity-50">
                @foreach(['CFP Ambilobe', 'LTP Mahamasina', 'CFP Mahajanga', 'LTP Toamasina'] as $name)
                    <div class="text-center">
                        <div class="font-display font-bold text-white text-lg lg:text-xl">
                            {{ $name }}
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ============================================================
         STATS (bandeau chiffres)
         ============================================================ --}}
    <section id="stats" class="relative z-10 py-24">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-px bg-white/[0.06]
                        rounded-2xl overflow-hidden border border-white/[0.06]">

                @php
                    $bigStats = [
                        ['14', 'Établissements', 'apartment'],
                        ['80+', 'Filières', 'school'],
                        ['7', 'Secteurs', 'category'],
                        ['5', 'Niveaux', 'stairs'],
                    ];
                @endphp

                @foreach($bigStats as $s)
                    <div class="bg-[#0a0a0a] p-8 group hover:bg-[#111111] transition-colors">
                        <span class="material-symbols-rounded text-emerald-500 text-2xl mb-6 block"
                              style="font-variation-settings: 'FILL' 1;">
                            {{ $s[2] }}
                        </span>
                        <div class="font-display text-4xl lg:text-5xl font-bold
                                    text-white tracking-tight">
                            {{ $s[0] }}
                        </div>
                        <div class="text-[13px] text-zinc-500 mt-2 font-medium uppercase tracking-wider">
                            {{ $s[1] }}
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ============================================================
         FEATURES
         ============================================================ --}}
    <section id="features" class="relative z-10 py-24 lg:py-32">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">

            {{-- En-tête --}}
            <div class="max-w-3xl mb-20">
                <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full
                            bg-emerald-500/10 border border-emerald-500/20 mb-6">
                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-400"></span>
                    <span class="text-[11px] font-bold text-emerald-400 uppercase tracking-wider">
                        Fonctionnalités
                    </span>
                </div>
                <h2 class="font-display text-4xl lg:text-5xl font-bold text-white
                           leading-[1.1] tracking-tight">
                    Tout pour piloter
                    <br>
                    <span class="text-gradient-emerald">votre réseau</span>
                </h2>
                <p class="text-lg text-zinc-400 mt-6 leading-relaxed max-w-xl">
                    Une suite d'outils pensée pour les besoins réels des établissements
                    de formation professionnelle.
                </p>
            </div>

            {{-- Grille features --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">

                @php
                    $features = [
                        [
                            'icon' => 'groups',
                            'title' => 'Gestion des formateurs',
                            'desc' => 'Fiches complètes : identité, coordonnées, grade, statut et historique des affectations.',
                        ],
                        [
                            'icon' => 'assignment_ind',
                            'title' => 'Affectations intelligentes',
                            'desc' => 'Liez formateurs, filières et établissements avec synchronisation automatique des statuts.',
                        ],
                        [
                            'icon' => 'event',
                            'title' => 'Sessions de formation',
                            'desc' => 'Créez et suivez vos sessions avec créneaux, lieux et participants centralisés.',
                        ],
                        [
                            'icon' => 'description',
                            'title' => 'Rapports PDF',
                            'desc' => 'Générez des rapports professionnels : listes, fiches, statistiques et exports ciblés.',
                        ],
                        [
                            'icon' => 'monitoring',
                            'title' => 'Statistiques temps réel',
                            'desc' => 'Tableaux de bord interactifs avec graphiques et indicateurs clés de performance.',
                        ],
                        [
                            'icon' => 'verified_user',
                            'title' => 'Sécurité par rôles',
                            'desc' => 'Gestion fine des permissions : super admin, admin, gestionnaire et formateur.',
                        ],
                    ];
                @endphp

                @foreach($features as $i => $f)
                    <div class="group relative p-7 rounded-2xl
                                bg-gradient-to-b from-[#111111] to-[#0d0d0d]
                                border border-white/[0.06]
                                hover:border-emerald-500/30 hover:-translate-y-0.5
                                transition-all duration-300 overflow-hidden">

                        {{-- Halo hover --}}
                        <div class="absolute -top-20 -right-20 w-40 h-40 rounded-full
                                    bg-emerald-500/0 group-hover:bg-emerald-500/10
                                    blur-3xl transition-all duration-500"></div>

                        <div class="relative">
                            {{-- Icon --}}
                            <div class="w-12 h-12 rounded-xl bg-white/[0.03] border border-white/[0.06]
                                        flex items-center justify-center mb-6
                                        group-hover:border-emerald-500/30
                                        group-hover:bg-emerald-500/5
                                        transition-all">
                                <span class="material-symbols-rounded text-emerald-400 text-[22px]"
                                      style="font-variation-settings: 'FILL' 1;">
                                    {{ $f['icon'] }}
                                </span>
                            </div>

                            {{-- Title --}}
                            <h3 class="font-display text-[17px] font-bold text-white mb-3">
                                {{ $f['title'] }}
                            </h3>

                            {{-- Desc --}}
                            <p class="text-[14px] text-zinc-400 leading-relaxed">
                                {{ $f['desc'] }}
                            </p>

                            {{-- Arrow --}}
                            <div class="mt-6 flex items-center gap-1.5 text-[12px] font-semibold
                                        text-emerald-400 opacity-0 group-hover:opacity-100
                                        transition-opacity">
                                <span>En savoir plus</span>
                                <span class="material-symbols-rounded text-[14px]
                                             group-hover:translate-x-1 transition-transform">
                                    arrow_forward
                                </span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ============================================================
         WORKFLOW (3 étapes)
         ============================================================ --}}
    <section id="workflow" class="relative z-10 py-24 lg:py-32
                                  border-y border-white/[0.06]">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">

            <div class="text-center mb-20">
                <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full
                            bg-emerald-500/10 border border-emerald-500/20 mb-6">
                    <span class="text-[11px] font-bold text-emerald-400 uppercase tracking-wider">
                        Workflow
                    </span>
                </div>
                <h2 class="font-display text-4xl lg:text-5xl font-bold text-white
                           leading-tight tracking-tight max-w-3xl mx-auto">
                    Démarrez en <span class="text-gradient-emerald">3 étapes</span>
                </h2>
                <p class="text-lg text-zinc-400 mt-6 max-w-xl mx-auto">
                    Aucune courbe d'apprentissage, aucune configuration complexe.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 relative">

                {{-- Ligne de connexion --}}
                <div class="hidden md:block absolute top-[60px] left-[20%] right-[20%] h-px
                            bg-gradient-to-r from-transparent via-emerald-500/30 to-transparent"></div>

                @php
                    $steps = [
                        ['01', 'Connexion sécurisée', 'Accédez à votre espace avec vos identifiants administrateur ou formateur.', 'login'],
                        ['02', 'Gestion des données', 'Ajoutez, modifiez et consultez formateurs, filières et affectations.', 'database'],
                        ['03', 'Export & analyse', 'Générez vos rapports PDF et suivez vos KPI en temps réel.', 'insights'],
                    ];
                @endphp

                @foreach($steps as $i => $s)
                    <div class="relative group">
                        <div class="relative bg-[#0a0a0a] p-8 rounded-2xl
                                    border border-white/[0.06]
                                    hover:border-emerald-500/30 transition-all">

                            {{-- Numéro --}}
                            <div class="relative w-14 h-14 mb-8">
                                <div class="absolute inset-0 rounded-2xl bg-emerald-500/20 blur-lg
                                            group-hover:bg-emerald-500/40 transition-all"></div>
                                <div class="relative w-14 h-14 rounded-2xl
                                            bg-gradient-to-br from-[#171717] to-[#0d0d0d]
                                            border border-white/[0.1]
                                            flex items-center justify-center">
                                    <span class="font-display text-xl font-bold
                                                 text-gradient-emerald">
                                        {{ $s[0] }}
                                    </span>
                                </div>
                            </div>

                            <h3 class="font-display text-[17px] font-bold text-white mb-2.5">
                                {{ $s[1] }}
                            </h3>
                            <p class="text-[14px] text-zinc-400 leading-relaxed">
                                {{ $s[2] }}
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ============================================================
         DOUBLE CTA
         ============================================================ --}}
    <section class="relative z-10 py-24 lg:py-32">
        <div class="max-w-5xl mx-auto px-6 lg:px-8">

            <div class="relative rounded-3xl overflow-hidden
                        border border-white/[0.08]
                        bg-gradient-to-b from-[#111111] to-[#0a0a0a]">

                {{-- Halos --}}
                <div class="absolute -top-32 left-1/2 -translate-x-1/2 w-[500px] h-[500px]
                            bg-emerald-500/15 rounded-full blur-[120px] pointer-events-none"></div>

                <div class="relative p-10 md:p-16 text-center">

                    <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full
                                bg-emerald-500/10 border border-emerald-500/20 mb-6">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse-dot"></span>
                        <span class="text-[11px] font-bold text-emerald-400 uppercase tracking-wider">
                            Accès immédiat
                        </span>
                    </div>

                    <h2 class="font-display text-4xl md:text-5xl font-bold text-white
                               leading-[1.1] tracking-tight max-w-3xl mx-auto">
                        Prêt à <span class="text-gradient-emerald">démarrer</span> ?
                    </h2>

                    <p class="text-lg text-zinc-400 mt-6 max-w-xl mx-auto leading-relaxed">
                        Choisissez votre espace et accédez à vos outils en un clic.
                    </p>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-12 max-w-3xl mx-auto">

                        {{-- CTA Admin --}}
                        <a href="{{ route('admin.login') }}"
                           class="group relative flex items-center gap-4 p-5 rounded-2xl
                                  bg-gradient-to-b from-emerald-400 to-emerald-600
                                  hover:scale-[1.02] transition-all duration-200
                                  text-black text-left overflow-hidden">

                            <div class="absolute inset-0 animate-shimmer"></div>

                            <div class="relative w-12 h-12 rounded-xl bg-black/10
                                        flex items-center justify-center shrink-0">
                                <span class="material-symbols-rounded text-black text-[24px]"
                                      style="font-variation-settings: 'FILL' 1;">
                                    admin_panel_settings
                                </span>
                            </div>

                            <div class="relative flex-1">
                                <div class="font-display font-bold text-[15px]">
                                    Espace Admin
                                </div>
                                <div class="text-[12px] text-black/70 mt-0.5">
                                    Gestion complète du système
                                </div>
                            </div>

                            <span class="relative material-symbols-rounded text-black text-[20px]
                                         group-hover:translate-x-1 transition-transform">
                                arrow_forward
                            </span>
                        </a>

                        {{-- CTA Formateur --}}
                        <a href="{{ route('formateur.login') }}"
                           class="group flex items-center gap-4 p-5 rounded-2xl
                                  bg-white/[0.03] border border-white/[0.08]
                                  hover:bg-white/[0.06] hover:border-emerald-500/30
                                  transition-all duration-200 text-left">

                            <div class="w-12 h-12 rounded-xl bg-white/[0.05]
                                        border border-white/[0.08]
                                        flex items-center justify-center shrink-0">
                                <span class="material-symbols-rounded text-emerald-400 text-[24px]"
                                      style="font-variation-settings: 'FILL' 1;">
                                    school
                                </span>
                            </div>

                            <div class="flex-1">
                                <div class="font-display font-bold text-white text-[15px]">
                                    Espace Formateur
                                </div>
                                <div class="text-[12px] text-zinc-500 mt-0.5">
                                    Mes sessions et affectations
                                </div>
                            </div>

                            <span class="material-symbols-rounded text-white text-[20px]
                                         group-hover:translate-x-1 transition-transform">
                                arrow_forward
                            </span>
                        </a>
                    </div>

                    {{-- Meta --}}
                    <div class="flex flex-wrap justify-center items-center gap-x-6 gap-y-2 mt-10
                                text-[12px] text-zinc-500">
                        <span class="inline-flex items-center gap-1.5">
                            <span class="material-symbols-rounded text-[14px] text-emerald-500">
                                check_circle
                            </span>
                            Aucune carte bancaire
                        </span>
                        <span class="inline-flex items-center gap-1.5">
                            <span class="material-symbols-rounded text-[14px] text-emerald-500">
                                check_circle
                            </span>
                            Support officiel METFP
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ============================================================
         FOOTER
         ============================================================ --}}
    <footer class="relative z-10 border-t border-white/[0.06]">
        <div class="max-w-7xl mx-auto px-6 lg:px-8 py-16">

            <div class="grid grid-cols-2 md:grid-cols-5 gap-8 mb-12">

                {{-- Brand --}}
                <div class="col-span-2">
                    <div class="flex items-center gap-2.5 mb-5">
                        <div class="w-8 h-8 rounded-lg bg-gradient-to-br
                                    from-emerald-400 to-emerald-600
                                    flex items-center justify-center">
                            <span class="material-symbols-rounded text-black text-[18px]"
                                  style="font-variation-settings: 'FILL' 1;">school</span>
                        </div>
                        <span class="font-display font-bold text-white text-[15px] tracking-tight">
                            SGFORMATEURS
                        </span>
                    </div>
                    <p class="text-[13px] text-zinc-500 leading-relaxed max-w-xs">
                        Plateforme officielle du Ministère de l'Enseignement Technique
                        et de la Formation Professionnelle de Madagascar.
                    </p>
                </div>

                {{-- Colonnes --}}
                <div>
                    <h4 class="text-white font-semibold text-[12px] mb-4
                               uppercase tracking-wider">
                        Produit
                    </h4>
                    <ul class="space-y-2.5 text-[13px] text-zinc-500">
                        <li><a href="#features" class="hover:text-emerald-400 transition">Fonctionnalités</a></li>
                        <li><a href="#workflow" class="hover:text-emerald-400 transition">Workflow</a></li>
                        <li><a href="#stats"    class="hover:text-emerald-400 transition">Chiffres</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="text-white font-semibold text-[12px] mb-4
                               uppercase tracking-wider">
                        Accès
                    </h4>
                    <ul class="space-y-2.5 text-[13px] text-zinc-500">
                        <li><a href="{{ route('admin.login') }}"     class="hover:text-emerald-400 transition">Espace Admin</a></li>
                        <li><a href="{{ route('formateur.login') }}" class="hover:text-emerald-400 transition">Espace Formateur</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="text-white font-semibold text-[12px] mb-4
                               uppercase tracking-wider">
                        Contact
                    </h4>
                    <ul class="space-y-2.5 text-[13px] text-zinc-500">
                        <li>METFP Madagascar</li>
                        <li>Antananarivo, MG</li>
                    </ul>
                </div>
            </div>

            {{-- Barre du bas --}}
            <div class="pt-8 border-t border-white/[0.06] flex flex-col md:flex-row
                        items-center justify-between gap-4">
                <p class="text-[12px] text-zinc-500">
                    © {{ date('Y') }} <span class="text-white font-semibold">SGFORMATEURS</span>
                    - Tous droits réservés
                </p>
                <div class="flex items-center gap-5 text-[12px] text-zinc-500">
                    <span class="inline-flex items-center gap-1.5">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse-dot"></span>
                        Système opérationnel
                    </span>
                    <span>v1.0</span>
                </div>
            </div>
        </div>
    </footer>

</div>

@endsection
BLADE;
    }
}