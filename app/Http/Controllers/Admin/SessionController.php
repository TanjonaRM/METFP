<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Infrastructure\Persistence\Eloquent\Models\DemandeSessionModel;
use Infrastructure\Persistence\Eloquent\Models\EtablissementModel;
use Infrastructure\Persistence\Eloquent\Models\FormateurModel;
use Infrastructure\Persistence\Eloquent\Models\SessionModel;

class SessionController extends Controller
{
    public function index()
    {
        $sessions = SessionModel::with(['formateur', 'filiere', 'etablissement'])
            ->search(request('search'))
            ->when(request('statut'), fn($q, $s) => $q->where('statut', $s))
            ->when(request('etablissement_id'), fn($q, $id) => $q->where('etablissement_id', $id))
            ->orderBy('date_debut', 'desc')
            ->paginate(20)
            ->withQueryString();

        $demandes = DemandeSessionModel::with(['formateur', 'filiere', 'etablissement'])
            ->latest()
            ->paginate(20, ['*'], 'demandes_page');

        $statsDemandes = [
            'total'      => DemandeSessionModel::count(),
            'en_attente' => DemandeSessionModel::where('statut', 'en_attente')->count(),
            'approuvees' => DemandeSessionModel::where('statut', 'approuvee')->count(),
            'refusees'   => DemandeSessionModel::where('statut', 'refusee')->count(),
        ];

        $etablissements = EtablissementModel::orderBy('nom')->get();
        $formateurs = FormateurModel::orderBy('nom')->get();

        return view('admin.sessions.index', compact(
            'sessions', 'demandes', 'statsDemandes',
            'etablissements', 'formateurs'
        ));
    }

    public function show(int $id)
    {
        $session = SessionModel::with(['formateur', 'filiere', 'etablissement'])->findOrFail($id);
        return view('admin.sessions.show', compact('session'));
    }
}