<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\HistoriqueService;
use App\Services\NotificationService;
use Illuminate\Http\Request;
use Infrastructure\Persistence\Eloquent\Models\DemandeSessionModel;
use Infrastructure\Persistence\Eloquent\Models\FormateurModel;
use Infrastructure\Persistence\Eloquent\Models\SessionModel;

class DemandeSessionAdminController extends Controller
{
    public function index(Request $request)
    {
        $query = DemandeSessionModel::with(['formateur', 'filiere', 'etablissement'])
            ->latest();

        if ($request->filled('statut')) {
            $query->where('statut', $request->statut);
        }

        $demandes = $query->paginate(20)->withQueryString();

        $stats = [
            'total'      => DemandeSessionModel::count(),
            'en_attente' => DemandeSessionModel::where('statut', 'en_attente')->count(),
            'approuvees' => DemandeSessionModel::where('statut', 'approuvee')->count(),
            'refusees'   => DemandeSessionModel::where('statut', 'refusee')->count(),
        ];

        return view('admin.demandes.sessions.index', compact('demandes', 'stats'));
    }

    /**
     * Approuver -> crée une session ACTIVE
     */
    public function approuver(Request $request, int $id)
    {
        $demande = DemandeSessionModel::findOrFail($id);

        $formateur = FormateurModel::find($demande->formateur_id);
        if (!$formateur) {
            return back()->with('error', 'Formateur introuvable');
        }

        // 1. Mettre à jour la demande
        $demande->update([
            'statut'        => DemandeSessionModel::STATUT_APPROUVEE,
            'reponse_admin' => $request->input('reponse_admin', 'Demande approuvée.'),
            'traitee_le'    => now(),
        ]);

        // 2. [AJAX] Créer la session en ACTIF
        $session = SessionModel::create([
            'code'             => SessionModel::generateNextCode(),
            'titre'            => $demande->titre ?? 'Session de formation',
            'filiere_id'       => $demande->filiere_id,
            'formateur_id'     => $demande->formateur_id,
            'etablissement_id' => $demande->etablissement_id,
            'date_debut'       => $demande->date_debut_souhaitee ?? now()->toDateString(),
            'date_fin'         => $demande->date_fin_souhaitee ?? now()->addMonths(6)->toDateString(),
            'nb_places'        => 0,
            'statut'           => 'actif',  // [AJAX] ACTIF
        ]);

        // 3. Historique
        HistoriqueService::session(
            formateurId:    $demande->formateur_id,
            codeSession:    $session->code,
            titre:          $session->titre,
            filiere:        $demande->filiere?->libelle,
            etablissement:  $demande->etablissement?->nom,
            sessionId:      $session->id,
            source:         'admin'
        );

        // 4. Notification formateur
        NotificationService::demandeSessionTraitee($demande);

        return redirect()
            ->route('admin.sessions.index')
            ->with('success', 'Demande approuvée. Session créée et active. Formateur notifié.');
    }

    /**
     * Refuser -> crée une session SUSPENDUE
     */
    public function refuser(Request $request, int $id)
    {
        $demande = DemandeSessionModel::findOrFail($id);

        // 1. Mettre à jour la demande
        $demande->update([
            'statut'        => DemandeSessionModel::STATUT_REFUSEE,
            'reponse_admin' => $request->input('reponse_admin', 'Demande refusée.'),
            'traitee_le'    => now(),
        ]);

        // 2. [AJAX] Créer la session en SUSPENDU (pour historique)
        SessionModel::create([
            'code'             => SessionModel::generateNextCode(),
            'titre'            => $demande->titre ?? 'Session de formation',
            'filiere_id'       => $demande->filiere_id,
            'formateur_id'     => $demande->formateur_id,
            'etablissement_id' => $demande->etablissement_id,
            'date_debut'       => $demande->date_debut_souhaitee ?? now()->toDateString(),
            'date_fin'         => $demande->date_fin_souhaitee ?? now()->addMonths(6)->toDateString(),
            'nb_places'        => 0,
            'statut'           => 'suspendu',  // [AJAX] SUSPENDU
        ]);

        // 3. Notification formateur
        NotificationService::demandeSessionTraitee($demande);

        return redirect()
            ->route('admin.demandes-sessions.index')
            ->with('success', 'Demande refusée. Session créée en suspendu. Formateur notifié.');
    }
}