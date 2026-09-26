<?php

namespace App\Http\Controllers\Auth\Formateur;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{
    public function logout(Request $request)
    {
        Auth::guard('formateur')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('formateur.login')
            ->with('success', 'Vous avez été déconnecté.');
    }
}