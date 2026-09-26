# ============================================================
# CREATION STRUCTURE HEXAGONALE - SGFORMATEURS
# ============================================================

Write-Host "=============================================" -ForegroundColor Cyan
Write-Host "  CREATION STRUCTURE HEXAGONALE SGFORMATEURS" -ForegroundColor Cyan
Write-Host "=============================================" -ForegroundColor Cyan

# Vérification : on doit être dans un projet Laravel
if (-not (Test-Path "artisan")) {
    Write-Host "❌ ERREUR : Vous n'êtes pas dans un projet Laravel !" -ForegroundColor Red
    Write-Host "   Lancez d'abord : composer create-project laravel/laravel SGFormateurs" -ForegroundColor Yellow
    exit 1
}

Write-Host "✅ Projet Laravel détecté : $(Get-Location)`n" -ForegroundColor Green

# Fonctions utilitaires
function New-Folder($path) {
    if (-not (Test-Path $path)) {
        New-Item -ItemType Directory -Path $path -Force | Out-Null
    }
}
function New-File($path) {
    if (-not (Test-Path $path)) {
        New-Item -ItemType File -Path $path -Force | Out-Null
    }
}

# ============================================================
# 1. DOMAIN
# ============================================================
Write-Host "[1/7] Creation de app/Domain..." -ForegroundColor Yellow

# ---------- Formateurs ----------
New-Folder "app\Domain\Formateurs\Entities"
New-Folder "app\Domain\Formateurs\ValueObjects"
New-Folder "app\Domain\Formateurs\Ports"
New-Folder "app\Domain\Formateurs\Exceptions"
New-Folder "app\Domain\Formateurs\Rules"

New-File "app\Domain\Formateurs\Entities\Formateur.php"
New-File "app\Domain\Formateurs\ValueObjects\Matricule.php"
New-File "app\Domain\Formateurs\ValueObjects\NomComplet.php"
New-File "app\Domain\Formateurs\ValueObjects\Email.php"
New-File "app\Domain\Formateurs\ValueObjects\Telephone.php"
New-File "app\Domain\Formateurs\ValueObjects\Statut.php"
New-File "app\Domain\Formateurs\Ports\FormateurRepositoryInterface.php"
New-File "app\Domain\Formateurs\Exceptions\FormateurNotFoundException.php"
New-File "app\Domain\Formateurs\Exceptions\FormateurDejaExistantException.php"
New-File "app\Domain\Formateurs\Exceptions\FormateurInvalideException.php"
New-File "app\Domain\Formateurs\Rules\FormateurRules.php"

# ---------- Auth ----------
New-Folder "app\Domain\Auth\Entities"
New-Folder "app\Domain\Auth\ValueObjects"
New-Folder "app\Domain\Auth\Ports"
New-Folder "app\Domain\Auth\Exceptions"
New-Folder "app\Domain\Auth\Rules"

New-File "app\Domain\Auth\Entities\User.php"
New-File "app\Domain\Auth\Entities\Admin.php"
New-File "app\Domain\Auth\Entities\FormateurUser.php"
New-File "app\Domain\Auth\ValueObjects\Email.php"
New-File "app\Domain\Auth\ValueObjects\Password.php"
New-File "app\Domain\Auth\ValueObjects\Role.php"
New-File "app\Domain\Auth\Ports\UserRepositoryInterface.php"
New-File "app\Domain\Auth\Ports\AdminRepositoryInterface.php"
New-File "app\Domain\Auth\Ports\FormateurUserRepositoryInterface.php"
New-File "app\Domain\Auth\Ports\PasswordHasherInterface.php"
New-File "app\Domain\Auth\Ports\TokenGeneratorInterface.php"
New-File "app\Domain\Auth\Exceptions\InvalidCredentialsException.php"
New-File "app\Domain\Auth\Exceptions\UserAlreadyExistsException.php"
New-File "app\Domain\Auth\Exceptions\UnauthorizedException.php"
New-File "app\Domain\Auth\Rules\AuthRules.php"
New-File "app\Domain\Auth\Rules\PasswordRules.php"
New-File "app\Domain\Auth\Rules\EmailRules.php"

# ---------- Etablissements ----------
New-Folder "app\Domain\Etablissements\Entities"
New-Folder "app\Domain\Etablissements\ValueObjects"
New-Folder "app\Domain\Etablissements\Ports"
New-Folder "app\Domain\Etablissements\Exceptions"
New-Folder "app\Domain\Etablissements\Rules"

New-File "app\Domain\Etablissements\Entities\Etablissement.php"
New-File "app\Domain\Etablissements\ValueObjects\CodeEtablissement.php"
New-File "app\Domain\Etablissements\ValueObjects\TypeEtablissement.php"
New-File "app\Domain\Etablissements\ValueObjects\Adresse.php"
New-File "app\Domain\Etablissements\Ports\EtablissementRepositoryInterface.php"
New-File "app\Domain\Etablissements\Exceptions\EtablissementNotFoundException.php"
New-File "app\Domain\Etablissements\Rules\EtablissementRules.php"

