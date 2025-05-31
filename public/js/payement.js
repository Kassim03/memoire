function updateReservationStatus(status) {
    const reservationId = "{{ session('reservation_id') }}";

    console.log(`Début mise à jour statut pour réservation ID ${reservationId} avec statut : ${status}`);

    // ✅ Vérifier que l'ID de réservation existe
    if (!reservationId) {
        console.error("ID de réservation manquant");
        //alert("Erreur : impossible de trouver l'ID de réservation.");
        return;
    }

    fetch("/reservation/statut/" + reservationId, {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": '{{ csrf_token() }}',
            "Accept": "application/json" // ✅ Préciser qu'on attend du JSON
        },
        body: JSON.stringify({
            statut: status
        })
    })
        .then(response => {
            console.log("Status de la réponse:", response.status);

            if (!response.ok) {
                throw new Error(`HTTP erreur ! status: ${response.status}`);
            }
            return response.json();
        })
        .then(data => {
            console.log("Réponse serveur:", data);

            if (data.success) {
                //alert(data.message);

                // Gestion des redirections en fonction du statut
                if (status === 'Confirmée') {
                    console.log("Statut Confirmée, redirection vers dashboard...");
                    window.location.href = "/dashboard";
                } else if (status === 'Annulée') {
                    console.log("Statut Annulée, redirection vers page réservations...");
                    window.location.href = "/reservations";
                } else {
                    console.log("Statut mis à jour, aucune redirection prévue pour :", status);
                }
            } else {
                //alert("Erreur : " + (data.message || "Impossible de mettre à jour le statut"));
            }
        })
        .catch(error => {
            console.error("Erreur lors de la mise à jour du statut :", error);
            //alert("Erreur lors de la mise à jour du statut. Veuillez réessayer.");
        });
}

document.addEventListener('DOMContentLoaded', function () {
    const payBtn = document.getElementById('pay-btn');
    const cancelBtn = document.getElementById('cancelBtn');
    const emailInput = document.getElementById('email');
    const nameInput = document.getElementById('name');
    const amountInput = document.getElementById('amount_hidden');

    if (payBtn) {
        FedaPay.init("#pay-btn", {
            public_key: "pk_sandbox_pcJ_JzC6Yq7Kr08k-mhI008H",
            transaction: {
                amount: parseInt(amountInput.value) || 0,
                description: 'Paiement de réservation BookWork'
            },
            customer: {
                email: emailInput.value || '{{ $user->email }}',
                lastname: (nameInput.value.split(' ')[1]) || '{{ $user->surname }}',
                firstname: (nameInput.value.split(' ')[0]) || '{{ $user->name }}',
            },
            onComplete: function (response) {
                console.log("Réponse de FedaPay :", response);

                if (response.transaction && response.transaction.status === 'approved') {
                    alert("✅ Paiement effectué avec succès !");
                    updateReservationStatus('Confirmée');
                } else {
                    //alert("❌ Paiement annulé ou échoué.");
                    updateReservationStatus('Annulée');
                }
            }
        });
    }

    /*if (cancelBtn) {
        cancelBtn.addEventListener('click', function () {
            window.history.back();
        });
    }*/
});

