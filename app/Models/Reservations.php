<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservations extends Model
{
    protected $fillable = [
        'id_user',
        'id_emplacement',
        'participants',
        'commentaires',
        'montant',
        'date_reserv',
        'heure_debut',
        'heure_fin',
        'statut', // ex : en cours, confirmée, annulée, en attente,
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
    public function emplacement()
    {
        return $this->belongsTo(Emplacements::class, 'id_emplacement');
    }
}