# ---------- Filieres ----------
New-Folder "app\Domain\Filieres\Entities"
New-Folder "app\Domain\Filieres\ValueObjects"
New-Folder "app\Domain\Filieres\Ports"
New-Folder "app\Domain\Filieres\Exceptions"
New-Folder "app\Domain\Filieres\Rules"

New-File "app\Domain\Filieres\Entities\Filiere.php"
New-File "app\Domain\Filieres\ValueObjects\CodeFiliere.php"
New-File "app\Domain\Filieres\ValueObjects\LibelleFiliere.php"
New-File "app\Domain\Filieres\Ports\FiliereRepositoryInterface.php"
New-File "app\Domain\Filieres\Exceptions\FiliereNotFoundException.php"
New-File "app\Domain\Filieres\Rules\FiliereRules.php"

# ---------- Niveaux ----------
New-Folder "app\Domain\Niveaux\Entities"
New-Folder "app\Domain\Niveaux\ValueObjects"
New-Folder "app\Domain\Niveaux\Ports"
New-Folder "app\Domain\Niveaux\Rules"

New-File "app\Domain\Niveaux\Entities\Niveau.php"
New-File "app\Domain\Niveaux\ValueObjects\CodeNiveau.php"
New-File "app\Domain\Niveaux\Ports\NiveauRepositoryInterface.php"
New-File "app\Domain\Niveaux\Rules\NiveauRules.php"

# ---------- Secteurs ----------
New-Folder "app\Domain\Secteurs\Entities"
New-Folder "app\Domain\Secteurs\ValueObjects"
New-Folder "app\Domain\Secteurs\Ports"
New-Folder "app\Domain\Secteurs\Rules"

New-File "app\Domain\Secteurs\Entities\Secteur.php"
New-File "app\Domain\Secteurs\ValueObjects\CodeSecteur.php"
New-File "app\Domain\Secteurs\Ports\SecteurRepositoryInterface.php"
New-File "app\Domain\Secteurs\Rules\SecteurRules.php"

# ---------- Affectations ----------
New-Folder "app\Domain\Affectations\Entities"
New-Folder "app\Domain\Affectations\ValueObjects"
New-Folder "app\Domain\Affectations\Ports"
New-Folder "app\Domain\Affectations\Exceptions"
New-Folder "app\Domain\Affectations\Rules"

New-File "app\Domain\Affectations\Entities\Affectation.php"
New-File "app\Domain\Affectations\ValueObjects\DateAffectation.php"
New-File "app\Domain\Affectations\ValueObjects\StatutAffectation.php"
New-File "app\Domain\Affectations\Ports\AffectationRepositoryInterface.php"
New-File "app\Domain\Affectations\Exceptions\AffectationConflictException.php"
New-File "app\Domain\Affectations\Rules\AffectationRules.php"

# ---------- Sessions ----------
New-Folder "app\Domain\Sessions\Entities"
New-Folder "app\Domain\Sessions\ValueObjects"
New-Folder "app\Domain\Sessions\Ports"
New-Folder "app\Domain\Sessions\Exceptions"
New-Folder "app\Domain\Sessions\Rules"

New-File "app\Domain\Sessions\Entities\Session.php"
New-File "app\Domain\Sessions\ValueObjects\CodeSession.php"
New-File "app\Domain\Sessions\ValueObjects\Periode.php"
New-File "app\Domain\Sessions\ValueObjects\NbPlaces.php"
New-File "app\Domain\Sessions\Ports\SessionRepositoryInterface.php"
New-File "app\Domain\Sessions\Exceptions\SessionPleineException.php"
New-File "app\Domain\Sessions\Rules\SessionRules.php"

# ---------- Presences ----------
New-Folder "app\Domain\Presences\Entities"
New-Folder "app\Domain\Presences\ValueObjects"
New-Folder "app\Domain\Presences\Ports"
New-Folder "app\Domain\Presences\Exceptions"
New-Folder "app\Domain\Presences\Rules"

New-File "app\Domain\Presences\Entities\Presence.php"
New-File "app\Domain\Presences\ValueObjects\DatePresence.php"
New-File "app\Domain\Presences\ValueObjects\StatutPresence.php"
New-File "app\Domain\Presences\Ports\PresenceRepositoryInterface.php"
New-File "app\Domain\Presences\Exceptions\PresenceDejaEnregistreeException.php"
New-File "app\Domain\Presences\Rules\PresenceRules.php"

# ============================================================
# 2. APPLICATION
# ============================================================
Write-Host "[2/7] Creation de app/Application..." -ForegroundColor Yellow

# ---------- Formateurs ----------
New-Folder "app\Application\Formateurs\DTOs"
New-Folder "app\Application\Formateurs\UseCases\CreateFormateur"
New-Folder "app\Application\Formateurs\UseCases\UpdateFormateur"
New-Folder "app\Application\Formateurs\UseCases\DeleteFormateur"
New-Folder "app\Application\Formateurs\UseCases\GetFormateurs"
New-Folder "app\Application\Formateurs\Ports"

