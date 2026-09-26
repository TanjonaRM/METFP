<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Infrastructure\Persistence\Eloquent\Models\NiveauModel;

class NiveauController extends Controller
{
    public function index()
    {
        $niveaux = NiveauModel::withCount('filieres')->get();
        return view('admin.niveaux.index', compact('niveaux'));
    }

    public function create()
    {
        return view('admin.niveaux.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'code' => 'required|string|unique:niveaux,code',
            'libelle' => 'required|string',
            'description' => 'nullable|string',
        ]);

        NiveauModel::create($validated);

        return redirect()->route('admin.niveaux.index')->with('success', 'Niveau créé.');
    }

    public function show(int $id)
    {
        $niveau = NiveauModel::with('filieres')->findOrFail($id);
        return view('admin.niveaux.show', compact('niveau'));
    }

    public function edit(int $id)
    {
        $niveau = NiveauModel::findOrFail($id);
        return view('admin.niveaux.edit', compact('niveau'));
    }

    public function update(Request $request, int $id)
    {
        $niveau = NiveauModel::findOrFail($id);

        $validated = $request->validate([
            'code' => 'required|string|unique:niveaux,code,' . $id,
            'libelle' => 'required|string',
            'description' => 'nullable|string',
        ]);

        $niveau->update($validated);

        return redirect()->route('admin.niveaux.index')->with('success', 'Niveau mis à jour.');
    }

    public function destroy(int $id)
    {
        NiveauModel::findOrFail($id)->delete();
        return redirect()->route('admin.niveaux.index')->with('success', 'Niveau supprimé.');
    }
}