<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Connexion | BookWork</title>

  <!-- Tailwind CDN -->
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

  <div class="w-full max-w-md bg-white shadow-2xl rounded-2xl p-8 animate-fade-in">
    <h1 class="text-3xl font-header text-primary text-center mb-4">Connexion</h1>
    <p class="text-light text-center mb-6">Accédez à votre espace personnel sécurisé</p>

    <form action="<?php echo e(url("/login/post")); ?>" method="POST" class="space-y-5">
      <div>
        <label for="email" class="block mb-1 font-semibold text-dark">Adresse e-mail</label>
        <input
          type="email" id="email" name="email" required
          placeholder="votre@email.com"
          class="w-full rounded-lg border border-light px-4 py-2 focus:outline-none focus:border-secondary focus:ring-2 focus:ring-secondary" />
      </div>

      <div>
        <label for="mot_de_passe" class="block mb-1 font-semibold text-dark">Mot de passe</label>
        <input
          type="password" id="mot_de_passe" name="mot_de_passe" required
          class="w-full rounded-lg border border-light px-4 py-2 focus:outline-none focus:border-secondary focus:ring-2 focus:ring-secondary" />
      </div>

      <button
        type="submit"
        class="w-full bg-secondary text-white py-3 rounded-lg font-semibold uppercase tracking-wider hover:bg-primary transition">
        Connexion
      </button>
    </form>

    <div class="text-center mt-6">
      <p class="text-sm text-gray-500">
        Pas encore inscrit ?
        <a href="<?php echo e(route("register")); ?>" class="text-secondary font-semibold hover:underline">Créer un compte</a>
      </p>
    </div>
  </div>

</body>
</html><?php /**PATH C:\Users\22964\OneDrive\Images\STORM-1\Views/login.blade.php ENDPATH**/ ?>