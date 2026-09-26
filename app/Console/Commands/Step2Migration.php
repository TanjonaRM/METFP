<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Artisan;

class Step2Migration extends Command
{
    protected $signature = 'step2:migration';
    protected $description = 'Ajoute les colonnes motif_refus, valide_le, valide_par';

    public function handle(): int
    {
        $this->line('');
        $this->line('+==========================================================+');
        $this->line('|   [DB]️  ÉTAPE 2 : MIGRATION COLONNES MANQUANTES             |');
        $this->line('+==========================================================+');

        $columns = Schema::getColumnListing('formateurs_users');

        $missing = [];
        foreach (['motif_refus', 'valide_le', 'valide_par'] as $col) {
            if (!in_array($col, $columns)) $missing[] = $col;
        }

        if (empty($missing)) {
            $this->info('[OK] Toutes les colonnes existent déjà');
            return self::SUCCESS;
        }

        $this->line('Colonnes manquantes : ' . implode(', ', $missing));

        // Créer la migration
        $timestamp = date('Y_m_d_His');
        $filename = "{$timestamp}_add_validation_columns_to_formateurs_users.php";
        $path = database_path("migrations/{$filename}");

        $content = <<<'PHP'
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('formateurs_users', function (Blueprint $table) {
            if (!Schema::hasColumn('formateurs_users', 'motif_refus')) {
                $table->text('motif_refus')->nullable()->after('statut');
            }
            if (!Schema::hasColumn('formateurs_users', 'valide_le')) {
                $table->timestamp('valide_le')->nullable()->after('motif_refus');
            }
            if (!Schema::hasColumn('formateurs_users', 'valide_par')) {
                $table->unsignedBigInteger('valide_par')->nullable()->after('valide_le');
            }
        });
    }

    public function down(): void
    {
        Schema::table('formateurs_users', function (Blueprint $table) {
            $table->dropColumn(['motif_refus', 'valide_le', 'valide_par']);
        });
    }
};
PHP;

        File::put($path, $content);
        $this->info("[OK] Migration créée : {$filename}");

        // Exécuter
        $this->call('migrate', ['--force' => true]);

        // Vérifier
        $newColumns = Schema::getColumnListing('formateurs_users');
        foreach (['motif_refus', 'valide_le', 'valide_par'] as $col) {
            if (in_array($col, $newColumns)) {
                $this->info("   [OK] {$col}");
            } else {
                $this->error("   [X] {$col} MANQUANT");
            }
        }

        $this->call('optimize:clear');

        $this->line('');
        $this->info('[SUCCESS] ÉTAPE 2 TERMINÉE !');
        $this->line('-> Passez à l\'étape 3 : php artisan step3:mailables');

        return self::SUCCESS;
    }
}