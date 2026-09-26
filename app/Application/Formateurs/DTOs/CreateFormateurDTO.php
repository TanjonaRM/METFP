<?php

namespace Application\Formateurs\DTOs;

class CreateFormateurDTO
{
    public function __construct(
        public string $matricule,
        public string $nom,
        public string $prenom,
        public string $email,
        public ?string $telephone = null,
        public ?string $sexe = null,
        public ?string $date_naissance = null,
        public ?string $lieu_naissance = null,
        public ?string $cin = null,
        public ?string $adresse = null,
        public ?string $grade = null,
        public ?string $date_recrutement = null,
        public ?string $photo = null,
        public ?int $etablissement_id = null,
        public ?int $filiere_id = null,
        public string $statut = 'actif',
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            matricule:        $data['matricule'],
            nom:              $data['nom'],
            prenom:           $data['prenom'],
            email:            $data['email'],
            telephone:        $data['telephone'] ?? null,
            sexe:             $data['sexe'] ?? null,
            date_naissance:   $data['date_naissance'] ?? null,
            lieu_naissance:   $data['lieu_naissance'] ?? null,
            cin:              $data['cin'] ?? null,
            adresse:          $data['adresse'] ?? null,
            grade:            $data['grade'] ?? null,
            date_recrutement: $data['date_recrutement'] ?? null,
            photo:            $data['photo'] ?? null,
            etablissement_id: isset($data['etablissement_id']) ? (int) $data['etablissement_id'] : null,
            filiere_id:       isset($data['filiere_id']) ? (int) $data['filiere_id'] : null,
            statut:           $data['statut'] ?? 'actif',
        );
    }

    public function toArray(): array
    {
        return [
            'matricule'        => $this->matricule,
            'nom'              => $this->nom,
            'prenom'           => $this->prenom,
            'email'            => $this->email,
            'telephone'        => $this->telephone,
            'sexe'             => $this->sexe,
            'date_naissance'   => $this->date_naissance,
            'lieu_naissance'   => $this->lieu_naissance,
            'cin'              => $this->cin,
            'adresse'          => $this->adresse,
            'grade'            => $this->grade,
            'date_recrutement' => $this->date_recrutement,
            'photo'            => $this->photo,
            'etablissement_id' => $this->etablissement_id,
            'filiere_id'       => $this->filiere_id,
            'statut'           => $this->statut,
        ];
    }
}