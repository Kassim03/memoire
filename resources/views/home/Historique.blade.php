<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Historique des Réservations | BookWork</title>
    <script src="https://cdn.fedapay.com/checkout.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    {{-- Assurez-vous que ce script est correctement lié à votre fichier JS --}}
    <script src="{{asset('js/3.4.16')}}"></script>
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
                    {{-- On supprime l'attribut href pour éviter le rechargement de page --}}
                    <a id="logout-link" class="font-medium hover:text-[#f6ac0f] transition cursor-pointer">Déconnexion</a>

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
                <p class="text-gray-500 mt-2"><span id="total-reservations-display">0</span> réservations trouvées</p>
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
                            @foreach ($reservation_list as $reservation)
                            <tr class="hover:bg-gray-50 transition-colors">
                                {{-- L'input hidden n'est pas nécessaire ici si l'ID est passé via le bouton --}}
                                {{-- <input type="hidden" name="reservation_id"> --}}
                                <td class="py-4 px-6 text-sm">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-lg bg-blue-50 flex items-center justify-center text-blue-600">
                                            <i class="ri-building-2-line text-lg"></i>
                                        </div>
                                        <div>
                                            <p class="font-medium">{{ $reservation->emplacement->nom }}</p>
                                            <span class="text-xs text-gray-500">Capacité : {{ $reservation->emplacement->capacites }} personne(s)</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-4 px-6 text-sm">
                                    @php
                                    $dateReserv = \Carbon\Carbon::parse($reservation->date_reserv)->startOfDay();
                                    $today = now()->startOfDay();
                                    $daysDiff = $today->diffInDays($dateReserv, false);
                                    @endphp

                                    <p>{{ $reservation->date_reserv }}</p>
                                    <p class="text-xs text-gray-500">
                                        @if ($daysDiff > 0)
                                        Dans {{ $daysDiff }} jour{{ $daysDiff > 1 ? 's' : '' }}
                                        @elseif ($daysDiff === 0)
                                        Aujourd'hui
                                        @elseif ($daysDiff === -1)
                                        Il y a moins d'un jour
                                        @else
                                        Il y a {{ abs($daysDiff) }} jour{{ abs($daysDiff) > 1 ? 's' : '' }}
                                        @endif
                                    </p>

                                </td>
                                <td class="py-4 px-6 text-sm">
                                    {{ \Carbon\Carbon::parse($reservation->heure_debut)->format('Y/m/d H:i') }} -
                                    {{ \Carbon\Carbon::parse($reservation->heure_fin)->format('Y/m/d H:i') }}
                                </td>

                                @php
                                $debut = \Carbon\Carbon::parse($reservation->heure_debut);
                                $fin = \Carbon\Carbon::parse($reservation->heure_fin);
                                $diff = $debut->diffInMinutes($fin);
                                @endphp

                                <td class="py-4 px-6 text-sm">
                                    {{ intdiv($diff, 60) }}h{{ str_pad($diff % 60, 2, '0', STR_PAD_LEFT) }}
                                </td>

                                <td class="py-4 px-6 text-sm">
                                    @if($reservation->statut === 'En cours')
                                    <span class="px-2 py-1 text-yellow-500 rounded-full text-xs font-medium status-confirmed">{{ $reservation->statut }}</span>
                                    @elseif($reservation->statut === 'Confirmée')
                                    <span class="px-2 py-1 text-green-500 rounded-full text-xs font-medium status-confirmed">{{ $reservation->statut }}</span>
                                    @elseif($reservation->statut === 'Terminée')
                                    <span class="px-2 py-1 text-green-500 rounded-full text-xs font-medium status-confirmed">{{ $reservation->statut }}</span>
                                    @elseif($reservation->statut === 'Annulée')
                                    <span class="px-2 py-1 text-red-500 rounded-full text-xs font-medium status-canceled">{{ $reservation->statut }}</span>
                                    @elseif($reservation->statut === 'En attente')
                                    <span class="px-2 py-1 rounded-full text-xs font-medium status-pending">{{ $reservation->statut }}</span>
                                    @endif
                                </td>
                                <td class="py-4 px-6 font-medium text-sm">{{ $reservation->montant }} FCFA</td>
                                <td class="py-4 px-6 relative">
                                    <button class="text-blue-600 hover:text-blue-800 transition focus:outline-none" onclick="toggleActions(this)">
                                        <i class="ri-more-2-fill text-xl"></i>
                                    </button>

                                    @if ($reservation->statut === 'En cours')
                                    <div class="absolute right-0 mt-2 w-32 bg-white border border-gray-200 rounded-md shadow-lg z-10 hidden" data-actions-menu>
                                        <form action="{{ route('reservation.cancel', ['id'=>$reservation->id]) }}" method="POST" id="annuler-form-{{ $reservation->id }}" style="display: none;">
                                            @csrf
                                            <input type="hidden" name="reservation_id" value="{{ $reservation->id }}">
                                        </form>
                                        <a href="#" onclick="event.preventDefault(); document.getElementById('annuler-form-{{ $reservation->id }}').submit();" class="block px-4 py-2 text-sm text-red-600 hover:bg-gray-100">Annuler</a>

                                        <a href=""
                                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                            data-id="{{ $reservation->id }}"
                                            data-emplacement-id="{{ $reservation->emplacement->id }}"
                                            data-emplacement-nom="{{ $reservation->emplacement->nom }}"
                                            data-date-reserv="{{ $reservation->date_reserv }}"
                                            data-heure-debut="{{ $reservation->heure_debut }}"
                                            data-heure-fin="{{ $reservation->heure_fin }}"
                                            data-participants="{{ $reservation->participants }}"
                                            onclick="openEditModalFromButton(this)">
                                            Modifier
                                        </a>

                                        {{-- Bouton Payer --}}
                                        <button
                                            class="w-full text-left block px-4 py-2 text-sm text-blue-600 hover:bg-gray-100"
                                            data-reservation-id="{{ $reservation->id }}"
                                            data-amount="{{ $reservation->montant }}"
                                            data-email="{{ Auth::user()->email }}"
                                            data-name="{{ Auth::user()->name }}">
                                            Payer
                                        </button>
                                    </div>

                                    @elseif ($reservation->statut === 'Confirmée')
                                    <div class="absolute right-0 mt-2 w-32 bg-green-200 border border-green-400 rounded-md shadow-lg z-10 hidden" data-actions-menu>
                                        <a href="#"
                                            class="block px-4 py-2 text-sm text-green-800 hover:bg-green-300 download-receipt-link" {{-- Ajout d'une classe pour cibler --}}
                                            data-reservation-id="{{ $reservation->id }}"> {{-- Stocke l'ID de la réservation --}}
                                            Télécharger reçu
                                        </a>

                                        {{-- Le formulaire masqué pour la soumission POST --}}
                                        <form id="download-receipt-form-{{ $reservation->id }}"
                                            action="{{ route('reservation.recu', ["id"=>$reservation->id]) }}"
                                            method="POST"
                                            style="display: none;">
                                            @csrf {{-- Essentiel pour la sécurité Laravel --}}
                                            <input type="hidden" name="id_reservation" value="{{ $reservation->id }}">
                                        </form>
                                    </div>

                                    @elseif ($reservation->statut === 'Terminée')
                                    <div class="absolute right-0 mt-2 w-32 bg-white border border-gray-200 rounded-md shadow-lg z-10 hidden" data-actions-menu>
                                        <a href="" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 bg-green-100">Voir</a>
                                    </div>
                                    @endif
                                </td>

                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="bg-gray-50 px-6 py-4 border-t border-gray-200">
                    <div class="flex justify-between items-center">
                        <p class="text-sm text-gray-500" id="pagination-info">Affichage de 1 à 2 sur 2 réservations</p>
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

            const logoutLink = document.getElementById('logout-link');
            if (logoutLink) {
                logoutLink.addEventListener('click', function(event) {
                    event.preventDefault(); // Crucial pour empêcher tout comportement par défaut
                    document.getElementById('logout-form').submit(); // Soumet le formulaire de déconnexion
                });
            }   

            document.querySelectorAll('.download-receipt-link').forEach(link => {
            link.addEventListener('click', function(event) {
                event.preventDefault(); // Empêche le comportement par défaut du lien (le # dans le href)

                const reservationId = this.dataset.reservationId; // Récupère l'ID de la réservation depuis l'attribut data-*
                const form = document.getElementById(`download-receipt-form-${reservationId}`); // Trouve le formulaire correspondant par son ID unique

                if (form) {
                    form.submit(); // Soumet le formulaire
                } else {
                    console.error('Erreur : Formulaire de téléchargement de reçu introuvable pour la réservation ID:', reservationId);
                }
                });
            });
            
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
        });

        function toggleActions(button) {
            const parentTd = button.closest('td');
            const actionsMenu = parentTd.querySelector('[data-actions-menu]');

            actionsMenu.classList.toggle('hidden');

            document.querySelectorAll('[data-actions-menu]').forEach(menu => {
                if (menu !== actionsMenu && !menu.classList.contains('hidden')) {
                    menu.classList.add('hidden');
                }
            });
        }

        document.addEventListener('click', function(event) {
            if (!event.target.closest('[data-actions-menu]') && !event.target.closest('button.text-blue-600')) {
                document.querySelectorAll('[data-actions-menu]').forEach(menu => {
                    if (!menu.classList.contains('hidden')) {
                        menu.classList.add('hidden');
                    }
                });
            }
        });

        // Pagination Script
        document.addEventListener("DOMContentLoaded", () => {


            const tableBody = document.getElementById('reservations-table-body');
            const prevButton = document.getElementById('prev-page');
            const nextButton = document.getElementById('next-page');
            const paginationInfo = document.getElementById('pagination-info');
            const totalReservationsDisplay = document.getElementById('total-reservations-display');

            const rows = Array.from(tableBody.children);
            const itemsPerPage = 2;
            let currentPage = 0;
            const totalPages = Math.ceil(rows.length / itemsPerPage);

            const displayPage = (page) => {
                tableBody.innerHTML = ''; // Clear current rows
                const start = page * itemsPerPage;
                const end = start + itemsPerPage;
                const paginatedItems = rows.slice(start, end);

                paginatedItems.forEach(item => tableBody.appendChild(item));

                updatePaginationControls();
                updatePaginationInfo();
            };

            const updatePaginationControls = () => {
                prevButton.disabled = currentPage === 0;
                nextButton.disabled = currentPage === totalPages - 1;
            };

            const updatePaginationInfo = () => {
                const startItem = (currentPage * itemsPerPage) + 1;
                const endItem = Math.min((currentPage + 1) * itemsPerPage, rows.length);
                paginationInfo.textContent = `Affichage de ${startItem} à ${endItem} sur ${rows.length} réservations`;
                totalReservationsDisplay.textContent = rows.length;
            };

            prevButton.addEventListener('click', () => {
                if (currentPage > 0) {
                    currentPage--;
                    displayPage(currentPage);
                }
            });

            nextButton.addEventListener('click', () => {
                if (currentPage < totalPages - 1) {
                    currentPage++;
                    displayPage(currentPage);
                }
            });

            // Initial display
            displayPage(currentPage);
        });

        function updateReservationStatus(reservationId, status) {
            console.log(`Début mise à jour statut pour réservation ID ${reservationId} avec statut : ${status}`);

            if (!reservationId) {
                console.error("ID de réservation manquant pour la mise à jour du statut.");
                return;
            }

            fetch("/reservation/statut/" + reservationId, {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": '{{ csrf_token() }}',
                        "Accept": "application/json"
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
                        console.error("Erreur serveur:", data.message || "Impossible de mettre à jour le statut");
                    }
                })
                .catch(error => {
                    console.error("Erreur lors de la mise à jour du statut :", error);
                });
        }

        document.addEventListener('DOMContentLoaded', function() {
            // Gestion des boutons "Payer"
            document.addEventListener('click', function(event) {
                if (event.target.matches('[data-reservation-id]') && event.target.textContent.trim() === 'Payer') {
                    const button = event.target;
                    const reservationId = button.dataset.reservationId;
                    const amount = parseFloat(button.dataset.amount);
                    const email = button.dataset.email;
                    const name = button.dataset.name;
                    const firstName = name.split(' ')[0] || '';
                    const lastName = name.split(' ').slice(1).join(' ') || '';

                    console.log(`Paiement pour Réservation ID: ${reservationId}, Montant: ${amount}`);

                    if (!reservationId || isNaN(amount) || amount <= 0 || !email) {
                        alert("Erreur : Données de paiement invalides.");
                        return;
                    }

                    FedaPay.init(button, {
                        public_key: "pk_live_Xzoyr48Fxd0AjUrk3wVVF2so",
                        transaction: {
                            amount: amount,
                            description: `Paiement réservation BookWork #${reservationId}`
                        },
                        customer: {
                            email: email,
                            lastname: lastName,
                            firstname: firstName,
                        },
                        onComplete: function(response) {
                            console.log("Réponse FedaPay:", response);

                            if (response.transaction && response.transaction.status === 'approved') {
                                alert("✅ Paiement effectué avec succès !");
                                updateReservationStatus(reservationId, 'Confirmée');
                            } else {
                                alert("❌ Paiement annulé ou échoué.");
                            }
                        }
                    });
                }
            });
        });

        function confirmLogout() {
            Swal.fire({
                title: 'Déconnexion',
                text: "Voulez-vous vraiment vous déconnecter ?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#f6ac0f', // orange (ton theme)
                cancelButtonColor: '#3085d6', // bleu
                confirmButtonText: 'Oui, déconnecter',
                cancelButtonText: 'Annuler'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('logout-form').submit();
                }
            });
        }
    </script>

    @include('home/modal/update')
    @include('sweetalert::alert')
</body>

</html>