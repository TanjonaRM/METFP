<?php

namespace App\Http\Controllers\Formateur;

use App\Http\Controllers\Controller;
use App\Services\NotificationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Infrastructure\Persistence\Eloquent\Models\DemandeSessionModel;
use Infrastructure\Persistence\Eloquent\Models\EtablissementModel;
use Infrastructure\Persistence\Eloquent\Models\FiliereModel;
use Infrastructure\Persistence\Eloquent\Models\FormateurModel;

class DemandeSessionController extends Controller
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
            return redirect()->route('formateur.sessions.index');
        }

        $demandes = DemandeSessionModel::with(['filiere', 'etablissement'])
            ->where('formateur_id', $formateurMetier->id)
            ->latest()
            ->get();

        $filieres = FiliereModel::orderBy('libelle')->get();
        $etablissements = EtablissementModel::orderBy('nom')->get();

        return view('formateur.demandes.sessions', compact(
            'demandes', 'formateurMetier', 'filieres', 'etablissements'
        ));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'filiere_id'           => 'nullable|exists:filieres,id',
            'etablissement_id'     => 'nullable|exists:etablissements,id',
            'titre'                => 'required|string|max:255',
            'date_debut_souhaitee' => 'nullable|date|after_or_equal:today',
            'date_fin_souhaitee'   => 'nullable|date|after_or_equal:date_debut_souhaitee',
            'motif'                => 'required|string|min:10|max:1000',
        ], [
            'titre.required' => 'Le titre est obligatoire.',
            'motif.required' => 'Le motif est obligatoire.',
            'motif.min'      => 'Le motif doit contenir au moins 10 caractères.',
        ]);

        $formateurMetier = $this->getFormateurMetier();

        if (!$formateurMetier) {
            return back()->withErrors(['error' => 'Profil formateur introuvable.']);
        }

        $demande = DemandeSessionModel::create([
            'formateur_id'         => $formateurMetier->id,
            'filiere_id'           => $validated['filiere_id'] ?? null,
            'etablissement_id'     => $validated['etablissement_id'] ?? null,
            'titre'                => $validated['titre'],
            'date_debut_souhaitee' => $validated['date_debut_souhaitee'] ?? null,
            'date_fin_souhaitee'   => $validated['date_fin_souhaitee'] ?? null,
            'motif'                => $validated['motif'],
            'statut'               => DemandeSessionModel::STATUT_EN_ATTENTE,
        ]);

        // [AJAX] Notification automatique aux admins
        NotificationService::demandeSessionCreee($demande);

        return back()->with('success', 'Votre demande a été envoyée avec succès. L\'administration va la traiter.');
    }
}