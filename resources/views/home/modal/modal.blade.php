<div id="profileModal" class="fixed inset-0 bg-black bg-opacity-50 backdrop-blur-sm z-50 hidden items-center justify-center p-4">
    <div class="bg-white rounded-2xl w-full max-w-2xl max-h-[80vh] overflow-y-auto shadow-2xl transform transition-all duration-300 scale-95 opacity-0" id="modalContent">

        <div class="bg-[#0f1a2c] from-blue-600 to-purple-600 text-white p-6 rounded-t-2xl">
            <div class="flex items-center justify-between">
                <h2 class="text-2xl font-bold flex items-center gap-3">
                    <i class="fas fa-user-cog"></i> 
                    Modifier le Profil
                </h2>
                <button id="closeModal" class="bg-white bg-opacity-20 hover:bg-opacity-30 rounded-full p-2 transition-all duration-200 hover:rotate-90">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>
        </div>

        <div class="p-6">
            <form id="profileForm" class="space-y-6" action="{{ route('update.profil') }}" method="POST"> {{-- Ajout de method="POST" --}}
                @csrf {{-- C'est crucial pour les requêtes POST dans Laravel --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="firstName" class="block text-sm font-medium text-gray-700 mb-2">
                            Prénom <span class="text-red-500">*</span>
                        </label>
                        <input
                            type="text"
                            id="firstName"
                            name="firstName"
                            value="{{ $user->name ?? 'Non défini' }}"
                            required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 bg-gray-50 focus:bg-white">
                    </div>
                    <div>
                        <label for="lastName" class="block text-sm font-medium text-gray-700 mb-2">
                            Nom <span class="text-red-500">*</span>
                        </label>
                        <input
                            type="text"
                            id="lastName"
                            name="lastName"
                            value="{{ $user->surname ?? 'Non défini' }}"
                            required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 bg-gray-50 focus:bg-white">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                            Adresse e-mail <span class="text-red-500">*</span>
                        </label>
                        <input
                            type="email"
                            id="email"
                            name="email"
                            value="{{ $user->email ?? 'Non défini' }}"
                            required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 bg-gray-50 focus:bg-white">
                    </div>
                    <div>
                        <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">
                            Téléphone
                        </label>
                        <input
                            type="tel"
                            id="phone"
                            name="phone"
                            value="{{ $user->telephone ?? 'Non défini' }}"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 bg-gray-50 focus:bg-white">
                    </div>
                </div>

                <h3 class="text-lg font-semibold pt-4 border-t mt-6">Changer le mot de passe (facultatif)</h3>
<p class="text-sm text-gray-600">Laissez ces champs vides si vous ne souhaitez pas changer votre mot de passe.</p>
<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <div>
        <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
            Mot de passe actuel
        </label>
        <input
            type="password"
            id="password"
            name="password"
            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 bg-gray-50 focus:bg-white">
        @error('password') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
    </div>
    <div>
        <label for="new_password" class="block text-sm font-medium text-gray-700 mb-2">
            Nouveau mot de passe
        </label>
        <input
            type="password"
            id="new_password"
            name="new_password"
            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 bg-gray-50 focus:bg-white">
        @error('new_password') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
    </div>
</div>
{{-- ADD THIS NEW FIELD --}}
<div>
    <label for="new_password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">
        Confirmer le nouveau mot de passe
    </label>
    <input
        type="password"
        id="new_password_confirmation"
        name="new_password_confirmation" {{-- THIS IS THE CRUCIAL NAME --}}
        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 bg-gray-50 focus:bg-white">
    @error('new_password_confirmation') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
</div>

                {{-- Le bouton de soumission est en dehors du form mais lié par form="profileForm" --}}
                {{-- Il n'y a pas besoin d'un bouton de soumission ici car il est déjà en bas --}}
            </form>
        </div>

        <div class="bg-gray-50 px-6 py-4 rounded-b-2xl flex flex-col sm:flex-row gap-3 sm:justify-end">
            <button
                type="button"
                id="cancelBtn"
                class="px-6 py-2 bg-gray-500 hover:bg-gray-600 text-white rounded-lg transition-colors duration-200 flex items-center justify-center gap-2">
                <i class="fas fa-times-circle"></i> Annuler
            </button>
            <button
                type="submit"
                form="profileForm" {{-- Ce lien est crucial pour que le bouton soumette le formulaire par son ID --}}
                class="px-6 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg transition-all duration-200 flex items-center justify-center gap-2 hover:shadow-lg">
                <i class="fas fa-save"></i> Sauvegarder
            </button>
        </div>
    </div>
</div>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<script>
    // Éléments du DOM
    const editProfileBtn = document.getElementById('editProfileBtn'); // Assurez-vous d'avoir un bouton avec cet ID pour ouvrir la modale
    const profileModal = document.getElementById('profileModal');
    const modalContent = document.getElementById('modalContent');
    const closeModal = document.getElementById('closeModal');
    const cancelBtn = document.getElementById('cancelBtn');
    // const profileForm = document.getElementById('profileForm'); // Plus besoin de le récupérer si on ne gère pas sa soumission

    // Ouvrir la modal
    if (editProfileBtn) {
        editProfileBtn.addEventListener('click', (e) => {
            e.preventDefault(); // Empêche le comportement par défaut du bouton si c'est un lien ou autre
            profileModal.classList.remove('hidden');
            profileModal.classList.add('flex');

            // Animation d'ouverture
            setTimeout(() => {
                modalContent.classList.remove('scale-95', 'opacity-0');
                modalContent.classList.add('scale-100', 'opacity-100');
            }, 10);

            document.body.style.overflow = 'hidden';
        });
    }

    // Fermer la modal
    function closeModalFunc() {
        modalContent.classList.remove('scale-100', 'opacity-100');
        modalContent.classList.add('scale-95', 'opacity-0');

        setTimeout(() => {
            profileModal.classList.add('hidden');
            profileModal.classList.remove('flex');
            document.body.style.overflow = 'auto';
        }, 300);
    }

    // Event listeners pour fermer
    closeModal.addEventListener('click', closeModalFunc);
    cancelBtn.addEventListener('click', closeModalFunc);

    // Fermer en cliquant sur le backdrop
    profileModal.addEventListener('click', (e) => {
        if (e.target === profileModal) {
            closeModalFunc();
        }
    });

    // Fermer avec Escape
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && !profileModal.classList.contains('hidden')) {
            closeModalFunc();
        }
    });

    // --- Retire le code JavaScript de soumission du formulaire ---
    // profileForm.addEventListener('submit', (e) => {
    //     e.preventDefault(); // Cette ligne doit être supprimée
    //     // ... votre logique de sauvegarde ou d'envoi AJAX si vous le souhaitez
    //     // closeModalFunc(); // Cette ligne sera appelée après la soumission réussie du formulaire
    // });
</script>
