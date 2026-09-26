@extends('pdf.layouts.base')
@section('title', 'Statistiques globales')
@section('doc-title', 'STATISTIQUES GLOBALES')
@section('doc-subtitle', 'Rapport généré le ' . now()->format('d/m/Y à H:i'))

@section('content')

{{-- ========== STATISTIQUES GÉNÉRALES ========== --}}
<div class="stats" style="margin-bottom: 20px;">
    <table>
        <tr>
            <td style="width: 25%;">
                <div class="stat-card">
                    <span class="value">{{ $stats['total_formateurs'] }}</span>
                    <span class="label">Formateurs</span>
                </div>
            </td>
            <td style="width: 25%;">
                <div class="stat-card">
                    <span class="value">{{ $stats['total_etablissements'] }}</span>
                    <span class="label">Établissements</span>
                </div>
            </td>
            <td style="width: 25%;">
                <div class="stat-card">
                    <span class="value">{{ $stats['total_filieres'] }}</span>
                    <span class="label">Filières</span>
                </div>
            </td>
            <td style="width: 25%;">
                <div class="stat-card">
                    <span class="value">{{ $stats['total_sessions'] }}</span>
                    <span class="label">Sessions</span>
                </div>
            </td>
        </tr>
    </table>
</div>

{{-- ========== FORMATEURS PAR STATUT ========== --}}
<div class="info-box">
    <h3>Répartition des formateurs par statut</h3>
    <table>
        <tr>
            <td style="width: 40%;"><strong>Actifs :</strong></td>
            <td>{{ $formateursParStatut['actif'] }}</td>
        </tr>
        <tr>
            <td><strong>Inactifs :</strong></td>
            <td>{{ $formateursParStatut['inactif'] }}</td>
        </tr>
        <tr>
            <td><strong>En attente :</strong></td>
            <td>{{ $formateursParStatut['en_attente'] }}</td>
        </tr>
    </table>
</div>

{{-- ========== AFFECTATIONS PAR STATUT ========== --}}
<div class="info-box">
    <h3>Répartition des affectations par statut</h3>
    <table>
        <tr>
            <td style="width: 40%;"><strong>Actives :</strong></td>
            <td>{{ $affectationsParStatut['actif'] }}</td>
        </tr>
        <tr>
            <td><strong>Terminées :</strong></td>
            <td>{{ $affectationsParStatut['termine'] }}</td>
        </tr>
        <tr>
            <td><strong>Suspendues :</strong></td>
            <td>{{ $affectationsParStatut['suspendu'] }}</td>
        </tr>
    </table>
</div>

{{-- ========== FORMATEURS PAR ÉTABLISSEMENT ========== --}}
<h3 style="color: #047857; font-size: 13px; margin: 20px 0 10px 0; font-weight: bold;">
    RÉPARTITION DES FORMATEURS PAR ÉTABLISSEMENT
</h3>

<table>
    <thead>
        <tr>
            <th style="width: 5%;">#</th>
            <th style="width: 50%;">Établissement</th>
            <th style="width: 15%;">Type</th>
            <th style="width: 30%;">Nombre de formateurs</th>
        </tr>
    </thead>
    <tbody>
        @forelse($formateursParEtablissement as $i => $e)
            <tr>
                <td>{{ $i + 1 }}</td>
                <td><strong>{{ $e->nom }}</strong> <span style="color: #666;">({{ $e->code }})</span></td>
                <td>{{ $e->type }}</td>
                <td style="text-align: center;">
                    <strong style="color: #047857; font-size: 12px;">{{ $e->formateurs_count }}</strong>
                </td>
            </tr>
        @empty
            <tr><td colspan="4" class="no-data">Aucun établissement</td></tr>
        @endforelse
    </tbody>
</table>

<div class="signatures">
    <table>
        <tr>
            <td>
                <div class="signature-block">
                    <p class="title">Le Responsable</p>
                    <p class="line">Nom et signature</p>
                </div>
            </td>
        </tr>
    </table>
</div>

@endsection