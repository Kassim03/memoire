<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Réservation | BookWork</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Playfair+Display:wght@400;700&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet" />
    <style>
        :root {
            --primary-color: #0f1a2c;
            --secondary-color: #f6ac0f;
            --accent-blue: #1777ff;
            --text-dark: #0f172a;
            --text-light: #64748b;
            --extra-light: #f8fafc;
            --white: #ffffff;
            --header-font: "Playfair Display", serif;
        }
        /* RESET */
        ::before,*::after{box-sizing:border-box;margin:0;padding:0;font-family:"Inter",sans-serif}
        body{background:var(--extra-light);color:var(--text-dark);min-height:100vh;display:flex;flex-direction:column;line-height:1.6}
        a{text-decoration:none;color:inherit}
        ul{list-style:none}

        nav{width:100%;background:var(--primary-color);color:var(--white);position:sticky;top:0;z-index:100}
        .nav__bar{max-width:1200px;margin:0 auto;padding:1rem 1.5rem;display:flex;align-items:center;justify-content:space-between}
        .logo{display:flex;align-items:center;gap:.5rem;font-weight:700}
        .logo div{width:42px;height:42px;background:var(--secondary-color);color:var(--primary-color);display:grid;place-content:center;border-radius:.4rem;font-family:var(--header-font);font-size:1.1rem}
        .logo span{line-height:1.1;font-family:var(--header-font)}
        .nav__links{display:flex;align-items:center;gap:1.5rem;transition:max-height .4s ease}
        .nav__links a{font-size:.95rem;font-weight:600;transition:color .3s}
        .nav__links a:hover{color:var(--secondary-color)}
        .nav__toggle{display:none;font-size:1.5rem;cursor:pointer}
        @media(max-width:768px){.nav_toggle{display:block}.navlinks{position:absolute;left:0;top:100%;width:100%;background:var(--primary-color);flex-direction:column;max-height:0;overflow:hidden}.navlinks li{border-top:1px solid rgba(255,255,255,.1);width:100%}.navlinks a{display:block;padding:1rem 1.5rem}.nav_links.show{max-height:320px}}

        .header{background:linear-gradient(135deg,var(--primary-color),var(--accent-blue));color:var(--white);text-align:center;padding:4rem 1.5rem 5rem}
        .header h1{font-family:var(--header-font);font-size:2.4rem;margin-bottom:.6rem}
        .header p{opacity:.85}

        .reservation-container{max-width:640px;width:92%;margin:-3rem auto 3rem;background:var(--white);padding:2.5rem 2rem;border-radius:1rem;box-shadow:0 12px 28px rgba(0,0,0,.08)}
        .reservation-container h2{text-align:center;margin-bottom:2rem;font-family:var(--header-font);font-size:1.8rem;color:var(--primary-color)}

        form{display:flex;flex-direction:column;align-items:center}
        form > *{width:100%;max-width:420px}

        label{display:block;margin-bottom:.4rem;font-weight:600;color:var(--primary-color)}
        input,select,textarea{width:100%;padding:.8rem 1rem;margin-bottom:1.2rem;border:1px solid #d1d5db;border-radius:.6rem;font-size:1rem;transition:border-color .3s,box-shadow .3s}
        input:focus,select:focus,textarea:focus{outline:none;border-color:var(--secondary-color);box-shadow:0 0 0 3px rgba(246,172,15,.25)}

        .duration-info{text-align:center;margin-top:-.6rem;margin-bottom:1rem;font-size:.85rem;color:var(--accent-blue)}

        .buttons{display:flex;gap:1rem;justify-content:center;flex-wrap:wrap;margin-top:.5rem}
        .btn{background:var(--accent-blue);color:var(--white);padding:.9rem 1.6rem;border:none;border-radius:.6rem;font-weight:700;font-size:1rem;cursor:pointer;transition:background .3s,transform .2s}
        .btn:hover{background:var(--secondary-color);transform:translateY(-2px)}
        .btn:active{transform:translateY(0)}

        .footer{margin-top:auto;background:var(--primary-color);color:var(--white);padding:3rem 1.5rem 1rem}
        .footer_container{max-width:1200px;margin:0 auto;display:grid;grid-template-columns:repeat(auto-fit,minmax(200px,1fr));gap:2rem}
        .footer__col h4{margin-bottom:.8rem;font-weight:600}
        .footer__bar{text-align:center;margin-top:2rem;font-size:.9rem;opacity:.75}

        @media(max-width:480px){.header h1{font-size:1.9rem}.reservation-container{padding:2rem 1.3rem}}

        /* Style pour la fenêtre de confirmation */
        #cancelConfirmation {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 50;
            display: flex;
            align-items: center;
            justify-content: center;
            display: none; /* Initialement cachée */
        }

        #cancelConfirmation .modal-content {
            background-color: white;
            border-radius: 0.5rem;
            padding: 2rem;
            text-align: center;
        }

        #cancelConfirmation .modal-buttons {
            display: flex;
            justify-content: center;
            gap: 1rem;
            margin-top: 1rem;
        }

        #cancelConfirmation .confirm-btn {
            background-color: #f6ac0f; /* Couleur orange */
            color: var(--primary-color); /* Couleur du texte principal */
            padding: 0.75rem 1.5rem;
            border-radius: 0.3rem;
            cursor: pointer;
            border: none;
            font-weight: bold;
        }

        #cancelConfirmation .cancel-btn {
            background-color: gray;
            color: white;
            
            padding: 0.75rem 1.5rem;
            border-radius: 0.3rem;
            cursor: pointer;
            border: none;
        }
    </style>
