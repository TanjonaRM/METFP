<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Application\Notifications\Services\NotificationService;
use Illuminate\Http\Request;
use Infrastructure\Persistence\Eloquent\Models\EtablissementModel;

class EtablissementController extends Controller
{
    /**
     * Liste des établissements avec filtres
     */
    public function index()
    {
        $etablissements = EtablissementModel::withCount(['formateurs', 'sessions'])
            ->search(request('search'))
            ->when(request('type'), fn($q, $t) => $q->where('type', $t))
            ->when(request('statut'), fn($q, $s) => $q->where('statut', $s))
            ->when(request('region'), fn($q, $r) => $q->where('region', $r))
            ->orderBy('nom')
            ->paginate(15)
            ->withQueryString();

        $regions = EtablissementModel::query()
            ->whereNotNull('region')
            ->distinct()
            ->orderBy('region')
            ->pluck('region');

        return view('admin.etablissements.index', compact('etablissements', 'regions'));
    }

    /**
     * Formulaire de création
     */
        public function create(Request $request)
    {
        // Requête AJAX -> renvoie JSON avec le HTML du formulaire
        if ($request->ajax()
            || $request->wantsJson()
            || $request->header('X-Requested-With') === 'XMLHttpRequest') {

            $errors = session()->get('errors', new \Illuminate\Support\ViewErrorBag());

            $html = view('admin.etablissements.partials._form', [
                'errors' => $errors,
            ])->render();

            return response()->json(['html' => $html]);
        }

        // Requête normale -> vue complète
        return view('admin.etablissements.create');
    }

    /**
     * Enregistrer un nouvel établissement
     */
                public function store(Request $request)
    {
        $isAjax = $request->ajax() || $request->wantsJson() || $request->header('X-Requested-With') === 'XMLHttpRequest';

        // [AJAX] Vérifier si un établissement avec le même NOM existe déjà
        $nomExistant = \Infrastructure\Persistence\Eloquent\Models\EtablissementModel::where('nom', $request->nom)->first();

        if ($nomExistant) {
            $message = "Cet établissement existe déjà : \"{$nomExistant->nom}\" (code : {$nomExistant->code})";

            if ($isAjax) {
                return response()->json([
                    'success' => false,
                    'errors'  => ['nom' => [$message]],
                ], 422);
            }

            return back()->withInput()->withErrors(['nom' => $message]);
        }

        try {
            $validated = $request->validate([
                'code'                => 'nullable|string|unique:etablissements,code',
                'nom'                 => 'required|string|max:150',
                'type'                => 'required|in:CFP,LTP,Lycee,Autre',
                'region'              => 'nullable|string|max:100',
                'adresse'             => 'nullable|string|max:255',
                'contact_responsable' => 'nullable|string|max:150',
                'email'               => 'nullable|email|max:150',
                'statut'              => 'required|in:actif,inactif,suspendu',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            if ($isAjax) {
                return response()->json([
                    'success' => false,
                    'errors'  => $e->errors(),
                ], 422);
            }
            throw $e;
        }

                // [AJAX] Auto-génération du code : TYPE-PREMIER-MOT + suffixe unique
        if (empty($validated['code'])) {
            $type = strtoupper(trim($validated['type'] ?? 'ETB'));
            $nom  = trim($validated['nom'] ?? '');

            // Retirer le type du début du nom si présent
            $nom = preg_replace('/^' . preg_quote($type, '/') . '\s+/i', '', $nom);

            // Prendre le premier mot (ou les 3 premiers caractères si trop court)
            $parts = preg_split('/[\s\-]+/', $nom);
            $mot   = strtoupper($parts[0] ?? 'X');

            if (strlen($mot) < 2) {
                $mot = strtoupper(substr(preg_replace('/\s+/', '', $nom), 0, 3));
            }
            if (empty($mot)) {
                $mot = 'X';
            }

            // Base du code : TYPE-MOT
            $baseCode = $type . '-' . $mot;
            $code     = $baseCode;
            $counter  = 1;

            // Boucler tant que le code existe déjà
            // CFP-TANJONA existe -> CFP-TANJONA-2 -> CFP-TANJONA-3 -> etc.
            while (\Infrastructure\Persistence\Eloquent\Models\EtablissementModel::where('code', $code)->exists()) {
                $counter++;
                $code = $baseCode . '-' . $counter;

                // Sécurité anti-boucle-infinie
                if ($counter > 999) {
                    $code = $baseCode . '-' . time();
                    break;
                }
            }

            $validated['code'] = $code;
        }

        $etablissement = \Infrastructure\Persistence\Eloquent\Models\EtablissementModel::create($validated);

        // Notification (non bloquante)
        try {
            if (class_exists(\App\Services\NotificationService::class)
                && method_exists(\App\Services\NotificationService::class, 'etablissementCree')) {
                \App\Services\NotificationService::etablissementCree($etablissement);
            }
        } catch (\Throwable $e) {
            \Log::warning('Notification échouée : ' . $e->getMessage());
        }

        // Réponse selon le type de requête
        if ($isAjax) {
            return response()->json([
                'success'  => true,
                'message'  => 'Établissement créé avec succès.',
                'redirect' => route('admin.etablissements.index'),
            ]);
        }

        return redirect()
            ->route('admin.etablissements.index')
            ->with('success', 'Établissement créé avec succès.');
    }

    /**
     * Afficher un établissement + ses formateurs + ses sessions
     */
    public function show(int $id)
    {
        $etablissement = EtablissementModel::with([
            'formateurs' => function ($q) {
                $q->orderBy('nom')->orderBy('prenom');
            },
            'formateurs.filiere',
            'sessions' => function ($q) {
                $q->with(['formateur', 'filiere'])->latest();
            },
        ])->findOrFail($id);

        return view('admin.etablissements.show', compact('etablissement'));
    }

    /**
     * Formulaire d'édition
     */
    public function edit(int $id)
    {
        $etablissement = EtablissementModel::findOrFail($id);
        return view('admin.etablissements.edit', compact('etablissement'));
    }

    /**
     * Mettre à jour un établissement
     */
    public function update(Request $request, int $id)
    {
        $etablissement = EtablissementModel::findOrFail($id);

        $validated = $request->validate([
            'code'                => 'required|string|unique:etablissements,code,' . $id,
            'nom'                 => 'required|string|max:150',
            'type'                => 'required|in:CFP,LTP,Lycee,Autre',
            'region'              => 'nullable|string|max:100',
            'adresse'             => 'nullable|string|max:255',
            'contact_responsable' => 'nullable|string|max:150',
            'email'               => 'nullable|email|max:150',
            'statut'              => 'required|in:actif,inactif,suspendu',
        ]);

        $etablissement->update($validated);

        return redirect()->route('admin.etablissements.index')
            ->with('success', 'Établissement mis à jour.');
    }

    /**
     * Supprimer un établissement
     */
    public function destroy(int $id)
    {
        $etablissement = EtablissementModel::findOrFail($id);
        $nom = $etablissement->nom;
        $etablissement->delete();

        NotificationService::suppression('Établissement', $nom);

        return redirect()->route('admin.etablissements.index')
            ->with('success', 'Établissement supprimé.');
    }
}