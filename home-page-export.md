# Export — Page d'accueil (`/`)

**URL concernée :** `http://localhost:8000/`

Généré le : 2026-09-20 09:16:15

## 📋 Fichiers inclus

- ✅ `public/index.php` — Point d'entrée de l'application
- ✅ `routes/web.php` — Route "/" qui pointe vers welcome
- ✅ `resources/views/welcome.blade.php` — Contenu HTML de la page d'accueil
- ✅ `resources/views/layouts/guest.blade.php` — Layout utilisé par welcome
- ✅ `resources/css/app.css` — Styles Tailwind v4 (thème vert)

---

## public/index.php

> Point d'entrée de l'application

```php
<?php

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// Determine if the application is in maintenance mode...
if (file_exists($maintenance = __DIR__.'/../storage/framework/maintenance.php')) {
    require $maintenance;
}

// Register the Composer autoloader...
require __DIR__.'/../vendor/autoload.php';

// Bootstrap Laravel and handle the request...
/** @var Application $app */
$app = require_once __DIR__.'/../bootstrap/app.php';

$app->handleRequest(Request::capture());
```

## routes/web.php

> Route "/" qui pointe vers welcome

```php
<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');
```

## resources/views/welcome.blade.php

> Contenu HTML de la page d'accueil

```blade
@extends('layouts.guest')

@section('title', 'Bienvenue')

@section('content')

{{-- ============ HEADER VISITEUR ============ --}}
<nav class="bg-white border-b border-slate-200 px-6 lg:px-12 h-16
            flex items-center justify-between sticky top-0 z-40">
    <a href="{{ route('home') }}" class="flex items-center gap-3 no-underline">
        <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-brand-500 to-brand-700
                    flex items-center justify-center">
            <span class="material-symbols-rounded text-white text-xl"
                  style="font-variation-settings: 'FILL' 1;">school</span>
        </div>
        <div class="flex flex-col leading-tight">
            <span class="font-display font-bold text-slate-900 text-sm">SGFORMATEURS</span>
            <span class="text-[10px] text-slate-500">Gestion des Formateurs</span>
        </div>
    </a>

    <div class="hidden md:flex items-center gap-6">
        <a href="#accueil" class="text-sm text-slate-600 hover:text-brand-700">Accueil</a>
        <a href="#a-propos" class="text-sm text-slate-600 hover:text-brand-700">À propos</a>
        <a href="#contact" class="text-sm text-slate-600 hover:text-brand-700">Contact</a>
    </div>

    <a href="{{ route('admin.login') }}" class="btn-primary btn-sm">Se connecter</a>
</nav>

{{-- ============ HERO ============ --}}
<section id="accueil" class="relative overflow-hidden">
    <div class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-2 gap-8 items-center px-6 lg:px-12 py-16">

        <div>
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full
                        bg-brand-50 border border-brand-200 mb-4">
                <span class="w-2 h-2 rounded-full bg-brand-500"></span>
                <span class="text-xs font-semibold text-brand-700">Nouveau</span>
            </div>

            <h1 class="font-display text-4xl lg:text-5xl font-bold text-slate-900 leading-tight">
                SGFORMATEURS
            </h1>
            <p class="text-xl text-slate-700 font-medium mt-4">
                Un outil au service du METFP
            </p>
            <p class="text-slate-500 mt-4 leading-relaxed">
                Centralisez, suivez et gérez tous les formateurs des centres de métiers
                et établissements de formation.
            </p>

            <div class="flex flex-wrap gap-3 mt-8">
                <a href="{{ route('admin.login') }}" class="btn-primary">
                    <span class="material-symbols-rounded text-[18px]">login</span>
                    Se connecter
                </a>
                <a href="#a-propos" class="btn-outline-primary">
                    En savoir plus
                </a>
            </div>
        </div>

        <div class="relative">
            <img src="https://images.unsplash.com/photo-1562774053-701939374585?w=800"
                 alt="Établissement"
                 class="rounded-2xl shadow-xl w-full h-96 object-cover">
        </div>
    </div>
</section>

{{-- ============ À PROPOS ============ --}}
<section id="a-propos" class="bg-white py-16 px-6 lg:px-12">
    <div class="max-w-7xl mx-auto">
        <div class="text-center mb-12">
            <h2 class="font-display text-3xl font-bold text-slate-900">À propos</h2>
            <p class="text-slate-500 mt-3">Une plateforme complète pour la gestion des formateurs</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-slate-50 rounded-2xl p-6 border border-slate-100">
                <div class="w-12 h-12 rounded-lg bg-brand-100 flex items-center justify-center mb-4">
                    <span class="material-symbols-rounded text-brand-700 text-2xl">groups</span>
                </div>
                <h3 class="font-display font-bold text-slate-900 mb-2">Gestion des formateurs</h3>
                <p class="text-sm text-slate-600">
                    Centralisez les informations de tous les formateurs du réseau.
                </p>
            </div>

            <div class="bg-slate-50 rounded-2xl p-6 border border-slate-100">
                <div class="w-12 h-12 rounded-lg bg-brand-100 flex items-center justify-center mb-4">
                    <span class="material-symbols-rounded text-brand-700 text-2xl">assignment_ind</span>
                </div>
                <h3 class="font-display font-bold text-slate-900 mb-2">Suivi des affectations</h3>
                <p class="text-sm text-slate-600">
                    Gérez les affectations par filière et établissement.
                </p>
            </div>

            <div class="bg-slate-50 rounded-2xl p-6 border border-slate-100">
                <div class="w-12 h-12 rounded-lg bg-brand-100 flex items-center justify-center mb-4">
                    <span class="material-symbols-rounded text-brand-700 text-2xl">description</span>
                </div>
                <h3 class="font-display font-bold text-slate-900 mb-2">Rapports et statistiques</h3>
                <p class="text-sm text-slate-600">
                    Générez des rapports PDF et consultez les statistiques en temps réel.
                </p>
            </div>
        </div>
    </div>
</section>

{{-- ============ CONTACT / CTA ============ --}}
<section id="contact" class="py-16 px-6 lg:px-12">
    <div class="max-w-4xl mx-auto bg-gradient-to-br from-brand-700 to-brand-900
                rounded-3xl p-12 text-center text-white shadow-2xl">
        <h2 class="font-display text-3xl font-bold">Prêt à commencer ?</h2>
        <p class="text-emerald-100 mt-3">Accédez à votre espace dès maintenant</p>
        <div class="flex justify-center gap-3 mt-8">
            <a href="{{ route('admin.login') }}"
               class="inline-flex items-center gap-2 px-6 py-3 rounded-xl
                      bg-white text-brand-800 font-semibold text-sm
                      hover:bg-slate-100 transition-all">
                <span class="material-symbols-rounded text-[18px]">login</span>
                Espace Admin
            </a>
            <a href="{{ route('formateur.login') }}"
               class="inline-flex items-center gap-2 px-6 py-3 rounded-xl
                      border-2 border-white text-white font-semibold text-sm
                      hover:bg-white hover:text-brand-800 transition-all">
                <span class="material-symbols-rounded text-[18px]">school</span>
                Espace Formateur
            </a>
        </div>
    </div>
</section>

{{-- ============ FOOTER ============ --}}
<footer class="bg-slate-900 text-slate-400 py-8 px-6 lg:px-12">
    <div class="max-w-7xl mx-auto flex flex-col md:flex-row items-center justify-between gap-4">
        <div class="flex items-center gap-3">
            <div class="w-8 h-8 rounded-lg bg-white/10 flex items-center justify-center">
                <span class="material-symbols-rounded text-white text-lg">school</span>
            </div>
            <span class="font-display font-bold text-white text-sm">SGFORMATEURS</span>
        </div>
        <p class="text-xs">© {{ date('Y') }} SGFORMATEURS — Tous droits réservés</p>
    </div>
</footer>

@endsection
```

