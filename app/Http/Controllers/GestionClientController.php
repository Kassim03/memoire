<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use GuzzleHttp\Client as GuzzleHttpClient;

class GestionClientController extends Controller
{
    public function index()
    {
        $User = User::latest()->get();
        return view('Adminboard.Users.index', compact('users'));
    }

    public function show($id)
    {
        $client = User::findOrFail($id);
        return view('Adminboard.Users.show', compact('user'));
    }

    public function destroy($id)
    {
        $client = User::findOrFail($id);
        $client->delete();
        return redirect()->route('gestionclient')->with('success', 'Client supprimé.');
    }
}