New-File "app\Application\Formateurs\DTOs\CreateFormateurDTO.php"
New-File "app\Application\Formateurs\DTOs\UpdateFormateurDTO.php"
New-File "app\Application\Formateurs\DTOs\FormateurResponseDTO.php"
New-File "app\Application\Formateurs\UseCases\CreateFormateur\CreateFormateurUseCase.php"
New-File "app\Application\Formateurs\UseCases\CreateFormateur\CreateFormateurCommand.php"
New-File "app\Application\Formateurs\UseCases\UpdateFormateur\UpdateFormateurUseCase.php"
New-File "app\Application\Formateurs\UseCases\UpdateFormateur\UpdateFormateurCommand.php"
New-File "app\Application\Formateurs\UseCases\DeleteFormateur\DeleteFormateurUseCase.php"
New-File "app\Application\Formateurs\UseCases\GetFormateurs\GetFormateursUseCase.php"
New-File "app\Application\Formateurs\UseCases\GetFormateurs\GetFormateursQuery.php"
New-File "app\Application\Formateurs\Ports\FormateurServiceInterface.php"

# ---------- Auth ----------
New-Folder "app\Application\Auth\DTOs"
New-Folder "app\Application\Auth\UseCases\Admin"
New-Folder "app\Application\Auth\UseCases\Formateur"
New-Folder "app\Application\Auth\Ports"

New-File "app\Application\Auth\DTOs\RegisterAdminDTO.php"
New-File "app\Application\Auth\DTOs\RegisterFormateurDTO.php"
New-File "app\Application\Auth\DTOs\LoginDTO.php"
New-File "app\Application\Auth\DTOs\ResetPasswordDTO.php"
New-File "app\Application\Auth\DTOs\UpdatePasswordDTO.php"
New-File "app\Application\Auth\UseCases\Admin\RegisterAdminUseCase.php"
New-File "app\Application\Auth\UseCases\Admin\LoginAdminUseCase.php"
New-File "app\Application\Auth\UseCases\Admin\LogoutAdminUseCase.php"
New-File "app\Application\Auth\UseCases\Admin\ResetAdminPasswordUseCase.php"
New-File "app\Application\Auth\UseCases\Formateur\RegisterFormateurUseCase.php"
New-File "app\Application\Auth\UseCases\Formateur\LoginFormateurUseCase.php"
New-File "app\Application\Auth\UseCases\Formateur\LogoutFormateurUseCase.php"
New-File "app\Application\Auth\UseCases\Formateur\ResetFormateurPasswordUseCase.php"
New-File "app\Application\Auth\Ports\AuthServiceInterface.php"
New-File "app\Application\Auth\Ports\MailServiceInterface.php"
New-File "app\Application\Auth\Ports\SessionManagerInterface.php"

# ---------- Etablissements ----------
New-Folder "app\Application\Etablissements\DTOs"
New-Folder "app\Application\Etablissements\UseCases"
New-Folder "app\Application\Etablissements\Ports"

New-File "app\Application\Etablissements\DTOs\CreateEtablissementDTO.php"
New-File "app\Application\Etablissements\DTOs\UpdateEtablissementDTO.php"
New-File "app\Application\Etablissements\UseCases\CreateEtablissementUseCase.php"
New-File "app\Application\Etablissements\UseCases\UpdateEtablissementUseCase.php"
New-File "app\Application\Etablissements\UseCases\DeleteEtablissementUseCase.php"
New-File "app\Application\Etablissements\UseCases\GetEtablissementsUseCase.php"

# ---------- Filieres ----------
New-Folder "app\Application\Filieres\DTOs"
New-Folder "app\Application\Filieres\UseCases"
New-Folder "app\Application\Filieres\Ports"

New-File "app\Application\Filieres\DTOs\CreateFiliereDTO.php"
New-File "app\Application\Filieres\DTOs\UpdateFiliereDTO.php"
New-File "app\Application\Filieres\UseCases\CreateFiliereUseCase.php"
New-File "app\Application\Filieres\UseCases\UpdateFiliereUseCase.php"
New-File "app\Application\Filieres\UseCases\DeleteFiliereUseCase.php"
New-File "app\Application\Filieres\UseCases\GetFilieresUseCase.php"

# ---------- Niveaux ----------
New-Folder "app\Application\Niveaux\DTOs"
New-Folder "app\Application\Niveaux\UseCases"
New-Folder "app\Application\Niveaux\Ports"

New-File "app\Application\Niveaux\DTOs\CreateNiveauDTO.php"
New-File "app\Application\Niveaux\DTOs\UpdateNiveauDTO.php"
New-File "app\Application\Niveaux\UseCases\CreateNiveauUseCase.php"
New-File "app\Application\Niveaux\UseCases\UpdateNiveauUseCase.php"
New-File "app\Application\Niveaux\UseCases\DeleteNiveauUseCase.php"
New-File "app\Application\Niveaux\UseCases\GetNiveauxUseCase.php"

