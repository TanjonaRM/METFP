<?php

namespace Application\Formateurs\UseCases\CreateFormateur;

use Application\Formateurs\DTOs\CreateFormateurDTO;
use Application\Notifications\Services\NotificationService;
use Domain\Formateurs\Exceptions\FormateurDejaExistantException;
use Domain\Formateurs\Ports\FormateurRepositoryInterface;
use Infrastructure\Persistence\Eloquent\Models\FormateurModel;
use Infrastructure\Persistence\Eloquent\Models\SessionModel;

class CreateFormateurUseCase
{
    public function __construct(
        private FormateurRepositoryInterface $repository,
    ) {}

    public function execute(CreateFormateurDTO $dto): FormateurModel
    {
        // 1. Vérifier doublon
        $existing = $this->repository->findByMatricule($dto->matricule);
        if ($existing) {
            throw FormateurDejaExistantException::withMatricule($dto->matricule);
        }

        // 2. Sauvegarder TOUS les champs
        $savedFormateur = FormateurModel::create($dto->toArray());

        // 3. Créer la session si établissement + filière fournis
        if ($savedFormateur->id && $dto->filiere_id && $dto->etablissement_id) {
            $code = SessionModel::generateNextCode();

            SessionModel::create([
                'code'             => $code,
                'titre'            => null,
                'filiere_id'       => $dto->filiere_id,
                'formateur_id'     => $savedFormateur->id,
                'etablissement_id' => $dto->etablissement_id,
                'date_debut'       => $dto->date_recrutement ?? now()->toDateString(),
                'date_fin'         => now()->addMonths(6)->toDateString(),
                'nb_places'        => 0,
                'description'      => null,
                'statut'           => 'actif',
            ]);

            NotificationService::sessionCreee(
                $code,
                $dto->prenom . ' ' . $dto->nom,
                route('admin.sessions.index')
            );
        }

        // 4. Notification formateur créé
        NotificationService::formateurCree(
            $dto->prenom . ' ' . $dto->nom,
            $dto->matricule,
            route('admin.formateurs.show', $savedFormateur->id)
        );

        return $savedFormateur;
    }
}