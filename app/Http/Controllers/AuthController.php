<?php
// app/Http/Controllers/AuthController.php

namespace App\Http\Controllers;

use App\Models\User; // Make sure this is imported
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Log;
use App\Models\Emplacements;

class AuthController extends Controller
{
    public function showRegister()
    {
        return view('home.register');
    }

    public function register(Request $request)
    {
        try {
            // Validation
            $request->validate([
                'prenom'     => 'required|max:100',
                'nom'        => 'required|max:100',
                'email'      => 'required|email|max:255|unique:users,email', // Added unique validation here too
                'telephone'  => 'required|max:200',
                'password'   => 'required|confirmed|min:6',
            ]);

            // No need for User::where('email', $request->email)->exists() check here
            // because `unique:users,email` validation rule handles it.

            // Création de l'utilisateur
            User::create([
                'name'      => $request->nom,
                'surname'   => $request->prenom,
                'telephone' => $request->telephone,
                'email'     => $request->email,
                'password'  => Hash::make($request->password),
            ]);

            Alert::success('Succès', 'Inscription réussie !');
            return redirect()->route('login');
        } catch (\Exception $e) {
            // Check if it's a validation exception (often handled by Laravel automatically)
            if ($e instanceof \Illuminate\Validation\ValidationException) {
                Alert::error('Erreur de validation', $e->getMessage())->persistent(true);
            } else {
                Alert::error('Erreur', 'Une erreur est survenue : ' . $e->getMessage());
                Log::error('Registration Error: ' . $e->getMessage(), ['exception' => $e]);
            }
            return back()->withInput();
        }
    }


    public function showLogin()
    {
        return view('home/login');
    }

    public function login(Request $request)
    {
        try {
            $credentials = $request->only('email', 'password');

            if (Auth::attempt($credentials)) {
                Alert::success('Bienvenue', 'Connexion réussie !');

                $user = Auth::user();

                if ($user->role === 'admin') {
                    return redirect()->route('adminboard');
                } else {
                    return redirect()->route('dashboard');
                }
            }

            Alert::error('Erreur', 'Identifiants incorrects.');
            return back()->withInput($request->except('password'));
        } catch (\Exception $e) {
            Log::error('Erreur lors de la tentative de connexion : ' . $e->getMessage());
            Alert::error('Erreur système', 'Une erreur est survenue. Veuillez réessayer plus tard.');
            return back()->withInput($request->except('password'));
        }
    }


    public function updateProfil(Request $request)
    {
        /** @var \App\Models\User|null $user */ // Aide Intelephense à comprendre le type de $user
        $user = Auth::user();

        // Si aucun utilisateur n'est authentifié, rediriger vers la page de connexion.
        if (!$user) {
            Alert::error('Erreur d\'Authentification', 'Vous devez être connecté pour modifier votre profil.')->persistent(true);
            return redirect()->route('login');
        }

        // Règles de validation de base pour les informations du profil.
        $rules = [
            'firstName' => 'required|string|max:100',
            'lastName' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email,' . $user->id, // L'email doit être unique sauf pour l'utilisateur actuel
            'phone' => 'nullable|string|max:20', // 'nullable' si le champ peut être vide
        ];

        // Ajouter des règles de validation pour le mot de passe seulement si un nouveau mot de passe est fourni.
        if ($request->filled('new_password')) {
            $rules['password'] = 'required|string'; // L'ancien mot de passe est requis pour la confirmation
            $rules['new_password'] = 'required|string|min:8|confirmed'; // 'confirmed' vérifie la correspondance avec 'new_password_confirmation'
        }

        // Exécuter la validation avec des messages personnalisés.
        $validatedData = $request->validate($rules, [
            'firstName.required' => 'Le prénom est obligatoire.',
            'lastName.required' => 'Le nom est obligatoire.',
            'email.required' => 'L\'adresse e-mail est obligatoire.',
            'email.email' => 'Veuillez saisir une adresse e-mail valide.',
            'email.unique' => 'Cette adresse e-mail est déjà utilisée par un autre compte.',
            'new_password.required' => 'Le nouveau mot de passe est obligatoire si vous souhaitez le changer.',
            'new_password.min' => 'Le nouveau mot de passe doit contenir au moins 8 caractères.',
            'new_password.confirmed' => 'Le nouveau mot de passe et sa confirmation ne correspondent pas.',
            'password.required' => 'Veuillez entrer votre mot de passe actuel pour confirmer le changement.',
        ]);

        // Gestion du mot de passe :
        // Si l'utilisateur a fourni un nouveau mot de passe...
        if ($request->filled('new_password')) {
            // Vérifier si l'ancien mot de passe fourni correspond au mot de passe actuel de l'utilisateur en base de données.
            if (!Hash::check($validatedData['password'], $user->password)) {
                Alert::error('Erreur de Mot de Passe', 'Votre mot de passe actuel est incorrect.')->persistent(true);
                return back()->withInput(); // Rediriger l'utilisateur avec les données saisies
            }

            // Hacher et attribuer le nouveau mot de passe à l'utilisateur.
            $user->password = Hash::make($validatedData['new_password']);
        }

        // Mettre à jour les autres informations de l'utilisateur.
        $user->name = $validatedData['firstName'];
        $user->surname = $validatedData['lastName']; // Assurez-vous que 'surname' est la bonne colonne
        $user->email = $validatedData['email'];
        $user->telephone = $validatedData['phone'] ?? null; // Utilise null si le champ est vide

        // Sauvegarder toutes les modifications (y compris le mot de passe si changé) dans la base de données.
        $user->save();

        // Recharger les données de session de l'utilisateur avec les nouvelles informations.
        // Cela garantit que Auth::user() renvoie les données à jour immédiatement.
        Auth::setUser($user);

        // Afficher un message de succès.
        Alert::success('Profil Mis à Jour !', 'Vos informations de profil ont été mises à jour avec succès.');

        // Rediriger l'utilisateur vers la page précédente.
        return redirect()->back();
    }

    public function dashboard()
    {
        $emplacements = Emplacements::orderBy('id', 'desc')->get();
        $data = [
            'emplacements' => $emplacements
        ];

        return view('home/dashboard', $data);
    }

    public function logout()
    {
        try {
            Auth::logout();
            Alert::info('Déconnexion', 'Vous êtes déconnecté.');
            return redirect()->route('login');
        } catch (\Exception $e) {
            Log::error('Erreur lors de la déconnexion : ' . $e->getMessage());
            Alert::error('Erreur', 'Impossible de vous déconnecter pour le moment.');
            return back();
        }
    }
}
