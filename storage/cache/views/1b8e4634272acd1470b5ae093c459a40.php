<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Inscription | BookWork</title>

  <!-- Tailwind CSS CDN -->
  <script src="https://cdn.tailwindcss.com"></script>

  <!-- Palette & police perso -->
  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            primary:  '#0f1a2c',   /* bleu nuit  */
            secondary:'#f6ac0f',   /* orange vif */
            dark:     '#0f172a',
            light:    '#64748b',
          },
          fontFamily: {
            header: ['"Playfair Display"', 'serif'],
          },
          keyframes: {
            fade: { '0%': {opacity:0}, '100%': {opacity:1} },
          },
          animation: {
            'fade-in': 'fade .6s ease-out',
          },
        }
      }
    };
  </script>

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet" />
</head>

<body class="bg-gradient-to-br from-primary to-dark min-h-screen flex items-center justify-center px-4">

  <div class="w-full max-w-lg bg-white shadow-2xl rounded-2xl p-8 animate-fade-in">
    <h1 class="text-3xl font-header text-primary text-center mb-4">Créer un compte</h1>
    <p class="text-light text-center mb-6">Inscrivez-vous pour réserver vos espaces en toute sécurité</p>

    <form action="<?php echo e(url('register/post')); ?>" method="POST" class="space-y-5">
      <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
          <label for="prenom" class="block mb-1 font-semibold text-dark">Prénom</label>
          <input
            type="text" id="prenom" name="prenom" placeholder="Jean"
            class="w-full rounded-lg border border-light px-4 py-2 focus:outline-none focus:border-secondary focus:ring-2 focus:ring-secondary" />
        </div>

        <div>
          <label for="nom" class="block mb-1 font-semibold text-dark">Nom</label>
          <input
            type="text" id="nom" name="nom" placeholder="Dupont"
            class="w-full rounded-lg border border-light px-4 py-2 focus:outline-none focus:border-secondary focus:ring-2 focus:ring-secondary" />
        </div>
      </div>

      <div>
        <label for="email" class="block mb-1 font-semibold text-dark">Adresse e-mail</label>
        <input
          type="email" id="email" name="email" placeholder="exemple@email.com"
          class="w-full rounded-lg border border-light px-4 py-2 focus:outline-none focus:border-secondary focus:ring-2 focus:ring-secondary" />
      </div>

      <div>
        <label for="telephone" class="block mb-1 font-semibold text-dark">Téléphone</label>
        <input
          type="tel" id="telephone" name="telephone" placeholder="+229 0164321208"
          class="w-full rounded-lg border border-light px-4 py-2 focus:outline-none focus:border-secondary focus:ring-2 focus:ring-secondary" />
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
          <label for="mot_de_passe" class="block mb-1 font-semibold text-dark">Mot de passe</label>
          <input
            type="password" id="mot_de_passe" name="mot_de_passe"
            class="w-full rounded-lg border border-light px-4 py-2 focus:outline-none focus:border-secondary focus:ring-2 focus:ring-secondary" />
        </div>

        <div>
          <label for="confirmation" class="block mb-1 font-semibold text-dark">Confirmer le mot de passe</label>
          <input
            type="password" id="confirmation" name="confirmation"
            class="w-full rounded-lg border border-light px-4 py-2 focus:outline-none focus:border-secondary focus:ring-2 focus:ring-secondary" />
        </div>
      </div>

      <button
        type="submit"
        class="w-full bg-secondary text-white py-3 rounded-lg font-semibold uppercase tracking-wider hover:bg-primary transition">
        Inscription
      </button>
    </form>

    <div class="text-center mt-6">
      <p class="text-sm text-gray-500">
        Déjà inscrit ?
        <a href="/login" class="text-secondary font-semibold hover:underline">Login</a>
      </p>
    </div>
  </div>

</body>
</html><?php /**PATH C:\Users\22964\OneDrive\Images\STORM-1\Views/register.blade.php ENDPATH**/ ?>