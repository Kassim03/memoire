<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Emplacements;





class EmplacementController extends Controller
{
    // Affiche la liste des emplacements
    public function index()
    {
        $emplacements = Emplacements::all();
        return view('emplacements.index', compact('emplacements'));
    }

    // Affiche le formulaire de création
    public function create()
    {
        return view('emplacements.create');
        


    }

    // Enregistre un nouvel emplacement
    public function store(Request $request)
{
    // Validation
    $request->validate([
        'type' => 'required|in:Salle,Espace',
        'nom' => 'required|string|max:255',
        'description' => 'required|string',
        'tarif_hr' => 'required|numeric|min:0',
        'capacite' => 'required|integer|min:1',
        'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // max 2MB
    ]);

    // Upload image
    if ($request->hasFile('image')) {
    $image = $request->file('image');
    $imageName = time() . '.' . $image->getClientOriginalExtension();
    $destinationPath = public_path('assets'); // le chemin physique vers public/assets

    // Déplace le fichier vers le dossier public/assets
    $image->move($destinationPath, $imageName);

    // Le chemin à stocker dans la base de données
    $imagePath = 'assets/' . $imageName;
}


    // Création du modèle Emplacement
    Emplacements::create([
        'type' => $request->input('type'),
        'nom' => $request->input('nom'),
        'description' => $request->input('description'),
        'tarif_hr' => $request->input('tarif_hr'),
        'capacite' => $request->input('capacite'),
        'image' => $imagePath,
    ]);

    return redirect()->route('emplacements.index')->with('success', 'Emplacement créé avec succès.');
}



    // Affiche le formulaire d'édition
    // Formulaire de modification

public function edit($id)
{
    $emplacement = Emplacements::findOrFail($id);
    return view('emplacements.edit', compact('emplacement'));
}


// Mise à jour des données
public function update(Request $request, $id) {
    $emplacement = Emplacements::findOrFail($id);

    // Validation + mise à jour ici
    $emplacement->nom = $request->nom;
    // ...

    $emplacement->save();
    return redirect()->back()->with('success', 'Emplacement mis à jour.');
}

// Suppression
public function destroy($id) {
    $emplacement = Emplacements::findOrFail($id);
    $emplacement->delete();
    return redirect()->back()->with('success', 'Emplacement supprimé.');
}


    
}