## resources/views/layouts/guest.blade.php

> Layout utilisé par welcome

```blade
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Connexion') — SGFORMATEURS</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&family=Space+Grotesk:wght@400..700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" rel="stylesheet">
    <style>
        @keyframes pulse-slow { 0%,100% { transform: translateY(0); } 50% { transform: translateY(-6px); } }
        .animate-pulse-slow { animation: pulse-slow 3s ease-in-out infinite; }
    </style>
</head>
<body class="font-sans min-h-screen flex items-center justify-center p-6 relative overflow-hidden bg-slate-950">
    <div class="fixed inset-0 z-0 bg-linear-to-br from-primary-900 via-primary-800 to-primary-700"></div>
    <div class="fixed inset-0 z-0 opacity-30" style="background-image: radial-gradient(circle at 20% 30%, rgba(16, 185, 129, 0.4) 0%, transparent 40%), radial-gradient(circle at 80% 70%, rgba(245, 158, 11, 0.2) 0%, transparent 40%);"></div>
    <div class="fixed inset-0 z-0 opacity-[0.03]" style="background-image: linear-gradient(rgba(255,255,255,0.5) 1px, transparent 1px), linear-gradient(90deg, rgba(255,255,255,0.5) 1px, transparent 1px); background-size: 50px 50px;"></div>
    <div class="relative z-10 w-full flex items-center justify-center">
        @yield('content')
    </div>
</body>
</html>
```

