<style>
/* Conteneur principal centré */
.form-container {
  display: flex;
  justify-content: center;
  align-items: center;
  min-height: 100vh; /* prend toute la hauteur de la fenêtre */
  background-color: #0e1e38; /* fond global bleu foncé */
}

/* Bloc du formulaire */
.form-box {
  background-color: #ffffff; /* fond blanc du formulaire */
  padding: 2em 3em;
  border-radius: 16px;
  box-shadow: 0 6px 20px rgba(0, 0, 0, 0.4);
  width: 100%;
  max-width: 500px;
}

/* Champs du formulaire à l’intérieur */
.form-box input,
.form-box select,
.form-box textarea {
  width: 100%;
  padding: 0.8em;
  border: 1px solid #ddd;
  border-radius: 10px;
  margin-bottom: 1em;
  color: #333;
  background-color: #f9f9f9;
}

/* Bouton submit */
.form-box button {
  background-color: #ffa500;
  color: #fff;
  padding: 0.8em 1.5em;
  border: none;
  border-radius: 10px;
  cursor: pointer;
  width: 100%;
  font-size: 1rem;
}

.form-box button:hover {
  background-color: #cc8400;
}

</style>





<div id="editReservationModal" class="fixed inset-0 bg-gray-600 bg-opacity-75 flex items-center justify-center p-4 z-50 hidden">
    <div class="bg-white rounded-lg shadow-xl w-full max-w-lg mx-auto p-6">
        <div class="flex justify-between items-center border-b pb-3 mb-4">
            <h3 class="text-xl font-semibold text-gray-800">Modifier la Réservation</h3>
            
        </div>
        <form id="editReservationForm" method="POST" action="{{ route('reservation.update', ['id_reservation'=>!empty($reservation->id) ? $reservation->id : 0, 'id_user'=>Auth::user()->id]) }}" class="space-y-4">
            @csrf
            @method('PUT')

            <input type="hidden" id="reservationId" name="reservation_id">

            <div>
                <label for="edit_salle" class="block text-gray-700 text-sm font-bold mb-2">Nom de la salle :</label>
                <input type="text" id="edit_salle" name="salle" value="{{ $reservation->emplacement->nom }}" class="shadow border rounded w-full py-2 px-3 text-gray-700" readonly>
            </div>

            <div>
                <label for="edit_email_client" class="block text-gray-700 text-sm font-bold mb-2">Email client :</label>
                <input type="email" id="edit_email_client" name="email_client" value="{{ $reservation->user->email }}" class="shadow border rounded w-full py-2 px-3 text-gray-700" required>
            </div>

            <div>
                <label for="edit_participants" class="block text-gray-700 text-sm font-bold mb-2">Nombre de participants :</label>
                <input type="number" id="edit_participants" name="participants "value="{{ $reservation->participants }}" class="shadow border rounded w-full py-2 px-3 text-gray-700" min="1" required>
            </div>

            {{-- Commentaire --}}
                <div>
                    <label for="commentaires" class="block text-sm font-medium text-gray-700 mb-1">Commentaire :</label>
                    <textarea name="commentaires" id="commentaires" rows="3"
                              class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:ring-secondary focus:border-secondary sm:text-sm resize-y">{{ old('commentaires', $reservation->commentaires) }}</textarea>
                </div>
            <div>
                <label for="edit_montant" class="block text-gray-700 text-sm font-bold mb-2">Montant :</label>
                <input type="number" step="0.01" id="edit_montant" name="montant" value="{{ $reservation->montant }}" class="shadow border rounded w-full py-2 px-3 text-gray-700" required>
            </div>

            <div>
                <label for="edit_date_reserv" class="block text-gray-700 text-sm font-bold mb-2">Date de réservation :</label>
                <input type="date" id="edit_date_reserv" name="date_reserv" value="{{ $reservation->date_reserv }}" class="shadow border rounded w-full py-2 px-3 text-gray-700" readonly>
            </div>

            <div class="flex gap-4">
                <div class="flex-1">
                    <label for="edit_heure_arrivee" class="block text-gray-700 text-sm font-bold mb-2">Heure d’arrivée :</label>
                    <input type="Datetime" id="edit_heure_arrivee" name="heure_arrivee" value="{{ $reservation->heure_debut }}" class="shadow border rounded w-full py-2 px-3 text-gray-700" required>
                </div>
                <div class="flex-1">
                    <label for="edit_heure_depart" class="block text-gray-700 text-sm font-bold mb-2">Heure de départ :</label>
                    <input type="datetime" id="edit_heure_depart" name="heure_depart" value="{{ $reservation->heure_fin}}" class="shadow border rounded w-full py-2 px-3 text-gray-700" required>
                </div>
            </div>

            <div>
                <label for="edit_statut" class="block text-gray-700 text-sm font-bold mb-2">Statut :</label>
                <select id="edit_statut" name="statut"  class="shadow border rounded w-full py-2 px-3 text-gray-700" required>
                    <option value="en attente">En attente</option>
                    <option value="confirmée">Confirmée</option>
                    <option value="annulée">Annulée</option>
                </select>
            </div>

            <div class="flex justify-end gap-3 pt-4">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Sauvegarder</button>
                <button type="button" onclick="closeModal()" class="bg-gray-400 hover:bg-gray-500 text-white font-bold py-2 px-4 rounded">Annuler</button>
            </div>
        </form>
    </div>
</div>

<script>
function openEditModalFromButton(btn) {
    const modal = document.getElementById('editReservationModal');

    // Remplir les champs avec les data-*
    document.getElementById('reservationId').value      = btn.dataset.id || '';
    document.getElementById('edit_salle').value         = btn.dataset.salle || '';
    document.getElementById('edit_email_client').value  = btn.dataset.emailClient || '';
    document.getElementById('edit_participants').value  = btn.dataset.participants || '';
    document.getElementById('edit_commentaire').value    = btn.dataset.commentaire || '';
    document.getElementById('edit_montant').value       = btn.dataset.montant || '';
    document.getElementById('edit_date_reserv').value   = btn.dataset.dateReserv || '';
    document.getElementById('edit_heure_arrivee').value = btn.dataset.heureArrivee || '';
    document.getElementById('edit_heure_depart').value  = btn.dataset.heureDepart || '';
    document.getElementById('edit_statut').value         = btn.dataset.statut || 'en attente';

    modal.classList.remove('hidden');
}

function closeModal() {
    document.getElementById('editReservationModal').classList.add('hidden');
    document.getElementById('editReservationForm').reset();
}
  
// Fermeture modale clic hors de la boîte
window.addEventListener('click', e => {
    const modal = document.getElementById('editReservationModal');
    if (e.target === modal) closeModal();
});
</script>


