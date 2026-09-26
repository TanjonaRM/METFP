<?php

namespace Application\Affectations\DTOs;

class UpdateAffectationDTO
{
    public function __construct(
        public int $id,
        public int $formateur_id,
        public int $filiere_id,
        public int $etablissement_id,
        public string $date_debut,
        public ?string $date_fin = null,
        public string $statut = 'actif',
    ) {}

    public static function fromArray(int $id, array $data): self
    {
        return new self(
            id:               $id,
            formateur_id:     (int) $data['formateur_id'],
            filiere_id:       (int) $data['filiere_id'],
            etablissement_id: (int) $data['etablissement_id'],
            date_debut:       $data['date_debut'],
            date_fin:         $data['date_fin'] ?? null,
            statut:           $data['statut'] ?? 'actif',
        );
    }

    public function toArray(): array
    {
        return [
            'formateur_id'     => $this->formateur_id,
            'filiere_id'       => $this->filiere_id,
            'etablissement_id' => $this->etablissement_id,
            'date_debut'       => $this->date_debut,
            'date_fin'         => $this->date_fin,
            'statut'           => $this->statut,
        ];
    }
}