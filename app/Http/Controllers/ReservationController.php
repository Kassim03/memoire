<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Emplacements;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use App\Models\Reservations;
use Carbon\Carbon;

class ReservationController extends Controller
{
    public function show($id)
    {
        // Récupérer l'emplacement par son id
        $emplacement = Emplacements::findOrFail($id);

        // Date d'aujourd'hui
        $aujourdhui = date('Y-m-d');

        // Date de demain
        $demain = Carbon::now()->addDay()->format('Y-m-d\TH:i');

        $data = [
            "emplacement" => $emplacement,
            "aujourdhui"=>$aujourdhui,
            "demain"=>$demain
        ];
        // Passer l'emplacement à la vue
        return view('home/reservation', $data);
    }

    public function valider(Request $request)
    {
        try {
            // Validation manuelle
            $validated = $request->validate([
                'salle' => 'required|string',
                'emplacement_id' => 'required|exists:emplacements,id',
                'date_arrive' => 'required',
                'date_depart' => 'required',
                'duree' => 'required|min:1|max:120',
                'participants' => 'required|integer|min:1',
                'commentaires' => 'nullable|string',
            ]);



            $emplacement = Emplacements::findOrFail($request->emplacement_id);

            $reservation = Reservations::create([
                'id_user' => Auth::user()->id,
                'id_emplacement' => $validated['emplacement_id'],
                'heure_debut' => $validated['date_arrive'],
                'heure_fin' => $validated['date_depart'],
                'date_reserv' => Date('Y-m-d'),
                'participants' => $validated['participants'],
                'commentaires' => $validated['commentaires'],
                'montant' => $validated['duree'] * $emplacement->tarif_hr,
                'statut' => 'En cours', // 👈 Par défaut
            ]);

            if($request){
                // Écraser proprement les anciennes données
            session()->forget('reservation');

            // Stocker les données en session
            session()->put('reservation', [
                'emplacement_id' => $emplacement->id,
                'nom_salle' => $emplacement->nom,
                'tarif_hr' => $emplacement->tarif_hr,
                'date_arrive' => $validated['date_arrive'],
                'date_depart' => $validated['date_depart'],
                'duree' => $validated['duree'],
                'participants' => $validated['participants'],
                'commentaires' => $validated['commentaires'],
                'total' => $validated['duree'] * $emplacement->tarif_hr,
                'reservation_id' => $reservation->id,
            ]);

            $data = [
                'emplacement' => $emplacement->tarif_hr,
            ];
            return redirect()->route('paiement.page')->with('data', $data);
            }else{
                Alert::error('Erreur', 'Erreur au cours de la réservation');
            }
            
        } catch (ValidationException $e) {
            // ✅ Gestion des erreurs de validation avec SweetAlert
            foreach ($e->errors() as $field => $messages) {
                foreach ($messages as $message) {
                    Alert::warning('Champ requis', $message);
                }
            }
            return back()->withInput();
        } catch (\Exception $e) {
            // ✅ Gestion des autres erreurs
            Log::error('Erreur dans valider() : ' . $e->getMessage());
            Alert::error('Erreur', 'Un problème est survenu lors de la réservation.' . $e->getMessage());
            return back()->withInput();
        }
    }

    public function paiement()
    {
        try {
            $reservation = session('reservation');

            if (!$reservation) {
                Alert::warning('Attention', 'Aucune réservation en cours.');
                return redirect()->route('dashboard');
            }
            session(['reservation_id' => $reservation['reservation_id']]); // ✅ Bon
            $user = Auth::user();
            $data = [
                'id' => $reservation['emplacement_id'],
                'reservation_id' => $reservation['reservation_id'],
                'amount' => $reservation['total'],
                'user' => $user,
            ];
            return view('home/paiement', $data);
        } catch (\Exception $e) {
            Log::error('Erreur dans paiement() : ' . $e->getMessage());
            Alert::error('Erreur', 'Impossible de charger la page de paiement.' . $e->getMessage());
            return redirect()->route('dashboard');
        }
    }

    public function updateStatut(Request $request, $id)
    {
        try {
            // ✅ Validation corrigée pour correspondre aux valeurs JavaScript
            $request->validate([
                'statut' => 'required|in:En cours,Confirmée,Annulée'
            ]);

            // ✅ Vérifier que l'utilisateur peut modifier cette réservation
            $reservation = Reservations::where('id', $id)
                ->where('id_user', Auth::user()->id)
                ->firstOrFail();

            $reservation->statut = $request->statut;
            $reservation->save();

            Log::info("Statut de la réservation {$id} mis à jour vers : {$request->statut}");

            return response()->json([
                'success' => true,
                'message' => 'Statut mis à jour avec succès.',
                'statut' => $reservation->statut
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Données invalides.',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            Log::error('Erreur lors de la mise à jour du statut : ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Erreur serveur lors de la mise à jour.'
            ], 500);
        }
    }

    public function stop()
    {
        try {
            // Supposons que tu stockes l'id de la réservation en session sous 'reservation_id'
            if (session()->has('reservation_id')) {
                $reservationId = session('reservation_id');

                // Supprimer la réservation en base si nécessaire
                $reservation = Reservations::find($reservationId);
                if ($reservation) {
                    $reservation->delete();
                }

                // Nettoyer toutes les données liées à la réservation en session
                session()->forget(['reservation_id', 'autre_donnee_associee', 'panier', 'reservation_statut']);
            }

            Alert::info('Annulation de réservation', 'Votre réservation a bien été annulée.');

            return redirect()->route('dashboard');
        } catch (\Exception $e) {
            Log::error('Erreur lors de l\'annulation de la réservation : ' . $e->getMessage());

            Alert::error('Erreur', 'Impossible d\'annuler la réservation pour le moment.');

            return back();
        }
    }

    public function edit($id)
{
    $reservation = Reservations::findOrFail($id); 
    return view('reservation.edit', compact('reservation'));
}

public function update(Request $request, $id) {
    $reservation = Reservations::findOrFail($id);

    // Validation + mise à jour ici
    $reservation->nom = $request->nom;
    // ...

    $reservation->save();
    return redirect()->back()->with('success', 'Reservation mis à jour.');
}



    
}
