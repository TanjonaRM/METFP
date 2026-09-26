<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class AddDashboardChartsData extends Command
{
    protected $signature = 'project:add-dashboard-charts-data
                            {--backup : Sauvegarder le controller existant}
                            {--force : Écraser sans confirmation}';

    protected $description = 'Ajoute les données des graphiques au DashboardController';

    public function handle(): int
    {
        $this->info("[STATS] Mise à jour du DashboardController");

        if (!$this->option('force') && !$this->confirm('Réécrire DashboardController ?', true)) {
            return self::FAILURE;
        }

        $path = 'app/Http/Controllers/Admin/DashboardController.php';
        $fullPath = base_path($path);

        if ($this->option('backup') && File::exists($fullPath)) {
            File::copy($fullPath, $fullPath . '.bak.' . date('Y-m-d_H-i-s'));
            $this->line("  [SAVE] Backup effectué");
        }

        File::put($fullPath, $this->getController());
        $this->line("  [OK] {$path}");

        $this->call('view:clear');
        $this->call('cache:clear');
        $this->info("✨ SUCCÈS");

        return self::SUCCESS;
    }

    protected function getController(): string
    {
        return <<<'PHP'
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
        // ========== KPI CARDS ==========
        $stats = [
            'formateurs'     => FormateurModel::count(),
            'etablissements' => EtablissementModel::count(),
            'filieres'       => FiliereModel::count(),
            'affectations'   => AffectationModel::count(),
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

        // ========== GRAPHIQUE 2 : Statut des formateurs ==========
        $formateursParStatut = [
            'actif'    => FormateurModel::where('statut', 'actif')->count(),
            'suspendu' => FormateurModel::where('statut', 'suspendu')->count(),
            'inactif'  => FormateurModel::where('statut', 'inactif')->count(),
        ];

        // ========== GRAPHIQUE 3 : Évolution des affectations ==========
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

        // ========== GRAPHIQUE 4 : Filières par secteur ==========
        $filieresParSecteur = DB::table('secteurs')
            ->leftJoin('filieres', 'filieres.secteur_id', '=', 'secteurs.id')
            ->select('secteurs.libelle as label', DB::raw('COUNT(filieres.id) as count'))
            ->groupBy('secteurs.id', 'secteurs.libelle')
            ->orderBy('count', 'desc')
            ->get()
            ->map(fn($s) => ['label' => $s->label, 'count' => (int) $s->count])
            ->toArray();

        // ========== TABLEAU ==========
        $dernieresAffectations = AffectationModel::with(['formateur', 'filiere', 'etablissement'])
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard.index', compact(
            'stats',
            'formateursParEtablissement',
            'formateursParStatut',
            'evolutionAffectations',
            'filieresParSecteur',
            'dernieresAffectations'
        ));
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
}
PHP;
    }
}