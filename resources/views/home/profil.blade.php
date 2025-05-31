<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Mon Profil | BookWork</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Playfair+Display:wght@400;700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/profil.css') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">
</head>

<body>
    <nav>
        <div class="nav__bar">
            <div class="logo nav__logo">
                <div>BW</div>
                <span>Book<br />Work</span>
            </div>
            <ul class="nav__links" id="nav-links">
                <li><a href="/dashboard">Accueil</a></li>
                <li><a href="/mesreservation">Historique</a></li>
                <li>
                    <a href="#" id="logout-link">Déconnexion</a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">
                        @csrf
                    </form>
                </li>
            </ul>
            <div class="nav__toggle" id="nav-toggle"><i class="ri-menu-line"></i></div>
        </div>
    </nav>

    <header class="header">
        </i></div>
        <h1>Bienvenue, {{ $user->name ?? 'Utilisateur' }} !</h1>
        <p>Gérez vos informations et activités.</p>
        
    </header>

    <section class="profile__container">
        <div class="profile__section">
            <h2>Mes Informations</h2>
            <div class="profile__details">
                <dl>
                    <dt>Nom :</dt>
                    <dd>{{ $user->name ?? 'Non défini' }}</dd>

                    <dt>Prénom :</dt>
                    <dd>{{ $user->surname ?? 'Non défini' }}</dd>

                    <dt>Email :</dt>
                    <dd>{{ $user->email ?? 'Non défini' }}</dd>

                    <dt>Téléphone :</dt>
                    <dd>{{ $user->telephone ?? 'Non défini' }}</dd>

                    <p>
                        @php

                        @endphp
                    </p>



                </dl>
            </div>
        </div>



        <div style="text-align: center; margin-top: 2.5rem;">
            <button id="editProfileBtn" class="btn bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg flex items-center gap-2 mx-auto transition-all duration-300 hover:shadow-lg">
            <i class="ri-edit-line"></i> Modifier le Profil
        </button>
        </div>
    </section>

    <footer class="footer">
        <div class="footer_container">
            <div class="footer__col">
                <div class="logo footer__logo">
                    <div>BW</div>
                    <span>BOOK<br />WORK</span>
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

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.getElementById('logout-link').addEventListener('click', function(event) {
            event.preventDefault();

            Swal.fire({
                title: 'Déconnexion',
                text: "Voulez-vous vraiment vous déconnecter ?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#f6ac0f', // orange thème
                cancelButtonColor: '#3085d6', // bleu
                confirmButtonText: 'Oui, déconnecter',
                cancelButtonText: 'Annuler'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('logout-form').submit();
                }
            });
        });
        document.addEventListener("DOMContentLoaded", () => {
            const navToggle = document.getElementById("nav-toggle");
            const navLinks = document.getElementById("nav-links");

            if (navToggle && navLinks) {
                navToggle.addEventListener("click", () => {
                    navLinks.classList.toggle("show");
                    navToggle.innerHTML = navLinks.classList.contains("show") ?
                        '<i class="ri-close-line"></i>' :
                        '<i class="ri-menu-line"></i>';
                });
            }
        });
    </script>
</body>

@include('home.modal.modal')
@include('sweetalert::alert')

</html>