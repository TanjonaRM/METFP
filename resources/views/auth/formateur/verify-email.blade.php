@extends('layouts.guest')
@section('title', 'Vérification Email')

@section('content')
<div class="w-full max-w-md bg-white/95 backdrop-blur-xl rounded-3xl shadow-[0_25px_60px_rgba(15,118,110,0.20)] ring-1 ring-emerald-100 p-10 animate-fade-up text-center lg:ml-[5%] xl:ml-[7%]">

    <div class="flex justify-center mb-6">
        <div class="w-[72px] h-[72px] rounded-2xl bg-linear-to-br from-emerald-600 to-teal-700 flex items-center justify-center shadow-[0_16px_30px_rgba(13,148,136,0.35)]">
            <span class="material-symbols-rounded text-white text-[40px]" style="font-variation-settings: 'FILL' 1;">mark_email_unread</span>
        </div>
    </div>

    <h1 class="font-display text-[26px] font-bold text-slate-900">Vérifiez votre email</h1>
    <p class="text-sm text-slate-500 mt-2">Nous vous avons envoyé un lien de vérification. Vérifiez votre boîte de réception.</p>

    @if (session('status') == 'verification-link-sent')
        <div class="mt-4 px-4 py-3 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-sm">
            Un nouveau lien a été envoyé !
        </div>
    @endif

    <form action="{{ route('formateur.verification.send') }}" method="POST" class="mt-6">
        @csrf
        <button type="submit" class="w-full flex items-center justify-center gap-2 px-6 py-3.5 rounded-xl bg-linear-to-br from-emerald-600 to-teal-700 text-white font-semibold text-sm shadow-[0_12px_25px_rgba(16,185,129,0.28)] hover:-translate-y-0.5 transition-all">
            Renvoyer l'email <span class="material-symbols-rounded text-[18px]">refresh</span>
        </button>
    </form>

    <form action="{{ route('logout') }}" method="POST" class="mt-3">
        @csrf
        <button type="submit" class="text-sm text-slate-500 hover:text-emerald-700 transition">Se déconnecter</button>
    </form>
</div>
@endsection