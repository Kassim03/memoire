<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Reservations;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Emplacements;

use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
class HistoriqueController extends Controller
{
    public function index()
    {

        $user = Auth::user();
        $reservation_list = Reservations::with(['user', 'emplacement'])
            ->where('id_user', $user->id)->orderBy('created_at','desc')
            ->get();



        $data = [
            'user' => $user,
            'reservation_list' => $reservation_list,
        ];
        return view('home/historique', $data);
    }

    public function cancel(Request $request)
    {
        try {
            $reservation = Reservations::find($request->reservation_id);

            if (!$reservation) {
                Alert::error('Erreur', 'Réservation introuvable.');
                return back();
            }

            if ($reservation->id_user !== Auth::id()) {
                Alert::error('Accès refusé', 'Vous ne pouvez pas annuler cette réservation.');
                return back();
            }

            $reservation->update([
                'statut' => 'Annulée',
            ]);

            Alert::success('Succès', 'Réservation annulée avec succès.');
            return back();
        } catch (\Exception $e) {
            Alert::error('Erreur', 'Une erreur est survenue : ' . $e->getMessage());
            return back();
        }
    }

    public function updateReservation(Request $request, $id_reservation)
    {
        // Valider les données du formulaire
        $validatedData = $request->validate([
            'reservation_id'  => 'required|integer',
            'participants'      =>'required|integer',
            'emplacement_id'  => 'required|integer',
            'salle'           => 'required|string|max:255',
            'heure_debut'     => 'required|date',
            'heure_fin'       => 'required|date|after:heure_debut',
            'duration'        => 'required|string|max:50',
        ]);

        // Dump and die des données validées

        $duration = $validatedData['duration']; 

        // Extraire le chiffre avec une expression régulière
        preg_match('/\d+/', $duration, $matches);
        
        $nombreHeures = isset($matches[0]) ? (int)$matches[0] : 0;

        $emplacement = Emplacements::where('id', '=', $validatedData['emplacement_id'])->first();
        if (!$emplacement) {
            Alert::error('Erreur','Impossible de retrouvé la salle');
        }else{
            $reservation = Reservations::where('id','=', $validatedData['reservation_id'])->first();
            $reservation->update([
                'participants'=>$validatedData['participants'],
                'montant'=>$emplacement->tarif_hr*$nombreHeures,
                'date_reserv'=>date('Y-m-d'),
                'heure_debut'=>$validatedData['heure_debut'],
                'heure_fin'=>$validatedData['heure_fin'],
            ]);
            $reservation->save();

            Alert::success('Modification de réservation', 'Votre réservation a bien été modifiée.');

            return redirect()->route('reservation.list');
        }

    }

    public function downloadpdf($id){
        $user = Auth::user();

        // Récupérer la réservation spécifique en utilisant l'ID
        // Assurez-vous que l'utilisateur est bien le propriétaire de la réservation pour des raisons de sécurité
        $reservation = Reservations::with(['user', 'emplacement'])
                                ->where('id', $id)
                                ->where('id_user', $user->id) // S'assurer que seule la réservation de l'utilisateur est accessible
                                ->firstOrFail(); // Renvoie une 404 si non trouvée ou si l'utilisateur n'est pas le propriétaire

        $data = [
            'reservation' => $reservation,
            'date_generation' => Carbon::now()->format('d/m/Y H:i'),
        ];

        $pdf = Pdf::loadView('receipts.pdf_template', $data);

        $pdf->output(); // Génère le PDF en mémoire
        $dom_pdf = $pdf->getDomPDF();
        $canvas = $dom_pdf->getCanvas();
        $width = $canvas->get_width();
        $height = $canvas->get_height();

        $text = "BOOK WORK";
        $font = null; // Utilise la police par défaut intégrée dans Dompdf
        $size = 70; // Taille du texte du filigrane, vous pouvez ajuster
        $color = [0.769, 0.675, 0.439]; // Couleur RVB de votre orange (alpha 0.4 pour la transparence)
        $opacity = 0.2; // Opacité du filigrane (20%)

        // Appliquer l'opacité au canvas avant de dessiner le texte
        $canvas->set_opacity($opacity);

        // Positionnement du filigrane :
        // Le point d'origine du texte est le coin supérieur gauche.
        // Pour un centrage diagonal, on le place légèrement au-dessus et à gauche du centre de la page.
        // Les valeurs 0.5 et 0.5 sont des facteurs par rapport à la taille de la page pour le centrage.
        // L'angle de -45 degrés est pour la diagonale.
        // Le 0 et le 0 à la fin sont les offsets X et Y par rapport à la position calculée.
        $canvas->page_text($width * 0.3, $height * 0.5, $text, $font, $size, $color, $opacity, 0.5, -45);

        // Restaurer l'opacité normale pour le contenu suivant (si vous en ajoutez)
        $canvas->set_opacity(1.0);
        
        return $pdf->download('recu_reservation_' . $reservation->id . '.pdf');
    }

}
