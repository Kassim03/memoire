<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Historique des Réservations | BookWork</title>
    <script src="https://cdn.fedapay.com/checkout.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Playfair+Display:wght@400;700&display=swap" rel="stylesheet" />
    <style>
        @layer components {
            .status-confirmed {
                @apply bg-emerald-100 text-emerald-800;
            }

            .status-pending {
                @apply bg-amber-100 text-amber-800;
            }

            .status-canceled {
                @apply bg-rose-100 text-rose-800;
            }
        }
    </style>
</head>

<body class="bg-gray-50 min-h-screen flex flex-col">
    <nav class="bg-[#0f1a2c] text-white sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">
            <div class="logo flex items-center gap-2 font-bold">
                <div class="w-10 h-10 bg-[#f6ac0f] text-[#0f1a2c] grid place-content-center rounded-md font-serif text-lg">BW</div>
                <span class="font-serif leading-tight">Book<br />Work</span>
            </div>
            <ul class="hidden md:flex items-center gap-6" id="nav-links">
                <li><a href="/dashboard" class="font-medium hover:text-[#f6ac0f] transition">Accueil</a></li>
                <li><a href="/profil" class="font-medium hover:text-[#f6ac0f] transition">Profil</a></li>
                <li>
                    <a href="#" id="logout-link">Déconnexion</a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">
                        @csrf
                    </form>
                </li>
            </ul>
            <div class="md:hidden text-2xl cursor-pointer" id="nav-toggle"><i class="ri-menu-line"></i></div>
        </div>
    </nav>

    <header class="bg-gradient-to-r from-[#0f1a2c] to-[#1777ff] text-white py-20 px-6 text-center">
        <div class="max-w-4xl mx-auto">
            <h1 class="font-serif text-4xl md:text-5xl font-bold mb-4">Historique des Réservations</h1>
            <p class="text-lg opacity-90">Retrouvez l'ensemble de vos réservations passées et à venir</p>
        </div>
    </header>

    <main class="flex-1 py-12 px-4">
        <div class="max-w-6xl mx-auto">
            <div class="mb-8 text-center">
                <h2 class="font-serif text-3xl text-[#0f1a2c] font-bold">Mes Réservations</h2>
                <p class="text-gray-500 mt-2"><span id="total-reservations-display">2</span> réservations trouvées</p>
            </div>

            <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50">
                            <tr class="border-b border-gray-200">
                                <th class="py-4 px-6 text-left font-medium text-gray-500 uppercase tracking-wider text-sm">Salle</th>
                                <th class="py-4 px-6 text-left font-medium text-gray-500 uppercase tracking-wider text-sm">Date de réservation</th>
                                <th class="py-4 px-6 text-left font-medium text-gray-500 uppercase tracking-wider text-sm">Heure d'arrivé et de depart</th>
                                <th class="py-4 px-6 text-left font-medium text-gray-500 uppercase tracking-wider text-sm">Durée</th>
                                <th class="py-4 px-6 text-left font-medium text-gray-500 uppercase tracking-wider text-sm">Statut</th>
                                <th class="py-4 px-6 text-left font-medium text-gray-500 uppercase tracking-wider text-sm">Montant</th>
                                <th class="py-4 px-6 text-left font-medium text-gray-500 uppercase tracking-wider text-sm">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200" id="reservations-table-body">
                            <!-- Exemple de ligne pour test -->
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="py-4 px-6 text-sm">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-lg bg-blue-50 flex items-center justify-center text-blue-600">
                                            <i class="ri-building-2-line text-lg"></i>
                                        </div>
                                        <div>
                                            <p class="font-medium">Salle de Conférence A</p>
                                            <span class="text-xs text-gray-500">Capacité : 20 personne(s)</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-4 px-6 text-sm">
                                    <p>2025-06-15</p>
                                    <p class="text-xs text-gray-500">Dans 16 jours</p>
                                </td>
                                <td class="py-4 px-6 text-sm">
                                    2025/06/15 09:00 - 2025/06/15 17:00
                                </td>
                                <td class="py-4 px-6 text-sm">8h00</td>
                                <td class="py-4 px-6 text-sm">
                                    <span class="px-2 py-1 text-yellow-500 rounded-full text-xs font-medium status-pending">En cours</span>
                                </td>
                                <td class="py-4 px-6 font-medium text-sm">15000 FCFA</td>
                                <td class="py-4 px-6 relative">
                                    <button class="text-blue-600 hover:text-blue-800 transition focus:outline-none" onclick="toggleActions(this)">
                                        <i class="ri-more-2-fill text-xl"></i>
                                    </button>

                                    <div class="absolute right-0 mt-2 w-32 bg-white border border-gray-200 rounded-md shadow-lg z-10 hidden" data-actions-menu>
                                        <a href="#" class="block px-4 py-2 text-sm text-red-600 hover:bg-gray-100">Annuler</a>
                                        <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Modifier</a>
                                        <button type="button"
                                            class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 pay-button"
                                            data-reservation-id="123"
                                            data-amount="15000"
                                            data-email="test@example.com"
                                            data-name="John Doe">
                                            Payer
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="bg-gray-50 px-6 py-4 border-t border-gray-200">
                    <div class="flex justify-between items-center">
                        <p class="text-sm text-gray-500" id="pagination-info">Affichage de 1 à 1 sur 1 réservations</p>
                        <div class="flex gap-2">
                            <button id="prev-page" class="px-3 py-1.5 rounded-md border border-gray-300 text-sm font-medium disabled:opacity-50" disabled>
                                Précédent
                            </button>
                            <button id="next-page" class="px-3 py-1.5 rounded-md border border-gray-300 text-sm font-medium hover:bg-gray-100 transition">
                                Suivant
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <footer class="bg-[#0f1a2c] text-white py-12 px-6">
        <div class="max-w-7xl mx-auto grid md:grid-cols-2 gap-8">
            <div>
                <div class="logo flex items-center gap-2 font-bold mb-4">
                    <div class="w-10 h-10 bg-[#f6ac0f] text-[#0f1a2c] grid place-content-center rounded-md font-serif text-lg">BW</div>
                    <span class="font-serif leading-tight">Book<br />Work</span>
                </div>
                <p class="text-gray-300">Réservez rapidement vos salles ou espaces modernes.</p>
            </div>
            <div>
                <h4 class="font-medium mb-3 text-lg">Contact</h4>
                <p class="text-gray-300 mb-2"><i class="ri-mail-line mr-2"></i> info@bookwork.com</p>
                <p class="text-gray-300"><i class="ri-phone-line mr-2"></i> +229 01 64 32 12 08</p>
            </div>
        </div>
        <div class="max-w-7xl mx-auto mt-8 pt-6 border-t border-gray-700 text-center text-sm text-gray-400">
            Copyright © 2025 BookWork. Tous droits réservés.
        </div>
    </footer>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            console.log("DOM Content Loaded - Initialisation des événements");

            // Gestion de la déconnexion
            const logoutLink = document.getElementById('logout-link');
            if (logoutLink) {
                logoutLink.addEventListener('click', function(event) {
                    event.preventDefault();
                    document.getElementById('logout-form').submit();
                });
            }

            // Gestion des liens de téléchargement de reçu
            document.querySelectorAll('.download-receipt-link').forEach(link => {
                link.addEventListener('click', function(event) {
                    event.preventDefault();
                    const reservationId = this.dataset.reservationId;
                    const form = document.getElementById(`download-receipt-form-${reservationId}`);
                    if (form) {
                        form.submit();
                    } else {
                        console.error('Formulaire de téléchargement introuvable pour la réservation ID:', reservationId);
                    }
                });
            });

            // Navigation mobile
            const navToggle = document.getElementById("nav-toggle");
            const navLinks = document.getElementById("nav-links");

            if (navToggle && navLinks) {
                navToggle.addEventListener("click", () => {
                    navLinks.classList.toggle("hidden");
                    navToggle.innerHTML = navLinks.classList.contains("hidden") ?
                        '<i class="ri-menu-line"></i>' :
                        '<i class="ri-close-line"></i>';
                });
            }

            // GESTION DU PAIEMENT - Code corrigé
            initializePaymentButtons();
        });

        // Fonction séparée pour initialiser les boutons de paiement
        function initializePaymentButtons() {
            console.log("Initialisation des boutons de paiement...");
            
            // Utiliser la délégation d'événement pour gérer les boutons ajoutés dynamiquement
            document.addEventListener('click', function(event) {
                if (event.target.classList.contains('pay-button')) {
                    event.preventDefault();
                    handlePayment(event.target);
                }
            });
        }

        function handlePayment(button) {
            console.log("Bouton payer cliqué");
            
            const reservationId = button.dataset.reservationId;
            const amount = parseFloat(button.dataset.amount);
            const email = button.dataset.email;
            const name = button.dataset.name;
            
            console.log("Données de paiement:", { reservationId, amount, email, name });

            // Validation des données
            if (!reservationId || isNaN(amount) || amount <= 0 || !email || !name) {
                console.error("Données de paiement invalides:", { reservationId, amount, email, name });
                alert("Erreur : Données de paiement invalides");
                return;
            }

            const firstName = name.split(' ')[0] || '';
            const lastName = name.split(' ').slice(1).join(' ') || '';

            console.log("Initialisation de FedaPay avec:", {
                amount: amount,
                email: email,
                firstName: firstName,
                lastName: lastName
            });

            try {
                FedaPay.init(button, {
                    public_key: "pk_sandbox_pcJ_JzC6Yq7Kr08k-mhI008H",
                    transaction: {
                        amount: amount,
                        description: `Paiement de réservation BookWork (ID: ${reservationId})`
                    },
                    customer: {
                        email: email,
                        lastname: lastName,
                        firstname: firstName,
                    },
                    onComplete: function(response) {
                        console.log("Réponse de FedaPay:", response);

                        if (response && response.transaction && response.transaction.status === 'approved') {
                            console.log("Paiement approuvé");
                            alert("✅ Paiement effectué avec succès !");
                            updateReservationStatus(reservationId, 'Confirmée');
                        } else {
                            console.log("Paiement échoué ou annulé:", response);
                            alert("❌ Paiement annulé ou échoué.");
                        }
                    },
                    onError: function(error) {
                        console.error("Erreur FedaPay:", error);
                        alert("❌ Erreur lors du paiement. Veuillez réessayer.");
                    }
                });
            } catch (error) {
                console.error("Erreur lors de l'initialisation de FedaPay:", error);
                alert("❌ Erreur lors de l'initialisation du paiement.");
            }
        }

        function toggleActions(button) {
            const parentTd = button.closest('td');
            const actionsMenu = parentTd.querySelector('[data-actions-menu]');

            // Fermer tous les autres menus
            document.querySelectorAll('[data-actions-menu]').forEach(menu => {
                if (menu !== actionsMenu && !menu.classList.contains('hidden')) {
                    menu.classList.add('hidden');
                }
            });

            // Toggle le menu actuel
            actionsMenu.classList.toggle('hidden');
        }

        // Fermer les menus quand on clique ailleurs
        document.addEventListener('click', function(event) {
            if (!event.target.closest('[data-actions-menu]') && !event.target.closest('button.text-blue-600')) {
                document.querySelectorAll('[data-actions-menu]').forEach(menu => {
                    if (!menu.classList.contains('hidden')) {
                        menu.classList.add('hidden');
                    }
                });
            }
        });

        function updateReservationStatus(reservationId, status) {
            console.log(`Mise à jour du statut pour réservation ID ${reservationId} vers : ${status}`);

            if (!reservationId) {
                console.error("ID de réservation manquant");
                return;
            }

            // Simulation d'une requête AJAX
            fetch(`/reservation/statut/${reservationId}`, {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "dummy-token", // Remplacer par le vrai token CSRF
                    "Accept": "application/json"
                },
                body: JSON.stringify({ statut: status })
            })
            .then(response => {
                console.log("Statut de la réponse:", response.status);
                if (!response.ok) {
                    throw new Error(`HTTP erreur ! status: ${response.status}`);
                }
                return response.json();
            })
            .then(data => {
                console.log("Réponse serveur:", data);
                if (data.success) {
                    console.log("Statut mis à jour avec succès");
                    // Redirection ou mise à jour de l'interface
                    if (status === 'Confirmée') {
                        window.location.href = "/dashboard";
                    } else if (status === 'Annulée') {
                        window.location.href = "/mesreservation";
                    }
                } else {
                    console.error("Erreur:", data.message);
                }
            })
            .catch(error => {
                console.error("Erreur lors de la mise à jour du statut:", error);
                alert("Erreur lors de la mise à jour du statut. Veuillez réessayer.");
            });
        }

        // Pagination (simplifié pour l'exemple)
        document.addEventListener("DOMContentLoaded", () => {
            const tableBody = document.getElementById('reservations-table-body');
            const totalReservationsDisplay = document.getElementById('total-reservations-display');
            
            if (tableBody && totalReservationsDisplay) {
                const rows = Array.from(tableBody.children);
                totalReservationsDisplay.textContent = rows.length;
            }
        });
    </script>
</body>

</html>