<?php

namespace App\Http\Controllers\Formateur;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Infrastructure\Persistence\Eloquent\Models\FormateurModel;
use Infrastructure\Persistence\Eloquent\Models\AffectationModel;
use Infrastructure\Persistence\Eloquent\Models\SessionModel;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::guard('formateur')->user();

        // Récupérer la fiche métier formateur
        $formateurMetier = FormateurModel::with([
                'etablissement',
                'filiere.niveau',
                'filiere.secteur',
            ])
            ->where('matricule', $user->matricule)
            ->orWhere('email', $user->email)
            ->first();

        // Statistiques
        $stats = [
            'affectations' => $formateurMetier
                ? AffectationModel::where('formateur_id', $formateurMetier->id)->count()
                : 0,
            'sessions' => $formateurMetier
                ? SessionModel::where('formateur_id', $formateurMetier->id)->count()
                : 0,
            'sessions_actives' => $formateurMetier
                ? SessionModel::where('formateur_id', $formateurMetier->id)
                    ->where('statut', 'actif')
                    ->where('date_fin', '>=', now())
                    ->count()
                : 0,
        ];

        // 3 dernières sessions
        $dernieresSessions = $formateurMetier
            ? SessionModel::with(['filiere', 'etablissement'])
                ->where('formateur_id', $formateurMetier->id)
                ->latest('date_debut')
                ->take(3)
                ->get()
            : collect();

        // Dernières affectations
        $dernieresAffectations = $formateurMetier
            ? AffectationModel::with(['filiere', 'etablissement'])
                ->where('formateur_id', $formateurMetier->id)
                ->latest('date_debut')
                ->take(3)
                ->get()
            : collect();

        return view('formateur.dashboard.index', compact(
            'user',
            'formateurMetier',
            'stats',
            'dernieresSessions',
            'dernieresAffectations'
        ));
    }
}