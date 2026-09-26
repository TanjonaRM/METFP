<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class InstallFormateurSidebar extends Command
{
    protected $signature = 'project:install-formateur-sidebar
                            {--backup : Sauvegarder le fichier existant (.bak)}
                            {--force : Écraser sans confirmation}';

    protected $description = 'Installe la sidebar formateur (identique à admin : 300px + rétractable + verrouillage)';

    public function handle(): int
    {
        $this->info("[TARGET] Installation de la sidebar formateur (style admin)");
        $this->newLine();

        if (!$this->option('force') && !$this->confirm('Réécrire resources/views/layouts/formateur.blade.php ?', true)) {
            $this->warn('Annulé.');
            return self::FAILURE;
        }

        $path = 'resources/views/layouts/formateur.blade.php';
        $fullPath = base_path($path);

        if (!File::exists(dirname($fullPath))) {
            File::makeDirectory(dirname($fullPath), 0755, true);
        }

        if ($this->option('backup') && File::exists($fullPath)) {
            $backupPath = $fullPath . '.bak.' . date('Y-m-d_H-i-s');
            File::copy($fullPath, $backupPath);
            $this->line("  [SAVE] Backup : " . basename($backupPath));
        }

        $content = $this->getLayout();
        File::put($fullPath, $content);

        $size = round(strlen($content) / 1024, 2);
        $this->line("  [OK] {$path} ({$size} Ko)");

        $this->newLine();
        $this->info("[CLEAN] Nettoyage des caches...");
        $this->call('view:clear');
        $this->call('cache:clear');

        $this->newLine();
        $this->info("✨ SUCCÈS : sidebar formateur installée");
        $this->line("  * Largeur : 300px");
        $this->line("  * Rétractable au survol");
        $this->line("  * Bouton de verrouillage (3 états)");
        $this->line("  * Tooltips sur les icônes");

        return self::SUCCESS;
    }

    protected function getLayout(): string
    {
        return <<<'BLADE'
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Espace Formateur') - SGFORMATEURS</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" rel="stylesheet">

    <style>
        /* =========================================================
           VARIABLES
        ========================================================= */
        :root {
            --sidebar-collapsed: 72px;
            --sidebar-expanded: 300px;
            --transition-speed: 0.3s;
            --transition-ease: cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* =========================================================
           SIDEBAR
        ========================================================= */
        #sidebar-formateur {
            width: var(--sidebar-collapsed);
            transition: width var(--transition-speed) var(--transition-ease);
            overflow: visible;
        }

        #sidebar-formateur:not(.sidebar-locked):hover {
            width: var(--sidebar-expanded);
            box-shadow: 8px 0 24px rgba(0, 0, 0, 0.15);
        }

        #sidebar-formateur.sidebar-locked.sidebar-locked-expanded {
            width: var(--sidebar-expanded);
            box-shadow: 8px 0 24px rgba(0, 0, 0, 0.15);
        }

        /* Logo */
        .sidebar-logo-text {
            opacity: 0;
            transition: opacity 0.2s ease 0.1s;
            white-space: nowrap;
        }
        #sidebar-formateur:not(.sidebar-locked):hover .sidebar-logo-text,
        #sidebar-formateur.sidebar-locked.sidebar-locked-expanded .sidebar-logo-text {
            opacity: 1;
        }

        /* Sections */
        .sidebar-section-label {
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 0.14em;
            text-transform: uppercase;
            color: rgba(167, 243, 208, 0.5);
            padding: 0 18px;
            max-height: 0;
            opacity: 0;
            overflow: hidden;
            white-space: nowrap;
            transition: all 0.25s ease;
        }
        #sidebar-formateur:not(.sidebar-locked):hover .sidebar-section-label,
        #sidebar-formateur.sidebar-locked.sidebar-locked-expanded .sidebar-section-label {
            opacity: 1;
            max-height: 60px;
            padding: 20px 18px 10px 18px;
        }

        /* Liens */
        .sidebar-link {
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 14px 18px;
            border-radius: 12px;
            font-size: 14px;
            font-weight: 500;
            transition: background 0.15s ease, color 0.15s ease;
            text-decoration: none;
            white-space: nowrap;
        }
        .sidebar-link .material-symbols-rounded {
            font-size: 22px;
            flex-shrink: 0;
            min-width: 24px;
            text-align: center;
        }
        .sidebar-link-text {
            opacity: 0;
            transition: opacity 0.15s ease;
            white-space: nowrap;
        }
        #sidebar-formateur:not(.sidebar-locked):hover .sidebar-link-text,
        #sidebar-formateur.sidebar-locked.sidebar-locked-expanded .sidebar-link-text {
            opacity: 1;
            transition: opacity 0.2s ease 0.1s;
        }

        .sidebar-link-active {
            background: rgba(255, 255, 255, 0.12);
            color: #ffffff;
            box-shadow: inset 3px 0 0 #34d399;
        }
        .sidebar-link-inactive {
            color: rgba(209, 250, 229, 0.75);
        }
        .sidebar-link-inactive:hover {
            background: rgba(255, 255, 255, 0.06);
            color: #ffffff;
        }

        /* Profil */
        .sidebar-profile-text {
            opacity: 0;
            transition: opacity 0.15s ease;
            white-space: nowrap;
            overflow: hidden;
        }
        #sidebar-formateur:not(.sidebar-locked):hover .sidebar-profile-text,
        #sidebar-formateur.sidebar-locked.sidebar-locked-expanded .sidebar-profile-text {
            opacity: 1;
            transition: opacity 0.2s ease 0.1s;
        }

        /* Bouton verrouillage */
        .sidebar-lock-btn {
            position: absolute;
            top: 20px;
            right: 8px;
            width: 32px;
            height: 32px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(255, 255, 255, 0.06);
            color: rgba(167, 243, 208, 0.6);
            border: none;
            cursor: pointer;
            transition: all 0.2s ease;
            opacity: 0;
            z-index: 10;
        }
        #sidebar-formateur:hover .sidebar-lock-btn,
        #sidebar-formateur.sidebar-locked .sidebar-lock-btn {
            opacity: 1;
        }
        .sidebar-lock-btn:hover {
            background: rgba(255, 255, 255, 0.15);
            color: #ffffff;
        }
        .sidebar-lock-btn .material-symbols-rounded {
            font-size: 18px;
        }
        #sidebar-formateur.sidebar-locked .sidebar-lock-btn {
            background: rgba(52, 211, 153, 0.2);
            color: #34d399;
        }
        #sidebar-formateur.sidebar-locked .sidebar-lock-btn:hover {
            background: rgba(52, 211, 153, 0.3);
        }

        /* Tooltip global */
        #global-tooltip-formateur {
            position: fixed;
            background: #18181b;
            color: #ffffff;
            padding: 10px 16px;
            border-radius: 10px;
            font-size: 13px;
            font-weight: 600;
            white-space: nowrap;
            pointer-events: none;
            opacity: 0;
            visibility: hidden;
            transform: translateY(-50%) translateX(-8px);
            transition: opacity 0.15s ease, transform 0.15s ease, visibility 0.15s;
            z-index: 99999;
            box-shadow: 0 10px 30px -8px rgba(0, 0, 0, 0.4);
        }
        #global-tooltip-formateur.visible {
            opacity: 1;
            visibility: visible;
            transform: translateY(-50%) translateX(0);
        }
        #global-tooltip-formateur::before {
            content: '';
            position: absolute;
            right: 100%;
            top: 50%;
            transform: translateY(-50%);
            border: 6px solid transparent;
            border-right-color: #18181b;
        }

        /* Contenu principal */
        .main-wrapper-formateur {
            margin-left: 0;
            transition: margin-left var(--transition-speed) var(--transition-ease);
        }

        @media (min-width: 1024px) {
            .main-wrapper-formateur {
                margin-left: var(--sidebar-collapsed);
            }
            .main-wrapper-formateur.sidebar-expanded {
                margin-left: var(--sidebar-expanded);
            }
        }
    </style>
