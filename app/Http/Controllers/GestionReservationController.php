<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\Reservations;

class GestionReservationController extends Controller
{
    public function index()
    {
        $reservations = Reservations::with('Users', 'Emplacements')->latest()->get();
        return view('Adminboard.Reservations.index', compact('reservations'));
    }

    public function show($id)
    {
        $reservation = Reservations::with('Users', 'Emplacements')->findOrFail($id);
        return view('Adminboard.reservations.show', compact('reservation'));
    }

    public function destroy($id)
    {
        $reservation = Reservations::findOrFail($id);
        $reservation->delete();
        return redirect()->route('Adminboard.reservations.index')->with('success', 'Réservation supprimée.');
    }
}

