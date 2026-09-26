<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class Step5Admin extends Command
{
    protected $signature = 'step5:admin';
    protected $description = 'Crée le controller et la vue admin de validation';

    public function handle(): int
    {
        $this->line('');
        $this->line('+==========================================================+');
        $this->line('|   🎛️  ÉTAPE 5 : ADMIN VALIDATION                          |');
        $this->line('+==========================================================+');

        // Controller
        $ctrlPath = app_path('Http/Controllers/Admin/DemandeFormateurController.php');
        File::put($ctrlPath, $this->controller());
        $this->info('[OK] DemandeFormateurController.php');

        // Vue admin
        $viewDir = resource_path('views/admin/demandes-formateurs');
        if (!File::exists($viewDir)) File::makeDirectory($viewDir, 0755, true);

        File::put($viewDir . '/index.blade.php', $this->adminView());
        $this->info('[OK] admin/demandes-formateurs/index.blade.php');

        $this->call('view:clear');
        $this->call('optimize:clear');

        $this->line('');
        $this->line('===========================================================');
        $this->warn('[!]️  ACTION MANUELLE REQUISE : Ajouter les routes');
        $this->line('===========================================================');
        $this->line('');
        $this->line('Ouvrez routes/web.php et ajoutez dans le groupe admin :');
        $this->line('');
        $this->line("Route::get('/demandes-formateurs',");
        $this->line("    [App\Http\Controllers\Admin\DemandeFormateurController::class, 'index'])");
        $this->line("    ->name('admin.demandes-formateurs.index');");
        $this->line('');
        $this->line("Route::post('/demandes-formateurs/{id}/approuver',");
        $this->line("    [App\Http\Controllers\Admin\DemandeFormateurController::class, 'approuver'])");
        $this->line("    ->name('admin.demandes-formateurs.approuver');");
        $this->line('');
        $this->line("Route::post('/demandes-formateurs/{id}/refuser',");
        $this->line("    [App\Http\Controllers\Admin\DemandeFormateurController::class, 'refuser'])");
        $this->line("    ->name('admin.demandes-formateurs.refuser');");
        $this->line('');
        $this->line('-> Puis lancez : php artisan route:clear');

        return self::SUCCESS;
    }

    private function controller(): string
    {
        return <<<'PHP'
<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\FormateurApprouveMail;
use App\Mail\FormateurRefuseMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Infrastructure\Persistence\Eloquent\Models\FormateurUserModel;

class DemandeFormateurController extends Controller
{
    public function index()
    {
        $demandes = FormateurUserModel::where('statut', 'en_attente')
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('admin.demandes-formateurs.index', compact('demandes'));
    }

    public function approuver(Request $request, int $id)
    {
        $formateur = FormateurUserModel::findOrFail($id);

        if ($formateur->statut !== 'en_attente') {
            return back()->with('error', 'Ce formateur a déjà été traité.');
        }

        $formateur->update([
            'statut'     => 'actif',
            'valide_le'  => now(),
            'valide_par' => auth('admin')->id(),
        ]);

        // Email
        try {
            Mail::to($formateur->email)->send(new FormateurApprouveMail($formateur, $request->message));
        } catch (\Throwable $e) {
            \Log::warning('Email échoué : ' . $e->getMessage());
        }

        return back()->with('success', "[OK] Formateur {$formateur->prenom} {$formateur->nom} approuvé.");
    }

    public function refuser(Request $request, int $id)
    {
        $request->validate(['motif' => 'required|string|max:500']);

        $formateur = FormateurUserModel::findOrFail($id);

        $formateur->update([
            'statut'      => 'refuse',
            'motif_refus' => $request->motif,
            'valide_le'   => now(),
            'valide_par'  => auth('admin')->id(),
        ]);

        try {
            Mail::to($formateur->email)->send(new FormateurRefuseMail($formateur, $request->motif));
        } catch (\Throwable $e) {
            \Log::warning('Email échoué : ' . $e->getMessage());
        }

        return back()->with('success', "[X] Formateur {$formateur->prenom} {$formateur->nom} refusé.");
    }
}
PHP;
    }

    private function adminView(): string
    {
        return <<<'BLADE'
@extends('layouts.admin')
@section('title', 'Demandes formateurs')

@section('content')

<div class="mb-6">
    <h1 class="font-display text-2xl font-bold text-slate-900">Demandes d'inscription formateur</h1>
    <p class="text-sm text-slate-500 mt-1">Validez ou refusez les nouvelles inscriptions</p>
</div>

@if(session('success'))
    <div class="mb-4 p-4 rounded-lg bg-emerald-50 border border-emerald-200">
        <p class="text-sm text-emerald-800">{{ session('success') }}</p>
    </div>
@endif

@if(session('error'))
    <div class="mb-4 p-4 rounded-lg bg-red-50 border border-red-200">
        <p class="text-sm text-red-800">{{ session('error') }}</p>
    </div>
@endif

<div class="bg-white rounded-xl border border-slate-200 overflow-hidden">
    <table class="w-full">
        <thead class="bg-slate-50 border-b border-slate-200">
            <tr>
                <th class="px-4 py-3 text-left text-xs font-semibold text-slate-700 uppercase">Formateur</th>
                <th class="px-4 py-3 text-left text-xs font-semibold text-slate-700 uppercase">Email</th>
                <th class="px-4 py-3 text-left text-xs font-semibold text-slate-700 uppercase">Date</th>
                <th class="px-4 py-3 text-right text-xs font-semibold text-slate-700 uppercase">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($demandes ?? [] as $d)
                <tr class="border-b border-slate-100 hover:bg-slate-50">
                    <td class="px-4 py-3 text-sm font-semibold text-slate-900">{{ $d->prenom }} {{ $d->nom }}</td>
                    <td class="px-4 py-3 text-sm text-slate-600">{{ $d->email }}</td>
                    <td class="px-4 py-3 text-xs text-slate-500">{{ $d->created_at->diffForHumans() }}</td>
                    <td class="px-4 py-3 text-right space-x-2">
                        <form method="POST" action="{{ route('admin.demandes-formateurs.approuver', $d->id) }}" class="inline">
                            @csrf
                            <button type="submit" class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg bg-emerald-600 text-white text-xs font-semibold hover:bg-emerald-700">
                                <span class="material-symbols-rounded text-[16px]">check</span>
                                Approuver
                            </button>
                        </form>
                        <button type="button" onclick="document.getElementById('refus-{{ $d->id }}').classList.toggle('hidden')"
                                class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg bg-red-600 text-white text-xs font-semibold hover:bg-red-700">
                            <span class="material-symbols-rounded text-[16px]">close</span>
                            Refuser
                        </button>
                    </td>
                </tr>
                <tr id="refus-{{ $d->id }}" class="hidden bg-red-50">
                    <td colspan="4" class="px-4 py-3">
                        <form method="POST" action="{{ route('admin.demandes-formateurs.refuser', $d->id) }}" class="flex items-center gap-3">
                            @csrf
                            <input type="text" name="motif" placeholder="Motif du refus..." required
                                   class="flex-1 px-3 py-2 text-sm border border-red-300 rounded-lg focus:ring-2 focus:ring-red-500">
                            <button type="submit" class="px-4 py-2 bg-red-600 text-white text-sm font-semibold rounded-lg hover:bg-red-700">
                                Confirmer le refus
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center py-12 text-slate-400">
                        <span class="material-symbols-rounded text-4xl block mb-2">inbox</span>
                        <p class="text-sm">Aucune demande en attente</p>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

@if(isset($demandes) && method_exists($demandes, 'links'))
    <div class="mt-4">{{ $demandes->links() }}</div>
@endif

@endsection
BLADE;
    }
}