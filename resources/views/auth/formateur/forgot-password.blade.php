@extends('layouts.guest')
@section('title', 'Mot de passe oublié')

@section('content')
<div class="w-full max-w-md bg-white/95 backdrop-blur-xl rounded-3xl shadow-[0_25px_60px_rgba(15,118,110,0.20)] ring-1 ring-emerald-100 p-10 animate-fade-up lg:ml-[5%] lg:mt-4 xl:ml-[7%]">

    <a href="{{ route('formateur.login') }}" class="inline-flex items-center gap-1 text-[13px] text-slate-500 hover:text-emerald-700 transition mb-6">
        <span class="material-symbols-rounded text-[18px]">arrow_back</span>Retour
    </a>

    <div class="flex flex-col items-center mb-8">
        <div class="w-[72px] h-[72px] rounded-2xl bg-linear-to-br from-emerald-600 to-teal-700 flex items-center justify-center shadow-[0_16px_30px_rgba(13,148,136,0.35)] mb-5">
            <span class="material-symbols-rounded text-white text-[40px]" style="font-variation-settings: 'FILL' 1;">lock_reset</span>
        </div>
        <h1 class="font-display text-[26px] font-bold text-slate-900 text-center">
            <span class="bg-linear-to-br from-emerald-600 to-teal-700 bg-clip-text text-transparent">Mot de passe</span> oublié
        </h1>
        <p class="text-sm text-slate-500 text-center mt-1.5">Recevez un lien de réinitialisation par email</p>
    </div>

    @if (session('status'))
        <div class="flex items-start gap-2.5 px-4 py-3.5 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-sm mb-5">
            <span class="material-symbols-rounded text-[20px] shrink-0">check_circle</span>
            <div>{{ session('status') }}</div>
        </div>
    @endif
    @if ($errors->any())
        <div class="flex items-start gap-2.5 px-4 py-3.5 rounded-xl bg-red-50 border border-red-200 text-red-800 text-sm mb-5">
            <span class="material-symbols-rounded text-[20px] shrink-0">error</span>
            <div>@foreach ($errors->all() as $error)<div>{{ $error }}</div>@endforeach</div>
        </div>
    @endif

    <form action="{{ route('formateur.password.email') }}" method="POST" class="space-y-5">
        @csrf
        <div>
            <label class="block text-[13px] font-semibold text-slate-700 mb-2">Adresse email</label>
            <input type="email" name="email" value="{{ old('email') }}" placeholder="votre.email@exemple.com" required autofocus
                   class="w-full px-4 py-3.5 rounded-xl border-[1.5px] border-slate-200 bg-slate-50 text-sm outline-none transition-all focus:border-emerald-500 focus:bg-white focus:ring-4 focus:ring-emerald-100">
        </div>
        <button type="submit" class="w-full flex items-center justify-center gap-2 px-6 py-3.5 rounded-xl bg-linear-to-br from-emerald-600 to-teal-700 text-white font-semibold text-sm shadow-[0_12px_25px_rgba(16,185,129,0.28)] hover:-translate-y-0.5 transition-all">
            Envoyer le lien <span class="material-symbols-rounded text-[18px]">send</span>
        </button>
    </form>
</div>
@endsection