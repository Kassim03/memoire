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
  <style>
    :root {
      /* Palette principale */
      --primary-color: #0f1a2c; /* Bleu nuit */
      --secondary-color: #f6ac0f; /* Orange vif */
      --accent-blue: #1777ff; /* Bleu vibrant */
      --text-dark: #0f172a;
      --text-light: #64748b;
      --extra-light: #f8fafc;
      --white: #ffffff;
    }

    /* RESET */
    *, *::before, *::after {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
      font-family: "Inter", sans-serif;
    }

    body {
      color: var(--text-dark);
      background: var(--extra-light);
      line-height: 1.6;
    }

    a { text-decoration: none; color: inherit; }
    ul { list-style: none; }

    /* ---------------- NAVBAR ---------------- */
    nav {
      width: 100%;
      background: var(--primary-color);
      color: var(--white);
      position: sticky;
      top: 0;
      z-index: 100;
    }

    .nav__bar {
      max-width: 1200px;
      margin: 0 auto;
      padding: 1rem 1.5rem;
      display: flex;
      align-items: center;
      justify-content: space-between;
    }

    .logo {
      display: flex;
      align-items: center;
      gap: 0.5rem;
      font-weight: 700;
    }

    .logo div {
      width: 42px;
      height: 42px;
      background: var(--secondary-color);
      color: var(--primary-color);
      display: grid;
      place-content: center;
      border-radius: 0.4rem;
      font-family: var(--header-font);
      font-size: 1.1rem;
    }

    .logo span {
      line-height: 1.1;
      font-family: var(--header-font);
    }

    .nav__links {
      display: flex;
      align-items: center;
      gap: 1.5rem;
      transition: max-height 0.4s ease;
    }

    .nav__links a {
      font-size: 0.95rem;
      font-weight: 600;
      transition: color 0.3s;
    }

    .nav__links a:hover { color: var(--secondary-color); }

    /* Hamburger */
    .nav__toggle {
      display: none;
      font-size: 1.5rem;
      cursor: pointer;
    }

    /* ---------------- HEADER ---------------- */
    .header {
      background: linear-gradient(135deg, var(--primary-color), var(--accent-blue));
      color: var(--white);
      padding: 4rem 1.5rem 5rem;
      text-align: center;
    }

    .header h1 {
      font-family: var(--header-font);
      font-size: 2.4rem;
      margin-bottom: 0.6rem;
    }

    .header p { opacity: 0.85; }

    /* ---------------- SECTION WRAPPER ---------------- */
    .section__header {
      font-family: var(--header-font);
      font-size: 1.8rem;
      margin-bottom: 1.3rem;
      color: var(--primary-color);
      text-align: center;
    }

    .room__container {
      max-width: 1200px;
      margin: -3rem auto 3rem;
      padding: 0 1.5rem;
    }

    .room__grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
      gap: 2rem;
    }

    /* ---------------- CARD ---------------- */
    .room__card {
      background: var(--white);
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
      width: 100%;
      height: 200px;
      object-fit: cover;
    }

    .room_card_details {
      padding: 1.2rem 1.4rem 1.8rem;
      display: flex;
      flex-direction: column;
      gap: 1rem;
    }

    .room_card_details h4 { color: var(--primary-color); }

    .room_card_details h3 {
      font-size: 1.2rem;
      color: var(--secondary-color);
    }

    .room_card_details h3 span {
      font-size: 0.8rem;
      font-weight: 500;
      color: var(--text-light);
    }

    /* Button */
    .btn {
      margin-top: auto;
      align-self: flex-start;
      background: var(--accent-blue);
      color: var(--white);
      padding: 0.7rem 1.4rem;
      border-radius: 0.5rem;
      font-weight: 600;
      transition: background 0.3s, transform 0.2s;
    }

    .btn:hover {
      background: var(--secondary-color);
      transform: translateY(-2px);
    }

    /* ---------------- FOOTER ---------------- */
    .footer {
      background: var(--primary-color);
      color: var(--white);
      padding: 3rem 1.5rem 1rem;
    }

    .footer_container {
      max-width: 1200px;
      margin: 0 auto;
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
      gap: 2rem;
    }

    .footer__col h4 { margin-bottom: 0.8rem; font-weight: 600; }

    .footer__logo { margin-bottom: 1rem; }

    .footer__bar {
      margin-top: 2rem;
      text-align: center;
      font-size: 0.9rem;
      opacity: 0.75;
    }

    /* ---------------- RESPONSIVE NAV ---------------- */
    @media (max-width: 768px) {
      .nav__toggle { display: block; }
      .nav__links {
        position: absolute;
        left: 0;
        top: 100%;
        width: 100%;
        background: var(--primary-color);
        flex-direction: column;
        max-height: 0;
        overflow: hidden;
      }
      .nav__links li { border-top: 1px solid rgba(255, 255, 255, 0.1); width: 100%; }
      .nav__links a { display: block; padding: 1rem 1.5rem; }
      .nav__links.show { max-height: 320px; }
    }
  </style>
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
        
        <li><a href="#salles">Salles</a></li>
        <li><a href="/profil">Profil</a></li>
        <li><a href="/historique">Historique</a></li>
        <li><a href="{{ route('logout') }}" id="logout-links">Déconnexion</a></li>
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
    <h2 class="section__header">Espaces  disponibles</h2>
    <div class="room__grid">
      <!-- CARD 1 -->
      <div class="room__card">
        <img src="assets/salle-1.jpg" alt="Salle Pro+" />
        <div class="room_card_details">
          <div>
            <h4>Salle Pro+</h4>
            <p>Un espace haut de gamme pour vos rencontres d'affaires.</p>
          </div>
          <h3>100.000 FCFA <span>/jour</span></h3>
          <a href="/reservation" class="btn">Réserver</a>
        </div>
      </div>
      <!-- CARD 2 -->
      <div class="room__card">
        <img src="assets/salle-2.jpg" alt="Salle Collaborative" />
        <div class="room_card_details">
          <div>
            <h4>Salle Collaborative</h4>
            <p>Parfaite pour le travail en groupe et la créativité.</p>
          </div>
          <h3>95.000 FCFA <span>/jour</span></h3>
          <a href="/reservation" class="btn">Réserver</a>
        </div>
      </div>
      <!-- CARD 3 -->
      <div class="room__card">
        <img src="assets/salle-3.jpg" alt="Salle Prestige" />
        <div class="room_card_details">
          <div>
            <h4>Salle Prestige</h4>
            <p>Un espace élégant pour vos événements professionnels.</p>
          </div>
          <h3>80.000 FCFA <span>/jour</span></h3>
          <a href="/reservation" class="btn">Réserver</a>
        </div>
      </div>
      <!-- CARD 4 -->