# ---------- Secteurs ----------
New-Folder "app\Application\Secteurs\DTOs"
New-Folder "app\Application\Secteurs\UseCases"
New-Folder "app\Application\Secteurs\Ports"

New-File "app\Application\Secteurs\DTOs\CreateSecteurDTO.php"
New-File "app\Application\Secteurs\DTOs\UpdateSecteurDTO.php"
New-File "app\Application\Secteurs\UseCases\CreateSecteurUseCase.php"
New-File "app\Application\Secteurs\UseCases\UpdateSecteurUseCase.php"
New-File "app\Application\Secteurs\UseCases\DeleteSecteurUseCase.php"
New-File "app\Application\Secteurs\UseCases\GetSecteursUseCase.php"

# ---------- Affectations ----------
New-Folder "app\Application\Affectations\DTOs"
New-Folder "app\Application\Affectations\UseCases"
New-Folder "app\Application\Affectations\Ports"

New-File "app\Application\Affectations\DTOs\CreateAffectationDTO.php"
New-File "app\Application\Affectations\DTOs\UpdateAffectationDTO.php"
New-File "app\Application\Affectations\UseCases\CreateAffectationUseCase.php"
New-File "app\Application\Affectations\UseCases\UpdateAffectationUseCase.php"
New-File "app\Application\Affectations\UseCases\DeleteAffectationUseCase.php"
New-File "app\Application\Affectations\UseCases\GetAffectationsUseCase.php"

# ---------- Sessions ----------
New-Folder "app\Application\Sessions\DTOs"
New-Folder "app\Application\Sessions\UseCases"
New-Folder "app\Application\Sessions\Ports"

New-File "app\Application\Sessions\DTOs\CreateSessionDTO.php"
New-File "app\Application\Sessions\DTOs\UpdateSessionDTO.php"
New-File "app\Application\Sessions\UseCases\CreateSessionUseCase.php"
New-File "app\Application\Sessions\UseCases\UpdateSessionUseCase.php"
New-File "app\Application\Sessions\UseCases\DeleteSessionUseCase.php"
New-File "app\Application\Sessions\UseCases\GetSessionsUseCase.php"

# ---------- Presences ----------
New-Folder "app\Application\Presences\DTOs"
New-Folder "app\Application\Presences\UseCases"
New-Folder "app\Application\Presences\Ports"

New-File "app\Application\Presences\DTOs\CreatePresenceDTO.php"
New-File "app\Application\Presences\DTOs\UpdatePresenceDTO.php"
New-File "app\Application\Presences\UseCases\CreatePresenceUseCase.php"
New-File "app\Application\Presences\UseCases\UpdatePresenceUseCase.php"
New-File "app\Application\Presences\UseCases\DeletePresenceUseCase.php"
New-File "app\Application\Presences\UseCases\GetPresencesUseCase.php"

# ============================================================
# 3. INFRASTRUCTURE
# ============================================================
Write-Host "[3/7] Creation de app/Infrastructure..." -ForegroundColor Yellow

New-Folder "app\Infrastructure\Persistence\Eloquent\Models"
New-Folder "app\Infrastructure\Persistence\Eloquent\Repositories"
New-Folder "app\Infrastructure\Persistence\Database"
New-Folder "app\Infrastructure\Adapters\Hashing"
New-Folder "app\Infrastructure\Adapters\Token"
New-Folder "app\Infrastructure\Adapters\Mail"
New-Folder "app\Infrastructure\Adapters\Session"
New-Folder "app\Infrastructure\Adapters\Storage"
New-Folder "app\Infrastructure\Adapters\Pdf"
New-Folder "app\Infrastructure\Providers"

# Models
New-File "app\Infrastructure\Persistence\Eloquent\Models\UserModel.php"
New-File "app\Infrastructure\Persistence\Eloquent\Models\AdminModel.php"
New-File "app\Infrastructure\Persistence\Eloquent\Models\FormateurUserModel.php"
New-File "app\Infrastructure\Persistence\Eloquent\Models\FormateurModel.php"
New-File "app\Infrastructure\Persistence\Eloquent\Models\EtablissementModel.php"
New-File "app\Infrastructure\Persistence\Eloquent\Models\FiliereModel.php"
New-File "app\Infrastructure\Persistence\Eloquent\Models\NiveauModel.php"
New-File "app\Infrastructure\Persistence\Eloquent\Models\SecteurModel.php"
New-File "app\Infrastructure\Persistence\Eloquent\Models\AffectationModel.php"
New-File "app\Infrastructure\Persistence\Eloquent\Models\SessionModel.php"
New-File "app\Infrastructure\Persistence\Eloquent\Models\PresenceModel.php"
New-File "app\Infrastructure\Persistence\Eloquent\Models\FiliereOptionModel.php"

