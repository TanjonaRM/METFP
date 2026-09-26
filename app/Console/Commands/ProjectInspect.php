<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class ProjectInspect extends Command
{
    protected $signature = 'project:inspect {module}';
    protected $description = 'Inspecte les fichiers d\'un module (existence, taille, champs)';

    public function handle(): int
    {
        $module = $this->argument('module');
        $modules = $this->getModules();

        if (!isset($modules[$module])) {
            $this->error("Module inconnu : {$module}");
            $this->info("Modules disponibles : " . implode(', ', array_keys($modules)));
            return self::FAILURE;
        }

        $this->info("Inspection du module : {$module}");
        $this->newLine();

        $ok = 0;
        $empty = 0;
        $missing = 0;

        $this->line(sprintf("%-4s %-12s %-60s %s", 'ST.', 'LIGNES', 'CHEMIN', 'TAILLE'));
        $this->line(str_repeat('-', 120));

        foreach ($modules[$module]['files'] as $file) {
            $fullPath = base_path($file['path']);

            if (File::exists($fullPath)) {
                $size = File::size($fullPath);
                $lines = count(file($fullPath));

                if ($size < 10) {
                    $this->line(sprintf("%-4s %-12s %-60s %s o", 'VIDE', $lines, $file['path'], $size));
                    $empty++;
                } else {
                    $sizeKB = round($size / 1024, 1);
                    $this->line(sprintf("%-4s %-12s %-60s %s Ko", 'OK', $lines, $file['path'], $sizeKB));
                    $ok++;
                }
            } else {
                $this->line(sprintf("%-4s %-12s %-60s %s", 'MANQ', '-', $file['path'], '-'));
                $missing++;
            }
        }

        $this->newLine();
        $this->info("Résumé :");
        $this->line("  OK       : {$ok}");
        $this->line("  Vides    : {$empty}");
        $this->line("  Manquants: {$missing}");

        // Vérification des champs pour les vues
        if (isset($modules[$module]['fields'])) {
            $this->newLine();
            $this->info("Vérification des champs :");

            foreach ($modules[$module]['fields'] as $file => $fields) {
                $fullPath = base_path($file);
                if (!File::exists($fullPath)) continue;

                $content = File::get($fullPath);
                $this->newLine();
                $this->line("  Fichier : {$file}");

                foreach ($fields as $field) {
                    $found = str_contains($content, $field);
                    $this->line(sprintf("    %s %s", $found ? 'OK' : 'MANQUE', $field));
                }
            }
        }

        return self::SUCCESS;
    }

    protected function getModules(): array
    {
        return [
            'affectations' => [
                'files' => [
                    ['path' => 'app/Http/Controllers/Admin/AffectationController.php'],
                    ['path' => 'app/Infrastructure/Persistence/Eloquent/Models/AffectationModel.php'],
                    ['path' => 'app/Domain/Affectations/Entities/Affectation.php'],
                    ['path' => 'app/Application/Affectations/DTOs/CreateAffectationDTO.php'],
                    ['path' => 'app/Application/Affectations/DTOs/UpdateAffectationDTO.php'],
                    ['path' => 'app/Application/Affectations/UseCases/CreateAffectationUseCase.php'],
                    ['path' => 'app/Application/Affectations/UseCases/UpdateAffectationUseCase.php'],
                    ['path' => 'app/Application/Affectations/UseCases/DeleteAffectationUseCase.php'],
                    ['path' => 'app/Http/Requests/Affectation/StoreAffectationRequest.php'],
                    ['path' => 'app/Http/Requests/Affectation/UpdateAffectationRequest.php'],
                    ['path' => 'app/Infrastructure/Persistence/Eloquent/Repositories/EloquentAffectationRepository.php'],
                    ['path' => 'resources/views/admin/affectations/index.blade.php'],
                    ['path' => 'resources/views/admin/affectations/create.blade.php'],
                    ['path' => 'resources/views/admin/affectations/edit.blade.php'],
                    ['path' => 'resources/views/admin/affectations/show.blade.php'],
                    ['path' => 'resources/views/admin/affectations/partials/form.blade.php'],
                ],
                'fields' => [
                    'resources/views/admin/affectations/partials/form.blade.php' => [
                        'name="formateur_id"',
                        'name="filiere_id"',
                        'name="etablissement_id"',
                        'name="date_debut"',
                        'name="date_fin"',
                        'name="statut"',
                    ],
                    'resources/views/admin/affectations/index.blade.php' => [
                        'route(\'admin.affectations.show\'',
                        'route(\'admin.formateurs.show\'',
                        '$a->etablissement',
                        'statut',
                    ],
                ],
            ],
            'formateurs' => [
                'files' => [
                    ['path' => 'app/Http/Controllers/Admin/FormateurController.php'],
                    ['path' => 'app/Infrastructure/Persistence/Eloquent/Models/FormateurModel.php'],
                    ['path' => 'app/Domain/Formateurs/Entities/Formateur.php'],
                    ['path' => 'app/Application/Formateurs/DTOs/CreateFormateurDTO.php'],
                    ['path' => 'resources/views/admin/formateurs/index.blade.php'],
                    ['path' => 'resources/views/admin/formateurs/partials/form.blade.php'],
                ],
            ],
        ];
    }
}