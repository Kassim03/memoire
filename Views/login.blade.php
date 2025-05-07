

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Connexion | Réservation Sécurisée</title>

  <!-- Tailwind CSS CDN -->
  <script src="{{ asset("assets/css/tailwindcss/3.4.16") }}"></script>


  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet"/>
  <link rel="stylesheet" href="{{ asset("assets/css/login.css") }}">

  <!-- Custom Tailwind Config -->
  
  <script src="{{ asset("assets/js/login.js") }}"></script>
</head>

<body class="bg-gradient-to-br from-primary to-dark min-h-screen flex items-center justify-center px-4">

  <div class="card w-full max-w-md bg-white shadow-2xl rounded-2xl p-8 animate-fade-in">
    <h2 class="text-3xl font-header text-primary text-center mb-4">Connexion</h2>
    <p class="text-light text-center mb-6">Accédez à votre espace personnel sécurisé</p>
    

    <form action="traitement_login.php" method="POST" class="space-y-5">
      <div>
        <label for="email" class="label text-dark">Adresse e-mail</label>
        <input type="email" id="email" name="email" required placeholder="votre@email.com"
          class="input input-bordered w-full border-light focus:border-secondary focus:ring-2 focus:ring-secondary" />
      </div>

      <div>
        <label for="mot_de_passe" class="label text-dark">Mot de passe</label>
        <input type="password" id="mot_de_passe" name="mot_de_passe" required placeholder="********"
          class="input input-bordered w-full border-light focus:border-secondary focus:ring-2 focus:ring-secondary" />
      </div>

      <button type="submit"
        class="btn w-full bg-secondary text-white hover:bg-primary transition-all duration-300 font-semibold uppercase tracking-wider">
        Se connecter
      </button>
    </form>

    <div class="text-center mt-6">
      <p class="text-sm text-gray-500">
        Pas encore inscrit ?
        <a href="{{ route("register") }}" class="text-secondary font-semibold hover:underline">Créer un compte</a>
      </p>
    </div>
  </div>

  <!-- Fade-in animation -->
</body>
</html>