# Repositories
New-File "app\Infrastructure\Persistence\Eloquent\Repositories\EloquentFormateurRepository.php"
New-File "app\Infrastructure\Persistence\Eloquent\Repositories\EloquentUserRepository.php"
New-File "app\Infrastructure\Persistence\Eloquent\Repositories\EloquentAdminRepository.php"
New-File "app\Infrastructure\Persistence\Eloquent\Repositories\EloquentFormateurUserRepository.php"
New-File "app\Infrastructure\Persistence\Eloquent\Repositories\EloquentEtablissementRepository.php"
New-File "app\Infrastructure\Persistence\Eloquent\Repositories\EloquentFiliereRepository.php"
New-File "app\Infrastructure\Persistence\Eloquent\Repositories\EloquentNiveauRepository.php"
New-File "app\Infrastructure\Persistence\Eloquent\Repositories\EloquentSecteurRepository.php"
New-File "app\Infrastructure\Persistence\Eloquent\Repositories\EloquentAffectationRepository.php"
New-File "app\Infrastructure\Persistence\Eloquent\Repositories\EloquentSessionRepository.php"
New-File "app\Infrastructure\Persistence\Eloquent\Repositories\EloquentPresenceRepository.php"

# Database
New-File "app\Infrastructure\Persistence\Database\MySqlConnection.php"

# Adapters
New-File "app\Infrastructure\Adapters\Hashing\BcryptPasswordHasher.php"
New-File "app\Infrastructure\Adapters\Token\LaravelTokenGenerator.php"
New-File "app\Infrastructure\Adapters\Mail\LaravelMailService.php"
New-File "app\Infrastructure\Adapters\Session\LaravelSessionManager.php"
New-File "app\Infrastructure\Adapters\Storage\LocalFileStorage.php"
New-File "app\Infrastructure\Adapters\Pdf\DompdfExporter.php"

# Providers
New-File "app\Infrastructure\Providers\HexagonalServiceProvider.php"

# ============================================================
# 4. HTTP
# ============================================================
Write-Host "[4/7] Creation de app/Http..." -ForegroundColor Yellow

# Controllers Auth
New-Folder "app\Http\Controllers\Auth\Admin"
New-Folder "app\Http\Controllers\Auth\Formateur"

New-File "app\Http\Controllers\Auth\Admin\LoginController.php"
New-File "app\Http\Controllers\Auth\Admin\RegisterController.php"
New-File "app\Http\Controllers\Auth\Admin\LogoutController.php"
New-File "app\Http\Controllers\Auth\Admin\ForgotPasswordController.php"
New-File "app\Http\Controllers\Auth\Admin\ResetPasswordController.php"
New-File "app\Http\Controllers\Auth\Formateur\LoginController.php"
New-File "app\Http\Controllers\Auth\Formateur\RegisterController.php"
New-File "app\Http\Controllers\Auth\Formateur\LogoutController.php"
New-File "app\Http\Controllers\Auth\Formateur\ForgotPasswordController.php"
New-File "app\Http\Controllers\Auth\Formateur\ResetPasswordController.php"

# Controllers Admin
New-Folder "app\Http\Controllers\Admin"
New-File "app\Http\Controllers\Admin\DashboardController.php"
New-File "app\Http\Controllers\Admin\FormateurController.php"
New-File "app\Http\Controllers\Admin\EtablissementController.php"
New-File "app\Http\Controllers\Admin\FiliereController.php"
New-File "app\Http\Controllers\Admin\NiveauController.php"
New-File "app\Http\Controllers\Admin\SecteurController.php"
New-File "app\Http\Controllers\Admin\AffectationController.php"
New-File "app\Http\Controllers\Admin\SessionController.php"
New-File "app\Http\Controllers\Admin\PresenceController.php"
New-File "app\Http\Controllers\Admin\UserController.php"

# Controllers Formateur
New-Folder "app\Http\Controllers\Formateur"
New-File "app\Http\Controllers\Formateur\DashboardController.php"
New-File "app\Http\Controllers\Formateur\ProfileController.php"
New-File "app\Http\Controllers\Formateur\AffectationController.php"
New-File "app\Http\Controllers\Formateur\SessionController.php"
New-File "app\Http\Controllers\Formateur\PresenceController.php"

# Requests
New-Folder "app\Http\Requests\Auth\Admin"
New-Folder "app\Http\Requests\Auth\Formateur"
New-Folder "app\Http\Requests\Formateur"
New-Folder "app\Http\Requests\Etablissement"
New-Folder "app\Http\Requests\Filiere"
New-Folder "app\Http\Requests\Niveau"
New-Folder "app\Http\Requests\Secteur"
New-Folder "app\Http\Requests\Affectation"
New-Folder "app\Http\Requests\Session"
New-Folder "app\Http\Requests\Presence"

