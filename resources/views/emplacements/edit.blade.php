@extends('layouts.app')

@section('content')
    <style>
        body {
            background-color: #f0f2f5;
        }

        .form-wrapper {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }

        .form-section {
            background: #f9f9f9;
            border-radius: 12px;
            padding: 30px;
            width: 100%;
            max-width: 700px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .form-section h1 {
            font-size: 26px;
            margin-bottom: 25px;
            color: #1e3a8a;
            text-align: center;
        }

        .form-group label {
            font-weight: bold;
            margin-bottom: 6px;
            display: block;
            color: #1e1e1e;
        }

        .form-control,
        select,
        textarea {
            width: 100%;
            padding: 10px 14px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 15px;
            transition: border-color 0.3s, background-color 0.3s;
        }

        .form-control:focus,
        select:focus,
        textarea:focus {
            border-color: #007bff;
            background-color: #dbeafe; /* bleu clair si focus */
            outline: none;
        }

        /* Si le champ contient une valeur, on colore */
        .form-control:not(:placeholder-shown),
        textarea:not(:placeholder-shown) {
            background-color: #dbeafe;
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
                font-size: 22px;
            }
        }
        .current-image {
            margin-top: 10px;
            text-align: center;
        }

        .current-image img {
            max-width: 200px;
            height: auto;
            border-radius: 10px;
            border: 1px solid #ccc;
        }
    </style>

    <div class="form-wrapper">
        <div class="form-section">
            <h1>Modifier l'emplacement</h1>

            <form action="{{ route('emplacements.update', $emplacement->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- Type --}}
                <div class="form-group mb-3">
                    <label for="type">Type d'emplacement</label>
                    <div class="radio-group">
                        <label>
                            <input type="radio" name="type" value="salles" {{ $emplacement->type == 'salles' ? 'checked' : '' }} required>
                            Salle
                        </label>
                        <label>
                            <input type="radio" name="type" value="espace" {{ $emplacement->type == 'espace' ? 'checked' : '' }} required>
                            Espace
                        </label>
                    </div>
                </div>

                {{-- Nom --}}
                <div class="form-group mb-3">
                    <label for="nom">Nom de l'emplacement</label>
                    <input type="text" name="nom" id="nom" class="form-control" value="{{ $emplacement->nom }}" required placeholder=" ">
                </div>

                {{-- Description --}}
                <div class="form-group mb-3">
                    <label for="description">Description</label>
                    <textarea name="description" id="description" class="form-control" rows="3" placeholder=" ">{{ $emplacement->description }}</textarea>
                </div>

                {{-- Capacité --}}
                <div class="form-group mb-3">
                    <label for="capacites">Capacité</label>
                    <input type="number" name="capacites" id="capacites" class="form-control" value="{{ $emplacement->capacites }}" placeholder=" ">
                </div>

                {{-- Tarif --}}
                <div class="form-group mb-3">
                    <label for="tarif_hr">Tarif horaire (en FCFA)</label>
                    <input type="number" name="tarif_hr" id="tarif_hr" class="form-control" value="{{ $emplacement->tarif_hr }}" step="0.01" placeholder=" ">
                </div>

                {{-- Image actuelle --}}
                @if($emplacement->image)
                    <div class="form-group mb-3 current-image">
                        <label>Image actuelle</label><br>
                        <img src="{{ asset('assets/' . $emplacement->image) }}" alt="Image actuelle">
                    </div>
                @endif

                {{-- Nouvelle image --}}
                <div class="form-group mb-3">
                    <label for="image">Changer l'image</label>
                    <input type="file" name="image" id="image" class="form-control">
                </div>

                {{-- Boutons --}}
                <div class="form-group mt-4 text-center">
                    <button type="submit" class="btn btn-primary">Mettre à jour</button>
                    <a href="{{ route('adminboard') }}" class="btn btn-secondary">Annuler</a>
                </div>
            </form>
        </div>
    </div>
@endsection
