<!-- resources/views/emplacements/index.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Liste des emplacements</h2>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('emplacements.create') }}" class="btn btn-primary mb-3">Ajouter un emplacement</a>
    

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Adresse</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($emplacements as $emplacement)
            <tr>
                <td>{{ $emplacement->nom }}</td>
                <td>{{ $emplacement->adresse }}</td>
                <td>
                    <a href="{{ route('emplacements.edit', $emplacement->id) }}" class="btn btn-warning btn-sm">Modifier</a>

                    <form action="{{ route('emplacements.destroy', $emplacement->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm" onclick="return confirm('Confirmer la suppression ?')">Supprimer</button>
                    </form>
                </td>
            </tr>
            @endforeach

            @if($emplacements->isEmpty())
            <tr>
                <td colspan="3">Aucun emplacement trouvé.</td>
            </tr>
            @endif
        </tbody>
    </table>
</div>
@endsection

@if(session('success'))
    <div x-data="{ show: true }" x-show="show" x-transition
         class="mb-4 p-4 rounded bg-green-100 text-green-800 border border-green-200 relative">
        <strong class="font-semibold">Succès !</strong> {{ session('success') }}
        <button @click="show = false" class="absolute top-2 right-2 text-green-600 hover:text-green-800">
            <i class="ri-close-line"></i>
        </button>
    </div>
@endif


<!-- Alpine.js nécessaire -->
<div x-data="{ openModal: false }">
    <!-- Le bouton qui ouvre la modale -->
    <button @click="openModal = true" id="add-emplacement-btn" class="bg-secondary text-cardBg px-4 py-2 rounded-lg hover:bg-opacity-90 transition-colors duration-200 !rounded-button whitespace-nowrap">
        <div class="flex items-center">
            <div class="w-4 h-4 flex items-center justify-center mr-1"><i class="ri-add-line"></i></div>
            <span>Ajouter un emplacement</span>
        </div>
    </button>

    <!-- La modale -->
    <div x-show="openModal" x-transition class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
        <div @click.away="openModal = false" class="bg-white p-6 rounded-lg w-full max-w-lg shadow-lg">
            <h2 class="text-xl font-semibold mb-4 text-gray-800">Ajouter un nouvel emplacement</h2>

            <form action="{{ route('emplacements.store') }}" method="POST" class="space-y-4">
                @csrf

                <div>
                    <label for="nom" class="block text-sm font-medium text-gray-700">Nom</label>
                    <input type="text" name="nom" id="nom" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-secondary focus:border-secondary">
                </div>

                <div>
                    <label for="type" class="block text-sm font-medium text-gray-700">Type</label>
                    <input type="text" name="type" id="type" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-secondary focus:border-secondary">
                </div>

                <div>
                    <label for="capacite" class="block text-sm font-medium text-gray-700">Capacité</label>
                    <input type="number" name="capacite" id="capacite" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-secondary focus:border-secondary">
                </div>

                <div>
                    <label for="tarif" class="block text-sm font-medium text-gray-700">Tarif (par heure)</label>
                    <input type="number" name="tarif" id="tarif" step="0.01" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-secondary focus:border-secondary">
                </div>

                <div class="flex justify-end">
                    <button type="button" @click="openModal = false" class="mr-3 px-4 py-2 rounded bg-gray-200 text-gray-700 hover:bg-gray-300">Annuler</button>
                    <button type="submit" class="px-4 py-2 rounded bg-secondary text-white hover:bg-opacity-90">Créer</button>
                </div>
            </form>
        </div>
    </div>
</div>