New-File "app\Http\Requests\Auth\Admin\LoginAdminRequest.php"
New-File "app\Http\Requests\Auth\Admin\RegisterAdminRequest.php"
New-File "app\Http\Requests\Auth\Formateur\LoginFormateurRequest.php"
New-File "app\Http\Requests\Auth\Formateur\RegisterFormateurRequest.php"

New-File "app\Http\Requests\Formateur\StoreFormateurRequest.php"
New-File "app\Http\Requests\Formateur\UpdateFormateurRequest.php"
New-File "app\Http\Requests\Etablissement\StoreEtablissementRequest.php"
New-File "app\Http\Requests\Etablissement\UpdateEtablissementRequest.php"
New-File "app\Http\Requests\Filiere\StoreFiliereRequest.php"
New-File "app\Http\Requests\Filiere\UpdateFiliereRequest.php"
New-File "app\Http\Requests\Niveau\StoreNiveauRequest.php"
New-File "app\Http\Requests\Niveau\UpdateNiveauRequest.php"
New-File "app\Http\Requests\Secteur\StoreSecteurRequest.php"
New-File "app\Http\Requests\Secteur\UpdateSecteurRequest.php"
New-File "app\Http\Requests\Affectation\StoreAffectationRequest.php"
New-File "app\Http\Requests\Affectation\UpdateAffectationRequest.php"
New-File "app\Http\Requests\Session\StoreSessionRequest.php"
New-File "app\Http\Requests\Session\UpdateSessionRequest.php"
New-File "app\Http\Requests\Presence\StorePresenceRequest.php"
New-File "app\Http\Requests\Presence\UpdatePresenceRequest.php"

# Middleware
New-Folder "app\Http\Middleware"
New-File "app\Http\Middleware\AdminMiddleware.php"
New-File "app\Http\Middleware\FormateurMiddleware.php"
New-File "app\Http\Middleware\RedirectIfAdmin.php"
New-File "app\Http\Middleware\RedirectIfFormateur.php"
New-File "app\Http\Middleware\RoleMiddleware.php"

# Resources
New-Folder "app\Http\Resources\Auth"
New-File "app\Http\Resources\FormateurResource.php"
New-File "app\Http\Resources\EtablissementResource.php"
New-File "app\Http\Resources\FiliereResource.php"
New-File "app\Http\Resources\NiveauResource.php"
New-File "app\Http\Resources\SecteurResource.php"
New-File "app\Http\Resources\AffectationResource.php"
New-File "app\Http\Resources\SessionResource.php"
New-File "app\Http\Resources\PresenceResource.php"
New-File "app\Http\Resources\Auth\AdminResource.php"
New-File "app\Http\Resources\Auth\FormateurUserResource.php"

# ViewModels
New-Folder "app\Http\ViewModels"
New-File "app\Http\ViewModels\FormateurViewModel.php"
New-File "app\Http\ViewModels\DashboardViewModel.php"

# Providers app
New-File "app\Providers\AuthServiceProvider.php"
New-File "app\Providers\HexagonalServiceProvider.php"

# ============================================================
# 5. DATABASE
# ============================================================
Write-Host "[5/7] Creation de database..." -ForegroundColor Yellow

New-Folder "database\factories"
New-Folder "database\migrations"
New-Folder "database\seeders"

# Migrations
New-File "database\migrations\2024_01_01_000001_create_admins_table.php"
New-File "database\migrations\2024_01_01_000002_create_formateurs_users_table.php"
New-File "database\migrations\2024_01_01_000003_create_niveaux_table.php"
New-File "database\migrations\2024_01_01_000004_create_secteurs_table.php"
New-File "database\migrations\2024_01_01_000005_create_filieres_table.php"
New-File "database\migrations\2024_01_01_000006_create_etablissements_table.php"
New-File "database\migrations\2024_01_01_000007_create_formateurs_table.php"
New-File "database\migrations\2024_01_01_000008_create_formateur_filieres_table.php"
New-File "database\migrations\2024_01_01_000009_create_affectations_table.php"
New-File "database\migrations\2024_01_01_000010_create_sessions_table.php"
New-File "database\migrations\2024_01_01_000011_create_presences_table.php"
New-File "database\migrations\2024_01_01_000012_create_filiere_options_table.php"
New-File "database\migrations\2024_01_01_000013_create_password_resets_table.php"

# Seeders
New-File "database\seeders\DatabaseSeeder.php"
New-File "database\seeders\AdminSeeder.php"
New-File "database\seeders\UserSeeder.php"
New-File "database\seeders\FormateurUserSeeder.php"
New-File "database\seeders\NiveauSeeder.php"
New-File "database\seeders\SecteurSeeder.php"
New-File "database\seeders\FiliereSeeder.php"
New-File "database\seeders\EtablissementSeeder.php"
New-File "database\seeders\FormateurSeeder.php"
New-File "database\seeders\AffectationSeeder.php"