</head>
<body class="font-sans bg-slate-50 text-slate-900 antialiased">

@php
    $formateur = Auth::guard('formateur')->user();
    $initials = strtoupper(
        substr($formateur->prenom ?? 'F', 0, 1) . substr($formateur->nom ?? 'M', 0, 1)
    );

    $menu = [
        [
            'route' => 'formateur.dashboard',
            'url'   => 'formateur.dashboard',
            'icon'  => 'home',
            'label' => 'Tableau de bord',
        ],
        ['section' => 'Mon activité'],
        [
            'route' => 'formateur.affectations.*',
            'url'   => 'formateur.affectations.index',
            'icon'  => 'assignment_ind',
            'label' => 'Mes affectations',
        ],
        [
            'route' => 'formateur.sessions.*',
            'url'   => 'formateur.sessions.index',
            'icon'  => 'event',
            'label' => 'Mes sessions',
        ],
        ['section' => 'Mon compte'],
        [
            'route' => 'formateur.profile.*',
            'url'   => 'formateur.profile.edit',
            'icon'  => 'person',
            'label' => 'Mon profil',
        ],
    ];
@endphp

{{-- ============================================================
     SIDEBAR
     ============================================================ --}}
<aside id="sidebar-formateur"
       class="fixed top-0 left-0 h-screen bg-brand-900 flex flex-col z-50
              -translate-x-full lg:translate-x-0">

    {{-- Logo + Bouton verrouillage --}}
    <div class="relative flex items-center gap-4 px-5 h-20 border-b border-white/10 shrink-0">

        <div class="w-8 h-8 rounded-lg bg-white/10 flex items-center justify-center shrink-0
                    ring-1 ring-white/10">
            <span class="material-symbols-rounded text-white text-[20px]"
                  style="font-variation-settings: 'FILL' 1;">school</span>
        </div>
        <div class="sidebar-logo-text flex flex-col leading-tight">
            <span class="font-display font-bold text-white text-[15px] tracking-tight">
                SGFORMATEURS
            </span>
            <span class="text-[11px] text-emerald-200/70 mt-1">
                Espace Formateur
            </span>
        </div>

        <button id="sidebar-lock-btn-formateur"
                class="sidebar-lock-btn"
                onclick="toggleSidebarLockFormateur()"
                title="Verrouiller / Déverrouiller">
            <span class="material-symbols-rounded" id="lock-icon-formateur">lock_open</span>
        </button>
    </div>

    {{-- Menu --}}
    <nav class="flex-1 overflow-y-auto overflow-x-hidden px-3 py-5 space-y-1.5">
        @foreach($menu as $item)
            @if(isset($item['section']))
                <div class="sidebar-section-label">
                    {{ $item['section'] }}
                </div>
            @else
                @php $active = request()->routeIs($item['route']); @endphp
                <a href="{{ route($item['url']) }}"
                   class="sidebar-link {{ $active ? 'sidebar-link-active' : 'sidebar-link-inactive' }}"
                   data-tooltip="{{ $item['label'] }}">
                    <span class="material-symbols-rounded shrink-0">
                        {{ $item['icon'] }}
                    </span>
                    <span class="sidebar-link-text flex-1">
                        {{ $item['label'] }}
                    </span>
                </a>
            @endif
        @endforeach
    </nav>

    {{-- Profil --}}
    <div class="p-3 border-t border-white/10 shrink-0">
        <div class="flex items-center gap-3 p-2 rounded-xl bg-white/5">
            <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-brand-400 to-brand-600
                        flex items-center justify-center
                        text-white font-bold text-[13px] shrink-0
                        ring-2 ring-white/10">
                {{ $initials }}
            </div>
            <div class="sidebar-profile-text flex-1 min-w-0">
                <div class="font-semibold text-[13px] text-white truncate">
                    {{ $formateur->prenom }} {{ $formateur->nom }}
                </div>
                <div class="text-[11px] text-emerald-200/70 mt-0.5">
                    Formateur
                </div>
            </div>
            <form action="{{ route('formateur.logout') }}" method="POST"
                  class="sidebar-profile-text">
                @csrf
                <button class="w-9 h-9 rounded-lg flex items-center justify-center
                               text-emerald-200/70 hover:bg-white/10 hover:text-white transition"
                        title="Déconnexion">
                    <span class="material-symbols-rounded text-[20px]">logout</span>
                </button>
            </form>
        </div>
    </div>
