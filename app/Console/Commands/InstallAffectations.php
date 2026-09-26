<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class InstallAffectations extends Command
{
    protected $signature = 'install:affectations';
    protected $description = 'Installe les fichiers du module Affectations';

    public function handle(): int
    {
        $this->info("Installation du module Affectations");
        $this->newLine();

        $files = $this->getFiles();
        $count = 0;

        foreach ($files as $path => $content) {
            $fullPath = base_path($path);
            $dir = dirname($fullPath);

            if (!File::exists($dir)) {
                File::makeDirectory($dir, 0755, true);
            }

            File::put($fullPath, $content);
            $size = strlen($content);
            $this->line("  OK  {$path} ({$size} car.)");
            $count++;
        }

        $this->newLine();
        $this->info("Nettoyage des caches...");
        $this->call('optimize:clear');

        $this->newLine();
        $this->info("SUCCES : {$count} fichier(s) installe(s) !");
        return self::SUCCESS;
    }

    protected function getFiles(): array
    {
        return [

            'app/Application/Affectations/DTOs/CreateAffectationDTO.php' => <<<'PHP'
<?php

namespace Application\Affectations\DTOs;

class CreateAffectationDTO
{
    public function __construct(
        public int $formateur_id,
        public int $filiere_id,
        public int $etablissement_id,
        public string $date_debut,
        public ?string $date_fin = null,
        public string $statut = 'actif',
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
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
PHP,

            'app/Application/Affectations/DTOs/UpdateAffectationDTO.php' => <<<'PHP'
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
PHP,

            'app/Application/Affectations/UseCases/CreateAffectationUseCase.php' => <<<'PHP'
<?php

namespace Application\Affectations\UseCases;

use Application\Affectations\DTOs\CreateAffectationDTO;
use Infrastructure\Persistence\Eloquent\Models\AffectationModel;
use Infrastructure\Persistence\Eloquent\Models\SessionModel;

class CreateAffectationUseCase
{
    public function execute(CreateAffectationDTO $dto): AffectationModel
    {
        $affectation = AffectationModel::create($dto->toArray());

        $code = SessionModel::generateNextCode();

        SessionModel::create([
            'code'             => $code,
            'titre'            => 'Session ' . ($affectation->filiere->libelle ?? ''),
            'filiere_id'       => $dto->filiere_id,
            'formateur_id'     => $dto->formateur_id,
            'etablissement_id' => $dto->etablissement_id,
            'date_debut'       => $dto->date_debut,
            'date_fin'         => $dto->date_fin ?? now()->addMonths(6)->toDateString(),
            'nb_places'        => 0,
            'description'      => null,
            'statut'           => 'actif',
        ]);

        return $affectation;
    }
}
PHP,

            'app/Application/Affectations/UseCases/UpdateAffectationUseCase.php' => <<<'PHP'
<?php

namespace Application\Affectations\UseCases;

use Application\Affectations\DTOs\UpdateAffectationDTO;
use Infrastructure\Persistence\Eloquent\Models\AffectationModel;

class UpdateAffectationUseCase
{
    public function execute(UpdateAffectationDTO $dto): AffectationModel
    {
        $affectation = AffectationModel::findOrFail($dto->id);
        $affectation->update($dto->toArray());

        return $affectation;
    }
}
PHP,

            'app/Application/Affectations/UseCases/DeleteAffectationUseCase.php' => <<<'PHP'
<?php

namespace Application\Affectations\UseCases;

use Infrastructure\Persistence\Eloquent\Models\AffectationModel;

class DeleteAffectationUseCase
{
    public function execute(int $id): void
    {
        $affectation = AffectationModel::findOrFail($id);
        $affectation->delete();
    }
}
PHP,

            'app/Http/Requests/Affectation/StoreAffectationRequest.php' => <<<'PHP'
<?php

namespace App\Http\Requests\Affectation;

use Illuminate\Foundation\Http\FormRequest;

class StoreAffectationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth('admin')->check();
    }

    public function rules(): array
    {
        return [
            'formateur_id'     => 'required|exists:formateurs,id',
            'filiere_id'       => 'required|exists:filieres,id',
            'etablissement_id' => 'required|exists:etablissements,id',
            'date_debut'       => 'required|date',
            'date_fin'         => 'nullable|date|after_or_equal:date_debut',
            'statut'           => 'required|in:actif,termine,suspendu',
        ];
    }

    public function messages(): array
    {
        return [
            'formateur_id.required'     => 'Le formateur est obligatoire.',
            'filiere_id.required'       => 'La filière est obligatoire.',
            'etablissement_id.required' => 'L\'établissement est obligatoire.',
            'date_debut.required'       => 'La date de début est obligatoire.',
            'date_fin.after_or_equal'   => 'La date de fin doit être après la date de début.',
            'statut.in'                 => 'Le statut doit être : actif, termine ou suspendu.',
        ];
    }
}
PHP,

            'app/Http/Requests/Affectation/UpdateAffectationRequest.php' => <<<'PHP'
<?php

namespace App\Http\Requests\Affectation;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAffectationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth('admin')->check();
    }

    public function rules(): array
    {
        return [
            'formateur_id'     => 'required|exists:formateurs,id',
            'filiere_id'       => 'required|exists:filieres,id',
            'etablissement_id' => 'required|exists:etablissements,id',
            'date_debut'       => 'required|date',
            'date_fin'         => 'nullable|date|after_or_equal:date_debut',
            'statut'           => 'required|in:actif,termine,suspendu',
        ];
    }
}
PHP,

            'app/Infrastructure/Persistence/Eloquent/Repositories/EloquentAffectationRepository.php' => <<<'PHP'
<?php

namespace Infrastructure\Persistence\Eloquent\Repositories;

use Infrastructure\Persistence\Eloquent\Models\AffectationModel;

class EloquentAffectationRepository
{
    public function findById(int $id): ?AffectationModel
    {
        return AffectationModel::find($id);
    }

    public function findAll(): array
    {
        return AffectationModel::with(['formateur', 'filiere', 'etablissement'])
            ->orderBy('date_debut', 'desc')
            ->get()
            ->all();
    }

    public function findByFormateur(int $formateurId): array
    {
        return AffectationModel::where('formateur_id', $formateurId)
            ->with(['filiere', 'etablissement'])
            ->orderBy('date_debut', 'desc')
            ->get()
            ->all();
    }

    public function save(array $data): AffectationModel
    {
        if (isset($data['id']) && $data['id']) {
            $model = AffectationModel::findOrFail($data['id']);
            $model->update($data);
            return $model;
        }
        return AffectationModel::create($data);
    }

    public function delete(int $id): void
    {
        AffectationModel::findOrFail($id)->delete();
    }
}
PHP,
        ];
    }
}