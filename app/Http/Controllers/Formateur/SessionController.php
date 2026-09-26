<?php

namespace App\Http\Controllers\Formateur;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Infrastructure\Persistence\Eloquent\Models\DemandeSessionModel;
use Infrastructure\Persistence\Eloquent\Models\EtablissementModel;
use Infrastructure\Persistence\Eloquent\Models\FiliereModel;
use Infrastructure\Persistence\Eloquent\Models\FormateurModel;
use Infrastructure\Persistence\Eloquent\Models\SessionModel;

class SessionController extends Controller
{
    private function getFormateurMetier()
    {
        $user = Auth::guard('formateur')->user();
        if (!$user) return null;

        return FormateurModel::where('matricule', $user->matricule)
            ->orWhere('email', $user->email)
            ->first();
    }

    public function index()
    {
        $formateurMetier = $this->getFormateurMetier();

        // Listes pour la modal
        $filieres = FiliereModel::orderBy('libelle')->get();
        $etablissements = EtablissementModel::orderBy('nom')->get();

        if (!$formateurMetier) {
            return view('formateur.sessions.index', [
                'sessions'        => collect(),
                'demandes'        => collect(),
                'formateurMetier' => null,
                'filieres'        => $filieres,
                'etablissements'  => $etablissements,
            ]);
        }

        // Sessions actives
        $sessions = SessionModel::where('formateur_id', $formateurMetier->id)
            ->with(['filiere.niveau', 'filiere.secteur', 'etablissement'])
            ->latest('date_debut')
            ->get();

        // [AJAX] Historique des demandes
        $demandes = DemandeSessionModel::with(['filiere', 'etablissement'])
            ->where('formateur_id', $formateurMetier->id)
            ->latest()
            ->get();

        return view('formateur.sessions.index', compact(
            'sessions',
            'demandes',
            'formateurMetier',
            'filieres',
            'etablissements'
        ));
    }

    public function show(int $id)
    {
        $formateurMetier = $this->getFormateurMetier();
        abort_if(!$formateurMetier, 403);

        $session = SessionModel::where('formateur_id', $formateurMetier->id)
            ->with(['filiere.niveau', 'filiere.secteur', 'etablissement'])
            ->findOrFail($id);

        return view('formateur.sessions.show', compact('session', 'formateurMetier'));
    }
}