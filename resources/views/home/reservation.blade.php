<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Réservation | BookWork</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Playfair+Display:wght@400;700&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/reservation.css') }}">
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
        <form action="{{ route('reservation.valider') }}" method="POST" autocomplete="off" id="resForm">
    @csrf

    <input type="hidden" name="emplacement_id" value="{{ $emplacement->id }}">

    <label for="salle">Type de Salle</label>
    <select name="salle" id="salle">
        <option value="{{ $emplacement->nom }}">{{ $emplacement->nom }}</option>
    </select>

    <label for="date">Date et heure d'arrivé</label>
    <input type="datetime-local" id="date_arrive" name="date_arrive"  value="{{ old('date_arrive', now()) }}" />

    <label for="heure">Date et heure de départ</label>
    <input type="datetime-local" id="heure" name="date_depart" value="{{ old('date_depart', $demain) }}" />

    <label for="duree">Durée </label>
    <input type="number" id="duree" name="duree" min="1" max="120" readonly style="background-color: #f3f4f6;" />

    <small class="duration-info" id="durationDisplay" style="display: block; margin-top: 4px;"></small>

    <label for="participants">Nombre de Participants</label>
    <input type="number" id="participants" name="participants" min="1" value="{{ old('participants') }}" max="{{ $emplacement->capacites }}"/>

    <label for="commentaires">Commentaires (optionnel)</label>
    <textarea id="commentaires" name="commentaires" rows="4" placeholder="Besoin spécifique, matériel requis, etc."></textarea>

    <div class="buttons">
        <button type="submit" class="btn">Valider</button>
        <button type="button" class="btn" id="cancelBtn">Annuler</button>
    </div>
</form>

<script>
    const dateArrive = document.getElementById('date_arrive');
    const dateDepart = document.getElementById('heure');
    const duree = document.getElementById('duree');
    const display = document.getElementById('durationDisplay');

    function updateDuree() {
        const start = new Date(dateArrive.value);
        const end = new Date(dateDepart.value);

        if (!isNaN(start) && !isNaN(end) && end > start) {
            const diffMs = end - start;
            const diffHrs = Math.round(diffMs / (1000 * 60 * 60));
            duree.value = diffHrs;
            display.textContent = `Durée calculée : ${diffHrs} heure${diffHrs > 1 ? 's' : ''}`;
        } else {
            duree.value = '';
            display.textContent = 'Veuillez entrer des dates valides.';
        }
    }

    dateArrive.addEventListener('change', updateDuree);
    dateDepart.addEventListener('change', updateDuree);
</script>

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
            window.location.href = "{{ route('reservation.list') }}";
        });
    </script>
  @include('sweetalert::alert')

</body>
</html>