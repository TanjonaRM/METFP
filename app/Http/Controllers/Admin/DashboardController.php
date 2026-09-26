<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Infrastructure\Persistence\Eloquent\Models\FormateurModel;
use Infrastructure\Persistence\Eloquent\Models\EtablissementModel;
use Infrastructure\Persistence\Eloquent\Models\FiliereModel;
use Infrastructure\Persistence\Eloquent\Models\AffectationModel;
use App\Models\Notification;

class DashboardController extends Controller
{
    public function index()
    {
        $data = $this->getDashboardData();

        return view('admin.dashboard.index', $data);
    }

    /**
     * Endpoint AJAX - retourne les données en JSON
     */
    public function data()
    {
        return response()->json($this->getDashboardData());
    }

    /**
     * Récupère TOUTES les données du dashboard (utilisé par index + data)
     */
    protected function getDashboardData(): array
    {
        // ========== KPI CARDS ==========
        $stats = [
            'formateurs'     => FormateurModel::count(),
            'etablissements' => EtablissementModel::count(),
            'filieres'       => FiliereModel::count(),
            'affectations'   => AffectationModel::count(),
        ];

        // ========== STATUT DES FORMATEURS ==========
        $formateursParStatut = [
            'actif'    => FormateurModel::where('statut', 'actif')->count(),
            'suspendu' => FormateurModel::where('statut', 'suspendu')->count(),
            'inactif'  => FormateurModel::where('statut', 'inactif')->count(),
        ];

        // ========== GRAPHIQUE 1 : Formateurs par établissement ==========
        $formateursParEtablissement = EtablissementModel::withCount('formateurs')
            ->orderBy('formateurs_count', 'desc')
            ->take(6)
            ->get()
            ->map(fn($e) => [
                'nom'   => $e->nom,
                'count' => $e->formateurs_count,
            ])
            ->toArray();

        // ========== GRAPHIQUE 2 : Évolution des affectations ==========
        $evolutionAffectations = [];
        for ($i = 5; $i >= 0; $i--) {
            $date = now()->subMonths($i);
            $evolutionAffectations[] = [
                'label' => $date->translatedFormat('M Y'),
                'count' => AffectationModel::whereYear('created_at', $date->year)
                    ->whereMonth('created_at', $date->month)
                    ->count(),
            ];
        }

        // ========== TABLEAU ==========
        $dernieresAffectations = AffectationModel::with(['formateur', 'filiere', 'etablissement'])
            ->latest()
            ->take(5)
            ->get()
            ->map(fn($a) => [
                'id'            => $a->id,
                'formateur'     => ($a->formateur->nom ?? '-') . ' ' . ($a->formateur->prenom ?? ''),
                'filiere'       => $a->filiere->libelle ?? '-',
                'etablissement' => $a->etablissement->nom ?? '-',
                'date_debut'    => $a->date_debut?->format('d/m/Y'),
                'date_fin'      => $a->date_fin?->format('d/m/Y') ?? 'En cours',
                'statut'        => $a->statut,
            ])
            ->toArray();

        return compact(
            'stats',
            'formateursParStatut',
            'formateursParEtablissement',
            'evolutionAffectations',
            'dernieresAffectations'
        );
    }

    public function search(Request $request)
    {
        $term = $request->input('q', '');
        if (strlen($term) < 2) return response()->json([]);

        $s = '%' . $term . '%';
        $formateurs = FormateurModel::where(function ($q) use ($s) {
                $q->where('nom', 'like', $s)
                  ->orWhere('prenom', 'like', $s)
                  ->orWhere('matricule', 'like', $s);
            })
            ->limit(5)
            ->get()
            ->map(fn($f) => [
                'type'  => 'formateur',
                'id'    => $f->id,
                'label' => $f->nom . ' ' . $f->prenom . ' (' . $f->matricule . ')',
                'url'   => route('admin.formateurs.show', $f->id),
            ]);

        return response()->json($formateurs->values());
    }

    public function notifications()
    {
        $notifications = Notification::latest()->take(15)->get()->map(fn($n) => [
            'id' => $n->id,
            'titre' => $n->titre,
            'message' => $n->message,
            'type' => $n->type,
            'icone' => $n->icone,
            'lu' => $n->lu,
            'lien' => $n->lien,
            'date' => $n->created_at?->diffForHumans(),
        ]);

        $nonLues = Notification::where('lu', false)->count();

        return response()->json([
            'notifications' => $notifications,
            'non_lues' => $nonLues,
        ]);
    }

    public function markNotificationAsRead($id)
    {
        Notification::findOrFail($id)->update(['lu' => true]);
        return response()->json(['success' => true]);
    }

    public function markAllNotificationsAsRead()
    {
        Notification::where('lu', false)->update(['lu' => true]);
        return response()->json(['success' => true]);
    }

    public function formateursByEtablissement(Request $request)
    {
        $etablissementId = $request->input('etablissement_id');

        $data = \Infrastructure\Persistence\Eloquent\Models\FormateurModel::query()
            ->when($etablissementId, fn($q) => $q->where('etablissement_id', $etablissementId))
            ->selectRaw('etablissement_id, COUNT(*) as total')
            ->groupBy('etablissement_id')
            ->with('etablissement')
            ->get();

        return response()->json($data);
    }
}