# Factories
New-File "database\factories\AdminFactory.php"
New-File "database\factories\FormateurUserFactory.php"
New-File "database\factories\FormateurFactory.php"
New-File "database\factories\FiliereFactory.php"
New-File "database\factories\EtablissementFactory.php"
New-File "database\factories\NiveauFactory.php"
New-File "database\factories\SecteurFactory.php"

# ============================================================
# 6. RESOURCES / VIEWS
# ============================================================
Write-Host "[6/7] Creation de resources/views..." -ForegroundColor Yellow

New-Folder "resources\views\layouts"
New-Folder "resources\views\auth\admin"
New-Folder "resources\views\auth\formateur"
New-Folder "resources\views\auth\partials"
New-Folder "resources\views\admin\dashboard"
New-Folder "resources\views\admin\formateurs\partials"
New-Folder "resources\views\admin\etablissements\partials"
New-Folder "resources\views\admin\filieres\partials"
New-Folder "resources\views\admin\niveaux"
New-Folder "resources\views\admin\secteurs"
New-Folder "resources\views\admin\affectations\partials"
New-Folder "resources\views\admin\sessions"
New-Folder "resources\views\admin\presences"
New-Folder "resources\views\admin\users"
New-Folder "resources\views\formateur\dashboard"
New-Folder "resources\views\formateur\profile"
New-Folder "resources\views\formateur\affectations"
New-Folder "resources\views\formateur\sessions"
New-Folder "resources\views\formateur\presences"
New-Folder "resources\views\emails"

# Layouts
New-File "resources\views\layouts\app.blade.php"
New-File "resources\views\layouts\guest.blade.php"
New-File "resources\views\layouts\admin.blade.php"
New-File "resources\views\layouts\formateur.blade.php"
New-File "resources\views\layouts\navigation.blade.php"

# Auth Admin
New-File "resources\views\auth\admin\login.blade.php"
New-File "resources\views\auth\admin\register.blade.php"
New-File "resources\views\auth\admin\forgot-password.blade.php"
New-File "resources\views\auth\admin\reset-password.blade.php"
New-File "resources\views\auth\admin\verify-email.blade.php"

# Auth Formateur
New-File "resources\views\auth\formateur\login.blade.php"
New-File "resources\views\auth\formateur\register.blade.php"
New-File "resources\views\auth\formateur\forgot-password.blade.php"
New-File "resources\views\auth\formateur\reset-password.blade.php"
New-File "resources\views\auth\formateur\verify-email.blade.php"

# Auth partials
New-File "resources\views\auth\partials\login-form.blade.php"
New-File "resources\views\auth\partials\register-form.blade.php"
New-File "resources\views\auth\partials\password-form.blade.php"

# Admin dashboard
New-File "resources\views\admin\dashboard\index.blade.php"

# Admin formateurs
New-File "resources\views\admin\formateurs\index.blade.php"
New-File "resources\views\admin\formateurs\create.blade.php"
New-File "resources\views\admin\formateurs\edit.blade.php"
New-File "resources\views\admin\formateurs\show.blade.php"
New-File "resources\views\admin\formateurs\partials\form.blade.php"
New-File "resources\views\admin\formateurs\partials\filters.blade.php"

# Admin etablissements
New-File "resources\views\admin\etablissements\index.blade.php"
New-File "resources\views\admin\etablissements\create.blade.php"
New-File "resources\views\admin\etablissements\edit.blade.php"
New-File "resources\views\admin\etablissements\show.blade.php"
New-File "resources\views\admin\etablissements\partials\form.blade.php"

# Admin filieres
New-File "resources\views\admin\filieres\index.blade.php"
New-File "resources\views\admin\filieres\create.blade.php"
New-File "resources\views\admin\filieres\edit.blade.php"
New-File "resources\views\admin\filieres\show.blade.php"
New-File "resources\views\admin\filieres\partials\form.blade.php"

# Admin niveaux
New-File "resources\views\admin\niveaux\index.blade.php"
New-File "resources\views\admin\niveaux\create.blade.php"
New-File "resources\views\admin\niveaux\edit.blade.php"
New-File "resources\views\admin\niveaux\show.blade.php"

# Admin secteurs
New-File "resources\views\admin\secteurs\index.blade.php"
New-File "resources\views\admin\secteurs\create.blade.php"
New-File "resources\views\admin\secteurs\edit.blade.php"
New-File "resources\views\admin\secteurs\show.blade.php"

# Admin affectations
New-File "resources\views\admin\affectations\index.blade.php"
New-File "resources\views\admin\affectations\create.blade.php"
New-File "resources\views\admin\affectations\edit.blade.php"
New-File "resources\views\admin\affectations\show.blade.php"
New-File "resources\views\admin\affectations\partials\form.blade.php"

# Admin sessions
New-File "resources\views\admin\sessions\index.blade.php"
New-File "resources\views\admin\sessions\create.blade.php"
New-File "resources\views\admin\sessions\edit.blade.php"
New-File "resources\views\admin\sessions\show.blade.php"

