<?php

namespace Application\Dashboard\UseCases;

use Application\Dashboard\DTOs\DashboardStatsDTO;
use Infrastructure\Persistence\Eloquent\Models\AffectationModel;
use Infrastructure\Persistence\Eloquent\Models\EtablissementModel;
use Infrastructure\Persistence\Eloquent\Models\FiliereModel;
use Infrastructure\Persistence\Eloquent\Models\FormateurModel;
use Infrastructure\Persistence\Eloquent\Models\NotificationModel;

class GetDashboardDataUseCase
{
    public function execute(): DashboardStatsDTO
    {
        // Statistiques globales
        $totalFormateurs = FormateurModel::count();
        $totalEtablissements = EtablissementModel::count();
        $totalFilieres = FiliereModel::count();
        $totalAffectations = AffectationModel::count();

        // Dernières affectations (5 plus récentes)
        $dernieresAffectations = AffectationModel::with([
                'formateur',
                'filiere',
                'etablissement',
            ])
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get()
            ->map(fn($a) => [
                'id' => $a->id,
                'formateur_nom' => $a->formateur?->nom . ' ' . $a->formateur?->prenom,
                'formateur_id' => $a->formateur_id,
                'formateur_matricule' => $a->formateur?->matricule,
                'filiere_libelle' => $a->filiere?->libelle,
                'etablissement_nom' => $a->etablissement?->nom,
                'date_debut' => $a->date_debut?->format('d/m/Y'),
                'date_fin' => $a->date_fin?->format('d/m/Y'),
                'statut' => $a->statut,
                'created_at' => $a->created_at?->diffForHumans(),
            ])
            ->toArray();

        // Notifications (10 plus récentes non lues)
        $notifications = NotificationModel::where('lu', false)
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get()
            ->map(fn($n) => [
                'id' => $n->id,
                'titre' => $n->titre,
                'message' => $n->message,
                'type' => $n->type, // 'info', 'warning', 'success', 'danger'
                'icone' => $n->icone ?? 'bell',
                'lu' => $n->lu,
                'created_at' => $n->created_at?->diffForHumans(),
                'date' => $n->created_at?->format('d/m/Y H:i'),
            ])
            ->toArray();

        // Formateurs par établissement (pour graphique optionnel)
        $formateursParEtablissement = EtablissementModel::withCount('formateurs')
            ->orderBy('formateurs_count', 'desc')
            ->limit(5)
            ->get()
            ->map(fn($e) => [
                'nom' => $e->nom,
                'count' => $e->formateurs_count,
            ])
            ->toArray();

        return new DashboardStatsDTO(
            totalFormateurs: $totalFormateurs,
            totalEtablissements: $totalEtablissements,
            totalFilieres: $totalFilieres,
            totalAffectations: $totalAffectations,
            dernieresAffectations: $dernieresAffectations,
            notifications: $notifications,
            formateursParEtablissement: $formateursParEtablissement,
        );
    }

    /**
     * Récupère les formateurs d'un établissement (pour carte cliquable)
     */
    public function getFormateursByEtablissement(?int $etablissementId = null): array
    {
        $query = FormateurModel::with(['etablissement']);

        if ($etablissementId) {
            $query->where('etablissement_id', $etablissementId);
        }

        return $query->orderBy('nom')
            ->get()
            ->map(fn($f) => [
                'id' => $f->id,
                'matricule' => $f->matricule,
                'nom_complet' => $f->nom . ' ' . $f->prenom,
                'email' => $f->email,
                'telephone' => $f->telephone,
                'etablissement' => $f->etablissement?->nom,
                'statut' => $f->statut,
                'initiales' => strtoupper(substr($f->prenom, 0, 1) . substr($f->nom, 0, 1)),
            ])
            ->toArray();
    }

    /**
     * Recherche globale (formateurs + établissements)
     */
    public function search(string $term): array
    {
        $term = '%' . $term . '%';

        $formateurs = FormateurModel::where('nom', 'like', $term)
            ->orWhere('prenom', 'like', $term)
            ->orWhere('matricule', 'like', $term)
            ->orWhere('email', 'like', $term)
            ->limit(5)
            ->get()
            ->map(fn($f) => [
                'type' => 'formateur',
                'id' => $f->id,
                'label' => $f->nom . ' ' . $f->prenom . ' (' . $f->matricule . ')',
                'url' => route('admin.formateurs.show', $f->id),
            ]);

        $etablissements = EtablissementModel::where('nom', 'like', $term)
            ->orWhere('code', 'like', $term)
            ->limit(5)
            ->get()
            ->map(fn($e) => [
                'type' => 'etablissement',
                'id' => $e->id,
                'label' => $e->nom . ' (' . $e->code . ')',
                'url' => route('admin.etablissements.show', $e->id),
            ]);

        return $formateurs->concat($etablissements)->toArray();
    }
}