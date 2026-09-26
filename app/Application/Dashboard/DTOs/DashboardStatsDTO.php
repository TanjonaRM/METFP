<?php

namespace Application\Dashboard\DTOs;

class DashboardStatsDTO
{
    public function __construct(
        public int $totalFormateurs,
        public int $totalEtablissements,
        public int $totalFilieres,
        public int $totalAffectations,
        public array $dernieresAffectations = [],
        public array $notifications = [],
        public array $formateursParEtablissement = [],
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            totalFormateurs: $data['total_formateurs'] ?? 0,
            totalEtablissements: $data['total_etablissements'] ?? 0,
            totalFilieres: $data['total_filieres'] ?? 0,
            totalAffectations: $data['total_affectations'] ?? 0,
            dernieresAffectations: $data['dernieres_affectations'] ?? [],
            notifications: $data['notifications'] ?? [],
            formateursParEtablissement: $data['formateurs_par_etablissement'] ?? [],
        );
    }

    public function toArray(): array
    {
        return [
            'total_formateurs' => $this->totalFormateurs,
            'total_etablissements' => $this->totalEtablissements,
            'total_filieres' => $this->totalFilieres,
            'total_affectations' => $this->totalAffectations,
            'dernieres_affectations' => $this->dernieresAffectations,
            'notifications' => $this->notifications,
            'formateurs_par_etablissement' => $this->formateursParEtablissement,
        ];
    }
}