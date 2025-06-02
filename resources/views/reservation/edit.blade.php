@extends('layouts.add')

@section('title', 'Modifier Réservation')

@section('content')
<div id="editReservationModal" class="fixed inset-0 bg-gray-600 bg-opacity-75 flex items-center justify-center p-4 z-50">
    <div class="bg-white rounded-lg shadow-xl w-full max-w-lg mx-auto p-6">
        <div class="flex justify-between items-center border-b pb-3 mb-4">
            <h3 class="text-xl font-semibold text-gray-800 w-full text-center">Modifier la Réservation</h3>
        </div>
        <form id="editReservationForm" method="POST" action="{{ route('reservation.update', ['id_reservation'=>!empty($reservation->id) ? $reservation->id : 0, 'id_user'=>Auth::user()->id]) }}" class="space-y-4 flex flex-col items-center">
            @csrf
            @method('PUT')

            <input type="hidden" id="reservationId" name="reservation_id">

            <div class="w-2/3 mx-auto">
                <label for="edit_salle" class="block text-gray-700 text-sm font-bold mb-2 text-center">Nom de la salle :</label>
                <input type="text" id="edit_salle" name="salle" value="{{ $reservation->emplacement->nom }}" class="shadow border rounded w-full py-2 px-3 text-gray-700 text-center" readonly>
            </div>

            <div class="w-2/3 mx-auto">
                <label for="edit_email_client" class="block text-gray-700 text-sm font-bold mb-2 text-center">Email client :</label>
                <input type="email" id="edit_email_client" name="email_client" value="{{ $reservation->user->email }}" class="shadow border rounded w-full py-2 px-3 text-gray-700 text-center" required>
            </div>

            <div class="w-2/3 mx-auto">
                <label for="edit_participants" class="block text-gray-700 text-sm font-bold mb-2 text-center">Nombre de participants :</label>
                <input type="number" id="edit_participants" name="participants" value="{{ $reservation->participants }}" class="shadow border rounded w-full py-2 px-3 text-gray-700 text-center" min="1" required>
            </div>

            <div class="w-2/3 mx-auto">
                <label for="commentaires" class="block text-sm font-medium text-gray-700 mb-1 text-center">Commentaire :</label>
                <textarea name="commentaires" id="commentaires" rows="3" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:ring-secondary focus:border-secondary sm:text-sm resize-y text-center">{{ old('commentaires', $reservation->commentaires) }}</textarea>
            </div>

            <div class="w-2/3 mx-auto">
                <label for="edit_montant" class="block text-gray-700 text-sm font-bold mb-2 text-center">Montant :</label>
                <input type="number" step="0.01" id="edit_montant" name="montant" value="{{ $reservation->montant }}" class="shadow border rounded w-full py-2 px-3 text-gray-700 text-center" required>
            </div>

            <div class="w-2/3 mx-auto">
                <label for="edit_date_reserv" class="block text-gray-700 text-sm font-bold mb-2 text-center">Date de réservation :</label>
                <input type="date" id="edit_date_reserv" name="date_reserv" value="{{ $reservation->date_reserv }}" class="shadow border rounded w-full py-2 px-3 text-gray-700 text-center" readonly>
            </div>

            <div class="flex gap-6 w-2/3 mx-auto">
                <div class="flex-1 flex flex-col">
                    <label for="edit_heure_arrivee" class="block text-gray-700 text-sm font-bold mb-2 text-left">Heure d’arrivée :</label>
                    <input type="datetime-local" id="edit_heure_arrivee" name="heure_arrivee" value="{{ $reservation->heure_debut }}" 
                           class="shadow border rounded w-full py-3 px-3 text-gray-700 text-center focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>
                <div class="flex-1 flex flex-col">
                    <label for="edit_heure_depart" class="block text-gray-700 text-sm font-bold mb-2 text-left">Heure de départ :</label>
                    <input type="datetime-local" id="edit_heure_depart" name="heure_depart" value="{{ $reservation->heure_fin }}" 
                           class="shadow border rounded w-full py-3 px-3 text-gray-700 text-center focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>
            </div>

            <div class="w-2/3 mx-auto">
                <label for="edit_statut" class="block text-gray-700 text-sm font-bold mb-2 text-center">Statut :</label>
                <select id="edit_statut" name="statut" class="shadow border rounded w-full py-2 px-3 text-gray-700 text-center" required>
                    <option value="en attente" {{ $reservation->statut == 'en attente' ? 'selected' : '' }}>En attente</option>
                    <option value="confirmée" {{ $reservation->statut == 'confirmée' ? 'selected' : '' }}>Confirmée</option>
                    <option value="annulée" {{ $reservation->statut == 'annulée' ? 'selected' : '' }}>Annulée</option>
                </select>
            </div>

            <div class="flex justify-center gap-3 pt-4 w-2/3 mx-auto">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Sauvegarder</button>
                <button type="button" onclick="closeModal()" class="bg-gray-400 hover:bg-gray-500 text-white font-bold py-2 px-4 rounded">Annuler</button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
function openEditModalFromButton(btn) {
    const modal = document.getElementById('editReservationModal');

    document.getElementById('reservationId').value      = btn.dataset.id || '';
    document.getElementById('edit_salle').value         = btn.dataset.salle || '';
    document.getElementById('edit_email_client').value  = btn.dataset.emailClient || '';
    document.getElementById('edit_participants').value  = btn.dataset.participants || '';
    document.getElementById('commentaires').value       = btn.dataset.commentaire || '';
    document.getElementById('edit_montant').value       = btn.dataset.montant || '';
    document.getElementById('edit_date_reserv').value   = btn.dataset.dateReserv || '';
    document.getElementById('edit_heure_arrivee').value = btn.dataset.heureArrivee || '';
    document.getElementById('edit_heure_depart').value  = btn.dataset.heureDepart || '';
    document.getElementById('edit_statut').value        = btn.dataset.statut || 'en attente';

    modal.classList.remove('hidden');
}

function closeModal() {
    document.getElementById('editReservationModal').classList.add('hidden');
    document.getElementById('editReservationForm').reset();
}

window.addEventListener('click', e => {
    const modal = document.getElementById('editReservationModal');
    if (e.target === modal) closeModal();
});
</script>
@endsection
