<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class RemoveStatutsChartAddToCard extends Command
{
    protected $signature = 'project:remove-statuts-chart-add-to-card
                            {--backup : Sauvegarder le fichier existant (.bak)}
                            {--force : Écraser sans confirmation}';

    protected $description = 'Supprime le graphique Statut + ajoute les statuts à la carte Formateurs (au survol)';

    public function handle(): int
    {
        $this->info("[DEL]️  Suppression du graphique Statut + ajout à la carte Formateurs");
        $this->newLine();

        if (!$this->option('force') && !$this->confirm('Réécrire resources/views/admin/dashboard/index.blade.php ?', true)) {
            $this->warn('Annulé.');
            return self::FAILURE;
        }

        $path = 'resources/views/admin/dashboard/index.blade.php';
        $fullPath = base_path($path);

        if (!File::exists(dirname($fullPath))) {
            File::makeDirectory(dirname($fullPath), 0755, true);
        }

        if ($this->option('backup') && File::exists($fullPath)) {
            $backupPath = $fullPath . '.bak.' . date('Y-m-d_H-i-s');
            File::copy($fullPath, $backupPath);
            $this->line("  [SAVE] Backup : " . basename($backupPath));
        }

        $content = $this->getDashboard();
        File::put($fullPath, $content);

        $size = round(strlen($content) / 1024, 2);
        $this->line("  [OK] {$path} ({$size} Ko)");

        $this->newLine();
        $this->info("[CLEAN] Nettoyage des caches...");
        $this->call('view:clear');
        $this->call('cache:clear');

        $this->newLine();
        $this->info("✨ SUCCÈS");
        $this->line("  * Graphique 'Statut des formateurs' supprimé");
        $this->line("  * Carte Formateurs enrichie : Actifs / Suspendus / Inactifs");
        $this->line("  * Détails visibles AU SURVOL de la carte Formateurs");
        $this->line("  * Autres cartes, graphiques, tableau : intacts");

        return self::SUCCESS;
    }

    protected function getDashboard(): string
    {
        return <<<'BLADE'
@extends('layouts.admin')
@section('title', 'Tableau de bord')

@section('content')

<style>
    /* =========================================================
       CARTES STATS AVEC HOVER + BOUTON
    ========================================================= */
    .stat-card-hover {
        position: relative;
        background: white;
        border: 1px solid #e4e4e7;
        border-radius: 16px;
        padding: 20px;
        display: flex;
        align-items: flex-start;
        gap: 16px;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        overflow: hidden;
        cursor: pointer;
        min-height: 130px;
    }

    .stat-card-hover:hover {
        border-color: #a7f3d0;
        box-shadow: 0 12px 30px -10px rgba(5, 150, 105, 0.2);
        transform: translateY(-2px);
    }

    .stat-card-hover::before {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(180deg,
                    transparent 0%,
                    transparent 60%,
                    rgba(5, 150, 105, 0.04) 100%);
        opacity: 0;
        transition: opacity 0.3s ease;
        pointer-events: none;
    }
    .stat-card-hover:hover::before {
        opacity: 1;
    }

    .stat-card-content {
        display: flex;
        align-items: flex-start;
        gap: 16px;
        flex: 1;
        transition: transform 0.3s ease;
    }

    .stat-card-btn {
        position: absolute;
        bottom: 16px;
        right: 16px;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 8px 14px;
        border-radius: 8px;
        background: #059669;
        color: white;
        font-size: 12px;
        font-weight: 600;
        text-decoration: none;
        opacity: 0;
        transform: translateY(10px);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        pointer-events: none;
        z-index: 3;
        white-space: nowrap;
    }

    .stat-card-hover:hover .stat-card-btn {
        opacity: 1;
        transform: translateY(0);
        pointer-events: auto;
    }

    .stat-card-btn:hover {
        background: #047857;
        transform: translateY(-1px) scale(1.02);
        box-shadow: 0 6px 16px -4px rgba(5, 150, 105, 0.4);
    }

    .stat-card-btn .material-symbols-rounded {
        font-size: 16px;
    }

    .stat-card-hover:hover .stat-card-content {
        transform: translateY(-6px);
    }

    .stat-card-hover .stat-icon {
        transition: transform 0.3s ease, background 0.3s ease;
    }
    .stat-card-hover:hover .stat-icon {
        transform: scale(1.08);
    }

    /* =========================================================
       DÉTAILS STATUT FORMATEURS - visibles uniquement au survol
    ========================================================= */
    .stat-status-details {
        position: absolute;
        left: 20px;
        right: 20px;
        bottom: 16px;
        display: flex;
        align-items: center;
        gap: 10px;
        opacity: 0;
        transform: translateY(12px);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        pointer-events: none;
        z-index: 2;
    }

    .stat-card-hover:hover .stat-status-details {
        opacity: 1;
        transform: translateY(0);
        pointer-events: auto;
    }

    .stat-status-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 5px 10px;
        border-radius: 8px;
        font-size: 11px;
        font-weight: 700;
        white-space: nowrap;
    }

    .stat-status-badge .dot {
        width: 6px;
        height: 6px;
        border-radius: 50%;
    }

    .stat-status-badge .count {
        font-weight: 800;
        font-size: 12px;
    }

    /* Couleurs des badges */
    .badge-actif-stat {
        background: #ecfdf5;
        color: #047857;
    }
    .badge-actif-stat .dot {
        background: #10b981;
    }

    .badge-suspendu-stat {
        background: #fffbeb;
        color: #b45309;
    }
    .badge-suspendu-stat .dot {
        background: #f59e0b;
    }

    .badge-inactif-stat {
        background: #f4f4f5;
        color: #52525b;
    }
    .badge-inactif-stat .dot {
        background: #a1a1aa;
    }
</style>

<div class="mb-6">
    <h1 class="font-display text-2xl font-bold text-slate-900">Tableau de bord</h1>
    <p class="text-sm text-slate-500 mt-1">Vue d'ensemble de la gestion des formateurs</p>
</div>

{{-- ============ STATISTIQUES AVEC BOUTONS AU SURVOL ============ --}}
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">

    {{-- Carte 1 : Formateurs (avec détails statuts au survol) --}}
    <a href="{{ route('admin.formateurs.index') }}" class="stat-card-hover">
        <div class="stat-card-content">
            <div class="stat-icon bg-emerald-50">
                <span class="material-symbols-rounded text-emerald-600 text-2xl"
                      style="font-variation-settings: 'FILL' 1;">groups</span>
            </div>
            <div class="flex-1">
                <div class="stat-value">{{ $stats['formateurs'] ?? 0 }}</div>
                <div class="stat-label">Formateurs</div>
                <div class="stat-trend-up mt-1">
                    <span class="material-symbols-rounded text-[12px] align-middle">trending_up</span>
                    +12% ce mois
                </div>
            </div>
        </div>

        {{-- [AJAX] Détails statuts : visibles UNIQUEMENT au survol --}}
        <div class="stat-status-details">
            <span class="stat-status-badge badge-actif-stat">
                <span class="dot"></span>
                <span class="count">{{ $formateursParStatut['actif'] ?? 0 }}</span>
                Actif
            </span>
            <span class="stat-status-badge badge-suspendu-stat">
                <span class="dot"></span>
                <span class="count">{{ $formateursParStatut['suspendu'] ?? 0 }}</span>
                Suspendu
            </span>
            <span class="stat-status-badge badge-inactif-stat">
                <span class="dot"></span>
                <span class="count">{{ $formateursParStatut['inactif'] ?? 0 }}</span>
                Inactif
            </span>
        </div>
    </a>

    {{-- Carte 2 : Établissements --}}
    <a href="{{ route('admin.etablissements.index') }}" class="stat-card-hover">
        <div class="stat-card-content">
            <div class="stat-icon bg-teal-50">
                <span class="material-symbols-rounded text-teal-600 text-2xl"
                      style="font-variation-settings: 'FILL' 1;">apartment</span>
            </div>
            <div class="flex-1">
                <div class="stat-value">{{ $stats['etablissements'] ?? 0 }}</div>
                <div class="stat-label">Établissements</div>
                <div class="stat-trend-up mt-1">
                    <span class="material-symbols-rounded text-[12px] align-middle">trending_up</span>
                    +3% ce mois
                </div>
            </div>
        </div>
        <span class="stat-card-btn">
            Voir plus
            <span class="material-symbols-rounded">arrow_forward</span>
        </span>
    </a>

    {{-- Carte 3 : Filières --}}
    <a href="{{ route('admin.filieres.index') }}" class="stat-card-hover">
        <div class="stat-card-content">
            <div class="stat-icon bg-green-50">
                <span class="material-symbols-rounded text-green-600 text-2xl"
                      style="font-variation-settings: 'FILL' 1;">school</span>
            </div>
            <div class="flex-1">
                <div class="stat-value">{{ $stats['filieres'] ?? 0 }}</div>
                <div class="stat-label">Filières</div>
                <div class="stat-trend-up mt-1">
                    <span class="material-symbols-rounded text-[12px] align-middle">trending_up</span>
                    +5% ce mois
                </div>
            </div>
        </div>
        <span class="stat-card-btn">
            Voir plus
            <span class="material-symbols-rounded">arrow_forward</span>
        </span>
    </a>

    {{-- Carte 4 : Affectations --}}
    <a href="{{ route('admin.affectations.index') }}" class="stat-card-hover">
        <div class="stat-card-content">
            <div class="stat-icon bg-lime-50">
                <span class="material-symbols-rounded text-lime-600 text-2xl"
                      style="font-variation-settings: 'FILL' 1;">assignment_ind</span>
            </div>
            <div class="flex-1">
                <div class="stat-value">{{ $stats['affectations'] ?? 0 }}</div>
                <div class="stat-label">Affectations</div>
                <div class="stat-trend-up mt-1">
                    <span class="material-symbols-rounded text-[12px] align-middle">trending_up</span>
                    +3% ce mois
                </div>
            </div>
        </div>
        <span class="stat-card-btn">
            Voir plus
            <span class="material-symbols-rounded">arrow_forward</span>
        </span>
    </a>
</div>

{{-- ============================================================
     GRAPHIQUES - 3 graphiques restants
     ============================================================ --}}
<div class="grid grid-cols-1 lg:grid-cols-2 gap-5 mb-6">

    {{-- Graphique 1 : Barres horizontales --}}
    <div class="bg-white rounded-xl border border-slate-200 p-5">
        <div class="flex items-center justify-between mb-4">
            <h2 class="font-display font-bold text-slate-900">Formateurs par établissement</h2>
            <span class="text-xs text-slate-400">Top 6</span>
        </div>
        <div id="chart-etablissements" style="min-height: 280px;"></div>
    </div>

    {{-- Graphique 3 : Courbe --}}
    <div class="bg-white rounded-xl border border-slate-200 p-5">
        <div class="flex items-center justify-between mb-4">
            <h2 class="font-display font-bold text-slate-900">Évolution des affectations</h2>
            <span class="text-xs text-slate-400">6 derniers mois</span>
        </div>
        <div id="chart-evolution" style="min-height: 280px;"></div>
    </div>
</div>

{{-- ============ DERNIÈRES AFFECTATIONS ============ --}}
<div class="bg-white rounded-xl border border-slate-200 overflow-hidden">
    <div class="px-5 py-4 border-b flex justify-between items-center">
        <h2 class="font-display font-bold text-slate-900">Dernières affectations</h2>
        <a href="{{ route('admin.affectations.index') }}" class="text-xs font-semibold text-brand-700">
            Voir tout ->
        </a>
    </div>
    <table class="table-modern">
        <thead>
            <tr>
                <th>Formateur</th>
                <th>Filière</th>
                <th>Établissement</th>
                <th>Période</th>
                <th>Statut</th>
            </tr>
        </thead>
        <tbody>
            @forelse($dernieresAffectations as $a)
            <tr>
                <td class="font-semibold">{{ $a->formateur->nom ?? '-' }} {{ $a->formateur->prenom ?? '' }}</td>
                <td>{{ $a->filiere->libelle ?? '-' }}</td>
                <td>{{ $a->etablissement->nom ?? '-' }}</td>
                <td class="text-xs">
                    {{ $a->date_debut?->format('d/m/Y') }}
                    -> {{ $a->date_fin?->format('d/m/Y') ?? 'En cours' }}
                </td>
                <td>
                    @if($a->statut === 'actif')
                        <span class="badge-success">Actif</span>
                    @elseif($a->statut === 'termine')
                        <span class="badge-gray">Terminé</span>
                    @else
                        <span class="badge-warning">Suspendu</span>
                    @endif
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="text-center py-8 text-slate-400 text-sm">
                    Aucune affectation
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

{{-- ============================================================
     SCRIPTS - APEXCHARTS (3 graphiques restants)
     ============================================================ --}}
<script src="https://cdn.jsdelivr.net/npm/apexcharts@3.45.2/dist/apexcharts.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', () => {

        // ============================================================
        // GRAPHIQUE 1 : Barres horizontales - Formateurs par établissement
        // ============================================================
        const dataEtablissements = @json($formateursParEtablissement ?? []);
        if (dataEtablissements.length) {
            new ApexCharts(document.querySelector('#chart-etablissements'), {
                chart: {
                    type: 'bar',
                    height: 280,
                    toolbar: { show: false },
                    fontFamily: 'Inter, sans-serif',
                },
                series: [{
                    name: 'Formateurs',
                    data: dataEtablissements.map(e => e.count),
                }],
                xaxis: {
                    categories: dataEtablissements.map(e => e.nom),
                    labels: { style: { fontSize: '11px', colors: '#71717a' } },
                },
                yaxis: {
                    labels: { style: { fontSize: '11px', colors: '#71717a' } },
                },
                plotOptions: {
                    bar: {
                        horizontal: true,
                        borderRadius: 6,
                        barHeight: '55%',
                    },
                },
                colors: ['#059669'],
                dataLabels: {
                    enabled: true,
                    style: { fontSize: '11px', fontWeight: 600, colors: ['#ffffff'] },
                },
                grid: {
                    borderColor: '#f1f5f9',
                    strokeDashArray: 3,
                    xaxis: { lines: { show: true } },
                    yaxis: { lines: { show: false } },
                },
                tooltip: { y: { formatter: val => `${val} formateur(s)` } },
            }).render();
        }

        // ============================================================
        // GRAPHIQUE 2 : Courbe - Évolution des affectations
        // ============================================================
        const evolution = @json($evolutionAffectations ?? []);
        if (evolution.length) {
            new ApexCharts(document.querySelector('#chart-evolution'), {
                chart: {
                    type: 'area',
                    height: 280,
                    toolbar: { show: false },
                    fontFamily: 'Inter, sans-serif',
                },
                series: [{
                    name: 'Affectations',
                    data: evolution.map(e => e.count),
                }],
                xaxis: {
                    categories: evolution.map(e => e.label),
                    labels: { style: { fontSize: '11px', colors: '#71717a' } },
                    axisBorder: { show: false },
                    axisTicks: { show: false },
                },
                yaxis: {
                    labels: { style: { fontSize: '11px', colors: '#71717a' } },
                    min: 0,
                    forceNiceScale: true,
                },
                colors: ['#059669'],
                fill: {
                    type: 'gradient',
                    gradient: {
                        shadeIntensity: 1,
                        opacityFrom: 0.4,
                        opacityTo: 0.05,
                        stops: [0, 100],
                    },
                },
                stroke: { curve: 'smooth', width: 3 },
                markers: {
                    size: 5,
                    colors: ['#059669'],
                    strokeColors: '#ffffff',
                    strokeWidth: 2,
                    hover: { size: 7 },
                },
                grid: { borderColor: '#f1f5f9', strokeDashArray: 3 },
                dataLabels: { enabled: false },
                tooltip: { y: { formatter: val => `${val} affectation(s)` } },
            }).render();
        }
    });
</script>

@endsection
BLADE;
    }
}