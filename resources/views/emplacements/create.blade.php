<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un emplacement</title>
    <link rel="stylesheet" href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/icons/boxicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/icons/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <style>
        body {
            background-color: #f4f6f9;
            font-family: 'Segoe UI', sans-serif;
        }

        .form-container {
            background-color: #ffffff;
            padding: 2.5rem;
            border-radius: 12px;
            max-width: 720px;
            margin: 3rem auto;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        }

        .form-title {
            font-size: 26px;
            font-weight: 700;
            color: #0d47a1;
            text-align: center;
            margin-bottom: 1.8rem;
        }

        label {
            font-weight: 500;
            color: #333;
        }

        input[type="text"],
        input[type="number"],
        input[type="file"],
        textarea,
        select {
            width: 100%;
            padding: 0.75rem;
            margin-top: 0.25rem;
            margin-bottom: 1rem;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 0.95rem;
        }

        .btn-submit {
            background-color: #0d47a1;
            color: #fff;
            padding: 0.7rem 2rem;
            border: none;
            border-radius: 6px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-submit:hover {
            background-color: #1565c0;
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="form-container">
            <h1 class="form-title">Ajouter un nouvel emplacement</h1>

            <form action="{{ route('emplacements.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label for="type"><strong>Type d'emplacement</label>
                    <select name="type" id="type" class="form-control" required>
                        <option value="">-- Sélectionner --</option>
                        <option value="Salle">salles</option>
                        <option value="Espace">espace</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="nom"><strong>Nom de l'emplacement</strong></label>
                    <input type="text" name="nom" id="nom" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="description"><strong>Description</strong></label>
                    <textarea name="description" id="description" rows="4" class="form-control" required></textarea>
                </div>

                <div class="form-group">
                    <label for="tarif_hr"><strong>Tarif horaire (FCFA)</strong></label>
                    <input type="number" name="tarif_hr" id="tarif_hr" step="0.01" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="image"><strong>Image de l'emplacement </strong></label>
                    <input type="file" name="image" id="image" class="form-control" accept="image/*">
                </div>

                <div class="form-group">
                    <label for="capacites"><strong>Capacité</strong></label>
                    <input type="number" name="capacites" id="capacites" class="form-control" required>
                </div>

                <div class="text-center mt-4">
                    <button type="submit" class="btn-submit">Enregistrer</button>
                </div>
            </form>
        </div>
    </div>

    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>
