@extends('layouts.guest')
@section('title', 'Vérification Email')

@section('content')
<div class="w-full max-w-md bg-white/95 backdrop-blur-xl rounded-3xl shadow-2xl ring-1 ring-white/20 p-10 animate-fade-up text-center">

    <div class="flex justify-center mb-6">
        <div class="w-[72px] h-[72px] rounded-2xl bg-linear-to-br from-primary-500 to-primary-700 flex items-center justify-center shadow-primary-lg">
            <span class="material-symbols-rounded text-white text-[40px]" style="font-variation-settings: 'FILL' 1;">mark_email_unread</span>
        </div>
    </div>

    <h1 class="font-display text-[26px] font-bold text-slate-900">Vérifiez votre email</h1>
    <p class="text-sm text-slate-500 mt-2">Nous vous avons envoyé un lien de vérification. Vérifiez votre boîte de réception.</p>

    @if (session('status') == 'verification-link-sent')
        <div class="mt-4 px-4 py-3 rounded-xl bg-primary-50 border border-primary-200 text-primary-800 text-sm">
            Un nouveau lien a été envoyé !
        </div>
    @endif

    <form action="{{ route('admin.verification.send') }}" method="POST" class="mt-6">
        @csrf
        <button type="submit" class="w-full flex items-center justify-center gap-2 px-6 py-3.5 rounded-xl bg-linear-to-br from-primary-500 to-primary-700 text-white font-semibold text-sm shadow-primary hover:-translate-y-0.5 transition-all">
            Renvoyer l'email <span class="material-symbols-rounded text-[18px]">refresh</span>
        </button>
    </form>

    <form action="{{ route('logout') }}" method="POST" class="mt-3">
        @csrf
        <button type="submit" class="text-sm text-slate-500 hover:text-primary-700 transition">Se déconnecter</button>
    </form>
</div>
@endsection