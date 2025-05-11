<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>Paiement | BookWork</title>
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Playfair+Display:wght@400;700&display=swap" rel="stylesheet" />
  <!-- Remix Icons -->
  <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet" />
  <!-- FedaPay Checkout -->
  <script src="https://cdn.fedapay.com/checkout.js?v=1.1.7"></script>
  <link rel="stylesheet" href="{{ asset('css/paiement.css') }}" />
</head>
<body>
  <!-- NAVIGATION -->
  <nav>
    <div class="nav__bar">
      <div class="logo nav__logo"><div>BW</div><span>Book<br/>Work</span></div>
      
      <div class="nav__toggle" id="nav-toggle"><i class="ri-menu-line"></i></div>
    </div>
  </nav>
  <!-- HEADER -->
  <header class="header">
    <h1>Paiement de votre réservation</h1>
    <p>Saisissez vos informations et réglez en toute sécurité.</p>
  </header>

  <!-- FORM -->
  <section class="pay-container">
    <h2>Formulaire de Paiement</h2>
    <form id="payForm" autocomplete="off" method="POST" action="{{ route('paiement.post')  }}">
      <label for="name">Nom complet</label>
      <input type="text" id="name" name="name" placeholder="Votre nom" required value="{{$name . " " . $surname}}" />
      <label for="email">Adresse e‑mail</label>
      <input type="email" id="email" name="email" placeholder="mail@example.com" required value="{{ $email }}"/>
      <label for="amount">Montant (FCFA)</label>
      <input type="number" id="amount" name="amount" min="1000" step="100" required />
      <div class="buttons">
        <button type="button" class="btn" id="pay-btn">Payer</button>
        <script type="text/javascript">
          FedaPay.init("#pay-btn", {
            public_key: "pk_sandbox_FNpFFtxnECohsoywzan7TsX_",
            transaction: {
              amount: 100000,
              description: 'Acheter mon produit'
            },
            customer: {
              email: document.getElementById('email').value,
              lastname: '{{ $surname }}',
              firstname: '{{ $name }}',
            },
            onComplete: function (response) {
              if (response.transaction && response.transaction.status === 'approved') {
                // ✅ Paiement réussi
                console.log('Paiement réussi', response);
                alert("✅ Paiement effectué avec succès !");
                window.location.href = "/dashboard"; // ou toute autre page de succès
              } else {
                // ❌ Paiement échoué ou annulé
                console.warn('Paiement non approuvé', response);
                alert("❌ Le paiement a échoué ou a été annulé.");
              }
            }
          });

        </script>
        <button type="button" class="btn" id="cancelBtn">Annuler</button>
      </div>
    </form>
  </section>
  </body>
  
  <!-- FOOTER -->
  <footer class="footer">
    <div class="footer_container">
      <div class="footer_col"><div class="logo footer_logo"><div>BW</div><span>BOOK<br/>WORK</span></div><p>Réservez rapidement vos salles ou espaces modernes.</p></div>
      <div class="footer__col"><h4>Contact</h4><p>Email : info@bookwork.com</p><p>Tél : +229 01 64 32 12 08</p></div>
    </div>
    <div class="footer__bar">© 2025 BookWork. Tous droits réservés.</div>
  </footer>


  {{-- <script>
    /* Navigation mobile toggle */
    const navToggle=document.getElementById('nav-toggle');
    const navLinks=document.getElementById('nav-links');
    navToggle.addEventListener('click',()=>{
      navLinks.classList.toggle('show');
      navToggle.innerHTML=navLinks.classList.contains('show')?'<i class="ri-close-line"></i>':'<i class=" --}}