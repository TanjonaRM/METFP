<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class FixSessionControllerLists extends Command
{
    protected $signature = 'project:fix-session-controller-lists
                            {--backup : Sauvegarder le fichier (.bak)}
                            {--force : Écraser sans confirmation}';

    protected $description = 'Ajoute les listes $filieres et $etablissements au SessionController formateur';

    public function handle(): int
    {
        $this->info("[TOOL] Correction du SessionController (listes déroulantes)");
        $this->newLine();

        if (!$this->option('force') && !$this->confirm('Corriger le SessionController ?', true)) {
            $this->warn('Annulé.');
            return self::FAILURE;
        }

        // ============================================================
        // 1. Chemin du fichier
        // ============================================================
        $path = 'app/Http/Controllers/Formateur/SessionController.php';
        $fullPath = base_path($path);

        if (!File::exists($fullPath)) {
            $this->error("[X] Fichier introuvable : {$path}");
            return self::FAILURE;
        }

        // ============================================================
        // 2. Backup
        // ============================================================
        if ($this->option('backup')) {
            $backupPath = $fullPath . '.bak.' . date('Y-m-d_H-i-s');
            File::copy($fullPath, $backupPath);
            $this->line("  [SAVE] Backup : " . basename($backupPath));
        }

        // ============================================================
        // 3. Écrire le nouveau contenu
        // ============================================================
        File::put($fullPath, $this->getController());
        $this->line("  [OK] {$path} mis à jour");

        // ============================================================
        // 4. Vérification : FiliereModel importé ?
        // ============================================================
        $content = File::get($fullPath);
        $checks = [
            'use FiliereModel'      => str_contains($content, 'use Infrastructure\Persistence\Eloquent\Models\FiliereModel;'),
            'use EtablissementModel' => str_contains($content, 'use Infrastructure\Persistence\Eloquent\Models\EtablissementModel;'),
            '$filieres = FiliereModel' => str_contains($content, '$filieres = FiliereModel'),
            '$etablissements = EtablissementModel' => str_contains($content, '$etablissements = EtablissementModel'),
        ];

        $this->newLine();
        $this->info("[SEARCH] Vérification :");
        foreach ($checks as $label => $ok) {
            $this->line("  " . ($ok ? '[OK]' : '[X]') . " {$label}");
        }

        // ============================================================
        // 5. Nettoyer les caches
        // ============================================================
        $this->newLine();
        $this->info("[CLEAN] Nettoyage des caches...");
        $this->call('view:clear');
        $this->call('cache:clear');
        $this->call('route:clear');

        // ============================================================
        // 6. Vérification des données en BDD
        // ============================================================
        $this->newLine();
        $this->info("[STATS] Vérification des données en BDD...");

        try {
            $nbFilieres = \Infrastructure\Persistence\Eloquent\Models\FiliereModel::count();
            $nbEtablissements = \Infrastructure\Persistence\Eloquent\Models\EtablissementModel::count();

            $this->line("  * Filières      : {$nbFilieres}");
            $this->line("  * Établissements : {$nbEtablissements}");

            if ($nbFilieres === 0) {
                $this->warn("  [!]️  Aucune filière en BDD - lancez : php artisan db:seed --class=FiliereSeeder");
            }
            if ($nbEtablissements === 0) {
                $this->warn("  [!]️  Aucun établissement en BDD - lancez : php artisan db:seed --class=EtablissementSeeder");
            }
        } catch (\Exception $e) {
            $this->warn("  [!]️  Impossible de compter : " . $e->getMessage());
        }

        // ============================================================
        // 7. Fin
        // ============================================================
        $this->newLine();
        $this->info("✨ SUCCÈS : SessionController corrigé");
        $this->line("  * \$filieres : liste des filières disponible dans la vue");
        $this->line("  * \$etablissements : liste des établissements disponible");
        $this->newLine();
        $this->info("-> Testez : http://localhost:8000/formateur/sessions");

        return self::SUCCESS;
    }

    // ============================================================
    // CONTENU DU CONTRÔLEUR
    // ============================================================
    protected function getController(): string
    {
        return <<<'PHP'
<?php

namespace App\Http\Controllers\Formateur;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Infrastructure\Persistence\Eloquent\Models\EtablissementModel;
use Infrastructure\Persistence\Eloquent\Models\FiliereModel;
use Infrastructure\Persistence\Eloquent\Models\FormateurModel;
use Infrastructure\Persistence\Eloquent\Models\SessionModel;

class SessionController extends Controller
{
    /**
     * Récupère la fiche formateur liée au compte connecté
     */
    private function getFormateurMetier()
    {
        $user = Auth::guard('formateur')->user();

        if (!$user) {
            return null;
        }

        return FormateurModel::where('matricule', $user->matricule)
            ->orWhere('email', $user->email)
            ->first();
    }

    /**
     * Liste des sessions du formateur
     * [AJAX] Charge aussi les listes pour la modal
     */
    public function index()
    {
        $formateurMetier = $this->getFormateurMetier();

        // [AJAX] Listes pour la modal de demande de session
        $filieres = FiliereModel::orderBy('libelle')->get();
        $etablissements = EtablissementModel::orderBy('nom')->get();

        if (!$formateurMetier) {
            return view('formateur.sessions.index', [
                'sessions'       => collect(),
                'formateurMetier' => null,
                'filieres'       => $filieres,
                'etablissements' => $etablissements,
            ]);
        }

        $sessions = SessionModel::where('formateur_id', $formateurMetier->id)
            ->with(['filiere.niveau', 'filiere.secteur', 'etablissement'])
            ->latest('date_debut')
            ->get();

        return view('formateur.sessions.index', compact(
            'sessions',
            'formateurMetier',
            'filieres',
            'etablissements'
        ));
    }

    /**
     * Détail d'une session
     */
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
PHP;
    }
}