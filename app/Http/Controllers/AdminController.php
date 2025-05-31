<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Emplacements;
use App\Models\User;
use App\Models\Reservations;

class AdminController extends Controller
{
    public function index()
    {
        $emplacements = Emplacements::all();

        $recentPerClient = Reservations::with(['user', 'emplacement'])
        ->orderByDesc('date_reserv')          // plus récent → plus haut
        ->orderByDesc('created_at')           // 2ᵉ critère si même jour
        ->get()
        ->unique('user_id')                   // 1 seul par client
        ->values(); 
        

        $users = User::withCount('reservations')
            ->with(['latestReservation.emplacement']) // Assure-toi d’avoir cette relation dans le modèle User
            ->get();

        $reservations = Reservations::with(['user', 'emplacement'])->get();

        $last_reserv = Reservations::with(['user', 'emplacement'])->orderBy("created_at", "desc")->first();

            

                $data = [
            "emplacements" => $emplacements,
            "users" => $users,
            "reservations" => $reservations,
            'nbre_reserv' => $reservations->count(),
            "last_reserv" => $last_reserv,
            'nbre_users' => $users->count(),
            'revenu_total' => $reservations->sum('montant'),
            'nbre_occupation' => $reservations->count(),
            'recentPerClient' => $recentPerClient, // Ajouté ici
        ];


        return view('home.Adminboard', $data);
    }
}