# Admin presences
New-File "resources\views\admin\presences\index.blade.php"
New-File "resources\views\admin\presences\create.blade.php"
New-File "resources\views\admin\presences\edit.blade.php"
New-File "resources\views\admin\presences\show.blade.php"

# Admin users
New-File "resources\views\admin\users\index.blade.php"
New-File "resources\views\admin\users\create.blade.php"
New-File "resources\views\admin\users\edit.blade.php"
New-File "resources\views\admin\users\show.blade.php"

# Formateur
New-File "resources\views\formateur\dashboard\index.blade.php"
New-File "resources\views\formateur\profile\edit.blade.php"
New-File "resources\views\formateur\profile\show.blade.php"
New-File "resources\views\formateur\affectations\index.blade.php"
New-File "resources\views\formateur\affectations\show.blade.php"
New-File "resources\views\formateur\sessions\index.blade.php"
New-File "resources\views\formateur\sessions\show.blade.php"
New-File "resources\views\formateur\presences\index.blade.php"
New-File "resources\views\formateur\presences\create.blade.php"
New-File "resources\views\formateur\presences\edit.blade.php"

# Emails
New-File "resources\views\emails\reset-password.blade.php"
New-File "resources\views\emails\verify-email.blade.php"

# ============================================================
# 7. ROUTES, TESTS, STORAGE
# ============================================================
Write-Host "[7/7] Creation de routes, tests, storage..." -ForegroundColor Yellow

# Routes
New-File "routes\auth.php"
New-File "routes\admin.php"
New-File "routes\formateur.php"

# Tests
New-Folder "tests\Unit\Domain\Formateurs"
New-Folder "tests\Unit\Domain\Auth"
New-Folder "tests\Unit\Domain\Etablissements"
New-Folder "tests\Unit\Domain\Filieres"
New-Folder "tests\Unit\Domain\Niveaux"
New-Folder "tests\Unit\Domain\Secteurs"
New-Folder "tests\Unit\Domain\Affectations"
New-Folder "tests\Unit\Domain\Sessions"
New-Folder "tests\Unit\Domain\Presences"
New-Folder "tests\Unit\Application\Formateurs"
New-Folder "tests\Unit\Application\Auth"
New-Folder "tests\Unit\Infrastructure"
New-Folder "tests\Feature\Auth"
New-Folder "tests\Feature\Admin"
New-Folder "tests\Feature\Formateur"

New-File "tests\Unit\Domain\Formateurs\FormateurTest.php"
New-File "tests\Unit\Domain\Auth\AdminTest.php"
New-File "tests\Unit\Domain\Auth\FormateurUserTest.php"
New-File "tests\Unit\Domain\Auth\PasswordTest.php"
New-File "tests\Unit\Domain\Etablissements\EtablissementTest.php"
New-File "tests\Unit\Domain\Filieres\FiliereTest.php"
New-File "tests\Unit\Domain\Niveaux\NiveauTest.php"
New-File "tests\Unit\Domain\Secteurs\SecteurTest.php"
New-File "tests\Unit\Domain\Affectations\AffectationTest.php"
New-File "tests\Unit\Domain\Sessions\SessionTest.php"
New-File "tests\Unit\Domain\Presences\PresenceTest.php"
New-File "tests\Unit\Application\Formateurs\CreateFormateurUseCaseTest.php"
New-File "tests\Unit\Application\Auth\RegisterAdminUseCaseTest.php"
New-File "tests\Unit\Application\Auth\LoginAdminUseCaseTest.php"
New-File "tests\Unit\Application\Auth\RegisterFormateurUseCaseTest.php"
New-File "tests\Unit\Application\Auth\LoginFormateurUseCaseTest.php"
New-File "tests\Feature\Auth\AdminAuthTest.php"
New-File "tests\Feature\Auth\FormateurAuthTest.php"
New-File "tests\Feature\Auth\PasswordResetTest.php"
New-File "tests\Feature\Admin\DashboardTest.php"
New-File "tests\Feature\Admin\FormateurControllerTest.php"
New-File "tests\Feature\Formateur\DashboardTest.php"
New-File "tests\Feature\Formateur\ProfileTest.php"

# Storage
New-Folder "storage\app\public\avatars"
New-Folder "storage\app\public\formateurs"
New-Folder "storage\app\public\documents"
New-Folder "storage\app\public\exports"

# Config
New-File "config\hexagonal.php"

# ============================================================
# FIN
# ============================================================
Write-Host "`n=============================================" -ForegroundColor Green
Write-Host "  ✅ STRUCTURE HEXAGONALE CREEE AVEC SUCCES !" -ForegroundColor Green
Write-Host "=============================================" -ForegroundColor Green
Write-Host "`nProchaines etapes :" -ForegroundColor Cyan
Write-Host "  1. Configurer composer.json (namespaces)"
Write-Host "  2. composer dump-autoload"
Write-Host "  3. Configurer .env"
Write-Host "  4. php artisan storage:link"
Write-Host "  5. php artisan migrate --seed"
Write-Host "  6. php artisan serve"