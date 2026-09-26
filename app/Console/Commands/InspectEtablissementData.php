<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;

class InspectEtablissementData extends Command
{
    protected $signature = 'inspect:etablissement-data';
    protected $description = 'Inspecte les données réelles : types, régions, noms';

    public function handle(): int
    {
        $this->line('');
        $this->line('+==========================================================+');
        $this->line('|   🔎 INSPECTION DES DONNÉES ÉTABLISSEMENTS                |');
        $this->line('+==========================================================+');

        // ===============================================
        // 1. Chercher les seeders
        // ===============================================
        $this->line('');
        $this->line('> 1. Fichiers seeder');

        $seedersDir = database_path('seeders');
        if (File::exists($seedersDir)) {
            foreach (File::allFiles($seedersDir) as $f) {
                $this->line('   [FILE] ' . $f->getFilename() . ' (' . File::size($f->getPathname()) . ' octets)');
            }
        }

        // ===============================================
        // 2. Types distincts en DB
        // ===============================================
        $this->line('');
        $this->line('> 2. Types distincts dans la table etablissements');

        try {
            $types = DB::table('etablissements')
                ->select('type')
                ->distinct()
                ->whereNotNull('type')
                ->pluck('type')
                ->toArray();

            if (empty($types)) {
                $this->warn('   [!]️  Aucun type trouvé en DB');
            } else {
                foreach ($types as $t) {
                    $count = DB::table('etablissements')->where('type', $t)->count();
                    $this->info("   * \"{$t}\" ({$count} établissements)");
                }
            }
        } catch (\Throwable $e) {
            $this->error('   [X] Erreur : ' . $e->getMessage());
        }

        // ===============================================
        // 3. Régions distinctes en DB
        // ===============================================
        $this->line('');
        $this->line('> 3. Régions distinctes dans la table etablissements');

        try {
            $regions = DB::table('etablissements')
                ->select('region')
                ->distinct()
                ->whereNotNull('region')
                ->pluck('region')
                ->toArray();

            if (empty($regions)) {
                $this->warn('   [!]️  Aucune région trouvée en DB');
            } else {
                foreach ($regions as $r) {
                    $this->info("   * \"{$r}\"");
                }
            }
        } catch (\Throwable $e) {
            $this->error('   [X] Erreur : ' . $e->getMessage());
        }

        // ===============================================
        // 4. Noms distincts
        // ===============================================
        $this->line('');
        $this->line('> 4. Premiers noms dans la table etablissements');

        try {
            $noms = DB::table('etablissements')
                ->select('nom')
                ->limit(20)
                ->pluck('nom')
                ->toArray();

            foreach ($noms as $n) {
                $this->line("   * \"{$n}\"");
            }
        } catch (\Throwable $e) {
            $this->error('   [X] Erreur : ' . $e->getMessage());
        }

        // ===============================================
        // 5. Codes existants (pour comprendre le format)
        // ===============================================
        $this->line('');
        $this->line('> 5. Codes existants (format)');

        try {
            $codes = DB::table('etablissements')
                ->select('code', 'nom', 'type')
                ->limit(15)
                ->get();

            foreach ($codes as $c) {
                $this->line("   * code=\"{$c->code}\" | nom=\"{$c->nom}\" | type=\"{$c->type}\"");
            }
        } catch (\Throwable $e) {
            $this->error('   [X] Erreur : ' . $e->getMessage());
        }

        // ===============================================
        // 6. Chercher un seeder contenant "etablissement"
        // ===============================================
        $this->line('');
        $this->line('> 6. Recherche de seeder Etablissement');

        foreach (File::allFiles(database_path('seeders')) as $f) {
            $content = File::get($f->getPathname());
            if (stripos($content, 'etablissement') !== false) {
                $this->info("   [OK] " . $f->getFilename() . " contient des établissements");

                // Chercher les tableaux
                if (preg_match_all('/[\'"](CFP|CEG|LYCEE|IST|UNIV|ENI|CFPI)[^\'"]*[\'"]/', $content, $m)) {
                    $this->line('   Types détectés dans le seeder :');
                    foreach (array_unique($m[0]) as $t) {
                        $this->line("      * {$t}");
                    }
                }
            }
        }

        $this->line('');
        $this->line('-> Envoyez-moi TOUT ce rapport.');

        return self::SUCCESS;
    }
}