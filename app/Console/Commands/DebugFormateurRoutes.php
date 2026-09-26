<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Route;

class DebugFormateurRoutes extends Command
{
    protected $signature = 'debug:formateur-routes';
    protected $description = 'Liste toutes les routes liées aux formateurs';

    public function handle(): int
    {
        $routes = collect(Route::getRoutes())->filter(function ($route) {
            return str_contains($route->uri(), 'formateur')
                || str_contains($route->getName() ?? '', 'formateur');
        });

        if ($routes->isEmpty()) {
            $this->error("[X] Aucune route formateur trouvée !");
            return self::FAILURE;
        }

        $this->table(
            ['Method', 'URI', 'Name', 'Action'],
            $routes->map(fn($r) => [
                implode('|', $r->methods()),
                $r->uri(),
                $r->getName() ?? '-',
                $r->getActionName(),
            ])->toArray()
        );

        return self::SUCCESS;
    }
}