</head>
<body>
    <nav>
        <div class="nav__bar">
            <div class="logo nav__logo"><div>BW</div><span>Book<br/>Work</span></div>
           
            <div class="nav__toggle" id="nav-toggle"><i class="ri-menu-line"></i></div>
        </div>
    </nav>

    <header class="header">
        <h1>Réservez votre espace</h1>
        <p>Choisissez la salle, la date et la durée – tout se fait ici.</p>
    </header>

    <section class="reservation-container">
        <h2>Formulaire de Réservation</h2>
        <form action="/valider" method="POST" autocomplete="off" id="resForm">
            <label for="salle">Type de Salle</label>
            <select name="salle" id="salle" required>
                <option value="">-- Sélectionnez une salle --</option>
                <option value="premium">Salle Premium</option>
                <option value="familiale">Salle Familiale</option>
                <option value="prestige">Salle Prestige</option>
                <option value="premium">Espace Nova</option>
                <option value="familiale">Espace Fusion</option>
                <option value="prestige">Espace Élégance</option>
            </select>
            <label for="date">Date</label>
            <input type="date" id="date" name="date" required />
            <label for="heure">Heure</label>
            <input type="time" id="heure" name="heure" required />
            <label for="duree">Durée (1 à 72 h)</label>
            <input type="number" id="duree" name="duree" min="1" max="48" required />
            <small class="duration-info" id="durationDisplay"></small>
            <label for="participants">Nombre de Participants</label>
            <input type="number" id="participants" name="participants" min="1" required />
            <label for="commentaires">Commentaires (optionnel)</label>
            <textarea id="commentaires" name="commentaires" rows="4" placeholder="Besoin spécifique, matériel requis, etc."></textarea>
            <div class="buttons">
                <button type="submit" class="btn">Valider</button>
                <button type="button" class="btn" id="cancelBtn">Annuler</button>
            </div>
        </form>
    </section>

    <div id="cancelConfirmation" class="hidden">
        <div class="modal-content">
            <p class="mb-4">Êtes-vous sûr de vouloir annuler votre réservation ?</p>
            <div class="modal-buttons">
                <button id="confirmCancelBtn" class="confirm-btn"><span style="color: white;">
                Oui, annuler
                </span></button>
                <button id="rejectCancelBtn" class="cancel-btn">Non, revenir</button>
            </div>
        </div>
    </div>
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
        const cancelBtn = document.getElementById('cancelBtn');
        const cancelConfirmation = document.getElementById('cancelConfirmation');
        const confirmCancelBtn = document.getElementById('confirmCancelBtn');
        const rejectCancelBtn = document.getElementById('rejectCancelBtn');

        cancelBtn.addEventListener('click', function() {
            cancelConfirmation.style.display = 'flex';
            document.body.classList.add('overflow-hidden'); // Empêcher le défilement du fond
        });

        rejectCancelBtn.addEventListener('click', function() {
            cancelConfirmation.style.display = 'none';
            document.body.classList.remove('overflow-hidden'); // Réactiver le défilement du fond
        });

        confirmCancelBtn.addEventListener('click', function() {
            // Rediriger vers le dashboard
            window.location.href = "<?php echo e(route('dashboard')); ?>";
        });
    </script>
</body>
</html><?php /**PATH C:\Users\22964\OneDrive\Images\STORM-1\Views/home/reservation.blade.php ENDPATH**/ ?>