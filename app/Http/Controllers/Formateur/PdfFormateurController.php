<?php

namespace App\Http\Controllers\Formateur;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Infrastructure\Services\PdfExporterInterface;
use Infrastructure\Persistence\Eloquent\Models\FormateurModel;
use Infrastructure\Persistence\Eloquent\Models\AffectationModel;
use Infrastructure\Persistence\Eloquent\Models\SessionModel;

class PdfFormateurController extends Controller
{
    public function __construct(
        private PdfExporterInterface $pdf,
    ) {}

    /**
     * Fiche PDF de mon profil (formateur connecté)
     */
    public function maFiche()
    {
        $formateur = $this->getFormateurConnecte();

        return $this->pdf->generate(
            'pdf.formateurs.fiche',
            compact('formateur'),
            'ma-fiche-' . $formateur->matricule
        );
    }

    /**
     * Liste PDF de mes affectations
     */
    public function mesAffectations()
    {
        $formateur = $this->getFormateurConnecte();

        $affectations = AffectationModel::with(['filiere', 'etablissement'])
            ->where('formateur_id', $formateur->id)
            ->orderBy('date_debut', 'desc')
            ->get();

        return $this->pdf->generate(
            'pdf.affectations.liste',
            compact('affectations', 'formateur'),
            'mes-affectations-' . $formateur->matricule
        );
    }

    /**
     * Liste PDF de mes sessions
     */
    public function mesSessions()
    {
        $formateur = $this->getFormateurConnecte();

        $sessions = SessionModel::with(['filiere', 'etablissement'])
            ->where('formateur_id', $formateur->id)
            ->orderBy('date_debut', 'desc')
            ->get();

        return $this->pdf->generate(
            'pdf.sessions.liste',
            compact('sessions', 'formateur'),
            'mes-sessions-' . $formateur->matricule
        );
    }

    /**
     * Récupère le formateur authentifié ou 404
     */
    private function getFormateurConnecte(): FormateurModel
    {
        $user = Auth::guard('formateur')->user();

        return FormateurModel::with(['etablissement', 'filieres'])
            ->where('matricule', $user->matricule)
            ->firstOrFail();
    }
}