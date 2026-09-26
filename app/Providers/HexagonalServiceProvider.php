<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Domain\Formateurs\Ports\FormateurRepositoryInterface;
use Domain\Auth\Ports\PasswordHasherInterface;
use Infrastructure\Services\PdfExporterInterface;

use Infrastructure\Persistence\Eloquent\Repositories\EloquentFormateurRepository;
use Infrastructure\Adapters\Hashing\BcryptPasswordHasher;
use Infrastructure\Adapters\Pdf\DompdfExporter;

class HexagonalServiceProvider extends ServiceProvider
{
    public array $bindings = [
        FormateurRepositoryInterface::class => EloquentFormateurRepository::class,
        PasswordHasherInterface::class => BcryptPasswordHasher::class,
        PdfExporterInterface::class => DompdfExporter::class,
    ];

    public function register(): void {}
    public function boot(): void {}
}