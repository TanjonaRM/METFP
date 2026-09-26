<?php

namespace Domain\Sessions\Entities;

use Carbon\Carbon;

class Session
{
    public function __construct(
        public ?int $id,
        public string $code,
        public int $filiereId,
        public int $formateurId,
        public int $etablissementId,
        public Carbon $dateDebut,
        public Carbon $dateFin,
        public int $nbPlaces = 0,
    ) {}

    public function getCode(): string
    {
        return $this->code;
    }

    public function estEnCours(): bool
    {
        $now = Carbon::now();
        return $this->dateDebut <= $now && $this->dateFin >= $now;
    }

    public function estTerminee(): bool
    {
        return $this->dateFin < Carbon::now();
    }

    public function estAVenir(): bool
    {
        return $this->dateDebut > Carbon::now();
    }

    public function getDureeEnJours(): int
    {
        return $this->dateDebut->diffInDays($this->dateFin);
    }
}