<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Artisan;

class FixAuditFindings extends Command
{
    protected $signature = 'fix:audit-findings';
    protected $description = 'Corrige les vues manquantes + nettoie le détecteur';

    public function handle(): int
    {
        $this->line('');
        $this->line('+==========================================================+');
        $this->line('|   [TOOL] CORRECTION DES RÉSULTATS D\'AUDIT                   |');
        $this->line('+==========================================================+');

        // ===============================================
        // 1. Créer admin/notifications/index.blade.php
        // ===============================================
        $this->line('');
        $this->line('> 1/4 - Vue admin/notifications/index.blade.php');

        $notifDir = resource_path('views/admin/notifications');
        if (!File::exists($notifDir)) {
            File::makeDirectory($notifDir, 0755, true);
            $this->line('   [DIR] Dossier créé');
        }

        $notifPath = $notifDir . '/index.blade.php';
        if (!File::exists($notifPath)) {
            File::put($notifPath, $this->getNotificationsIndexView());
            $this->info('   [OK] Vue créée');
        } else {
            $this->warn('   >>️  Existe déjà');
        }

        // ===============================================
        // 2. Créer formateur/demandes/show.blade.php
        // ===============================================
        $this->line('');
        $this->line('> 2/4 - Vue formateur/demandes/show.blade.php');

        $demandeDir = resource_path('views/formateur/demandes');
        if (!File::exists($demandeDir)) {
            File::makeDirectory($demandeDir, 0755, true);
            $this->line('   [DIR] Dossier créé');
        }

        $demandePath = $demandeDir . '/show.blade.php';
        if (!File::exists($demandePath)) {
            File::put($demandePath, $this->getDemandeShowView());
            $this->info('   [OK] Vue créée');
        } else {
            $this->warn('   >>️  Existe déjà');
        }

        // ===============================================
        // 3. Améliorer le détecteur de vues
        // ===============================================
        $this->line('');
        $this->line('> 3/4 - Amélioration du détecteur de vues');

        $auditPath = app_path('Console/Commands/FullProjectAudit.php');
        $content = File::get($auditPath);

        // Backup
        File::copy($auditPath, $auditPath . '.bak.' . date('Y-m-d_His'));

        // Améliorer la regex pour ignorer les faux positifs
        $oldRegex = "preg_match_all('/@(?:include|extends|component)\\s*\\(\\s*[\\'\"]([^\\'\"]+)[\\'\"]/', \$content, \$m);";
        $newRegex = "preg_match_all('/@(?:include|extends|component)\\s*\\(\\s*[\\'\"]([a-zA-Z0-9_.\\-]+)[\\'\"]/', \$content, \$m);";

        $content = str_replace($oldRegex, $newRegex, $content);

        // Filtrer les scripts d'installation et le fichier d'audit
        $content = str_replace(
            '$sources[] = $f;',
            "// Ignorer les scripts d'installation et ce fichier d'audit\n            if (str_starts_with(\$f->getFilename(), 'Install')) continue;\n            if (\$f->getFilename() === 'FullProjectAudit.php') continue;\n            \$sources[] = \$f;",
            $content
        );

        File::put($auditPath, $content);
        $this->info('   [OK] Détecteur amélioré');
        $this->line('      * Ignore les "..." dans le code');
        $this->line('      * Ignore les fichiers Install*.php');
        $this->line('      * Ignore FullProjectAudit.php lui-même');

        // ===============================================
        // 4. Vider les caches + relancer l'audit
        // ===============================================
        $this->line('');
        $this->line('> 4/4 - Nettoyage + Audit final');

        Artisan::call('view:clear');
        Artisan::call('optimize:clear');
        $this->info('   [OK] Caches vidés');

        $this->line('');
        $this->line('===========================================================');
        $this->line('');

        // Relancer l'audit
        $this->call('audit:full');

        return self::SUCCESS;
    }

