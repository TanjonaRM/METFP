<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class InstallHomeAsLogin extends Command
{
    protected $signature = 'project:install-home-as-login
                            {--backup : Sauvegarder les fichiers existants (.bak)}
                            {--force : Écraser sans confirmation}';

    protected $description = 'Page d\'accueil style login : vert émeraude à gauche, blanc à droite';

    public function handle(): int
    {
        $this->info("✨ Installation de la page d'accueil (style login inversé)");
        $this->newLine();

        if (!$this->option('force') && !$this->confirm('Remplacer welcome.blade.php ?', true)) {
            $this->warn('Annulé.');
            return self::FAILURE;
        }

        $path = 'resources/views/welcome.blade.php';
        $content = $this->getWelcomePage();
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

        $this->newLine();
        $this->info("[CLEAN] Nettoyage des caches...");
        $this->call('view:clear');
        $this->call('cache:clear');

        $this->newLine();
        $this->info("✨ SUCCÈS");
        $this->info("-> Ouvrez http://localhost:8000/");

        return self::SUCCESS;
    }

    protected function getWelcomePage(): string
    {
        return <<<'BLADE'
@extends('layouts.guest')

@section('title', 'Bienvenue - SGFORMATEURS')

@section('content')

<div class="min-h-screen flex bg-zinc-50">

    {{-- ============================================================
         COLONNE GAUCHE : VERT ÉMERAUDE + Image (côté login inversé)
         ============================================================ --}}
    <div class="hidden lg:flex lg:w-[45%] relative overflow-hidden order-1">

        {{-- Image --}}
        <img src="https://images.unsplash.com/photo-1523240795612-9a054b0db644?auto=format&fit=crop&w=1600&q=80"
             alt="Salle de formation"
             class="absolute inset-0 w-full h-full object-cover object-center">

        {{-- Overlay vert émeraude --}}
        <div class="absolute inset-0 bg-gradient-to-br
                    from-emerald-900/85 via-emerald-800/75 to-zinc-900/85"></div>

        {{-- Grille subtile --}}
        <div class="absolute inset-0 opacity-[0.08]"
             style="background-image:
                    linear-gradient(rgba(255,255,255,0.5) 1px, transparent 1px),
                    linear-gradient(90deg, rgba(255,255,255,0.5) 1px, transparent 1px);
                    background-size: 60px 60px;"></div>

        {{-- Contenu --}}
        <div class="relative z-10 flex flex-col justify-between p-12 text-white w-full">

            {{-- Top --}}
            <div class="flex items-center gap-2 text-[11px] font-bold
                        tracking-[0.14em] uppercase text-emerald-200">
                <span class="w-6 h-px bg-emerald-300"></span>
                METFP · Madagascar
            </div>

            {{-- Citation centrale --}}
            <div>
                <div class="rule-emerald !bg-emerald-300 mb-8"></div>

                <p class="font-display text-3xl lg:text-4xl font-bold leading-[1.15]
                          tracking-tight max-w-md">
                    La gestion des formateurs,
                    <span class="text-emerald-300">simplifiée.</span>
                </p>

                <p class="text-[14px] text-emerald-100/80 mt-6 max-w-sm leading-relaxed">
                    Une plateforme centralisée pour piloter l'ensemble
                    du réseau de formation professionnelle.
                </p>
            </div>

            {{-- Stats en bas --}}
            <div class="flex items-center gap-6 pt-6 border-t border-white/15">
                <div>
                    <div class="font-display text-2xl font-bold text-white">14+</div>
                    <div class="text-[10px] text-emerald-200 uppercase tracking-widest mt-1">
                        Établissements
                    </div>
                </div>
                <div class="w-px h-8 bg-white/20"></div>
                <div>
                    <div class="font-display text-2xl font-bold text-white">80+</div>
                    <div class="text-[10px] text-emerald-200 uppercase tracking-widest mt-1">
                        Filières
                    </div>
                </div>
                <div class="w-px h-8 bg-white/20"></div>
                <div>
                    <div class="font-display text-2xl font-bold text-white">5</div>
                    <div class="text-[10px] text-emerald-200 uppercase tracking-widest mt-1">
                        Niveaux
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ============================================================
         COLONNE DROITE : BLANC/ZINC (contenu accueil)
         ============================================================ --}}
    <div class="flex-1 flex flex-col order-2">

        {{-- Barre décorative verte --}}
        <div class="h-[3px] bg-emerald-600"></div>

        {{-- Header --}}
        <header class="border-b border-zinc-200">
            <div class="px-6 lg:px-12 h-16 flex items-center justify-between">

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
                             tracking-[0.14em] uppercase text-zinc-500">
                    <span class="w-6 h-px bg-zinc-300"></span>
                    METFP · Madagascar
                </span>
            </div>
        </header>

        {{-- Contenu --}}
        <div class="flex-1 flex items-center justify-center px-6 py-12 lg:py-16">
            <div class="w-full max-w-xl">

                {{-- Label + Titre --}}
                <div class="label-caps">Plateforme officielle</div>
                <div class="rule-emerald mt-3 mb-6"></div>

                <h1 class="font-display text-4xl sm:text-5xl lg:text-6xl font-bold
                           text-zinc-900 leading-[1.05] tracking-tight">
                    Système de
                    <br>
                    Gestion des
                    <br>
                    <span class="text-emerald-600">Formateurs.</span>
                </h1>

                <p class="text-[15px] text-zinc-600 mt-6 leading-relaxed max-w-md">
                    Plateforme officielle du Ministère de l'Enseignement
                    Technique et de la Formation Professionnelle pour la
                    gestion centralisée des formateurs et de leur écosystème.
                </p>

                {{-- Objectif --}}
                <div class="mt-10 pt-8 border-t border-zinc-200">
                    <div class="label-caps mb-4">Objectif</div>
                    <p class="text-[15px] text-zinc-700 leading-relaxed">
                        Centraliser la gestion des
                        <span class="text-emerald-600 font-semibold">formateurs</span>
                        et de leur écosystème : établissements, filières,
                        affectations, sessions et rapports - dans une seule plateforme.
                    </p>
                </div>

                {{-- Accès --}}
                <div class="mt-10 pt-8 border-t border-zinc-200">
                    <div class="label-caps mb-5">Accès</div>

                    <div class="space-y-3">

                        {{-- CONNEXION --}}
                        <a href="{{ route('admin.login') }}"
                           class="group flex items-center justify-between gap-4
                                  w-full px-6 py-4 rounded-xl
                                  bg-zinc-900 text-white
                                  hover:bg-black transition-all duration-200">
                            <div class="flex items-center gap-4">
                                <span class="material-symbols-rounded text-[22px] text-emerald-400"
                                      style="font-variation-settings: 'FILL' 1;">login</span>
                                <div class="text-left">
                                    <div class="font-semibold text-[15px]">Connexion</div>
                                    <div class="text-[12px] text-zinc-400 mt-0.5">
                                        Accédez à votre espace
                                    </div>
                                </div>
                            </div>
                            <span class="material-symbols-rounded text-[20px] text-zinc-400
                                         group-hover:text-emerald-400
                                         group-hover:translate-x-1 transition-all">
                                arrow_forward
                            </span>
                        </a>

                        {{-- INSCRIPTION --}}
                        <a href="{{ route('formateur.register') }}"
                           class="group flex items-center justify-between gap-4
                                  w-full px-6 py-4 rounded-xl
                                  bg-white border-2 border-zinc-200
                                  hover:border-emerald-500 transition-all duration-200">
                            <div class="flex items-center gap-4">
                                <span class="material-symbols-rounded text-[22px] text-emerald-600"
                                      style="font-variation-settings: 'FILL' 1;">person_add</span>
                                <div class="text-left">
                                    <div class="font-semibold text-[15px] text-zinc-900">
                                        Inscription
                                    </div>
                                    <div class="text-[12px] text-zinc-500 mt-0.5">
                                        Créer un compte formateur
                                    </div>
                                </div>
                            </div>
                            <span class="material-symbols-rounded text-[20px] text-zinc-400
                                         group-hover:text-emerald-600
                                         group-hover:translate-x-1 transition-all">
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
}