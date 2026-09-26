<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Infrastructure\Persistence\Eloquent\Models\AdminModel;

class UserController extends Controller
{
    /**
     * Liste des utilisateurs
     */
    public function index(Request $request)
    {
        $users = AdminModel::query()
            ->when($request->filled('search'), function ($q) use ($request) {
                $s = $request->search;
                $q->where(function ($qq) use ($s) {
                    $qq->where('nom', 'like', "%{$s}%")
                       ->orWhere('prenom', 'like', "%{$s}%")
                       ->orWhere('email', 'like', "%{$s}%");
                });
            })
            ->when($request->filled('role'), fn($q) => $q->where('role', $request->role))
            ->orderBy('nom')
            ->paginate(15)
            ->withQueryString();

        return view('admin.users.index', compact('users'));
    }

    /**
     * Formulaire de création (AJAX pour modal)
     */
    public function create()
    {
        if (request()->ajax() || request()->wantsJson()) {
            return response()->json([
                'html' => view('admin.users.partials.form')->render(),
            ]);
        }

        return view('admin.users.create');
    }

    /**
     * Enregistrer un nouvel utilisateur
     */
    public function store(StoreUserRequest $request)
    {
        $validated = $request->validated();
        $validated['password'] = Hash::make($validated['password']);

        AdminModel::create($validated);

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success'  => true,
                'message'  => 'Compte admin créé.',
                'redirect' => route('admin.users.index'),
            ]);
        }

        return redirect()->route('admin.users.index')
            ->with('success', 'Compte admin créé.');
    }

    /**
     * Afficher un utilisateur (AJAX pour modal show)
     */
    public function show(int $id)
    {
        $user = AdminModel::findOrFail($id);

        if (request()->ajax() || request()->wantsJson()) {
            return response()->json([
                'html' => view('admin.users.partials.show', compact('user'))->render(),
            ]);
        }

        return view('admin.users.show', compact('user'));
    }

    /**
     * Formulaire d'édition (AJAX pour modal)
     */
    public function edit(int $id)
    {
        $user = AdminModel::findOrFail($id);

        if (request()->ajax() || request()->wantsJson()) {
            return response()->json([
                'html' => view('admin.users.partials.form', compact('user'))->render(),
            ]);
        }

        return view('admin.users.edit', compact('user'));
    }

    /**
     * Mettre à jour un utilisateur
     */
    public function update(UpdateUserRequest $request, int $id)
    {
        $user = AdminModel::findOrFail($id);
        $validated = $request->validated();

        if (!empty($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        $user->update($validated);

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success'  => true,
                'message'  => 'Compte admin mis à jour.',
                'redirect' => route('admin.users.index'),
            ]);
        }

        return redirect()->route('admin.users.index')
            ->with('success', 'Compte admin mis à jour.');
    }

    /**
     * Supprimer un utilisateur (form classique, pas AJAX)
     */
    public function destroy(int $id)
    {
        $user = AdminModel::findOrFail($id);

        if (auth('admin')->id() === $user->id) {
            return back()->with('error', 'Vous ne pouvez pas supprimer votre propre compte.');
        }

        $user->delete();

        return redirect()->route('admin.users.index')
            ->with('success', 'Compte admin supprimé.');
    }
}