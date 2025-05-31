<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Emplacements extends Model
{


    protected $fillable = [
        'type',
        'nom',
        'description',
        'tarif_hr',
        'image',
        'capacites',
    ];

    // Si tu veux gérer les dates automatiquement (created_at, updated_at), pas besoin de changer quoi que ce soit

    // Optionnel : si tu veux préciser que 'tarif_hr' est un float ou decimal, tu peux le caster
    protected $casts = [
        'tarif_hr' => 'float',
        'capacites' => 'integer',
    ];
}
