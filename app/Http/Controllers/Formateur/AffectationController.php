<?php

namespace App\Http\Controllers\Formateur;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Infrastructure\Persistence\Eloquent\Models\AffectationModel;
use Infrastructure\Persistence\Eloquent\Models\FormateurModel;

class AffectationController extends Controller
{
    private function getFormateurMetier()
    {
        $user = Auth::guard('formateur')->user();
        return FormateurModel::where('matricule', $user->matricule)
            ->orWhere('email', $user->email)
            ->first();
    }

    public function index()
    {
        $formateurMetier = $this->getFormateurMetier();

        if (!$formateurMetier) {
            return view('formateur.affectations.index', [
                'affectations' => collect(),
                'formateurMetier' => null,
            ]);
        }

        $affectations = AffectationModel::where('formateur_id', $formateurMetier->id)
            ->with(['filiere.niveau', 'filiere.secteur', 'etablissement'])
            ->latest('date_debut')
            ->get();

        return view('formateur.affectations.index', compact('affectations', 'formateurMetier'));
    }

    public function show(int $id)
    {
        $formateurMetier = $this->getFormateurMetier();
        abort_if(!$formateurMetier, 403);

        $affectation = AffectationModel::where('formateur_id', $formateurMetier->id)
            ->with(['filiere.niveau', 'filiere.secteur', 'filiere.options', 'etablissement'])
            ->findOrFail($id);

        return view('formateur.affectations.show', compact('affectation', 'formateurMetier'));
    }
}