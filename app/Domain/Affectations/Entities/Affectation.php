<?php

namespace Domain\Affectations\Entities;

use Carbon\Carbon;

class Affectation
{
    public function __construct(
        public ?int $id,
        public int $formateurId,
        public int $filiereId,
        public int $etablissementId,
        public Carbon $dateDebut,
        public ?Carbon $dateFin = null,
        public string $statut = 'actif',
    ) {}

    public function estActive(): bool
    {
        return $this->statut === 'actif';
    }

    public function estTerminee(): bool
    {
        return $this->statut === 'termine';
    }

    public function estSuspendue(): bool
    {
        return $this->statut === 'suspendu';
    }

    public function getDureeEnJours(): int
    {
        if (!$this->dateFin) {
            return 0;
        }
        return $this->dateDebut->diffInDays($this->dateFin);
    }
}