@extends('layouts.app')

@section('content')
    <style>
        .form-section {
            background: #f9f9f9;
            border-radius: 12px;
            padding: 30px;
            max-width: 700px;
            margin: 0 auto;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .form-section h1 {
            font-size: 24px;
            margin-bottom: 25px;
            color: #333;
        }

        .form-group label {
            font-weight: bold;
            margin-bottom: 6px;
            display: block;
            color: #222;
        }

        .form-control, select {
            width: 100%;
            padding: 10px 14px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 15px;
            transition: border-color 0.3s;
        }

        .form-control:focus {
            border-color: #007bff;
            outline: none;
        }

        .radio-group {
            display: flex;
            gap: 20px;
            margin-top: 8px;
        }

        .radio-group label {
            display: flex;
            align-items: center;
            gap: 8px;
            font-weight: 500;
        }

        .btn-primary {
            background-color: #007bff;
            border: none;
            padding: 10px 20px;
            border-radius: 8px;
            color: white;
            font-weight: bold;
        }

        .btn-secondary {
            background-color: #6c757d;
            border: none;
            padding: 10px 20px;
            border-radius: 8px;
            color: white;
            margin-left: 10px;
        }

        @media (max-width: 600px) {
            .form-section {
                padding: 20px;
            }

            .form-section h1 {
                font-size: 20px;
            }
        }
    </style>

    <div class="form-section">
        <h1>Modifier l'emplacement</h1>

        <form action="{{ route('emplacements.update', $emplacement->id) }}" method="POST">
            @csrf
            @method('PUT')

            {{-- Type --}}
            <div class="form-group mb-3">
                <label for="type">Type d'emplacement</label>
                <div class="radio-group">
                    <label>
                        <input type="radio" name="type" value="Salle" {{ $emplacement->type == 'Salle' ? 'checked' : '' }} required>
                        Salle
                    </label>
                    <label>
                        <input type="radio" name="type" value="Espace" {{ $emplacement->type == 'Espace' ? 'checked' : '' }} required>
                        Espace
                    </label>
                </div>
            </div>

            {{-- Nom --}}
            <div class="form-group mb-3">
                <label for="nom">Nom de l'emplacement</label>
                <input type="text" name="nom" id="nom" class="form-control" value="{{ $emplacement->nom }}" required>
            </div>

            {{-- Description --}}
            <div class="form-group mb-3">
                <label for="description">Description</label>
                <textarea name="description" id="description" class="form-control" rows="3">{{ $emplacement->description }}</textarea>
            </div>

            {{-- Capacité --}}
            <div class="form-group mb-3">
                <label for="capacite">Capacité</label>
                <input type="number" name="capacite" id="capacite" class="form-control" value="{{ $emplacement->capacites }}">
            </div>

            {{-- Montant --}}
            <div class="form-group mb-3">
                <label for="montant">Tarif horaire (en FCFA)</label>
                <input type="number" name="montant" id="montant" class="form-control" value="{{ $emplacement->tarif_hr }}" step="0.01">
            </div>

            {{-- Bouton de soumission --}}
            <div class="form-group mt-4">
                <button type="submit" class="btn btn-primary">Mettre à jour</button>
                <a href="{{ route('emplacements.index') }}" class="btn btn-secondary">Annuler</a>
            </div>
        </form>
    </div>
@endsection


