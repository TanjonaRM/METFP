<?php

namespace App\Http\Controllers\Formateur;

use App\Http\Controllers\Controller;
use App\Services\NotificationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Infrastructure\Persistence\Eloquent\Models\DemandeAffectationModel;
use Infrastructure\Persistence\Eloquent\Models\EtablissementModel;
use Infrastructure\Persistence\Eloquent\Models\FiliereModel;
use Infrastructure\Persistence\Eloquent\Models\FormateurModel;

class DemandeAffectationController extends Controller
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

        if (!$formateurMetier) {
            return view('formateur.demandes.index', [
                'demandes' => collect(),
                'formateurMetier' => null,
                'filieres' => collect(),
                'etablissements' => collect(),
            ]);
        }

        $demandes = DemandeAffectationModel::with(['filiere', 'etablissement'])
            ->where('formateur_id', $formateurMetier->id)
            ->latest()
            ->get();

        $filieres = FiliereModel::orderBy('libelle')->get();
        $etablissements = EtablissementModel::orderBy('nom')->get();

        return view('formateur.demandes.index', compact(
            'demandes',
            'formateurMetier',
            'filieres',
            'etablissements'
        ));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'filiere_id'       => 'nullable|exists:filieres,id',
            'etablissement_id' => 'nullable|exists:etablissements,id',
            'date_souhaitee'   => 'nullable|date|after_or_equal:today',
            'motif'            => 'required|string|min:10|max:1000',
        ]);

        $formateurMetier = $this->getFormateurMetier();

        if (!$formateurMetier) {
            return back()->withErrors(['error' => 'Profil formateur introuvable.']);
        }

        $demande = DemandeAffectationModel::create([
            'formateur_id'     => $formateurMetier->id,
            'filiere_id'       => $validated['filiere_id'] ?? null,
            'etablissement_id' => $validated['etablissement_id'] ?? null,
            'date_souhaitee'   => $validated['date_souhaitee'] ?? null,
            'motif'            => $validated['motif'],
            'statut'           => DemandeAffectationModel::STATUT_EN_ATTENTE,
        ]);

        // [AJAX] NOTIFICATION AUTOMATIQUE AUX ADMINS
        NotificationService::demandeAffectationCreee($demande);

        return back()->with('success', 'Votre demande a été envoyée avec succès !');
    }

    public function show(int $id)
    {
        $demande = \Infrastructure\Persistence\Eloquent\Models\DemandeAffectationModel::findOrFail($id);
        return view('formateur.demandes.show', compact('demande'));
    }
}