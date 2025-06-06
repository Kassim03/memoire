<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un Emplacement - Moderne</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Styles personnalisés pour les animations (optionnel, Tailwind suffit souvent) */
        .form-input-focus:focus {
            outline: none;
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.45); /* indigo-500 avec opacité */
            border-color: #6366F1; /* indigo-500 */
        }

        .btn-hover-scale:hover {
            transform: scale(1.02);
        }

        .btn-active-press:active {
            transform: scale(0.98);
        }

        /* Animation pour l'apparition des champs (exemple) */
        .fade-in-up {
            animation: fadeInUp 0.5s ease-out forwards;
            opacity: 0;
            transform: translateY(20px);
        }

        @keyframes fadeInUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>

<body class="bg-gradient-to-br from-indigo-50 to-purple-50 min-h-screen flex items-center justify-center p-4">

    <div class="bg-white shadow-2xl rounded-xl p-8 md:p-10 w-full max-w-md transform transition-all duration-300 hover:scale-[1.005]">
        <h1 class="text-3xl md:text-4xl font-extrabold text-gray-900 text-center mb-8 tracking-tight">
            Ajouter un <span class="text-indigo-600">Nouvel Emplacement</span>
        </h1>

        <form action="{{ route('emplacements.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <div class="fade-in-up" style="animation-delay: 0.0s;">
                <label for="type" class="block text-sm font-medium text-gray-700 mb-1">Type d'emplacement</label>
                <div class="relative">
                    <select name="type" id="type" class="form-input-focus block w-full pl-4 pr-10 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 text-gray-900 leading-tight transition duration-200 ease-in-out" required>
                        <option value="">-- Sélectionner --</option>
                        <option value="salles">Salle</option>
                        <option value="espace">Espace</option>
                    </select>
                    <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l4-4 4 4m0 6l-4 4-4-4"></path></svg>
                    </div>
                </div>
            </div>

            <div class="fade-in-up" style="animation-delay: 0.1s;">
                <label for="nom" class="block text-sm font-medium text-gray-700 mb-1">Nom de l'emplacement</label>
                <input type="text" name="nom" id="nom" class="form-input-focus block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 text-gray-900 leading-tight transition duration-200 ease-in-out" placeholder="Ex: Salle de conférence Alpha" required>
            </div>

            <div class="fade-in-up" style="animation-delay: 0.2s;">
                <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                <textarea name="description" id="description" rows="4" class="form-input-focus block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 text-gray-900 leading-tight transition duration-200 ease-in-out" placeholder="Décrivez l'emplacement en quelques mots..." required></textarea>
            </div>

            <div class="fade-in-up" style="animation-delay: 0.3s;">
                <label for="tarif_hr" class="block text-sm font-medium text-gray-700 mb-1">Tarif horaire (FCFA)</label>
                <input type="number" name="tarif_hr" id="tarif_hr" step="0.01" class="form-input-focus block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 text-gray-900 leading-tight transition duration-200 ease-in-out" placeholder="Ex: 50000" required>
            </div>

            <div class="fade-in-up" style="animation-delay: 0.4s;">
                <label for="image" class="block text-sm font-medium text-gray-700 mb-1">Image de l'emplacement</label>
                <input type="file" name="image" id="image" class="block w-full text-sm text-gray-500
                    file:mr-4 file:py-2 file:px-4
                    file:rounded-full file:border-0
                    file:text-sm file:font-semibold
                    file:bg-indigo-50 file:text-indigo-700
                    hover:file:bg-indigo-100
                    cursor-pointer transition duration-200 ease-in-out" accept="image/*">
            </div>

            <div class="fade-in-up" style="animation-delay: 0.5s;">
                <label for="capacites" class="block text-sm font-medium text-gray-700 mb-1">Capacité</label>
                <input type="number" name="capacites" id="capacites" class="form-input-focus block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 text-gray-900 leading-tight transition duration-200 ease-in-out" placeholder="Ex: 50 personnes" required>
            </div>

            <div class="pt-4 flex justify-center fade-in-up" style="animation-delay: 0.6s;">
                <button type="submit" class="btn-hover-scale btn-active-press inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-full shadow-lg text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition duration-300 ease-in-out transform">
                    <svg class="-ml-1 mr-3 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                    Enregistrer l'emplacement
                </button>
            </div>
        </form>
    </div>

</body>

</html>