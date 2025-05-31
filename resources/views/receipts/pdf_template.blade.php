
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Reçu de Réservation #{{ $reservation->id }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 40px;
            color: #333;
        }
        .container {
            width: 100%;
            margin: 0 auto;
            border: 1px solid #eee;
            padding: 30px;
            box-shadow: 0 0 10px rgba(0,0,0,0.05);
        }
        h1 {
            color: #0f1a2c;
            text-align: center;
            margin-bottom: 30px;
        }
        .header-logo {
            text-align: center;
            margin-bottom: 20px;
        }
        .header-logo span {
            /* Dompdf a un support limité pour les polices. 'Playfair Display' ne fonctionnera pas sans l'intégrer. */
            font-family: Arial, sans-serif; 
            font-size: 24px;
            font-weight: bold;
            color: #0f1a2c;
        }
        .details-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        .details-table th, .details-table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }
        .details-table th {
            background-color: #f2f2f2;
            color: #555;
        }
        .footer {
            text-align: center;
            margin-top: 50px;
            font-size: 0.9em;
            color: #777;
        }
        .status-badge {
            display: inline-block;
            padding: 4px 8px;
            border-radius: 9999px; /* rounded-full */
            font-size: 0.75rem; /* text-xs */
            font-weight: 500; /* font-medium */
            line-height: 1;
        }
        .status-confirmed {
            background-color: #d1fae5; /* bg-emerald-100 */
            color: #065f46; /* text-emerald-800 */
        }
        .status-pending {
            background-color: #fffbeb; /* bg-amber-100 */
            color: #b45309; /* text-amber-800 */
        }
        .status-canceled {
            background-color: #ffe4e6; /* bg-rose-100 */
            color: #be123c; /* text-rose-800 */
        }
        .status-en-cours { /* Ajoutez cette règle si 'En cours' a un style spécifique */
            background-color: #fffbe6;
            color: #b45309;
        }

    </style>
</head>
<body>
    @php
        // Carbon est déjà importé dans le contrôleur, il n'est pas nécessaire de le ré-importer ici.
        // Mais si vous utilisez ce template indépendamment, vous pouvez le garder.
        use Carbon\Carbon;
    @endphp
    <div class="container">
        <div class="header-logo">
            <span style="background-color: #f6ac0f; color: #0f1a2c; padding: 5px 8px; border-radius: 6px; font-size: 1.2em;">BW</span>
            <span style="margin-left: 5px;">Book<br/>Work</span>
        </div>
        <h1>Reçu de Réservation</h1>

        <p><strong>Date de génération du reçu:</strong> {{ $date_generation }}</p>

        <table class="details-table">
            <thead>
                <tr>
                    <th>Détail</th>
                    <th>Valeur</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>ID de Réservation</td>
                    <td>#{{ $reservation->id }}</td>
                </tr>
                <tr>
                    <td>Client</td>
                    <td>{{ $reservation->user->name }} {{ $reservation->user->surname }}</td>
                </tr>
                <tr>
                    <td>Email Client</td>
                    <td>{{ $reservation->user->email }}</td>
                </tr>
                <tr>
                    <td>Salle Réservée</td>
                    <td>{{ $reservation->emplacement->nom }} (Capacité: {{ $reservation->emplacement->capacites }} personnes)</td>
                </tr>
                <tr>
                    <td>Date de Réservation</td>
                    <td>{{ Carbon::parse($reservation->date_reserv)->format('d/m/Y') }}</td>
                </tr>
                <tr>
                    <td>Heure de Réservation</td> {{-- Nouvelle ligne pour l'heure précise de réservation --}}
                    <td>{{ Carbon::parse($reservation->created_at)->format('H:i:s') }}</td>
                </tr>
                <tr>
                    <td>Heure d'Arrivée</td>
                    <td>{{ Carbon::parse($reservation->heure_debut)->format('d/m/Y à H:i') }}</td>
                </tr>
                <tr>
                    <td>Heure de Départ</td>
                    <td>{{ Carbon::parse($reservation->heure_fin)->format('d/m/Y à H:i') }}</td>
                </tr>
                <tr>
                    <td>Durée</td>
                    <td>
                        @php
                            $debut = Carbon::parse($reservation->heure_debut);
                            $fin = Carbon::parse($reservation->heure_fin);
                            $diffMinutes = $debut->diffInMinutes($fin);
                            $hours = floor($diffMinutes / 60);
                            $minutes = $diffMinutes % 60;
                        @endphp
                        {{ $hours }}h{{ str_pad($minutes, 2, '0', STR_PAD_LEFT) }}
                    </td>
                </tr>
                <tr>
                    <td>Nombre de Participants</td>
                    <td>{{ $reservation->participants }}</td>
                </tr>
                <tr>
                    <td>Statut</td>
                    <td>
                        @php
                            $statusClass = '';
                            switch ($reservation->statut) {
                                case 'Confirmée': $statusClass = 'status-confirmed'; break;
                                case 'Terminée': $statusClass = 'status-pending'; break;
                                case 'Annulée': $statusClass = 'status-canceled'; break;
                                case 'En cours': $statusClass = 'status-en-cours'; break;
                                default: $statusClass = ''; break;
                            }
                        @endphp
                        <span class="status-badge {{ $statusClass }}">{{ $reservation->statut }}</span>
                    </td>
                </tr>
                <tr>
                    <td><strong>Montant Payé</strong></td>
                    <td><strong>{{ number_format($reservation->montant, 0, ',', ' ') }} FCFA</strong></td>
                </tr>
            </tbody>
        </table>

        <div class="footer">
            <p>Ce document est un reçu de votre réservation chez BookWork.</p>
            <p>Pour toute question, contactez-nous à info@bookwork.com</p>
        </div>
    </div>
</body>
</html>