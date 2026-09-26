<?php

namespace App\Http\Controllers\Formateur;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Infrastructure\Persistence\Eloquent\Models\FormateurModel;

class ProfileController extends Controller
{
    public function edit()
    {
        $user = Auth::guard('formateur')->user();
        
        // Récupérer le formateur depuis la table formateurs (pas formateurs_users)
        $formateur = FormateurModel::where('matricule', $user->matricule)->firstOrFail();
        
        return view('formateur.profile.edit', compact('formateur', 'user'));
    }

    public function update(Request $request)
    {
        $user = Auth::guard('formateur')->user();
        $formateur = FormateurModel::where('matricule', $user->matricule)->firstOrFail();

        // [!]️ IMPORTANT : 'statut' N'EST PAS dans les champs modifiables
        $validated = $request->validate([
            'nom'       => 'required|string|max:100',
            'prenom'    => 'required|string|max:100',
            'email'     => 'required|email|unique:formateurs,email,' . $formateur->id,
            'telephone' => 'nullable|string|max:20',
            'adresse'   => 'nullable|string|max:255',
        ]);

        // [!]️ Sécurité : ne JAMAIS accepter 'statut' même si envoyé manuellement
        unset($validated['statut']);

        $formateur->update($validated);

        // Mettre à jour aussi formateurs_users si nécessaire
        $user->update([
            'nom'       => $validated['nom'],
            'prenom'    => $validated['prenom'],
            'email'     => $validated['email'],
            'telephone' => $validated['telephone'] ?? null,
        ]);

        return back()->with('success', 'Profil mis à jour.');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password'         => 'required|min:8|confirmed',
        ]);

        $formateur = Auth::guard('formateur')->user();

        if (!Hash::check($request->current_password, $formateur->password)) {
            return back()->withErrors(['current_password' => 'Mot de passe actuel incorrect.']);
        }

        $formateur->update(['password' => $request->password]);

        return back()->with('success', 'Mot de passe modifié.');
    }
}