<div class="room__card">
  <img src="assets/salle-4.jpg" alt="Espace Nova" />
  <div class="room_card_details">
    <div>
      <h4>Espace Nova</h4>
      <p>Un lieu connecté pour des réunions productives et inspirantes.</p>
    </div>
    <h3>110.000 FCFA <span>/jour</span></h3>
    <a href="/reservation" class="btn">Réserver</a>
  </div>
</div>

<!-- CARD 5 -->
<div class="room__card">
  <img src="assets/salle-5.jpg" alt="Espace Fusion" />
  <div class="room_card_details">
    <div>
      <h4>Espace Fusion</h4>
      <p>Conçu pour stimuler l’innovation et le travail collaboratif.</p>
    </div>
    <h3>90.000 FCFA <span>/jour</span></h3>
    <a href="/reservation" class="btn">Réserver</a>
  </div>
</div>

<!-- CARD 6 -->
<div class="room__card">
  <img src="assets/salle-6.jpg" alt="Espace Élégance" />
  <div class="room_card_details">
    <div>
      <h4>Espace Élégance</h4>
      <p>Un cadre raffiné pour vos événements professionnels haut de gamme.</p>
    </div>
    <h3>75.000 FCFA <span>/jour</span></h3>
    <a href="/reservation" class="btn">Réserver</a>
  </div>
</div>

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

  <script>
    // Responsive nav toggle
    const navToggle = document.getElementById("nav-toggle");
    const navLinks = document.getElementById("nav-links");

    navToggle.addEventListener("click", () => {
      navLinks.classList.toggle("show");
      navToggle.innerHTML = navLinks.classList.contains("show")
        ? '<i class="ri-close-line"></i>'
        : '<i class="ri-menu-line"></i>';
    });

    // Simple logout simulation (placeholder)
    document.getElementById("logout-link").addEventListener("click", (e) => {
      e.preventDefault();
      alert("Vous êtes déconnecté.");
      // Rediriger vers la page de connexion si nécessaire
      // window.location.href = "/login";
    });
  </script>
</body>
</html>