</aside>

<div id="sidebar-overlay-formateur"
     class="fixed inset-0 bg-black/40 z-40 hidden lg:hidden"
     onclick="closeSidebarFormateur()"></div>

{{-- ============================================================
     CONTENU PRINCIPAL
     ============================================================ --}}
<div id="main-wrapper-formateur" class="main-wrapper-formateur min-h-screen flex flex-col">

    {{-- HEADER --}}
    <header class="sticky top-0 h-20 bg-white border-b border-slate-200
                   flex items-center justify-between px-6 lg:px-10 z-30
                   shadow-sm">

        <div class="flex items-center gap-6">
            <button class="lg:hidden w-10 h-10 rounded-xl flex items-center justify-center
                           text-slate-600 hover:bg-slate-100 transition"
                    onclick="toggleSidebarFormateur()">
                <span class="material-symbols-rounded text-[22px]">menu</span>
            </button>

            <div class="hidden sm:flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-brand-50 flex items-center justify-center">
                    <span class="material-symbols-rounded text-brand-700 text-[22px]"
                          style="font-variation-settings: 'FILL' 1;">school</span>
                </div>
                <div class="flex flex-col">
                    <span class="text-[11px] font-bold text-slate-400 uppercase tracking-widest leading-none">
                        ESPACE FORMATEUR
                    </span>
                    <span class="font-display font-bold text-slate-900 text-[16px] mt-1 leading-none">
                        @yield('title', 'Tableau de bord')
                    </span>
                </div>
            </div>
        </div>

        <div class="flex items-center gap-4">
            <div class="flex items-center gap-3 pl-1">
                <div class="hidden sm:flex flex-col items-end">
                    <span class="text-[13px] font-semibold text-slate-800 leading-none">
                        {{ $formateur->prenom }} {{ $formateur->nom }}
                    </span>
                    <span class="text-[11px] text-slate-500 mt-1 leading-none">
                        {{ $formateur->matricule ?? 'Formateur' }}
                    </span>
                </div>
                <div class="w-11 h-11 rounded-xl bg-gradient-to-br from-brand-500 to-brand-700
                            flex items-center justify-center
                            text-white font-bold text-[14px] shadow-sm
                            ring-2 ring-brand-100">
                    {{ $initials }}
                </div>
            </div>
        </div>
    </header>

    {{-- ZONE DE CONTENU - margin 20px + padding 20px --}}
    <div class="flex-1" style="margin: 20px; padding: 20px;">

        @yield('content')

    </div>
