<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Dashboard Client | BookWork</title>
  <!-- Remix Icons -->
  <link href="" rel="{{ asset('css/remixicon.css') }}" />
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Playfair+Display:wght@400;700&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
</head>

<body>
  <!-- NAVIGATION -->
  <nav>
    <div class="nav__bar">
      <div class="logo nav__logo">
        <div>BW</div>
        <span>Book<br />Work</span>
      </div>
      <ul class="nav__links" id="nav-links">

        <li><a href="#salles">Emplacements</a></li>
        <li><a href="/profil">Profil</a></li>
        <li>
          <a href="#" id="logout-link" onclick="confirmLogout(event)" class="btn-logout">Déconnexion</a>

          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">
            @csrf
          </form>
        </li>

      </ul>
      <div class="nav__toggle" id="nav-toggle"><i class="ri-menu-line"></i></div>
    </div>
  </nav>
  <!-- HERO HEADER -->
  <header class="header">
    <h1>Bienvenue sur votre espace client</h1>
    <p>Consultez et réservez rapidement les espaces disponibles.</p>
  </header>

  <!-- ROOMS SECTION -->
  <section class="room__container" id="salles">
    <h2 class="section__header">Emplacements disponibles</h2>
    <div class="room__grid">
      @foreach ($emplacements as $emplacement)
      <div class="room__card">
        <img src="{{ asset("assets/".$emplacement->image) }}" alt="{{ $emplacement->nom }}" />
        <div class="room_card_details">
          <div>
            <h4>{{ $emplacement->nom }}</h4>
            <p>{{ $emplacement->description }}</p>
          </div>
          <h3>{{ $emplacement->tarif_hr }}<span>/heure</span></h3>
          <a href="{{ route('reservation.show', $emplacement->id) }}" class="btn">Réserver</a>
        </div>
      </div>
      @endforeach

    </div>
  </section>


  <!-- FOOTER -->
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

  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
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

    // Responsive nav toggle
    const navToggle = document.getElementById("nav-toggle");
    const navLinks = document.getElementById("nav-links");

    navToggle.addEventListener("click", () => {
      navLinks.classList.toggle("show");
      navToggle.innerHTML = navLinks.classList.contains("show") ?
        '<i class="ri-close-line"></i>' :
        '<i class="ri-menu-line"></i>';
    });
  </script>
  @include('sweetalert::alert')
</body>

</html>