    // =======================================================
    // Vue : admin/notifications/index.blade.php
    // =======================================================
    private function getNotificationsIndexView(): string
    {
        return <<<'BLADE'
@extends('layouts.admin')
@section('title', 'Notifications')

@section('content')
<div class="mb-6 flex items-center justify-between">
    <div>
        <h1 class="font-display text-2xl font-bold text-slate-900">Notifications</h1>
        <p class="text-sm text-slate-500 mt-1">Toutes vos notifications</p>
    </div>
    @if(isset($notifications) && $notifications->count() > 0)
    <form method="POST" action="{{ route('admin.notifications.markAllAsRead') ?? '#' }}">
        @csrf
        <button type="submit" class="btn-secondary">
            <span class="material-symbols-rounded text-[18px]">done_all</span>
            Tout marquer comme lu
        </button>
    </form>
    @endif
</div>

<div class="bg-white rounded-xl border border-slate-200 overflow-hidden">
    @forelse($notifications ?? [] as $notif)
        <div class="flex items-start gap-4 p-4 border-b border-slate-100 hover:bg-slate-50 transition
                    {{ !$notif->read_at ? 'bg-emerald-50/40' : '' }}">
            <div class="w-10 h-10 rounded-xl bg-emerald-100 flex items-center justify-center shrink-0">
                <span class="material-symbols-rounded text-emerald-700 text-[22px]">
                    {{ $notif->type ?? 'notifications' }}
                </span>
            </div>
            <div class="flex-1 min-w-0">
                <div class="flex items-start justify-between gap-4">
                    <div>
                        <p class="text-sm font-semibold text-slate-900">{{ $notif->titre ?? 'Notification' }}</p>
                        <p class="text-xs text-slate-600 mt-1">{{ $notif->message ?? '' }}</p>
                    </div>
                    <span class="text-[11px] text-slate-400 whitespace-nowrap">
                        {{ isset($notif->created_at) ? $notif->created_at->diffForHumans() : '' }}
                    </span>
                </div>
            </div>
        </div>
    @empty
        <div class="text-center py-16 text-slate-400">
            <span class="material-symbols-rounded text-5xl block mb-3">notifications_off</span>
            <p class="text-sm">Aucune notification</p>
        </div>
    @endforelse
</div>

@if(isset($notifications) && method_exists($notifications, 'links'))
    <div class="mt-4">
        {{ $notifications->links() }}
    </div>
@endif
@endsection
BLADE;
    }

    // =======================================================
    // Vue : formateur/demandes/show.blade.php
    // =======================================================
    private function getDemandeShowView(): string
    {
        return <<<'BLADE'
@extends('layouts.admin')
@section('title', 'Demande d\'affectation')

@section('content')
<div class="mb-6">
    <a href="{{ route('formateur.demandes.index') }}" class="text-[12px] text-slate-500 hover:text-brand-700">
        <- Retour aux demandes
    </a>
    <h1 class="font-display text-2xl font-bold text-slate-900 mt-2">
        Demande #{{ $demande->id ?? '-' }}
    </h1>
</div>

<div class="bg-white rounded-xl border border-slate-200 p-6">
    <dl class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
        <div>
            <dt class="text-slate-500 text-xs uppercase tracking-wide mb-1">Statut</dt>
            <dd class="font-semibold">
                @php $statut = $demande->statut ?? 'en_attente'; @endphp
                <span class="inline-flex px-2 py-0.5 rounded-full text-xs font-semibold
                    @if($statut === 'approuvee') bg-emerald-100 text-emerald-800
                    @elseif($statut === 'refusee') bg-red-100 text-red-800
                    @else bg-amber-100 text-amber-800 @endif">
                    {{ ucfirst(str_replace('_', ' ', $statut)) }}
                </span>
            </dd>
        </div>

        <div>
            <dt class="text-slate-500 text-xs uppercase tracking-wide mb-1">Créée le</dt>
            <dd class="font-semibold">
                {{ isset($demande->created_at) ? $demande->created_at->format('d/m/Y H:i') : '-' }}
            </dd>
        </div>

        <div class="md:col-span-2">
            <dt class="text-slate-500 text-xs uppercase tracking-wide mb-1">Motif</dt>
            <dd class="text-slate-700">{{ $demande->motif ?? '-' }}</dd>
        </div>
    </dl>
</div>
@endsection
BLADE;
    }
}