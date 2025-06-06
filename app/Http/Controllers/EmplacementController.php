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
        return view('adminboard', compact('emplacements'));
    }

    // Affiche le formulaire de création
    public function create()
    {
        return view('emplacements.create');
    }

    // Enregistre un nouvel emplacement
    public function store(Request $request)
{
    try {
        // 1. Validation
        $validatedData = $request->validate([
            'type' => 'required|in:salles   ,espace',
            'nom' => 'required|string|max:255',
            'description' => 'required|string',
            'tarif_hr' => 'required|numeric|min:0',
            'capacites' => 'required|integer|min:1',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // 2. Traitement de l'upload d'image
        $imagePath = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('assets');

            // Crée le dossier s'il n'existe pas
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            $image->move($destinationPath, $imageName);
            $imagePath = $imageName;
        }

        // 3. Création du modèle Emplacement
        Emplacements::create([
            'type' => $validatedData['type'],
            'nom' => $validatedData['nom'],
            'description' => $validatedData['description'],
            'tarif_hr' => $validatedData['tarif_hr'],
            'capacites' => $validatedData['capacites'],
            'image' => $imagePath,
        ]);

        // 4. Redirection avec message de succès
        return redirect()->route('adminboard')->with('success', 'Emplacement créé avec succès.');

    } catch (\Exception $e) {
        // 5. En cas d'erreur, on redirige avec un message d'erreur
        return back()->withInput()->with('error', 'Erreur lors de l’enregistrement : ' . $e->getMessage());
    }
}



    // Affiche le formulaire d'édition
    // Formulaire de modification

    public function edit($id)
    {
        $emplacement = Emplacements::findOrFail($id);
        return view('emplacements.edit', compact('emplacement'));
    }


    // Mise à jour des données
    public function update(Request $request, $id)
{
    try {
        $emplacement = Emplacements::findOrFail($id);

        // Validation
        $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'nullable|string',
            'type' => 'required|in:salles,espace',
            'capacites' => 'nullable|integer|min:1',
            'tarif_hr' => 'nullable|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Mise à jour des champs
        $emplacement->nom = $request->nom;
        $emplacement->description = $request->description;
        $emplacement->type = $request->type;
        $emplacement->capacites = $request->capacites;
        $emplacement->tarif_hr = $request->tarif_hr;

        // Si une nouvelle image est uploadée
        if ($request->hasFile('image')) {
            // Supprimer l'ancienne si elle existe
            if ($emplacement->image && file_exists(public_path('assets/' . $emplacement->image))) {
                unlink(public_path('assets/' . $emplacement->image));
            }

            // Enregistrer la nouvelle image
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('assets'), $imageName);
            $emplacement->image = $imageName;
        }

        $emplacement->save();

        return redirect("/adminboard");

    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'Une erreur est survenue : ' . $e->getMessage());
    }
}


    // Suppression
    public function destroy($id)
    {
        $emplacement = Emplacements::findOrFail($id);
        $emplacement->delete();
        return redirect()->back()->with('success', 'Emplacement supprimé.');
    }
}
