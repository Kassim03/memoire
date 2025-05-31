<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Emplacements;

class GestionEmplacementController extends Controller
{
    public function index()
    {
        $emplacements = Emplacements::latest()->get();
        return view('Adminboard.Emplacements.index', compact('emplacements'));
    }

    public function show($id)
    {
        $emplacement = Emplacements::findOrFail($id);
        return view('Adminboard.Emplacements.show', compact('emplacements'));
    }

    public function destroy($id)
    {
        $emplacement = Emplacements::findOrFail($id);
        $emplacement->delete();
        return redirect()->route('gestionemplacement')->with('success', 'Emplacement supprimé.');
    }
}
