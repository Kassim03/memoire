<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard Administrateur | BookWork</title>

    <script src="https://cdn.tailwindcss.com/3.4.16"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#0f1a2c',
                        secondary: '#f6ac0f',
                        accentBlue: '#1777ff',
                        textDark: '#0f1a2a',
                        textLight: '#64748b',
                        bodyBg: '#f0f2f5',
                        cardBg: '#f8fafc',
                    },
                    borderRadius: {
                        DEFAULT: '8px',
                        'button': '8px'
                    },
                    fontFamily: {
                        inter: ['Inter', 'sans-serif'],
                        playfair: ['Playfair Display', 'serif'],
                        poppins: ['Poppins', 'sans-serif'],
                    }
                }
            }
        }
    </script>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.min.css" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Playfair+Display:wght@400;700&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary-color: #0f1a2c;
            --secondary-color: #f6ac0f;
            --accent-blue: #1777ff;
            --text-dark: #0f1a2c;
            --text-light: #64748b;
            --body-background: #f0f2f5;
            --card-background: #f8fafc;
            --secondary-color-rgb: 246, 172, 15;
        }

        * {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
        }

        body {
            font-family: "Poppins", sans-serif;
            color: var(--text-dark);
            background: var(--body-background);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            line-height: 1.6;
        }

        a {
            text-decoration: none;
            color: inherit;
        }

        ul {
            list-style: none;
        }

        img {
            width: 100%;
            display: flex;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-weight: 700;
            color: var(--primary-color);
        }

        .logo div {
            width: 42px;
            height: 42px;
            background: var(--secondary-color);
            color: var(--primary-color);
            display: grid;
            place-content: center;
            border-radius: 0.4rem;
            font-family: 'Playfair Display', serif;
            font-size: 1.1rem;
        }

        .logo span {
            line-height: 1.1;
            font-family: 'Playfair Display', serif;
        }

        .sidebar-link.active {
            background-color: rgba(var(--secondary-color-rgb), 0.1);
            color: var(--secondary-color);
            border-left: 3px solid var(--secondary-color);
        }

        .sidebar-link:hover:not(.active) {
            background-color: rgba(0, 0, 0, 0.05);
        }

        .content-section {
            display: none;
            animation: fadeIn 0.5s ease-in;
        }

        .content-section.active {
            display: block;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .tab-button.active {
            border-bottom-color: var(--secondary-color);
            color: var(--secondary-color);
        }

        .room__grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 2rem;
        }

        .room__card {
            background: var(--card-background);
            border-radius: 1rem;
            overflow: hidden;
            box-shadow: 0 12px 28px rgba(0, 0, 0, 0.08);
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .room__card:hover {
            transform: translateY(-6px);
            box-shadow: 0 20px 32px rgba(0, 0, 0, 0.12);
        }

        .room__card img {
            height: 200px;
            object-fit: cover;
        }

        .room_card_details {
            padding: 1.2rem 1.4rem 1.8rem;
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .room_card_details h4 {
            color: var(--primary-color);
        }

        .room_card_details h3 {
            font-size: 1.2rem;
            color: var(--secondary-color);
        }

        .room_card_details h3 span {
            font-size: 0.8rem;
            font-weight: 500;
            color: var(--text-light);
        }

        .footer {
            background-color: var(--primary-color);
            color: var(--card-background);
            padding: 3rem 1.5rem 1rem;
            margin-top: auto;
        }

        .footer_container {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 2rem;
        }

        .footer__col h4 {
            margin-bottom: 0.8rem;
            font-weight: 600;
        }

        .footer__logo {
            margin-bottom: 1rem;
            color: var(--card-background);
        }

        .footer__logo div {
            background-color: var(--secondary-color);
        }

        .footer__bar {
            margin-top: 2rem;
            text-align: center;
            font-size: 0.9rem;
            opacity: 0.75;
        }

        .bg-white {
            background-color: var(--card-background);
        }

        .text-white {
            color: var(--card-background);
        }

        .btn {
            color: var(--card-background);
            background-color: var(--secondary-color);
            padding: 0.75rem 2rem;
            border-radius: 5px;
        }

        .btn.bg-accentBlue {
            background-color: var(--accent-blue);
        }

        .btn.bg-red-600 {
            background-color: #dc2626;
        }

        /* Direct color for red */
        .slider:before {
            background-color: var(--card-background);
        }

        @media (width > 768px) {
            .md\:block {
                display: block !important;
            }

            .md\:ml-0 {
                margin-left: 0 !important;
            }

            .md\:hidden {
                display: none !important;
            }

            .room__grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (width > 1024px) {
            .room__grid {
                grid-template-columns: repeat(3, 1fr);
                gap: 2rem;
            }
        }
    </style>
</head>

<script>
    document.querySelectorAll('.action-btn').forEach(function (btn) {
        btn.addEventListener('click', function (e) {
            e.stopPropagation(); // Pour éviter de fermer instantanément
            // Fermer tous les autres menus
            document.querySelectorAll('.dropdown-container').forEach(function (container) {
                if (container !== btn.parentElement) {
                    container.classList.remove('show');
                }
            });
            // Ouvrir celui-ci
            btn.parentElement.classList.toggle('show');
        });
    });

    window.addEventListener('click', function () {
        document.querySelectorAll('.dropdown-container').forEach(function (container) {
            container.classList.remove('show');
        });
    });
</script>

<body class="bg-bodyBg">
    <div class="flex h-screen overflow-hidden">
        <aside class="w-64 bg-cardBg shadow-md hidden md:block">
            <div class="p-6 border-b">
                <a href="#" class="text-2xl font-['Playfair_Display'] text-primary flex items-center gap-2">
                    <div class="w-10 h-10 bg-secondary text-primary flex items-center justify-center rounded-md text-xl font-bold">BW</div>
                    <span>Book<br />Work</span>
                </a>
            </div>
            <div class="py-4">
                <div class="px-6 py-3 text-xs font-semibold text-gray-400 uppercase">Menu Principal</div>
                <nav>
                    <a href="/Tableaudebord" class="sidebar-link active flex items-center px-6 py-3 text-gray-700 hover:text-secondary transition-colors duration-200" data-target="dashboard-content">
                        <div class="w-5 h-5 flex items-center justify-center mr-3 text-current"><i class="ri-dashboard-line"></i></div><span>Tableau de bord</span>
                    </a>
                    <a href="#/Reservations" class="sidebar-link flex items-center px-6 py-3 text-gray-700 hover:text-secondary transition-colors duration-200" data-target="reservations-content">
                        <div class="w-5 h-5 flex items-center justify-center mr-3 text-current"><i class="ri-calendar-line"></i></div><span>Réservations</span>
                    </a>
                    <a href="/Emplacements" class="sidebar-link flex items-center px-6 py-3 text-gray-700 hover:text-secondary transition-colors duration-200" data-target="emplacements-content">
                        <div class="w-5 h-5 flex items-center justify-center mr-3 text-current"><i class="ri-building-line"></i></div><span>Emplacements</span>
                    </a>
                    <a href="/Clients" class="sidebar-link flex items-center px-6 py-3 text-gray-700 hover:text-secondary transition-colors duration-200" data-target="clients-content">
                        <div class="w-5 h-5 flex items-center justify-center mr-3 text-current"><i class="ri-user-line"></i></div><span>Clients</span>
                    </a>


                </nav>

            </div>
        </aside>

        <div class="fixed inset-0 bg-black bg-opacity-50 z-40 hidden" id="sidebar-overlay"></div>
        <aside class="fixed top-0 left-0 h-full w-64 bg-cardBg shadow-md z-50 transform -translate-x-full transition-transform duration-300 md:hidden" id="mobile-sidebar">
            <div class="p-6 border-b flex justify-between items-center">
                <a href="#" class="text-2xl font-['Playfair_Display'] text-primary flex items-center gap-2">
                    <div class="w-10 h-10 bg-secondary text-primary flex items-center justify-center rounded-md text-xl font-bold">BW</div>
                    <span>Book<br />Work</span>
                </a>
                <button id="close-sidebar" class="text-gray-500 hover:text-gray-700">
                    <div class="w-6 h-6 flex items-center justify-center"><i class="ri-close-line"></i></div>
                </button>
            </div>
            <div class="py-4">
                <div class="px-6 py-3 text-xs font-semibold text-gray-400 uppercase">Menu Principal</div>
                <nav>
                    <a href="#" class="sidebar-link active flex items-center px-6 py-3 text-gray-700 hover:text-secondary transition-colors duration-200" data-target="dashboard-content">
                        <div class="w-5 h-5 flex items-center justify-center mr-3 text-current"><i class="ri-dashboard-line"></i></div><span>Tableau de bord</span>
                    </a>
                    <a href="#" class="sidebar-link flex items-center px-6 py-3 text-gray-700 hover:text-secondary transition-colors duration-200" data-target="reservations-content">
                        <div class="w-5 h-5 flex items-center justify-center mr-3 text-current"><i class="ri-calendar-line"></i></div><span>Réservations</span>
                    </a>
                    <a href="#" class="sidebar-link flex items-center px-6 py-3 text-gray-700 hover:text-secondary transition-colors duration-200" data-target="emplacements-content">
                        <div class="w-5 h-5 flex items-center justify-center mr-3 text-current"><i class="ri-building-line"></i></div><span>Emplacements</span>
                    </a>
                    <a href="#" class="sidebar-link flex items-center px-6 py-3 text-gray-700 hover:text-secondary transition-colors duration-200" data-target="clients-content">
                        <div class="w-5 h-5 flex items-center justify-center mr-3 text-current"><i class="ri-user-line"></i></div><span>Clients</span>
                    </a>


                </nav>

            </div>
        </aside>

        <div class="flex-1 flex flex-col overflow-hidden">
            <header class="bg-cardBg shadow-sm">
                <div class="flex items-center justify-between px-6 py-3">
                    <div class="flex items-center">
                        <button id="toggle-sidebar" class="text-gray-500 hover:text-gray-700 md:hidden">
                            <div class="w-6 h-6 flex items-center justify-center"><i class="ri-menu-line"></i></div>
                        </button>
                        <h1 class="text-xl font-semibold text-gray-800 ml-4 md:ml-0" id="main-content-title">Tableau de bord Administrateur</h1>
                    </div>
                    <div class="flex items-center space-x-4">
                        <div class="relative group">
                            <button class="flex items-center space-x-2 focus:outline-none">
                                <div class="w-8 h-8 bg-gray-200 rounded-full flex items-center justify-center">
                                    <div class="w-8 h-8 flex items-center justify-center text-gray-500"><i class="ri-user-line"></i></div>
                                </div>
                                <span class="text-gray-700 hidden md:block">Admin</span>
                                <div class="w-5 h-5 flex items-center justify-center text-gray-500"><i class="ri-arrow-down-s-line"></i></div>
                            </button>
                            <div class="absolute right-0 top-full pt-2 w-48 bg-cardBg rounded-md shadow-lg py-1 z-10 hidden group-hover:block">
                                <a href="/AdminProfil" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Mon profil</a>
                                <a href="/Logout" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Déconnexion </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>


                            </div>
                        </div>
                    </div>
                </div>
            </header>
            

            <main class="flex-1 overflow-y-auto p-6">
                <div id="dashboard-content" class="content-section active">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
                        <div class="bg-cardBg rounded-lg shadow-sm p-4">
                            <p class="text-gray-500 text-sm">Réservations</p>
                            <h3 class="text-xl font-bold text-gray-800" id="reservations-count">{{ $nbre_reserv }}</h3>
                        </div>
                        <div class="bg-cardBg rounded-lg shadow-sm p-4">
                            <p class="text-gray-500 text-sm">Revenus</p>
                            <h3 class="text-xl font-bold text-gray-800" id="revenue-count">{{$revenu_total}}</h3>
                        </div>
                        
                        <div class="bg-cardBg rounded-lg shadow-sm p-4">
                            <p class="text-gray-500 text-sm">Utilisateurs</p>
                            <h3 class="text-xl font-bold text-gray-800" id="users-count">{{ $nbre_users }}</h3>
                        </div>
                    </div>

                    <div class="bg-cardBg rounded-lg shadow-sm mb-6">
                        <div class="border-b">
                            <div class="flex overflow-x-auto">
                                <button class="tab-button active px-6 py-3 text-gray-700 hover:text-secondary border-b-2 border-transparent hover:border-secondary focus:outline-none whitespace-nowrap" data-tab="overview-tab">Vue d'ensemble</button>
                                <button class="tab-button px-6 py-3 text-gray-700 hover:text-secondary border-b-2 border-transparent hover:border-secondary focus:outline-none whitespace-nowrap" data-tab="recent-reservations-dashboard-tab">Réservations récentes</button>
                            </div>
                        </div>
                        <div class="p-6">
                            <div class="tab-content active" id="overview-tab">
                                <h3 class="text-lg font-semibold text-gray-800 mb-4">Aperçu rapide</h3>
                                <p class="text-gray-600">Statistiques clés de votre activité.</p>
                            </div>
                            <div class="tab-content" id="recent-reservations-dashboard-tab">
                                <h3 class="text-lg font-semibold text-gray-800 mb-4">Réservations récentes</h3>
                                <table class="min-w-full bg-cardBg border border-gray-200 rounded-lg">
                                    <thead>
                                        <tr class="bg-orange-100 from-blue-600 to-purple-600 text-bleu"> {{-- En-tête avec un dégradé --}}
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email Client</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Emplacement</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date de reservation</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Statut</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Montant</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody id="recent-reservations-table-body">
                                        @forelse($recentPerClient as $reservation)
                                            <tr class="border-b border-gray-200 hover:bg-gray-50">
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                                    {{ $reservation->id }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                                    {{ $reservation->user->email ?? 'Inconnu' }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                                    {{ $reservation->emplacement->nom ?? 'Non défini' }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                                    {{ \Carbon\Carbon::parse($reservation->date_reserv)->format('d/m/Y') }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm">
                                                    <span class="inline-block px-2 py-1 text-xs font-semibold rounded-full
                                                        {{ $reservation->statut == 'confirmée' ? 'text-green-700 bg-green-100' : 'text-yellow-700 bg-yellow-100' }}">
                                                        {{ ucfirst($reservation->statut) }}
                                                    </span>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                                    {{ number_format($reservation->montant, 0, ',', ' ') }} CFA
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm">
                                                    <a href="{{ route('reservations.show', $reservation->id) }}" 
                                                    class="text-blue-600 hover:text-blue-800 hover:underline font-medium">
                                                        Voir
                                                    </a>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="7" class="text-center px-6 py-4 text-sm text-gray-500 italic">
                                                    Aucune réservation trouvée.
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>

                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="reservations-content" class="content-section">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-semibold text-gray-800">Liste des Réservations</h3>
                    </div>
                    <table class="min-w-full bg-cardBg border border-gray-200 rounded-lg">
                        <thead>
                            <tr class="bg-orange-100 from-blue-600 to-purple-600 text-bleu"> {{-- En-tête avec un dégradé --}}
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">id</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nom de la salle</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email clients</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nombre de participants</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">commentaire</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">montant</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date de reservation</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Heure d'arrivee</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Heure de depart</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Statut</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>

                        <tbody id="reservations-table-body" class="bg-white divide-y divide-gray-200"></tbody>
                       @foreach ($reservations as $reservation)
                                <tr class="hover:bg-gray-50 transition duration-150 ease-in-out">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">{{ $reservation->id }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">{{ optional($reservation->emplacement)->nom ?? '—' }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">{{ optional($reservation->user)->email ?? '—' }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">{{ $reservation->participants ?? '—' }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">{{ $reservation->commentaires ?? '—' }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">{{ $reservation->montant ?? '—' }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">{{ $reservation->date_reserv ?? '—' }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">{{ $reservation->heure_debut ?? '—' }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">{{ $reservation->heure_fin ?? '—' }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">{{ $reservation->statut ?? '—' }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <div class="flex items-center space-x-2">
                                            {{-- Voir --}}
                                            <a href="/Reservation/Voir/{{ $reservation->id }}" class="text-blue-600 hover:text-blue-900" title="Voir les détails">
                                                <i class="fas fa-eye"></i>
                                            </a>

                                            {{-- Modifier --}}
                                            <a href="/Reservation/Modifier/{{ $reservation->id }}" title="Modifier">
                                                <button class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded text-sm">
                                                    Modifier
                                                </button>
                                            </a>

                                            {{-- Supprimer --}}
                                            <form action="/Reservation/Supprimer/{{ $reservation->id }}" method="POST" onsubmit="return confirm('Confirmer la suppression ?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-sm">
                                                    Supprimer
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>

                <div id="emplacements-content" class="content-section">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-semibold text-gray-800">Gestion des Emplacements</h3>
                        <button id="add-emplacement-btn" class="bg-secondary text-cardBg px-4 py-2 rounded-lg hover:bg-opacity-90 transition-colors duration-200 !rounded-button whitespace-nowrap">
                            <div class="flex items-center">
                                <a href="{{ route('emplacements.create') }}" id="add-emplacement-btn" class="bg-secondary text-cardBg px-4 py-2 rounded-lg hover:bg-opacity-90 transition-colors duration-200 !rounded-button whitespace-nowrap inline-block">
                        <div class="flex items-center">
                            <div class="w-4 h-4 flex items-center justify-center mr-1"><i class="ri-add-line"></i></div>
                            <span>Ajouter un emplacement</span>
                        </div>
                    </a>

                            </div>
                        </button>
                    </div>
                    <table class="min-w-full bg-cardBg border border-gray-200 rounded-lg">
                        <thead>
                            <tr class="bg-orange-100 from-blue-600 to-purple-600 text-bleu"> {{-- En-tête avec un dégradé --}}
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID Emplacement</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nom</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Capacités</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tarif_hr</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="emplacements-table-body" class="bg-white divide-y divide-gray-200">

                            @foreach ($emplacements as $emplacement)

                            <tr class="hover:bg-gray-50 transition duration-150 ease-in-out">

                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $emplacement->id }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">{{ $emplacement->nom }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">{{ $emplacement->type }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">{{ $emplacement->capacites  }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">{{ $emplacement->tarif_hr }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <div class="flex items-center space-x-2">

                                        {{-- Voir --}}
                                        <a href="/Emplacement/Voir/{{ $emplacement->id }}" class="text-blue-600 hover:text-blue-900" title="Voir les détails">
                                            <i class="fas fa-eye"></i>
                                        </a>

                                        {{-- Modifier --}}
                                        <a href="/Emplacement/Modifier/{{ $emplacement->id }}" title="Modifier">
                                            <button class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded text-sm">
                                                Modifier
                                            </button>
                                        </a>

                                        {{-- Supprimer --}}
                                        <form action="/Emplacement/Supprimer/{{ $emplacement->id }}" method="POST" onsubmit="return confirm('Confirmer la suppression ?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-sm">
                                                Supprimer
                                            </button>
                                        </form>
                                    </div>
                                </td>

                            </tr>
                            @endforeach

                            @if ($emplacements->isEmpty())
                            <tr>
                                <td colspan="7" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">Aucun emplacement trouvé.</td>
                            </tr>
                            @endif
                        </tbody>


                    </table>
                </div>

                <div id="clients-content" class="content-section">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-semibold text-gray-800">Gestion des Clients</h3>
                    </div>
                    <div class="overflow-x-auto shadow-lg rounded-lg"> {{-- Ajouté un conteneur pour le défilement horizontal sur petits écrans et une ombre --}}
                        <table class="min-w-full bg-cardBg border border-gray-200 rounded-lg divide-y divide-gray-200">
                            <thead>
                                <tr class="bg-orange-100 from-blue-600 to-purple-600 text-bleu"> {{-- En-tête avec un dégradé --}}
                                    <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider rounded-tl-lg">ID Client</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider">Nom Complet</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider">Email</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider">Téléphone</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider">Total Réservations</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider">Dernière Réservation</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider rounded-tr-lg">Actions</th>
                                </tr>
                            </thead>
                            <tbody id="clients-table-body" class="bg-white divide-y divide-gray-200">

                                @foreach ($users as $user)
                                <tr class="hover:bg-gray-50 transition duration-150 ease-in-out"> {{-- Effet hover pour les lignes --}}
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $user->id }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">{{ $user->name }} {{ $user->surname }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">{{ $user->email }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">{{ $user->telephone }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">
                                        {{-- Remplacez ceci par le nombre réel de réservations de l'utilisateur --}}
                                        {{ $user->reservations_count ?? 0 }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">
                                        {{-- Remplacez ceci par la date de dernière réservation de l'utilisateur --}}
                                        @if ($user->latestReservation && $user->latestReservation->emplacement)
                                            {{ $user->latestReservation->emplacement->nom }}
                                        @else
                                            Aucune réservation
                                        @endif

                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        {{-- Boutons d'action pour chaque utilisateur --}}
                                        <div class="flex items-center space-x-2">
                                            <a href="/VoirDetails" class="text-blue-600 hover:text-blue-900" title="Voir les détails">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="/Nodifier" class="text-yellow-600 hover:text-yellow-900" title="Modifier">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="/Supprimer" class="text-red-600 hover:text-red-900" title="Supprimer">
                                                <i class="fas fa-trash-alt"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach

                                @if ($users->isEmpty())
                                <tr>
                                    <td colspan="7" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">Aucun utilisateur trouvé.</td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>



                <div id="utilisateurs-content" class="content-section">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-semibold text-gray-800">Gestion des Utilisateurs</h3>
                        <button id="add-user-btn" class="bg-secondary text-cardBg px-4 py-2 rounded-lg hover:bg-opacity-90 transition-colors duration-200 !rounded-button whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="w-4 h-4 flex items-center justify-center mr-1"><i class="ri-user-add-line"></i></div>
                                <span>Ajouter un utilisateur</span>
                            </div>
                        </button>
                    </div>
                    <table class="min-w-full bg-cardBg border border-gray-200 rounded-lg">
                        <thead>
                            <tr class="bg-gray-50">
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID Utilisateur</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nom Complet</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Rôle</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Statut</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date Création</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="users-table-body">
                        </tbody>
                    </table>
                </div>

                <div id="parametres-content" class="content-section">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Paramètres du Système</h3>
                    <p class="text-gray-600 mb-4">Configurez les options générales de l'application.</p>
                    <div class="flex flex-wrap gap-4">
                        <button class="bg-secondary text-cardBg px-4 py-2 rounded-lg hover:bg-opacity-90 transition-colors duration-200 !rounded-button">Paramètres de Paiement</button>
                        <button class="bg-secondary text-cardBg px-4 py-2 rounded-lg hover:bg-opacity-90 transition-colors duration-200 !rounded-button">Préférences de Notification</button>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <footer>
        <div class="footer_container">
            <div class="footer__col">
                <div class="logo footer__logo">
                    <div>BW</div>
                    <span>Book<br />Work</span>
                </div>
                <p>Réservez rapidement vos salles ou espaces modernes.</p>
            </div>
            <div class="footer__col">
                <h4>Contact</h4>
                <p>Email: info@bookwork.com</p>
                <p>Téléphone: +229 01 64 32 12 08</p>
            </div>
        </div>
        <div class="footer__bar">Copyright © 2025 BookWork. Tous droits réservés.</div>
    </footer>

    <script type="module">
        // Firebase SDK imports
        import {
            initializeApp
        } from "https://www.gstatic.com/firebasejs/11.6.1/firebase-app.js";
        import {
            getAuth,
            signInAnonymously,
            signInWithCustomToken,
            onAuthStateChanged
        } from "https://www.gstatic.com/firebasejs/11.6.1/firebase-auth.js";
        import {
            getFirestore,
            collection,
            onSnapshot,
            addDoc,
            updateDoc,
            deleteDoc,
            doc
        } from "https://www.gstatic.com/firebasejs/11.6.1/firebase-firestore.js";

        // Global Firebase variables (provided by Canvas environment)
        const appId = typeof __app_id !== 'undefined' ? __app_id : 'default-app-id';
        const firebaseConfig = typeof __firebase_config !== 'undefined' ? JSON.parse(__firebase_config) : {};
        const initialAuthToken = typeof __initial_auth_token !== 'undefined' ? __initial_auth_token : null;

        // Initialize Firebase
        let app;
        let db;
        let auth;
        let userId = null;
        let isAuthReady = false;

        try {
            app = initializeApp(firebaseConfig);
            db = getFirestore(app);
            auth = getAuth(app);

            onAuthStateChanged(auth, async (user) => {
                if (user) {
                    userId = user.uid;
                    console.log("Authenticated with Firebase. User ID:", userId);
                    // Display user ID on the dashboard (optional)
                    const adminSpan = document.querySelector('header .text-gray-700');
                    if (adminSpan) {
                        adminSpan.textContent = `Admin (${userId.substring(0, 8)}...)`;
                    }
                } else {
                    console.log("No user signed in. Signing in anonymously...");
                    try {
                        if (initialAuthToken) {
                            await signInWithCustomToken(auth, initialAuthToken);
                        } else {
                            await signInAnonymously(auth);
                        }
                    } catch (error) {
                        console.error("Firebase authentication failed:", error);
                    }
                }
                isAuthReady = true;
                // Once auth is ready, load data
                if (isAuthReady) {
                    loadAllData();
                }
            });

        } catch (error) {
            console.error("Failed to initialize Firebase:", error);
        }

        // --- Data Rendering Functions ---

        function renderRecentReservationsTable(reservations) {
            const tbody = document.getElementById('recent-reservations-table-body');
            if (!tbody) return;
            tbody.innerHTML = ''; // Clear existing rows

            reservations.slice(0, 2).forEach(reservation => { // Limit to 2 recent reservations for dashboard
                const row = `
                    <tr class="border-b border-gray-200">
                        <td class="px-6 py-4">${reservation.id}</td>
                        <td class="px-6 py-4">${reservation.client}</td>
                        <td class="px-6 py-4">${reservation.emplacement}</td>
                        <td class="px-6 py-4">${reservation.date}</td>
                        <td class="px-6 py-4"><span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full ${reservation.statut === 'Confirmée' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800'}">${reservation.statut}</span></td>
                        <td class="px-6 py-4">${reservation.montant} FCFA</td>
                        <td class="px-6 py-4 flex space-x-2">
                            <a href="#" class="text-secondary hover:text-secondary-dark text-sm" onclick="handleAction('voir', 'reservations', '${reservation.id}')">Voir</a>
                            <a href="#" class="text-accentBlue hover:text-accentBlue-dark text-sm" onclick="handleAction('modifier', 'reservations', '${reservation.id}')">Modifier</a>
                            <a href="#" class="text-red-600 hover:text-red-900 text-sm" onclick="handleAction('annuler', 'reservations', '${reservation.id}')">Annuler</a>
                            <a href="#" class="text-red-600 hover:text-red-900 text-sm" onclick="handleAction('supprimer', 'reservations', '${reservation.id}')">Supprimer</a>
                        </td>
                    </tr>
                `;
                tbody.insertAdjacentHTML('beforeend', row);
            });
        }

        function renderReservationsTable(reservations) {
            const tbody = document.getElementById('reservations-table-body');
            if (!tbody) return;
            tbody.innerHTML = ''; // Clear existing rows

            reservations.forEach(reservation => {
                const row = `
                    <tr class="border-b border-gray-200">
                        <td class="px-6 py-4">${reservation.id}</td>
                        <td class="px-6 py-4">${reservation.client}</td>
                        <td class="px-6 py-4">${reservation.emplacement}</td>
                        <td class="px-6 py-4">${reservation.dateDebut}</td>
                        <td class="px-6 py-4">${reservation.dateFin}</td>
                        <td class="px-6 py-4">${reservation.heureDebut}</td>
                        <td class="px-6 py-4">${reservation.heureFin}</td>
                        <td class="px-6 py-4"><span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full ${reservation.statut === 'Confirmée' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800'}">${reservation.statut}</span></td>
                        <td class="px-6 py-4">${reservation.montantTotal} FCFA</td>
                        <td class="px-6 py-4 flex space-x-2">
                            <a href="#" class="text-secondary hover:text-secondary-dark text-sm" onclick="handleAction('voir', 'reservations', '${reservation.id}')">Voir</a>
                            <a href="#" class="text-accentBlue hover:text-accentBlue-dark text-sm" onclick="handleAction('modifier', 'reservations', '${reservation.id}')">Modifier</a>
                            <a href="#" class="text-red-600 hover:text-red-900 text-sm" onclick="handleAction('annuler', 'reservations', '${reservation.id}')">Annuler</a>
                            <a href="#" class="text-red-600 hover:text-red-900 text-sm" onclick="handleAction('supprimer', 'reservations', '${reservation.id}')">Supprimer</a>
                        </td>
                    </tr>
                `;
                tbody.insertAdjacentHTML('beforeend', row);
            });
        }

        function renderEmplacementsTable(emplacements) {
            const tbody = document.getElementById('emplacements-table-body');
            if (!tbody) return;
            tbody.innerHTML = ''; // Clear existing rows

            emplacements.forEach(emplacement => {
                const row = `
                    <tr class="border-b border-gray-200">
                        <td class="px-6 py-4">${emplacement.id}</td>
                        <td class="px-6 py-4">${emplacement.nom}</td>
                        <td class="px-6 py-4">${emplacement.type}</td>
                        <td class="px-6 py-4">${emplacement.capacite}</td>
                        <td class="px-6 py-4">${emplacement.prixParJour} FCFA</td>
                        <td class="px-6 py-4">${emplacement.disponibilite ? 'Oui' : 'Non'}</td>
                        <td class="px-6 py-4 flex space-x-2">
                            <a href="#" class="text-secondary hover:text-secondary-dark text-sm" onclick="handleAction('voir', 'emplacements', '${emplacement.id}')">Voir</a>
                            <a href="#" class="text-accentBlue hover:text-accentBlue-dark text-sm" onclick="handleAction('modifier', 'emplacements', '${emplacement.id}')">Modifier</a>
                            <a href="#" class="text-red-600 hover:text-red-900 text-sm" onclick="handleAction('supprimer', 'emplacements', '${emplacement.id}')">Supprimer</a>
                        </td>
                    </tr>
                `;
                tbody.insertAdjacentHTML('beforeend', row);
            });
        }

        function renderClientsTable(clients) {
            const tbody = document.getElementById('clients-table-body');
            if (!tbody) return;
            tbody.innerHTML = ''; // Clear existing rows

            clients.forEach(client => {
                const row = `
                    <tr class="border-b border-gray-200">
                        <td class="px-6 py-4">${client.id}</td>
                        <td class="px-6 py-4">${client.nomComplet}</td>
                        <td class="px-6 py-4">${client.email}</td>
                        <td class="px-6 py-4">${client.telephone}</td>
                        <td class="px-6 py-4">${client.totalReservations}</td>
                        <td class="px-6 py-4">${client.derniereReservation}</td>
                        <td class="px-6 py-4 flex space-x-2">
                            <a href="#" class="text-secondary hover:text-secondary-dark text-sm" onclick="handleAction('voir', 'clients', '${client.id}')">Voir</a>
                            <a href="#" class="text-accentBlue hover:text-accentBlue-dark text-sm" onclick="handleAction('modifier', 'clients', '${client.id}')">Modifier</a>
                            <a href="#" class="text-red-600 hover:text-red-900 text-sm" onclick="handleAction('supprimer', 'clients', '${client.id}')">Supprimer</a>
                        </td>
                    </tr>
                `;
                tbody.insertAdjacentHTML('beforeend', row);
            });
        }

        function renderUsersTable(users) {
            const tbody = document.getElementById('users-table-body');
            if (!tbody) return;
            tbody.innerHTML = ''; // Clear existing rows

            users.forEach(user => {
                const row = `
                    <tr class="border-b border-gray-200">
                        <td class="px-6 py-4">${user.id}</td>
                        <td class="px-6 py-4">${user.nomComplet}</td>
                        <td class="px-6 py-4">${user.email}</td>
                        <td class="px-6 py-4">${user.role}</td>
                        <td class="px-6 py-4">${user.statut}</td>
                        <td class="px-6 py-4">${user.dateCreation}</td>
                        <td class="px-6 py-4 flex space-x-2">
                            <a href="#" class="text-secondary hover:text-secondary-dark text-sm" onclick="handleAction('voir', 'users', '${user.id}')">Voir</a>
                            <a href="#" class="text-accentBlue hover:text-accentBlue-dark text-sm" onclick="handleAction('modifier', 'users', '${user.id}')">Modifier</a>
                            <a href="#" class="text-red-600 hover:text-red-900 text-sm" onclick="handleAction('supprimer', 'users', '${user.id}')">Supprimer</a>
                        </td>
                    </tr>
                `;
                tbody.insertAdjacentHTML('beforeend', row);
            });
        }

        // --- Firestore Data Loading ---

        function loadAllData() {
            if (!isAuthReady || !db) {
                console.warn("Firebase not ready for data loading.");
                return;
            }

            // Load Reservations and update count
            onSnapshot(collection(db, `artifacts/${appId}/public/data/reservations`), (snapshot) => {
                const reservations = snapshot.docs.map(doc => ({
                    id: doc.id,
                    ...doc.data()
                }));
                document.getElementById('reservations-count').textContent = reservations.length;
                renderRecentReservationsTable(reservations);
                renderReservationsTable(reservations);
            }, (error) => {
                console.error("Error loading reservations:", error);
            });

            // Load Emplacements
            onSnapshot(collection(db, `artifacts/${appId}/public/data/emplacements`), (snapshot) => {
                const emplacements = snapshot.docs.map(doc => ({
                    id: doc.id,
                    ...doc.data()
                }));
                renderEmplacementsTable(emplacements);
            }, (error) => {
                console.error("Error loading emplacements:", error);
            });

            // Load Clients
            onSnapshot(collection(db, `artifacts/${appId}/public/data/clients`), (snapshot) => {
                const clients = snapshot.docs.map(doc => ({
                    id: doc.id,
                    ...doc.data()
                }));
                renderClientsTable(clients);
            }, (error) => {
                console.error("Error loading clients:", error);
            });

            // Load Users and update count
            onSnapshot(collection(db, `artifacts/${appId}/public/data/users`), (snapshot) => {
                const users = snapshot.docs.map(doc => ({
                    id: doc.id,
                    ...doc.data()
                }));
                document.getElementById('users-count').textContent = users.length;
                renderUsersTable(users);
            }, (error) => {
                console.error("Error loading users:", error);
            });
        }

        // --- Action Handlers (Simulated) ---

        window.handleAction = async (action, entity, id) => {
            console.log(`Action: ${action} sur ${entity} avec l'ID: ${id}`);
            const entityRef = doc(db, `artifacts/${appId}/public/data/${entity}`, id);

            try {
                if (action === 'voir') {
                    console.log(`Afficher les détails de ${entity} ${id}`);
                    // In a real app, this would open a modal or navigate to a detail page
                } else if (action === 'modifier') {
                    console.log(`Modifier ${entity} ${id}`);
                    // In a real app, this would open a form to edit the data
                    // Example: await updateDoc(entityRef, { fieldToUpdate: newValue });
                } else if (action === 'annuler') { // Specific for reservations
                    console.log(`Annuler la réservation ${id}`);
                    // Example: await updateDoc(entityRef, { statut: 'Annulée' });
                } else if (action === 'supprimer') {
                    console.log(`Supprimer ${entity} ${id}`);
                    // Example: await deleteDoc(entityRef);
                }
            } catch (error) {
                console.error(`Erreur lors de l'action ${action} sur ${entity} ${id}:`, error);
            }
        };

        // --- Add Data Functionality (Simulated) ---

        document.addEventListener('DOMContentLoaded', () => {
            // Existing sidebar and tab logic
            const toggleSidebar = document.getElementById('toggle-sidebar');
            const closeSidebar = document.getElementById('close-sidebar');
            const mobileSidebar = document.getElementById('mobile-sidebar');
            const sidebarOverlay = document.getElementById('sidebar-overlay');

            if (toggleSidebar) {
                toggleSidebar.addEventListener('click', () => {
                    mobileSidebar.classList.remove('-translate-x-full');
                    sidebarOverlay.classList.remove('hidden');
                });
            }
            if (closeSidebar) {
                closeSidebar.addEventListener('click', () => {
                    mobileSidebar.classList.add('-translate-x-full');
                    sidebarOverlay.classList.add('hidden');
                });
            }
            if (sidebarOverlay) {
                sidebarOverlay.addEventListener('click', () => {
                    mobileSidebar.classList.add('-translate-x-full');
                    sidebarOverlay.classList.add('hidden');
                });
            }

            const sidebarLinks = document.querySelectorAll('.sidebar-link');
            const contentSections = document.querySelectorAll('.content-section');
            const mainContentTitle = document.getElementById('main-content-title');
            const tabButtons = document.querySelectorAll('.tab-button');

            function showContent(targetId, title) {
                contentSections.forEach(section => {
                    section.classList.remove('active');
                });
                const targetSection = document.getElementById(targetId);
                if (targetSection) {
                    targetSection.classList.add('active');
                    mainContentTitle.textContent = title;
                }
            }

            function activateSidebarLink(clickedLink) {
                sidebarLinks.forEach(link => {
                    link.classList.remove('active');
                });
                clickedLink.classList.add('active');
            }

            sidebarLinks.forEach(link => {
                link.addEventListener('click', (e) => {
                    if (link.dataset.target) {
                        e.preventDefault();
                        activateSidebarLink(link);
                        const titleSpan = link.querySelector('span');
                        const newTitle = titleSpan ? titleSpan.textContent : 'Tableau de bord Administrateur';
                        showContent(link.dataset.target, newTitle);
                        mobileSidebar.classList.add('-translate-x-full');
                        sidebarOverlay.classList.add('hidden');
                    }
                });
            });

            tabButtons.forEach(button => {
                button.addEventListener('click', () => {
                    tabButtons.forEach(btn => {
                        btn.classList.remove('active', 'border-secondary', 'text-secondary');
                        btn.classList.add('border-transparent', 'text-gray-700');
                    });
                    document.querySelectorAll('.tab-content').forEach(content => content.classList.remove('active'));
                    const targetTab = button.dataset.tab;
                    button.classList.add('active', 'border-secondary', 'text-secondary');
                    button.classList.remove('border-transparent', 'text-gray-700');
                    document.getElementById(targetTab).classList.add('active');
                });
            });

            // Initial chart rendering (placeholders)
            function renderCharts() {
                const revenueChartCtx = document.getElementById('revenue-chart');
                if (revenueChartCtx) {
                    revenueChartCtx.innerHTML = '<div class="flex items-center justify-center h-full text-gray-400">Graphique des revenus</div>';
                }
                const occupancyChartCtx = document.getElementById('occupancy-chart');
                if (occupancyChartCtx) {
                    occupancyChartCtx.innerHTML = '<div class="flex items-center justify-center h-full text-gray-400">Graphique d\'occupation</div>';
                }
            }
            renderCharts();

            // Handle initial content display based on hash or default
            const initialHash = window.location.hash.substring(1);
            const defaultTarget = 'dashboard-content';
            const defaultTitle = 'Tableau de bord Administrateur';
            let activeTarget = initialHash || defaultTarget;
            let activeTitle = defaultTitle;

            if (initialHash) {
                const correspondingLink = document.querySelector(`.sidebar-link[data-target="${initialHash}"]`);
                if (correspondingLink) {
                    activeTitle = correspondingLink.querySelector('span').textContent;
                    activateSidebarLink(correspondingLink);
                }
            }
            showContent(activeTarget, activeTitle);


            // --- Add Data Button Handlers ---
            const addEmplacementBtn = document.getElementById('add-emplacement-btn');
            if (addEmplacementBtn) {
                addEmplacementBtn.addEventListener('click', async () => {
                    console.log("Ajouter un nouvel emplacement...");
                    // Simulate adding data
                    try {
                        await addDoc(collection(db, `artifacts/${appId}/public/data/emplacements`), {
                            nom: "Nouvel Espace",
                            type: "Bureau privé",
                            capacite: Math.floor(Math.random() * 5) + 1,
                            prixParJour: (Math.floor(Math.random() * 5) + 5) * 10000,
                            disponibilite: true
                        });
                        console.log("Nouvel emplacement ajouté (simulé)!");
                    } catch (e) {
                        console.error("Erreur lors de l'ajout de l'emplacement: ", e);
                    }
                });
            }

            const addUserBtn = document.getElementById('add-user-btn');
            if (addUserBtn) {
                addUserBtn.addEventListener('click', async () => {
                    console.log("Ajouter un nouvel utilisateur...");
                    // Simulate adding data
                    try {
                        await addDoc(collection(db, `artifacts/${appId}/public/data/users`), {
                            nomComplet: `Nouvel Utilisateur ${Math.floor(Math.random() * 1000)}`,
                            email: `user${Math.floor(Math.random() * 1000)}@example.com`,
                            role: "Client",
                            statut: "Actif",
                            dateCreation: new Date().toISOString().slice(0, 10)
                        });
                        console.log("Nouvel utilisateur ajouté (simulé)!");
                    } catch (e) {
                        console.error("Erreur lors de l'ajout de l'utilisateur: ", e);
                    }
                });
            }
        });
    </script>
</body>

</html>