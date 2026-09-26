<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class InstallHomeMinimal extends Command
{
    protected $signature = 'project:install-home-minimal
                            {--backup : Sauvegarder les fichiers existants (.bak)}
                            {--force : Écraser sans confirmation}';

    protected $description = 'Installe une page d\'accueil minimale (fond blanc, 4 cartes, 3 liens)';

    public function handle(): int
    {
        $this->info("✨ Installation de la page d'accueil minimale");
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
        body { background: #ffffff; color: #18181b; }
        .material-symbols-rounded {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
            line-height: 1;
            vertical-align: middle;
        }
        ::selection { background: #10b981; color: #ffffff; }
    </style>
</head>
<body class="font-sans antialiased bg-white">
    @yield('content')
</body>
</html>
BLADE;
    }

    // ============================================================
    // PAGE D'ACCUEIL
    // ============================================================
    protected function getWelcomePage(): string
    {
        return <<<'BLADE'
@extends('layouts.guest')

@section('title', 'Bienvenue - SGFORMATEURS')

@section('content')

<div class="min-h-screen flex flex-col bg-white">

    {{-- ============================================================
         HEADER : Logo minimal
         ============================================================ --}}
    <header class="border-b border-zinc-200">
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

            <span class="hidden sm:inline-flex items-center gap-1.5 px-3 py-1 rounded-full
                         bg-emerald-50 border border-emerald-100 text-[11px] font-semibold
                         text-emerald-700">
                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                METFP Madagascar
            </span>
        </div>
    </header>

    {{-- ============================================================
         CONTENU PRINCIPAL
         ============================================================ --}}
    <main class="flex-1">

        {{-- ==================== HERO ==================== --}}
        <section class="max-w-6xl mx-auto px-6 lg:px-8 pt-20 pb-16 text-center">

            <h1 class="text-4xl sm:text-5xl lg:text-6xl font-bold text-zinc-900
                       leading-[1.1] tracking-tight max-w-4xl mx-auto">
                Système de Gestion
                <br>
                <span class="text-emerald-600">des Formateurs</span>
            </h1>

            <p class="text-lg text-zinc-500 mt-6 max-w-2xl mx-auto leading-relaxed">
                Plateforme officielle du Ministère de l'Enseignement Technique
                et de la Formation Professionnelle pour la gestion centralisée
                des formateurs, filières et établissements.
            </p>
        </section>

        {{-- ==================== 4 CARTES DESCRIPTIVES ==================== --}}
        <section class="max-w-6xl mx-auto px-6 lg:px-8 pb-20">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">

                {{-- Carte 1 : Formateurs --}}
                <div class="group bg-white rounded-2xl border border-zinc-200 p-6
                            hover:border-emerald-300 hover:shadow-[0_4px_20px_-4px_rgba(16,185,129,0.15)]
                            transition-all duration-200">
                    <div class="w-11 h-11 rounded-xl bg-emerald-50 border border-emerald-100
                                flex items-center justify-center mb-5
                                group-hover:bg-emerald-100 transition-colors">
                        <span class="material-symbols-rounded text-emerald-600 text-[22px]"
                              style="font-variation-settings: 'FILL' 1;">groups</span>
                    </div>
                    <h3 class="font-bold text-zinc-900 text-[15px] mb-2">
                        Formateurs
                    </h3>
                    <p class="text-[13px] text-zinc-500 leading-relaxed">
                        Centralisez les fiches complètes de tous les formateurs
                        du réseau : identité, coordonnées et grade.
                    </p>
                </div>

                {{-- Carte 2 : Établissements --}}
                <div class="group bg-white rounded-2xl border border-zinc-200 p-6
                            hover:border-emerald-300 hover:shadow-[0_4px_20px_-4px_rgba(16,185,129,0.15)]
                            transition-all duration-200">
                    <div class="w-11 h-11 rounded-xl bg-emerald-50 border border-emerald-100
                                flex items-center justify-center mb-5
                                group-hover:bg-emerald-100 transition-colors">
                        <span class="material-symbols-rounded text-emerald-600 text-[22px]"
                              style="font-variation-settings: 'FILL' 1;">apartment</span>
                    </div>
                    <h3 class="font-bold text-zinc-900 text-[15px] mb-2">
                        Établissements
                    </h3>
                    <p class="text-[13px] text-zinc-500 leading-relaxed">
                        Gérez les centres de formation, lycées techniques et
                        autres établissements du territoire.
                    </p>
                </div>

                {{-- Carte 3 : Filières --}}
                <div class="group bg-white rounded-2xl border border-zinc-200 p-6
                            hover:border-emerald-300 hover:shadow-[0_4px_20px_-4px_rgba(16,185,129,0.15)]
                            transition-all duration-200">
                    <div class="w-11 h-11 rounded-xl bg-emerald-50 border border-emerald-100
                                flex items-center justify-center mb-5
                                group-hover:bg-emerald-100 transition-colors">
                        <span class="material-symbols-rounded text-emerald-600 text-[22px]"
                              style="font-variation-settings: 'FILL' 1;">school</span>
                    </div>
                    <h3 class="font-bold text-zinc-900 text-[15px] mb-2">
                        Filières
                    </h3>
                    <p class="text-[13px] text-zinc-500 leading-relaxed">
                        Organisez les filières par niveau et secteur d'activité
                        avec leurs options spécifiques.
                    </p>
                </div>

                {{-- Carte 4 : Affectations & Rapports --}}
                <div class="group bg-white rounded-2xl border border-zinc-200 p-6
                            hover:border-emerald-300 hover:shadow-[0_4px_20px_-4px_rgba(16,185,129,0.15)]
                            transition-all duration-200">
                    <div class="w-11 h-11 rounded-xl bg-emerald-50 border border-emerald-100
                                flex items-center justify-center mb-5
                                group-hover:bg-emerald-100 transition-colors">
                        <span class="material-symbols-rounded text-emerald-600 text-[22px]"
                              style="font-variation-settings: 'FILL' 1;">description</span>
                    </div>
                    <h3 class="font-bold text-zinc-900 text-[15px] mb-2">
                        Rapports
                    </h3>
                    <p class="text-[13px] text-zinc-500 leading-relaxed">
                        Suivez les affectations et générez des rapports PDF
                        professionnels en un clic.
                    </p>
                </div>
            </div>
        </section>

        {{-- ==================== LIENS DE CONNEXION ==================== --}}
        <section class="max-w-6xl mx-auto px-6 lg:px-8 pb-24">

            <div class="text-center mb-10">
                <h2 class="text-2xl font-bold text-zinc-900 tracking-tight">
                    Accédez à votre espace
                </h2>
                <p class="text-[14px] text-zinc-500 mt-2">
                    Choisissez votre profil pour vous connecter ou créer un compte
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 max-w-4xl mx-auto">

                {{-- Admin --}}
                <a href="{{ route('admin.login') }}"
                   class="group flex items-center gap-4 p-5 rounded-2xl
                          bg-zinc-900 text-white
                          hover:bg-black hover:-translate-y-0.5
                          transition-all duration-200 shadow-sm hover:shadow-lg">
                    <div class="w-12 h-12 rounded-xl bg-white/10 flex items-center justify-center shrink-0">
                        <span class="material-symbols-rounded text-white text-[22px]"
                              style="font-variation-settings: 'FILL' 1;">admin_panel_settings</span>
                    </div>
                    <div class="flex-1">
                        <div class="font-bold text-[15px]">Administrateur</div>
                        <div class="text-[12px] text-zinc-400 mt-0.5">
                            Gestion du système
                        </div>
                    </div>
                    <span class="material-symbols-rounded text-[20px] text-zinc-400
                                 group-hover:text-white group-hover:translate-x-0.5
                                 transition-all">arrow_forward</span>
                </a>

                {{-- Formateur --}}
                <a href="{{ route('formateur.login') }}"
                   class="group flex items-center gap-4 p-5 rounded-2xl
                          bg-emerald-600 text-white
                          hover:bg-emerald-700 hover:-translate-y-0.5
                          transition-all duration-200 shadow-sm hover:shadow-lg">
                    <div class="w-12 h-12 rounded-xl bg-white/15 flex items-center justify-center shrink-0">
                        <span class="material-symbols-rounded text-white text-[22px]"
                              style="font-variation-settings: 'FILL' 1;">school</span>
                    </div>
                    <div class="flex-1">
                        <div class="font-bold text-[15px]">Formateur</div>
                        <div class="text-[12px] text-emerald-100 mt-0.5">
                            Espace personnel
                        </div>
                    </div>
                    <span class="material-symbols-rounded text-[20px] text-emerald-100
                                 group-hover:text-white group-hover:translate-x-0.5
                                 transition-all">arrow_forward</span>
                </a>

                {{-- Inscription --}}
                <a href="{{ route('formateur.register') }}"
                   class="group flex items-center gap-4 p-5 rounded-2xl
                          bg-white border-2 border-zinc-200 text-zinc-900
                          hover:border-emerald-300 hover:-translate-y-0.5
                          transition-all duration-200 shadow-sm hover:shadow-lg">
                    <div class="w-12 h-12 rounded-xl bg-emerald-50 border border-emerald-100
                                flex items-center justify-center shrink-0">
                        <span class="material-symbols-rounded text-emerald-600 text-[22px]"
                              style="font-variation-settings: 'FILL' 1;">person_add</span>
                    </div>
                    <div class="flex-1">
                        <div class="font-bold text-[15px]">Inscription</div>
                        <div class="text-[12px] text-zinc-500 mt-0.5">
                            Créer un compte
                        </div>
                    </div>
                    <span class="material-symbols-rounded text-[20px] text-zinc-400
                                 group-hover:text-emerald-600 group-hover:translate-x-0.5
                                 transition-all">arrow_forward</span>
                </a>

            </div>
        </section>
    </main>

    {{-- ============================================================
         FOOTER
         ============================================================ --}}
    <footer class="border-t border-zinc-200 bg-zinc-50">
        <div class="max-w-6xl mx-auto px-6 lg:px-8 py-8">

            <div class="flex flex-col md:flex-row items-center justify-between gap-4">

                {{-- Brand --}}
                <div class="flex items-center gap-2.5">
                    <div class="w-7 h-7 rounded-lg bg-zinc-900 flex items-center justify-center">
                        <span class="material-symbols-rounded text-white text-[16px]"
                              style="font-variation-settings: 'FILL' 1;">school</span>
                    </div>
                    <span class="font-bold text-zinc-900 text-[13px] tracking-tight">
                        SGFORMATEURS
                    </span>
                </div>

                {{-- Copyright --}}
                <p class="text-[12px] text-zinc-500 text-center md:text-left">
                    © {{ date('Y') }} - Ministère de l'Enseignement Technique
                    et de la Formation Professionnelle
                </p>

                {{-- Status --}}
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