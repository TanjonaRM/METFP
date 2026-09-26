@extends('pdf.layouts.base')
@section('title', 'Formateurs par filière')
@section('doc-title', 'FORMATEURS PAR FILIÈRE')
@section('doc-subtitle', 'Nombre total : ' . $filieres->count() . ' filière(s)')

@section('content')

@forelse($filieres as $filiere)
    <div class="info-box">
        <h3>{{ $filiere->libelle }} - ({{ $filiere->code }})</h3>
        @if($filiere->description)
            <p style="font-size: 10px; color: #666; margin-top: 4px;">
                {{ Str::limit($filiere->description, 120) }}
            </p>
        @endif
    </div>

    <table>
        <thead>
            <tr>
                <th style="width: 5%;">#</th>
                <th style="width: 15%;">Matricule</th>
                <th style="width: 30%;">Nom complet</th>
                <th style="width: 25%;">Email</th>
                <th style="width: 15%;">Établissement</th>
                <th style="width: 10%;">Statut</th>
            </tr>
        </thead>
        <tbody>
            @forelse($filiere->formateurs as $i => $f)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td><strong>{{ $f->matricule }}</strong></td>
                    <td>{{ $f->prenom }} {{ $f->nom }}</td>
                    <td>{{ $f->email ?? '-' }}</td>
                    <td>{{ $f->etablissement->nom ?? '-' }}</td>
                    <td><span class="badge badge-{{ $f->statut }}">{{ ucfirst($f->statut) }}</span></td>
                </tr>
            @empty
                <tr><td colspan="6" class="no-data">Aucun formateur rattaché à cette filière</td></tr>
            @endforelse
        </tbody>
    </table>
    <p style="font-size: 10px; color: #666; margin-bottom: 20px;">
        <strong>Total :</strong> {{ $filiere->formateurs->count() }} formateur(s)
    </p>
@empty
    <div class="no-data">Aucune filière trouvée</div>
@endforelse

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