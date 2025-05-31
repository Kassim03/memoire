



<div id="editReservationModal" class="fixed inset-0 bg-gray-600 bg-opacity-75 flex items-center justify-center p-4 z-50 hidden">
    <div class="bg-white rounded-lg shadow-xl w-full max-w-lg mx-auto p-6">
        <div class="flex justify-between items-center border-b pb-3 mb-4">
            <h3 class="text-xl font-semibold text-gray-800">Modifier la Réservation</h3>
            <button class="text-gray-500 hover:text-gray-700 text-2xl" onclick="closeModal()">
                &times;
            </button>
        </div>
        <form id="editReservationForm" method="POST" action="{{ route('reservation.update', ['id_reservation' => !empty($reservation->id) ? $reservation->id : 0, 'id_user' => Auth::user()->id]) }}" class="space-y-4">

            @csrf
            @method('PUT')
            <input type="hidden" id="reservationId" name="reservation_id">
            <input type="hidden" id="reservationPlaceId" name="reservation_place_id"> {{-- Anciennement emplacement_id, renommé pour clarté --}}

            <div class="mb-4">
                <label for="edit_salle" class="block text-gray-700 text-sm font-bold mb-2">Salle :</label>
                <input type="text" id="edit_salle" name="salle" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" readonly>
            </div>

            <div class="mb-4">
                <label for="edit_date_reserv" class="block text-gray-700 text-sm font-bold mb-2">Date de réservation :</label>
                <input type="date" id="edit_date_reserv" name="date_reserv" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" readonly>
            </div>

            <div class="flex flex-wrap -mx-2 mb-4">
                <div class="w-full md:w-1/2 px-2 mb-4 md:mb-0">
                    <label for="edit_heure_debut" class="block text-gray-700 text-sm font-bold mb-2">Heure de début :</label>
                    <input type="datetime-local" id="edit_heure_debut" name="heure_debut" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div class="w-full md:w-1/2 px-2">
                    <label for="edit_heure_fin" class="block text-gray-700 text-sm font-bold mb-2">Heure de fin :</label>
                    <input type="datetime-local" id="edit_heure_fin" name="heure_fin" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
            </div>

            <div class="flex flex-wrap -mx-2 mb-6">
                <div class="w-full md:w-1/2 px-2 mb-4 md:mb-0">
                    <label for="participants" class="block text-gray-700 text-sm font-bold mb-2">Nombre(s) de participant(s)</label>
                    <input type="number" id="participants" name="participants" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline bg-gray-100">
                </div>
                <div class="w-full md:w-1/2 px-2">
                    <label for="reservation_duration" class="block text-gray-700 text-sm font-bold mb-2">Durée de la réservation :</label>
                    <input type="text" id="reservation_duration" name="duration" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline bg-gray-100" readonly>
                </div>
            </div>

            <div class="flex items-center justify-between">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Sauvegarder les modifications
                </button>
                <button type="button" class="bg-gray-400 hover:bg-gray-500 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" onclick="closeModal()">
                    Annuler
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function openEditModalFromButton(btn) {
    const modal = document.getElementById('editReservationModal');
    const form  = document.getElementById('editReservationForm');

    const id                = btn.dataset.id;
    const reservationPlaceId = btn.dataset.reservationPlaceId; // ancien emplacementId
    const reservationPlaceName = btn.dataset.reservationPlaceName; // ancien emplacementNom
    const dateReserv        = btn.dataset.dateReserv;
    const heureDebut        = btn.dataset.heureDebut;
    const heureFin          = btn.dataset.heureFin;
    const participants      = btn.dataset.participants;

    document.getElementById('reservationId').value = id;
    document.getElementById('reservationPlaceId').value = reservationPlaceId;
    document.getElementById('edit_salle').value = reservationPlaceName;
    document.getElementById('edit_date_reserv').value = dateReserv;
    document.getElementById('participants').value = participants;
    document.getElementById('edit_heure_debut').value = heureDebut ? new Date(heureDebut).toISOString().slice(0,16) : '';
    document.getElementById('edit_heure_fin').value = heureFin ? new Date(heureFin).toISOString().slice(0,16) : '';

    calculateDuration();
    modal.classList.remove('hidden');
}

function closeModal() {
    document.getElementById('editReservationModal').classList.add('hidden');
    document.getElementById('editReservationForm').reset();
    document.getElementById('reservation_duration').value = '';
}

function calculateDuration() {
    const inDebut  = document.getElementById('edit_heure_debut').value;
    const inFin    = document.getElementById('edit_heure_fin').value;
    const durField = document.getElementById('reservation_duration');

    if (!inDebut || !inFin) { durField.value = ''; return; }

    const dDebut = new Date(inDebut);
    const dFin   = new Date(inFin);

    if (isNaN(dDebut) || isNaN(dFin)) {
        durField.value = 'Entrez des heures valides';
        return;
    }
    if (dFin <= dDebut) {
        durField.value = "L'heure de fin doit être après l'heure de début";
        return;
    }

    const diffMin = Math.floor((dFin - dDebut) / 60000);
    const h = Math.floor(diffMin / 60);
    const m = diffMin % 60;

    durField.value =
        (h ? `${h} heure${h > 1 ? 's' : ''}` : '') +
        (h && m ? ' ' : '') +
        (m ? `${m} minute${m > 1 ? 's' : ''}` : '');
}

document.addEventListener('DOMContentLoaded', () => {
    ['edit_heure_debut', 'edit_heure_fin'].forEach(id =>
        document.getElementById(id).addEventListener('change', calculateDuration)
    );
});

window.addEventListener('click', e => {
    const modal = document.getElementById('editReservationModal');
    if (e.target === modal) closeModal();
});
</script>
