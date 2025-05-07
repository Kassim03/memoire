
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Inscription | Réservation Sécurisée</title>

  <!-- Tailwind CSS CDN -->
  <script src="<?php echo e(asset("assets/css/tailwindcss/3.4.16")); ?>"></script>

  <script src="<?php echo e(asset("assets/js/register.js")); ?>"></script>

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet"/>
  <link rel="stylesheet" href="<?php echo e(asset("assets/css/register.css")); ?>">
  <!-- Custom Tailwind Config -->
  
</head>

<body class="bg-gradient-to-br from-primary to-dark min-h-screen flex items-center justify-center px-4">

  <div class="card w-full max-w-lg bg-white shadow-2xl rounded-2xl p-8 animate-fade-in">
    <h2 class="text-3xl font-header text-primary text-center mb-4">Créer un compte</h2>
    <p class="text-light text-center mb-6">Inscrivez-vous pour réserver vos espaces en toute sécurité</p>

    <form action="" method="POST" class="space-y-5">

      <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
          <label for="prenom" class="label text-dark">Prénom</label>
          <input type="text" id="prenom" name="prenom" required placeholder="Jean"
            class="input input-bordered w-full border-light focus:border-secondary focus:ring-2 focus:ring-secondary" />
        </div>

        <div>
          <label for="nom" class="label text-dark">Nom</label>
          <input type="text" id="nom" name="nom" required placeholder="Dupont"
            class="input input-bordered w-full border-light focus:border-secondary focus:ring-2 focus:ring-secondary" />
        </div>
      </div>

      <div>
        <label for="email" class="label text-dark">Adresse e-mail</label>
        <input type="email" id="email" name="email" required placeholder="exemple@email.com"
          class="input input-bordered w-full border-light focus:border-secondary focus:ring-2 focus:ring-secondary" />
      </div>

      <div>
        <label for="telephone" class="label text-dark">Téléphone</label>
        <input type="tel" id="telephone" name="telephone" required placeholder="+225 01 02 03 04"
          class="input input-bordered w-full border-light focus:border-secondary focus:ring-2 focus:ring-secondary" />
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
          <label for="mot_de_passe" class="label text-dark">Mot de passe</label>
          <input type="password" id="mot_de_passe" name="mot_de_passe" required placeholder="********"
            class="input input-bordered w-full border-light focus:border-secondary focus:ring-2 focus:ring-secondary" />
        </div>

        <div>
          <label for="confirmation" class="label text-dark">Confirmer le mot de passe</label>
          <input type="password" id="confirmation" name="confirmation" required placeholder="********"
            class="input input-bordered w-full border-light focus:border-secondary focus:ring-2 focus:ring-secondary" />
        </div>
      </div>

      <div>
        <label for="type_utilisateur" class="label text-dark">Type d'utilisateur</label>
        <select id="type_utilisateur" name="type_utilisateur"
          class="select select-bordered w-full border-light focus:border-secondary focus:ring-2 focus:ring-secondary">
          <option disabled selected>Choisissez un profil</option>
          <option value="client">Client</option>
          <option value="proprietaire">Propriétaire</option>
        </select>
      </div>

      <button type="submit"
        class="btn w-full bg-secondary text-white hover:bg-primary transition-all duration-300 font-semibold uppercase tracking-wider">
        S'inscrire
      </button>
    </form>

    <div class="text-center mt-6">
      <p class="text-sm text-gray-500">
        Déjà inscrit ?
        <a href="<?php echo e(route("login")); ?>" class="text-secondary font-semibold hover:underline">Connectez-vous</a>
      </p>
    </div>
  </div>

 
  
</body>
</html>


<?php /**PATH C:\Users\22964\OneDrive\Images\STORM-1\Views/register.blade.php ENDPATH**/ ?>