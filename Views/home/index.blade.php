<!DOCTYPE html>

<html lang="fr">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="{{ asset("styles.css") }}" />
    <title>BookWork | Réservation d’espaces de travail</title>
    <style>
      
    </style>
  </head>
  <body>
    <nav>
      <div class="nav__bar">
        <div class="nav__header">
          <div class="logo nav__logo">
            <div>BW</div>
            <span>Book<br />Work</span>
          </div>
          <div class="nav__menu__btn" id="menu-btn">
            <i class="ri-menu-line"></i>
          </div>
        </div>
        <ul class="nav__links" id="nav-links">
          <li><a href="#home">Home</a></li>
          <li><a href="#about">About</a></li>
          <li><a href="#salles">Emplacements</a></li>
          <li><a href="#feature">Feature</a></li>
          <li><a href="#explorer">Explorer</a></li>
          <li><a href="/login">Login</a></li>
        </ul>
      </div>
    </nav>

<header class="header" id="home">
  <div class="section__container header__container">
   
    <h1>Le bon espace<br />Au bon moment</h1>
    
  </div>
</header>



<section class="about" id="about">
  <div class="section__container about__container">
    <div class="about__grid">
      <div class="about__image">
        <img src="assets/about-1.jpg" alt="about" />
      </div>
      <div class="about__card">
        <span><i class="ri-user-line"></i></span>
        <h4>Votre Réservation, Notre Priorité</h4>
        <p>
        Un service fiable pour vos besoins professionnels ponctuels.
        </p>
      </div>
      <div class="about__image">
        <img src="assets/about-2.jpeg" alt="about" />
      </div>
      <div class="about__card">
        <span><i class="ri-calendar-check-line"></i></span>
        <h4>Salles de luxe</h4>
        <p>Découvrez un luxe inégalé dans nos SALLES de luxe exquises</p>
      </div>
    </div>
    <div class="about__content">
      <p class="section__subheader">ABOUT US</p>
      <h2 class="section__header">Bienvenue dans un univers discret et intelligent dédié à vos besoins professionnels.
      </h2>
      <p class="section__description">
      Nos espaces soigneusement sélectionnés vous offrent bien plus que de simples salles : ce sont des environnements conçus pour stimuler la concentration, favoriser la collaboration et transformer chaque réunion en réussite.
      Loin du bruit et de la complexité, explorez une nouvelle manière d’organiser vos moments clés, dans des lieux flexibles, modernes et inspirants.
      </p>

      <button class="btn">Book Now</button>
    </div>
  </div>
</section>

<section class="room__container" id="salles">
  <p class="section__subheader">SALLES</p>
  <h2 class="section__header">Nos meilleurs choix de salles</h2>
  <p class="section__subheader">Des salles pensées pour inspirer, performer et collaborer avec fluidité.</p>
  <div class="room__grid">
    <div class="room__card">
      <img src="assets/salle-1.jpg" alt="room" />
      <div class="room__card__details">
        <div>
          <h4>Salle Pro+</h4>
          <p>Un espace haut de gamme pour vos rencontres d'affaires stratégiques réussies.</p>
        </div>
        <h3>100.000 FCFA<span>/jour</span></h3>

      </div>
    </div>
    <div class="room__card">
      <img src="assets/salle-2.jpg" alt="room" />
      <div class="room__card__details">
        <div>
          <h4>Salle Collaborative</h4>
          <p>Conçue pour travailler en équipe, partager des idées et avancer ensemble.</p>
        </div>
        <h3>95.000 FCFA<span>/jour</span></h3>

      </div>
    </div>
    <div class="room__card">
      <img src="assets/salle-3.jpg" alt="room" />
      <div class="room__card__details">
        <div>
          <h4>Salle Prestige</h4>
          <p>
          Un lieu lumineux et élégant pour vos événements professionnels d'exception.
            
          </p>
        </div>
        <h3>80.000 FCFA<span>/jour</span></h3>

      </div>
    </div>
  </div>
</section>



<section class="section__container feature__container" id="feature">
  <p class="section__subheader">FONCTIONNALITÉS</p>
  <h2 class="section__header">Fonctionnalités Clés</h2>
  <div class="feature__grid">
    <div class="feature__card">
      <span><i class="ri-thumb-up-line"></i></span>
      <h4>Très bien noté</h4>
      <p>
        Nous sélectionnons des espaces de travail appréciés pour leur confort, leur accessibilité et la satisfaction des utilisateurs.
      </p>
    </div>
    <div class="feature__card">
      <span><i class="ri-time-line"></i></span>
      <h4>Heures silencieuses</h4>
      <p>
        Nous offrons des créneaux où le calme est garanti, idéals pour vos réunions, formations ou sessions de travail concentré.
      </p>
    </div>
    <div class="feature__card">
      <span><i class="ri-map-pin-line"></i></span>
      <h4>Meilleurs emplacements</h4>
      <p>
        Nos espaces sont situés dans des zones stratégiques, facilement accessibles et proches des commodités essentielles.
      </p>
    </div>
    <div class="feature__card">
      <span><i class="ri-close-circle-line"></i></span>
      <h4>Annulation gratuite</h4>
      <p>
        Parce que les imprévus existent, nous vous permettons d’annuler gratuitement selon les conditions définies.
      </p>
    </div>
    <div class="feature__card">
      <span><i class="ri-wallet-line"></i></span>
      <h4>Options de paiement</h4>
      <p>
        Plusieurs méthodes de paiement, y compris via Fedapay, sont disponibles pour simplifier vos réservations.
      </p>
    </div>
    <div class="feature__card">
      <span><i class="ri-coupon-line"></i></span>
      <h4>Offres spéciales</h4>
      <p>
        Bénéficiez de réductions sur vos réservations d’espaces de travail grâce à nos offres promotionnelles régulières.
      </p>
    </div>
  </div>
