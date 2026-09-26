@extends('pdf.layouts.base')
@section('title', 'Liste des affectations')
@section('doc-title', 'LISTE DES AFFECTATIONS')
@section('doc-subtitle', 'Nombre total : ' . $affectations->count() . ' affectation(s)')

@section('content')
<table>
    <thead>
        <tr>
            <th style="width: 20%;">Formateur</th>
            <th style="width: 20%;">Filière</th>
            <th style="width: 20%;">Établissement</th>
            <th style="width: 13%;">Début</th>
            <th style="width: 13%;">Fin</th>
            <th style="width: 14%;">Statut</th>
        </tr>
    </thead>
    <tbody>
        @forelse($affectations as $a)
            <tr>
                <td>
                    <strong>{{ $a->formateur->nom ?? '-' }} {{ $a->formateur->prenom ?? '' }}</strong>
                    <br>
                    <span style="font-size:9px; color:#666;">{{ $a->formateur->matricule ?? '' }}</span>
                </td>
                <td>
                    <strong>{{ $a->filiere->code ?? '-' }}</strong>
                    <br>
                    <span style="font-size:9px;">{{ Str::limit($a->filiere->libelle ?? '', 35) }}</span>
                </td>
                <td>{{ $a->etablissement->nom ?? '-' }}</td>
                <td>{{ $a->date_debut?->format('d/m/Y') ?? '-' }}</td>
                <td>{{ $a->date_fin?->format('d/m/Y') ?? 'En cours' }}</td>
                <td><span class="badge badge-{{ $a->statut }}">{{ ucfirst($a->statut) }}</span></td>
            </tr>
        @empty
            <tr><td colspan="6" class="no-data">Aucune affectation trouvée</td></tr>
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