</div>

{{-- Tooltip global --}}
<div id="global-tooltip-formateur"></div>

<script>
    // ============================================
    // VERROUILLAGE SIDEBAR FORMATEUR
    // ============================================
    (function() {
        const sidebar = document.getElementById('sidebar-formateur');
        const mainWrapper = document.getElementById('main-wrapper-formateur');
        const lockIcon = document.getElementById('lock-icon-formateur');

        if (!sidebar || !mainWrapper) return;

        let lockState = localStorage.getItem('sidebarLockStateFormateur') || 'unlocked';

        function applyState() {
            sidebar.classList.remove('sidebar-locked', 'sidebar-locked-collapsed', 'sidebar-locked-expanded');
            mainWrapper.classList.remove('sidebar-expanded');

            if (lockState === 'locked-collapsed') {
                sidebar.classList.add('sidebar-locked', 'sidebar-locked-collapsed');
                lockIcon.textContent = 'lock';
            } else if (lockState === 'locked-expanded') {
                sidebar.classList.add('sidebar-locked', 'sidebar-locked-expanded');
                mainWrapper.classList.add('sidebar-expanded');
                lockIcon.textContent = 'lock';
            } else {
                lockIcon.textContent = 'lock_open';
            }
        }

        sidebar.addEventListener('mouseenter', () => {
            if (window.innerWidth >= 1024 && lockState === 'unlocked') {
                mainWrapper.classList.add('sidebar-expanded');
            }
        });
        sidebar.addEventListener('mouseleave', () => {
            if (window.innerWidth >= 1024 && lockState === 'unlocked') {
                mainWrapper.classList.remove('sidebar-expanded');
            }
        });

        window.toggleSidebarLockFormateur = function() {
            if (lockState === 'unlocked') {
                lockState = 'locked-collapsed';
            } else if (lockState === 'locked-collapsed') {
                lockState = 'locked-expanded';
            } else {
                lockState = 'unlocked';
            }
            localStorage.setItem('sidebarLockStateFormateur', lockState);
            applyState();
        };

        applyState();

        window.addEventListener('resize', () => {
            if (window.innerWidth < 1024) {
                mainWrapper.classList.remove('sidebar-expanded');
            } else if (lockState === 'locked-expanded') {
                mainWrapper.classList.add('sidebar-expanded');
            }
        });
    })();

    // ============================================
    // TOOLTIP GLOBAL FORMATEUR
    // ============================================
    (function() {
        const tooltip = document.getElementById('global-tooltip-formateur');
        const sidebar = document.getElementById('sidebar-formateur');

        if (!tooltip || !sidebar) return;

        const COLLAPSED_WIDTH = 150;

        function isSidebarCollapsed() {
            return sidebar.getBoundingClientRect().width < COLLAPSED_WIDTH;
        }

        function showTooltip(target) {
            if (!isSidebarCollapsed()) return;

            const text = target.getAttribute('data-tooltip');
            if (!text) return;

            tooltip.textContent = text;

            const rect = target.getBoundingClientRect();
            const tooltipLeft = rect.right + 14;
            const tooltipTop = rect.top + rect.height / 2;

            tooltip.style.left = tooltipLeft + 'px';
            tooltip.style.top = tooltipTop + 'px';
            tooltip.style.transform = 'translateY(-50%) translateX(-8px)';

            void tooltip.offsetWidth;

            tooltip.classList.add('visible');
            tooltip.style.transform = 'translateY(-50%) translateX(0)';
        }

        function hideTooltip() {
            tooltip.classList.remove('visible');
        }

        const links = sidebar.querySelectorAll('[data-tooltip]');
        links.forEach(link => {
            link.addEventListener('mouseenter', (e) => {
                setTimeout(() => showTooltip(e.currentTarget), 100);
            });
            link.addEventListener('mouseleave', hideTooltip);
        });

        document.addEventListener('click', hideTooltip);
    })();

    // ============================================
    // SIDEBAR MOBILE
    // ============================================
    function toggleSidebarFormateur() {
        document.getElementById('sidebar-formateur').classList.toggle('-translate-x-full');
        document.getElementById('sidebar-overlay-formateur').classList.toggle('hidden');
    }
    function closeSidebarFormateur() {
        document.getElementById('sidebar-formateur').classList.add('-translate-x-full');
        document.getElementById('sidebar-overlay-formateur').classList.add('hidden');
    }
</script>
@stack('scripts')
</body>
</html>
BLADE;
    }
}