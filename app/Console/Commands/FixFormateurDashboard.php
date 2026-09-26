<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class FixFormateurDashboard extends Command
{
    protected $signature = 'project:fix-formateur-dashboard
                            {--backup : Sauvegarder le fichier existant (.bak)}
                            {--force : Écraser sans confirmation}';

    protected $description = 'Réécrit le dashboard formateur (sans références à PresenceModel)';

    public function handle(): int
    {
        $this->info("[TOOL] Réécriture complète du dashboard formateur");
        $this->newLine();

        if (!$this->option('force') && !$this->confirm('Réécrire resources/views/formateur/dashboard/index.blade.php ?', true)) {
            $this->warn('Annulé.');
            return self::FAILURE;
        }

        $path = 'resources/views/formateur/dashboard/index.blade.php';
        $fullPath = base_path($path);

        if (!File::exists(dirname($fullPath))) {
            File::makeDirectory(dirname($fullPath), 0755, true);
        }

        if ($this->option('backup') && File::exists($fullPath)) {
            $backupPath = $fullPath . '.bak.' . date('Y-m-d_H-i-s');
            File::copy($fullPath, $backupPath);
            $this->line("  [SAVE] Backup : " . basename($backupPath));
        }

        $content = $this->getDashboardView();
        File::put($fullPath, $content);

        $size = round(strlen($content) / 1024, 2);
        $this->line("  [OK] {$path} ({$size} Ko)");

        $this->newLine();
        $this->info("[CLEAN] Nettoyage des caches...");
        $this->call('view:clear');
        $this->call('cache:clear');

        $this->newLine();
        $this->info("✨ SUCCÈS : dashboard formateur corrigé");
        $this->line("  * Aucune référence à PresenceModel");
        $this->line("  * Aucune variable \$nbPresences");
        $this->line("  * Testez : http://localhost:8000/formateur/dashboard");

        return self::SUCCESS;
    }

    protected function getDashboardView(): string
    {
        return <<<'BLADE'
@extends('layouts.formateur')
@section('title', 'Tableau de bord')

@section('content')

{{-- ============================================================
     HERO - Bandeau de bienvenue
     ============================================================ --}}
<div class="bg-linear-to-br from-emerald-600 via-teal-700 to-emerald-800
            rounded-3xl p-10 text-white mb-8 relative overflow-hidden
            shadow-[0_20px_40px_rgba(13,148,136,0.22)]">

    <div class="absolute -top-12 -right-12 w-64 h-64 rounded-full"
         style="background: radial-gradient(circle, rgba(255,255,255,0.15) 0%, transparent 70%);"></div>
    <div class="absolute -bottom-20 right-24 w-52 h-52 rounded-full"
         style="background: radial-gradient(circle, rgba(255,255,255,0.12) 0%, transparent 70%);"></div>

    <div class="relative z-10">
        <div class="flex items-center gap-2 text-[13px] text-white/80 mb-3">
            <span class="material-symbols-rounded text-base">waving_hand</span>
            Bonjour
        </div>

        <h1 class="font-display text-3xl font-bold">
            {{ $formateur->prenom }} {{ $formateur->nom }}
        </h1>

        <p class="text-white/70 text-sm mt-2">
            Bienvenue dans votre espace formateur SGFORMATEURS
        </p>

        <div class="inline-flex items-center gap-2 mt-4 px-3 py-1.5 rounded-full
                    bg-white/15 backdrop-blur-sm">
            <span class="material-symbols-rounded text-sm">badge</span>
            <span class="text-sm font-mono">{{ $formateur->matricule }}</span>
        </div>
    </div>
</div>

{{-- ============================================================
     STATISTIQUES - 3 cartes
     ============================================================ --}}
<div class="grid grid-cols-1 sm:grid-cols-3 gap-5 mb-8">

    {{-- Carte 1 : Affectations --}}
    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6
                border-l-4 border-green-500">
        <div class="flex items-center gap-3 mb-3">
            <span class="material-symbols-rounded text-green-600 text-2xl"
                  style="font-variation-settings: 'FILL' 1;">assignment_ind</span>
        </div>
        <div class="font-display text-3xl font-bold text-slate-900">
            {{ $stats['affectations'] ?? 0 }}
        </div>
        <div class="text-[13px] text-slate-500 mt-1">Affectations</div>
    </div>

    {{-- Carte 2 : Sessions --}}
    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6
                border-l-4 border-emerald-500">
        <div class="flex items-center gap-3 mb-3">
            <span class="material-symbols-rounded text-emerald-600 text-2xl"
                  style="font-variation-settings: 'FILL' 1;">event</span>
        </div>
        <div class="font-display text-3xl font-bold text-slate-900">
            {{ $stats['sessions'] ?? 0 }}
        </div>
        <div class="text-[13px] text-slate-500 mt-1">Sessions</div>
    </div>

    {{-- Carte 3 : Filière --}}
    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6
                border-l-4 border-teal-500">
        <div class="flex items-center gap-3 mb-3">
            <span class="material-symbols-rounded text-teal-600 text-2xl"
                  style="font-variation-settings: 'FILL' 1;">school</span>
        </div>
        <div class="font-display text-3xl font-bold text-slate-900">
            {{ $formateurMetier?->filiere?->libelle ?? '-' }}
        </div>
        <div class="text-[13px] text-slate-500 mt-1">Ma filière</div>
    </div>
</div>

{{-- ============================================================
     ACTIONS RAPIDES
     ============================================================ --}}
<h2 class="font-display text-xl font-bold text-slate-900 mb-4">Actions rapides</h2>

<div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-8">

    {{-- Mes affectations --}}
    <a href="{{ route('formateur.affectations.index') }}"
       class="group bg-white rounded-2xl border border-slate-100 shadow-sm
              hover:shadow-lg hover:-translate-y-0.5 transition-all
              p-6 border-l-4 border-green-500 no-underline">
        <div class="flex items-center gap-3 mb-3">
            <div class="w-11 h-11 rounded-xl bg-green-50 flex items-center justify-center
                        text-green-600 group-hover:scale-105 transition">
                <span class="material-symbols-rounded"
                      style="font-variation-settings: 'FILL' 1;">assignment_ind</span>
            </div>
        </div>
        <h3 class="font-display font-bold text-slate-900">Mes affectations</h3>
        <p class="text-[13px] text-slate-500 mt-1">
            Consulter mes filières et établissements
        </p>
    </a>

    {{-- Mes sessions --}}
    <a href="{{ route('formateur.sessions.index') }}"
       class="group bg-white rounded-2xl border border-slate-100 shadow-sm
              hover:shadow-lg hover:-translate-y-0.5 transition-all
              p-6 border-l-4 border-green-500 no-underline">
        <div class="flex items-center gap-3 mb-3">
            <div class="w-11 h-11 rounded-xl bg-green-50 flex items-center justify-center
                        text-green-600 group-hover:scale-105 transition">
                <span class="material-symbols-rounded"
                      style="font-variation-settings: 'FILL' 1;">event</span>
            </div>
        </div>
        <h3 class="font-display font-bold text-slate-900">Mes sessions</h3>
        <p class="text-[13px] text-slate-500 mt-1">
            Voir les sessions de formation
        </p>
    </a>

    {{-- Mon profil --}}
    <a href="{{ route('formateur.profile.edit') }}"
       class="group bg-white rounded-2xl border border-slate-100 shadow-sm
              hover:shadow-lg hover:-translate-y-0.5 transition-all
              p-6 border-l-4 border-emerald-500 no-underline">
        <div class="flex items-center gap-3 mb-3">
            <div class="w-11 h-11 rounded-xl bg-emerald-50 flex items-center justify-center
                        text-emerald-600 group-hover:scale-105 transition">
                <span class="material-symbols-rounded"
                      style="font-variation-settings: 'FILL' 1;">person</span>
            </div>
        </div>
        <h3 class="font-display font-bold text-slate-900">Mon profil</h3>
        <p class="text-[13px] text-slate-500 mt-1">
            Modifier mes informations personnelles
        </p>
    </a>
</div>

{{-- ============================================================
     EXPORTS PDF
     ============================================================ --}}
<h2 class="font-display text-xl font-bold text-slate-900 mb-4">Exports PDF</h2>

<div class="grid grid-cols-1 sm:grid-cols-2 gap-4">

    {{-- Mes affectations PDF --}}
    <a href="{{ route('formateur.pdf.mes-affectations') }}" target="_blank"
       class="group bg-linear-to-br from-red-500 to-red-700 text-white
              rounded-2xl p-6 hover:shadow-lg hover:-translate-y-0.5
              transition-all no-underline">
        <div class="flex items-center gap-3 mb-2">
            <span class="material-symbols-rounded"
                  style="font-variation-settings: 'FILL' 1;">picture_as_pdf</span>
        </div>
        <div class="font-display font-bold">Mes affectations PDF</div>
        <div class="text-[13px] text-red-100 mt-1">
            Liste complète de mes affectations
        </div>
    </a>

    {{-- Ma fiche PDF --}}
    <a href="{{ route('formateur.pdf.ma-fiche') }}" target="_blank"
       class="group bg-linear-to-br from-slate-600 to-slate-800 text-white
              rounded-2xl p-6 hover:shadow-lg hover:-translate-y-0.5
              transition-all no-underline">
        <div class="flex items-center gap-3 mb-2">
            <span class="material-symbols-rounded"
                  style="font-variation-settings: 'FILL' 1;">badge</span>
        </div>
        <div class="font-display font-bold">Ma fiche formateur</div>
        <div class="text-[13px] text-slate-300 mt-1">
            Télécharger ma fiche complète
        </div>
    </a>
</div>

@endsection
BLADE;
    }
}