</section>


<section class="menu" id="explorer">
  <div class="section__container menu__container">
    <div class="menu__header">
      <div>
        <p class="section__subheader">Explorer</p>
        <h2 class="section__header">Nos Espaces à Découvrir</h2>
      </div>
      <div class="section__nav">
        <span><i class="ri-arrow-left-line"></i></span>
        <span><i class="ri-arrow-right-line"></i></span>
      </div>
    </div>
    <ul class="menu__items">
      <li>
        <img src="assets/menu-1.jpg" alt="menu" />
        <div class="menu__details">
          <h4>Salle Propulse</h4>
          <p>
            Un espace dynamique pensé pour les réunions productives et les séances de brainstorming efficaces.
          </p>
        </div>
      </li>
      <li>
        <img src="assets/menu-2.jpg" alt="menu" />
        <div class="menu__details">
          <h4>Espace Corroboratif</h4>
          <p>
            L’ambiance parfaite pour des discussions stratégiques, des entretiens ou des ateliers collaboratifs.
          </p>
        </div>
      </li>
      <li>
        <img src="assets/menu-3.jpg" alt="menu" />
        <div class="menu__details">
          <h4>Salle Prestige</h4>
          <p>
            Élégance et confort haut de gamme pour vos présentations ou événements d’entreprise.
          </p>
        </div>
      </li>
      <li>
        <img src="assets/menu-4.jpg" alt="menu" />
        <div class="menu__details">
          <h4>Espace Connectée</h4>
          <p>
            Un lieu technologique avec wifi haut débit et équipements numériques de pointe.
          </p>
        </div>
      </li>
      <li>
        <img src="assets/menu-5.jpg" alt="menu" />
        <div class="menu__details">
          <h4>Salle de Concentration</h4>
          <p>
            Idéal pour travailler en silence, réviser ou enregistrer un podcast.
          </p>
        </div>
      </li>
      <li>
        <img src="assets/menu-6.jpg" alt="menu" />
        <div class="menu__details">
          <h4>Espace Détente</h4>
          <p>
            Un coin chaleureux pour faire une pause, discuter autour d’un café ou lire tranquillement.
          </p>
        </div>
      </li>
    </ul>
    <div class="menu__images">
      <img src="assets/menu-7.jpg" alt="menu" />
      <img src="assets/menu-8.jpg" alt="menu" />
      <img src="assets/menu-9.jpg" alt="menu" />
    </div>
    <ul class="menu__banner">
      <li>
        <span><i class="ri-file-text-line"></i></span>
        <h4>250+</h4>
        <p>Réservations enregistrées</p>
      </li>
      <li>
        <span><i class="ri-user-line"></i></span>
        <h4>12k</h4>
        <p>Utilisateurs actifs</p>
      </li>
      <li>
        <span><i class="ri-function-line"></i></span>
        <h4>15</h4>
        <p>Types d’espaces disponibles</p>
      </li>
      <li>
        <span><i class="ri-lightbulb-flash-line"></i></span>
        <h4>98%</h4>
        <p>Satisfaction client</p>
      </li>
    </ul>
  </div>
</section>




<footer class="footer">
  <div class="section__container footer__container">
    <div class="footer__col">
    <div class="logo footer__logo">
  <div>BW</div>
  <span>BOOK<br />WORK</span>
</div>

      
      <p>Réservez rapidement vos salles de réunion ou espaces de travail modernes en quelques clics.</p>

      
      <ul class="footer__socials">
        <li>
          <a href="#"><i class="ri-youtube-fill"></i></a>
        </li>
        <li>
          <a href="#"><i class="ri-instagram-line"></i></a>
        </li>
        <li>
          <a href="#"><i class="ri-facebook-fill"></i></a>
        </li>
        <li>
          <a href="#"><i class="ri-linkedin-fill"></i></a>
        </li>
      </ul>
    </div>
    <div class="footer__col">
      <h4>Services</h4>
      <ul class="footer__links">
  <li><a href="#">Réservation instantanée d'espaces</a></li>
  <li><a href="#">Personnalisation de la salle réservée</a></li>
  <li><a href="#">Support client dédié</a></li>
 
</ul>

    </div>
    <div class="footer__col">
      <h4>Contact Us</h4>
      <div class="footer__links">
        <li>
          <span><i class="ri-phone-fill"></i></span>
          <div>
            <h5>Phone Number</h5>
            <p>+229 0164321208</p>
          </div>
        </li>
        <li>
          <span><i class="ri-record-mail-line"></i></span>
          <div>
            <h5>Email</h5>
            <p>info@bookwork.com</p>
          </div>
        </li>
        <li>
          <span><i class="ri-map-pin-2-fill"></i></span>
          <div>
            <h5>Location</h5>
            <p>Avenue Steinmetz</p>
          </div>
        </li>
      </div>
    </div>
  </div>
  <div class="footer__bar">
    Copyright © 2023 Web Design Mastery. All rights reserved.
  </div>
</footer>

<script src="https://unpkg.com/scrollreveal"></script>
<script src="main.js"></script>
```

  </body>
</html>
