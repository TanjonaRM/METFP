<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Infrastructure\Persistence\Eloquent\Models\SecteurModel;

class SecteurController extends Controller
{
    public function index()
    {
        $secteurs = SecteurModel::withCount('filieres')->get();
        return view('admin.secteurs.index', compact('secteurs'));
    }

    public function create()
    {
        return view('admin.secteurs.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'code' => 'required|string|unique:secteurs,code',
            'libelle' => 'required|string',
        ]);

        SecteurModel::create($validated);

        return redirect()->route('admin.secteurs.index')->with('success', 'Secteur créé.');
    }

    public function show(int $id)
    {
        $secteur = SecteurModel::with('filieres')->findOrFail($id);
        return view('admin.secteurs.show', compact('secteur'));
    }

    public function edit(int $id)
    {
        $secteur = SecteurModel::findOrFail($id);
        return view('admin.secteurs.edit', compact('secteur'));
    }

    public function update(Request $request, int $id)
    {
        $secteur = SecteurModel::findOrFail($id);

        $validated = $request->validate([
            'code' => 'required|string|unique:secteurs,code,' . $id,
            'libelle' => 'required|string',
        ]);

        $secteur->update($validated);

        return redirect()->route('admin.secteurs.index')->with('success', 'Secteur mis à jour.');
    }

    public function destroy(int $id)
    {
        SecteurModel::findOrFail($id)->delete();
        return redirect()->route('admin.secteurs.index')->with('success', 'Secteur supprimé.');
    }
}