<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ExportHomePage extends Command
{
    protected $signature = 'project:export-home
                            {--output=home-page-export.md : Fichier de sortie}
                            {--format=md : Format (md|txt)}';

    protected $description = 'Exporte uniquement les fichiers de la page d\'accueil (/ -> welcome)';

    /**
     * Les 5 fichiers essentiels de la page d'accueil
     */
    protected array $files = [
        // 1. Point d'entrée
        'public/index.php'                              => 'Point d\'entrée de l\'application',

        // 2. Route
        'routes/web.php'                                => 'Route "/" qui pointe vers welcome',

        // 3. Vue affichée
        'resources/views/welcome.blade.php'             => 'Contenu HTML de la page d\'accueil',

        // 4. Layout parent
        'resources/views/layouts/guest.blade.php'       => 'Layout utilisé par welcome',

        // 5. Style
        'resources/css/app.css'                         => 'Styles Tailwind v4 (thème vert)',
    ];

    public function handle(): int
    {
        $output = $this->option('output');
        $format = $this->option('format');

        $this->info("[BOX] Export des fichiers de la page d'accueil...");
        $this->newLine();

        $basePath = base_path();
        $content = match ($format) {
            'txt'   => $this->buildTxt($basePath),
            default => $this->buildMarkdown($basePath),
        };

        $outputPath = $basePath . '/' . $output;
        file_put_contents($outputPath, $content);

        $size = round(strlen($content) / 1024, 2);
        $this->newLine();
        $this->info("[OK] Export terminé : {$output} ({$size} KB)");

        return self::SUCCESS;
    }

    protected function buildMarkdown(string $basePath): string
    {
        $out = "# Export - Page d'accueil (`/`)\n\n";
        $out .= "**URL concernée :** `http://localhost:8000/`\n\n";
        $out .= "Généré le : " . now()->format('Y-m-d H:i:s') . "\n\n";
        $out .= "## [LIST] Fichiers inclus\n\n";

        foreach ($this->files as $path => $desc) {
            $exists = file_exists($basePath . '/' . $path);
            $out .= "- " . ($exists ? '[OK]' : '[X]') . " `{$path}` - {$desc}\n";
        }

        $out .= "\n---\n\n";

        foreach ($this->files as $path => $desc) {
            $fullPath = $basePath . '/' . $path;

            $out .= "## {$path}\n\n";
            $out .= "> {$desc}\n\n";

            if (!file_exists($fullPath)) {
                $out .= "[!]️ **Fichier introuvable**\n\n";
                $this->warn("[X] Manquant : {$path}");
                continue;
            }

            $fileContent = file_get_contents($fullPath);
            $ext = $this->detectExtension($path);

            $out .= "```{$ext}\n";
            $out .= rtrim($fileContent) . "\n";
            $out .= "```\n\n";

            $size = round(strlen($fileContent) / 1024, 2);
            $this->line("  [OK] {$path} ({$size} Ko)");
        }

        // Bonus : chaîne d'exécution
        $out .= "---\n\n";
        $out .= "## [LINK] Chaîne d'exécution\n\n";
        $out .= "```\n";
        $out .= "Navigateur -> http://localhost:8000/\n";
        $out .= "         v\n";
        $out .= "   public/index.php              (point d'entrée PHP)\n";
        $out .= "         v\n";
        $out .= "   bootstrap/app.php             (charge routes/web.php)\n";
        $out .= "         v\n";
        $out .= "   routes/web.php ⭐            (route '/' -> view('welcome'))\n";
        $out .= "         v\n";
        $out .= "   resources/views/welcome.blade.php\n";
        $out .= "         v\n";
        $out .= "   resources/views/layouts/guest.blade.php\n";
        $out .= "         v\n";
        $out .= "   resources/css/app.css         (styles Tailwind v4)\n";
        $out .= "```\n";

        return $out;
    }

    protected function buildTxt(string $basePath): string
    {
        $out = "===========================================\n";
        $out .= "EXPORT PAGE D'ACCUEIL (/)\n";
        $out .= "URL : http://localhost:8000/\n";
        $out .= "Généré le : " . now()->format('Y-m-d H:i:s') . "\n";
        $out .= "===========================================\n\n";

        foreach ($this->files as $path => $desc) {
            $fullPath = $basePath . '/' . $path;

            $sep = str_repeat('=', 60);
            $out .= "{$sep}\n";
            $out .= "FICHIER : {$path}\n";
            $out .= "DESC    : {$desc}\n";
            $out .= "{$sep}\n\n";

            if (!file_exists($fullPath)) {
                $out .= "[FICHIER INTROUVABLE]\n\n\n";
                continue;
            }

            $out .= rtrim(file_get_contents($fullPath)) . "\n\n\n";
            $this->line("  [OK] {$path}");
        }

        return $out;
    }

    protected function detectExtension(string $path): string
    {
        if (str_ends_with($path, '.blade.php')) return 'blade';
        if (str_ends_with($path, '.php'))       return 'php';
        if (str_ends_with($path, '.css'))       return 'css';
        if (str_ends_with($path, '.js'))        return 'js';
        return 'txt';
    }
}