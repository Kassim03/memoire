<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Capsule\Manager as Capsule;

return new class extends Migration {
    public function up()
    {
        if (!Capsule::schema()->hasTable('Reservations')) {
            Capsule::schema()->create('Reservations', function (Blueprint $table) {
                $table->id();
                $table->date('date'); // Longueur 10, type date
                $table->time('heure_start'); // Longueur 8, type time
                $table->time('heure_end'); // Longueur 8, type time
                $table->char('statut', 20); // Longueur 20, type char
                $table->decimal('prix_total', 10, 2); // Longueur 10,2
                $table->timestamps(); // Longueur 20 (created_at, updated_at)

                // Ajoutez ici les autres colonnes nécessaires, par exemple :
                // $table->string('name');
                // $table->integer('age');
            });
            echo "Table 'Reservations' créée avec succès.\n";
        } else {
            echo "La table 'Reservations' existe déjà.\n";
        }
    }

    public function down()
    {
        if (Capsule::schema()->hasTable('Reservations')) {
            Capsule::schema()->dropIfExists('Reservations');
            echo "Table 'Reservations' supprimée.\n";
        } else {
            echo "La table 'Reservations' n'existe pas.\n";
        }
    }
};
