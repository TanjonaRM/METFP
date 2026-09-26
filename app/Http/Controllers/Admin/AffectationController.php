<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Application\Notifications\Services\NotificationService;
use Illuminate\Http\Request;
use Infrastructure\Persistence\Eloquent\Models\AffectationModel;
use Infrastructure\Persistence\Eloquent\Models\DemandeAffectationModel;
use Infrastructure\Persistence\Eloquent\Models\EtablissementModel;
use Infrastructure\Persistence\Eloquent\Models\FiliereModel;
use Infrastructure\Persistence\Eloquent\Models\FormateurModel;
use Infrastructure\Persistence\Eloquent\Models\SessionModel;

class AffectationController extends Controller
{
    public function index()
    {
        // Affectations
        $affectations = AffectationModel::with(['formateur', 'filiere', 'etablissement'])
            ->when(request('search'), function ($q, $s) {
                $q->whereHas('formateur', function ($qq) use ($s) {
                    $qq->where('nom', 'like', "%{$s}%")
                       ->orWhere('prenom', 'like', "%{$s}%")
                       ->orWhere('matricule', 'like', "%{$s}%");
                });
            })
            ->when(request('statut'), fn($q, $s) => $q->where('statut', $s))
            ->when(request('etablissement_id'), fn($q, $id) => $q->where('etablissement_id', $id))
            ->when(request('filiere_id'), fn($q, $id) => $q->where('filiere_id', $id))
            ->latest('date_debut')
            ->paginate(20)
            ->withQueryString();

        // Demandes
        $demandes = DemandeAffectationModel::with(['formateur', 'filiere', 'etablissement'])
            ->latest()
            ->paginate(20, ['*'], 'demandes_page');

        $statsDemandes = [
            'total'      => DemandeAffectationModel::count(),
            'en_attente' => DemandeAffectationModel::where('statut', 'en_attente')->count(),
            'approuvees' => DemandeAffectationModel::where('statut', 'approuvee')->count(),
            'refusees'   => DemandeAffectationModel::where('statut', 'refusee')->count(),
        ];

        $etablissements = EtablissementModel::orderBy('nom')->get();
        $filieres = FiliereModel::orderBy('libelle')->get();

        return view('admin.affectations.index', compact(
            'affectations', 'demandes', 'statsDemandes',
            'etablissements', 'filieres'
        ));
    }

    public function create()
    {
        $formateurs = FormateurModel::orderBy('nom')->get();
        $filieres = FiliereModel::orderBy('libelle')->get();
        $etablissements = EtablissementModel::orderBy('nom')->get();

        if (request()->ajax()) {
            return response()->json([
                'html' => view('admin.affectations.partials.form', compact(
                    'formateurs', 'filieres', 'etablissements'
                ))->render(),
            ]);
        }

        return view('admin.affectations.create', compact('formateurs', 'filieres', 'etablissements'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'formateur_id'     => 'required|exists:formateurs,id',
            'filiere_id'       => 'required|exists:filieres,id',
            'etablissement_id' => 'required|exists:etablissements,id',
            'date_debut'       => 'required|date',
            'date_fin'         => 'nullable|date|after_or_equal:date_debut',
            'statut'           => 'required|in:actif,termine,suspendu',
        ]);

        $affectation = AffectationModel::create($validated);

        $formateur = FormateurModel::find($validated['formateur_id']);
        $filiere = FiliereModel::find($validated['filiere_id']);

        if ($formateur && $filiere) {
            $code = SessionModel::generateNextCode();
            SessionModel::create([
                'code'             => $code,
                'titre'            => 'Session ' . $filiere->libelle,
                'filiere_id'       => $validated['filiere_id'],
                'formateur_id'     => $validated['formateur_id'],
                'etablissement_id' => $validated['etablissement_id'],
                'date_debut'       => $validated['date_debut'],
                'date_fin'         => $validated['date_fin'] ?? now()->addMonths(6)->toDateString(),
                'nb_places'        => 0,
                'statut'           => 'actif',
            ]);

            NotificationService::sessionCreee($code, $formateur->prenom . ' ' . $formateur->nom);
            NotificationService::affectationCreee($formateur->prenom . ' ' . $formateur->nom, $filiere->libelle);
        }

        if ($request->ajax()) {
            return response()->json([
                'success'  => true,
                'redirect' => route('admin.affectations.index'),
            ]);
        }

        return redirect()->route('admin.affectations.index')->with('success', 'Affectation créée.');
    }

    public function show(int $id)
    {
        $affectation = AffectationModel::with(['formateur', 'filiere', 'etablissement'])->findOrFail($id);

        if (request()->ajax()) {
            return response()->json([
                'html' => view('admin.affectations.partials.show', compact('affectation'))->render(),
            ]);
        }

        return view('admin.affectations.show', compact('affectation'));
    }

    public function edit(int $id)
    {
        $affectation = AffectationModel::findOrFail($id);
        $formateurs = FormateurModel::orderBy('nom')->get();
        $filieres = FiliereModel::orderBy('libelle')->get();
        $etablissements = EtablissementModel::orderBy('nom')->get();

        if (request()->ajax()) {
            return response()->json([
                'html' => view('admin.affectations.partials.form', compact(
                    'affectation', 'formateurs', 'filieres', 'etablissements'
                ))->render(),
            ]);
        }

        return view('admin.affectations.edit', compact('affectation', 'formateurs', 'filieres', 'etablissements'));
    }

    public function update(Request $request, int $id)
    {
        $affectation = AffectationModel::findOrFail($id);

        $validated = $request->validate([
            'formateur_id'     => 'required|exists:formateurs,id',
            'filiere_id'       => 'required|exists:filieres,id',
            'etablissement_id' => 'required|exists:etablissements,id',
            'date_debut'       => 'required|date',
            'date_fin'         => 'nullable|date|after_or_equal:date_debut',
            'statut'           => 'required|in:actif,termine,suspendu',
        ]);

        $affectation->update($validated);

        if ($request->ajax()) {
            return response()->json([
                'success'  => true,
                'redirect' => route('admin.affectations.index'),
            ]);
        }

        return redirect()->route('admin.affectations.index')->with('success', 'Affectation mise à jour.');
    }

    public function destroy(int $id)
    {
        AffectationModel::findOrFail($id)->delete();
        return redirect()->route('admin.affectations.index')->with('success', 'Affectation supprimée.');
    }
}