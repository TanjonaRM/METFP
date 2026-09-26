@extends('layouts.guest')
@section('title', 'Mot de passe oublié')

@section('content')
<div class="min-h-screen flex items-center justify-center p-6
            bg-gradient-to-br from-brand-700 via-brand-800 to-brand-900">

    <div class="w-full max-w-md bg-white rounded-2xl shadow-2xl p-10 animate-fade-up">

        <a href="{{ route('admin.login') }}"
           class="inline-flex items-center gap-1 text-[13px] text-slate-500
                  hover:text-brand-700 transition mb-6">
            <span class="material-symbols-rounded text-[18px]">arrow_back</span>
            Retour
        </a>

        <div class="flex flex-col items-center mb-8">
            <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-brand-500 to-brand-700
                        flex items-center justify-center shadow-lg mb-5">
                <span class="material-symbols-rounded text-white text-3xl"
                      style="font-variation-settings: 'FILL' 1;">lock_reset</span>
            </div>
            <h1 class="font-display text-2xl font-bold text-slate-900 text-center">
                Mot de passe oublié
            </h1>
            <p class="text-sm text-slate-500 text-center mt-1.5">
                Recevez un lien de réinitialisation par email
            </p>
        </div>

        @if (session('status'))
            <div class="flex items-start gap-2.5 px-4 py-3.5 rounded-lg mb-5
                        bg-brand-50 border border-brand-200 text-brand-800 text-sm">
                <span class="material-symbols-rounded text-[20px] shrink-0">check_circle</span>
                <div>{{ session('status') }}</div>
            </div>
        @endif

        @if ($errors->any())
            <div class="flex items-start gap-2.5 px-4 py-3.5 rounded-lg mb-5
                        bg-red-50 border border-red-200 text-red-800 text-sm">
                <span class="material-symbols-rounded text-[20px] shrink-0">error</span>
                <div>@foreach ($errors->all() as $error)<div>{{ $error }}</div>@endforeach</div>
            </div>
        @endif

        <form action="{{ route('admin.password.email') }}" method="POST" class="space-y-5">
            @csrf

            <div>
                <label class="form-label">Adresse email</label>
                <input type="email" name="email" value="{{ old('email') }}"
                       placeholder="admin@sgformateurs.mg" required autofocus
                       class="form-input">
            </div>

            <button type="submit" class="w-full btn-primary justify-center py-3">
                Envoyer le lien
                <span class="material-symbols-rounded text-[18px]">send</span>
            </button>
        </form>

    </div>
</div>
@endsection