<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>Paiement | BookWork</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Playfair+Display:wght@400;700&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet" />
    <script src="https://cdn.fedapay.com/checkout.js?v=1.1.7"></script>
    <link rel="stylesheet" href="{{ asset('css/paiement.css') }}" />
</head>

<body>
    <nav>
        <div class="nav__bar">
            <div class="logo nav__logo">
                <div>BW</div><span>Book<br />Work</span>
            </div>
            <div class="nav__toggle" id="nav-toggle"><i class="ri-menu-line"></i></div>
        </div>
    </nav>
    <header class="header">
        <h1>Paiement de votre réservation</h1>
        <p>Saisissez vos informations et réglez en toute sécurité.</p>
    </header>

    <section class="pay-container">

        <h2>Formulaire de Paiement</h2>
        <form id="payForm" autocomplete="off" method="POST" action="">
            <label for="name">Nom complet</label>
            <input type="text" id="name" name="name" placeholder="Votre nom" required value="{{ $user->name . " " . $user->surname  }}" />

            <label for="email">Adresse e‑mail</label>
            <input type="email" id="email" name="email" placeholder="mail@example.com" required value="{{ $user->email }}" />

            <label for="amount">Montant (FCFA)</label>
            <input type="number" readonly id="amount" name="amount" min="1000" step="100" required value="{{ $amount }}" />
            <input type="hidden" name="amount_hidden" id="amount_hidden" , value="{{ $amount }}">
            <div class="buttons">
                <button type="button" class="btn" id="pay-btn">Payer</button>
                <button type="button" class="btn" id="cancelBtn">Annuler</button>
                <form id="cancel-form" action="/annuler/reservation" method="POST" style="display:none;">
                    @csrf
                </form>
            </div>
        </form>
    </section>

    <footer class="footer">
        <div class="footer_container">
            <div class="footer_col">
                <div class="logo footer_logo">
                    <div>BW</div>
                    <span>BOOK<br />WORK</span>
                </div>
                <p>Réservez rapidement vos salles ou espaces modernes.</p>
            </div>
            <div class="footer__col">
                <h4>Contact</h4>
                <p>Email : info@bookwork.com</p>
                <p>Tél : +229 01 64 32 12 08</p>
            </div>
        </div>
        <div class="footer__bar">© 2025 BookWork. Tous droits réservés.</div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <button type="button" class="btn" id="cancelBtn">Annuler</button>

    <form id="cancel-form" action="/annuler/reservation" method="POST" style="display:none;">
        @csrf
    </form>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        function confirmCancel() {
            Swal.fire({
                title: 'Annulation de réservation',
                text: "Voulez-vous vraiment annuler votre réservation ?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#f6ac0f', // ton orange
                cancelButtonColor: '#3085d6', // bleu
                confirmButtonText: 'Oui, annuler',
                cancelButtonText: 'Non, garder'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('cancel-form').submit();
                }
            });
        }

        document.getElementById('cancelBtn').addEventListener('click', function(e) {
            e.preventDefault();
            confirmCancel();
        });
    </script>

    <script>
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
                            window.location.href = "/mesreservation";
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

        document.addEventListener('DOMContentLoaded', function() {
            const payBtn = document.getElementById('pay-btn');
            const cancelBtn = document.getElementById('cancelBtn');
            const emailInput = document.getElementById('email');
            const nameInput = document.getElementById('name');
            const amountInput = document.getElementById('amount_hidden');

            if (payBtn) {
                FedaPay.init("#pay-btn", {
                    public_key: "pk_live_Xzoyr48Fxd0AjUrk3wVVF2so",
                    transaction: {
                        amount: parseInt(amountInput.value) || 0,
                        description: 'Paiement de réservation BookWork'
                    },
                    customer: {
                        email: emailInput.value || '{{ $user->email }}',
                        lastname: (nameInput.value.split(' ')[1]) || '{{ $user->surname }}',
                        firstname: (nameInput.value.split(' ')[0]) || '{{ $user->name }}',
                    },
                    onComplete: function(response) {
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
    </script>

    @include('sweetalert::alert')

</body>

</html>