## resources/css/app.css

> Styles Tailwind v4 (thème vert)

```css
@import "tailwindcss";

/* =========================================================
   THÈME SGFORMATEURS — VERT ÉMERAUDE
   Couleur principale : vert (aucun bleu)
========================================================= */

@theme {
    --font-sans: 'Inter', ui-sans-serif, system-ui, sans-serif;
    --font-display: 'Space Grotesk', ui-sans-serif, system-ui, sans-serif;

    /* Vert émeraude principal */
    --color-brand-50:  #ecfdf5;
    --color-brand-100: #d1fae5;
    --color-brand-200: #a7f3d0;
    --color-brand-300: #6ee7b7;
    --color-brand-400: #34d399;
    --color-brand-500: #10b981;
    --color-brand-600: #059669;
    --color-brand-700: #047857;
    --color-brand-800: #065f46;
    --color-brand-900: #064e3b;   /* sidebar */
    --color-brand-950: #022c22;

    /* Couleurs secondaires (remplacent l'ancien bleu) */
    --color-accent-50:  #f0fdfa;
    --color-accent-100: #ccfbf1;
    --color-accent-500: #14b8a6;
    --color-accent-600: #0d9488;
    --color-accent-700: #0f766e;
}

/* =========================================================
   BASE
========================================================= */

@layer base {
    * { box-sizing: border-box; }
    html { scroll-behavior: smooth; }

    body {
        @apply font-sans bg-slate-50 text-slate-900 antialiased;
    }

    ::-webkit-scrollbar { @apply w-1.5 h-1.5; }
    ::-webkit-scrollbar-thumb { @apply bg-brand-500 rounded-full; }
    ::-webkit-scrollbar-track { @apply bg-slate-100; }

    .material-symbols-rounded {
        font-size: 20px;
        line-height: 1;
        vertical-align: middle;
        font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
    }
}

/* =========================================================
   COMPOSANTS
   NB : Tailwind v4 n'autorise pas `@apply` sur une classe
   personnalisée. Les styles de base sont donc partagés
   via une liste de sélecteurs.
========================================================= */

@layer components {

    /* ---------- BOUTONS ---------- */
    .btn,
    .btn-primary,
    .btn-outline-primary,
    .btn-secondary,
    .btn-danger,
    .btn-ghost {
        @apply inline-flex items-center justify-center gap-2
               px-5 py-2.5 rounded-lg font-semibold text-sm
               transition-all duration-200 cursor-pointer
               focus:outline-none focus:ring-4;
    }
    .btn-primary {
        @apply bg-brand-600 text-white shadow-sm
               hover:bg-brand-700 hover:-translate-y-0.5
               hover:shadow-md focus:ring-brand-100;
    }
    .btn-outline-primary {
        @apply border border-brand-600 text-brand-700 bg-transparent
               hover:bg-brand-600 hover:text-white focus:ring-brand-100;
    }
    .btn-secondary {
        @apply bg-slate-100 text-slate-700
               hover:bg-slate-200 focus:ring-slate-100;
    }
    .btn-danger {
        @apply bg-red-600 text-white
               hover:bg-red-700 focus:ring-red-100;
    }
    .btn-ghost {
        @apply bg-transparent text-slate-500
               hover:bg-slate-100 hover:text-slate-800;
    }
    .btn-sm { @apply px-3.5 py-2 text-xs; }

    /* ---------- SIDEBAR ---------- */
    .sidebar-item,
    .sidebar-item-active,
    .sidebar-item-inactive {
        @apply flex items-center gap-3 px-3 py-2.5 rounded-lg
               text-sm font-medium transition-all duration-150;
    }
    .sidebar-item-active {
        @apply bg-white/10 text-white;
    }
    .sidebar-item-inactive {
        @apply text-emerald-100/70
               hover:bg-white/5 hover:text-white;
    }

    /* ---------- CARTES STATS ---------- */
    .stat-card {
        @apply bg-white rounded-xl border border-slate-200 p-5
               flex items-start gap-4 transition-all hover:shadow-md;
    }
    .stat-icon {
        @apply w-12 h-12 rounded-lg flex items-center justify-center shrink-0;
    }
    .stat-value {
        @apply font-display text-2xl font-bold text-slate-900 leading-none;
    }
    .stat-label {
        @apply text-xs text-slate-500 mt-1;
    }
    .stat-trend-up {
        @apply text-xs font-semibold text-emerald-600;
    }

    /* ---------- FORMULAIRES ---------- */
    .form-label {
        @apply block text-[13px] font-semibold text-slate-700 mb-1.5;
    }
    .form-input,
    .form-select,
    .form-textarea {
        @apply w-full px-3.5 py-2.5 rounded-lg
               border border-slate-200 bg-white
               text-sm text-slate-900 placeholder:text-slate-400
               focus:border-brand-500 focus:ring-2 focus:ring-brand-100
               focus:outline-none transition-all;
    }
    .form-error {
        @apply text-xs text-red-600 mt-1;
    }

    /* ---------- TABLEAU ---------- */
    .table-modern { @apply w-full text-sm; }
    .table-modern thead {
        @apply bg-slate-50 border-b border-slate-200;
    }
    .table-modern thead th {
        @apply px-4 py-3 text-left text-[11px] font-bold
               text-slate-500 uppercase tracking-wider;
    }
    .table-modern tbody tr {
        @apply border-b border-slate-100 hover:bg-brand-50/40 transition;
    }
    .table-modern tbody td {
        @apply px-4 py-3 text-slate-700;
    }

    /* ---------- BADGES ---------- */
    .badge,
    .badge-success,
    .badge-danger,
    .badge-warning,
    .badge-info,
    .badge-gray {
        @apply inline-flex items-center gap-1 px-2.5 py-0.5
               rounded-full text-[11px] font-semibold;
    }
    .badge-success { @apply bg-emerald-100 text-emerald-700; }
    .badge-danger  { @apply bg-red-100 text-red-700; }
    .badge-warning { @apply bg-amber-100 text-amber-700; }
    .badge-info    { @apply bg-teal-100 text-teal-700; }
    .badge-gray    { @apply bg-slate-100 text-slate-600; }

    /* ---------- CARTES ---------- */
    .card {
        @apply bg-white rounded-xl border border-slate-200;
    }
    .card-header {
        @apply px-5 py-4 border-b border-slate-100
               flex items-center justify-between;
    }
    .card-title {
        @apply font-display font-semibold text-slate-900;
    }
    .card-body { @apply p-5; }

    /* ---------- AVATAR ---------- */
    .avatar,
    .avatar-sm,
    .avatar-md,
    .avatar-lg {
        @apply rounded-full flex items-center justify-center
               font-bold text-white shrink-0;
    }
    .avatar-sm { @apply w-8 h-8 text-[10px]; }
    .avatar-md { @apply w-10 h-10 text-xs; }
    .avatar-lg { @apply w-16 h-16 text-lg; }
    .avatar-primary { @apply bg-gradient-to-br from-brand-500 to-brand-700; }

    /* ---------- LIENS / PAGINATION ---------- */
    .link-primary {
        @apply text-brand-700 font-medium hover:text-brand-800
               hover:underline transition;
    }
}

/* =========================================================
   SURCHARGE PAGINATION LARAVEL (retire tout reste de bleu)
========================================================= */

.pagination .active span,
[aria-current="page"] span {
    background-color: var(--color-brand-600) !important;
    border-color: var(--color-brand-600) !important;
    color: #fff !important;
}

/* =========================================================
   UTILITAIRES
========================================================= */

@layer utilities {
    @keyframes fadeUp {
        from { opacity: 0; transform: translateY(15px); }
        to   { opacity: 1; transform: translateY(0); }
    }
    @keyframes slideIn {
        from { opacity: 0; transform: translateX(-10px); }
        to   { opacity: 1; transform: translateX(0); }
    }
    @keyframes pulseSlow {
        0%, 100% { transform: translateY(0); }
        50%      { transform: translateY(-6px); }
    }
    .animate-fade-up { animation: fadeUp 0.5s ease-out; }
    .animate-slide-in { animation: slideIn 0.3s ease-out; }
    .animate-pulse-slow { animation: pulseSlow 3s ease-in-out infinite; }
}
```

---

## 🔗 Chaîne d'exécution

```
Navigateur → http://localhost:8000/
         ↓
   public/index.php              (point d'entrée PHP)
         ↓
   bootstrap/app.php             (charge routes/web.php)
         ↓
   routes/web.php ⭐            (route '/' → view('welcome'))
         ↓
   resources/views/welcome.blade.php
         ↓
   resources/views/layouts/guest.blade.php
         ↓
   resources/css/app.css         (styles Tailwind v4)
```
