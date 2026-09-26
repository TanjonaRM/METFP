@extends('layouts.admin')
@section('title', 'Rapports PDF')

@section('content')

<style>
    /* ===========================================================
       CARTES RAPPORTS - même style que le dashboard
    =========================================================== */
    .report-card {
        position: relative;
        background: white;
        border: 1px solid #e4e4e7;
        border-radius: 16px;
        padding: 20px;
        display: flex;
        flex-direction: column;
        gap: 16px;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        overflow: hidden;
        cursor: pointer;
        text-decoration: none;
        color: inherit;
        min-height: 180px;
    }

    .report-card:hover {
        border-color: #a7f3d0;
        box-shadow: 0 12px 30px -10px rgba(5, 150, 105, 0.2);
        transform: translateY(-2px);
    }

    .report-card::before {
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
    .report-card:hover::before {
        opacity: 1;
    }

    .report-card-icon {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: transform 0.3s ease;
        flex-shrink: 0;
    }

    .report-card:hover .report-card-icon {
        transform: scale(1.08);
    }

    .report-card-icon .material-symbols-rounded {
        font-size: 26px;
        font-variation-settings: 'FILL' 1;
    }

    .report-card-title {
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-weight: 700;
        font-size: 15px;
        color: #0f172a;
        line-height: 1.3;
    }

    .report-card-desc {
        font-size: 13px;
        color: #64748b;
        line-height: 1.5;
        margin-top: 4px;
    }

    .report-card-cta {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        font-size: 13px;
        font-weight: 600;
        color: #059669;
        margin-top: auto;
        padding-top: 8px;
    }

    .report-card-cta .material-symbols-rounded {
        font-size: 18px;
        transition: transform 0.3s ease;
    }

    .report-card:hover .report-card-cta .material-symbols-rounded {
        transform: translateX(4px);
    }

    /* ===========================================================
       FORMULAIRES - même style que dashboard
    =========================================================== */
    .export-panel {
        background: white;
        border: 1px solid #e4e4e7;
        border-radius: 16px;
        overflow: hidden;
        transition: all 0.3s ease;
    }

    .export-panel:hover {
        border-color: #d4d4d8;
        box-shadow: 0 4px 12px -4px rgba(0, 0, 0, 0.08);
    }

    .export-panel-header {
        padding: 16px 20px;
        border-bottom: 1px solid #f4f4f5;
        background: #fafafa;
    }

    .export-panel-title {
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-weight: 700;
        font-size: 15px;
        color: #0f172a;
    }

    .export-panel-sub {
        font-size: 12px;
        color: #71717a;
        margin-top: 2px;
    }

    .form-label-modern {
        display: block;
        font-size: 12px;
        font-weight: 600;
        color: #334155;
        margin-bottom: 6px;
    }

    .form-input-modern {
        width: 100%;
        padding: 10px 12px;
        font-size: 13px;
        border: 1px solid #e4e4e7;
        border-radius: 10px;
        background: white;
        transition: all 0.2s ease;
        color: #0f172a;
    }

    .form-input-modern:focus {
        outline: none;
        border-color: #10b981;
        box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.1);
    }

    .btn-export {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        width: 100%;
        padding: 10px 16px;
        font-size: 13px;
        font-weight: 600;
        color: white;
        background: #059669;
        border: none;
        border-radius: 10px;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .btn-export:hover {
        background: #047857;
        transform: translateY(-1px);
        box-shadow: 0 6px 16px -4px rgba(5, 150, 105, 0.4);
    }

    .btn-export:active {
        transform: translateY(0);
    }

    .btn-export .material-symbols-rounded {
        font-size: 18px;
    }
</style>

{{-- ===========================================================
     EN-TÊTE
=========================================================== --}}
<div class="mb-6 flex items-center gap-4">
    <div class="w-14 h-14 rounded-2xl flex items-center justify-center shadow-md"
         style="background: linear-gradient(135deg, #10b981 0%, #047857 100%);">
        <span class="material-symbols-rounded text-white text-3xl"
              style="font-variation-settings: 'FILL' 1;">description</span>
    </div>
    <div>
        <h1 class="font-display text-2xl font-bold text-slate-900">Rapports PDF</h1>
        <p class="text-sm text-slate-500 mt-1">Générez vos rapports et listes au format PDF</p>
    </div>
</div>

{{-- ===========================================================
     CARTES RAPPORTS - même style que dashboard
=========================================================== --}}
@php
    $rapports = [
        [
            'icon'      => 'groups',
            'iconBg'    => 'bg-emerald-50',
            'iconColor' => 'text-emerald-600',
            'titre'     => 'Liste des formateurs',
            'desc'      => 'Exporter la liste complète des formateurs du réseau',
            'route'     => route('admin.pdf.formateurs'),
        ],
        [
            'icon'      => 'apartment',
            'iconBg'    => 'bg-teal-50',
            'iconColor' => 'text-teal-600',
            'titre'     => 'Formateurs par établissement',
            'desc'      => 'Liste des formateurs regroupés par établissement',
            'route'     => route('admin.pdf.formateurs.par-etablissement'),
        ],
        [
            'icon'      => 'school',
            'iconBg'    => 'bg-green-50',
            'iconColor' => 'text-green-600',
            'titre'     => 'Formateurs par filière',
            'desc'      => 'Liste des formateurs regroupés par filière',
            'route'     => route('admin.pdf.formateurs.par-filiere'),
        ],
        [
            'icon'      => 'assignment_ind',
            'iconBg'    => 'bg-lime-50',
            'iconColor' => 'text-lime-600',
            'titre'     => 'Affectations',
            'desc'      => 'Liste complète des affectations des formateurs',
            'route'     => route('admin.pdf.affectations'),
        ],
        [
            'icon'      => 'monitoring',
            'iconBg'    => 'bg-cyan-50',
            'iconColor' => 'text-cyan-600',
            'titre'     => 'Statistiques globales',
            'desc'      => 'Tableau de bord chiffré et statistiques complètes',
            'route'     => route('admin.pdf.statistiques'),
        ],
    ];
@endphp

<div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-4 mb-8">
    @foreach($rapports as $r)
        <a href="{{ $r['route'] }}" target="_blank" class="report-card">
            <div class="flex items-start gap-3">
                <div class="report-card-icon {{ $r['iconBg'] }}">
                    <span class="material-symbols-rounded {{ $r['iconColor'] }}">{{ $r['icon'] }}</span>
                </div>
                <div class="flex-1 min-w-0">
                    <div class="report-card-title">{{ $r['titre'] }}</div>
                    <p class="report-card-desc">{{ $r['desc'] }}</p>
                </div>
            </div>
            <div class="report-card-cta">
                Ouvrir le PDF
                <span class="material-symbols-rounded">arrow_forward</span>
            </div>
        </a>
    @endforeach
</div>

{{-- ===========================================================
     EXPORTS PERSONNALISÉS
=========================================================== --}}
<div class="space-y-5">

    {{-- ----- Export Formateurs ----- --}}
    <div class="export-panel">
        <div class="export-panel-header">
            <div class="export-panel-title">Export personnalisé - Formateurs</div>
            <div class="export-panel-sub">Filtrez la liste avant de générer le PDF</div>
        </div>

        <form method="GET" action="{{ route('admin.pdf.formateurs') }}" target="_blank"
              class="p-5 grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <label class="form-label-modern">Établissement</label>
                <select name="etablissement_id" class="form-input-modern">
                    <option value="">Tous les établissements</option>
                    @foreach($etablissements ?? [] as $e)
                        <option value="{{ $e->id }}">{{ $e->nom }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="form-label-modern">Statut</label>
                <select name="statut" class="form-input-modern">
                    <option value="">Tous les statuts</option>
                    <option value="actif">Actif</option>
                    <option value="inactif">Inactif</option>
                    <option value="suspendu">Suspendu</option>
                </select>
            </div>

            <div class="flex items-end">
                <button type="submit" class="btn-export">
                    <span class="material-symbols-rounded">picture_as_pdf</span>
                    Générer le PDF
                </button>
            </div>
        </form>
    </div>

    {{-- ----- Export Affectations ----- --}}
    <div class="export-panel">
        <div class="export-panel-header">
            <div class="export-panel-title">Export personnalisé - Affectations</div>
            <div class="export-panel-sub">Filtrez les affectations par statut, établissement ou période</div>
        </div>

        <form method="GET" action="{{ route('admin.pdf.affectations') }}" target="_blank"
              class="p-5 grid grid-cols-1 md:grid-cols-4 gap-4">
            <div>
                <label class="form-label-modern">Établissement</label>
                <select name="etablissement_id" class="form-input-modern">
                    <option value="">Tous</option>
                    @foreach($etablissements ?? [] as $e)
                        <option value="{{ $e->id }}">{{ $e->nom }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="form-label-modern">Statut</label>
                <select name="statut" class="form-input-modern">
                    <option value="">Tous</option>
                    <option value="actif">Actif</option>
                    <option value="termine">Terminé</option>
                    <option value="suspendu">Suspendu</option>
                </select>
            </div>

            <div>
                <label class="form-label-modern">Date début (≥)</label>
                <input type="date" name="date_debut" class="form-input-modern">
            </div>

            <div class="flex items-end">
                <button type="submit" class="btn-export">
                    <span class="material-symbols-rounded">picture_as_pdf</span>
                    Générer
                </button>
            </div>
        </form>
    </div>

</div>

@endsection